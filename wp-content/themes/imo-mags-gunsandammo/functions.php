<?php
/**
 * functions.php 
 */

define("JETPACK_SITE", "gunsammo");
define("DARTADGEN_SITE", "imo.gunsandammo");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0145V&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0145V&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0NVY0NDY5Mg=");
define("SUBS_DEAL_STRING", "Save 80%");
define("DRUPAL_SITE", TRUE);

if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}


// Add new image size for post lists
add_image_size('post-thumb', 226, 147, true);
add_image_size('post-slide', 640, 350, true);


// New excerpt ending
function ga_new_excerpt_more($more) {
  global $post;
 return '&nbsp;&hellip; ';
}
add_filter('excerpt_more', 'ga_new_excerpt_more');

function get_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

// Widget structure
function ga_imo_addons_sidebar_init() {
  
  register_nav_menus(array(
      'subnav' => __( 'Sub Navigation', 'carrington-business' ),
      'subnav-right' => __( 'Sub Navigation - Right', 'carrington-business' ),
  ));
  
  $sidebar_defaults = array(
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title"><span>',
    'after_title' => '</span></h3>'
  );
  
  register_sidebar(array_merge($sidebar_defaults, array(
    'id' => 'sidebar-default',
    'name' => 'Blog Sidebar',
    'Shown on blog posts and archives.'
  )));

  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'header-slot',
      'name' => 'Header Slot',
      'description' => 'Shown on the right of the logo.',
  )));

  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-home',
      'name' => __('Homepage Sidebar', 'carrington-business'),
      'description' => __('Shown on the homepage.', 'carrington-business')
  )));
  
  register_sidebar(array_merge($sidebar_defaults, array(
    'id' => 'secondary-home',
    'name' => __('Homepage Secondary', 'carrington-business'),
    'description' => __('area below main and sidebar columns on the homepage', 'carrington-business')
  )));

  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-landing',
      'name' => __('Landing Page Sidebar', 'carrington-business'),
      'description' => __('Shown on Landing Pages.', 'carrington-business')
  )));	

  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-video',
      'name' => __('Video Sidebar', 'carrington-business'),
      'description' => __('Shown on video posts.', 'carrington-business')
  )));
  
  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-gallery',
      'name' => __('Gallery Sidebar', 'carrington-business'),
      'description' => __('Sidebar for Gallery posts.', 'carrington-business')
  )));
  
  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-articles',
      'name' => __('Article Sidebar', 'carrington-business'),
      'description' => __('Shown on article posts.', 'carrington-business')
  )));
      
   register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-digmag-article',
      'name' => __('DIGMAG Article Sidebar', 'carrington-business'),
      'description' => __('Shown on DIGMAG article posts.', 'carrington-business')
  )));

  register_sidebar(array_merge($sidebar_defaults, array(
      'name' => 'Bonus Sidebar',
      'id'   => 'bonus_sidebar',
      'description'   => 'Appears on pages that use the Right Sidebar template',
  )));

}
add_action( 'widgets_init', 'ga_imo_addons_sidebar_init' );


function ga_cfct_widgets_init() {
  $sidebar_defaults = array(
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title"><span>',
    'after_title' => '</span></h3>'
  );
  register_sidebar(array_merge($sidebar_defaults, array(
		'id' => 'sidebar-default',
		'name' => __('Blog Sidebar', 'carrington-business'),
		'description' => __('Shown on blog posts and archives.', 'carrington-business')
	)));
	register_sidebar(array_merge($sidebar_defaults, array(
		'id' => 'sidebar-news',
		'name' => __('News Sidebar', 'carrington-business'),
		'description' => __('Shown on news pages and archives.', 'carrington-business')
	)));	
}
add_action( 'widgets_init', 'gupnp_service_action_get(action, name, type)cfct_widgets_init' );


include_once get_stylesheet_directory().'/widgets/newsletter-signup.php';
include_once get_stylesheet_directory().'/widgets/ipad-app.php';
include_once get_stylesheet_directory().'/widgets/caption-contest.php';


// SHORTCODES
/*
 * [mm-current-issue]
 *
 * For use with the UberMenu plugin.
 *
 */
function mm_current_issue($atts, $content = null) {
	extract(shortcode_atts(array(
    "" => ""
	), $atts));
	
	$magazine_img = get_option("magazine_cover_uri", get_stylesheet_directory_uri(). "/img/magazine.png" );
  if (empty($magazine_img)) {
      $magazine_img = get_stylesheet_directory_uri(). "/img/magazine.png";
  }
	
	return '<div class="current-issue">
	        <h3 class="month">November 2011</h3>
	        <img src="'.$magazine_img.'" alt />
	        </div>
	        <ul class="subscriber-links">
	        <li class="subscribe"><a href="'.SUBS_LINK.'">Subscribe</a></li>
	        <li><a href="'.SUBS_LINK.'">Give a Gift</a></li>
          <li><a href="'.SERVICE_LINK.'">Subscriber Services</a></li>
	        </ul>';
}
add_shortcode("mm-current-issue", "mm_current_issue");


