<?php 

function ecpt_register_post_types() {
	global $ecpt_options;
	
	$ecpt_post_types = ecpt_get_cached_post_types();
	
	foreach( $ecpt_post_types as $key => $type) {
		$labels = array(
			'name' 				=> _x( $type->plural_name, 'post type general name' ),
			'singular_name'		=> _x( $type->singular_name, 'post type singular name' ),
			'add_new' 			=> _x( 'Add New ' . $type->singular_name, $type->singular_name),
			'add_new_item' 		=> __( 'Add New ' . $type->singular_name ),
			'edit_item' 		=> __( 'Edit ' . $type->singular_name ),
			'new_item' 			=> __( 'New ' . $type->singular_name ),
			'view_item' 		=> __( 'View ' . $type->singular_name ),
			'search_items' 		=> __( 'Search ' . $type->plural_name ),
			'not_found' 		=> __( 'No ' . $type->plural_name . ' found' ),
			'not_found_in_trash'=> __( 'No ' . $type->plural_name . ' found in Trash' ),
			'parent_item_colon' => ''
		);

		if($type->hierarchical == 1) { $hierarchical = true; } else { $hierarchical = false; } 
		if($type->has_archive == 1) { $archive = true; } else { $archive = false; } 
		if($type->exclude_from_search == 1) { $search = false; } else { $search = true; } 
		if($type->with_front == 1) { $with_front = false; } else { $with_front = true; } 
		
		// show in nav menus is not working right now, so all post types are shown
		if($type->show_in_nav_menus == 1) 	{ $show_in_menus = true; } else { $show_in_menus = false; }
		
		// check for supports options
		$supports = array();
		if($type->title == 1) 				{ $supports[] = 'title'; }
		if($type->editor == 1) 				{ $supports[] = 'editor'; }
		if($type->author == 1) 				{ $supports[] = 'author'; }
		if($type->thumbnail == 1) 			{ $supports[] = 'thumbnail'; }
		if($type->excerpt == 1) 			{ $supports[] = 'excerpt'; }
		if($type->fields == 1) 				{ $supports[] = 'custom-fields'; }
		if($type->comments == 1) 			{ $supports[] = 'comments'; }
		if($type->revisions == 1) 			{ $supports[] = 'revisions'; }
		if($type->post_formats == 1) 		{ $supports[] = 'post-formats'; }
		if($type->hierarchical == 1) 		{ $supports[] = 'page-attributes'; }
		
		// check for default taxonomies
		$taxonomies = array();
		if($type->post_tags == 1) 			{ $taxonomies[] = 'post_tag'; }
		if($type->categories == 1) 			{ $taxonomies[] = 'category'; }
		
		$custom_taxonomies = get_object_taxonomies($type->name);
		if($custom_taxonomies) {
			foreach($custom_taxonomies as $tax) {
				$taxonomies[] = $tax;
			}
		}

		// convert menu position to an int
		$position = (int)$type->menu_position;
		
		if($type->menu_icon != '' && $type->menu_icon != 'undefined' )	{ $icon = $type->menu_icon; } else { $icon = ''; }
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __($type->singular_name),
			'public'			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> $type->name,
			'capability_type' 	=> 'post',
			'has_archive' 		=> $archive,
			'hierarchical' 		=> $hierarchical,
			'exclude_from_search' => $search,
			'rewrite' 			=> array('slug' => $type->slug, 'with_front' => $with_front ),
			'supports' 			=> $supports,
			'menu_position' 	=> $position,
			'show_in_nav_menus' => $show_in_menus,
			'menu_icon' 		=> $icon,
			'taxonomies'		=> $taxonomies
		 );
		 
		if(isset($ecpt_options['create_single_templates']) && $ecpt_options['create_single_templates'] == true) {
			 // create a template file for the single post type if it doesn't exist
			 if(!file_exists(get_stylesheet_directory() . '/single-' . $type->name . '.php')) {
				if(file_exists(get_stylesheet_directory() . '/single.php')) {
					copy(get_stylesheet_directory() . '/single.php', get_stylesheet_directory() . '/single-' . $type->name . '.php');
				} else {
					if(file_exists(get_stylesheet_directory() . '/index.php')) {
						// copy index.php if single.php doesn't exist
						copy(get_stylesheet_directory() . '/index.php', get_stylesheet_directory() . '/single-' . $type->name . '.php');
					}
				}
			 }
		}
		if(isset($ecpt_options['create_archive_templates']) && $ecpt_options['create_archive_templates'] == true) {
			// create a template file for the single post type if it doesn't exist
			if(!file_exists(get_stylesheet_directory() . '/archive-' . $type->name . '.php')) {
				// first check for archive.php in the current theme dir
				if(file_exists(get_stylesheet_directory() . '/archive.php')) {
					copy(get_stylesheet_directory() . '/archive.php', get_stylesheet_directory() . '/archive-' . $type->name . '.php');
				// if it didn't exist, check the parent theme directory
				} elseif(file_exists(get_template_directory() . '/archive.php')) {				
					copy(get_template_directory() . '/archive.php', get_stylesheet_directory() . '/archive-' . $type->name . '.php');
				// if both of the above failed, check for an index.php
				} else {
					// first look in the current theme dir
					if(file_exists(get_stylesheet_directory() . '/index.php')) {
						// copy index.php if archive.php doesn't exist
						copy(get_stylesheet_directory() . '/index.php', get_stylesheet_directory() . '/archive-' . $type->name . '.php');
					// if not found, check the parent theme dir
					} elseif (file_exists(get_stylesheet_directory() . '/index.php')) {
						copy(get_template_directory() . '/index.php', get_stylesheet_directory() . '/archive-' . $type->name . '.php');
					}
				}
			}
		}	
		// register the post type
		register_post_type($type->name, $post_type_args);
	}
}
add_action('init', 'ecpt_register_post_types', 20);

