<?php


// create custom plugin settings menu
add_action('admin_menu', 'ecpt_menu');
function ecpt_menu() {
	global $ecpt_options, $ecpt_base_file;
	
	// check the user levels needed to access each page
	
	if($ecpt_options['menu_user_level'] == 'Author') { 
		$menu_level = 'edit_posts'; $posts_level = 'edit_posts'; $tax_level = 'edit_posts'; $meta_level = 'edit_posts';
	} else if ($ecpt_options['menu_user_level'] == 'Editor') { 
		$menu_level = 'edit_pages'; $posts_level = 'edit_pages'; $tax_level = 'edit_pages'; $meta_level = 'edit_pages';
	} else { 
		$menu_level = 'manage_options'; $posts_level = 'manage_options'; $tax_level = 'manage_options'; $meta_level = 'manage_options'; 
	}	
	
	if($ecpt_options['posttype_user_level'] == 'Author' && (($ecpt_options['menu_user_level'] != 'Editor') && ($ecpt_options['menu_user_level'] != 'Admin'))) { 
		$posts_level = 'edit_posts'; 
	} else if ($ecpt_options['posttype_user_level'] == 'Editor' && ($ecpt_options['menu_user_level'] != 'Admin')) { 
		$posts_level = 'edit_pages'; 
	} else { 
		$posts_level = 'manage_options'; 
	}
	
	if($ecpt_options['tax_user_level'] == 'Author' && (($ecpt_options['menu_user_level'] != 'Editor') && ($ecpt_options['menu_user_level'] != 'Admin'))) { 
		$tax_level = 'edit_posts'; 
	} else if ($ecpt_options['tax_user_level'] == 'Editor' && ($ecpt_options['menu_user_level'] != 'Admin')) { 
		$tax_level = 'edit_pages'; 
	} else { 
		$tax_level = 'manage_options'; 
	}
	//echo $tax_level; exit;
	
	if($ecpt_options['metabox_user_level'] == 'Author' && (($ecpt_options['menu_user_level'] != 'Editor') && ($ecpt_options['menu_user_level'] != 'Admin'))) { 
		$meta_level = 'edit_posts'; 
	} else if ($ecpt_options['metabox_user_level'] == 'Editor' && ($ecpt_options['menu_user_level'] != 'Admin')) { 
		$meta_level = 'edit_pages'; 
	} else { 
		$meta_level = 'manage_options'; 
	}
	
	//create new top-level menu
	add_menu_page('Custom Content Types', 'Content Types', $menu_level, $ecpt_base_file, 'ecpt_home_page', plugins_url('/images/icon.png', __FILE__));
	
	// add about page -- top level page links here
	add_submenu_page($ecpt_base_file, 'About', 'About',$menu_level, $ecpt_base_file, 'ecpt_home_page');	
	
	
	// add custom post types page
	add_submenu_page($ecpt_base_file, __('Post Types', 'ecpt'), __('Post Types', 'ecpt'), $posts_level, $ecpt_base_file . '?posttypes', 'ecpt_posttype_manager');	
	
	// add custom taxonomies page
	add_submenu_page($ecpt_base_file, __('Taxonomies', 'ecpt'), __('Taxonomies', 'ecpt'), $tax_level, $ecpt_base_file . '?taxonomies', 'ecpt_tax_manager');	

	// add custom metaboxes page
	add_submenu_page($ecpt_base_file, __('MetaBoxes', 'ecpt'), __('Meta Boxes', 'ecpt'),$meta_level, $ecpt_base_file . '?metaboxes', 'ecpt_metabox_manager');	
	
	// add settings page
	add_submenu_page($ecpt_base_file, __('Settings', 'ecpt'), __('Settings', 'ecpt'),'manage_options', $ecpt_base_file . '?settings', 'ecpt_settings_page');		
	
	// add export page
	add_submenu_page($ecpt_base_file, __('Export', 'ecpt'), __('Export', 'ecpt'),'manage_options', $ecpt_base_file . '?export', 'ecpt_export_page');		
	
	// add help page
	add_submenu_page($ecpt_base_file, __('Help', 'ecpt'), __('Help', 'ecpt'), $menu_level, $ecpt_base_file . '?help', 'ecpt_help_page');	
	
}