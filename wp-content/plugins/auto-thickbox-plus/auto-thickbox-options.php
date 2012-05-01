<?php
/*
 * Auto ThickBox Plus Options
 * Copyright (C) 2010-2012 attosoft <http://attosoft.info/en/>
 * This file is distributed under the same license as the Auto ThickBox Plus package.
 * attosoft <contact@attosoft.info>, 2010.
 */

class auto_thickbox_options {

	// Auto ThickBox Plus Options
	function register_options_page() {
		wp_enqueue_script( 'postbox' );
		wp_enqueue_script( 'farbtastic' );
		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_script( 'jquery-ui-slider' );
		add_options_page($this->texts['options'], AUTO_THICKBOX_PLUS, 'manage_options', $this->base_dir, array(&$this, 'options_page'));
		add_meta_box( 'general-box', __('General'), array(&$this, 'general_metabox'), 'auto-thickbox-options', 'normal' );
		add_meta_box( 'action-box', $this->texts['action'], array(&$this, 'action_metabox'), 'auto-thickbox-options', 'normal' );
		add_meta_box( 'view-box', __('View'), array(&$this, 'view_metabox'), 'auto-thickbox-options', 'normal' );
		add_meta_box( 'image-box', $this->texts['image'], array(&$this, 'image_metabox'), 'auto-thickbox-options', 'normal' );
		add_meta_box( 'effect-box', __('Effect', 'auto-thickbox') . ' (' . __('beta', 'auto-thickbox') . ')', array(&$this, 'effect_metabox'), 'auto-thickbox-options', 'normal' );
	}

	function options_page() {
		wp_enqueue_script('auto-thickbox', plugins_url('auto-thickbox.js', __FILE__), array(), AUTO_THICKBOX_PLUS_VERSION, true);
		wp_enqueue_style('auto-thickbox', plugins_url('auto-thickbox.css', __FILE__), array(), AUTO_THICKBOX_PLUS_VERSION);
?>
<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php echo $this->texts['options']; ?></h2>
	<form method="post" action="options.php" name="form">
	<?php settings_fields( 'auto-thickbox-plus-options' ); ?>
		<div id="poststuff" class="metabox-holder">
		<?php
				wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );
				wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
				do_meta_boxes( 'auto-thickbox-options', 'normal', null );
		?>
		</div>
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			<input type="submit" class="button-primary" value="<?php _e('Reset') ?>" name="reset" />
		</p>
	</form>
</div>
<?php
	}

	function general_metabox() {
?>
<table class="form-table">
	<tr>
		<th scope="row"><?php _e('Default Display Style', 'auto-thickbox'); ?></th>
		<td>
			<label><input type="radio" name="auto-thickbox-plus[thickbox_style]" value="single"<?php checked($this->options['thickbox_style'], 'single'); ?> />
			<?php _e('Single Image (explicitly specify a@rel attribute as needed)', 'auto-thickbox'); ?></label><br />
			<label><input type="radio" name="auto-thickbox-plus[thickbox_style]" value="gallery"<?php checked($this->options['thickbox_style'], 'gallery'); ?> />
			<?php _e('Gallery Images (automatically set a@rel attribute in \'gallery-id\' format)', 'auto-thickbox'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php _e('ThickBox on Text Links', 'auto-thickbox'); ?></th>
		<td>
			<label><input type="radio" name="auto-thickbox-plus[thickbox_text]" value="auto"<?php checked($this->options['thickbox_text'], 'auto'); ?> />
			<?php _e('Auto (automatically set a@class=&quot;thickbox&quot;)', 'auto-thickbox'); ?></label><br />
			<label><input type="radio" name="auto-thickbox-plus[thickbox_text]" value="manual"<?php checked($this->options['thickbox_text'], 'manual'); ?> />
			<?php _e('Manual (explicitly specify a@class=&quot;thickbox&quot; as needed)', 'auto-thickbox'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php _e('Auto Resize', 'auto-thickbox'); ?></th>
		<td>
			<label><input type="checkbox" name="auto-thickbox-plus[auto_resize]"<?php checked($this->options['auto_resize'], 'on'); ?> />
			<?php _e('Enabled'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php _e('ThickBox Resources', 'auto-thickbox'); ?></th>
		<td>
			<label><input type="checkbox" name="auto-thickbox-plus[builtin_res]"<?php checked($this->options['builtin_res'], 'on'); ?> />
			<?php _e('Use WordPress built-in thickbox.js/css (some extra features will be disabled)', 'auto-thickbox'); ?></label>
		</td>
	</tr>
</table>
<?php
	}

	function action_metabox() {
		$click_end_disabled = in_array($this->options['click_img'], array('close', 'none'));
?>
<table class="form-table">
	<tr>
		<th scope="row"><?php _e('Mouse Click', 'auto-thickbox'); ?></th>
		<th scope="row"><?php echo $this->texts['image']; ?></th>
		<td>
			<label class="item"><input type="radio" name="auto-thickbox-plus[click_img]" value="close"<?php checked($this->options['click_img'], 'close'); ?> onclick="disableClickEnd()" />
			<?php echo $this->texts['close']; ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[click_img]" value="none"<?php checked($this->options['click_img'], 'none'); ?> onclick="disableClickEnd()" />
			<?php _e('None'); ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[click_img]" value="next"<?php checked($this->options['click_img'], 'next'); ?> onclick="disableClickEnd(false)" />
			<?php echo $this->texts['next2']; ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[click_img]" value="prev_next"<?php checked($this->options['click_img'], 'prev_next'); ?> onclick="disableClickEnd(false)" />
			<?php echo $this->texts['prev2']; ?> / <?php echo $this->texts['next2']; ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php echo $this->texts['image']; ?> (<?php echo $this->texts['first2']; ?> / <?php echo $this->texts['last2']; ?>)</th>
		<td>
			<label class="item"><input type="radio" name="auto-thickbox-plus[click_end]" value="close"<?php checked($this->options['click_end'], 'close'); disabled($click_end_disabled); ?> />
			<?php echo $this->texts['close']; ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[click_end]" value="none"<?php checked($this->options['click_end'], 'none'); disabled($click_end_disabled); ?> />
			<?php _e('None'); ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[click_end]" value="loop"<?php checked($this->options['click_end'], 'loop'); disabled($click_end_disabled); ?> />
			<?php _e('Loop', 'auto-thickbox'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php _e('Background'); ?></th>
		<td>
			<label class="item"><input type="radio" name="auto-thickbox-plus[click_bg]" value="close"<?php checked($this->options['click_bg'], 'close'); ?> />
			<?php echo $this->texts['close']; ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[click_bg]" value="none"<?php checked($this->options['click_bg'], 'none'); ?> />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php _e('Mouse Wheel', 'auto-thickbox'); ?> (<?php _e('Scroll'); ?>)</th>
		<th scope="row"><?php echo $this->texts['image']; ?></th>
		<td>
			<label class="item"><input type="radio" name="auto-thickbox-plus[wheel_img]" value="prev_next"<?php checked($this->options['wheel_img'], 'prev_next'); ?> />
			<?php echo $this->texts['prev2']; ?> / <?php echo $this->texts['next2']; ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[wheel_img]" value="none"<?php checked($this->options['wheel_img'], 'none'); ?> />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php _e('Drag &amp; Drop', 'auto-thickbox'); ?></th>
		<th scope="row"><?php _e('Window', 'auto-thickbox'); ?> (<?php echo $this->texts['image']; ?>)</th>
		<td>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[drag_img_move]"<?php checked($this->options['drag_img_move'], 'on'); ?> />
			<?php _e('Move', 'auto-thickbox'); ?></label>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[drag_img_resize]"<?php checked($this->options['drag_img_resize'], 'on'); ?> />
			<?php _e('Resize', 'auto-thickbox'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php _e('Window', 'auto-thickbox'); ?> (<?php _e('Content'); ?>)</th>
		<td>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[drag_content_move]"<?php checked($this->options['drag_content_move'], 'on'); ?> />
			<?php _e('Move', 'auto-thickbox'); ?></label>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[drag_content_resize]"<?php checked($this->options['drag_content_resize'], 'on'); ?> />
			<?php _e('Resize', 'auto-thickbox'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php _e('Keyboard Shortcuts'); ?></th>
		<th scope="row"><?php echo $this->texts['close']; ?></th>
		<td>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[key_close_esc]"<?php checked($this->options['key_close_esc'], 'on'); ?> />
				Esc</label>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[key_close_enter]"<?php checked($this->options['key_close_enter'], 'on'); ?> />
				Enter</label>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php echo $this->texts['prev2']; ?></th>
		<td>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[key_prev_angle]"<?php checked($this->options['key_prev_angle'], 'on'); ?> />
				< ( , )</label>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[key_prev_left]"<?php checked($this->options['key_prev_left'], 'on'); ?> />
			<?php _e('Left'); ?></label>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[key_prev_tab]"<?php checked($this->options['key_prev_tab'], 'on'); ?> />
				Shift + Tab</label>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[key_prev_space]"<?php checked($this->options['key_prev_space'], 'on'); ?> />
				Shift + <?php _e('Space', 'auto-thickbox'); ?></label>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[key_prev_bs]"<?php checked($this->options['key_prev_bs'], 'on'); ?> />
				BackSpace</label>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php echo $this->texts['next2']; ?></th>
		<td>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[key_next_angle]"<?php checked($this->options['key_next_angle'], 'on'); ?> />
				> ( . )</label>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[key_next_right]"<?php checked($this->options['key_next_right'], 'on'); ?> />
			<?php _e('Right'); ?></label>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[key_next_tab]"<?php checked($this->options['key_next_tab'], 'on'); ?> />
				Tab</label>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[key_next_space]"<?php checked($this->options['key_next_space'], 'on'); ?> />
			<?php _e('Space', 'auto-thickbox'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php echo $this->texts['first2']; ?> / <?php echo $this->texts['last2']; ?></th>
		<td>
			<label class="item"><input type="checkbox" name="auto-thickbox-plus[key_end_home_end]"<?php checked($this->options['key_end_home_end'], 'on'); ?> />
				Home / End</label>
		</td>
	</tr>
</table>
<?php
	}

	function view_metabox() {
		$bgcolor_title_trans = $this->options['bgcolor_title'] == 'transparent';
		$bgcolor_cap_trans = $this->options['bgcolor_cap'] == 'transparent';
		$bgcolor_win_trans = $this->options['bgcolor_win'] == 'transparent';
		$bgcolor_bg_trans = $this->options['bgcolor_bg'] == 'transparent';
		$border_win_none = $this->options['border_win'] == 'none';
		$border_img_tl_none = $this->options['border_img_tl'] == 'none';
		$border_img_br_none = $this->options['border_img_br'] == 'none';
		$box_shadow_win_none = $this->options['box_shadow_win'] == 'none';
		$txt_shadow_title_none = $this->options['txt_shadow_title'] == 'none';
		$txt_shadow_cap_none = $this->options['txt_shadow_cap'] == 'none';
?>
<table class="form-table">
	<tr>
		<th scope="row"><a href="<?php esc_attr_e('https://developer.mozilla.org/en/CSS/font-family', 'auto-thickbox'); ?>" target="_blank"><?php echo str_replace('family', 'Family', __('Font family')); ?></a></th>
		<th scope="row"><?php _e('Title'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[font_title]" value="<?php echo esc_attr($this->options['font_title']); ?>" style="width:70%" /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[font_weight_title]" value="bold"<?php checked($this->options['font_weight_title'], 'bold'); ?> />
			<?php _e('Bold'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php _e('Caption'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[font_cap]" value="<?php echo esc_attr($this->options['font_cap']); ?>" style="width:70%" /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[font_weight_cap]" value="bold"<?php checked($this->options['font_weight_cap'], 'bold'); ?> />
			<?php _e('Bold'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><a href="<?php esc_attr_e('https://developer.mozilla.org/en/CSS/color', 'auto-thickbox'); ?>" target="_blank"><?php _e('Text Color'); ?></a></th>
		<th scope="row"><?php _e('Title'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[color_title]" value="<?php echo $this->options['color_title']; ?>" /></label>
			<a href="#" class="pickcolor colorpreview hide-if-no-js"></a>&nbsp;
			<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a Color' ); ?>" />
			<div class="colorpicker"></div>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php _e('Caption'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[color_cap]" value="<?php echo $this->options['color_cap']; ?>" /></label>
			<a href="#" class="pickcolor colorpreview hide-if-no-js"></a>&nbsp;
			<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a Color' ); ?>" />
			<div class="colorpicker"></div>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php _e('Navigation'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[color_nav]" value="<?php echo $this->options['color_nav']; ?>" /></label>
			<a href="#" class="pickcolor colorpreview hide-if-no-js"></a>&nbsp;
			<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a Color' ); ?>" />
			<div class="colorpicker"></div>
		</td>
	</tr>
	<tr>
		<th scope="row"><a href="<?php esc_attr_e('https://developer.mozilla.org/en/CSS/background-color', 'auto-thickbox'); ?>" target="_blank"><?php _e('Background Color'); ?></a></th>
		<th scope="row"><?php _e('Title'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[bgcolor_title]" value="<?php echo $this->options['bgcolor_title']; ?>"<?php disabled($bgcolor_title_trans); ?> /></label>
			<a href="#" class="pickcolor colorpreview hide-if-no-js"></a>&nbsp;
			<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a Color' ); ?>" />
			<div class="colorpicker"></div>
			<label><input type="checkbox" name="auto-thickbox-plus[bgcolor_title]" value="transparent"<?php checked($bgcolor_title_trans); ?> onclick="disableOption(this)" />
			<?php _e('Transparent', 'auto-thickbox'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php _e('Caption'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[bgcolor_cap]" value="<?php echo $this->options['bgcolor_cap']; ?>"<?php disabled($bgcolor_cap_trans); ?> /></label>
			<a href="#" class="pickcolor colorpreview hide-if-no-js"></a>&nbsp;
			<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a Color' ); ?>" />
			<div class="colorpicker"></div>
			<label><input type="checkbox" name="auto-thickbox-plus[bgcolor_cap]" value="transparent"<?php checked($bgcolor_cap_trans); ?> onclick="disableOption(this)" />
			<?php _e('Transparent', 'auto-thickbox'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php _e('Window', 'auto-thickbox'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[bgcolor_win]" value="<?php echo $this->options['bgcolor_win']; ?>"<?php disabled($bgcolor_win_trans); ?> /></label>
			<a href="#" class="pickcolor colorpreview hide-if-no-js"></a>&nbsp;
			<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a Color' ); ?>" />
			<div class="colorpicker"></div>
			<label><input type="checkbox" name="auto-thickbox-plus[bgcolor_win]" value="transparent"<?php checked($bgcolor_win_trans); ?> onclick="disableOption(this)" />
			<?php _e('Transparent', 'auto-thickbox'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php _e('Background'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[bgcolor_bg]" value="<?php echo $this->options['bgcolor_bg']; ?>"<?php disabled($bgcolor_bg_trans); ?> /></label>
			<a href="#" class="pickcolor colorpreview hide-if-no-js"></a>&nbsp;
			<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a Color' ); ?>" />
			<div class="colorpicker"></div>
			<label><input type="checkbox" name="auto-thickbox-plus[bgcolor_bg]" value="transparent"<?php checked($bgcolor_bg_trans); ?> onclick="disableOption(this)" />
			<?php _e('Transparent', 'auto-thickbox'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><a href="<?php esc_attr_e('https://developer.mozilla.org/en/CSS/border', 'auto-thickbox'); ?>" target="_blank"><?php _e('Border'); ?></a></th>
		<th scope="row"><?php _e('Window', 'auto-thickbox'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[border_win]" value="<?php echo $this->options['border_win']; ?>"<?php disabled($border_win_none); ?> /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[border_win]" value="none"<?php checked($border_win_none); ?> onclick="disableOption(this)" />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php _e('Image'); ?> (<?php _e('Top left'); ?>)</th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[border_img_tl]" value="<?php echo $this->options['border_img_tl']; ?>"<?php disabled($border_img_tl_none); ?> /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[border_img_tl]" value="none"<?php checked($border_img_tl_none); ?> onclick="disableOption(this)" />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php _e('Image'); ?> (<?php _e('Bottom right'); ?>)</th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[border_img_br]" value="<?php echo $this->options['border_img_br']; ?>"<?php disabled($border_img_br_none); ?> /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[border_img_br]" value="none"<?php checked($border_img_br_none); ?> onclick="disableOption(this)" />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><a href="<?php esc_attr_e('https://developer.mozilla.org/en/CSS/border-radius', 'auto-thickbox'); ?>" target="_blank"><?php _e('Border Radius', 'auto-thickbox'); ?></a></th>
		<th scope="row"><?php _e('Window', 'auto-thickbox'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[radius_win]" value="<?php echo $this->options['radius_win']; ?>" /> px</label>
		</td>
	</tr>
	<tr>
		<th scope="row"><a href="<?php esc_attr_e('https://developer.mozilla.org/en/CSS/opacity', 'auto-thickbox'); ?>" target="_blank"><?php _e('Opacity', 'auto-thickbox'); ?></a></th>
		<th scope="row"><?php _e('Background'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[opacity_bg]" value="<?php echo $this->options['opacity_bg']; ?>" id="opacity-bg" class="small-text" /></label>
			<label for="opacity-bg-slider" id="opacity-bg-trans"><?php _e('Transparent', 'auto-thickbox'); ?></label>
			<div id="opacity-bg-slider"></div>
			<label for="opacity-bg-slider" id="opacity-bg-opaque"><?php _e('Opaque', 'auto-thickbox'); ?></label>
			<div style="clear:left"></div>
		</td>
	</tr>
	<tr>
		<th scope="row"><a href="<?php esc_attr_e('https://developer.mozilla.org/en/CSS/box-shadow', 'auto-thickbox'); ?>" target="_blank"><?php _e('Box Shadow', 'auto-thickbox'); ?></a></th>
		<th scope="row"><?php _e('Window', 'auto-thickbox'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[box_shadow_win]" value="<?php echo $this->options['box_shadow_win']; ?>" size="27"<?php disabled($box_shadow_win_none); ?> /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[box_shadow_win]" value="none"<?php checked($box_shadow_win_none); ?> onclick="disableOption(this)" />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><a href="<?php esc_attr_e('https://developer.mozilla.org/en/CSS/text-shadow', 'auto-thickbox'); ?>" target="_blank"><?php _e('Text Shadow', 'auto-thickbox'); ?></a></th>
		<th scope="row"><?php _e('Title'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[txt_shadow_title]" value="<?php echo $this->options['txt_shadow_title']; ?>" size="27"<?php disabled($txt_shadow_title_none); ?> /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[txt_shadow_title]" value="none"<?php checked($txt_shadow_title_none); ?> onclick="disableOption(this)" />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"></th>
		<th scope="row"><?php _e('Caption'); ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[txt_shadow_cap]" value="<?php echo $this->options['txt_shadow_cap']; ?>" size="27"<?php disabled($txt_shadow_cap_none); ?> /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[txt_shadow_cap]" value="none"<?php checked($txt_shadow_cap_none); ?> onclick="disableOption(this)" />
			<?php _e('None'); ?></label>
		</td>
	</tr>
</table>
<?php
	}

	function image_metabox() {
		$img_prev_none = $this->options['img_prev'] == 'none';
		$img_prev = !$img_prev_none ? $this->options['img_prev'] : $this->options_def['img_prev'];
		$img_next_none = $this->options['img_next'] == 'none';
		$img_next = !$img_next_none ? $this->options['img_next'] : $this->options_def['img_next'];
		$img_first_none = $this->options['img_first'] == 'none';
		$img_first = !$img_first_none ? $this->options['img_first'] : $this->options_def['img_first'];
		$img_last_none = $this->options['img_last'] == 'none';
		$img_last = !$img_last_none ? $this->options['img_last'] : $this->options_def['img_last'];
		$img_close_none = $this->options['img_close'] == 'none';
		$img_close = !$img_close_none ? $this->options['img_close'] : $this->options_def['img_close'];
		$img_close_btn_none = $this->options['img_close_btn'] == 'none';
		$img_close_btn = !$img_close_btn_none ? $this->options['img_close_btn'] : $this->options_def['img_close_btn'];
		$img_load_none = $this->options['img_load'] == 'none';
		$img_load = !$img_load_none ? $this->options['img_load'] : $this->options_def['img_load'];
?>
<table class="form-table">
	<tr>
		<th scope="row"><?php echo $this->texts['prev2']; ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[img_prev]" value="<?php echo esc_attr($img_prev); ?>" style="width:80%"<?php disabled($img_prev_none); ?> /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[img_prev]" value="none"<?php checked($img_prev_none); ?> onclick="disableOption(this)" />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php echo $this->texts['next2']; ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[img_next]" value="<?php echo esc_attr($img_next); ?>" style="width:80%"<?php disabled($img_next_none); ?> /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[img_next]" value="none"<?php checked($img_next_none); ?> onclick="disableOption(this)" />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php echo $this->texts['first2']; ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[img_first]" value="<?php echo esc_attr($img_first); ?>" style="width:80%"<?php disabled($img_first_none); ?> /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[img_first]" value="none"<?php checked($img_first_none); ?> onclick="disableOption(this)" />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php echo $this->texts['last2']; ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[img_last]" value="<?php echo esc_attr($img_last); ?>" style="width:80%"<?php disabled($img_last_none); ?> /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[img_last]" value="none"<?php checked($img_last_none); ?> onclick="disableOption(this)" />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php echo $this->texts['close']; ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[img_close]" value="<?php echo esc_attr($img_close); ?>" style="width:80%"<?php disabled($img_close_none); ?> /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[img_close]" value="none"<?php checked($img_close_none); ?> onclick="disableOption(this)" />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php echo $this->texts['close']; ?> (<?php _e('Button', 'auto-thickbox'); ?>)</th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[img_close_btn]" value="<?php echo esc_attr($img_close_btn); ?>" style="width:80%"<?php disabled($img_close_btn_none); ?> /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[img_close_btn]" value="none"<?php checked($img_close_btn_none); ?> onclick="disableOption(this)" />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php echo $this->texts['load']; ?></th>
		<td>
			<label><input type="text" name="auto-thickbox-plus[img_load]" value="<?php echo esc_attr($img_load); ?>" style="width:80%"<?php disabled($img_load_none); ?> /></label>
			<label><input type="checkbox" name="auto-thickbox-plus[img_load]" value="none"<?php checked($img_load_none); ?> onclick="disableOption(this)" />
			<?php _e('None'); ?></label>
		</td>
	</tr>
</table>
<?php
	}

	function effect_metabox() {
		$effect_speed = $this->options['effect_speed'];
		$effect_speed_num = is_numeric($effect_speed);
		switch ($effect_speed) {
			case "fast": $effect_speed = "200"; break;
			case "normal": $effect_speed = "400"; break;
			case "slow": $effect_speed = "600"; break;
		}
?>
<table class="form-table">
	<tr>
		<th scope="row"><?php _e('Open', 'auto-thickbox'); ?></th>
		<td>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_open]" value="zoom"<?php checked($this->options['effect_open'], 'zoom'); ?> />
			<?php _e('Zoom', 'auto-thickbox'); ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_open]" value="slide"<?php checked($this->options['effect_open'], 'slide'); ?> />
			<?php _e('Slide', 'auto-thickbox'); ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_open]" value="fade"<?php checked($this->options['effect_open'], 'fade'); ?> />
			<?php _e('Fade', 'auto-thickbox'); ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_open]" value="none"<?php checked($this->options['effect_open'], 'none'); ?> />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php echo $this->texts['close']; ?></th>
		<td>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_close]" value="zoom"<?php checked($this->options['effect_close'], 'zoom'); ?> />
			<?php _e('Zoom', 'auto-thickbox'); ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_close]" value="slide"<?php checked($this->options['effect_close'], 'slide'); ?> />
			<?php _e('Slide', 'auto-thickbox'); ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_close]" value="fade"<?php checked($this->options['effect_close'], 'fade'); ?> />
			<?php _e('Fade', 'auto-thickbox'); ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_close]" value="none"<?php checked($this->options['effect_close'], 'none'); ?> />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php _e('Transition', 'auto-thickbox'); ?></th>
		<td>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_trans]" value="zoom"<?php checked($this->options['effect_trans'], 'zoom'); ?> />
			<?php _e('Zoom', 'auto-thickbox'); ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_trans]" value="slide"<?php checked($this->options['effect_trans'], 'slide'); ?> />
			<?php _e('Slide', 'auto-thickbox'); ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_trans]" value="fade"<?php checked($this->options['effect_trans'], 'fade'); ?> />
			<?php _e('Fade', 'auto-thickbox'); ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_trans]" value="none"<?php checked($this->options['effect_trans'], 'none'); ?> />
			<?php _e('None'); ?></label>
		</td>
	</tr>
	<tr>
		<th scope="row"><?php _e('Speed', 'auto-thickbox'); ?></th>
		<td>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_speed]" value="fast"<?php checked($this->options['effect_speed'], 'fast'); ?> onclick="updateEffectSpeed(this)" />
			<?php _e('Fast', 'auto-thickbox'); ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_speed]" value="normal"<?php checked($this->options['effect_speed'], 'normal'); ?> onclick="updateEffectSpeed(this)" />
			<?php _e('Normal', 'auto-thickbox'); ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_speed]" value="slow"<?php checked($this->options['effect_speed'], 'slow'); ?> onclick="updateEffectSpeed(this)" />
			<?php _e('Slow', 'auto-thickbox'); ?></label>
			<label class="item"><input type="radio" name="auto-thickbox-plus[effect_speed]" value="number"<?php checked($effect_speed_num); ?> onclick="updateEffectSpeed(this)" />
				<input type="text" name="auto-thickbox-plus[effect_speed]" value="<?php echo $effect_speed; ?>"<?php disabled(!$effect_speed_num); ?> class="small-text" /> ms</label>
		</td>
	</tr>
</table>
<?php
	}

	var $base_dir;
	var $options, $options_def;
	var $texts;

	function auto_thickbox_options() {
		$this->__construct(); // for PHP4
	}

	function __construct() {
		add_action('admin_menu', array(&$this, 'register_options_page'));
		add_action('admin_init', array(&$this, 'register_options'));
	}

	function init_variables(&$auto_thickbox) {
		$this->base_dir = &$auto_thickbox->base_dir;

		$this->options_def = &$auto_thickbox->options_def;
		$this->options = &$auto_thickbox->options;
		$this->texts = &$auto_thickbox->texts;
	}

	function register_options() {
		register_setting( 'auto-thickbox-plus-options', 'auto-thickbox-plus', array(&$this, 'options_callback') );
	}

	var $checkboxes = array('auto_resize', 'builtin_res',
		'drag_img_move', 'drag_img_resize',
		'drag_content_move', 'drag_content_resize',
		'key_close_esc', 'key_close_enter',
		'key_prev_angle', 'key_prev_left', 'key_prev_tab', 'key_prev_space', 'key_prev_bs',
		'key_next_angle', 'key_next_right', 'key_next_tab', 'key_next_space',
		'key_end_home_end');

	function options_callback($options) {
		if (isset($_POST['reset'])) return $this->options_def;
		foreach ($this->checkboxes as $checkbox) {
			if (!isset($options[$checkbox]))
				$options[$checkbox] = 'off';
		}
		return $options;
	}
} # auto_thickbox_options

?>