<?php
/**
 * functions.php 
 */

define("JETPACK_SITE", "flyfisherman");

define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0142A&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0142A&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0MkE0NDY5MyZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 55% off<br/> the Cover Price");
define("DRUPAL_SITE", TRUE);

/**
 * Define FF Blogs Custom Taxonomy
 */
function ffblogs_init() {
    $labels = array(
        'name' => _x( 'FF Blogs', 'taxonomy general name' ),
        'singular_name' => _x( 'FF Blog', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search FF Blogs' ),
        'all_items' => __( 'All FF Blogs' ),
        'parent_item' => __( 'Parent FF Blog' ),
        'parent_item_colon' => __( 'Parent FF Blog:' ),
        'edit_item' => __( 'Edit FF Blog' ), 
        'update_item' => __( 'Update FF Blog' ),
        'add_new_item' => __( 'Add New FF Blog' ),
        'new_item_name' => __( 'New FF Blog' ),
        'menu_name' => __( 'FF Blogs' ),
    );
    register_taxonomy(
        'ffblogs',
        'post',
         array(
            'labels' => $labels,
            'hierarchical' => True,
            'show_ui' => True,
            'query_var' => True,
            'rewrite' => array('slug'=>'ffblogs'),
        )
    );
    
    /** Removes bad selectors from CSS PIE; affects IE7 and IE8 **/
     css3pie_remove('.cfct-module.style-b, .cfct-module.style-b .cfct-mod-title');
}
add_action('init', 'ffblogs_init');