<?php
// Define base row class so that it can be extended for different row types

class cfct_build_row {	
	
	private $defaults;
	protected $config;
	
	public $current_module;
	
	public function __construct($config) {
		// validate config first...
		$this->config = $config;
		
		$row_defaults = array(
			'row_class' => 'cfct-row',
			'block_class' => 'cfct-block'
		);
		$row_defaults = apply_filters('cfct_row_defaults', $row_defaults); // @deprecated, remove in 1.2
		$this->defaults = apply_filters('cfct-row-defaults', $row_defaults);
		
		// do not override these default classes at this point, none of them will correspond to needed classes in JS
		$this->defaults = array_merge($this->defaults, array(
			'add_new_module_class' => 'cfct-add-new-module',
			'remove_row_class' => 'cfct-row-delete',
			'row_handle_class' => 'cfct-row-handle'
		));
	}

// Module integrity check

	/**
	 * Simple validation of module data to check validity
	 *
	 * @param array $module_data 
	 * @param array $build_data 
	 * @return bool
	 */
	public function is_malformed_module_data($module_data, $build_data) {
		// empty is bad, and easy to check
		if (empty($module_data)) {
			return true;
		}
		
		// check required fields
		$required_fields = array(
			'module_type',
			'module_id',
			'block_id'
		);
		foreach ($required_fields as $key) {
			if (empty($module_data[$key])) {
				return true;
			}
		}
		
		// widgets need a widget id
		if ($module_data['module_type'] == 'cfct_module_widget_full') {
			if (empty($module_data['widget_id'])) {
				return true;
			}
		}

		return false;
	}
	
	/**
	 * Pull the module key from the saved data
	 *
	 * Accommodates widgets having special needs:
	 * Widgets used to be registered with the widget_id that WordPress would generate based on the classname of the widget.
	 * They are now registered differently under a generic classname. When that classname isn't stored we need to try and revert
	 * to the old name that was registered based on the wordpress generated name.
	 *
	 * @param array $module saved module data
	 * @return string the module key used to pull the right output module
	 */
	public function determine_module_key($module) {
	
		$module_key = $module['module_type'];
		
		if (!empty($module['widget_id'])) {
			if (!empty($module['module_id_base'])) {
				$module_key = $module['module_id_base'];
			}
			else {
				$module_key = $module['widget_id'];
			}
		}

		return $module_key;
	}

// row content output

	/**
	 * Process Admin data for output, then pass to builder for return
	 *
	 * @param array $opts 
	 * @param array $data 
	 * @param object $template 
	 * @return string html
	 */
	public function admin(array $opts, array $data = array(), $template) {
		$blocks = array();
		$empty = true;
		if (is_array($this->config['blocks']) && count($this->config['blocks'])) {
			foreach ($this->config['blocks'] as $a => $block) {
				$modules = '';
				$blockdata = array_shift($opts['blocks']);
				if (isset($data['blocks'][$blockdata['guid']]) && is_array($data['blocks'][$blockdata['guid']])) {
					foreach ($data['blocks'][$blockdata['guid']] as $module_id) {
						$module = $data['modules'][$module_id];
						
						if ($this->is_malformed_module_data($module, $data)) {
							continue;
						}

						$module_key = $this->determine_module_key($module);

						if ($template->module_type_exists($module_key)) {						
							$modules .= $template->get_module($module_key)->_admin('details', $module);
						}
					}
				}
				
				if (!empty($modules)) {
					$empty = false;
				}

				$html = $this->block_html(true);
				$block_values = array(
					'{class}' => $this->block_class($block['class'], $a),
					'{modules}' => $modules,
					'{id}' => $blockdata['guid'],
					'{attrs}' => ''
				);
				if (isset($block['attrs']) && is_array($block['attrs']) && !empty($block['attrs'])) {
					$attrs = array();
					foreach ($block['attrs'] as $attr => $value) {
						$attrs[] = $attr.'="'.$value.'"';
					}
					$block_values['{attrs}'] = ' '.implode(' ', $attrs);
				}
				
				$blocks_controls[$a] = str_replace('{attrs}', $block_values['{attrs}'], $this->block_controls($blockdata['guid']));
				$blocks[$a] = str_replace(array_keys($block_values), array_values($block_values), $html);
			}
		}
		
		$html = $this->row_html(true);

		$row_values = array(
			'{class}' => $this->row_class($this->config['class']),
			'{id}' => $opts['guid']
		);
		
		if ($empty) {
			$row_values['{class}'] .= ' cfct-row-empty';
		}
		
		// handle custom blocks order
		if (isset($this->config['admin_blocks']) && !empty($this->config['admin_blocks'])) {
			$blocks_html = $this->config['admin_blocks'];
			preg_match_all('/{(block_([0-9]))}/', $blocks_html, $match);
			foreach ($match[2] as $key => $block_id) {
				$row_values['{'.$match[1][$key].'}'] = $blocks[$block_id];
				$row_values['{'.$match[1][$key].'_controls}'] = $blocks_controls[$block_id];
				
			}
			$html = str_replace('{row_blocks}', $blocks_html, $html);
		}
		else {
			$html = str_replace('{row_blocks}', $this->row_blocks(), $html);
			$row_values['{blocks}'] = implode('', $blocks);
			$row_values['{blocks_controls}'] = implode('', $blocks_controls);
		}
		$html = str_replace(array_keys($row_values), array_values($row_values), $html);
		
		return apply_filters('cfct-build-row-'.$this->config['class'].'-admin-html', $html);
	}
	
	/**
	 * Get the row in a plain text form with no formatting
	 * Calls 'text' method on each module.
	 * Modules that should not be included in such items as search data should return 
	 * an emtpy value for their textual representation.
	 *
	 * @param array $opts 
	 * @param array $data 
	 * @param string $template 
	 * @return void
	 */
	public function text(array $opts, array $data = array(), $template) {
		$text = '';
		if (is_array($this->config['blocks']) && count($this->config['blocks'])) {
			foreach ($this->config['blocks'] as $a => $block) {
				$blockdata = array_shift($opts['blocks']);
				if (isset($data['blocks'][$blockdata['guid']]) && is_array($data['blocks'][$blockdata['guid']])) {
					foreach ($data['blocks'][$blockdata['guid']] as $module_id) {
						$module = $data['modules'][$module_id];
						if ($this->is_malformed_module_data($module, $data)) {
							continue;
						}
						
						$module_key = $this->determine_module_key($module);
						
						if ($template->module_type_exists($module_key)) {
							$text .= trim($template->get_module($module_key)->_text($module, true)).PHP_EOL;
						}
					}
				}				
			}
		}
		return $text;
	}
	
	/**
	 * Process Client data for output, then pass to builder for return
	 *
	 * @param array $opts 
	 * @param array $data 
	 * @param string $template 
	 * @return void
	 */
	public function html(array $opts, array $data = array(), $template) {
		$blocks = array();
		if (is_array($this->config['blocks']) && count($this->config['blocks'])) {
			foreach ($this->config['blocks'] as $a => $block) {
				$modules = '';
				$blockdata = array_shift($opts['blocks']);
				if (isset($data['blocks'][$blockdata['guid']]) && is_array($data['blocks'][$blockdata['guid']])) {
					foreach ($data['blocks'][$blockdata['guid']] as $module_id) {
						$module = $data['modules'][$module_id];

						if ($this->is_malformed_module_data($module, $data)) {
							continue;
						}
						
						$module_key = $this->determine_module_key($module);
												
						if ($template->module_type_exists($module_key)) {
							$this->current_module = $template->get_module($module_key);
							$modules .= $template->get_module($module_key)->html($module);
							$this->current_module = null;
						}
					}
				}
			
				if (isset($block['html']) && false !== $block['html']) {
					$html = $block['html'];
				}
				else {
					$html = $this->block_html();
				}
				$block_values = array(
					'{class}' => $this->block_class($block['class'], $a),
					'{module}' => $modules,
					'{id}' => $blockdata['guid']
				);		
			
				$blocks[$a] = str_replace(array_keys($block_values), array_values($block_values), $html);
			}
		}
		
		// pull html if there, but don't allow it to be empty
		if (!empty($this->config['html'])) {
			$html = $this->config['html'];
		}
		else {
			$html = $this->row_html();
		}
		
		// build row HTML
		$row_values = array(
			'{class}' => $this->row_class($this->config['class']),
			'{id}' => $opts['guid']
		);
		
		// handle custom blocks order
		if (strpos($html, '{blocks}') === false) {
			preg_match_all('/{block_([0-9])}/', $html, $match);
			foreach ($match[1] as $key => $block_id) {
				$row_values[$match[0][$key]] = $blocks[$block_id];
			}
		}
		else {
			$row_values['{blocks}'] = implode('', $blocks);
		}
		
		// put it all together
		$html = str_replace(array_keys($row_values), array_values($row_values), $html);
		return apply_filters('cfct-build-row-'.$this->config['class'].'-html', $html);
	}

// templates

	/**
	 * row_html
	 * Define row_html defaults
	 *
	 * @param bool $admin 
	 * @return string html
	 */
	function row_html($admin = false) {
		if ($admin) {
			$html = '
				<div id="{id}" class="{class}">
					<div class="cfct-row-inner">
						<div title="'.__('Drag and drop to reorder', 'carrington-build').'" class="'.$this->defaults['row_handle_class'].'">
							<a class="'.$this->defaults['remove_row_class'].'" href="#">'.__('Remove', 'carrington-build').'</a>
						</div>
						'.$this->row_table().'
					</div>
				</div>';
		}
		else {
			$html = '
				<div id="{id}" class="{class}">
					<div class="cfct-row-inner">{blocks}</div>
				</div>';
		}
		return apply_filters('cfct-row-'.($admin ? 'admin-' : '').'html', $html, $this->config['class']);
	}
	
	function row_table() {
		return '
			<table class="cfct-row-blocks">
				<tbody>
					{row_blocks}
				</tbody>
			</table>';
	}
	
	function row_blocks() {
		return '
			<tr>
				{blocks}
			</tr>
			<tr class="cfct-build-module-controls">
				{blocks_controls}
			</tr>';
	}
	
	/**
	 * block_html
	 * Define block html defaults
	 *
	 * @param bool $admin 
	 * @return string html
	 */
	function block_html($admin = false) {
		if ($admin) {
			$html = '
					<td id="{id}" class="{class}"{attrs}>
						<div class="cfct-block-modules">
							{modules}
						</div>
					</td>';
		}
		else {
			$html = '<div id="{id}" class="{class}">{module}</div>';
		}
		return apply_filters('cfct-block-'.($admin ? 'admin-' : '').'html', $html, $this->config['class']);
	}
	
	function block_controls($id = null) {
		$html = '
			<td class="cfct-build-add-module"{attrs}>
				<p><a class="'.$this->defaults['add_new_module_class'].'" href="#'.$id.'"><img class="cfct-icon-add" src="'.CFCT_BUILD_URL.'img/x.gif" alt="Click to" /> '.__('Add Module', 'carrington-build').'</a></p>
			</td>';
		return $html;
	}

// Helpers
	
	/**
	 * Go through the row options and generate guids
	 * Called when processing generation of a blank row
	 *
	 * @param array $opts 
	 * @return array
	 */
	public function process_new($opts) {
		$opts['guid'] = cfct_build_guid($opts['type'], 'row');
		if (empty($opts['blocks']) || !is_array($opts['blocks']) || !count($opts['blocks'])) {
			$blocks = $this->config['blocks'];
			$i=0;
			foreach ($blocks as $block) {
				$block['guid'] = cfct_build_guid($block['class'].(++$i), 'block');
				$opts['blocks'][$block['guid']] = $block;
			}
		}
		
		return $opts;
	}
	
	private function row_class($class) {
		$classes[] = $this->defaults['row_class'];	// add the default row class
		$classes[] = $class;						// add the specified class
		return implode(' ', $classes);
	}
	
	private function block_class($class, $block_id) {
		$classes[] = $this->defaults['block_class'];	// add the default block class
		$classes[] = 'block-'.$block_id; 				// add a block class that tells us which numeric position he is
		$classes[] = $class; 							// add the specified block class
		return implode(' ', $classes);
	}
	
	/**
	 * Public CSS function to allow row to provide custom CSS
	 * Override in child class to use.
	 *
	 * @return string css
	 */
	public function css() {
		return null;
	}
	
	/**
	 * Admin CSS function to allow additional CSS to be added to the Admin
	 * neck, meet rope.
	 *
	 * @return string
	 */
	public function _admin_css() {
		return null;
	}
	
	/**
	 * Empty block
	 *
	 * @deprecated
	 * @return html
	 */
	public function empty_block() {
		return '<div class="cfct-empty-module">&nbsp;</div>';
	}

// Icon handling

	function icon() {
		return isset($this->config['icon']) ? $this->config['icon'] : false;
	}

	/**
	 * Get the row icon.
	 * Icon can be defined in $opts['icon'].
	 * Alternately the icon() method can be overridden to return a path if special operations are needed
	 *
	 * @return string - icon url
	 */
	public function get_icon() {
		if ($path = $this->icon()) {
			$icon = $path;			
			if (!preg_match('/^(http)/', $icon)) {
				$icon = CFCT_BUILD_URL.'rows/'.preg_replace('/^(\\/)/', '', $icon);
			}
		}
		else {
			// provide generic icon
			$icon = CFCT_BUILD_URL.'img/row-default-icon.png';
		}
		return apply_filters('cfct-'.$this->config['class'].'-row-icon', $icon);
	}
	
// Getters

	public function get_name() {
		return $this->config['name'];
	}
	
	public function get_config() {
		return $this->config;
	}
	
	public function get_config_item($key) {
		if (isset($this->config[$key])) {
			return $this->config[$key];
		}
		else {
			return false;
		}
	}
	
	public function get_desc() {
		return isset($this->config['description']) ? $this->config['description'] : null;
	}
	
	/**
	 * Handle pre-1.1 legacy ID attributes that were used to identify modules and rows
	 *
	 * @return string/bool
	 */
	public function _legacy_id() {
		return !empty($this->_deprecated_id) ? $this->_deprecated_id : false;
	}
	
	public function __get($var) {
		if (isset($this->config[$var])) {
			return $this->config[$var];
		}
		return false;
	}
	
	public function __isset($var) {
		return isset($this->config[$var]);
	}
	
	public function __set($var, $val) {
		// setting disabled
		return false;
	}
	
// Revision Manager Integration

	/**
	 * Describe the row contents in human readable form
	 *
	 * @param array $opts 
	 * @param array $data 
	 * @param object $template 
	 * @return string html
	 */
	public function describe(array $opts, array $data, $template) {
		$ret = '
			<li>
				<b>Row Type: '.esc_html($this->get_name()).' ('.esc_attr($this->config['class']).')</b><br />
				Row Modules:
				<ul style="margin-left: 1.5em; list-style: disc outside;">';
				
		if (is_array($this->config['blocks']) && count($this->config['blocks'])) {
			foreach ($this->config['blocks'] as $a => $block) {
				$blockdata = array_shift($opts['blocks']);
				if (isset($data['blocks'][$blockdata['guid']]) && is_array($data['blocks'][$blockdata['guid']]) && count($data['blocks'][$blockdata['guid']])) {
					foreach ($data['blocks'][$blockdata['guid']] as $module_id) {
						$module = $data['modules'][$module_id];
						$_module = $template->get_module($module['module_type']);
						$ret .= '
							<li>'.trim($_module->get_name()).' ('.$_module->get_id().'): '.trim(esc_html($_module->text($module))).'</li>';
					}
				}
				else {
					$ret .= '<li>Empty Row</li>';
				}
			}
		}
		else {
			$ret .= '<li>Row has no blocks</li>';
		}
		
		$ret .= '
				</ul>
			</li>';
		return $ret;
	}
}

?>
