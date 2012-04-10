<?php
/**
 * functions.php 
 */

define("JETPACK_SITE", "flsportsman");
define("DARTADGEN_SITE", "imo.floridasportsman");
define("USE_IFRAME_ADS",FALSE);
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0146F&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0146F&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0NkY0NDA2OCZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 70% off<br> the Cover Price");
define("GOOGLE_FONT", "http://fonts.googleapis.com/css?family=Bitter");




/**
 * Define Region Custom Taxonomy
 */
function fs_region_init() {
    $labels = array(
        'name' => _x( 'Regions', 'taxonomy general name' ),
        'singular_name' => _x( 'Region', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Regions' ),
        'all_items' => __( 'All Regions' ),
        'parent_item' => __( 'Parent Region' ),
        'parent_item_colon' => __( 'Parent Region:' ),
        'edit_item' => __( 'Edit Region' ), 
        'update_item' => __( 'Update Region' ),
        'add_new_item' => __( 'Add New Region' ),
        'new_item_name' => __( 'New Region Name' ),
        'menu_name' => __( 'Region' ),
    );
    register_taxonomy(
        "region",
        "post",
         array(
            "labels" => $labels,
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => True,
            "rewrite" => array("slug"=>"region"),
        )
    );
    
    //default configuration from carrington build
    $sidebar_settings = array(
        'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
		'id' => 'sidebar-region',
		'name' => __('Region Sidebar', 'carrington-business'),
		'description' => __('Shown on Region Pages.', 'carrington-business')
    );
    register_sidebar($sidebar_settings);	
    /** Removes bad selectors from CSS PIE; affects IE7 and IE8 **/
     css3pie_remove(".cfct-module.style-b, .cfct-module.style-b .cfct-mod-title");
}
add_action("init", "fs_region_init");


/**
 * Adds widget area to Featured Sidget
 */
if (function_exists('register_sidebar')) {
register_sidebar(array(
 'name' => 'FS Featured Area',
 'id'   => 'fs_featured_area',
 'description'   => 'Right side of FS featured slider',
 'before_widget' => '<div id="fs_featured_area">',
 'after_widget'  => '</div>',
 'before_title'  => '<h2>',
 'after_title'   => '</h2>'
 ));
 
 

}
if (function_exists('register_sidebar')) {
register_sidebar(array(
        'id' => 'sidebar-reeltime',
        'name' => 'FS Reel Time Sidebar',
        'description' => 'Shown on FS Reel Time Pages.',
        'before_widget' => '<div id="bonus-area">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
}
if (function_exists('register_sidebar')) {
register_sidebar(array(
        'id' => 'sidebar-fstv',
        'name' => 'FSTV Sidebar',
        'description' => 'Shown on FSTV Pages.',
        'before_widget' => '<div id="bonus-area">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
}
if (function_exists('register_sidebar')) {
register_sidebar(array(
        'id' => 'sidebar-fs-challenge',
        'name' => 'FS Challenge Sidebar',
        'description' => 'Shown on FS Challenge Pages.',
        'before_widget' => '<div id="bonus-area">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
}
if (function_exists('register_sidebar')) {
register_sidebar(array(
        'id' => 'sidebar-imafs',
        'name' => 'Im A Florida Sportsman Sidebar',
        'description' => 'Shown on Im A Florida Sportsman Pages.',
        'before_widget' => '<div id="bonus-area">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
}

/*New Menu for REEL TIME*/

add_action( 'init', 'register_rt_menu' );

function register_rt_menu() {
	register_nav_menu( 'reeltime-menu', __( 'REEL TIME Menu' ) );
}
/*New Menu for FSTV*/

add_action( 'init', 'register_fstv_menu' );

function register_fstv_menu() {
	register_nav_menu( 'fstv-menu', __( 'FSTV Menu' ) );
}
/*New Menu for FS Challenge*/

add_action( 'init', 'register_fs_challenge_menu' );

function register_fs_challenge_menu() {
	register_nav_menu( 'fs-challenge-menu', __( 'FS Challenge Menu' ) );
}
/*New Menu for I'm A Florida Sportsman*/

add_action( 'init', 'register_imafs_menu' );

function register_ima_fs_menu() {
	register_nav_menu( 'imafs-menu', __( 'Im A FS Menu' ) );
}