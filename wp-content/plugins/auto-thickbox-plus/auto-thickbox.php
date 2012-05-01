<?php
/*
Plugin Name: Auto ThickBox Plus
Plugin URI: http://attosoft.info/blog/en/auto-thickbox-plus/
Description: Overlays linked image, inline, iFrame and AJAX content on the page in simple & fast effects. (improved version of Auto Thickbox plugin)
Version: 1.0
Author: attosoft
Author URI: http://attosoft.info/en/
License: GPL 2.0
Text Domain: auto-thickbox
Domain Path: /languages
*/

/*  Copyright 2010-2012 attosoft (contact@attosoft.info)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* This plugin is mainly based on Auto Thickbox plugin by Denis de Bernardy.
   http://www.semiologic.com/software/auto-thickbox/
*/

define('AUTO_THICKBOX_PLUS', 'Auto ThickBox Plus');
define('AUTO_THICKBOX_PLUS_VERSION', '1.0');

/**
 * auto_thickbox
 *
 * @package Auto Thickbox
 **/

class auto_thickbox {
	/**
	 * filter()
	 *
	 * @param array $anchor
	 * @return anchor $anchor
	 **/

	function filter($anchor) {
		if ( preg_match("/\.(?:jpe?g|gif|png|bmp|webp)\b/i", $anchor['attr']['href']) )
			return auto_thickbox::image($anchor);
		elseif ( !empty($anchor['attr']['class']) && in_array('thickbox', $anchor['attr']['class']) )
			return auto_thickbox::iframe($anchor);
		else
			return $anchor;
	} # filter()
	
	
	/**
	 * image()
	 *
	 * @param array $anchor
	 * @return anchor $anchor
	 **/

	function image($anchor) {
		if ( $this->options['thickbox_text'] == 'manual' && !preg_match("/^\s*<\s*img\s.+?>\s*$/is", $anchor['body']) )
			return $anchor;
		
		if ( !$anchor['attr']['class'] ) {
			$anchor['attr']['class'][] = 'thickbox';
			$anchor['attr']['class'][] = 'no_icon';
		} else {
			if ( !in_array('thickbox', $anchor['attr']['class']) && !in_array('nothickbox', $anchor['attr']['class']) && !in_array('no_thickbox', $anchor['attr']['class']) )
				$anchor['attr']['class'][] = 'thickbox';
			if ( !in_array('no_icon', $anchor['attr']['class']) && !in_array('noicon', $anchor['attr']['class']) )
				$anchor['attr']['class'][] = 'no_icon';
		}
		
		if ( $this->options['thickbox_style'] == 'gallery' && in_the_loop() && !$anchor['attr']['rel'] )
			$anchor['attr']['rel'][] = 'gallery-' . get_the_ID();
		
		if ( empty($anchor['attr']['title']) ) {
			if ( preg_match("/\b(?:alt|title)\s*=\s*('|\")(.*?)\\1/i", $anchor['body'], $title) ) {
				$anchor['attr']['title'] = end($title);
			}
		}
		
		return $anchor;
	} # image()
	
	
	/**
	 * iframe()
	 *
	 * @return void
	 **/
	
	function iframe($anchor) {
		if ( strpos($anchor['attr']['href'], 'TB_iframe=true') !== false || strpos($anchor['attr']['href'], '#TB_inline') !== false )
			return $anchor;
		if ( strpos($anchor['attr']['href'], '://') === false || strpos($anchor['attr']['href'], $_SERVER['HTTP_HOST']) !== false )
			return $anchor; // not append 'TB_iframe=true' to URL in the same domain (i.e. display as not iframe but AJAX content)
		
		# strip anchor ref
		$href = explode('#', $anchor['attr']['href']);
		$anchor['attr']['href'] = array_shift($href);
		
		$anchor['attr']['href'] .= ( ( strpos($anchor['attr']['href'], '?') === false ) ? '?' : '&' )
			. 'TB_iframe=true' . ( count($href) == 0 ? '' : '#' . implode('#', $href) );
		
		return $anchor;
	} # iframe()
	
	
	/**
	 * scripts()
	 *
	 * @return void
	 **/

	function scripts() {
		if ( $this->options['builtin_res'] == 'off' ) {
			wp_deregister_script('thickbox');
			wp_register_script('thickbox', plugins_url($this->thickbox_js, __FILE__), array('jquery'), AUTO_THICKBOX_PLUS_VERSION, true);
		}
		wp_enqueue_script('thickbox');
		if ( $this->options['builtin_res'] == 'off' ) {
			wp_localize_script('thickbox', 'thickboxL10n', array(
				'next' => $this->texts['next'],
				'prev' => $this->texts['prev'],
				'first' => $this->texts['first'],
				'last' => $this->texts['last'],
				'image' => $this->texts['image'],
				'of' => $this->texts['of'],
				'close' => $this->texts['close'],
				'noiframes' => __('This feature requires inline frames. You have iframes disabled or your browser does not support them.'),
				'loadingAnimation' => $this->options['img_load'] != 'none' ? $this->options['img_load'] : $this->options_def['img_load'],
				'closeImage' => $this->options['img_close_btn'] != 'none' ? $this->options['img_close_btn'] : $this->options_def['img_close_btn']
			));
		}
	} # scripts()
	
	
	/**
	 * styles()
	 *
	 * @return void
	 **/

	function styles() {
		if ( $this->options['builtin_res'] == 'off' ) {
			wp_deregister_style('thickbox');
			wp_register_style('thickbox', plugins_url($this->thickbox_css, __FILE__), false, AUTO_THICKBOX_PLUS_VERSION);
		}
		wp_enqueue_style('thickbox');
	} # styles()
	
	
	/**
	 * thickbox_images()
	 *
	 * @return void
	 **/

	function thickbox_images() {
		$script = '';

		if ( !$this->is_default_options('auto_resize') )
			$script .= "tb_options.auto_resize = " . var_export($this->options['auto_resize'] == 'on', true) . ";\n";
		if ( !$this->is_default_options('effect_open') )
			$script .= "tb_options.effect_open = '{$this->options['effect_open']}';\n";
		if ( !$this->is_default_options('effect_close') )
			$script .= "tb_options.effect_close = '{$this->options['effect_close']}';\n";
		if ( !$this->is_default_options('effect_trans') )
			$script .= "tb_options.effect_trans = '{$this->options['effect_trans']}';\n";
		if ( !$this->is_default_options('effect_speed') ) {
			$quot = is_numeric($this->options['effect_speed']) ? "" : "'";
			$script .= "tb_options.effect_speed = " . $quot . $this->options['effect_speed'] . $quot . ";\n";
		}
		if ( !$this->is_default_options('click_img') )
			$script .= "tb_options.click_img = '{$this->options['click_img']}';\n";
		if ( !$this->is_default_options('click_end') )
			$script .= "tb_options.click_end = '{$this->options['click_end']}';\n";
		if ( !$this->is_default_options('click_bg') )
			$script .= "tb_options.click_bg = '{$this->options['click_bg']}';\n";
		if ( !$this->is_default_options('wheel_img') )
			$script .= "tb_options.wheel_img = '{$this->options['wheel_img']}';\n";
		if ( !$this->is_default_options('drag_img_move') )
			$script .= "tb_options.move_img = " . var_export($this->options['drag_img_move'] == 'on', true) . ";\n";
		if ( !$this->is_default_options('drag_img_resize') )
			$script .= "tb_options.resize_img = " . var_export($this->options['drag_img_resize'] == 'on', true) . ";\n";
		if ( !$this->is_default_options('drag_content_move') )
			$script .= "tb_options.move_content = " . var_export($this->options['drag_content_move'] == 'on', true) . ";\n";
		if ( !$this->is_default_options('drag_content_resize') )
			$script .= "tb_options.resize_content = " . var_export($this->options['drag_content_resize'] == 'on', true) . ";\n";
		$keys_close = array();
		if ( $this->options['key_close_esc'] == 'on' ) $keys_close[] = 27;
		if ( $this->options['key_close_enter'] == 'on' ) $keys_close[] = 13;
		if ( !$this->is_default_options(array('key_close_esc', 'key_close_enter')) )
			$script .= "tb_options.keys_close = [" . implode(', ', $keys_close) . "];\n";
		$keys_prev = $keys_prev_shift = array();
		if ( $this->options['key_prev_angle'] == 'on' ) $keys_prev[] = 188;
		if ( $this->options['key_prev_left'] == 'on' ) $keys_prev[] = 37;
		if ( $this->options['key_prev_tab'] == 'on' ) $keys_prev_shift[] = 9;
		if ( $this->options['key_prev_space'] == 'on' ) $keys_prev_shift[] = 32;
		if ( $this->options['key_prev_bs'] == 'on' ) $keys_prev[] = 8;
		if ( !$this->is_default_options(array('key_prev_angle', 'key_prev_left', 'key_prev_tab', 'key_prev_space', 'key_prev_bs')) ) {
			$script .= "tb_options.keys_prev = [" . implode(', ', $keys_prev) . "];\n";
			$script .= "tb_options.keys_prev['shift'] = [" . implode(', ', $keys_prev_shift) . "];\n";
		}
		$keys_next = array();
		if ( $this->options['key_next_angle'] == 'on' ) $keys_next[] = 190;
		if ( $this->options['key_next_right'] == 'on' ) $keys_next[] = 39;
		if ( $this->options['key_next_tab'] == 'on' ) $keys_next[] = 9;
		if ( $this->options['key_next_space'] == 'on' ) $keys_next[] = 32;
		if ( !$this->is_default_options(array('key_next_angle', 'key_next_right', 'key_next_tab', 'key_next_space')) )
			$script .= "tb_options.keys_next = [" . implode(', ', $keys_next) . "];\n";
		$keys_first = $keys_last = array();
		if ( $this->options['key_end_home_end'] == 'on' ) { $keys_first[] = 36; $keys_last[] = 35; }
		if ( !$this->is_default_options('key_end_home_end') ) {
			$script .= "tb_options.keys_first = [" . implode(', ', $keys_first) . "];\n";
			$script .= "tb_options.keys_last = [" . implode(', ', $keys_last) . "];\n";
		}

		if ($script)
			echo "<script type='text/javascript'>\n/* <![CDATA[ */\n" . $script . "/* ]]> */\n</script>\n";

		$style = '';

		if ( !$this->is_default_options('font_title') )
			$style .= "#TB_title { font-family:{$this->options['font_title']}; }\n";
		if ( !$this->is_default_options('font_cap') )
			$style .= "#TB_caption,#TB_secondLine { font-family:{$this->options['font_cap']}; }\n";
		if ( !$this->is_default_options('font_weight_title') )
			$style .= "#TB_title { font-weight:{$this->options['font_weight_title']}; }\n";
		if ( !$this->is_default_options('font_weight_cap') )
			$style .= "#TB_caption { font-weight:{$this->options['font_weight_cap']}; }\n";
		if ( !$this->is_default_options('color_title') )
			$style .= "#TB_title { color:{$this->options['color_title']}; }\n";
		if ( !$this->is_default_options('color_nav') )
			$style .= "#TB_secondLine,#TB_window a:link,#TB_window a:visited { color:{$this->options['color_nav']}; }\n";
		if ( !$this->is_default_options('color_cap') )
			$style .= "#TB_caption,#TB_window a:hover { color:{$this->options['color_cap']}; }\n"; // :hover must be placed after :link and :visited
		if ( !$this->is_default_options('bgcolor_title') )
			$style .= "#TB_title { background-color:{$this->options['bgcolor_title']}; }\n";
		if ( !$this->is_default_options('bgcolor_cap') )
			$style .= "#TB_caption { background-color:{$this->options['bgcolor_cap']}; margin:4px 0 0 15px; padding-top:5px; height:23px; -moz-border-radius:4px; -webkit-border-radius:4px; -khtml-border-radius:4px; border-radius:4px; }\n";
		if ( !$this->is_default_options('bgcolor_win') )
			$style .= "#TB_window { background-color:{$this->options['bgcolor_win']}; }\n";
		if ( !$this->is_default_options('bgcolor_bg') )
			$style .= ".TB_overlayBG { background-color:{$this->options['bgcolor_bg']}; }\n";
		if ( !$this->is_default_options('border_win') )
			$style .= "#TB_window { border:{$this->options['border_win']}; }\n";
		if ( !$this->is_default_options('border_img_tl') )
			$style .= "#TB_window img#TB_Image { border-top:{$this->options['border_img_tl']}; border-left:{$this->options['border_img_tl']}; }\n";
		if ( !$this->is_default_options('border_img_br') )
			$style .= "#TB_window img#TB_Image { border-bottom:{$this->options['border_img_br']}; border-right:{$this->options['border_img_br']}; }\n";
		if ( !$this->is_default_options('radius_win') )
			$style .= "#TB_window { -moz-border-radius:{$this->options['radius_win']}px; -webkit-border-radius:{$this->options['radius_win']}px; -khtml-border-radius:{$this->options['radius_win']}px; border-radius:{$this->options['radius_win']}px; }\n";
		if ( !$this->is_default_options('opacity_bg') ) {
			$opacity_bg100 = $this->options['opacity_bg'] * 100;
			$style .= ".TB_overlayBG { -ms-filter:\"progid:DXImageTransform.Microsoft.Alpha(Opacity={$opacity_bg100})\"; filter:alpha(opacity={$opacity_bg100}); -moz-opacity:{$this->options['opacity_bg']}; opacity:{$this->options['opacity_bg']}; }\n";
		}
		if ( !$this->is_default_options('box_shadow_win') )
			$style .= "#TB_window { -moz-box-shadow:{$this->options['box_shadow_win']}; -webkit-box-shadow:{$this->options['box_shadow_win']}; -khtml-box-shadow:{$this->options['box_shadow_win']}; box-shadow:{$this->options['box_shadow_win']}; }\n";
		if ( !$this->is_default_options('txt_shadow_title') )
			$style .= "#TB_title { text-shadow:{$this->options['txt_shadow_title']}; }\n";
		if ( !$this->is_default_options('txt_shadow_cap') )
			$style .= "#TB_caption { text-shadow:{$this->options['txt_shadow_cap']}; }\n";

		if ( $this->options['img_prev'] == 'none' )
			$style .= "#TB_ImageClick a#TB_ImagePrev:hover { background-image: none; }\n";
		else if ( !$this->is_default_options('img_prev') )
			$style .= "#TB_ImageClick a#TB_ImagePrev:hover { background-image: url({$this->options['img_prev']}); }\n";
		if ( $this->options['img_next'] == 'none' )
			$style .= "#TB_ImageClick a#TB_ImageNext:hover { background-image: none; }\n";
		else if ( !$this->is_default_options('img_next') )
			$style .= "#TB_ImageClick a#TB_ImageNext:hover { background-image: url({$this->options['img_next']}); }\n";
		if ( $this->options['img_first'] == 'none' )
			$style .= "#TB_ImageClick a#TB_ImageFirst:hover { background-image: none; }\n";
		else if ( !$this->is_default_options('img_first') )
			$style .= "#TB_ImageClick a#TB_ImageFirst:hover { background-image: url({$this->options['img_first']}); }\n";
		if ( $this->options['img_last'] == 'none' )
			$style .= "#TB_ImageClick a#TB_ImageLast:hover { background-image: none; }\n";
		else if ( !$this->is_default_options('img_last') )
			$style .= "#TB_ImageClick a#TB_ImageLast:hover { background-image: url({$this->options['img_last']}); }\n";
		if ( $this->options['img_close'] == 'none' )
			$style .= "#TB_ImageClick a#TB_ImageClose:hover { background-image: none; }\n";
		else if ( !$this->is_default_options('img_close') )
			$style .= "#TB_ImageClick a#TB_ImageClose:hover { background-image: url({$this->options['img_close']}); }\n";
		if ( $this->options['img_close_btn'] == 'none' )
			$style .= "#TB_closeWindow { display: none; }\n";
		if ( $this->options['img_load'] == 'none' )
			$style .= "#TB_load { display: none !important; }\n";
		else if ( !$this->is_default_options('img_load') ) {
			$filename = $this->options['img_load'];
			if (strpos($filename, '/') === 0)
				$filename = (isset($_SERVER["HTTPS"]) ? "https" : "http") . "://" . $_SERVER["SERVER_NAME"] . $filename;
			list($width, $height) = getimagesize($filename);
			$margin_top = $height / 2; $margin_left = $width / 2;
			$style .= "#TB_load { background-color:transparent; border:none; padding:0; margin: -{$margin_top}px 0 0 -{$margin_left}px; }\n";
		}

		if ($style)
			echo "<style type='text/css'>\n" . $style . "</style>\n";
	} # thickbox_images()

	function is_default_options($names) {
		if (!is_array($names))
			return $this->options[$names] == $this->options_def[$names];

		foreach ($names as $name) {
			if ($this->options[$name] != $this->options_def[$name])
				return false;
		}
		return true;
	}

	function add_auto_thickbox_action_links($links, $file) {
		if ( $file == plugin_basename(__FILE__) )
			$links[] = '<a href="' . get_bloginfo('url') . '/wp-admin/options-general.php?page=' . $this->base_dir .'">' . __('Settings') . '</a>';
		return $links;
	}

	// Additional links on the Plugins page
	function add_auto_thickbox_links($links, $file) {
		if ( $file == plugin_basename(__FILE__) ) {
			$links[] = '<a href="http://wordpress.org/extend/plugins/auto-thickbox-plus/" target="_blank">' . __('Show Details') . '</a>';
			$links[] = '<a href="http://wordpress.org/tags/auto-thickbox-plus" target="_blank">' . __('Support', 'auto-thickbox') . '</a>';
			$links[] = '<a href="' . __('http://attosoft.info/blog/en/', 'auto-thickbox') . 'contact/" target="_blank">' . __('Contact Me', 'auto-thickbox') . '</a>';
			$links[] = '<a href="' . __('http://attosoft.info/blog/en/', 'auto-thickbox') . 'donate/" target="_blank">' . __('Donate', 'auto-thickbox') . '</a>';
		}
		return $links;
	}

	var $base_dir;
	var $thickbox_js, $thickbox_css;
	var $options, $options_def;
	var $is_en_locale;
	var $texts;

	function auto_thickbox() {
		$this->__construct(); // for PHP4
	}

	function __construct() {
		$this->base_dir = basename(dirname(__FILE__));
		load_plugin_textdomain('auto-thickbox', false, $this->base_dir . '/languages');

		$this->thickbox_js = WP_DEBUG ? 'thickbox.js' :'thickbox.min.js';
		$this->thickbox_css = WP_DEBUG ? 'thickbox.css' : 'thickbox.min.css';

if ( !is_admin() && isset($_SERVER['HTTP_USER_AGENT']) &&
    	strpos($_SERVER['HTTP_USER_AGENT'], 'W3C_Validator') === false) {
	if ( !class_exists('anchor_utils') )
		include dirname(__FILE__) . '/anchor-utils/anchor-utils.php';
		
	add_action('wp_print_scripts', array(&$this, 'scripts'));
	add_action('wp_print_styles', array(&$this, 'styles'));
	
	add_action('wp_footer', array(&$this, 'thickbox_images'), 20);
	
	add_filter('filter_anchor', array(&$this, 'filter'));
}

if ( is_admin() ) {
	if (include_once dirname(__FILE__) . '/auto-thickbox-options.php')
		$atb_options = new auto_thickbox_options();
	add_filter('plugin_action_links', array(&$this, 'add_auto_thickbox_action_links'), 10, 2);
	add_filter('plugin_row_meta', array(&$this, 'add_auto_thickbox_links'), 10, 2);
}

		$this->options_def = array(
			'thickbox_style' => 'single',
			'thickbox_text' => 'auto',
			'auto_resize' => 'on',
			'builtin_res' => 'off',
			'effect_open' => 'none',
			'effect_close' => 'fade',
			'effect_trans' => 'none',
			'effect_speed' => 'fast',
			'click_img' => 'close',
			'click_end' => 'loop',
			'click_bg' => 'close',
			'wheel_img' => 'prev_next',
			'drag_img_move' => 'off',
			'drag_img_resize' => 'off',
			'drag_content_move' => 'off',
			'drag_content_resize' => 'off',
			'key_close_esc' => 'on',
			'key_close_enter' => 'on',
			'key_prev_angle' => 'on',
			'key_prev_left' => 'on',
			'key_prev_tab' => 'off',
			'key_prev_space' => 'off',
			'key_prev_bs' => 'off',
			'key_next_angle' => 'on',
			'key_next_right' => 'on',
			'key_next_tab' => 'off',
			'key_next_space' => 'off',
			'key_end_home_end' => 'on',
			'font_title' => '"Lucida Grande", Verdana, Arial, sans-serif',
			'font_cap' => '"Lucida Grande", Verdana, Arial, sans-serif',
			'font_weight_title' => 'normal',
			'font_weight_cap' => 'normal',
			'color_title' => 'black',
			'color_cap' => 'black',
			'color_nav' => '#666',
			'bgcolor_title' => '#e8e8e8',
			'bgcolor_cap' => 'transparent',
			'bgcolor_win' => 'white',
			'bgcolor_bg' => 'black',
			'border_win' => '1px solid #555',
			'border_img_tl' => '1px solid #666',
			'border_img_br' => '1px solid #ccc',
			'radius_win' => '0',
			'opacity_bg' => '0.75',
			'box_shadow_win' => 'rgba(0,0,0,1) 0 4px 30px',
			'txt_shadow_title' => 'none',
			'txt_shadow_cap' => 'none',
			'img_prev' => plugins_url('images/tb-prev.png', __FILE__),
			'img_next' => plugins_url('images/tb-next.png', __FILE__),
			'img_first' => plugins_url('images/tb-first.png', __FILE__),
			'img_last' => plugins_url('images/tb-last.png', __FILE__),
			'img_close' => plugins_url('images/tb-close.png', __FILE__),
			'img_close_btn' => plugins_url('images/tb-close.png', __FILE__),
			'img_load' => plugins_url('images/loadingAnimation.gif', __FILE__)
		);
		$this->options = get_option('auto-thickbox-plus');
		$this->options = $this->options ? wp_parse_args($this->options, $this->options_def) : $this->options_def;

		// XXX: transition code for v0.5 or earlier
		$thickbox_style = get_option('thickbox_style');
		if ($thickbox_style) {
			$this->options['thickbox_style'] = $thickbox_style;
			delete_option('thickbox_style');
		}
		$thickbox_text = get_option('thickbox_text');
		if ($thickbox_text) {
			$this->options['thickbox_text'] = $thickbox_text;
			delete_option('thickbox_text');
		}
		$thickbox_res = get_option('thickbox_res');
		if ($thickbox_res) {
			$this->options['thickbox_res'] = $thickbox_res;
			delete_option('thickbox_res');
		}

		// XXX: transition code for v0.6
		if (isset($this->options['thickbox_res'])) {
			$this->options['builtin_res'] = $this->options['thickbox_res'] == 'unload' ? 'on' : 'off';
			unset($this->options['thickbox_res']);
			update_option('auto-thickbox-plus', $this->options);
		}

		$this->is_en_locale = strpos(get_locale(), 'en') !== false;
		$this->texts['next'] = $this->gettext('Next &gt;', array('Next &raquo;'));
		$this->texts['next2'] = trim(str_replace(array('&gt;', '&raquo;'), '', $this->texts['next']));
		$this->texts['prev'] = $this->gettext('&lt; Prev', array('&laquo; Previous'));
		$this->texts['prev2'] = trim(str_replace(array('&lt;', '&laquo;'), '', $this->texts['prev']));
		$this->texts['image'] = $this->gettext('Image', array('Images', 'File', 'Files'));
		$this->texts['of'] = $this->gettext('of');
		if (trim($this->texts['of']) == '' || ($this->texts['of'] == 'of' && !$this->is_en_locale))
			$this->texts['of'] = '/';
		$this->texts['close'] = $this->gettext('Close', array('close'));
		$this->texts['options'] = $this->gettext('Options:', array('Options', 'Settings'));
		$this->texts['options'] = AUTO_THICKBOX_PLUS . ' - ' . str_replace(array(':', '：'), '', $this->texts['options']);
		$this->texts['action'] = $this->gettext('Action', array('Actions'));
		$this->texts['load'] = $this->gettext('Loading&#8230;', array('Loading...'));

		$this->texts['first2'] = ucfirst($this->gettext('first'));
		$this->texts['first'] = '&laquo; ' . $this->texts['first2'];
		$this->texts['last2'] = ucfirst($this->gettext('last'));
		$this->texts['last'] = $this->texts['last2'] . ' &raquo;';

		if (isset($atb_options))
			$atb_options->init_variables($this);
	}

	/*
	 * search for translation in 'auto-thickbox' amd default (WordPress)
	 * 
	 * @param string $message msgid key
	 * @param array $alt_messages alternative msgid key
	 */
	function gettext($message, $alt_messages = array()) {
		$text = __($message, 'auto-thickbox');
		if ($text == $message) {
			$text = __($message);
			if ($text == $message && !$this->is_en_locale && $alt_messages) {
				foreach ($alt_messages as $alt_message) {
					$alt_text = __($alt_message);
					if ($alt_text != $alt_message)
						return $alt_text;
				}
			}
		}
		return $text;
	}

} # auto_thickbox

add_action('init', 'init_auto_thickbox');
function init_auto_thickbox() {
	new auto_thickbox();
}
?>