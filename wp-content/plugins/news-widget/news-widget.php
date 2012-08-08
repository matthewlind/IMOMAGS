<?php

/*
Plugin Name: RSS News widget 
Plugin URI: http://www.sitebase.be
Description: Show news from one or more RSS/Atom feeds in a widget
Author: Sitebase
Version: 1.1
Requires at least: 3.0
Author URI: http://www.sitebase.be
*/
	
// Include library
if(!class_exists('WpFramework_Base_0_5')) include "lib/wp-framework/Base.php";
if(!class_exists('WpFramework_Vo_Form')) include_once "lib/wp-framework/Vo/Form.php";
if(!class_exists('HtmlHelper')) include_once "lib/HtmlHelper.php";
if(!class_exists('ApiClient')) include_once "lib/ApiClient.php";
class NewsWidget extends WpFramework_Base_0_5 {
		
	const NAME = 'RSS News Widget';
	const NAME_SLUG = 'news-widget';
		
	private $_form_fields_default = array(
								'title'	=> 'Feed Reader',
								'feed1' => '',
								'feed2' => '',
								'feed3' => '',
								'feed4' => '',
								'feed5' => '',
								'feed6' => '',
								'view' => 'basic',
								'number' => '5',
								'cache' => '3',
								'use_ajax' => false,
								'random' => false,
								'ajax_refresh_time' => '30'
	);
	
	private $_footer_js = '';
	
	private $_form_validators = null;
	
	public function NewsWidget() {
		parent::__construct();
		$widget_ops = array('description' => 'Show news from one or more RSS/Atom feeds in a widget.' );
		$this->WP_Widget(self::NAME_SLUG, self::NAME, $widget_ops);
		
		// Use jquery
		$this->enqueue_script('jquery');
		
		// Bind ajax action
		add_action('wp_ajax_nopriv_news_widget_refresh', array($this, 'refresh'));
		add_action('wp_ajax_news_widget_refresh', array($this, 'refresh'));
		add_action( 'wp_scheduled_delete', array($this, 'cleanup') );
		
		// Validate input
		$this->load(array('Abstract', 'NotEmpty', 'Url', 'Integer'), 'WpFramework_Validators_');
		//$this->_form_validators['feed1'][] = new WpFramework_Validators_NotEmpty(__('You must at least fill in one feed'));
		$url_validator = new WpFramework_Validators_Url(__('This is not a valid url'));
		$this->_form_validators['feed1'][] = $url_validator;
		$this->_form_validators['feed2'][] = $url_validator;
		$this->_form_validators['feed3'][] = $url_validator;
		$this->_form_validators['feed4'][] = $url_validator;
		$this->_form_validators['feed5'][] = $url_validator;
		$this->_form_validators['feed6'][] = $url_validator;
		$this->_form_validators['number'][] = new WpFramework_Validators_Integer(__('This must be a number. Fill in 0 if you want to return all items.'));
		$this->_form_validators['ajax_refresh_time'][] = new WpFramework_Validators_Integer(__('This must be a number. Fill in a number bigger as 3.'), 3);
		$this->_form_validators['cache'][] = new WpFramework_Validators_Integer(__('This must be a number.'));
	}
	
	/**
	 * Init
	 */
	public function action_init() {
		add_shortcode('newswidget', array($this, 'shortcode'));
		add_filter('media_buttons_context', array($this, 'add_media_button'));
	}
	
	/**
	 * Widget display method
	 * 
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	public function widget($args, $instance) {
		
		if(!is_array($args) || !is_array($instance)) exit();
		
		// Merge data
		$data = array_merge($this->_form_fields_default, $args, $instance);

		// Get entries from the selected feeds
		$cache_key = 'news_widget_' . md5(implode('_', $data));
		if (false === ($entries = get_transient($cache_key)) || $data['cache'] == 0 ){
			$entries = array();
			for($i=1 ; $i < 7 ; $i++) {
				if(isset($data['feed' . $i]) && WpFramework_Validators_Url::validate($data['feed' . $i])) {
					$new_entries = $this->read_feed($data['feed' . $i]);
					$entries += $new_entries;
				}
			}
			if($data['cache'] != 0) set_transient($cache_key, $entries, $data['cache']);
		}

		// Randomize entries
		if($data['random'] == 'true') {
			shuffle($entries);
		}
		
		// Trim number of items
		if(is_numeric($data['number']) && $data['number'] > 0) {
			$entries = array_slice($entries, 0, $data['number']);
		}
		
		// Add entries to data array
		$data['entries'] = $entries;
		
		if($data['use_ajax'] == 'true') {
			$this->_footer_js .= 'setTimeout(function() {refresh_news_widget("' . $data['widget_id'] . '", ' . ($data['ajax_refresh_time']*1000) . '); }, ' . ($data['ajax_refresh_time']*1000) . ');' . PHP_EOL;
			if(!isset($_SESSION)) session_start();
			$_SESSION['newswidget']['ajax'][$data['widget_id']]['instance'] = serialize($instance);
			$_SESSION['newswidget']['ajax'][$data['widget_id']]['args'] = serialize($args);
		}
		echo '<div id="' . $data['widget_id'] . '">';
		$this->load_view($this->plugin_path . "/views/" . $data['view'] . ".php", $data);
		echo '</div>';
	}
	
	/**
	 * Widget update method
	 * 
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return void
	 */
	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		foreach($this->_form_fields_default as $key => $value){
			$instance[$key] = strip_tags($_POST[$key]);
		}
		return $instance;
	}
	
	/**
	 * Widget form method
	 * 
	 * @param array $instance
	 * @return void
	 */
	public function form($instance) {
		$instance = wp_parse_args( (array) $instance, $this->_form_fields_default );
		
		// If not isset the form is not submitted
		$validation_results = $this->validate_fields($instance, $this->_form_validators);
		$data['wpform'] = new WpFramework_Vo_Form($instance, $validation_results);
		
		$this->load_view($this->plugin_path . "/views/widget-options.php", $data);
		
		// Cleanup database cache entries
		global $wpdb;
		$query = "SELECT option_name FROM $wpdb->options WHERE option_name LIKE '%_transient_timeout_news_widget%' AND option_value < " . time();
		$result = $wpdb->get_results($query);
		foreach($result as $entry) {
			delete_transient(str_replace('_transient_timeout_', '', $entry->option_name));
		}

	}
	
	/**
	 * Add refresh js to header if ajax is enabled
	 * 
	 * @return void
	 */
	public function action_wp_footer() {
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			<?php echo $this->_footer_js; ?>
		});
		function refresh_news_widget(id, speed) {
			var data = {
				action: 'news_widget_refresh',
				id: id
			};

			jQuery.post('<?php echo get_bloginfo('url') ?>/wp-admin/admin-ajax.php', data, function(response) {
				if(response == '') return;
				jQuery('#' + data.id).replaceWith(response);
				setTimeout(function() {
					refresh_news_widget(id, speed);
				}, speed);
			});
		}
		</script>
		<?php
	}
	
	/**
	 * Get a list of views
	 * 
	 * @param string $base
	 * @param bool $with_keys
	 * @return array
	 */
	public static function get_views($view_dir, $with_keys=true){
		$templates = array();
		if (is_dir($view_dir)) {
		    if ($dh = opendir($view_dir)) {
		        while (($file = readdir($dh)) !== false) {
		        	if(strstr($file, '.php') && strstr($file, 'view')){
		        		if($with_keys){
		           			$templates[substr($file, 0, -4)] = ucfirst(substr($file, 0, -4));
		        		}else{
		        			$templates[] = substr($file, 0, -4);
		        		}
		        	}
		        }
		        closedir($dh);
		    }
		}
		return $templates;
	}
	
	/**
	 * Ajax method that does a refresh of the widget
	 * 
	 * @return void
	 */
	public function refresh() {
		@session_start();
		$args = array();
		$instance = array();
		if(isset($_SESSION['newswidget'])){
			$args = unserialize($_SESSION['newswidget']['ajax'][$_POST['id']]['args']);
			$instance = unserialize($_SESSION['newswidget']['ajax'][$_POST['id']]['instance']);
		}
		$this->widget($args, $instance);
		exit();	
	}
	
	/**
	 * Function to read a feed
	 * 
	 * @param string $feed
	 * @return stdClass
	 */
	private function read_feed($feed, $items=10) {
		
		$default_params = array(
				'v' => '1.0',
				'key' => 'notsupplied',
				'output' => 'json',
				'hl' => 'en',
				'context' => 0,
				'num' => 10
		);
		
		$params = array_merge($default_params, array('q' => $feed, 'num' => $items));
		
		try {
			$Client = new ApiClient();
			$Client->setParams($params);
			$result = $Client->request('https://www.google.com/uds/Gfeeds', ApiClient::CONTENT_JSON);
			
			$website_title = $result->responseData->feed->title;
			$feed_url = $result->responseData->feed->feedUrl;
			$website_url = $result->responseData->feed->link;
			$website_description = $result->responseData->feed->description;
	
			$entries = array();
			foreach($result->responseData->feed->entries as $entry) {
				$entry->websiteTitle = $website_title;
				$entry->feedUrl = $feed_url;
				$entry->websiteUrl = $website_url;
				$entry->websiteDescription = $website_description;
				$image = $this->get_first_images($entry->content);
				if($image) $entry->image = $image;
				$time = strtotime($entry->publishedDate);
				$entries[$time] = $entry;
			}
			return $entries;
		}catch (Exception $e) {
			return array();	
		}
	}
	
	/**
	 * Get the first image url of images use in a html string
	 * 
	 * @param string $html
	 * @return string
	 */
	private function get_first_images($html){
		preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $html, $matches);
		if(isset($matches[1]) && isset($matches[1][0]) && !empty($matches[1][0])){
			return $matches[1][0];
  		}else{
  			return false;
  		}
	}
	
	/**
	 * Cleanup expired cache
	 *
	 * @return void
	 */
	public function cleanup() {
	 	global $wpdb, $_wp_using_ext_object_cache;

    	if( $_wp_using_ext_object_cache )
        	return;

    	$time = isset ( $_SERVER['REQUEST_TIME'] ) ? (int)$_SERVER['REQUEST_TIME'] : time() ;
    	$expired = $wpdb->get_col( "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout%' AND option_value < {$time};" );

    	foreach( $expired as $transient ) {
       		$key = str_replace('_transient_timeout_', '', $transient);
        	delete_transient($key);
   	 	}
	}
	
	/**
	 * When deactivate this plugin do a cleanup
	 * 
	 * @return void
	 */
	public function deactivate() {
		$this->cleanup();
	}
	
	/**
	 * Readable time
	 * 
	 * @param int $timestamp
	 * @return string
	 */
	public function readable_time($timestamp){
			if(!is_numeric($timestamp)) $timestamp = strtotime($timestamp);
            $diff = time() - $timestamp;
            $rest = ($diff % 3600);
            $restdays = ($diff % 86400);
			$restweeks = ($diff % 604800);
			$weeks = ($diff - $restweeks) / 604800;
			$days = ($diff - $restdays) / 86400;
            $hours = ($diff - $rest) / 3600;
            $seconds = ($rest % 60);
            $minutes = ($rest - $seconds) / 60;
            $date = '';
			if ($timestamp == '')
				return $lang_common['Never'];
			if($weeks > 1)
                return $date.sprintf(__("%d weeks ago", self::NAME_SLUG), $weeks);
            elseif($days > 1)
                return $date.sprintf(__("%d days ago", self::NAME_SLUG), $days);
			elseif($hours > 1)
                return $date.sprintf(__("%d hours ago", self::NAME_SLUG), $hours);
            elseif ($hours == 1)
                return $date.sprintf(__("1 hour, %d mins ago", self::NAME_SLUG), $minutes);
            elseif ($minutes == 0)
                return $date.sprintf(__("%d seconds ago", self::NAME_SLUG), $seconds);
			elseif ($minutes == 1)
                return $date.__("1 minute ago", self::NAME_SLUG);
			elseif ($seconds < 60)
                return $date.sprintf(__("%s mins ago", self::NAME_SLUG), $minutes);
	}
	
	/**
	 * Shortcode proxy that handles generating the extra variables needed
	 * to call the widget method
	 * 
	 * @param array $atts
	 * @return string
	 */
	public function shortcode($atts){
		$class = str_replace("_main", "", get_class($this));
		$args['widget_id'] = self::generate_widget_id($class);
		$args['widget_name'] = str_replace("_", " ", $class);
		$args['before_widget'] = '<div id="' . $args['widget_id'] . '" class="shortcode_' . strtolower($class) . ' wb-container">';
		$args['after_widget'] = '</div>';
		$args['before_title'] = isset($atts['before_title']) ? $atts['before_title'] : '<h3>';
		$args['after_title'] = isset($atts['after_title']) ? $atts['after_title'] : '</h3>';
		
		// Convert Yes checkbox value
		foreach($atts as $key => $value){
			if(!strcmp($value, 'true') || $value == 'yes'){
				$atts[$key] = 'true';
			} 
		}

		// Buffer output and return
		ob_start();
		$this->widget($args, $atts);
		$content = ob_get_contents();
		ob_end_clean();
		
		return $content;
	}
	
	/**
	  * Generate widget id based on widget class name
	  * 
	  * @param string $name
	  * @return string
	  */
	 public static function generate_widget_id($name){
	 	return str_replace('_main', '', strtolower($name)) . '_' . rand(1, time());
	 }
	 
	/**
	  * Add bubobox button above editor
	  * 
	  * @param array $context
	  * @return array
	  */
	 public function add_media_button($context) {
	 	return $context . '<script type="text/javascript">function add_newswidget() {
	 						send_to_editor(\'[newswidget feed1="http://rss1.smashingmagazine.com/feed/" view=\"basic-view\" number=\"5\" cache=\"60\" use_ajax=\"true\" random=\"true\" ajax_refresh_time=\"10\"]\');
	 						}</script>
	 						<a href="javascript:add_newswidget();" id="add_newswidget" title="Add News Widget"><img src="' . $this->plugin_url . '/assets/feed.png" alt="Add News Widget"></a>';
	 }

}

// Instead of creating a instance like for a dashboard widget/cpt or plugin
// You trigger the widget this way
add_action('widgets_init', create_function('', 'register_widget("NewsWidget");'));