<?php
/**
 * functions.php 
 */
 
add_image_size('huge-thumb', 646, 400, true); 

define("JETPACK_SITE", "phunting");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0144V&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0144V&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0144V&i4Ky=IBZN");
define("SUBS_DEAL_STRING", "Save Over 80% off<br/> the Cover Price");
define("DRUPAL_SITE", TRUE);

function my_connection_types() {
	// Make sure the Posts 2 Posts plugin is active.
	if ( !function_exists( 'p2p_register_connection_type' ) )
		return;

	p2p_register_connection_type( array(
		'name' => 'columnists-to-columnistposts',
		'from' => 'columnists',
		'to' => 'columnistposts'
	) );
}
add_action( 'wp_loaded', 'my_connection_types' );

/***
**
** Enqueue Scripts
**
***/
function my_scripts_method() {
      wp_enqueue_script("cross-site-feed", get_stylesheet_directory_uri() . "/js/cross-site-feed.js");
      wp_enqueue_script("scrollface", get_stylesheet_directory_uri() . "/js/jquery.scrollface.min.js");
}    
 
add_action('wp_enqueue_scripts', 'my_scripts_method');

function ph_imo_addons_sidebar_init() {
	$sidebar_defaults = array(
	    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	    'after_widget' => '</aside>',
	    'before_title' => '<h3 class="widget-title"><span>',
	    'after_title' => '</span></h3>'
    );

	register_sidebar(array_merge($sidebar_defaults, array(
		'name' => 'Shot Show Sidebar',
		'id' => 'shot-show-sidebar',
		'description' => 'Shot Show Sidebar',
	)));
}
add_action( 'widgets_init', 'ph_imo_addons_sidebar_init' );
?>