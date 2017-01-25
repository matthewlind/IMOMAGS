<?php

add_action('init', 'cptui_register_my_cpt_fish_head_photos');
function cptui_register_my_cpt_fish_head_photos() {
	register_post_type(
		'fish_head_photos', array(
			'label' => 'FishHead Photos',
			'description' => 'Upload a photo to In Fisherman!',
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'reader_post',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array('slug' => 'photos'),
			'query_var' => true,
			'has_archive' => true,
			'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes'),
			'taxonomies' => array('category'),
			'labels' => array (
			  'name' => 'FishHead Photos',
			  'singular_name' => 'Reader Photo',
			  'menu_name' => 'FishHead Photos',
			  'add_new' => 'Add Reader Photo',
			  'add_new_item' => 'Add New Reader Photo',
			  'edit' => 'Edit',
			  'edit_item' => 'Edit Reader Photo',
			  'new_item' => 'New Reader Photo',
			  'view' => 'View Reader Photo',
			  'view_item' => 'View Reader Photo',
			  'search_items' => 'Search FishHead Photos',
			  'not_found' => 'No FishHead Photos Found',
			  'not_found_in_trash' => 'No FishHead Photos Found in Trash',
			  'parent' => 'Parent Reader Photo',
			)
		)
	);


}