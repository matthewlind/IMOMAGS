<?php
define("FACEBOOK_LINK", "https://www.facebook.com/GunDogMag");
define("TWITTER_LINK", "https://www.twitter.com/@gundogmag");
define("RSS_LINK", "http://www.gundogmag.com/feed/");
define("SITE_LINK", "gundogmag.com");
define("SITE_NAME", "Gun Dog Magazine");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=014HS&i4Ky=IBZN");


add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/css/redesign/allpages.css' );

}
add_action('init', 'cptui_register_my_cpt_reader_photos');
function cptui_register_my_cpt_reader_photos() {
	register_post_type(
		'reader_photos', array(
			'label' => 'Reader Photos',
			'description' => 'Upload a photo',
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
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_photos',
		'title' => 'Photos',
		'fields' => array (
			array (
				'key' => 'field_55805a9ca937f',
				'label' => 'Photos Menu',
				'name' => 'photos_menu',
				'type' => 'taxonomy',
				'taxonomy' => 'category',
				'field_type' => 'checkbox',
				'allow_null' => 0,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'acf-options',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
