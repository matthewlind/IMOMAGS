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


// New excerpt ending
// function new_excerpt_more($more) {
//   global $post;
//  return '&nbsp;&hellip; ';
// }
// add_filter('excerpt_more', 'new_excerpt_more');


// Widget structure
if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'before_widget' => '<aside id="%1$s" class="widget %2$s"></aside>',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget_title"><span>',
    'after_title' => '</span></h3>',
));
