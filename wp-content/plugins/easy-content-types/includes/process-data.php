<?php

function ecpt_process_data() {

	global $wpdb;
	global $ecpt_db_name;
	global $ecpt_db_tax_name;
	global $ecpt_db_meta_name;
	global $ecpt_db_meta_fields_name;
	global $ecpt_base_dir;
	$ecpt_post = (!empty($_POST)) ? true : false;

	if($ecpt_post) // if data is being sent
	{
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'add-post-type') {
		
			if($_POST['label-single'] != '') { $single = $_POST['label-single']; } else { $single = $_POST['post-type-name']; }
			if($_POST['label-plural'] != '') { $plural = $_POST['label-plural']; } else { $plural = $_POST['post-type-name']; }

			// check for checked options
			if(isset($_POST['options-hierarchical']))	{ $hierarchical = 1; } else { $hierarchical = 0; }
			if(isset($_POST['options-post-formats'])) 	{ $post_formats = 1; } else { $post_formats = 0; }
			if(isset($_POST['options-archives'])) 		{ $archives = 1; } else { $archives = 0; }
			if(isset($_POST['options-nav'])) 			{ $nav = 1; } else { $nav = 0; }
			if(isset($_POST['options-search'])) 		{ $search = 1; } else { $search = 0; }
			
			// menu icon - set to default if no image given
			if(isset($_POST['options-icon']) && $_POST['options-icon'] != '') { $icon = $_POST['options-icon']; } else { $icon = $ecpt_base_dir . 'includes/images/icon.png'; }
			
			// check for supports options
			if(isset($_POST['options-title'])) 			{ $title = 1; } else { $title = 0; }
			if(isset($_POST['options-editor'])) 		{ $editor = 1; } else { $editor = 0; }
			if(isset($_POST['options-author'])) 		{ $author = 1; } else { $author = 0; }
			if(isset($_POST['options-thumbnail'])) 		{ $thumbnail = 1; } else { $thumbnail = 0; }
			if(isset($_POST['options-excerpt'])) 		{ $excerpt = 1; } else { $excerpt = 0; }
			if(isset($_POST['options-custom-fields'])) 	{ $fields = 1; } else { $fields = 0; }
			if(isset($_POST['options-comments'])) 		{ $comments = 1; } else { $comments = 0; }
			if(isset($_POST['options-revisions'])) 		{ $revisions = 1; } else { $revisions = 0; }
			if(isset($_POST['options-tags'])) 			{ $tags = 1; } else { $tags = 0; }
			if(isset($_POST['options-categories'])) 	{ $categories = 1; } else { $categories = 0; }
			
			// check for advanced options
			if(!isset($_POST['advanced-position']) || $_POST['advanced-position'] == '') 	{ $position = 5; } else { $position = intval($_POST['advanced-position']); }
			if(!isset($_POST['advanced-slug']) || $_POST['advanced-slug'] == '') { $slug = str_replace(' ', '_', strtolower($_POST['post-type-name'])); } else { $slug = $_POST['advanced-slug']; }
			if(isset($_POST['advanced-with-front'])) 	{ $with_front = 1; } else { $with_front = 0; }
				
			// page attributes (for page templates) are not used at this time but set in order to prevent errors	
			$page_attributes = 0;	
				
			$add = $wpdb->query("INSERT INTO " . $ecpt_db_name . " SET 
				`name`='" . str_replace(' ', '', strtolower($_POST['post-type-name'])) . "',			
				`singular_name`='"		. 	$single . "',	
				`plural_name`='"		. 	$plural . "',	
				`hierarchical`='"		. 	$hierarchical . "',	
				`post_formats`='"		. 	$post_formats . "',	
				`page_attributes`='"	. 	$page_attributes . "',	
				`show_in_nav_menus`='"	. 	$nav . "',	
				`exclude_from_search`='". 	$search . "',	
				`has_archive`='"		. 	$archives . "',		
				`title`='"				. 	$title . "',
				`editor`='"				. 	$editor . "',
				`author`='"				. 	$author . "',
				`thumbnail`='"			. 	$thumbnail . "',
				`excerpt`='"			. 	$excerpt . "',
				`fields`='"				. 	$fields . "',
				`comments`='"			. 	$comments . "',
				`revisions`='"			. 	$revisions . "',
				`menu_icon`='"			. 	$icon . "',
				`menu_position`='"		. 	$position . "',
				`slug`='"				. 	$slug . "',
				`with_front`='"			. 	$with_front . "',
				`post_tags`='"			. 	$tags . "',
				`categories`='"			. 	$categories . "'

			;");	
			
			// clear the post type cache
			ecpt_clear_cache('post_types');
			
			$url = get_bloginfo('wpurl') . '/wp-admin/admin.php?page=easy-content-types/easy-content-types.php?posttypes&post-type-added=1';
			header ("Location: $url");
		}
		
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'add-taxonomy') {

			if(isset($_POST['label-single']) && $_POST['label-single'] != '') { $single = $_POST['label-single']; } else { $single = $_POST['taxonomy-name']; }
			if(isset($_POST['label-plural']) && $_POST['label-plural']!= '') { $plural = $_POST['label-plural']; } else { $plural = $_POST['taxonomy-name']; }
			if(isset($_POST['options-slug']) && $_POST['options-slug'] != '' ) { 
				$slug = strtolower(str_replace(' ', '-', $_POST['options-slug'])); 
			} else { 
				$slug = str_replace(' ', '', strtolower($_POST['taxonomy-name'])); 
			}
			
			
			// check for checked options
			if(isset($_POST['options-hierarchical'])) 	{ $hierarchical = 1; } else { $hierarchical = 0; }
			if(isset($_POST['options-tagcloud'])) 		{ $show_tagcloud = 1; } else { $show_tagcloud = 0; }
			if(isset($_POST['options-nav'])) 			{ $nav = 1; } else { $nav = 0; }
			if(isset($_POST['options-with-front'])) 	{ $with_front = 1; } else { $with_front = 0; }
			if(isset($_POST['options-enable-filter'])) 	{ $enable_filter = 1; } else { $enable_filter = 0; }
			
			$pages = array();
			if(isset($_POST['taxonomy-object'])) {
				foreach($_POST['taxonomy-object'] as $page) { $pages[] = $page; };
				$pages_final = implode(',', $pages);
			} else {
				$pages_final = array('post');
			}
			$add = $wpdb->query("INSERT INTO " . $ecpt_db_tax_name . " SET 
				`name`='" 					. 	str_replace(' ', '', strtolower($_POST['taxonomy-name'])) . "',
				`singular_name`='"			. 	$single . "',
				`plural_name`='"			. 	$plural . "',	
				`hierarchical`='"			. 	$hierarchical . "',
				`show_tagcloud`='"			. 	$show_tagcloud . "',
				`show_in_nav_menus`='"		. 	$nav . "',
				`page`='"					. 	$pages_final . "',
				`with_front`='"				. 	$with_front . "',
				`slug`='"					. 	$slug . "',
				`enable_filter`='"			. 	$enable_filter . "'

			;");	
			
			// clear the taxonomy cache
			ecpt_clear_cache('taxonomies');
			
			$url = get_bloginfo('wpurl') . '/wp-admin/admin.php?page=easy-content-types/easy-content-types.php?taxonomies&taxonomy-added=1';
			header ("Location: $url");
		}
		
		// add custom meta boxes
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'add-metabox') {
						
			$add = $wpdb->query("INSERT INTO " . $ecpt_db_meta_name . " SET 
				`name`='" 	.   str_replace(' ', '', strtolower($_POST['metabox-name'])) . "',
				`nicename`='" .   $_POST['metabox-name'] . "',
				`page`='"		. 	$_POST['metabox-page'] . "',
				`context`='"	. 	$_POST['metabox-context'] . "',
				`priority`='"	. 	$_POST['metabox-priority'] . "'
			;");	
			
			// clear the cache
			ecpt_clear_cache('metaboxes');
			
			$url = get_bloginfo('wpurl') . '/wp-admin/admin.php?page=easy-content-types/easy-content-types.php?metaboxes&metabox-added=1';
			header ("Location: $url");
		}
		
		
		
		// add fields to meta boxes
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'add-field') {
			
			$existing_field = $wpdb->get_row("SELECT * FROM " . $ecpt_db_meta_fields_name . " WHERE nicename = '" . $_POST['field-name'] . "' ORDER BY id DESC LIMIT 1");
			
			if(isset($_POST['field-id']) && strlen(trim($_POST['field-id'])) > 0 ) {
				$field_id = str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-id'])));
			} elseif($existing_field) {
				$existing_field_id_number = substr($existing_field->name, -1);
				if(is_numeric($existing_field_id_number)) {
					$new_number = intval($existing_field_id_number) + 1;
					$field_id = preg_replace('/[^a-zA-Z0-9!@#$"\'\/()\.,]/', '', str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-name'])))) . '_' . $new_number;
				} else {
					$field_id = preg_replace('/[^a-zA-Z0-9!@#$"\'\/()\.,]/', '', str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-name'])))) . '_2';
				}
			} else {
				$field_id = preg_replace('/[^a-zA-Z0-9!@#$"\'\/()\.,]/', '', str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-name']))));
			}
			
			if(isset($_POST['rich-editor'])) 	{ $rich_editor = 1; } else { $rich_editor = 0; }
			
			$add = $wpdb->query("INSERT INTO " . $ecpt_db_meta_fields_name . " SET 
				`name`= '" 			. $field_id . "',
				`nicename`='"		. utf8_decode($_POST['field-name']) . "',
				`parent`='"			. $_POST['field-parent'] . "',
				`type`='"			. $_POST['field-type'] . "',
				`description`='"	. addslashes($_POST['field-desc']) . "',
				`options`='"		. str_replace(', ', ',', $_POST['field-options']) . "',
				`rich_editor`='"	. $rich_editor . "',
				`list_order`='"		. intval($_POST['field-order']) . "',
				`max`='"			. intval($_POST['field-max']) . "'

			;");	
			
			$url = get_bloginfo('wpurl') . '/wp-admin/admin.php?page=easy-content-types/easy-content-types.php?metaboxes&fields-edit=' . $_POST['current-field'];
			header ("Location: $url");
		}
		
		/*************************************
		* update data
		*************************************/
		
		/* process post type updates*/
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'update-post-type') {
			
			if($_POST['posttype-singlular'] != '') { $single = $_POST['posttype-singlular']; } else { $single = $_POST['posttype-name']; }
			if($_POST['posttype-plural'] != '') { $plural = $_POST['posttype-plural']; } else { $plural = $_POST['posttype-name']; }

			// check for checked options
			if(isset($_POST['posttype-hierarchical']))			{ $hierarchical = 1; } else { $hierarchical = 0; }
			if(isset($_POST['posttype-post_formats'])) 			{ $post_formats = 1; } else { $post_formats = 0; }
			if(isset($_POST['posttype-has_archive'])) 			{ $archives = 1; } else { $archives = 0; }
			if(isset($_POST['posttype-show_in_nav_menus'])) 	{ $nav = 1; } else { $nav = 0; }
			if(isset($_POST['posttype-exclude_from_search'])) 	{ $search = 1; } else { $search = 0; }
			
			// menu icon - set to default if no image given
			if(isset($_POST['posttype-menu-icon']) && $_POST['posttype-menu-icon'] != '') { 
				$icon = $_POST['posttype-menu-icon']; 
			} else { 
				$icon = $ecpt_base_dir . 'includes/images/icon.png'; 
			}
			
			// check for supports options
			if(isset($_POST['posttype-title'])) 		{ $title = 1; } else { $title = 0; }
			if(isset($_POST['posttype-editor'])) 		{ $editor = 1; } else { $editor = 0; }
			if(isset($_POST['posttype-author'])) 		{ $author = 1; } else { $author = 0; }
			if(isset($_POST['posttype-thumbnail'])) 	{ $thumbnail = 1; } else { $thumbnail = 0; }
			if(isset($_POST['posttype-excerpt'])) 		{ $excerpt = 1; } else { $excerpt = 0; }
			if(isset($_POST['posttype-fields'])) 		{ $fields = 1; } else { $fields = 0; }
			if(isset($_POST['posttype-comments'])) 		{ $comments = 1; } else { $comments = 0; }
			if(isset($_POST['posttype-revisions']))		{ $revisions = 1; } else { $revisions = 0; }
			if(isset($_POST['posttype-tags'])) 			{ $tags = 1; } else { $tags = 0; }
			if(isset($_POST['posttype-categories']))	{ $categories = 1; } else { $categories = 0; }
			
			// check for advanced options
			if(!isset($_POST['posttype-position']) || $_POST['posttype-position'] == '') { 
				$position = 5; 
			} else { 
				$position = intval($_POST['posttype-position']); 
			}
			if(!isset($_POST['posttype-slug']) || $_POST['posttype-slug'] == '') { 
				$slug = str_replace(' ', '_', strtolower($_POST['posttype-name'])); 
			} else { 
				$slug = str_replace(' ', '_', strtolower($_POST['posttype-slug']));  
			}
			if(isset($_POST['posttype-with-front'])) 	{ $with_front = 1; } else { $with_front = 0; }
				
			// page attributes (for page templates) are not used at this time but set in order to prevent errors	
			$page_attributes = 0;
					
			$update = $wpdb->query("UPDATE " . $ecpt_db_name . " SET 
				`name`='" 				. str_replace(' ', '', strtolower($_POST['posttype-name'])) . "', 
				`singular_name`='" 		. $single . "', 
				`plural_name`='" 		. $plural . "', 
				`title`='" 				. $title . "',
				`editor`='" 			. $editor . "',
				`author`='" 			. $author . "',
				`thumbnail`='" 			. $thumbnail . "',
				`excerpt`='" 			. $excerpt . "',
				`fields`='" 			. $fields . "',
				`comments`='" 			. $comments . "',
				`revisions`='" 			. $revisions . "',
				`has_archive`='" 		. $archives . "',
				`hierarchical`='" 		. $hierarchical . "',
				`post_formats`='" 		. $post_formats . "',
				`show_in_nav_menus`='"	. $nav . "',
				`exclude_from_search`='". $search . "',
				`menu_icon`='"			. $icon . "',
				`menu_position`='"		. $position . "',
				`slug`='"				. $slug . "',
				`with_front`='"			. $with_front . "',
				`post_tags`='"			. $tags . "',
				`categories`='"			. $categories . "'
				WHERE `id`='" 			. intval($_POST['posttype-id']) . "';"
			);
			
			// clear the post type cache
			ecpt_clear_cache('post_types');
			
			header ("Location:" . $_SERVER['HTTP_REFERER'] . '&post-type-updated=1');
			
		} // end post type update
		
		
		
		/* process taxonomy updates*/
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'update-taxonomy') {
			// taxonomy labels
			if($_POST['tax-singular'] != '') { $single = $_POST['tax-singular']; } else { $single = $_POST['tax-name']; }
			if($_POST['tax-plural'] != '') { $plural = $_POST['tax-plural']; } else { $plural = $_POST['tax-name']; }
			
			// check for checked options
			if(isset($_POST['tax-hierarchical'])) 	{ $hierarchical = 1; } else { $hierarchical = 0; }
			if(isset($_POST['tax-tagcloud'])) 		{ $show_tagcloud = 1; } else { $show_tagcloud = 0; }
			if(isset($_POST['tax-show-in-nav'])) 	{ $nav = 1; } else { $nav = 0; }
			if(isset($_POST['tax-with-front'])) 	{ $with_front = 1; } else { $with_front = 0; }
			if(isset($_POST['tax-enable-filter'])) 	{ $enable_filter = 1; } else { $enable_filter = 0; }
			
			// taxonomy objects
			$pages = array();
			foreach($_POST['tax-page'] as $page) { $pages[] = $page; };
			$pages_final = implode(',', $pages);
			
			// taxonomy slug
			if(!isset($_POST['tax-slug']) || $_POST['tax-slug'] == '') { 
				$slug = str_replace(' ', '_', strtolower($_POST['tax-name'])); 
			} else { 
				$slug = str_replace(' ', '_', strtolower($_POST['tax-slug']));  
			}
			
			$update = $wpdb->query("UPDATE " . $ecpt_db_tax_name . " SET 
					`name`='" 				. str_replace(' ', '', strtolower($_POST['tax-name'])) . "', 
					`page`='" 				. $pages_final . "', 
					`singular_name`='" 		. $single . "', 
					`plural_name`='" 		. $plural . "', 
					`hierarchical`='" 		. $hierarchical . "',
					`show_tagcloud`='" 		. $show_tagcloud . "',
					`show_in_nav_menus`='"	. $nav . "', 
					`slug`='"				. $slug . "',
					`with_front`='"			. $with_front . "', 
					`enable_filter`='"		. $enable_filter . "' 
					WHERE `id`='" 			. $_POST['tax-id'] . "';"
				);
						
			// clear the taxonomy cache
			ecpt_clear_cache('taxonomies');
						
			header ("Location:" . $_SERVER['HTTP_REFERER'] . '&taxonomy-updated=1');
		} // end taxonomy update
		
		
		
		/* process metabox updates */
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'update-metabox') {
			$update = $wpdb->query("UPDATE " . $ecpt_db_meta_name . " SET 
				`name`='" 		. str_replace(' ', '', strtolower($_POST['metabox-name'])) . "', 
				`nicename`='" 	. $_POST['metabox-name'] . "', 
				`page`='" 		. $_POST['metabox-page'] . "', 
				`context`='" 	. $_POST['metabox-context'] . "',
				`priority`='" 	. $_POST['metabox-priority'] . "' 
				WHERE `id`='" 	. $_POST['metabox-id'] . "';"
			);
			
			// if the name has been changed, we need to update the fields
			if($_POST['metabox-name'] != $_POST['metabox-old-name']) {
				// update each of the meta box field parent names
				foreach( $wpdb->get_results("SELECT * FROM " . $ecpt_db_meta_fields_name . " WHERE `parent`='" . $_POST['metabox-old-name'] . "';") as $key => $field) {
					$update_field = $wpdb->query("UPDATE " . $ecpt_db_meta_fields_name . " SET 
						`parent`= '" 		. str_replace(' ', '', strtolower($_POST['metabox-name'])) . "' 
						WHERE `id`='" 		. $field->id . "';"
					);
				}
			}
		
			// clear the cache
			ecpt_clear_cache('metaboxes');
		
			header ("Location:" . $_SERVER['HTTP_REFERER'] . '&metabox-updated=1');
		} // end metabox update
		
		
		
		/* process field updates*/
		if(isset($_POST['ecpt-action']) && $_POST['ecpt-action'] == 'update-field') {
				
			$existing_field = $wpdb->get_row("SELECT * FROM " . $ecpt_db_meta_fields_name . " WHERE nicename = '" . $_POST['field-name'] . "' AND id != '" . $_POST['field-id'] . "' ORDER BY id DESC LIMIT 1");
			
			if(isset($_POST['field-unique-id']) && strlen(trim($_POST['field-unique-id'])) > 0 ) {
				$field_id = str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-unique-id'])));
			} elseif($existing_field) {
				$existing_field_id_number = substr($existing_field->name, -1);
				if(is_numeric($existing_field_id_number)) {
					$new_number = intval($existing_field_id_number) + 1;
					$field_id = preg_replace('/[^a-zA-Z0-9!@#$"\'\/()\.,]/', '', str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-name'])))) . '_' . $new_number;
				} else {
					$field_id = preg_replace('/[^a-zA-Z0-9!@#$"\'\/()\.,]/', '', str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-name'])))) . '_2';
				}
			} else {
				$field_id = preg_replace('/[^a-zA-Z0-9!@#$"\'\/()\.,]/', '', str_replace(' ', '', str_replace('/', '', strtolower($_POST['field-name']))));
			}
				
			if(isset($_POST['rich-editor'])) 	{ $rich_editor = 1; } else { $rich_editor = 0; }
			
			$update = $wpdb->query("UPDATE " 			. $ecpt_db_meta_fields_name . " SET 
				`name`= '" 			. $field_id . "',
				`nicename`= '"		. utf8_decode($_POST['field-name']) . "', 
				`description`= '"	. addslashes($_POST['field-desc']) . "', 
				`type`='" 			. $_POST['field-type'] . "', 
				`options`='" 		. str_replace(', ', ',', $_POST['field-options']) . "', 
				`rich_editor`='" 	. $rich_editor . "', 
				`max`='" 			. $_POST['field-max'] . "' 
				WHERE `id`='" 		. $_POST['field-id'] . "';"
			);
			header ("Location:" . $_SERVER['HTTP_REFERER'] . '&field-updated=1');
		} // end meta field update	
	} 

	/*************************************
	* delete data
	*************************************/
	$ecpt_get = (!empty($_GET)) ? true : false;

	if($ecpt_get) // if data is being sent
	{
		/* delete post type */
		if(isset($_GET['ecpt-action']) && $_GET['ecpt-action'] == 'delete-posttype' && isset($_GET['posttype-id'])) {
			$remove = $wpdb->query("DELETE FROM " . $ecpt_db_name . " WHERE `id`='" . $_GET['posttype-id'] . "';");
			// clear the post type cache
			ecpt_clear_cache('post_types');
		}
		/* delete taxonomy */
		if(isset($_GET['ecpt-action']) && $_GET['ecpt-action'] == 'delete-taxonomy' && isset($_GET['tax-id'])) {
			$remove = $wpdb->query("DELETE FROM " . $ecpt_db_tax_name . " WHERE `id`='" . $_GET['tax-id'] . "';");
			// clear the taxonomy cache
			ecpt_clear_cache('taxonomies');
		}
		/* delete metabox */
		if(isset($_GET['ecpt-action']) && $_GET['ecpt-action'] == 'delete-metabox' && isset($_GET['metabox-id'])) {
			$remove = $wpdb->query("DELETE FROM " . $ecpt_db_meta_name . " WHERE `id`='" . $_GET['metabox-id'] . "';");
			$remove_fields = $wpdb->query("DELETE FROM " . $ecpt_db_meta_fields_name . " WHERE `parent`='" . $_GET['metabox-name'] . "';");
			// clear the cache
			ecpt_clear_cache('metaboxes');
		}
		/* delete field */
		if(isset($_GET['ecpt-action']) && $_GET['ecpt-action'] == 'delete-field' && isset($_GET['field-id'])) {
			$remove = $wpdb->query("DELETE FROM " . $ecpt_db_meta_fields_name . " WHERE `id`='" . $_GET['field-id'] . "';");
		}
	}
}
add_action('admin_init', 'ecpt_process_data');