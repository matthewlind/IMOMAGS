<?php
/**********************************
* This page displays all export code
* I know the code is ugly, but it
* will be updated when 3.3 is
* released with a new meta API
**********************************/
function ecpt_export_page() {
	
	global $wpdb;
	global $wp_version;
	global $ecpt_prefix;
  	global $ecpt_db_name;
  	global $ecpt_db_tax_name;
  	global $ecpt_db_meta_name;
  	global $ecpt_db_meta_fields_name;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;
	?>
	<div class="wrap">
	<div id="ecpt-wrap">
		<h2><?php _e('Export Post Types, Taxonomies, and Metaboxes', 'ecpt'); ?></h2>
		<p><?php _e('The code provided on this page will allow you to "export" your created post types, taxonomies, and metaboxes to other WordPress installs very easily. Simply copy the given code and paste it into your theme\'s functions.php.', 'ecpt'); ?>
			
		<div class="postbox-container" style="width:70%;">
				<div class="metabox-holder"> 
					<div class="meta-box-sortables">
					
						<!--Post Type Export-->
						<div class="postbox open">
							<div class="handlediv" title="Click to toggle"><br /></div>
							<h3 class="hndle"><span><?php _e('Custom Post Type Export Code', 'ecpt') ?></span></h3>
							<div class="inside ecpt-clearfix">
		
								<pre class="code">
									<code class="php">
									<?php
									$post_types = ecpt_get_cached_post_types();
									foreach( $post_types as $key => $type)
									{
										echo "// registration code for $type->name post type
										";
										echo "function register_" . str_replace('-', '_', $type->name) . "_posttype() {";
											echo "
											&#36labels = array(
												'name' 				=> _x( '" . $type->plural_name . "', 'post type general name' ),
												'singular_name'		=> _x( '" . $type->singular_name . "', 'post type singular name' ),
												'add_new' 			=> _x( 'Add New', '" . $type->singular_name . "'),
												'add_new_item' 		=> __( 'Add New " . $type->singular_name ." '),
												'edit_item' 		=> __( 'Edit " . $type->singular_name ." '),
												'new_item' 			=> __( 'New " . $type->singular_name . " '),
												'view_item' 		=> __( 'View " . $type->singular_name ." '),
												'search_items' 		=> __( 'Search " . $type->plural_name ." '),
												'not_found' 		=>  __( 'No " . $type->singular_name ." found' ),
												'not_found_in_trash'=> __( 'No " . $type->plural_name . " found in Trash' ),
												'parent_item_colon' => ''
											);
											";

											if($type->hierarchical == 1) { $hierarchical = 'true'; } else { $hierarchical = 'false'; } 
											if($type->has_archive == 1) { $archive = 'true'; } else { $archive = 'false'; } 
											if($type->with_front == 1) { $with_front = 'false'; } else { $with_front = 'true'; } 
											
											// check for supports options
											$supports = array();
											if($type->title == 1) 			{ $supports[] = 'title'; }
											if($type->editor == 1) 			{ $supports[] = 'editor'; }
											if($type->author == 1) 			{ $supports[] = 'author'; }
											if($type->thumbnail == 1) 		{ $supports[] = 'thumbnail'; }
											if($type->excerpt == 1) 		{ $supports[] = 'excerpt'; }
											if($type->fields == 1) 			{ $supports[] = 'custom-fields'; }
											if($type->comments == 1) 		{ $supports[] = 'comments'; }
											if($type->revisions == 1) 		{ $supports[] = 'revisions'; }
											if($type->post_formats == 1) 	{ $supports[] = 'post-formats'; }
											if($type->hierarchical == 1) 	{ $supports[] = 'page-attributes'; } // page attributes are based on hierarchy
											
											$taxonomies = array();
											
											if($type->post_tags == 1) 		{ $taxonomies[] = 'post_tag'; }
											if($type->categories == 1) 		{ $taxonomies[] = 'category'; }
											
											$t_count = count($taxonomies) -1;
											echo "
											&#36taxonomies = array("; 
												foreach($taxonomies as $key => $t) {
													if($key == $t_count) {
														echo "'" . $t . "'";
													} else {
														echo "'" . $t . "'" . ', '; 
													}
												}
											echo ");
											
											&#36supports = array(";
											$supports_string = '';
											foreach ($supports as $support) { $supports_string .= "'" . $support . "',"; }
											echo substr($supports_string, 0, strlen($supports_string)-1) . ");
											";
														
											echo "
											&#36post_type_args = array(
												'labels' 			=> &#36labels,
												'singular_label' 	=> __('$type->singular_name'),
												'public' 			=> true,
												'show_ui' 			=> true,
												'publicly_queryable'=> true,
												'query_var'			=> true,
												'capability_type' 	=> 'post',
												'has_archive' 		=> $archive,
												'hierarchical' 		=> $hierarchical,
												'rewrite' 			=> array('slug' => '$type->slug', 'with_front' => $with_front ),
												'supports' 			=> &#36supports,
												'menu_position' 	=> 5,
												'menu_icon' 		=> '$type->menu_icon',
												'taxonomies'		=> &#36taxonomies
											 );
											 ";
											echo "register_post_type('$type->name',&#36post_type_args);
										}
										";
										echo "add_action('init', 'register_" . str_replace('-', '_', $type->name) . "_posttype');";
									}
									?>
									</code>
								</pre>
						</div><!-- end inside -->												
					</div><!-- END postbox -->		
						
					<div class="postbox closed">
						<div class="handlediv" title="Click to toggle"><br /></div>
						<h3 class="hndle"><span><?php _e('Taxonomy Export Code', 'ecpt'); ?></span></h3>
						<div class="inside">				
							<pre class="code">
								<code class="php">
								<?php
								$taxonomies = ecpt_get_cached_taxonomies();
								foreach( $taxonomies as $key => $tax)
								{
									echo '<div class="export-code">
									';
									echo "// registration code for $tax->name taxonomy
									";
									echo "function register_" . str_replace('-', '_', strtolower($tax->name)) . "_tax() {";
										echo "
										&#36labels = array(
											'name' 					=> _x( '$tax->plural_name', 'taxonomy general name' ),
											'singular_name' 		=> _x( '$tax->singular_name', 'taxonomy singular name' ),
											'add_new' 				=> _x( 'Add New $tax->singular_name', '$tax->singular_name'),
											'add_new_item' 			=> __( 'Add New $tax->singular_name' ),
											'edit_item' 			=> __( 'Edit $tax->singular_name' ),
											'new_item' 				=> __( 'New $tax->singular_name' ),
											'view_item' 			=> __( 'View $tax->singular_name' ),
											'search_items' 			=> __( 'Search $tax->plural_name' ),
											'not_found' 			=> __( 'No $tax->singular_name found' ),
											'not_found_in_trash' 	=> __( 'No $tax->singular_name found in Trash' ),
										);
										";
										if($tax->hierarchical == 1) 		{ $hierarchical = 'true'; } else { $hierarchical = 'false'; } 
										if($tax->show_tagcloud == 1) 		{ $tagcloud = 'true'; } else { $tagcloud = 'false'; } 
										if($tax->show_in_nav_menus == 1)	{ $nav = 'true'; } else { $nav = 'false'; }
										if($tax->with_front == 1) 			{ $with_front = 'false'; } else { $with_front = 'true'; } 
										$pages = explode(',', $tax->page);
										
										echo "
										&#36pages = array(";
										$pages_str = '';
										foreach ($pages as $page) { $pages_str .= "'" . $page . "',"; }
										echo substr($pages_str, 0, strlen($pages_str)-1) . ");
										";
									
										echo "			
										&#36args = array(
											'labels' 			=> &#36labels,
											'singular_label' 	=> __('$tax->singular_name'),
											'public' 			=> true,
											'show_ui' 			=> true,
											'hierarchical' 		=> $hierarchical,
											'show_tagcloud' 	=> $tagcloud,
											'show_in_nav_menus' => $nav,
											'rewrite' 			=> array('slug' => '$tax->slug', 'with_front' => $with_front ),
										 );
										";
										echo "register_taxonomy('" . strtolower($tax->name) . "', &#36pages, &#36args);
									}
									";
									echo "add_action('init', 'register_" . str_replace('-', '_', strtolower($tax->name)) . "_tax');";
									echo '</div>';
								}
								?>
								</code>
							</pre>
					</div><!-- end inside -->												
				</div><!-- END postbox -->	
				<div class="postbox closed">
					<div class="handlediv" title="Click to toggle"><br /></div>
					<h3 class="hndle"><span><?php _e('Meta Box Export Code', 'ecpt'); ?></span></h3>
					<div class="inside">	
						<pre class="code">
							<code class="php">
<?php
								$metaboxes = ecpt_get_cached_metaboxes();
								foreach($metaboxes as $key => $metabox)
								{
								?>
								
								
								$<?php echo $metabox->name; ?>_metabox_<?php echo str_replace('-', '_', $metabox->page); ?> = array( 
									'id' => '<?php echo $metabox->name; ?>',
									'title' => '<?php echo $metabox->nicename; ?>',
									'page' => '<?php echo $metabox->page; ?>',
									'context' => '<?php echo $metabox->context; ?>',
									'priority' => '<?php echo $metabox->priority; ?>',
									'fields' => $<?php echo $metabox->name; ?>_fields = array(

<?php
												foreach($wpdb->get_results("SELECT * FROM " . $ecpt_db_meta_fields_name . " WHERE parent = '" . $metabox->name ."' ORDER BY list_order;") as $key => $meta_field) 
												{  
												
												$options_string = '';
												$options = explode(',', $meta_field->options);
												foreach($options as $option) { $options_string .= "'" . $option . "',"; }
												$options_string = substr($options_string, 0, -1);
												?>
												
												array(
													'name' 			=> <?php echo "'" . $meta_field->nicename . "'"; ?>,
													'desc' 			=> <?php echo "'" . $meta_field->description . "'"; ?>,
													'id' 			=> <?php echo "'" . $ecpt_prefix . $meta_field->name . "'"; ?>,
													'class' 		=> <?php echo "'" . $ecpt_prefix . $meta_field->name . "'"; ?>,
													'type' 			=> <?php echo "'" . $meta_field->type . "'"; ?>,
													'rich_editor' 	=> <?php echo $meta_field->rich_editor; ?>,			
										<?php if($meta_field->options && ($meta_field->type == 'select' || $meta_field->type == 'radio')) { ?>
			'options' => array(<?php echo $options_string; ?>),
										<?php } ?>
			'max' 			=> <?php echo $meta_field->max; ?>
													
												),
											<?php } ?>
									)
								);			
											
								add_action('admin_menu', 'ecpt_add_<?php echo $metabox->name; ?>_meta_box');
								function ecpt_add_<?php echo $metabox->name; ?>_meta_box() {

									global $<?php echo $metabox->name; ?>_metabox_<?php echo str_replace('-', '_', $metabox->page); ?>;			
										
									add_meta_box($<?php echo $metabox->name; ?>_metabox_<?php echo str_replace('-', '_', $metabox->page); ?>['id'], $<?php echo $metabox->name; ?>_metabox_<?php echo $metabox->page; ?>['title'], 'ecpt_show_<?php echo $metabox->name; ?>_box', '<?php echo str_replace('-', '_', $metabox->page); ?>', '<?php echo $metabox->context; ?>', '<?php echo $metabox->priority; ?>', $<?php echo $metabox->name; ?>_metabox_<?php echo str_replace('-', '_', $metabox->page); ?>);
								}

								// function to show meta boxes
								function ecpt_show_<?php echo $metabox->name; ?>_box()	{
									global $post;
									global $<?php echo $metabox->name; ?>_metabox_<?php echo str_replace('-', '_', $metabox->page); ?>;
									global $ecpt_prefix;
									global $wp_version;
									
									// Use nonce for verification
									echo '&lt;input type="hidden" name="ecpt_<?php echo $metabox->name; ?>_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" /&gt;';
									
									echo '&lt;table class="form-table"&gt;';

									foreach ($<?php echo $metabox->name; ?>_metabox_<?php echo str_replace('-', '_', $metabox->page); ?>['fields'] as $field) {
										// get current post meta data

										$meta = get_post_meta($post-&gt;ID, $field['id'], true);
										
										echo '&lt;tr&gt;',
												'&lt;th style="width:20%"&gt;&lt;label for="', $field['id'], '"&gt;', $field['name'], '&lt;/label&gt;&lt;/th&gt;',
												'&lt;td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '"&gt;';
										switch ($field['type']) {
											case 'text':
												echo '&lt;input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" /&gt;&lt;br/&gt;', '', $field['desc'];
												break;
											case 'date':
												echo '&lt;input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. ecpt_timestamp_to_date($meta) . '" size="30" style="width:97%" /&gt;' . '' . $field['desc'];
												break;
											case 'upload':
												echo '&lt;input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:80%" /&gt;&lt;input class="ecpt_upload_image_button" type="button" value="Upload Image" /&gt;&lt;br/&gt;', '', $field['desc'];
												break;
											case 'textarea':
											
												if($field['rich_editor'] == 1) {
													if($wp_version >= 3.3) {
														echo wp_editor($meta, $field['id'], array('textarea_name' => $field['id']));
													} else {
														// older versions of WP
														$editor = '';
														if(!post_type_supports($post->post_type, 'editor')) {
															$editor = wp_tiny_mce(true, array('editor_selector' => $field['class'], 'remove_linebreaks' => false) );
														}
														$field_html = '&lt;div style="width: 97%; border: 1px solid #DFDFDF;"&gt;&lt;textarea name="' . $field['id'] . '" class="' . $field['class'] . '" id="' . $field['id'] . '" cols="60" rows="8" style="width:100%">'. $meta . '&lt;/textarea&gt;&lt;/div&gt;&lt;br/&gt;' . __($field['desc']);
														echo $editor . $field_html;
													}
												} else {
													echo '&lt;div style="width: 100%;"&gt;&lt;textarea name="', $field['id'], '" class="', $field['class'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%"&gt;', $meta ? $meta : $field['std'], '&lt;/textarea&gt;&lt;/div&gt;', '', $field['desc'];				
												}
												
												break;
											case 'select':
												echo '&lt;select name="', $field['id'], '" id="', $field['id'], '"&gt;';
												foreach ($field['options'] as $option) {
													echo '&lt;option value="' . $option . '"', $meta == $option ? ' selected="selected"' : '', '&gt;', $option, '&lt;/option&gt;';
												}
												echo '&lt;/select&gt;', '', $field['desc'];
												break;
											case 'radio':
												foreach ($field['options'] as $option) {
													echo '&lt;input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' /&gt;&nbsp;', $option;
												}
												echo '&lt;br/&gt;' . $field['desc'];
												break;
											case 'checkbox':
												echo '&lt;input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /&gt;&nbsp;';
												echo $field['desc'];
												break;
											case 'slider':
												echo '&lt;input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" /&gt;';
												echo '&lt;div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"&gt;&lt;/div&gt;';		
												echo '&lt;div style="width: 100%; clear: both;"&gt;' . $field['desc'] . '&lt;/div&gt;';
												break;
											case 'repeatable' :
												
												$field_html = '&lt;input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/&gt;';
												if(is_array($meta)) {
													$count = 1;
													foreach($meta as $key => $value) {
														$field_html .= '&lt;div class="ecpt_repeatable_wrapper"&gt;&lt;input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:90%" /&gt;';
														if($count > 1) {
															$field_html .= '&lt;a href="#" class="ecpt_remove_repeatable button-secondary"&gt;x&lt;/a&gt;&lt;br/&gt;';
														}
														$field_html .= '&lt;/div&gt;';
														$count++;
													}
												} else {
													$field_html .= '&lt;div class="ecpt_repeatable_wrapper"&gt;&lt;input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:90%" /&gt;&lt;/div&gt;';
												}
												$field_html .= '&lt;button class="ecpt_add_new_field button-secondary"&gt;' . __('Add New', 'ecpt') . '&lt;/button&gt;&nbsp;&nbsp;' . __(stripslashes($field['desc']));
												
												echo $field_html;
												
												break;
											
											case 'repeatable upload' :
											
												$field_html = '&lt;input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/&gt;';
												if(is_array($meta)) {
													$count = 1;
													foreach($meta as $key =&gt; $value) {
														$field_html .= '&lt;div class="ecpt_repeatable_upload_wrapper"&gt;&lt;input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:80%" /&gt;&lt;button class="button-secondary ecpt_upload_image_button"&gt;Upload File&lt;/button&gt;';
														if($count &gt; 1) {
															$field_html .= '&lt;a href="#" class="ecpt_remove_repeatable button-secondary"&gt;x&lt;/a&gt;&lt;br/&gt;';
														}
														$field_html .= '&lt;/div&gt;';
														$count++;
													}
												} else {
													$field_html .= '&lt;div class="ecpt_repeatable_upload_wrapper"&gt;&lt;input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:80%" /&gt;&lt;input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /&gt;&lt;/div&gt;';
												}
												$field_html .= '&lt;button class="ecpt_add_new_upload_field button-secondary"&gt;' . __('Add New', 'ecpt') . '&lt;/button&gt;&nbsp;&nbsp;' . __(stripslashes($field['desc']));		
											
												echo $field_html;
											
												break;
										}
										echo     '&lt;td&gt;',
											'&lt;/tr&gt;';
									}
									
									echo '&lt;/table&gt;';
								}	

								add_action('save_post', 'ecpt_<?php echo $metabox->name; ?>_save');

								// Save data from meta box
								function ecpt_<?php echo $metabox->name; ?>_save($post_id) {
									global $post;
									global $<?php echo $metabox->name; ?>_metabox_<?php echo str_replace('-', '_', $metabox->page); ?>;
									
									// verify nonce
									if (!wp_verify_nonce($_POST['ecpt_<?php echo $metabox->name; ?>_meta_box_nonce'], basename(__FILE__))) {
										return $post_id;
									}

									// check autosave
									if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
										return $post_id;
									}

									// check permissions
									if ('page' == $_POST['post_type']) {
										if (!current_user_can('edit_page', $post_id)) {
											return $post_id;
										}
									} elseif (!current_user_can('edit_post', $post_id)) {
										return $post_id;
									}
									
									foreach ($<?php echo $metabox->name; ?>_metabox_<?php echo str_replace('-', '_', $metabox->page); ?>['fields'] as $field) {
									
										$old = get_post_meta($post_id, $field['id'], true);
										$new = $_POST[$field['id']];
										
										if ($new && $new != $old) {
											if($field['type'] == 'date') {
												$new = ecpt_format_date($new);
												update_post_meta($post_id, $field['id'], $new);
											} else {
												if(is_string($new)) {
													$new = esc_attr($data);
												} 
												update_post_meta($post_id, $field['id'], $new);
												
												
											}
										} elseif ('' == $new && $old) {
											delete_post_meta($post_id, $field['id'], $old);
										}
									}
								}
								
								<?php }  ?>
								
								function ecpt_export_ui_scripts() {

									global $ecpt_options;
								?&gt; 
								&lt;script type="text/javascript"&gt;
										jQuery(document).ready(function($)
										{
											
											if($('.form-table .ecpt_upload_field').length > 0 ) {
												// Media Uploader
												window.formfield = '';

												$('.ecpt_upload_image_button').live('click', function() {
												window.formfield = $('.ecpt_upload_field',$(this).parent());
													tb_show('', 'media-upload.php?type=file&TB_iframe=true');
																	return false;
													});

													window.original_send_to_editor = window.send_to_editor;
													window.send_to_editor = function(html) {
														if (window.formfield) {
															imgurl = $('a','&lt;div&gt;'+html+'&lt;/div&gt;').attr('href');
															window.formfield.val(imgurl);
															tb_remove();
														}
														else {
															window.original_send_to_editor(html);
														}
														window.formfield = '';
														window.imagefield = false;
													}
											}
											if($('.form-table .ecpt-slider').length > 0 ) {
												$('.ecpt-slider').each(function(){
													var $this = $(this);
													var id = $this.attr('rel');
													var val = $('#' + id).val();
													var max = $('#' + id).attr('rel');
													max = parseInt(max);
													//var step = $('#' + id).closest('input').attr('rel');
													$this.slider({
														value: val,
														max: max,
														step: 1,
														slide: function(event, ui) {
															$('#' + id).val(ui.value);
														}
													});
												});
											}
											
											if($('.form-table .ecpt_datepicker').length > 0 ) {
												var dateFormat = 'mm/dd/yy';
												$('.ecpt_datepicker').datepicker({dateFormat: dateFormat});
											}
											
											// add new repeatable field
											$(".ecpt_add_new_field").on('click', function() {					
												var field = $(this).closest('td').find("div.ecpt_repeatable_wrapper:last").clone(true);
												var fieldLocation = $(this).closest('td').find('div.ecpt_repeatable_wrapper:last');
												// get the hidden field that has the name value
												var name_field = $("input.ecpt_repeatable_field_name", ".ecpt_field_type_repeatable:first");
												// set the base of the new field name
												var name = $(name_field).attr("id");
												// set the new field val to blank
												$('input', field).val("");
												
												// set up a count var
												var count = 0;
												$('.ecpt_repeatable_field').each(function() {
													count = count + 1;
												});
												name = name + '[' + count + ']';
												$('input', field).attr("name", name);
												$('input', field).attr("id", name);
												field.insertAfter(fieldLocation, $(this).closest('td'));

												return false;
											});		

											// add new repeatable upload field
											$(".ecpt_add_new_upload_field").on('click', function() {	
												var container = $(this).closest('tr');
												var field = $(this).closest('td').find("div.ecpt_repeatable_upload_wrapper:last").clone(true);
												var fieldLocation = $(this).closest('td').find('div.ecpt_repeatable_upload_wrapper:last');
												// get the hidden field that has the name value
												var name_field = $("input.ecpt_repeatable_upload_field_name", container);
												// set the base of the new field name
												var name = $(name_field).attr("id");
												// set the new field val to blank
												$('input[type="text"]', field).val("");
												
												// set up a count var
												var count = 0;
												$('.ecpt_repeatable_upload_field', container).each(function() {
													count = count + 1;
												});
												name = name + '[' + count + ']';
												$('input', field).attr("name", name);
												$('input', field).attr("id", name);
												field.insertAfter(fieldLocation, $(this).closest('td'));

												return false;
											});
											
											// remove repeatable field
											$('.ecpt_remove_repeatable').on('click', function(e) {
												e.preventDefault();
												var field = $(this).parent();
												$('input', field).val("");
												field.remove();				
												return false;
											});											
																					
										});
								  &lt;/script&gt;
								&lt;?php
								}

								function ecpt_export_datepicker_ui_scripts() {
									global $ecpt_base_dir;
									wp_enqueue_script('jquery-ui.min', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js', false, '1.8', 'all');
								}
								function ecpt_export_datepicker_ui_styles() {
									global $ecpt_base_dir;
									wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css', false, '1.8', 'all');
								}

								// these are for newest versions of WP
								add_action('admin_print_scripts-post.php', 'ecpt_export_datepicker_ui_scripts');
								add_action('admin_print_scripts-edit.php', 'ecpt_export_datepicker_ui_scripts');
								add_action('admin_print_scripts-post-new.php', 'ecpt_export_datepicker_ui_scripts');
								add_action('admin_print_styles-post.php', 'ecpt_export_datepicker_ui_styles');
								add_action('admin_print_styles-edit.php', 'ecpt_export_datepicker_ui_styles');
								add_action('admin_print_styles-post-new.php', 'ecpt_export_datepicker_ui_styles');

								if ((isset($_GET['post']) && (isset($_GET['action']) && $_GET['action'] == 'edit') ) || (strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php')))
								{
									add_action('admin_head', 'ecpt_export_ui_scripts');
								}

								// converts a time stamp to date string for meta fields
								if(!function_exists('ecpt_timestamp_to_date')) {
									function ecpt_timestamp_to_date($date) {
										
										return date('m/d/Y', $date);
									}
								}
								if(!function_exists('ecpt_format_date')) {
									function ecpt_format_date($date) {

										$date = strtotime($date);
										
										return $date;
									}
								}
							</code>
						</pre>
						</div><!-- end inside -->												
					</div><!-- END postbox -->	
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
}