<?php
/*
Plugin Name: IMO Wordpress Community
Plugin URI: http://www.imomags.com/
Description: Helps Setup Custom Post Types,User Permissions and Rewrites for a Wordpress-based photo community
Version: 0.1
Author: Aaron Baker
*/

register_activation_hook( __FILE__, 'imo_wordpress_community_flush' );
register_deactivation_hook( __FILE__, 'imo_wordpress_community_flush' );


function imo_wordpress_community_flush() {

	flush_rewrite_rules( false );
}

add_action('init', 'category_cpt_rewrites');
function category_cpt_rewrites() {

    $rule = "photos" . '/hunting/(.+?)/?$';
    $rewrite = 'index.php?post_type=' . "reader_photos" . '&category_name=$matches[1]';
    add_rewrite_rule($rule,$rewrite,'top');

    $rule = "photos" . '/hunting';
    $rewrite = 'index.php?post_type=' . "reader_photos" . '&category_name=hunting';
    add_rewrite_rule($rule,$rewrite,'top');

	$rule2 = "photos" . '/fishing/(.+?)/?$';
    $rewrite2 = 'index.php?post_type=' . "reader_photos" . '&category_name=$matches[1]';
    add_rewrite_rule($rule2,$rewrite2,'top');

    $rule = "photos" . '/fishing';
    $rewrite = 'index.php?post_type=' . "reader_photos" . '&category_name=fishing';
    add_rewrite_rule($rule,$rewrite,'top');


}


add_filter( 'wp_unique_post_slug', 'imo_wordpress_community_post_slug', 10, 4 );
function imo_wordpress_community_post_slug( $slug, $post_ID, $post_status, $post_type ) {

		if ($post_type == "reader_photos") {

			if (strpos($slug,"photo-") === FALSE && $post_ID == 0) {

				$slug = "photo-" . $slug;
			}

		}


    return $slug;
}




add_action('init', 'cptui_register_my_cpt_reader_photos');
function cptui_register_my_cpt_reader_photos() {
	register_post_type(
		'reader_photos', array(
			'label' => 'Reader Photos',
			'description' => 'Upload a photo to G&F!',
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
			  'name' => 'Reader Photos',
			  'singular_name' => 'Reader Photo',
			  'menu_name' => 'Reader Photos',
			  'add_new' => 'Add Reader Photo',
			  'add_new_item' => 'Add New Reader Photo',
			  'edit' => 'Edit',
			  'edit_item' => 'Edit Reader Photo',
			  'new_item' => 'New Reader Photo',
			  'view' => 'View Reader Photo',
			  'view_item' => 'View Reader Photo',
			  'search_items' => 'Search Reader Photos',
			  'not_found' => 'No Reader Photos Found',
			  'not_found_in_trash' => 'No Reader Photos Found in Trash',
			  'parent' => 'Parent Reader Photo',
			)
		)
	);


}