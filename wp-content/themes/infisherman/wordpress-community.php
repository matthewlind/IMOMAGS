<?php

register_activation_hook( __FILE__, 'imo_wordpress_community_flush' );
register_deactivation_hook( __FILE__, 'imo_wordpress_community_flush' );


//Wordpress Community Scripts Config
add_action("wp_enqueue_scripts","ff_wp_community_scripts");
function ff_wp_community_scripts() {
	$photos = get_post_type();
	
    if ( is_post_type_archive( "fish_head_photos" ) || $photos == "fish_head_photos" ) {

        wp_enqueue_script( 'bootstrap-dropdown', get_stylesheet_directory_uri() . '/js/bootstrap-dropdown.js', array("jquery",'underscore'), '0.1', true );
        wp_enqueue_script( 'gf-wp-community-listing', get_stylesheet_directory_uri() . '/js/community-listing.js', array("jquery",'underscore','bootstrap-dropdown'), '0.1', true );
    }
}


function imo_wordpress_community_flush() {

	flush_rewrite_rules( false );
}

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