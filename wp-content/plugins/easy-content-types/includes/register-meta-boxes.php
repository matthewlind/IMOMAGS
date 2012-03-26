<?php

// adds the meta boxes to the admin pages
function ecpt_add_box() {
	
	global $wpdb, $ecpt_db_meta_fields_name, $ecpt_prefix;
	
	$metaboxes = ecpt_get_cached_metaboxes();
	
	foreach( $metaboxes as $key => $metabox) 
	{
		$fields_array = array();
		foreach($wpdb->get_results("SELECT * FROM " . $ecpt_db_meta_fields_name . " WHERE parent = '" . $metabox->name ."' ORDER BY list_order;") as $key => $meta_field) 
		{
			$options = '';
			$options = explode(',', $meta_field->options);

			$fields = array(
				'name' 			=> $meta_field->nicename,
				'desc' 			=> $meta_field->description,
				'num_id'		=> $meta_field->id,
				'id' 			=> $ecpt_prefix . $meta_field->name,
				'class' 		=> $ecpt_prefix . $meta_field->name,
				'type' 			=> $meta_field->type,
				'rich_editor' 	=> $meta_field->rich_editor,
				'options' 		=> $options,
				'max' 			=> $meta_field->max,
				'std'			=> ''
			);
			$fields_array[] = $fields;
		}
	
		$meta_box_fields = array(
			'id' => 'ecpt_metabox_' . $metabox->id,
			'fields' => $fields_array
			
		);
		add_meta_box('ecpt_metabox_' . $metabox->id, __($metabox->nicename), 'ecpt_show_box', $metabox->page, $metabox->context, $metabox->priority, $meta_box_fields);
		
	}	
}
add_action('admin_menu', 'ecpt_add_box');

// renders the meta box
function ecpt_show_box($post, $metabox)	{
    global $post;
    global $ecpt_prefix;
	global $field_types;
	
    // Use nonce for verification
    echo '<input type="hidden" name="ecpt_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    
    echo '<table class="form-table" id="' . $metabox['id'] . '">';

    foreach ($metabox['args']['fields'] as $field) {
        // get current post meta data

        $meta = get_post_meta($post->ID, $field['id'], true);
        
		$field_types = apply_filters('ecpt_field_types', $field_types);
		
		// this check is necessary because we only want to create a table row for the availalbe field types
		if(in_array($field['type'], $field_types)) {
			echo '<tr id="ecpt_field_' . $field['num_id'] . '" class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
				$label = ecpt_field_label($field);
				echo '<th style="width:20%">' . $label . '</th>';
				echo '<td>';
					echo ecpt_render_field($field, $meta);
				echo '<td>';
			echo '</tr>';
		}
    }
    
    echo '</table>';
}

// run the label through a filter. This allows us to modify/remove the label for any field type
function ecpt_field_label($field) {
	$label = '<label for="' . $field['id'] . '">' . __(stripslashes($field['name'])) . '</label>';
	// the ecpt_field_label_filter allows the field label output to be altered for any field type
	if(has_filter('ecpt_field_label_filter')) {
		$label = apply_filters('ecpt_field_label_filter', $label, $field);
	}
	return $label;
}

// displays the requested field type
function ecpt_render_field($field, $meta) {

	global $wp_version, $post, $ecpt_options;

	switch($field['type']) :
	
		case 'text' :
			$field_html = '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . stripslashes($meta) . '" size="30" style="width:97%" /><br/>' . __(stripslashes($field['desc']));
			break;
			
		case 'textarea' :
			if($field['rich_editor'] == 1) {
				if($wp_version >= 3.3) {
					$field_html = wp_editor($meta, $field['id'], array('textarea_name' => $field['id']));
					$field_html .= '<p>' . __(stripslashes($field['desc'])) . '</p>';
				} else {
					// older versions of WP
					if(!post_type_supports($post->post_type, 'editor')) {
						$editor = wp_tiny_mce(true, array('editor_selector' => $field['class'], 'remove_linebreaks' => false) );
					}
					$field_html = '<div style="width: 97%; border: 1px solid #DFDFDF;"><textarea name="' . $field['id'] . '" class="' . $field['class'] . '" id="' . $field['id'] . '" cols="60" rows="8" style="width:100%">'. $meta . '</textarea></div><br/>' . __(stripslashes($field['desc']));
					$field_html = $editor . $field_html;
				}
			} else {
				$field_html = '<div style="width: 97%; border: 1px solid #DFDFDF;"><textarea name="' . $field['id'] . '" class="' . $field['class'] . '" id="' . $field['id'] . '" cols="60" rows="8" style="width:100%">'. $meta . '</textarea></div><br/>' . __(stripslashes($field['desc']));
			}
			break;
			
		case 'date' :
			if(!isset($meta) || $meta == '')  $date = ''; else $date = ecpt_timestamp_to_date($meta);
			$field_html = '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $date . '" size="30" style="width:97%" /><br/>' . __(stripslashes($field['desc']));
						
			break;
			
		case 'select' :
			$options = '';
			if($field['options'] != '') {
				foreach ($field['options'] as $option) {
					$selected = '';
					if($option == $meta) {
						$selected = 'selected="selected"';
					}
					$options .= '<option value="' . $option . '"' . $selected . '>'. $option . '</option>';
				}
			}
			$field_html = '<select name="' . $field['id'] . '" id="' . $field['id'] . '">' . $options . '</select><br/>' . __(stripslashes($field['desc']));
			break;
			
		case 'upload' :
			$field_html = '<input type="text" class="ecpt_upload_field" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /><br/>' . __(stripslashes($field['desc']));
			break;
			
		case 'radio' : 
			$options = '';
			if($field['options'] != '') {
				foreach ($field['options'] as $option) {
					$checked = '';
					if($option == $meta) {
						$checked = 'checked="checked"';
					}
					$options .= '<input type="radio" name="' . $field['id'] . '" group="' . $field['id'] . '" value="' . $option . '"' . $checked . '/>&nbsp;'. $option . '&nbsp;&nbsp;';
				}
			}
			$field_html = $options . '<br/>' . __(stripslashes($field['desc']));
			break;
			
		case 'checkbox' :
			$field_html = '<input type="checkbox" name="' . $field['id'] . '" id="' . $field['id'] . '" ' . checked(!empty($meta), true, false) .'/><div class="ecpt_description">' . __(stripslashes($field['desc'])) . '</div>';
			break;
			
		case 'slider' :
			$field_html = '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" /><div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div><div style="width: 100%; clear: both;">' . __(stripslashes($field['desc'])) . '</div>';
			break;		
	
		case 'repeatable' :

			$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/>';
			if(is_array($meta)) {
				$count = 1;
				foreach($meta as $key => $value) {
					$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:90%" />';
					if($count > 1) {
						$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
					}
					$field_html .= '</div>';
					$count++;
				}
			} else {
				$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:90%" /></div>';
			}
			$field_html .= '<button class="ecpt_add_new_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));
			
			break;
			
		case 'repeatable upload' :

			$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/>';
			if(is_array($meta)) {
				$count = 1;
				foreach($meta as $key => $value) {
					$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[' . $key . ']" id="' . $field['id'] . '[' . $key . ']" value="' . $meta[$key] . '" size="30" style="width:80%" /><button class="button-secondary ecpt_upload_image_button">Upload File</button>';
					if($count > 1) {
						$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
					}
					$field_html .= '</div>';
					$count++;
				}
			} else {
				$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[0]" id="' . $field['id'] . '[0]" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /></div>';
			}
			$field_html .= '<button class="ecpt_add_new_upload_field button-secondary">' . __('Add New', 'ecpt') . '</button>&nbsp;&nbsp;' . __(stripslashes($field['desc']));
			
			break;
		
	endswitch;
	
	
	if(has_filter('ecpt_fields_html')) {
		// this adds any addon fields (from plugins) to the array
		$field_html = apply_filters('ecpt_fields_html', $field_html, $field, $meta);
	}
	
	
	// return the final field
	return $field_html;
}

	
// Save data from meta box
add_action('save_post', 'ecpt_save_data');
function ecpt_save_data($post_id) {

	//echo '<pre>'; print_r($_POST); echo '</pre>';exit;

    global $wpdb;
	global $ecpt_prefix;
  	global $ecpt_db_meta_name;
  	global $ecpt_db_meta_fields_name;  
	
    // verify nonce
    if (!isset($_POST['ecpt_meta_box_nonce']) || !wp_verify_nonce($_POST['ecpt_meta_box_nonce'], basename(__FILE__))) {
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
    
	// first get the metaboxes associated with this post
    foreach( $wpdb->get_results("SELECT * FROM " . $ecpt_db_meta_name . " WHERE page='" . $_POST['post_type'] . "';") as $key => $metabox)
	{
	
		// now get all the fields associated with this metabox
		foreach( $wpdb->get_results("SELECT * FROM " . $ecpt_db_meta_fields_name . " WHERE parent='" . $metabox->name . "';") as $key => $field)
		{
			// only update meta if the field contains meta. Fields like the Separator have no meta value
			if(isset($_POST[$ecpt_prefix . $field->name])) {
				
				$old = get_post_meta($post_id, $ecpt_prefix . $field->name, true);
				$data = $_POST[$ecpt_prefix . $field->name];
				
				if($field->type == 'textarea') {
					// preserve line breaks for rich textareas
					$new = wpautop($data);
				} else if ($field->type == 'date') {			
					$new = ecpt_format_date($data);  		
				} else {
					if(is_string($data)) {
						$new = esc_attr($data);
					} else {
						$new = $data;
					}
				}
				
				if (($new || $new == 0) && $new != $old) {
					update_post_meta($post_id, $ecpt_prefix . $field->name, $new);
				} elseif ('' == $new && $old) {
					delete_post_meta($post_id, $ecpt_prefix . $field->name, $old);
				}
				
			} else {
				delete_post_meta($post_id, $ecpt_prefix . $field->name);
			}
		}	
	}
}