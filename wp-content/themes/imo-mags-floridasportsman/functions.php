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
            "rewrite" => array("slug"=>"regions"),
        )
    );
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

