<?php

register_activation_hook( __FILE__, 'imo_wordpress_community_flush' );
register_deactivation_hook( __FILE__, 'imo_wordpress_community_flush' );


function imo_wordpress_community_flush() {

	flush_rewrite_rules( false );
}

add_action('init', 'cptui_register_my_cpt_rack_room');
function cptui_register_my_cpt_rack_room() {
	register_post_type(
		'rack_room', array(
			'label' => 'Rack Room Photos',
			'description' => "Upload a photo to Petersen's Hunting",
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'capability_type' => 'rack_room',
			'map_meta_cap' => true,
			'hierarchical' => false,
			'rewrite' => array('slug' => 'rack-room'),
			'query_var' => true,
			'has_archive' => true,
			'supports' => array('title','editor','excerpt','trackbacks','custom-fields','comments','revisions','thumbnail','author','page-attributes'),
			'taxonomies' => array('category'),
			'labels' => array (
			  'name' => 'Rack Room Photos',
			  'singular_name' => 'Rack Room Photos',
			  'menu_name' => 'Rack Room Photos',
			  'add_new' => 'Add Rack Room Photos',
			  'add_new_item' => 'Add New Rack Room Photos',
			  'edit' => 'Edit',
			  'edit_item' => 'Edit Rack Room Photos',
			  'new_item' => 'New Rack Room Photos',
			  'view' => 'View Rack Room Photos',
			  'view_item' => 'View Rack Room Photos',
			  'search_items' => 'Search Rack Room Photos',
			  'not_found' => 'No Rack Room Photos Found',
			  'not_found_in_trash' => 'No Rack Room Photos Found in Trash',
			  'parent' => 'Parent Rack Room Photos',
			)
		)
	);


}