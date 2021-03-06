<?php
/**
 * functions.php 
 */

define("JETPACK_SITE", "gamefish");
define("DARTADGEN_SITE", "imo.gameandfish");
define("USE_IFRAME_ADS",FALSE);
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=01488&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=01488&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0ODg0NDcwNSZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 70% off<br/> the Cover Price");

	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 100, 9999 ); // Unlimited height, soft crop
    add_image_size( 'index-thumb', 200, 150, true );
    add_image_size( 'legacy-thumb', 190, 120, true );
    add_image_size( 'post-thumb', 700, 450, true );
    add_image_size( 'post-home-thumb', 695, 380, true );
    add_image_size( 'post-home-small-thumb', 335, 225, true );
/**
 * Register widgetized areas
 * @uses register_sidebar
 */
function gf_widgets_init() {
	$sidebar_defaults = array(
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>'
	);

	register_sidebar(array_merge($sidebar_defaults, array(
		'id' => 'sidebar-default',
		'name' => __('Blog Sidebar', 'carrington-business'),
		'description' => __('Shown on blog posts and archives.', 'carrington-business')
	)));
	register_sidebar(array_merge($sidebar_defaults, array(
		'id' => 'sidebar-crown',
		'name' => __('Crown Royal Sidebar', 'carrington-business'),
		'description' => __('Shown on custom post type: photo_contest', 'carrington-business')
	)));
	register_sidebar(array_merge($sidebar_defaults, array(
		'id' => 'sidebar-news',
		'name' => __('News Sidebar', 'carrington-business'),
		'description' => __('Shown on news pages and archives.', 'carrington-business')
	)));
	register_sidebar(array_merge($sidebar_defaults, array(
		'id' => 'sidebar-sweeps',
		'name' => __('Sweeps Sidebar', 'carrington-business'),
		'description' => __('Shown on sweeps pages', 'carrington-business')
	)));
	
	// Modify args for footer
	$footer_defaults = array_merge($sidebar_defaults, array(
		'before_widget' => '<aside id="%1$s" class="widget style-f clearfix %2$s">',
		'after_widget' => '</aside>'
	));
	register_sidebar(array_merge($footer_defaults, array(
		'id' => 'footer-a',
		'name' => __('Footer (left)', 'carrington-business'),
		'description' => __('Customizable footer area on the left.', 'carrington-business')
	)));
	register_sidebar(array_merge($footer_defaults, array(
		'id' => 'footer-b',
		'name' => __('Footer (center)', 'carrington-business'),
		'description' => __('Customizable footer area in the middle.', 'carrington-business')
	)));
	register_sidebar(array_merge($footer_defaults, array(
		'id' => 'footer-c',
		'name' => __('Footer (right)', 'carrington-business'),
		'description' => __('Customizable footer area on the right.', 'carrington-business')
	)));
}
add_action( 'widgets_init', 'gf_widgets_init' );


include_once get_stylesheet_directory().'/widgets/us-map.php';

