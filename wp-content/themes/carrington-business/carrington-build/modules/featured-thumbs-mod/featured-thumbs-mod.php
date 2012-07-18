<?php

if (!class_exists('cfct_module_featured_thumbs_mod') && class_exists('cfct_build_module')) {
	class cfct_module_featured_thumbs_mod extends cfct_build_module {
		protected $context_excludes = array(
			'multi-module'
		);
		
		protected $default_display_args = array(
			'ignore_sticky_posts' => 1
		);		


		const POST_TYPES_FILTER = 'cfct-module-loop-post-types';
		const TAXONOMY_TYPES_FILTER = 'cfct-module-loop-taxonomy-types';
		protected $content_display_options = array();		
		protected $default_content_display = 'title';
		protected $default_item_count = 10;
		protected $default_item_offset = 0;
		protected $default_post_type = 'post';
		protected $default_relation = 'AND';
		protected $default_tax_select_text = '&mdash; Select taxonomy to filter &mdash;';
		protected $js_base = 'cfct_thumb';
		
		public function __construct() {
			$opts = array(
				'description' => __('A 4 thumb Image Carousel (mod)', 'carrington-build'),
				'icon' => 'featured-thumbs/icon.png'
			);
			parent::__construct('cfct-module-featured-thumbs-mod', __('Featured Thumbs (mod)', 'carrington-build'), $opts);
			add_filter('wp_ajax_cfct_featured_thumbs_post_search', array($this, '_handle_featured_thumbs_request'));
			
			wp_register_script('featured-thumbs-mod-js',$this->get_url().'js/featured-thumbs-mod.js',array('jquery','jquery-ui-core','jquery-ui-tabs'));
			wp_register_style('featured-thumbs-mod-css',$this->get_url().'css/featured-thumbs-mod.css');
			
			if (!is_admin()) {
				
				wp_enqueue_script('jquery-ui-tabs');
				wp_enqueue_script('jquery-ui-core');
				wp_enqueue_script('featured-thumbs-js',NULL,array('jquery','jquery-ui-core','jquery-ui-tabs'));
				wp_enqueue_style('featured-thumbs-css');
				wp_enqueue_script('suggest');
			}
			
			
			
			// this is but a small subset of what the JS can do
			// but this is the "good" stuff, the rest is weird or fluffy
			$this->transitions = apply_filters('cfct-featured-thumbs-transitions-options', array(
				'none' => 'No transition effect',
				'fade' => 'Fade between images',
				'scrollHorz' => 'Scroll images left or right, per position',
				'scrollVert' => 'Scroll images up or down, per position',
				'cover' => 'Slide new image in on top',
				'uncover' => 'Slide old image off of top'
			));
			
			$this->nav_positions = apply_filters('cfct-featured-thumbs-nav-positions', array(
				'before' => 'Before Carousel',
				'after' => 'After Carousel',
				'overlay' => 'Inside Overlay'
			));
			$this->init();
		}

		protected function init() {
			// do this at init 'cause we can't do intl in member declarations
			$this->content_display_options = array(
				'title' => __('Titles Only', 'carrington-build'),
				'excerpt' => __('Titles &amp; Excerpts', 'carrington-build'),
				'content' => __('Titles &amp; Post Content', 'carrington-build')
			);
			


			// Taxonomy Filter Request Handler
			$this->register_ajax_handler($this->id_base.'-get-new-taxonomy-block', array($this, 'get_new_taxonomy_block'));
			add_action('wp_ajax_cf_taxonomy_filter_autocomplete', array($this, 'taxonomy_filter_autocomplete'));			
		}

// Display
		
		/**
		 * contains capacity to have pre-defined links & image urls,
		 * though that functionality is not exposed in the admin
		 *
		 * @param string $data 
		 * @return void
		 */
		public function display($data) {
			$this->cache_global_post();
			$args = $this->set_display_args($data);
			ob_start();
			

			$the_query = new WP_Query( $args );
					
				
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$ft_id = get_the_id();
				$data['cfct-module-featured-thumbs-mod-posts'][$ft_id] = array( 'id' => $ft_id, 'title' => get_the_title(), 'content' => '' );
			endwhile;
			$image_size = $data[$this->get_field_name('image_size-size')];
		
			// walk items to make sure they're all valid
			$items = array();
			$ft_count = 0;
			if (!$data[$this->get_field_name('posts')]){

				echo '<b>No featured thumbnails found for selected terms.</b>';

				
				return;

			}
			foreach ($data[$this->get_field_name('posts')] as $item) {
				$ft_count++;
				
				if (empty($item['link'])) {
					$item['link'] = get_permalink($item['id']);
				}
				
				if (empty($item['img_src'])) {
					$_img = $_img_id = null;
					$_img_id = get_post_meta($item['id'], '_thumbnail_id', true);
					if (!empty($_img_id) && $_img = wp_get_attachment_image_src($_img_id, "large-featured-thumb-x", false)) {
						$item['img_src'] = $_img;
						$item['img_src_thumb'] = wp_get_attachment_image_src($_img_id, "small-featured-thumb-x", false);
					}
				}
				
				// last chance for an image
				if (!empty($item['img_src'])) {
					$items[] = $item;
				}

				if ($ft_count >= 4)
					break;
			}
				
							
			$control_layout_order = apply_filters($this->id_base.'-control-layout-order', array(
				'title',
				'description',
				'call-to-action',
				'pagination'
			));
			
			// carousel defaults
			$car_opts = array(
				'link_images' => !empty($data[$this->get_field_name('link_images')]) ? true : false,
				'height' => intval($data[$this->get_field_name('height')]),
				'nav_pos' => esc_attr($data[$this->get_field_name('nav_pos')]),
				'nav_element' => apply_filters('cfct-featured-thumbs-nav-element', '<div class="car-pagination"><ol></ol></div>'),
				'nav_selector' => apply_filters('cfct-featured-thumbs-nav-selector', '#featured-thumbs-'.$data['module_id'].' .car-pagination ol', '#featured-thumbs-'.$data['module_id'])
			);
			
			// Make sure you quote string values - this distinguishes them from object literals
			$js_opts = apply_filters('cfct-featured-thumbs-js-options', array(
				'fx' => '"' . esc_attr($data[$this->get_field_name('transition')]) . '"',
				'speed' => abs(intval($data[$this->get_field_name('transition_duration')])),
				'timeout' => abs(intval($data[$this->get_field_name('auto_scroll')])),
				'pager' => '"' . $car_opts['nav_selector'] . '"',
				'activePagerClass' => '"active"',
				// Pause when hovering over nav
				'pauseOnPagerHover' => 'true',
				// Pause when hovering over slider
				'pause' => 'true',
				'prev' => '$(\'<a class="cfct-featured-thumbs-prev">'.__('Prev', 'carrington-build').'</a>\').insertBefore("'.$car_opts['nav_selector'].'")',
				'next' => '$(\'<a class="cfct-featured-thumbs-next">'.__('Next', 'carrington-build').'</a>\').insertAfter("'.$car_opts['nav_selector'].'")',
				// Callback for changing pane content
				'before' => 'cfctCarousel.PagerClick',
				'pagerAnchorBuilder' => 'cfctCarousel.PagerAnchorBuilder'
			), $car_opts);
			
			// Don't use json_encode because it quotes object literals, turning them into strings.
			$jobj = array();
			foreach ($js_opts as $key => $value) {
				$jobj[] = $key . ':' . $value;
			}
			$jobj = '{' . implode(',', $jobj) . ' }';
			
			$js_init = apply_filters('cfct-featured-thumbs-js-init', '
			<script type="text/javascript">
				jQuery(function($) {
					$("#featured-thumbs-'.$data['module_id'].' .car-content ul").cycle('.$jobj.');
				});
			</script>', $data['module_id'], $car_opts, $js_opts);
	
			return $this->load_view($data, compact('items', 'control_layout_order', 'image_size', 'car_opts', 'js_init'));
		}

		protected function set_display_args($data) {
			// Set default
			$args = $this->default_display_args;
			
			// Figure out post type or use default
			if (isset($data[$this->get_field_name('post_type')])) {
				$post_type = $data[$this->get_field_name('post_type')];
				if (!empty($post_type)) {
					$args['post_type'] = $post_type;
				}
			}
			
			$tax_input = $this->get_data('tax_input', $data);
			if (!empty($tax_input)) {
				$relation = $this->get_data('relation', $data, $this->default_relation);
				if (!empty($relation)) {
					$args['tax_query']['relation'] = $relation;

				}
				foreach ($tax_input as $taxonomy => $terms) {
					$taxonomy = get_taxonomy($taxonomy);
					$args['tax_query'][] = array(
						'taxonomy' => $taxonomy->name,
						'terms' => $terms,
						'field' => 'id',
						'orderby' => 'date', 
						'order' => 'DESC'
					);
				}
			}

			// Post Parent
			// @deprecated? @TODO check if any child-modules are using this ~sp
			$args['post_parent'] = !empty($data[$this->get_field_name('parent')]) ? $data[$this->get_field_name('parent')] : null;

			// Filter by Author
			$args['author'] = !empty($data[$this->get_field_name('author')]) ? $data[$this->get_field_name('author')] : null;

			// Number of items
			$args['posts_per_page'] = intval(!empty($data[$this->get_field_name('item_count')]) ? $data[$this->get_field_name('item_count')] : $this->default_item_count);

			// Item offset
			$args['offset'] = intval(isset($data[$this->get_field_name('item_offset')]) ? $data[$this->get_field_name('item_offset')] : $this->default_item_offset);

			// Don't include this post, otherwise we'll get an infinite loop
			global $post;
			$args['post__not_in'] = array($post->ID);
			$args['display'] = $data[$this->get_field_name('display_type')];
			
			return $args;
		}

		
// Admin
# Data upgrade

		/**
		 * Function to translate legacy loop save data in to "modern" loop save data.
		 * This is not going to be standard practice. It was unavoidable in the 1.1 upgrade.
		 *
		 * @param array $data 
		 * @return array
		 */
		protected function migrate_data($data) {
			if (!isset($data[$this->gfn('post_type')])) {
				$data[$this->gfn('post_type')] = array();
			}
			// post types used to be singular and stored as strings
			if (!is_array($data[$this->gfn('post_type')])) {
				$data[$this->gfn('post_type')] = (array) $data[$this->gfn('post_type')];
			}
		
			// tax_filter used to be the name, now its tax_input and stores much more data
			if (isset($data[$this->gfn('tax_filter')]) && !empty($data[$this->gfn('tax_filter')])) {
				$data[$this->gfn('tax_input')][$data[$this->gfn('taxonomy')]] = (array) $data[$this->gfn('tax_filter')];
				unset($data[$this->gfn('tax_filter')], $data[$this->gfn('taxonomy')]);
			}
		
			return apply_filters('cfct-migrate-loop-data', $data, $this);
		}



		public function text($data) {
			return 'Featured Thumb';
		}
		
		public function admin_form($data) {
			$size_select_args = array(
				'field_name' => 'image_size',
				'selected_size' => (!empty($data[$this->get_field_name('image_size-size')]) ? $data[$this->get_field_name('image_size-size')] : 'large')
			);
			
			$tabs = array(
				'car-items' => 'Items',
				
			);
			
			$transition_duration = !empty($data[$this->get_field_name('transition_duration')]) ? $data[$this->get_field_name('transition_duration')] : 300;
			$auto_scroll = !empty($data[$this->get_field_name('auto_scroll')]) ? $data[$this->get_field_name('auto_scroll')] : 0;
			$carousel_height = !empty($data[$this->get_field_name('height')]) ? $data[$this->get_field_name('height')] : '';
			$nav_pos = !empty($data[$this->get_field_name('nav_pos')]) ? $data[$this->get_field_name('nav_pos')] : 'after';
			
			$html = $this->cfct_module_tabs('cfct-car-tabs', $tabs, 'car-items').'
				<div id="cfct-car-tab-containers" class="cfct-module-tab-contents">
					<div id="car-settings" class="cfct-lbl-pos-left">
						<div class="cfct-elm-block">
							'.$this->_image_selector_size_select($size_select_args).'
						</div>
						<div class="cfct-elm-block has-checkbox mar-bottom-double">
							<input type="checkbox" class="elm-checkbox" id="'.$this->get_field_id('link_images').'" name="'.$this->get_field_name('link_images').'" value="1" '.checked('1', $data[$this->get_field_name('link_images')], false).' />
							<label for="'.$this->get_field_id('link_images').'" class="lbl-checkbox">'.__('Link images', 'carrington-buld').'</label>
						</div>
						<div class="cfct-elm-block elm-width-100">
							<label for="'.$this->get_field_id('height').'" class="lbl-text">'.__('Carousel Height', 'carrington-build').'</label>
							<input type="text" name="'.$this->get_field_name('height').'" id="'.$this->get_field_id('height').'" value="'.$carousel_height.'" class="elm-text"/>
							<span class="elm-help">pixels <em>(leave blank to set height based on tallest image)</em></span>
						</div>
						<div class="cfct-elm-block mar-bottom-double">
							<label class="lbl-select" for="'.$this->get_field_id('nav_pos').'">'.__('Navigation position', 'carrington-build').'</label>
							<select id="'.$this->get_field_id('nav_pos').'" name="'.$this->get_field_name('nav_pos').'" class="elm-select">';
			foreach ($this->nav_positions as $nav_pos_name => $nav_pos_title) {
				$html .= '
								<option value="'.$nav_pos_name.'"'.selected($nav_pos_name, $nav_pos, false).'>'.$nav_pos_title.'</option>';
			}		
			$html .= '
							</select>
						</div>
						<div class="cfct-elm-block">
							<label  class="lbl-select" for="'.$this->get_field_id('transition').'">'.__('Transition', 'carrington-build').'</label>
							<select id="'.$this->get_field_id('transition').'" name="'.$this->get_field_name('transition').'" class="elm-select">';
			foreach ($this->transitions as $transition_name => $transition_title) {
				$html .= '
								<option value="'.$transition_name.'"'.selected($transition_name, $data[$this->get_field_name('transition')], false).'>'.$transition_title.'</option>';
			}

			$html .= '
							</select>
						</div>
						<div class="cfct-elm-block elm-width-100">
							<label class="lbl-text" for="'.$this->get_field_name('transition_duration').'">'.__('Transition duration', 'carrington-build').'</label>
							<input type="text" name="'.$this->get_field_name('transition_duration').'" id="'.$this->get_field_id('transition_duration').'" value="'.intval($transition_duration).'" class="elm-text" /> 
							<span class="elm-help">'.__('milliseconds', 'carrington-build').'</span>
						</div>
						<div class="cfct-elm-block elm-width-100">
							<label class="lbl-text" for="'.$this->get_field_name('auto_scroll').'">'.__('Auto-scroll every', 'carrington-build').'</label>
							<input type="text" name="'.$this->get_field_name('auto_scroll').'" id="'.$this->get_field_id('auto_scroll').'" value="'.intval($auto_scroll).'" class="elm-text" /> 
							<span class="elm-help">'.__('milliseconds <i>(set to 0 to turn off auto-scroll)</i>', 'carrington-build').'</span>
						</div>
					</div>
				</div>';

				$data = $this->migrate_data($data);
				$html .= '<div id="'.$this->id_base.'-admin-form-wrapper">'.
					$this->admin_form_post_types($data).
					$this->admin_form_taxonomy_filter($data).
			//		$this->admin_form_display_options($data).
				'</div>';




			return $html;
		}
# Admin Ajax
		
		/**
		 * Type ahead search for tag like term completion
		 *
		 * @return string
		 */
		public function taxonomy_filter_autocomplete() {
			$search = strip_tags(stripslashes($_GET['q']));
			$tax = strip_tags(stripslashes($_GET['tax']));

			$items = array();
			if (!empty($search)) {
				$terms = get_terms($tax, array(
					'search' => $search
				));
				if (is_array($terms)) {
					foreach ($terms as $term) {
						$items[] = $term->name;
					}
				}
			}

			header('content-type: text/plain');
			if (!empty($items)) {
				echo implode("\n", $items);
			}
			else {
				echo __('No Matching Taxonomies', 'carrington-build');
			}
			exit;
		}
		
		/**
		 * Return a taxonomy filter section for the admin-ui
		 *
		 * @param array $args 
		 * @return object cfct_message
		 */
		public function get_new_taxonomy_block($args) {
			$success = $html = false;
			
			$taxonomy = get_taxonomy(esc_attr($args['taxonomy']));
			if (!empty($taxonomy) || !is_wp_error($taxonomy)) {
				$success = true;
				$html = $this->get_taxonomy_filter_item($taxonomy, array());
			}
			return $this->ajax_response($success, $html, 'get-new-taxonomy-block');
		}



		public function update($new_data,$old_data) {
			// Set default for item count
			$count =  $new_data[$this->gfi('item_count')];
			if (empty($count) && $count !== '0') {
				$new_data[$this->gfi('item_count')] = 10;
			}

			// Using wordpress constructs can give us a stand-alone post_category
			// input. Shoehorn it in to our own data structure for consistency
			if (!empty($new_data['post_category'])) {
				$new_data['tax_input']['category'] = $new_data['post_category'];
				unset($new_data['post_category']);
			}
			
			// Namespace the saved data & convert non-hierarchical term strings in to arrays
			if (!empty($new_data['tax_input'])) {
				foreach ($new_data['tax_input'] as $taxonomy => $tax_input) {
					if (!is_array($tax_input)) {
						$tax_input = array_filter(array_map('trim', explode(',', $tax_input)));
						foreach ($tax_input as &$tax_input_item) {
							$term = get_term_by('name', $tax_input_item, $taxonomy); {
								if (!empty($term) && !is_wp_error($term)) {
									$tax_input_item = $term->term_id;
								}
							}
						}
					}
					$new_data[$this->gfn('tax_input')][$taxonomy] = $tax_input;
				}
				unset($new_data['tax_input']);
			}
			
			return $new_data;
		}
		
		
		public function admin_text($data) {
			return strip_tags($data[$this->get_field_name('title')]);
		}


		/* Due to bad theme settings, this function does nothing */
		public function css() {
			$css = "
				/**
				 * Featured Widget
				 */
				
				#block-gunsandammo_blocks-front_page_featured_widget {
				  width: 420px; height: 365px; position:relative; margin-left:20px;float:left;overflow:hidden;
				}
				.featured-item-pane {
				  position: relative; height:275px;width: 100%;
				}
				.ui-tabs-hide {
				display: none;
				}
				.featured-item-image {
				  position:absolute;
				  z-index:2;
				  top:0;
				  left:0;
				  padding:0;margin:0;
				  overflow:hidden;
				}
				.featured-item-description {
				  position: absolute;
				  z-index:3;
				  width:100%;
				  left:0;bottom:0;
				  padding:0px;margin:0; background-color: black;
				  background: url(../images/black80.png);
				}n
				.featured-item-description h2 {
				  margin:0;color:white;  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
				  font-size: 30px;opacity:1;padding:20px;
				  font-weight: bold;letter-spacing: -1px;line-height:30px;
				}
				.featured-item-description h2 a {color:white;}
				#featured-articles-navigator {list-style:none;margin:0;padding:0;display:block;
				  height: 90px; position:absolute; bottom: 0;
				}
				#featured-articles-navigator li.first {margin-left:0;} 
				
				#featured-articles-navigator li {list-style:none; padding-top: 8px;margin-top:4px;float:left;
				display:block; width: 100px;height:79px; margin-left:6px;
				}
				#featured-articles-navigator li.ui-tabs-selected {
				  background-image: url(/sites/all/themes/gunsandammo/images/tab-selected-arrow-up.png);
				  background-position: center top;
				  background-repeat: no-repeat;
				  } 
				#featured-articles-navigator li a {background-color: #231F20; display:block;height: 71px;width:96px;border:2px solid #231F20;}
				.featured-articles .tab-content { cursor: pointer; }
				";
			
			
			
			return $css;
		}
		
		public function admin_css() {
			return preg_replace('/^(\t){4}/m', '', '
				.featured-thumbs-sortable-placeholder {
					height: 18px;
					background-color: gray;
					border: 1px solid white;
					border-width: 1px 0
				}
				
				/* Carousel List */
				.featured-thumbs-list {
					background-color: #eee;
					border: 1px solid #aaa;
					-moz-border-radius: 5px; /* FF1+ */
					-webkit-border-radius: 5px; /* Saf3+, Chrome */
					border-radius: 5px; /* Standard. IE9 */
					padding: 0;
					margin: 0;
				}
				.featured-thumbs-list li {
					border-bottom: 1px solid #aaa;
					list-style-type: none;
					margin: 0;
					min-height: 45px;
					padding: 5px;
				}
				.featured-thumbs-list li:hover {
					background: #fff url('.$this->get_url().'img/featured-thumbs-drag.gif) 100% 50% no-repeat;
					cursor: move;
				}
				.featured-thumbs-list li.featured-thumbs-item-edit:hover {
					background: none;
				}
				.featured-thumbs-list li:first-child {
					-moz-border-radius-topleft: 4px; /* FF1+ */
					-webkit-border-top-left-radius: 4px; /* Saf3+, Chrome */
					border-top-left-radius: 4px; /* Standard. IE9 */
					-moz-border-radius-topright: 4px; /* FF1+ */
					-webkit-border-top-right-radius: 4px; /* Saf3+, Chrome */
					border-top-right-radius: 4px; /* Standard. IE9 */
				}
				.featured-thumbs-list li:last-child {
					border-bottom: 0;
					-moz-border-radius-bottomleft: 4px; /* FF1+ */
					-webkit-border-bottom-left-radius: 4px; /* Saf3+, Chrome */
					border-bottom-left-radius: 4px; /* Standard. IE9 */
					-moz-border-radius-bottomright: 4px; /* FF1+ */
					-webkit-border-bottom-right-radius: 4px; /* Saf3+, Chrome */
					border-bottom-right-radius: 4px; /* Standard. IE9 */
				}
				/* clearfix */
				.featured-thumbs-list li:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }

				/* Floating */
				.featured-thumbs-item-img,
				.featured-thumbs-item-title,
				.featured-thumbs-edit-form {
					float: left;
				}

				/* Setting heights */
				.featured-thumbs-item-img,
				.featured-thumbs-item-title {
					height: 45px;
				}
				.featured-thumbs-item-img {
					background: #D2CFCF url('.$this->get_url().'img/featured-thumbs-none-icon.png) center center no-repeat;
					display: inline-block;
					margin-right: 10px;
					width: 150px;
				}
				.featured-thumbs-item-title {
					font-size: 15px;
					line-height: 42px;
				}

				/* Show/hide elements for editing */
				.featured-thumbs-item-edit .featured-thumbs-item-title {
					display: none;
				}
				.featured-thumbs-item-edit .featured-thumbs-item-img {
					height: 150px;
					background-position: 0px 0px !important;
				}
				.featured-thumbs-edit-form {
					display: none;
				}
				.featured-thumbs-item-edit .featured-thumbs-edit-form {
					display: block;
				}

				/* Edit mode */
				.featured-thumbs-edit-form {
					padding: 5px 0;
					width: 475px;
				}
				.featured-thumbs-edit-form label {
					display: none;
				}
				.featured-thumbs-edit-form input.text,
				.featured-thumbs-edit-form textarea {
					width: 90%;	
				}
				.featured-thumbs-edit-form input.text {
					font-size: 13px;
					margin-bottom: 8px;
				}
				.featured-thumbs-edit-form textarea {
					font-size: 11px;
					height: 80px;
				}
				.featured-thumbs-edit-done {
					margin-top: 7px;
				}
				.featured-thumbs-edit-remove {
					line-height: 1px;
					margin: 0 0 0 10px;
				}			
				
				/* Carousel Live Search */
				#car-items {
					min-height: 400px;
				}
				.cfct-popup-content #car-item-search {
					margin-bottom: 10px;
					position: relative;
				}
				.cfct-popup-content #car-item-search label {
					float: left;
					font-size: 13px;
					font-weight: bold;
					line-height: 23px;
					width: 165px;
				}
				.cfct-popup-content #car-item-search .elm-align-bottom {
					padding-left: 165px;
				}
				.cfct-module-form .cfct-popup-content #car-item-search #car-search-term {
					/**
					 * @workaround absolute positioning fix
					 * IE doesn\'t position absolute elements beneath inline-block els
					 * instead, it overlays them on top of elements.
					 * Basically, this caused the type-ahead search to sit on top
					 * of the input. A simple display: block fixes it.
					 * @affected ie7
					 */
					display: block;
					margin: 0;
					width: 500px; 
				}
				.cfct-popup-content #car-item-search .otypeahead-target {
					background: white;
					border: 1px solid #ccc;
					-moz-border-radius-bottomleft: 5px; /* FF1+ */
					-moz-border-radius-bottomright: 5px; /* FF1+ */
					-webkit-border-bottom-left-radius: 5px; /* Saf3+, Chrome */
					-webkit-border-bottom-right-radius: 5px; /* Saf3+, Chrome */
					border-bottom-left-radius: 5px; /* Standard. IE9 */
					border-bottom-right-radius: 5px; /* Standard. IE9 */
					border-width: 0 1px 1px 1px;
					display: none;
					left: 0;
					margin-top: 0;
					margin-left: 165px;
					padding: 0;
					position: absolute;
					width: 498px;
					z-index: 99;
				}
				.cfct-popup-content #car-item-search .otypeahead-target ul,
				.cfct-popup-content #car-item-search .otypeahead-target li,
				.cfct-popup-content #car-item-search .otypeahead-target li a {
					margin: 0;
					padding: 0;
				}
				.cfct-popup-content #car-item-search .otypeahead-target li a {
					color: #454545;
					text-decoration: none;
					display: block;
					/*width: 738px;*/
					padding: 5px;
				}
				.cfct-popup-content #car-item-search .otypeahead-target li a:hover,
				.cfct-popup-content #car-item-search .otypeahead-target li.otypeahead-current a {
					color: #333;
					background-color: #eee;
				}
				.cfct-popup-content #car-item-search .otypeahead-target li .featured-thumbs-item-title,
				.cfct-popup-content #car-item-search .otypeahead-target li.no-items-found {
					float: none;
					font-size: 12px;
					height: 15px;
					line-height: 15px;
				}
				.cfct-popup-content #car-item-search .otypeahead-target li:last-child a {
					-moz-border-radius-bottomleft: 5px; /* FF1+ */
					-moz-border-radius-bottomright: 5px; /* FF1+ */
					-webkit-border-bottom-left-radius: 5px; /* Saf3+, Chrome */
					-webkit-border-bottom-right-radius: 5px; /* Saf3+, Chrome */
					border-bottom-left-radius: 5px; /* Standard. IE9 */
					border-bottom-right-radius: 5px; /* Standard. IE9 */
				}
				.cfct-popup-content #car-item-search .otypeahead-target li.no-items-found,
				.cfct-popup-content #car-item-search .otypeahead-target li .otypeahead-loading {
					padding: 5px;
				}
				.cfct-popup-content #car-item-search .otypeahead-target .cfct-module-featured-thumbs-mod-loading {
					padding: 5px;
					font-size: .9em;
					color: gray;
					-moz-border-radius-bottomleft: 5px; /* FF1+ */
					-moz-border-radius-bottomright: 5px; /* FF1+ */
					-webkit-border-bottom-left-radius: 5px; /* Saf3+, Chrome */
					-webkit-border-bottom-right-radius: 5px; /* Saf3+, Chrome */
					border-bottom-left-radius: 5px; /* Standard. IE9 */
					border-bottom-right-radius: 5px; /* Standard. IE9 */
				}
				.cfct-popup-content #car-item-search .otypeahead-target li .featured-thumbs-item-img {
					display: none;
				}
			'). preg_replace('/(\t){4}/m', '', '
				#'.$this->id_base.'-admin-form-wrapper li .warning-text {
					border: 1px solid #822c27;
					background-color: #990000;
					-moz-border-radius: 3px;
					-webkit-border-radius: 3px;
					-khtml-border-radius: 3px;
					border-radius: 3px;
					display: none;
					margin-bottom: 5px;
					padding: 6px;
				}
				#'.$this->id_base.'-admin-form-wrapper li .warning-text p {
					color: #fff;
					font-size: 11px;
					line-height: 15px;
					margin: 0;
				}
				#'.$this->id_base.'-admin-form-wrapper li.post-type-taxonomy-warning {
					background-color: #fcf2f2;
					color: #666;
				}
				#'.$this->id_base.'-admin-form-wrapper li.post-type-taxonomy-warning .cfct-input-full,
				#'.$this->id_base.'-admin-form-wrapper li.post-type-taxonomy-warning input[type=text] {
					background: #eee;
				}
				
				#'.$this->id_base.'-admin-form-wrapper li.post-type-taxonomy-warning .warning-text {
					display: block;
				}
				#'.$this->id_base.'-admin-form-wrapper .cfct-repeater-item input[type=text] {
					width: 616px
				}
				.'.$this->gfi('advanced-filter-options-toggle').' {
					font-size: .9em;
				}
			');
		}
		
		/**
		 * Admin JS functionality for type-ahead-search
		 *
		 * @uses o-type-ahead.js
		 * @return string
		 */
		public function admin_js() {
			$js_base = str_replace('-', '_', $this->id_base);
			$js = preg_replace('/^(\t){4}/m', '', '
			
				cfct_builder.addModuleLoadCallback("'.$this->id_base.'", function() {
					'.$this->cfct_module_tabs_js().'
					
					// set up search
					$("#car-item-search #car-search-term").oTypeAhead({
						searchParams: {
							action: "cfct_featured_thumbs_post_search",
							carousel_action: "do_search"
						},
						url:cfct_builder.opts.ajax_url,
						loading: "<div class=\"'.$this->id_base.'-loading\">'.__('Loading...', 'carrington-build').'<\/div>",
						form: ".car-item-search-container",
						disableForm: false,
						resultsCallback: function(target) {
							$(target).unbind().bind("otypeahead-select", function() {
								var _insert = $(this).find("li.otypeahead-current").clone().removeClass("otypeahead-current");
								'.$js_base.'_insert_selected_item(_insert);
							}).find("a").click(function() {
								var _insert = $(this).closest("li").clone();
								'.$js_base.'_insert_selected_item(_insert);
								return false;
							});
						}
					});
									
					// init sortabled
					$("#car-items ol").sortable({
						items: "li",
						axis: "y",
						opacity: 0.6,
						containment: "parent",
						placeholder: "featured-thumbs-sortable-placeholder"
					});
				});
			
				var '.$js_base.'_insert_selected_item = function(_insert) {
					$("#car-items ol").append(_insert).find(".no-items").hide().end().sortable("refresh");
					$("a.featured-thumbs-post-item-ident", _insert).trigger("click");
					$("body").trigger("click");
					$("#car-item-search #car-search-term").val("");
				};
			
				cfct_builder.addModuleSaveCallback("'.$this->id_base.'", function() {
					$("#car-item-search .otypeahead-target").children().remove();
				});
			
				// set up post edit
				$("#car-items li.featured-thumbs-post-item .featured-thumbs-post-item-ident, #car-items li.featured-thumbs-post-item .featured-thumbs-item-img").live("click", function() {
					$(this).closest(".featured-thumbs-post-item").addClass("featured-thumbs-item-edit");
					return false;
				});
								
				// set up post done edit
				$("#car-items li.featured-thumbs-post-item .featured-thumbs-edit-done").live("click", function() {
					$(this).closest(".featured-thumbs-post-item").removeClass("featured-thumbs-item-edit");
					return false;
				});
								
				// set up post remove
				$("#car-items li.featured-thumbs-post-item .featured-thumbs-edit-remove a").live("click", function() {
					if (confirm("Do you really want to remove this item?")) {
						$(this).closest(".featured-thumbs-post-item").remove();
						_parent = $("#car-items ol");
						if (_parent.children().length == 1) {
							$(".no-items", _parent).show();
						}
					}
					return false;
				});



				');

			$js2 = preg_replace('/^(\t){4}/m', '', '
				cfct_builder.addModuleLoadCallback("'.$this->id_base.'", function(form) {
					
					
					'.$this->js_base.'_get_selected_post_type_taxonomies = function() {
						var taxonomies = null;
						// merge available taxonomies from the chosen post types
						$(":input.post-type-select:checked, input[type=hidden].post-type-select").each(function() {
							var _taxes = $(this).attr("data-taxonomies").split(",");
							if (taxonomies == null) {
								taxonomies = _taxes;
							}
							else {
								taxonomies = cfct_array_intersect(taxonomies, _taxes);
							}
						})
						return taxonomies;
					}
					
					// do post-type selection change				
					$("#'.$this->gfi('post_type_checks').' :input.post-type-select", form).change(function() {
						'.$this->js_base.'_filter_taxonomy_select();
					});
					
					// add another taxonomy block
					$("#'.$this->id_base.'-add-tax-button").click(function() {
						var _this = $(this);
						var tax = $("#'.$this->id_base.'-taxonomy-select", form).val();
						if ( tax != "none") {
							 '.$this->js_base.'_set_loading();
							cfct_builder.fetch(
								"'.$this->id_base.'-get-new-taxonomy-block", 
								{
									taxonomy: tax,
									post_types: $("#'.$this->id_base.'-post_type", form).val()
								},
								null,
								null,
								'.$this->js_base.'_insert_taxonomy_block
							);
						}
						return false;
					});
					
					'.$this->js_base.'_filter_taxonomy_select = function() {
						var taxonomies = '.$this->js_base.'_get_selected_post_type_taxonomies();
						var tax_names = eval("(" + $("#'.$this->gfi('tax_defs').'").val() + ")");
						var _tgt = $("#'.$this->id_base.'-taxonomy-select", form);
						var options = "";
												
						// create options for the taxonomoy select list
						if (taxonomies != null && taxonomies.length > 0) {
							options = "<option value=\"none\">'.__($this->default_tax_select_text, 'carrington-build').'</option>";							
							for (i = 0; i < taxonomies.length; i++) {
								options += "<option value=\"" + taxonomies[i] + "\">" + tax_names[taxonomies[i]] + "</option>";
							}
						}
						else {
							options = "<option value=\"none\">'.__('no matching taxonomies available', 'carrington-build').'</option>";
						}
						
						// assign new options to the taxonomy select list
						_tgt.html(options);
						'.$this->js_base.'_prep_taxonomy_filter_list();
					}
					
					// generic repeater element remove button
					$(".cfct-module-admin-repeater-block .cfct-repeater-item .cfct-repeater-item-remove").live("click", function() {
						var _list = $(this).closest("ol");
						$(this).closest("li").remove();
						if (_list.find("li.cfct-repeater-item").size() == 1) {
							_list.addClass("no-items");
						}
						'.$this->js_base.'_filter_taxonomy_select();
						return false;
					});
								
					// taxonomy filter selection callback
					'.$this->js_base.'_insert_taxonomy_block = function(ret) {
						if (ret.success) {
							var _list = $("#'.$this->id_base.'-tax-filter-items ol", form);
							var _html = $(ret.html);		
							_list.prepend(_html);
							
							// columnize
							_html.find("ul.categorychecklist").columnizeLists({ cols: 3 });
							
							// set no-items status
							if (_list.find("li.cfct-repeater-item").size() > 1) {
								_list.removeClass("no-items");
							}
							'.$this->js_base.'_unset_loading();
							'.$this->js_base.'_prep_taxonomy_filter_list();
						}
						else {
							// @TODO handle error
						}
					};
					
					// reset and prune the taxonomy filter list
					'.$this->js_base.'_prep_taxonomy_filter_list = function() {
						// prune the taxonomy filter list of taxonomies that are already being displayed
						$("#'.$this->id_base.'-taxonomy-select", form)
							.val("")
							.find("option")
							.each(function() {
								var _this = $(this);
								if (_this.attr("data-taxonomy") == "") {
									return;
								}
								
								if ( $("#'.$this->id_base.'-tax-filter-items li[data-taxonomy=" + _this.val() + "]").size() > 0 ) {
									_this.remove();
								}
							});
							
						var taxonomies = '.$this->js_base.'_get_selected_post_type_taxonomies();
						$("#'.$this->id_base.'-tax-filter-items ol li.cfct-repeater-item").not(".no-items-item").each(function() {
							var _this = $(this);
							var warning_class = "post-type-taxonomy-warning";

							if ($.inArray(_this.attr("data-taxonomy"), taxonomies) > -1) {
								_this.removeClass(warning_class).find(":input").attr("disabled", false); // apparently more consistent than removeAttr()
								'.$this->js_base.'_bind_suggest(this);
							}
							else {
								_this.addClass(warning_class).find(":input").attr("disabled", "disabled");
								'.$this->js_base.'_unbind_suggest(this);
							}
						});
					};
					
					'.$this->js_base.'_set_loading = function() {
						$("#'.$this->gfi('tax-select-inputs').' span.'.$this->gfi('loading').'").show();
					};
					
					'.$this->js_base.'_unset_loading = function() {
						$("#'.$this->gfi('tax-select-inputs').' span.'.$this->gfi('loading').'").hide();
					};					
					
					'.$this->js_base.'_bind_suggest = function(item) {
						var _parent = $(item);
						var e = _parent.find(".'.$this->id_base.'-tax-filter-type-ahead-search").unbind();

						// unattach any other suggests for this box
						$(".ac_results").remove();

						// hook our new suggest on there
						e.suggest(
							cfct_builder.opts.ajax_url + "?action=cf_taxonomy_filter_autocomplete&tax=" + encodeURI(_parent.attr("data-taxonomy")),
							{
								delay: 500, 
								minchars: 2, 
								multiple: true,
								onSelect: function() {
									$(this).attr("value", $(this).val());
								}
							}
						);
						$(".ac_results").css({"z-index": "10005"});
					};
					
					'.$this->js_base.'_unbind_suggest = function(item) {
						$(item).find(".'.$this->id_base.'-tax-filter-type-ahead-search").unbind().end().find(".ac_results").remove();
					}
					
					// Show/Hide for Pagination
					$("#'.$this->get_field_id('show_pagination').'", form).change(function() {
						var _wrapper = $("#pagination-wrapper");
						if ($(this).is(":checked")) {
							_wrapper.show();
						}
						else {
							_wrapper.hide();
						}
					}).trigger("change");
					
					// columnize
					$("ul.categorychecklist", form).columnizeLists({ cols: 4 });
					
					// togglr
					$(".toggle", form).click(function() {
						var _tgt = $($(this).attr("href"));
						if (_tgt.is(":visible")) {
							$(this).find("span").text("'.__('Show', 'carrington-build').'");
							_tgt.hide();
						}
						else {
							$(this).find("span").text("'.__('Hide', 'carrington-build').'");
							_tgt.show();
						}
						return false;
					});
					
					// do initial taxonomy select filtering
					'.$this->js_base.'_filter_taxonomy_select();
					'.$this->js_base.'_prep_taxonomy_filter_list();	
					$(".cfct-columnized-4x ul", form).columnizeLists({ cols: 4 });
					
				});
				
				cfct_builder.addModuleSaveCallback("'.$this->id_base.'",function(form) {
					// disable taxonomy filter dropdown so that it does not submit
					$("#'.$this->gfi('taxonomy-select').'").attr("disabled", "disabled");
				});');
			return $js . ' ' . $js2;
		}
		
		public function js() {
			return '
				/**
				 * Tab Callbacks
				 */
				
				// $(document).ready(function() {
				//	$(".featured-articles ul#featured-articles-navigator").tabs();
				//      });
				
				//$(function() {
				//	
				//	$(".featured-articles ul#featured-articles-navigator").tabs();
				//	$("#loadcover").fadeOut("slow");
				//	$(".featured-articles ul#featured-articles-navigator").tabs("rotate", 4250);
				//	     
				//	$(".featured-articles .tab-content").each(function(i, o){
				//	    $(o).click(function(){
				//	      window.location=$("h2 > a",this).attr("href");  
				//	    });
				//	});
				//});
			';
		}



		/**
		 * Pagination selection items
		 *
		 * @param array $data - module save data
		 * @return string HTML
		 */
		protected function get_pagination_section($data) {
			$checkbox_value = (!empty($data[$this->get_field_name('show_pagination')])) ? $data[$this->get_field_name('show_pagination')] : '';
			$url_value = (!empty($data[$this->get_field_name('next_pagination_link')])) ? $data[$this->get_field_name('next_pagination_link')] : '';
			$text_value = (!empty($data[$this->get_field_name('next_pagination_text')])) ? $data[$this->get_field_name('next_pagination_text')] : '';
			
			$html = '
				<div class="cfct-inline-els">
					<label for="'.$this->get_field_id('show_pagination').'">'.__('Pagination Link', 'carrington-build').'</label>
					<input type="checkbox" name="'.$this->get_field_name('show_pagination').'" id="'.$this->get_field_name('show_pagination').'" value="yes"'.checked('yes', $checkbox_value, false).' />
				</div>
				<div id="pagination-wrapper">
					<div class="cfct-inline-els">
						<label for="'.$this->get_field_id('next_pagination_link').'">'.__('Link URL', 'carrington-build').'</label>
						<input type="text" name="'.$this->get_field_name('next_pagination_link').'" id="'.$this->get_field_id('next_pagination_link').'" value="'.$url_value.'" />
					</div>
					<div class="cfct-inline-els">
						<label for="'.$this->get_field_id('next_pagination_text').'">'.__('Link Text', 'carrington-build').'</label>
						<input type="text" name="'.$this->get_field_name('next_pagination_text').'" id="'.$this->get_field_id('next_pagination_text').'" value="'.$text_value.'" />
					</div>
				</div>';
				
			return $html;
		}



		/**
		 * Show module output display options
		 *
		 * @param array $data - saved module data
		 * @return string HTML
		 */
		public function admin_form_display_options($data) {
			return '
				<fieldset class="cfct-form-section">
					<legend>'.__('Display', 'carrington-build').'</legend>
					<div class="'.$this->id_base.'-display-group-left">
						<!-- display type -->
						<div class="cfct-inline-els">
							'.$this->get_display_type($data).'
						</div>
						<!-- / display type -->

						<!-- num posts input -->
						'.$this->get_item_count_input($data).'
						<!-- / num posts input -->

						<!-- num posts input -->
						'.$this->get_item_count_offset_input($data).'
						<!-- / num posts input -->
					</div>
					<!-- pagination -->
					<div class="'.$this->id_base.'-display-group-right">
						'.$this->get_pagination_section($data).'
					</div>
					<!-- /pagination -->
				</fieldset>';
		}
		
		protected function get_item_count_input($data) {
			return '
				<div class="cfct-inline-els">
					<label for="'.$this->get_field_id('item_count').'">'.__('Number of Items:', 'carrington-build').'</label>
					<input class="cfct-number-field" id="'.$this->get_field_id('item_count').'" name="'.$this->get_field_name('item_count').'" type="text" value="'.esc_attr($this->get_data('item_count', $data, $this->default_item_count)).'" />
				</div>';
		}
		
		protected function get_item_count_offset_input($data) {
			return '
				<div class="cfct-inline-els">
					<label for="'.$this->get_field_id('item_offset').'">'.__('Start at Item:', 'carrington-build').'</label>
					<input class="cfct-number-field" id="'.$this->get_field_id('item_offset').'" name="'.$this->get_field_name('item_offset').'" type="text" value="'.esc_attr($this->get_data('item_offset', $data, $this->default_item_offset)).'" />
				</div>';
		}

# Admin helpers

		/**
		 * Get the display type select list
		 *
		 * @param array $data
		 * @return string HTML
		 */
		protected function get_display_type($data) {
			$value = $this->get_data('display_type', $data, $this->default_content_display);
			if(empty($this->content_display_options[$value])) {
				$value = $this->default_content_display;
			}

			if(count($this->content_display_options) > 1) {
				$args = array(
					'label' => __('Show', 'carrington-build'),
					'default' => (!empty($data[$this->get_field_name('display_type')]) ? $data[$this->get_field_name('display_type')] : null)
				);
				return $this->dropdown('display_type', $this->content_display_options, $value, $args);
			}
			else {
				// i.e., subclass only allows one content display type
				return '
					<input type="hidden" name="'.$this->get_field_name('display_type').'" id="'.$this->get_field_id('display_type').'" value="'.$value.'"/>';
			}
		}
		
		protected function get_taxonomy_filter_items($data) {
			$html = '';
			
			if (!empty($data[$this->gfn('tax_input')])) {
				foreach ($data[$this->gfn('tax_input')] as $taxonomy => $tax_input) {
					$html .= $this->get_taxonomy_filter_item($taxonomy, $tax_input);
				}
			}
			
			$html .= '
				<li class="cfct-repeater-item no-items-item">
					<p>'.__('There are currently no taxonomy filters.', 'carrington-build').'</p>
				</li>';
			return $html;
		}
		
		protected function get_taxonomy_filter_item($taxonomy, $tax_input) {
			if (!is_object($taxonomy)) {
				$taxonomy = get_taxonomy($taxonomy);
			}
			
			$html = '
				<li id="'.$this->id_base.'-tax-section-'.$taxonomy->name.'" class="'.$this->id_base.'-tax-section cfct-repeater-item" data-taxonomy="'.$taxonomy->name.'">';
			
			// Heirarchichal taxonomy checkbox interface
			if ($taxonomy->hierarchical) {
				$html .= '
						<h2 class="cfct-title">'.$taxonomy->label.':  </h2>';
				$html .= $this->get_taxonomy_selector(array(
					'taxonomy' => $taxonomy,
					'selected_cats' => (!empty($tax_input) ? $tax_input : array()),
					'post_id' => $this->get_post_id()
				));
			}
			// Tag type-ahead search input
			else {
				if (!empty($tax_input)) {
					foreach ($tax_input as &$term) {
						$_term = get_term($term, $taxonomy->name);
						$term = $_term->name;
					}
				}
				$html .= '
						<label class="cfct-title" for="'.$this->gfi('tax-filter-'.$taxonomy->name).'">' . $taxonomy->label . '</label>

						<div class="cfct-tax-filter-type-ahead-wrapper">
							<span class="cfct-input-full">
								<input class="'.$this->id_base.'-tax-filter-type-ahead-search" name="tax_input['.$taxonomy->name.']" id="'.$this->gfi('tax-input-'.$taxonomy->name).'" type="text" value="'.(!empty($tax_input) ? implode(', ', $tax_input) : '').'" />
							</span>
							<div class="cfct-help">'.__('Start typing to search for a term. Separate terms with commas. If a term is misspelled (ie: does not exist) it will be discarded during save.', 'carrington-build').'</div>
						</div>';
			}
			$html .= '
					<div class="warning-text">
						<p>'.__('This taxonomy is incompatible with the current post-type selection and will be discarded upon save. Change the post-type selection to keep this filter.', 'carrington-build').'</p>
					</div>
					<a href="#" class="cfct-repeater-item-remove">remove</a>
				</li>';
			
			return $html;
		}
	
		/**
		 * Show module title input
		 *
		 * @param array $data - saved module data
		 * @return string HTML
		 */
		public function admin_form_title($data) {
			return '
				<fieldset class="cfct-form-section">
					<!-- title -->
					<legend>'.__('Title', 'carrington-build').'</legend>
					<span class="cfct-input-full">
						<input type="text" name="'.$this->get_field_id('title').'" id="'.$this->get_field_id('title').'" value="'.esc_attr(isset($data[$this->get_field_name('title')]) ? $data[$this->get_field_name('title')] : '').'" />
					</span>
					<!-- /title -->
				</fieldset>';
		}

		/**
		 * Show module post types filter
		 * If only 1 post type is available the method ouputs a hidden
		 * element instead of a select list
		 *
		 * @param array $data - saved module data
		 * @return string HTML
		 */
		public function admin_form_post_types($data) {
			$post_types = $this->get_post_types(null);
			$selected = (!empty($data[$this->gfn('post_type')]) ? $data[$this->gfn('post_type')] : array());

			$_taxes = apply_filters(self::TAXONOMY_TYPES_FILTER, get_object_taxonomies(array_keys($post_types), 'objects'), $this);
		
			foreach ($_taxes as $taxonomy) {
				if ($taxonomy->name == 'post_format') {
					// its like a cockroach...
					continue;
				}
				$tax_defs[$taxonomy->name] = $taxonomy->label;
			}
			
			$html = '
			<fieldset class="cfct-form-section" id="'.$this->gfi('post_type_checks').'">
				<legend>Post Type</legend>';
			if (count($post_types) > 1) {
				$html .= '
					<div class="cfct-columnized cfct-columnized-4x clearfix">
						<ul>';
					foreach ($post_types as $key => $post_type) {
						$post_taxonomies = $this->get_post_type_taxonomies($key);
						$html .= '
							<li>
								<input type="checkbox" name="'.$this->gfn('post_type').'[]" id="'.$this->gfi('post-type-'.$key).'" ';
						if (is_array($selected) && in_array($key, $selected)) {
							$html .= 'checked="checked" ';
						}		
						$html .= 'class="post-type-select" data-taxonomies="'.implode(',', $post_taxonomies).'" value="'.$key.'" />
								<label for="'.$this->gfi('post-type-'.$key).'">'.$post_type->labels->name.'</label>
							</li>';
					}	
					$html .= '
						</ul>
					</div>';
			}
			elseif (count($post_types) == 1) {
				// if we only have one option then just set a hidden element
				$key = key($post_types);
				$post_type = current($post_types);
				$post_taxonomies = $this->get_post_type_taxonomies($key);
				$html .= '
					<input type="hidden" class="post-type-select" name="'.$this->get_field_name('post_type').'[]" value="'.$key.'" data-taxonomies="'.implode(',', $post_taxonomies).'" />';
			}
			elseif (empty($post_types)) {
				$type = get_post_type($this->default_post_type);
				$post_taxonomies = $this->get_post_type_taxonomies($type->name);
				$html .= '
					<input type="hidden" class="post-type-select" name="'.$this->gfn('post_type').'[]" value="'.$post_type->name.'" data-taxonomies="'.implode(',', $post_taxonomies).'" />';
			}
			
			$html .= '					
					<input type="hidden" name="'.$this->gfn('tax_defs').'" id="'.$this->gfi('tax_defs').'" disabled="disabled" value=\''.json_encode($tax_defs).'\' />
				</fieldset>';
				
			return $html;
		}
		
		protected function get_post_type_taxonomies($post_type) {
			$taxonomies = get_object_taxonomies($post_type);
			foreach($taxonomies as $i => $t) {
				if ($t == 'post_format') {
					// cockroach!
					unset($taxonomies[$i]);
				}
			}
			return $taxonomies;
		}

		/**
		 * Show module taxonomy filter options
		 *
		 * @param array $data - saved module data
		 * @return string HTML
		 */
		public function admin_form_taxonomy_filter($data) {
			$html = '';
			
			$post_type = ($data[$this->get_field_name('post_type')]) ? $data[$this->get_field_name('post_type')] : $this->default_post_type;
			$_taxes = apply_filters(self::TAXONOMY_TYPES_FILTER, get_object_taxonomies($post_type, 'objects'), $this);
			
			$tax_defs = array();
			foreach ($_taxes as $tax_type => $taxonomy) {
				if ($tax_type == 'post_format') { 
					continue;
				}
				if (!is_array($post_type)) {
					$post_type = array($post_type);
				}
				$matches = array_intersect($post_type, $taxonomy->object_type);
				if (count($matches) == count($post_type)) {
					$taxes[$tax_type] = $taxonomy;
				}
			}
			unset($_taxes);

			$html = '
				<fieldset class="cfct-form-section">
					<script type="text/javascript">
						// you will not see this in the DOM, it gets parsed right away at ajax load
						var tax_defs = '.json_encode($tax_defs).';
					</script>
					<legend>'.__('Taxonomies', 'carrington-build').'</legend>
					<!-- taxonomy select -->
					<div class="'.$this->id_base.'-input-wrapper '.$this->id_base.'-post-category-select '.$this->id_base.'-tax-wrapper">
						<div id="'.$this->gfi('tax-select-inputs').'" class="cfct-inline-els">
							'.$this->get_taxonomy_dropdown($taxes, $data).'
							<button id="'.$this->id_base.'-add-tax-button" class="button" type="button">'.__('Add Filter', 'carrington-build').'</button>
							<span class="'.$this->id_base.'-loading cfct-spinner" style="display: none;">Loading&hellip;</span>
						</div>
						<div id="'.$this->id_base.'-tax-filter-items" class="cfct-module-admin-repeater-block">
							<ol class="'.(empty($data[$this->gfn('tax_input')]) ? ' no-items' : '').'">';
			$html .= $this->get_taxonomy_filter_items($data);
			$html .= '
							</ol>
						</div>
					</div>
					'.$this->get_filter_advanced_options($data).'
					<!-- /taxonomy select -->
				</fieldset>
				<fieldset class="cfct-form-section">
					<legend>'.__('Author', 'carrington-build').'</legend>
					<!-- author select -->
					<div class="cfct-inline-els">
						'.$this->get_author_dropdown($data).'
					</div>
					<!-- /author select -->
				</fieldset>';
			return $html;
		}
		
		protected function get_filter_advanced_options($data) {
			$html = '
				<div id="'.$this->gfi('filter-advanced-options').'">
					<p><a class="toggle '.$this->gfi('advanced-filter-options-toggle').'" id="advanced-filter-options-toggle" href="#'.$this->gfi('filter-advanced-options-container').'">'.
						sprintf(__('%sShow%s Advanced Options', 'carrington-build'), '<span>', '</span>').'</a></p>
					<div id="'.$this->gfi('filter-advanced-options-container').'" style="display: none;">
						'.$this->get_filter_relation_select($data).'
					</div>
				</div>';
			return $html;
		}
		
		/**
		 * Taxonomy query relation
		 * 
		 * By default all queries are done with an AND operator, meaning that all taxonomies
		 * selected must be part of the result. Change this to 'OR' and then all results must
		 * match at least 1 of the selected taxonomies instead of all of them
		 *
		 * @param array $data 
		 * @return void
		 */
		protected function get_filter_relation_select($data) {
			$relations = apply_filters($this->id_base.'-relation-options', array(
				'AND' => __('And - all taxonomies must be matched', 'carrington-build'),
				'OR' => __('Or - any taxonomy can be matched', 'carrington-build')
			));
			
			$selected = $this->get_data('relation', $data, $this->default_relation);
			
			$html = '
				<div class="cfct-inline-els">
					<label for="'.$this->gfi('relation').'">'.__('Filter Relation', 'carrington-build').'</label>
					<select name="'.$this->gfn('relation').'" id="'.$this->gfi('relation').'">';
			foreach ($relations as $key => $relation) {
				$html .= '
						<option value="'.$key.'"'.selected($key, $selected, false).'>'.$relation.'</option>';
			}
			$html .= '
					</select>
				</div>';
			return $html;
		}



		/**
		 * Generates a simple dropdown
		 *
		 * @param string $field_name
		 * @param array $options
		 * @param int/string $value The current value of this field
		 * @param array $args Miscellaneous arguments
		 * @return string of <select> element's HTML
		 **/
		protected function dropdown($field_name, $options, $value = false, $args = '') {
			$defaults = array(
				'label' => '', // The text for the label element
				'default' => null, // Add a default option ('all', 'none', etc.)
				'excludes' => array(), // values to exclude from options
				'class_name' => null, // name to use in the class; defaults to $field_name
				'multi' => false // use a multi-select instead of a single select
			);
			$args = array_merge($defaults, $args);
			extract($args);

			$options = (is_array($options)) ? $options : array();


			// Set a label if there is one
			$html = (!empty($label)) ? '<label for="'.$this->gfi($field_name).'">'.$label.': </label>' : '';

			if(empty($class_name)) {
				$class_name = $field_name;
			}
			// Start off the select element
			$html .= '
				<select class="'.$class_name.'-dropdown" name="'.$this->gfn($field_name).($multi ? '[]' : '').'" id="'.$this->gfi($field_name).'"'.($multi ? ' multiple="multiple"' : '').'>';

			// Set a default option that's not in the list of options (i.e., all, none)
			if (is_array($default)) {
				$html .= '<option value="'.$default['value'].'"'.selected($default['value'], $value, false).'>'.esc_html($default['text']).'</option>';
			}

			// Loop through our options
			foreach ($options as $k => $v) {
				if (!in_array($k, $excludes)) {
					$selected = '';
					if (is_array($value) && in_array($k, $value)) {
						// the selected() helper doesn't recognize arrays as potential values
						$selected = ' selected="selected"';
					}
					elseif (!empty($value)) {
						$selected = selected($k, $value, false);
					}
					$html .= '<option value="'.$k.'"'.$selected.'>'.esc_html($v).'</option>';
				}
			}

			// Close off our select element
			$html .= '
				</select>';
			return $html;
		}

		/**
		 * Returns a dropdown for available taxonomies
		 *
		 * @param array $items array of taxonomy objects
		 * @return string
		 */
		protected function get_taxonomy_dropdown($items, $data) {
			// Prepare our options
			$options = array();
			if (!empty($items)) {
				foreach ($items as $k => $v) {
					if (in_array($k, array('link_category', 'nav_menu'))) {
						continue;
					}
					$options[$k] = $v->labels->name;
				}
			}
			
			//print_r($data);
			$index = ""; // TODO: What is $index supposed to be here?  Setting it blank.
			$field_name = $this->get_field_name('taxonomy-'.$index);
			$value = (isset($data[$field_name])) ? $data[$field_name] : 0;
			
			$html = $this->dropdown(
				'taxonomy-select',
				$options,
				$value,
				array(
					'default' => array(
						'value' => '',
						'text' => __($this->default_tax_select_text, 'carrington-build'),
					),
					'class_name' => 'taxonomy'
				)
			);
		
			return $html;
		}
		
		/**
		 * Formats the data for admin editing 
		 *
		 * @param $postdata - pro-processed post information
		 * @return string HTML
		 */
		protected function get_featured_thumbs_admin_item($postdata) {
			$img = array();
			$img_id = get_post_meta($postdata['id'], '_thumbnail_id', true);
			if (!empty($img_id)) {
				$imgdata = wp_get_attachment_image_src($img_id, 'thumbnail', false);
				$img_style = ' style="background: url('.$imgdata[0].') 0 -52px"';
			}
			else {
				$img_style = null;
			}
						
			$html = '
				<li class="featured-thumbs-post-item">
					<div class="featured-thumbs-item-img"'.$img_style.'></div>
					<a class="featured-thumbs-post-item-ident featured-thumbs-item-title" href="#featured-thumbs-post-'.intval($postdata['id']).'">'.esc_html($postdata['title']).'</a>
					<div class="featured-thumbs-edit-form">
						<input type="hidden" name="'.$this->get_field_name('posts').'['.$postdata['id'].'][id]" value="'.intval($postdata['id']).'" />
						<label>Title</label>
						<input type="text" class="text" name="'.$this->get_field_name('posts').'['.$postdata['id'].'][title]" value="'.esc_attr($postdata['title']).'" />
						<label>Description</label>
						<textarea name="'.$this->get_field_name('posts').'['.$postdata['id'].'][content]">'.esc_textarea($postdata['content']).'</textarea>
						<input type="button" name="done" class="button featured-thumbs-edit-done" value="Done" />
						<span class="featured-thumbs-edit-remove trash"><a href="#remove" class="lnk-remove">remove</a></span>
					</div>
				</li>
				';			
			return $html;
		}
		
// Search Request
		
		public function _handle_featured_thumbs_request() {
			if (!empty($_POST['carousel_action'])) {
				switch($_POST['carousel_action']) {
					case 'do_search':
						$this->_featured_thumbs_do_search();
						break;
				}
				exit;
			}
		}
		

		/**
		 * Get a list of post types available for selection
		 * Automatically excludes attachments, revisions, and nav_menu_items
		 * Post Type must be public to appear in this list
		 *
		 * @param string $type - 'post' for non-heirarchal objects, 'page' or heirarchal objects
		 * @return array
		 */
		protected function get_post_types($type) {
			$type_opts = array(
				'publicly_queryable' => 1
			);
			if (!empty($type)) {
				if(is_array($type)) {
					$hierarchical = true;
					if((count($type) == 1) && ($type[0] == 'post')) {
						$hierarchical = false;
					}
				}
				else {
					$hierarchical = ($type == 'post' ? false : true);
				}
				$type_opts['hierarchical'] = $hierarchical;
			}
			$post_types = get_post_types($type_opts, 'objects');
			ksort($post_types);
			
			// be safe, filter out the undesirables
			foreach (array('attachment', 'revision', 'nav_menu_item') as $item) {
				if (!empty($post_types[$item])) {
					unset($post_types[$item]);
				}
			}
			
			return apply_filters(self::POST_TYPES_FILTER, $post_types, $this);
		}


		protected function _featured_thumbs_do_search() {
			// ONLY PULLS POSTS THAT HAVE A FEATURED IMAGE
			$s = new WP_Query(array(
				's' => $_POST['car-search-term'],
				'post_type' => apply_filters('cfct-featured-thumbs-search-in', array_filter(get_post_types(array('public' => 1)), array($this, 'filter_post_types'))),
				'posts_per_page' => 8,
				'meta_key' => '_thumbnail_id'
			));
			
			$ret = array(
				'html' => '',
				'key' => $_POST['key']
			);
			if ($s->have_posts()) {
				$html = '<ul>';
				while ($s->have_posts()) {
					$s->the_post();
					remove_filter('the_content', 'wptexturize');
					$postdata = array(
						'id' => get_the_id(),
						'title' => get_the_title(),
						'link' => get_permalink(),
						'content' => get_the_excerpt()
					);
					add_filter('the_content', 'wptexturize');
					$html .= $this->get_featured_thumbs_admin_item($postdata);
				}
				$html .= '</ul>';
				$ret['html'] = $html;
			}
			else {
				$ret['html'] = '<ul><li class="no-items-found">No items found for search: "'.esc_html($_POST['car-search-term']).'"</li></ul>';
			}
						
			header('content-type: application/javascript');
			echo json_encode($ret);
			exit;
		}
		
		protected function filter_post_types($var) {
			return !in_array($var, array('attachment', 'revision', 'nav_menu_item'));
		}
		
// Content Move Helpers
		
		public function get_referenced_ids($data) {
			$references = array();			
			if (!empty($data[$this->gfn('posts')])) {
				$references['posts'] = array();
				foreach ($data[$this->gfn('posts')] as $post_id => $post_info) {
					$post = get_post($post_id);
					$references['posts'][$post_id] = array(
						'type' => 'post_type',
						'type_name' => $post->post_type,
						'value' => $post_info['id']
					);
				}
			}

			return $references;
		}
		
		public function merge_referenced_ids($data, $reference_data) {
			if (!empty($reference_data['posts']) && !empty($data)) {
				foreach ($reference_data['posts'] as $key => $r_data) {
					// Data here is stored with the post_id in the data as well as being the array key,
					// so we need to nuke the old value with the old post_id key and replace it with 
					// the new post_id as the key and the updated post_info
					$_post_info = $data[$this->gfn('posts')][$key];
					unset($data[$this->gfn('posts')][$key]);
					$_post_info['id'] = $r_data['value'];
					$data[$this->gfn('posts')][$r_data['value']] = $_post_info;
				}
			}

			return $data;
		}
	}
	cfct_build_register_module('cfct_module_featured_thumbs_mod');
	  
}
?>