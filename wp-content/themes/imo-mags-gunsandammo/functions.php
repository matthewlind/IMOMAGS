<?php
/**
 * functions.php 
 */

define("JETPACK_SITE", "gunsammo");
define("DARTADGEN_SITE", "imo.gunsandammo");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0145V&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0145V&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0NVY0NDY5Mg=");
define("SUBS_DEAL_STRING", "Save Over 80% off<br/> the Cover Price");
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

/*New Menu for TV*/

add_action( 'init', 'register_rt_menu' );

function register_rt_menu() {
	register_nav_menu( 'tv-menu', __( 'TV Menu' ) );
}

/*CLOSED*/

if (function_exists('register_sidebar')) {
register_sidebar(array(
'id' => 'sidebar-tv',
'name' => 'TV Sidebar',
'description' => 'Shown on GA TV Pages.',
'before_widget' => '<div id="bonus-area">',
'after_widget' => '</div>',
'before_title' => '<h2>',
'after_title' => '</h2>'
));
}
