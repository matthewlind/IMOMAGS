<?php 

include("functions/profile.php");
include("plus/functions-plus.php");

// Thumbs
add_image_size('medium-thumb', 420, 330, true);
add_image_size('huge-thumb', 672, 407, true);
add_image_size('gear-thumb', 250, 250, true);
add_image_size('video-widget-thumb', 318, 228, true);
add_image_size('gallery-thumb', 'auto', 169, true);

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
	        <h3 class="month">August 2012</h3>
	        <img src="'.$magazine_img.'" alt />
	        </div>
	        <ul class="subscriber-links">
	        <li class="subscribe"><a href="'."http://subs.northamericanwhitetail.com/".'">Subscribe</a></li>
	        <li><a href="'."http://subs.northamericanwhitetail.com/gift".'">Give a Gift</a></li>
          <li><a href="'."https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0OEQ0NDcyNCZpVHlwZT1FTlRFUg==".'">Subscriber Services</a></li>
	        </ul>';
}

add_shortcode("mm-current-issue", "mm_current_issue");


/***
**
** Enqueue Scripts
**
***/
function naw_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );

    wp_enqueue_script("jquery-simplemodal", get_stylesheet_directory_uri() . "/js/jquery.simplemodal.1.4.2.min.js");
    wp_enqueue_script("cross-site-feed", get_stylesheet_directory_uri() . "/js/cross-site-feed.js");
    wp_enqueue_script("local-site-feed", get_stylesheet_directory_uri() . "/js/local-site-feed.js");

}    
 
add_action('wp_enqueue_scripts', 'naw_scripts_method');

// Widget structure
function naw_imo_addons_sidebar_init() {
  
  $sidebar_defaults = array(
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title"><span>',
    'after_title' => '</span></h3>'
  );
  
  register_sidebar(array_merge($sidebar_defaults, array(
    'id' => 'sidebar-default',
    'name' => 'Sidebar Default',
    'Shown on blog posts and archives.'
  )));

  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-home-top',
      'name' => __('Top Homepage Sidebar', 'carrington-business'),
      'description' => __('Shown on the top right of the homepage.', 'carrington-business')
  )));
  
  register_sidebar(array_merge($sidebar_defaults, array(
      'id' => 'sidebar-home-bottom',
      'name' => __('Bottom Homepage Sidebar', 'carrington-business'),
      'description' => __('Shown on the bottom right of the homepage.', 'carrington-business')
  )));
  register_sidebar(array_merge($sidebar_defaults, array(
    'id' => 'gear-home',
    'name' => __('Homepage Gear Slider', 'carrington-business'),
    'description' => __('Gear slider near bottom of the homepage', 'carrington-business')
  )));
  register_sidebar(array_merge($sidebar_defaults, array(
    'id' => 'secondary-home',
    'name' => __('Homepage Secondary', 'carrington-business'),
    'description' => __('area below main and sidebar columns on the homepage', 'carrington-business')
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
    
}
add_action( 'widgets_init', 'naw_imo_addons_sidebar_init' );


include_once get_stylesheet_directory().'/widgets/newsletter-signup.php';
include_once get_stylesheet_directory().'/widgets/join.php';
include_once get_stylesheet_directory().'/widgets/video-callout.php';
include_once get_stylesheet_directory().'/widgets/gallery-loop.php';





