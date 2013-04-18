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

function boldwater_excerpt_length($length) {
    
	return 20;

}

if ( ! function_exists( 'cfct_setup' ) ) {
	function cfct_setup() {
		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
		
		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );
		// Width, Height, Crop
		set_post_thumbnail_size( 150, 100, true );
		// Image sizes to support Carousel
		add_image_size('post-image-large', 584, 370, true);
		add_image_size('post-image-medium', 426, 270, true);
		add_image_size('post-image-small', 268, 170, true);

		register_nav_menus(array(
			'main' => __( 'Main Navigation', 'carrington-business' ),
			'featured' => __( 'Featured Navigation', 'carrington-business' ),
			'footer' => __( 'Footer Navigation', 'carrington-business' )
		));
		
		if (!is_admin()) {
			wp_enqueue_script('carrington-business', get_bloginfo('template_directory') . '/js/master.js', array('jquery'), CFCT_URL_VERSION);
			wp_enqueue_script('carrington-business-custom', get_bloginfo('template_directory') . '/js/custom.js', array('jquery'), CFCT_URL_VERSION);
		}
		
		// Enqueue child styles at theme setup (allow child themes to override)
		if (is_child_theme() && !is_admin()) {
			wp_enqueue_style('carrington-business', get_bloginfo('stylesheet_url'), array(), CFCT_URL_VERSION, 'screen');
            add_filter('excerpt_length', 'boldwater_excerpt_length');
		}
		
		// Attach CSS3PIE behavior to the following elements
		css3pie_enqueue('#main-content, #main-content .str-content, #masthead, #footer-content, #footer-content .str-content, nav.nav li ul, .cfct-module.style-b, .cfct-module.style-b .cfct-mod-title, .cfct-module.style-c, .cfct-module.style-d, .cft-module.style-d .cfct-mod-title, .cfct-notice, .notice, .cfct-pullquote, .cfct-module-image img.cfct-mod-image, .cfct-module-hero, .cfct-module-hero-image, .wp-caption, .loading span, .cfct-block-abc .cfct-module-carousel, .cfct-block-abc .cfct-module-carousel, .carousel, .cfct-block-abc .cfct-module-carousel .car-content');
	}
}
add_action( 'after_setup_theme', 'cfct_setup' );




/**
* ADD SIDEBARS
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
        'id' => 'sidebar-fs-sportfish',
        'name' => 'FS Sportfish Sidebar',
        'description' => 'Shown on FS Sportfish Pages.',
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
if (function_exists('register_sidebar')) {
register_sidebar(array(
        'id' => 'sidebar-picofday',
        'name' => 'Daily Photo Sponsor',
        'description' => 'Sponsor Logo and Link for Daily Photo Gallery',
        'before_widget' => '<div id="picofday-sidebar">',
        'after_widget'  => '</div>',
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

/*New Menu for FS Sportfish*/

add_action( 'init', 'register_fs_sportfish_menu' );

function register_fs_sportfish_menu() {
	register_nav_menu( 'fs-sportfish-menu', __( 'FS Sportfish Menu' ) );
}

/* New Menu for I'm A Florida Sportsman*/

add_action( 'init', 'register_ima_fs_menu' );

function register_ima_fs_menu() {
    register_nav_menu( 'imafs-menu', __( 'Im A FS Menu' ) );
}


/**
 * Run the following tasks on init
 * Keep Carrington Build styles out of the front-end. We'll add our own.
 */
 
function my_theme_remove_build_css() {
	wp_deregister_style('cfct-build-css');
}
add_action('init', 'my_theme_remove_build_css');

/* Remove Category Dropdown from Edit Screen */

add_action( 'load-edit.php', 'no_category_dropdown' );
function no_category_dropdown() {
    add_filter( 'wp_dropdown_cats', '__return_false' );
}



function convert_id_to_term_in_query($query) {
		global $pagenow;
		$post_type = 'post'; // change HERE
		$taxonomy = 'column'; // change HERE
		$q_vars = &$query->query_vars;
		if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
			$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			$q_vars[$taxonomy] = $term->slug;
		}
	}

	add_filter('parse_query', 'convert_id_to_term_in_query');

function ilc_cpt_columns($defaults) {

    $defaults['region'] = 'Regions';
    $defaults['column'] = 'Columns';
    $defaults['activity'] = 'Activities';
    return $defaults;
}


function ilc_cpt_custom_column($column_name, $post_id) {

    $taxonomy = $column_name;
    $post_type = get_post_type($post_id);
    $terms = get_the_terms($post_id, $taxonomy);
    
    if ( !empty($terms) ) {
        foreach ( $terms as $term )
            $post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
        echo join( ', ', $post_terms );
    }
    else echo '<i>No terms</i>';
}


function wp_title_multitax($sep = '&raquo;', $display = true, $seplocation = '') {
    global $wpdb, $wp_locale;

    $m = get_query_var('m');
    $year = get_query_var('year');
    $monthnum = get_query_var('monthnum');
    $day = get_query_var('day');
    $search = get_query_var('s');
    $title = '';

    $t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary

    // If there is a post
    if ( is_single() || ( is_home() && !is_front_page() ) || ( is_page() && !is_front_page() ) ) {
        $title = single_post_title( '', false );
    }

    // If there's a category or tag
    if ( is_category() || is_tag() ) {
        $title = single_term_title( '', false );
    }

    // If there's a taxonomy
    if ( is_tax() ) {
        $term = get_queried_object();
        $tax = get_taxonomy( $term->taxonomy );
        $title = single_term_title( $tax->labels->name . $t_sep, false );
    }

    // If there's an author
    if ( is_author() ) {
        $author = get_queried_object();
        $title = $author->display_name;
    }

    // If there's a post type archive
    if ( is_post_type_archive() )
        $title = post_type_archive_title( '', false );

    // If there's a month
    if ( is_archive() && !empty($m) ) {
        $my_year = substr($m, 0, 4);
        $my_month = $wp_locale->get_month(substr($m, 4, 2));
        $my_day = intval(substr($m, 6, 2));
        $title = $my_year . ( $my_month ? $t_sep . $my_month : '' ) . ( $my_day ? $t_sep . $my_day : '' );
    }

    // If there's a year
    if ( is_archive() && !empty($year) ) {
        $title = $year;
        if ( !empty($monthnum) )
            $title .= $t_sep . $wp_locale->get_month($monthnum);
        if ( !empty($day) )
            $title .= $t_sep . zeroise($day, 2);
    }

    // If it's a search
    if ( is_search() ) {
        // translators: 1: separator, 2: search phrase 
        $title = sprintf(__('Search Results %1$s %2$s'), $t_sep, strip_tags($search));
    }

    // If it's a 404 page
    if ( is_404() ) {
        $title = __('Page not found');
    }

    $prefix = '';
    if ( !empty($title) )
        $prefix = " $sep ";

    // Determines position of the separator and direction of the breadcrumb
    if ( 'right' == $seplocation ) { // sep on right, so reverse the order
        $title_array = explode( $t_sep, $title );
        $title_array = array_reverse( $title_array );
        $title = implode( " $sep ", $title_array ) . $prefix;
    } else {
        $title_array = explode( $t_sep, $title );
        $title = $prefix . implode( " $sep ", $title_array );
    }

    $title = apply_filters('wp_title_multitax', $title, $sep, $seplocation);

    // Send it out
    if ( $display )
        echo $title;
    else
        return $title;

} 



/* TAXONOMY FUNCTIONS SECTIONS


/* fs_region_init()
/* Defines custom taxonomies for this theme
/* To add a taxonomy, copy and add a new $labels array and a register_taxonomy call, and set the values accordingly
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
        array("post"),
         array(
            "labels" => $labels,
            "public" => True,
            "hierarchical" => True,
            "show_ui" => True,
            "query_var" => "region",
            "rewrite" => array("slug"=>"region"),
        ));
        
$labels = array(
        'name' => _x( 'Columns', 'taxonomy general name' ),
        'singular_name' => _x( 'Column', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Columns' ),
        'all_items' => __( 'All Columns' ),
        'parent_item' => __( 'Parent Column' ),
        'parent_item_colon' => __( 'Parent Columns:' ),
        'edit_item' => __( 'Edit Columns' ), 
        'update_item' => __( 'Update Column' ),
        'add_new_item' => __( 'Add New Column' ),
        'new_item_name' => __( 'New Column Name' ),
        'menu_name' => __( 'Columns' ),
    );
    register_taxonomy(
        "column",
        "post",
         array(
            "labels" => $labels,
            "hierarchical" => True,
            "public" => True,
            "show_ui" => True,
            "query_var" => "column",
            "rewrite" => array("slug"=>"columns"),
        ));

$labels = array(
        'name' => _x( 'Shows', 'taxonomy general name' ),
        'singular_name' => _x( 'Show', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Shows' ),
        'all_items' => __( 'All Shows' ),
        'edit_item' => __( 'Edit Shows' ), 
        'update_item' => __( 'Update Column' ),
        'add_new_item' => __( 'Add New Show' ),
        'new_item_name' => __( 'New Show Name' ),
        'menu_name' => __( 'Shows' ),
    );
    register_taxonomy(
        "show",
        "post",
         array(
            "labels" => $labels,
            "hierarchical" => False,
            "public" => True,
            "show_ui" => True,
            "query_var" => "show",
            "rewrite" => array("slug"=>"show"),
        ));

$labels = array(
        'name' => _x( 'Marketplace', 'taxonomy general name' ),
        'singular_name' => _x( 'Marketplace', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Marketplace' ),
        'all_items' => __( 'All Marketplace' ),
        'edit_item' => __( 'Edit Marketplace' ), 
        'update_item' => __( 'Update Marketplace' ),
        'add_new_item' => __( 'Add New Marketplace' ),
        'new_item_name' => __( 'New Marketplace Name' ),
        'menu_name' => __( 'Marketplace' ),
    );
    register_taxonomy(
        "marketplace",
        "post",
         array(
            "labels" => $labels,
            "hierarchical" => False,
            "public" => True,
            "show_ui" => True,
            "query_var" => "marketplace",
            "rewrite" => array("slug"=>"marketplace"),
        ));

    

$labels = array(
        'name' => _x( 'Blogs', 'taxonomy general name' ),
        'singular_name' => _x( 'Blog', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Blogs' ),
        'all_items' => __( 'All Blogs' ),
        'edit_item' => __( 'Edit Blog' ), 
        'update_item' => __( 'Update Blog' ),
        'add_new_item' => __( 'Add New Blog' ),
        'new_item_name' => __( 'New Blog Name' ),
        'menu_name' => __( 'Blogs' ),
    );
    register_taxonomy(
        "blog",
        "post",
         array(
            "labels" => $labels,
            "hierarchical" => True,
            "public" => True,
            "show_ui" => True,
            "query_var" => "blog",
            "rewrite" => array("slug"=>"blog"),
        ));

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




/* eg_add_rewrite_rules
/* defines rewrites for custom taxonomy drill-downs
 */


function eg_add_rewrite_rules(){



    add_rewrite_rule( '(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/?$','index.php?$matches[1]=$matches[2]&$matches[3]=$matches[4]&$matches[5]=$matches[6]&$matches[7]=$matches[8]&$matches[9]=$matches[10]&$matches[11]=$matches[12]&$matches[13]=$matches[14])', 'top');
    add_rewrite_rule('(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/?$' , 'index.php?$matches[1]=$matches[2]&$matches[3]=$matches[4]&$matches[5]=$matches[6]&$matches[7]=$matches[8]&$matches[9]=$matches[10]&$matches[11]=$matches[12]', 'top');
    add_rewrite_rule('(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/?$' , 'index.php?$matches[1]=$matches[2]&$matches[3]=$matches[4]&$matches[5]=$matches[6]&$matches[7]=$matches[8]&$matches[9]=$matches[10]', 'top');
    
    add_rewrite_rule('(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/?$' , 'index.php?$matches[1]=$matches[2]&$matches[3]=$matches[4]&$matches[5]=$matches[6]&$matches[7]=$matches[8]', 'top');
    
    add_rewrite_rule('(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/?$' , 'index.php?$matches[1]=$matches[2]&$matches[3]=$matches[4]&$matches[5]=$matches[6]', 'top');
    //add_rewrite_rule('(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/?$' , 'index.php?$matches[1]=$matches[2]&$matches[3]=$matches[4]', 'top'); 
    add_rewrite_rule('(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/?$' , 'index.php?$matches[1]=$matches[2]&$matches[3]=$matches[4]', 'top');
   // add_rewrite_rule('(show|region|species|marketplace|activity|gear|column|page|blog)/(.+)/?$' , 'index.php?$matches[1]=$matches[2]', 'top');
    

     add_rewrite_tag('%gallery%','([^/]+)');
     add_rewrite_tag('%album%','([^/]+)');
     add_rewrite_tag('%tags%','([^/]+)');
     add_rewrite_tag('%channel_taxonomy%','([^&]+)');
     add_rewrite_tag('%channel_term%','([^&]+)');
     add_rewrite_tag('%channel%','([^&]+)');



    // add_rewrite_rule('^galleries/([^/]+)/?$', 'index.php?pagename=galleries&album=1&gallery=$matches[1]','top');
    // add_rewrite_rule('^tag/([^/]+)/?$', 'index.php?pagename=galleries/photos-by-tag&gallerytag=$matches[1]','top');
     
   //  add_rewrite_rule('^galleries/([^/]+)/tag/([^/]+)/?$', 'index.php?pagename=galleries&album=1&gallery=$matches[1]&ngg_tag=$matches[2]','top');
     //galleries/tag/?album=1&gallery=16
     add_rewrite_rule('^album/([^/]+)/gallery/([^/]+)/?$', 'index.php?pagename=galleries/tag&album=$matches[1]&gallery=$matches[2]','top');     
     add_rewrite_rule('^album/([^/]+)/gallery/([^/]+)/tags/([^/]+)/?$', 'index.php?pagename=galleries/tag&album=$matches[1]&gallery=$matches[2]&tags=$matches[3]','top');
     //add_rewrite_rule('^galleries/tag/([^/]+)/?$', 'index.php?pagename=galleries&gallerytag=$matches[1]','top');
    // add_rewrite_tag('%gallery%','([^/]+)');
     //add_rewrite_tag('%album%','([^/]+)');
      add_rewrite_rule('^videos/([^/-]+)-([^/]+)/?$','index.php?pagename=videos&channel_taxonomy=$matches[1]&channel_term=$matches[2]', 'top');
      add_rewrite_rule('^videos/([^/-]+)/?$','index.php?pagename=videos&channel=$matches[1]', 'top');
       

} 

add_action('init', 'eg_add_rewrite_rules');

//add_filter( 'manage_posts_columns', 'ilc_cpt_columns' );
//add_filter( 'manage_posts_columns', 'ilc_cpt_columns' );
//add_action('manage_posts_custom_column', 'ilc_cpt_custom_column', 10, 2);
//add_action('manage_region_posts_custom_column', 'ilc_cpt_custom_column', 10, 2);



/* Flushes Rewrites and Permalinks, COMMENT OUT FOR PRODUCTION */

add_action('init', 'flush_rewrite_rules');
add_action('admin_init', 'flush_rewrite_rules');



/* setup_cpt_filters()
/* sets up filters for Advanced Post Manager admin plugin */


if (function_exists(setup_cpt_filters)){
    add_action('init', 'setup_cpt_filters');
}


function setup_cpt_filters() {


    $filter_array = array(
                            'region' => array(
                                                    'name' => 'Region',
                                                    'taxonomy' => 'region',
                                                    ),
                            'marketplace' => array(
                                                    'name' => 'Marketplace',
                                                    'taxonomy' => 'marketplace',
                                                    ),
                            'column' => array(
                                                    'name' => 'Column',
                                                    'taxonomy' => 'column',
                                                    ),
                            'show' => array(
                                                    'name' => 'Show',
                                                    'taxonomy' => 'show',
                                                    ),
                            'species' => array(
                                                    'name' => 'Species',
                                                    'taxonomy' => 'species',
                                                    ),
                            'gear' => array(
                                                    'name' => 'Gear',
                                                    'taxonomy' => 'gear',
                                                    ),
                            'activity' => array(
                                                    'name' => 'Activity',
                                                    'taxonomy' => 'activity',
                                                    ),
    						'blog' => array(
    												'name' => 'Blog',
    												'taxonomy' => 'blog',
    												),    		                                                   
                                                                                                                                                  
                        );


    $show_ui = true;
    // globalize it so that we can call methods on the returned object
    global $my_cpt_filters;
    
    
    if (function_exists("tribe_setup_apm"))
        $my_cpt_filters = tribe_setup_apm('post', $filter_array );
    $my_cpt_filters->add_taxonomies = false;


}


// customize the text for the NGG picture tag taxonomy label
add_filter('the_content','replace_content', 99);
function replace_content($content)
{
	// change this to whatever you want the new label to be
	$newlabel = 'View related galleries:';
	
	$content = str_replace('Picture tag:', $newlabel ,$content);
	
	return $content;
}




/**
 * nggShowSingleGalleryTags() - create a gallery based on the tags, using images from a single, specified album-gallery
 *
 * @access public
 * @param string $taglist list of tags as csv
 * @return the content
 */
function nggShowSingleGalleryTags($galleryID, $taglist) {

	
	
	// $_GET from wp_query
	$pid    = $_GET["pid"];
	$pageid = get_query_var('pageid');
	$tags = $_POST["ngg_tag"] . $_GET['tags'];

	if (empty($tags))
		$tags = get_query_var('tags');
	$tags = str_replace('+', ' ', $tags);
	$tags = str_replace('%20', ' ', $tags);
	
	$post_gallery = get_query_var('gallery');

	
	if (empty($tags)){
		 
		// get now the related images
		$picturelist = nggTags::find_images_for_tags($taglist , 'ASC');
		 
	}
	else{
		$gallery = $post_gallery;
		$picturelist = nggTags::find_images_for_tags($tags , 'ASC');
		
	}

	// filter through the picture list and remove images from other galleries
	foreach($picturelist as $key => $picture){
		if ($picture->galleryid != $gallery){

			unset($picturelist[$key]);


		}

	}
	// normalize the array if any elements were removed
	$picturelist = array_values($picturelist);


	// look for ImageBrowser if we have a $_GET('pid')
	if ( $pageid == get_the_ID() || !is_home() )
		if (!empty( $pid ))  {
		 
		$out = nggCreateImageBrowser( $picturelist );

		return $out;
	}

	// go on if not empty
	if ( empty($picturelist) )
		return;

	// show gallery
	if ( is_array($picturelist) )
		$out = nggCreateTagBasedGallery($picturelist, $gallery, $tags);

	$out = apply_filters('ngg_show_gallery_tags_content', $out, $taglist);
	return $out;
}

function show_tag_for_header($tag){
	$tag = str_replace("pic-", "", $tag);
	$tag = str_replace("pic+", "", $tag);
	$tag = str_replace("+", " ", $tag);
	$tag = str_replace("pic ", "", $tag);
	$tag = str_replace("-", " " , $tag);
	$tag = ucwords($tag);
	return $tag;
}


function get_objects_in_term_ex( $term_ids, $taxonomies, $args = array() , $match_all_tags = 0) {
	global $wpdb;

	if ( ! is_array( $term_ids ) )
		$term_ids = array( $term_ids );

	if ( ! is_array( $taxonomies ) )
		$taxonomies = array( $taxonomies );

	foreach ( (array) $taxonomies as $taxonomy ) {
		if ( ! taxonomy_exists( $taxonomy ) )
			return new WP_Error( 'invalid_taxonomy', __( 'Invalid Taxonomy' ) );
	}

	$defaults = array( 'order' => 'ASC' );
	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );

	$order = ( 'desc' == strtolower( $order ) ) ? 'DESC' : 'ASC';

	$term_ids = array_map('intval', $term_ids );

	$taxonomies = "'" . implode( "', '", $taxonomies ) . "'";
	//$term_ids = "'" . implode( "', '", $term_ids ) . "'";




	$sql_query = "SELECT distinct tr.object_id FROM $wpdb->term_relationships AS tr INNER JOIN $wpdb->term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy IN ($taxonomies) ";

	$x = 0;
	$num_terms = count($term_ids);

	$sql_query .= "AND (";

	if ($match_all_tags) {


		foreach($term_ids as $term_id){
			$x++;

			$sql_query .= " tr.object_id IN (SELECT tr.object_id FROM $wpdb->term_relationships tr, $wpdb->term_taxonomy tt WHERE tr.term_taxonomy_id IN (SELECT term_taxonomy_id FROM $wpdb->term_taxonomy WHERE term_id = '". $term_id ."'))" ;
			if ($x < $num_terms)
				$sql_query .= " AND ";

		}
	} else {

		foreach($term_ids as $term_id){
			$x++;
			$sql_query .= " tr.object_id IN (SELECT tr.object_id FROM $wpdb->term_relationships tr, $wpdb->term_taxonomy tt WHERE tr.term_taxonomy_id IN (SELECT term_taxonomy_id FROM $wpdb->term_taxonomy WHERE term_id = '". $term_id ."'))" ;
			if ($x < $num_terms)
				$sql_query .= " OR ";
		}
	}


 

	$sql_query .= ") ORDER BY tr.object_id $order";

	/*
	$test = mysql_query("SELECT * FROM $wpdb->terms");
	while ($row = mysql_fetch_object($test)){

	print_r($row);
	echo "<br>";
	} */

	$object_ids = $wpdb->get_col($sql_query);

	if ( ! $object_ids )
		return array();

		return $object_ids;
}



/**
 * Build a tag-driven gallery output
 *
 * @access internal
 * @param array $picturelist
 * @param bool $galleryID, if you supply a gallery ID, you can add a slideshow link
 * @param string $tags
 * @param string $template (optional) name for a template file, look for gallery-$template
 * @param int $images (optional) number of images per page
 * @return the content
 */
function nggCreateTagBasedGallery($picturelist, $galleryID = false, $tags, $template = '', $images = false) {
	global $nggRewrite;
	

	//require_once (dirname (__FILE__) . '/lib/media-rss.php');

	$ngg_options = nggGallery::get_option('ngg_options');

	//the shortcode parameter will override global settings, TODO: rewrite this to a class
	$ngg_options['galImages'] = ( $images === false ) ? $ngg_options['galImages'] : (int) $images;

	$current_pid = false;

	// $_GET from wp_query
	$nggpage  = get_query_var('nggpage');
	$pageid   = get_query_var('pageid');
	$pid      = get_query_var('pid');

	// in case of permalinks the pid is a slug, we need the id
	if( !is_numeric($pid) && !empty($pid) ) {
		$picture = nggdb::find_image($pid);
		$pid = $picture->pid;
	}

	// we need to know the current page id
	$current_page = (get_the_ID() == false) ? 0 : get_the_ID();

	if ( !is_array($picturelist) )
		$picturelist = array($picturelist);

	// Populate galleries values from the first image
	$first_image = current($picturelist);
	$gallery = new stdclass;
	$gallery->ID = (int) $galleryID;
	$gallery->show_slideshow = false;
	$gallery->show_piclens = false;
	$gallery->name = stripslashes ( $first_image->name  );
	$gallery->title = stripslashes( $first_image->title );
	$gallery->description = html_entity_decode(stripslashes( $first_image->galdesc));
	$gallery->pageid = $first_image->pageid;
	$gallery->anchor = 'ngg-gallery-' . $galleryID . '-' . $current_page;
	reset($picturelist);

	$maxElement  = $ngg_options['galImages'];
	$thumbwidth  = $ngg_options['thumbwidth'];
	$thumbheight = $ngg_options['thumbheight'];

	// fixed width if needed
	$gallery->columns    = intval($ngg_options['galColumns']);
	$gallery->imagewidth = ($gallery->columns > 0) ? 'style="width:' . floor(100/$gallery->columns) . '%;"' : '';

	// obsolete in V1.4.0, but kept for compat reason
	// pre set thumbnail size, from the option, later we look for meta data.
	$thumbsize = ($ngg_options['thumbfix']) ? $thumbsize = 'width="' . $thumbwidth . '" height="'.$thumbheight . '"' : '';

	// show slideshow link
	if ($galleryID) {
		if ($ngg_options['galShowSlide']) {
			$gallery->show_slideshow = true;
			$gallery->slideshow_link = $nggRewrite->get_permalink(array ( 'show' => 'slide') );
			$gallery->slideshow_link_text = nggGallery::i18n($ngg_options['galTextSlide']);
		}

		if ($ngg_options['usePicLens']) {
			$gallery->show_piclens = true;
			$gallery->piclens_link = "javascript:PicLensLite.start({feedUrl:'" . htmlspecialchars( nggMediaRss::get_gallery_mrss_url($gallery->ID) ) . "'});";
		}
	}

	// check for page navigation
	if ($maxElement > 0) {

		if ( !is_home() || $pageid == $current_page )
			$page = ( !empty( $nggpage ) ) ? (int) $nggpage : 1;
		else
			$page = 1;
			
		$start = $offset = ( $page - 1 ) * $maxElement;

		$total = count($picturelist);

		//we can work with display:hidden for some javascript effects
		if (!$ngg_options['galHiddenImg']){
			// remove the element if we didn't start at the beginning
			if ($start > 0 )
				array_splice($picturelist, 0, $start);

			// return the list of images we need
			array_splice($picturelist, $maxElement);
		}

		$nggNav = new nggTagGalleryNavigation;
		
		$navigation = $nggNav->create_navigation($page, $total, $maxElement);
	} else {
		$navigation = '<div class="ngg-clear"></div>';
	}

	//we cannot use the key as index, cause it's filled with the pid
	$index = 0;
	foreach ($picturelist as $key => $picture) {

		//needed for hidden images (THX to Sweigold for the main idea at : http://wordpress.org/support/topic/228743/ )
		$picturelist[$key]->hidden = false;
		$picturelist[$key]->style  = $gallery->imagewidth;

		if ($maxElement > 0 && $ngg_options['galHiddenImg']) {
			if ( ($index < $start) || ($index > ($start + $maxElement -1)) ){
				$picturelist[$key]->hidden = true;
				$picturelist[$key]->style  = ($gallery->columns > 0) ? 'style="width:' . floor(100/$gallery->columns) . '%;display: none;"' : 'style="display: none;"';
			}
			$index++;
		}

		// get the effect code
		if ($galleryID)
			$thumbcode = ($ngg_options['galImgBrowser']) ? '' : $picture->get_thumbcode('set_' . $galleryID);
		else
			$thumbcode = ($ngg_options['galImgBrowser']) ? '' : $picture->get_thumbcode(get_the_title());

		// create link for imagebrowser and other effects
		$args ['nggpage'] = empty($nggpage) || ($template != 'carousel') ? false : $nggpage;  // only needed for carousel mode
		$args ['pid']     = ($ngg_options['usePermalinks']) ? $picture->image_slug : $picture->pid;
		$picturelist[$key]->pidlink = $nggRewrite->get_permalink( $args ) . '&tags='.urlencode($tags);

		// generate the thumbnail size if the meta data available
		if ( isset($picturelist[$key]->meta_data['thumbnail']) && is_array ($size = $picturelist[$key]->meta_data['thumbnail']) )
			$thumbsize = 'width="' . $size['width'] . '" height="' . $size['height'] . '"';

		// choose link between imagebrowser or effect
		$link = ($ngg_options['galImgBrowser']) ? $picturelist[$key]->pidlink : $picture->imageURL;
		// bad solution : for now we need the url always for the carousel, should be reworked in the future
		$picturelist[$key]->url = $picture->imageURL;
		// add a filter for the link
		$picturelist[$key]->imageURL = apply_filters('ngg_create_gallery_link', $link, $picture);
		$picturelist[$key]->thumbnailURL = $picture->thumbURL;
		$picturelist[$key]->size = $thumbsize;
		$picturelist[$key]->thumbcode = $thumbcode;
		$picturelist[$key]->caption = ( empty($picture->description) ) ? '&nbsp;' : html_entity_decode ( stripslashes(nggGallery::i18n($picture->description, 'pic_' . $picture->pid . '_description')) );
		$picturelist[$key]->description = ( empty($picture->description) ) ? ' ' : htmlspecialchars ( stripslashes(nggGallery::i18n($picture->description, 'pic_' . $picture->pid . '_description')) );
		$picturelist[$key]->alttext = ( empty($picture->alttext) ) ?  ' ' : htmlspecialchars ( stripslashes(nggGallery::i18n($picture->alttext, 'pic_' . $picture->pid . '_alttext')) );

		// filter to add custom content for the output
		$picturelist[$key] = apply_filters('ngg_image_object', $picturelist[$key], $picture->pid);

		//check if $pid is in the array
		if ($picture->pid == $pid)
			$current_pid = $picturelist[$key];
	}
	reset($picturelist);

	//for paged galleries, take the first image in the array if it's not in the list
	$current_pid = ( empty($current_pid) ) ? current( $picturelist ) : $current_pid;

	// look for gallery-$template.php or pure gallery.php
	$filename = ( empty($template) ) ? 'gallery' : 'gallery-' . $template;

	//filter functions for custom addons
	$gallery     = apply_filters( 'ngg_gallery_object', $gallery, $galleryID );
	$picturelist = apply_filters( 'ngg_picturelist_object', $picturelist, $galleryID );

	//additional navigation links
	$next = ( empty($nggNav->next) ) ? false : $nggNav->next;
	$prev = ( empty($nggNav->prev) ) ? false : $nggNav->prev;

	// create the output
	$out = nggGallery::capture ( $filename, array ('gallery' => $gallery, 'images' => $picturelist, 'pagination' => $navigation, 'current' => $current_pid, 'next' => $next, 'prev' => $prev) );

	// apply a filter after the output
	$out = apply_filters('ngg_gallery_output', $out, $picturelist);

	return $out;
}

add_filter('wp_title' , 'rewrite_title', 99 );
function rewrite_title($title) {


    $title = preg_replace("/[a-zA-Z]+ [0-9]+ &laquo;/i", "", $title); 
	//$title = preg_replace("/Member Photo Galleries - /i", "",  $title);
	$new_title = '';
	// the separataor
	$sep = ' &laquo; ';

	// $_GET from wp_query
	$pid     = get_query_var('pid');
	$pageid  = get_query_var('pageid');
	$nggpage = get_query_var('nggpage');
	$gallery = get_query_var('gallery');
	$album   = get_query_var('album');
	$tag  	 = get_query_var('gallerytag');
	$show    = get_query_var('show');

	//TODO: I could parse for the Picture name , gallery etc, but this increase the queries
	//TODO: Class nggdb need to cache the query for the nggfunctions.php

	if ( $show == 'slide' )
		$new_title .= __('Slideshow', 'nggallery') . $sep ;
	elseif ( $show == 'show' )
	$new_title .= __('Gallery', 'nggallery') . $sep ;

	if ( !empty($pid) )
		$new_title .= __('Picture', 'nggallery') . ' ' . esc_attr($pid) . $sep ;

	if ( !empty($album) )
		$new_title .= __('Album', 'nggallery') . ' ' . esc_attr($album) . $sep ;

	if ( !empty($gallery) )
		$new_title .= __('Gallery', 'nggallery') . ' ' . esc_attr($gallery) . $sep ;
		
	if ( !empty($nggpage) )
		$new_title .= __('Page', 'nggallery') . ' ' . esc_attr($nggpage) . $sep ;

	//esc_attr should avoid XSS like http://domain/?gallerytag=%3C/title%3E%3Cscript%3Ealert(document.cookie)%3C/script%3E
	if ( !empty($tag) )
		$new_title .= esc_attr($tag) . $sep;



	global $wpdb;

	$albumcontent = $wpdb->get_row("SELECT * FROM $wpdb->nggalbum WHERE id = '$album' ");
	$gallerycontent = $wpdb->get_row("SELECT * FROM $wpdb->nggallery WHERE gid = '$gallery' ");
	$imagecontent = $wpdb->get_row("SELECT * FROM $wpdb->nggpictures WHERE pid = '$pid' ");

	if (!empty($imagecontent->alttext))
		$image_title = $imagecontent->alttext;
	else
		$image_title = $imagecontent->description;

	$gallery_title = $gallerycontent->title;



	if ($_POST['ngg_tag'] || $_GET['tags'])
		$gallery_title = show_tag_for_header($_POST['ngg_tag'] . $_GET['tags']) . ' - ' . $gallery_title; //. ' - Gallery: View Photos by Tag';

	if (!empty($gallery_title))
		$gallery_title .= ' - ';


	if (!empty($image_title))
		$image_title .= ' - ';

	if(!empty($gallerycontent->title)) {
			
		$new_title = $image_title . $gallery_title;
	}




	//prepend the data
	$title = $new_title . $title;




	return $title;
}


    function show_tags_single_gallery( $atts ) {
    
    $temp = str_replace('-', ' ', $atts['gallery']);
    $temp = ucwords($temp);
    $GLOBALS['ngg_shortcode'] = $temp;
        extract(shortcode_atts(array(
            'gallery'       => '',
            'tags'          => ''
        ), $atts ));
        
 		$out = nggShowSingleGalleryTags($gallery, $tags);
        return $out;
    }

    
    /**
     * nggShowGallery() - return a gallery
     *
     * @access public
     * @param int | string ID or slug from a gallery
     * @param string $template (optional) name for a template file, look for gallery-$template
     * @param int $images (optional) number of images per page
     * @return the content
     */
    function nggShowGalleryMod( $galleryID, $template = '', $images = false, $onclick = '' ) {
    
    	global $nggRewrite;
    
    	$ngg_options = nggGallery::get_option('ngg_options');
    
    	//Set sort order value, if not used (upgrade issue)
    	$ngg_options['galSort'] = ($ngg_options['galSort']) ? $ngg_options['galSort'] : 'pid';
    	$ngg_options['galSortDir'] = ($ngg_options['galSortDir'] == 'DESC') ? 'DESC' : 'ASC';
    
    	// get gallery values
    	//TODO: Use pagination limits here to reduce memory needs
    	$picturelist = nggdb::get_gallery($galleryID, $ngg_options['galSort'], $ngg_options['galSortDir']);
    
    	if ( !$picturelist )
    		return __('[Gallery not found]','nggallery');
    
    	// If we have we slug instead the id, we should extract the ID from the first image
    	if ( !is_numeric($galleryID) ) {
    		$first_image = current($picturelist);
    		$galleryID = intval($first_image->gid);
    	}
    
    	// $_GET from wp_query
    	$show    = get_query_var('show');
    	$pid     = get_query_var('pid');
    	$pageid  = get_query_var('pageid');
    
    	// set $show if slideshow first
    	if ( empty( $show ) AND ($ngg_options['galShowOrder'] == 'slide')) {
    		if ( is_home() )
    			$pageid = get_the_ID();
    
    		$show = 'slide';
    	}
    
    	// filter to call up the imagebrowser instead of the gallery
    	// use in your theme : add_action( 'ngg_show_imagebrowser_first', create_function('', 'return true;') );
    	if ( apply_filters('ngg_show_imagebrowser_first', false, $galleryID ) && $show != 'thumbnails' )  {
    		$out = nggShowImageBrowserMod( $galleryID, $template );
    		return $out;
    	}
    
    	// go on only on this page
    	if ( !is_home() || $pageid == get_the_ID() ) {
    
    		// 1st look for ImageBrowser link
    		if ( !empty($pid) && $ngg_options['galImgBrowser'] && ($template != 'carousel') )  {
    			$out = nggShowImageBrowserMod( $galleryID, $template );
    			return $out;
    		}
    
    		// 2nd look for slideshow
    		if ( $show == 'slide' ) {
    			$args['show'] = "gallery";
    			$out  = '<div class="ngg-galleryoverview">';
    			$out .= '<div class="slideshowlink"><a class="slideshowlink" href="' . $nggRewrite->get_permalink($args) . '">'.nggGallery::i18n($ngg_options['galTextGallery']).'</a></div>';
    			$out .= nggShowSlideshow($galleryID, $ngg_options['irWidth'], $ngg_options['irHeight']);
    			$out .= '</div>'."\n";
    			$out .= '<div class="ngg-clear"></div>'."\n";
    			return $out;
    		}
    	}
    
    	// get all picture with this galleryid
    	if ( is_array($picturelist) ){
    		if ( $onclick != 'lightbox')
    			$out = nggCreateGallery($picturelist, $galleryID, $template, $images);
    		else
    			$out = nggCreateGalleryMod($picturelist, $galleryID, $template, $images);
    			
    	}
    	$out = apply_filters('ngg_show_gallery_content', $out, intval($galleryID));
    	return $out;
    }
    
    
    
    /**
     * Build a gallery output
     *
     * @access internal
     * @param array $picturelist
     * @param bool $galleryID, if you supply a gallery ID, you can add a slideshow link
     * @param string $template (optional) name for a template file, look for gallery-$template
     * @param int $images (optional) number of images per page
     * @return the content
     */
    function nggCreateGalleryMod($picturelist, $galleryID = false, $template = '', $images = false) {
    	global $nggRewrite;
    
    //	require_once (dirname (__FILE__) . '/lib/media-rss.php');
    
    	$ngg_options = nggGallery::get_option('ngg_options');
    
    	//the shortcode parameter will override global settings, TODO: rewrite this to a class
    	$ngg_options['galImages'] = ( $images === false ) ? $ngg_options['galImages'] : (int) $images;
    
    	$current_pid = false;
    
    	// $_GET from wp_query
    	$nggpage  = get_query_var('nggpage');
    	$pageid   = get_query_var('pageid');
    	$pid      = get_query_var('pid');
    
    	// in case of permalinks the pid is a slug, we need the id
    	if( !is_numeric($pid) && !empty($pid) ) {
    		$picture = nggdb::find_image($pid);
    		$pid = $picture->pid;
    	}
    
    	// we need to know the current page id
    	$current_page = (get_the_ID() == false) ? 0 : get_the_ID();
    
    	if ( !is_array($picturelist) )
    		$picturelist = array($picturelist);
    
    	// Populate galleries values from the first image
    	$first_image = current($picturelist);
    	$gallery = new stdclass;
    	$gallery->ID = (int) $galleryID;
    	$gallery->show_slideshow = false;
    	$gallery->show_piclens = false;
    	$gallery->name = stripslashes ( $first_image->name  );
    	$gallery->title = stripslashes( $first_image->title );
    	$gallery->description = html_entity_decode(stripslashes( $first_image->galdesc));
    	$gallery->pageid = $first_image->pageid;
    	$gallery->anchor = 'ngg-gallery-' . $galleryID . '-' . $current_page;
    	reset($picturelist);
    
    	$maxElement  = $ngg_options['galImages'];
    	$thumbwidth  = $ngg_options['thumbwidth'];
    	$thumbheight = $ngg_options['thumbheight'];
    
    	// fixed width if needed
    	$gallery->columns    = intval($ngg_options['galColumns']);
    	$gallery->imagewidth = ($gallery->columns > 0) ? 'style="width:' . floor(100/$gallery->columns) . '%;"' : '';
    
    	// obsolete in V1.4.0, but kept for compat reason
    	// pre set thumbnail size, from the option, later we look for meta data.
    	$thumbsize = ($ngg_options['thumbfix']) ? $thumbsize = 'width="' . $thumbwidth . '" height="'.$thumbheight . '"' : '';
    
    	// show slideshow link
    	if ($galleryID) {
    		if ($ngg_options['galShowSlide']) {
    			$gallery->show_slideshow = true;
    			$gallery->slideshow_link = $nggRewrite->get_permalink(array ( 'show' => 'slide') );
    			$gallery->slideshow_link_text = nggGallery::i18n($ngg_options['galTextSlide']);
    		}
    
    		if ($ngg_options['usePicLens']) {
    			$gallery->show_piclens = true;
    			$gallery->piclens_link = "javascript:PicLensLite.start({feedUrl:'" . htmlspecialchars( nggMediaRss::get_gallery_mrss_url($gallery->ID) ) . "'});";
    		}
    	}
    
    	// check for page navigation
    	if ($maxElement > 0) {
    
    		if ( !is_home() || $pageid == $current_page )
    			$page = ( !empty( $nggpage ) ) ? (int) $nggpage : 1;
    		else
    			$page = 1;
    		 
    		$start = $offset = ( $page - 1 ) * $maxElement;
    
    		$total = count($picturelist);
    
    		//we can work with display:hidden for some javascript effects
    		if (!$ngg_options['galHiddenImg']){
    			// remove the element if we didn't start at the beginning
    			if ($start > 0 )
    				array_splice($picturelist, 0, $start);
    			 
    			// return the list of images we need
    			array_splice($picturelist, $maxElement);
    		}
    
    		$nggNav = new nggNavigation;
    		$navigation = $nggNav->create_navigation($page, $total, $maxElement);
    	} else {
    		$navigation = '<div class="ngg-clear"></div>';
    	}
    	 
    	//we cannot use the key as index, cause it's filled with the pid
    	$index = 0;
    	foreach ($picturelist as $key => $picture) {
    
    		//needed for hidden images (THX to Sweigold for the main idea at : http://wordpress.org/support/topic/228743/ )
    		$picturelist[$key]->hidden = false;
    		$picturelist[$key]->style  = $gallery->imagewidth;
    
    		if ($maxElement > 0 && $ngg_options['galHiddenImg']) {
    			if ( ($index < $start) || ($index > ($start + $maxElement -1)) ){
    				$picturelist[$key]->hidden = true;
    				$picturelist[$key]->style  = ($gallery->columns > 0) ? 'style="width:' . floor(100/$gallery->columns) . '%;display: none;"' : 'style="display: none;"';
    			}
    			$index++;
    		}
    
    		// get the effect code
    		if ($galleryID)
    			$thumbcode = $picture->get_thumbcode('set_' . $galleryID);
    		else
    			$thumbcode = $picture->get_thumbcode(get_the_title());
    		if (empty($thumbcode))
    		 $thumbcode = 'class="thickbox" rel="set_6"';

    		// create link for imagebrowser and other effects
    		$args ['nggpage'] = empty($nggpage) || ($template != 'carousel') ? false : $nggpage;  // only needed for carousel mode
    		$args ['pid']     = ($ngg_options['usePermalinks']) ? $picture->image_slug : $picture->pid;
    		
    		$picturelist[$key]->pidlink = $nggRewrite->get_permalink( $args );
    
    		// generate the thumbnail size if the meta data available
    		if ( isset($picturelist[$key]->meta_data['thumbnail']) && is_array ($size = $picturelist[$key]->meta_data['thumbnail']) )
    			$thumbsize = 'width="' . $size['width'] . '" height="' . $size['height'] . '"';
    
    		// choose link between imagebrowser or effect
    		$link =  $picture->imageURL;
    		// bad solution : for now we need the url always for the carousel, should be reworked in the future
    		$picturelist[$key]->url = $picture->imageURL;
    		// add a filter for the link
    		$picturelist[$key]->imageURL = apply_filters('ngg_create_gallery_link', $link, $picture);
    		$picturelist[$key]->thumbnailURL = $picture->thumbURL;
    		$picturelist[$key]->size = $thumbsize;
    		$picturelist[$key]->thumbcode = $thumbcode;
    		$picturelist[$key]->caption = ( empty($picture->description) ) ? '&nbsp;' : html_entity_decode ( stripslashes(nggGallery::i18n($picture->description, 'pic_' . $picture->pid . '_description')) );
    		$picturelist[$key]->description = ( empty($picture->description) ) ? ' ' : htmlspecialchars ( stripslashes(nggGallery::i18n($picture->description, 'pic_' . $picture->pid . '_description')) );
    		$picturelist[$key]->alttext = ( empty($picture->alttext) ) ?  ' ' : htmlspecialchars ( stripslashes(nggGallery::i18n($picture->alttext, 'pic_' . $picture->pid . '_alttext')) );
    
    		// filter to add custom content for the output
    		$picturelist[$key] = apply_filters('ngg_image_object', $picturelist[$key], $picture->pid);
    
    		//check if $pid is in the array
    		if ($picture->pid == $pid)
    			$current_pid = $picturelist[$key];
    	}
    	reset($picturelist);
    
    	//for paged galleries, take the first image in the array if it's not in the list
    	$current_pid = ( empty($current_pid) ) ? current( $picturelist ) : $current_pid;
    
    	// look for gallery-$template.php or pure gallery.php
    	$filename = ( empty($template) ) ? 'gallery' : 'gallery-' . $template;
    
    	//filter functions for custom addons
    	$gallery     = apply_filters( 'ngg_gallery_object', $gallery, $galleryID );
    	$picturelist = apply_filters( 'ngg_picturelist_object', $picturelist, $galleryID );
    
    	//additional navigation links
    	$next = ( empty($nggNav->next) ) ? false : $nggNav->next;
    	$prev = ( empty($nggNav->prev) ) ? false : $nggNav->prev;
    
    	// create the output
    	$out = nggGallery::capture ( $filename, array ('gallery' => $gallery, 'images' => $picturelist, 'pagination' => $navigation, 'current' => $current_pid, 'next' => $next, 'prev' => $prev) );
    
    	// apply a filter after the output
    	$out = apply_filters('ngg_gallery_output', $out, $picturelist);
    
    	return $out;
    }
    
    
    /**
     * nggNavigation - PHP class for the pagination
    *
    * @package NextGEN Gallery
    * @author Alex Rabe
    * @copyright 2009-2011
    * @version 1.0.1
    * @access public
    */
    class nggTagGalleryNavigation {
    
    	/**
    	 * Return the navigation output
    	 *
    	 * @access public
    	 * @var string
    	 */
    	var $output = false;
    
    	/**
    	 * Link to previous page
    	 *
    	 * @access public
    	 * @var string
    	 */
    	var $prev = false;
    
    	/**
    	 * Link to next page
    	 *
    	 * @access public
    	 * @var string
    	 */
    	var $next = false;
    
    	/**
    	 * PHP4 compatibility layer for calling the PHP5 constructor.
    	 *
    	 */
    	function nggNavigation() {
    		return $this->__construct();
    	}
    
    	/**
    	 * Main constructor - Does nothing.
    	 * Call create_navigation() method when you need a navigation.
    	 *
    	 */
    	function __construct() {
    		return;
    	}
    
    	/**
    	 * nggNavigation::create_navigation()
    	 *
    	 * @param mixed $page
    	 * @param integer $totalElement
    	 * @param integer $maxElement
    	 * @return string pagination content
    	 */
    	function create_navigation($page, $totalElement, $maxElement = 0) {
    		global $nggRewrite;
    
    		$prev_symbol = apply_filters('ngg_prev_symbol', '&#9668;');
    		$next_symbol = apply_filters('ngg_prev_symbol', '&#9658;');
    
    		if ($maxElement > 0) {
    			$total = $totalElement;
    				
    			// create navigation
    			if ( $total > $maxElement ) {
    				$total_pages = ceil( $total / $maxElement );
    				$r = '';
    				if ( 1 < $page ) {
    					$args['nggpage'] = ( 1 == $page - 1 ) ? FALSE : $page - 1;
    					$previous = $args['nggpage'];
    					if (FALSE == $args['nggpage']) {
    						$previous = 1;
    					}
    					//$this->prev = $nggRewrite->get_permalink ( $args );
    					$link = $nggRewrite->get_permalink( $args );
    					if (!empty($_POST['ngg_tag'])){
    						$tag_insert = "/tags/".$_POST['ngg_tag'];
    						$link = str_insert($tag_insert, $link, strpos($link, "?") -1);
    					}
    					$this->prev = $link;    					
    					
    					$r .=  '<a class="prev" id="ngg-prev-' . $previous . '" href="' . $this->prev . '">' . $prev_symbol . '</a>';
    				}
    
    				$total_pages = ceil( $total / $maxElement );
    
    				if ( $total_pages > 1 ) {
    					for ( $page_num = 1; $page_num <= $total_pages; $page_num++ ) {
    						if ( $page == $page_num ) {
    							$r .=  '<span class="current">' . $page_num . '</span>';
    						} else {
    							$p = false;
    							if ( $page_num < 3 || ( $page_num >= $page - 3 && $page_num <= $page + 3 ) || $page_num > $total_pages - 3 ) {
    								$args['nggpage'] = ( 1 == $page_num ) ? FALSE : $page_num;
    								
    								$link = $nggRewrite->get_permalink( $args );
    								if (!empty($_POST['ngg_tag'])){
    									$tag_insert = "/tags/".$_POST['ngg_tag'];
    									$link = str_insert($tag_insert, $link, strpos($link, "?") -1);
    								}
    								$r .= '<a class="page-numbers" href="' . $link . '">' . ( $page_num ) . '</a>';
    								$in = true;
    							} elseif ( $in == true ) {
    								$r .= '<span class="more">...</span>';
    								$in = false;
    							}
    						}
    					}
    				}
    
    				if ( ( $page ) * $maxElement < $total || -1 == $total ) {
    					$args['nggpage'] = $page + 1;
    					//$this->next = $nggRewrite->get_permalink ( $args );
    					$link = $nggRewrite->get_permalink( $args );
    					if (!empty($_POST['ngg_tag'])){
    						$tag_insert = "/tags/".$_POST['ngg_tag'];
    						$link = str_insert($tag_insert, $link, strpos($link, "?") -1);
    					}    					
    					$this->next = $link;
    					$r .=  '<a class="next" id="ngg-next-' . $args['nggpage'] . '" href="' . $this->next . '">' . $next_symbol . '</a>';
    				}
    
    				$this->output = "<div class='ngg-navigation'>$r</div>";
    			} else {
    				$this->output = "<div class='ngg-clear'></div>"."\n";
    			}
    		}
    
    		return $this->output;
    	}
    }

    function str_insert($insertstring, $intostring, $offset) {
    	$part1 = substr($intostring, 0, $offset);
    	$part2 = substr($intostring, $offset);
    
    	$part1 = $part1 . $insertstring;
    	$whole = $part1 . $part2;
    	return $whole;
    }    
    
 

    
    class SidebarRecentBlogPosts extends WP_Widget
    {
    	function SidebarRecentBlogPosts()
    	{
    		$widget_ops = array('classname' => 'SidebarRecentBlogPosts', 'description' => 'Displays links to recent blog posts in the sidebar' );
    		$this->WP_Widget('SidebarRecentBlogPosts', 'Recent Blog Posts and Blog Listing', $widget_ops);
    	}
    
    	function form($instance)
    	{
    		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    		$title = $instance['title'];
    		?>
          <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
        <?php
          }
         
          function update($new_instance, $old_instance)
          {
            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            return $instance;
          }
         
          function widget($args, $instance)
          {
            extract($args, EXTR_SKIP);
         
            echo $before_widget;
            $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
         
            if (!empty($title))
              echo $before_title . $title . $after_title;
         
		    //SHOW LATEST POSTS FROM BLOGS ONLY ON BLOG PAGES
    
    
    // Display recent blog posts in blog currently being viewed
    if ( is_tax('blog') || has_term('', 'blog')) {
    	
    ?>
    <div id="fls-blogs-nav">
    <?php
    
    // List posts by the terms for a custom taxonomy of any post type
    
    $post_type = 'post';
    $tax = 'blog';
    global $post;
    $terms = get_the_terms($post->ID, 'blog');
    
    foreach($terms as $term){
    	$blog_name = $term->slug; 
    }
    
    $tax_terms = get_terms( $tax );
    if ($tax_terms) {
    	foreach ($tax_terms  as $tax_term) {
    		if ($tax_term->slug == $blog_name){
    	$args = array(
    		'post_type' => $post_type,
    		"$tax" => $tax_term->slug,
    		'post_status' => 'publish',
    		'posts_per_page' => 4,
    		'caller_get_posts'=> 1
    	);
    
    		$my_query = null;
    		$my_query = new WP_Query($args);
    
    		if( $my_query->have_posts() ) : ?>
    
    			<h3 class="breadcrumb">Latest from <a href="<?php bloginfo('url'); ?>/<?php echo $tax; ?>/<?php echo $tax_term->slug; ?>"><?php echo $tax_term->name; ?></a></h3>
    			<ul class="taxlist">
    			<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
    
    				<li id="post-<?php the_ID(); ?>">
    					<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
    				</li>
    
    			<?php endwhile; // end of loop ?>
    
    			</ul>
    
    		<?php else : ?>
    		<?php endif; // if have_posts()
    		wp_reset_query();
    
    	}
    	} // end foreach #tax_terms
    	?>
        <h2>Sportsman Blogs</h2>
        <?php
    	
    	foreach ($tax_terms  as $tax_term) {
    		if ($tax_term->slug != $blog_name) {
    		$my_query = null;
    		$my_query = new WP_Query($args);
    	
    			if( $my_query->have_posts() ) : ?>
    	
    				<h4 class="breadcrumb"><a href="<?php bloginfo('url'); ?>/<?php echo $tax; ?>/<?php echo $tax_term->slug; ?>"><?php echo $tax_term->name; ?></a></h4>
    	
    			<?php else : ?>
    			<?php endif; // if have_posts()
    			wp_reset_query();
    		}
    		} // end foreach #tax_terms	
    	
    }
    }
    ?>
     </div>   
         <?php 
            echo $after_widget;
          }
         
        }
        add_action( 'widgets_init', create_function('', 'return register_widget("SidebarRecentBlogPosts");') );
        
        
        
        
        class SidebarBlogTitles extends WP_Widget
        {
        	function SidebarBlogTitles()
        	{
        		$widget_ops = array('classname' => 'SidebarBlogTitles', 'description' => 'Displays links to blogs in the sidebar' );
        		$this->WP_Widget('SidebarBlogTitles', 'List of Blogs', $widget_ops);
        	}
        
        	function form($instance)
        	{
        		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        		$title = $instance['title'];
        		?>
                  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
                <?php
                  }
                 
                  function update($new_instance, $old_instance)
                  {
                    $instance = $old_instance;
                    $instance['title'] = $new_instance['title'];
                    return $instance;
                  }
                 
                  function widget($args, $instance)
                  {
                    extract($args, EXTR_SKIP);
                 
                    echo $before_widget;
                    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
                 
                    if (!empty($title))
                      echo $before_title . $title . $after_title;
                    ?>
                    <div id="fls-blogs-nav">
                    <?php
                    
                    if ( is_tax('blog') || has_term('', 'blog')) {
                    
	                    	?>
	                    <h2>The Sportsman's Blogs</h2>
	                    <?php
	                    
	                    // List posts by the terms for a custom taxonomy of any post type
	                    
	                    $post_type = 'post';
	                    $tax = 'blog';
	                    $tax_terms = get_terms( $tax );
	                    if ($tax_terms) {
	                    	foreach ($tax_terms  as $tax_term) {
	                  		?>
	                    	      <h4 class="blog-latest-title"><a href="<?php bloginfo('url'); ?>/<?php echo $tax; ?>/<?php echo $tax_term->slug; ?>"><?php echo $tax_term->name; ?></a></h4>
	                        <?php 
	                    		wp_reset_query();
	                    
	                    	} // end foreach #tax_terms
	                    }
                    }
                    ?>
                        </div>
                    
                    
                    
                 <?php 
                    echo $after_widget;
                  }
                 
                }
                add_action( 'widgets_init', create_function('', 'return register_widget("SidebarBlogTitles");') );
                
                
            

                
                class BioWidgetNew extends WP_Widget {
                	/** constructor */
                	function BioWidgetNew() {
                		parent::WP_Widget(false, $name = 'Author Bio');
                	}
                
                	function widget($args, $instance) {
                
                		global $post;
                		$title = apply_filters('widget_title', $instance['title']);
                		$av_size = $instance['size'];
                
                		$author = $post->post_author;
                
                		$name = get_the_author_meta('nickname', $author);
                		$alt_name = get_the_author_meta('display_name', $author);
                		$avatar = get_avatar($author, $av_size, 'Gravatar Logo', $alt_name.'-photo');
                		$description = get_the_author_meta('description', $author);
                		$author_link = get_author_posts_url($author);
                		?>
                   
                   
                   <span class="bio-title"><?php echo $title ?></span>
                   <ul class="author-bio">
                    <li class="author-avatar"><?php echo $avatar; ?></li>
                    <li class="author-name"><?php echo $alt_name; ?></li>
                    <li class="author-description"><?php echo $description; ?> </li>
                   </ul>
                   
                   
                    <?php
                    }
                
                    function update($new_instance, $old_instance) {       
                  $instance = $old_instance;
                  $instance['title'] = strip_tags($new_instance['title']);
                  $instance['size'] = strip_tags($new_instance['size']);
                        return $instance;
                    }
                
                    function form($instance) {
                      if(array_key_exists('title', $instance)){
                        $title = esc_attr($instance['title']);
                      }else{$title='';}
                      
                      if(array_key_exists('size', $instance)){
                        $size = esc_attr($instance['size']);
                      }else{$size=64;}
                     
                        ?>
                            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
                            <p><label for="<?php echo $this->get_field_id('size'); ?>"><?php _e('Avatar Size:'); ?>
                              <select id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" value="<?php echo $size; ?>" >
                             <?php
                             for ( $i = 16; $i <= 256; $i+=16 )
                              echo "<option value='$i' " . ( $size == $i ? "selected='selected'" : '' ) . ">$i</option>";
                               ?>
                              </select></label></p> 
                        <?php 
                    }
                }
                add_action('widgets_init', create_function('', 'return register_widget("BioWidgetNew");'));

                
                
                class NextGEN_shortcodes_mod {
                
                	// register the new shortcodes
                	function NextGEN_shortcodes_mod() {
                
                		//Long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
                		@ini_set('pcre.backtrack_limit', 500000);
                
                		// convert the old shortcode
                		add_filter('the_content', array(&$this, 'convert_shortcode'));
                
                		// do_shortcode on the_excerpt could causes several unwanted output. Uncomment it on your own risk
                		// add_filter('the_excerpt', array(&$this, 'convert_shortcode'));
                		// add_filter('the_excerpt', 'do_shortcode', 11);
                
                		add_shortcode( 'singlepic', array(&$this, 'show_singlepic' ) );
                		add_shortcode( 'album', array(&$this, 'show_album' ) );
                		add_shortcode( 'nggallery', array(&$this, 'show_gallery') );
                		add_shortcode( 'nggallery_mod', array(&$this, 'show_gallery_mod') );
                		add_shortcode( 'imagebrowser', array(&$this, 'show_imagebrowser' ) );
                		add_shortcode( 'slideshow', array(&$this, 'show_slideshow' ) );
                		add_shortcode( 'nggtags', array(&$this, 'show_tags' ) );
                		add_shortcode( 'nggallery_tags', array(&$this, 'show_tags_single_gallery' ) );
                		add_shortcode( 'thumb', array(&$this, 'show_thumbs' ) );
                		add_shortcode( 'random', array(&$this, 'show_random' ) );
                		add_shortcode( 'recent', array(&$this, 'show_recent' ) );
                		add_shortcode( 'tagcloud', array(&$this, 'show_tagcloud' ) );
                	}
                
                	/**
                	 * NextGEN_shortcodes::convert_shortcode()
                	 * convert old shortcodes to the new WordPress core style
                	 * [gallery=1]  ->> [nggallery id=1]
                	 *
                	 * @param string $content Content to search for shortcodes
                	 * @return string Content with new shortcodes.
                	 */
                	function convert_shortcode($content) {
                
                		$ngg_options = nggGallery::get_option('ngg_options');
                
                		if ( stristr( $content, '[singlepic' )) {
                			$search = "@\[singlepic=(\d+)(|,\d+|,)(|,\d+|,)(|,watermark|,web20|,)(|,right|,center|,left|,)\]@i";
                			if (preg_match_all($search, $content, $matches, PREG_SET_ORDER)) {
                
                				foreach ($matches as $match) {
                					// remove the comma
                					$match[2] = ltrim($match[2], ',');
                					$match[3] = ltrim($match[3], ',');
                					$match[4] = ltrim($match[4], ',');
                					$match[5] = ltrim($match[5], ',');
                					$replace = "[singlepic id=\"{$match[1]}\" w=\"{$match[2]}\" h=\"{$match[3]}\" mode=\"{$match[4]}\" float=\"{$match[5]}\" ]";
                					$content = str_replace ($match[0], $replace, $content);
                				}
                			}
                		}
                
                		if ( stristr( $content, '[album' )) {
                			$search = "@(?:<p>)*\s*\[album\s*=\s*(\w+|^\+)(|,extend|,compact)\]\s*(?:</p>)*@i";
                			if (preg_match_all($search, $content, $matches, PREG_SET_ORDER)) {
                
                				foreach ($matches as $match) {
                					// remove the comma
                					$match[2] = ltrim($match[2],',');
                					$replace = "[album id=\"{$match[1]}\" template=\"{$match[2]}\"]";
                					$content = str_replace ($match[0], $replace, $content);
                				}
                			}
                		}
                
                		if ( stristr( $content, '[gallery' )) {
                			$search = "@(?:<p>)*\s*\[gallery\s*=\s*(\w+|^\+)\]\s*(?:</p>)*@i";
                			if (preg_match_all($search, $content, $matches, PREG_SET_ORDER)) {
                
                				foreach ($matches as $match) {
                					$replace = "[nggallery id=\"{$match[1]}\"]";
                					$content = str_replace ($match[0], $replace, $content);
                				}
                			}
                		}
                
                		if ( stristr( $content, '[imagebrowser' )) {
                			$search = "@(?:<p>)*\s*\[imagebrowser\s*=\s*(\w+|^\+)\]\s*(?:</p>)*@i";
                			if (preg_match_all($search, $content, $matches, PREG_SET_ORDER)) {
                
                				foreach ($matches as $match) {
                					$replace = "[imagebrowser id=\"{$match[1]}\"]";
                					$content = str_replace ($match[0], $replace, $content);
                				}
                			}
                		}
                
                		if ( stristr( $content, '[slideshow' )) {
                			$search = "@(?:<p>)*\s*\[slideshow\s*=\s*(\w+|^\+)(|,(\d+)|,)(|,(\d+))\]\s*(?:</p>)*@i";
                			if (preg_match_all($search, $content, $matches, PREG_SET_ORDER)) {
                
                				foreach ($matches as $match) {
                					// remove the comma
                					$match[3] = ltrim($match[3],',');
                					$match[5] = ltrim($match[5],',');
                					$replace = "[slideshow id=\"{$match[1]}\" w=\"{$match[3]}\" h=\"{$match[5]}\"]";
                					$content = str_replace ($match[0], $replace, $content);
                				}
                			}
                		}
                
                		if ( stristr( $content, '[tags' )) {
                			$search = "@(?:<p>)*\s*\[tags\s*=\s*(.*?)\s*\]\s*(?:</p>)*@i";
                			if (preg_match_all($search, $content, $matches, PREG_SET_ORDER)) {
                
                				foreach ($matches as $match) {
                					$replace = "[nggtags gallery=\"{$match[1]}\"]";
                					$content = str_replace ($match[0], $replace, $content);
                				}
                			}
                		}
                
                		if ( stristr( $content, '[albumtags' )) {
                			$search = "@(?:<p>)*\s*\[albumtags\s*=\s*(.*?)\s*\]\s*(?:</p>)*@i";
                			if (preg_match_all($search, $content, $matches, PREG_SET_ORDER)) {
                
                				foreach ($matches as $match) {
                					$replace = "[nggtags album=\"{$match[1]}\"]";
                					$content = str_replace ($match[0], $replace, $content);
                				}
                			}
                		}
                
                		// attach related images based on category or tags
                		if ($ngg_options['activateTags'])
                			$content .= nggShowRelatedImages();
                
                		return $content;
                	}
                
                	/**
                	 * Function to show a single picture:
                	 *
                	 *     [singlepic id="10" float="none|left|right" width="" height="" mode="none|watermark|web20" link="url" "template="filename" /]
                	 *
                	 * where
                	 *  - id is one picture id
                	 *  - float is the CSS float property to apply to the thumbnail
                	 *  - width is width of the single picture you want to show (original width if this parameter is missing)
                	 *  - height is height of the single picture you want to show (original height if this parameter is missing)
                	 *  - mode is one of none, watermark or web20 (transformation applied to the picture)
                	 *  - link is optional and could link to a other url instead the full image
                	 *  - template is a name for a gallery template, which is located in themefolder/nggallery or plugins/nextgen-gallery/view
                	 *
                	 * If the tag contains some text, this will be inserted as an additional caption to the picture too. Example:
                	 *      [singlepic id="10"]This is an additional caption[/singlepic]
                	 * This tag will show a picture with under it two HTML span elements containing respectively the alttext of the picture
                	 * and the additional caption specified in the tag.
                	 *
                	 * @param array $atts
                	 * @param string $caption text
                	 * @return the content
                	 */
                	function show_singlepic( $atts, $content = '' ) {
                
                		extract(shortcode_atts(array(
                				'id'        => 0,
                				'w'         => '',
                				'h'         => '',
                				'mode'      => '',
                				'float'     => '',
                				'link'      => '',
                				'template'  => ''
                		), $atts ));
                
                		$out = nggSinglePicture($id, $w, $h, $mode, $float, $template, $content, $link);
                
                		return $out;
                	}
                
                	/**
                	 * Function to show a collection of galleries:
                	 *
                	 * [album id="1,2,4,5,..." template="filename" gallery="filename" /]
                	 * where
                	 * - id of a album
                	 * - template is a name for a album template, which is located in themefolder/nggallery or plugins/nextgen-gallery/view
                	 * - template is a name for a gallery template, which is located in themefolder/nggallery or plugins/nextgen-gallery/view
                	 *
                	 * @param array $atts
                	 * @return the_content
                	 */
                	function show_album( $atts ) {
                
                		extract(shortcode_atts(array(
                				'id'        => 0,
                				'template'  => 'extend',
                				'gallery'   => ''
                		), $atts ));
                
                
                		$out = nggShowAlbum($id, $template, $gallery);
                
                		return $out;
                	}
                	/**
                	 * Function to show a thumbnail or a set of thumbnails with shortcode of type:
                	 *
                	 * [gallery id="1,2,4,5,..." template="filename" images="number of images per page" /]
                	 * where
                	 * - id of a gallery
                	 * - images is the number of images per page (optional), 0 will show all images
                	 * - template is a name for a gallery template, which is located in themefolder/nggallery or plugins/nextgen-gallery/view
                	 *
                	 * @param array $atts
                	 * @return the_content
                	 */
                	function show_gallery( $atts ) {
                
                		global $wpdb;
                
                		extract(shortcode_atts(array(
                				'id'        => 0,
                				'template'  => '',
                				'images'    => false
                		), $atts ));
                
                		// backward compat for user which uses the name instead, still deprecated
                		if( !is_numeric($id) )
                			$id = $wpdb->get_var( $wpdb->prepare ("SELECT gid FROM $wpdb->nggallery WHERE name = '%s' ", $id) );
                
                		$out = nggShowGallery( $id, $template, $images );
                
                		return $out;
                	}
                
                	function show_gallery_mod( $atts ) {
                
                		global $wpdb;
                
                		extract(shortcode_atts(array(
                				'id'        => 0,
                				'template'  => '',
                				'images'    => false,
                				'onclick'   => ''
                		), $atts ));
                
                		// backward compat for user which uses the name instead, still deprecated
                		if( !is_numeric($id) )
                			$id = $wpdb->get_var( $wpdb->prepare ("SELECT gid FROM $wpdb->nggallery WHERE name = '%s' ", $id) );
                
                		$out = nggShowGalleryMod( $id, $template, $images, $onclick );
                
                		return $out;
                	}
                
                	function show_imagebrowser( $atts ) {
                
                		global $wpdb;
                
                		extract(shortcode_atts(array(
                				'id'        => 0,
                				'template'  => ''
                		), $atts ));
                
                		$out = nggShowImageBrowser($id, $template);
                
                		return $out;
                	}
                
                	function show_slideshow( $atts ) {
                
                		global $wpdb;
                
                		extract(shortcode_atts(array(
                				'id'        => 0,
                				'w'         => '',
                				'h'         => ''
                		), $atts ));
                
                		if( !is_numeric($id) )
                			$id = $wpdb->get_var( $wpdb->prepare ("SELECT gid FROM $wpdb->nggallery WHERE name = '%s' ", $id) );
                
                		if( !empty( $id ) )
                			$out = nggShowSlideshow($id, $w, $h);
                		else
                			$out = __('[Gallery not found]','nggallery');
                
                		return $out;
                	}
                
                	function show_tags( $atts ) {
                
                		$temp = str_replace('-', ' ', $atts['gallery']);
                		$temp = ucwords($temp);
                		$GLOBALS['ngg_shortcode'] = $temp;
                		extract(shortcode_atts(array(
                				'gallery'       => '',
                				'album'         => ''
                		), $atts ));
                
                		if ( !empty($album) )
                			$out = nggShowAlbumTags($album);
                		else
                			$out = nggShowGalleryTags($gallery);
                		return $out;
                	}
                
                
                
                	function show_tags_single_gallery( $atts ) {
                
                		$temp = str_replace('-', ' ', $atts['gallery']);
                		$temp = ucwords($temp);
                		$GLOBALS['ngg_shortcode'] = $temp;
                		extract(shortcode_atts(array(
                				'gallery'       => '',
                				'tags'          => ''
                		), $atts ));
                
                		$out = nggShowSingleGalleryTags($gallery, $tags);
                		return $out;
                	}
                
                
                	/**
                	 * Function to show a thumbnail or a set of thumbnails with shortcode of type:
                	 *
                	 * [thumb id="1,2,4,5,..." template="filename" /]
                	 * where
                	 * - id is one or more picture ids
                	 * - template is a name for a gallery template, which is located in themefolder/nggallery or plugins/nextgen-gallery/view
                	 *
                	 * @param array $atts
                	 * @return the_content
                	 */
                	function show_thumbs( $atts ) {
                
                		extract(shortcode_atts(array(
                				'id'        => '',
                				'template'  => ''
                		), $atts));
                
                		// make an array out of the ids
                		$pids = explode( ',', $id );
                
                		// Some error checks
                		if ( count($pids) == 0 )
                			return __('[Pictures not found]','nggallery');
                
                		$picturelist = nggdb::find_images_in_list( $pids );
                
                		// show gallery
                		if ( is_array($picturelist) )
                			$out = nggCreateGallery($picturelist, false, $template);
                
                		return $out;
                	}
                
                	/**
                	 * Function to show a gallery of random or the most recent images with shortcode of type:
                	 *
                	 * [random max="7" template="filename" id="2" /]
                	 * [recent max="7" template="filename" id="3" mode="date" /]
                	 * where
                	 * - max is the maximum number of random or recent images to show
                	 * - template is a name for a gallery template, which is located in themefolder/nggallery or plugins/nextgen-gallery/view
                	 * - id is the gallery id, if the recent/random pictures shall be taken from a specific gallery only
                	 * - mode is either "id" (which takes the latest additions to the databse, default)
                	 *               or "date" (which takes the latest pictures by EXIF date)
                	 *               or "sort" (which takes the pictures by user sort order)
                	 *
                	 * @param array $atts
                	 * @return the_content
                	 */
                	function show_random( $atts ) {
                
                		extract(shortcode_atts(array(
                				'max'       => '',
                				'template'  => '',
                				'id'        => 0
                		), $atts));
                
                		$out = nggShowRandomRecent('random', $max, $template, $id);
                
                		return $out;
                	}
                
                	function show_recent( $atts ) {
                
                		extract(shortcode_atts(array(
                				'max'       => '',
                				'template'  => '',
                				'id'        => 0,
                				'mode'      => 'id'
                		), $atts));
                
                		$out = nggShowRandomRecent($mode, $max, $template, $id);
                
                		return $out;
                	}
                
                	/**
                	 * Shortcode for the Image tag cloud
                	 * Usage : [tagcloud template="filename" /]
                	 *
                	 * @param array $atts
                	 * @return the content
                	 */
                	function show_tagcloud( $atts ) {
                
                		extract(shortcode_atts(array(
                				'template'  => ''
                		), $atts));
                
                		$out = nggTagCloud( '', $template );
                
                		return $out;
                	}
                
                }
                
                // let's use it
                $nggShortcodes = new NextGEN_Shortcodes_mod;                
                
                
                function my_load_loop_view($view, $data) {
                	//if (is_home() || is_front_page()) {
                		//$view = 'views/cfct-module-loop-view.php';
                		$view = '/data/wordpress/imomags/wp-content/themes/imo-mags-floridasportsman/views/cfct-module-loop-view.php';
                	//}
                	return $view;
                }
                add_filter('cfct-module-loop-view', 'my_load_loop_view', 1, 2);                
               
                
                
                /**
                 * nggShowImageBrowser()
                 *
                 * @access public
                 * @param int|string $galleryID or gallery name
                 * @param string $template (optional) name for a template file, look for imagebrowser-$template
                 * @return the content
                 */
                function nggShowImageBrowserMod($galleryID, $template = '', $tags = '') {
                
                	global $wpdb;
                	
                	$ngg_options = nggGallery::get_option('ngg_options');
                
                	//Set sort order value, if not used (upgrade issue)
                	$ngg_options['galSort'] = ($ngg_options['galSort']) ? $ngg_options['galSort'] : 'pid';
                	$ngg_options['galSortDir'] = ($ngg_options['galSortDir'] == 'DESC') ? 'DESC' : 'ASC';
                
                	// get the pictures
                	
                	
                	
                	
                	
                	
                	
                	
                	if (empty($tags))
                		$picturelist = nggdb::get_gallery($galleryID, $ngg_options['galSort'], $ngg_options['galSortDir']);
                	else{
                		$picturelist = nggTags::find_images_for_tags($tags , 'ASC');
                	
                	
	                	// filter through the picture list and remove images from other galleries
	                	foreach($picturelist as $key => $picture){
	                		if ($picture->galleryid != $galleryID){
                	
    	            			unset($picturelist[$key]);
    	
	        	        	}
	                	
	                	}
	                	//normalize the array if any elements were removed
	                	$picturelist = array_values($picturelist);
                	}
                	
             	
                	
                	
                
                	if ( is_array($picturelist) )
                		$out = nggCreateImageBrowser($picturelist, $template);
                	else
                		$out = __('[Gallery not found]','nggallery');
                
                	$out = apply_filters('ngg_show_imagebrowser_content', $out, $galleryID);
                	
                	if (strpos($out, "thickbox") === false){
                		$out = preg_replace('/" title/', '" class="thickbox no_icon" rel="gallery-3826" title' , $out );
                	}                	
                	return $out;
                
                } 
      
            class FLSP_nggLoader extends nggLoader{    

            	
            	function FLSP_nggLoader() {
            	
            		// Stop the plugin if we missed the requirements
            		if ( ( !$this->required_version() ) || ( !$this->check_memory_limit() ) )
            			return;
            			
            		// Get some constants first
            		$this->load_options();
            		$this->define_constant();
            		$this->define_tables();
            		//$this->load_dependencies();
            		$this->start_rewrite_module();
            	
            		$this->plugin_name = basename(dirname(__FILE__)).'/'.basename(__FILE__);
            	
            		// Init options & tables during activation & deregister init option
            		register_activation_hook( $this->plugin_name, array(&$this, 'activate') );
            		register_deactivation_hook( $this->plugin_name, array(&$this, 'deactivate') );
            	
            		// Register a uninstall hook to remove all tables & option automatic
            		register_uninstall_hook( $this->plugin_name, array('nggLoader', 'uninstall') );
            	
            		// Start this plugin once all other plugins are fully loaded
            		add_action( 'plugins_loaded', array(&$this, 'start_plugin') );
            	
            		// Register_taxonomy must be used during the init
            		add_action( 'init', array(&$this, 'register_taxonomy') );
            	
            		// Hook to upgrade all blogs with one click and adding a new one later
            		add_action( 'wpmu_upgrade_site', array(&$this, 'multisite_upgrade') );
            		add_action( 'wpmu_new_blog', array(&$this, 'multisite_new_blog'), 10, 6);
            	
            		// Add a message for PHP4 Users, can disable the update message later on
            		if (version_compare(PHP_VERSION, '5.0.0', '<'))
            			add_filter('transient_update_plugins', array(&$this, 'disable_upgrade'));
            	
            		//Add some links on the plugin page
            		add_filter('plugin_row_meta', array(&$this, 'add_plugin_links'), 10, 2);
            	
            		// Check for the header / footer
            		add_action( 'init', array(&$this, 'test_head_footer_init' ) );
            	
            		// Show NextGEN version in header
            		add_action('wp_head', array('nggGallery', 'nextgen_version') );
            	
            	}
            	            	
            	
            	
                function load_scripts() {
                	$this->options['thumbEffect'] = "shutter";
                	// if you don't want that NGG load the scripts, add this constant
                	if ( defined('NGG_SKIP_LOAD_SCRIPTS') )
                		return;
                
                	//	activate Thickbox
                	if ($this->options['thumbEffect'] == 'thickbox') {
                		wp_enqueue_script( 'thickbox' );
                		// Load the thickbox images after all other scripts
                		add_action( 'wp_footer', array(&$this, 'load_thickbox_images'), 11 );
                
                	}
                
                	// activate modified Shutter reloaded if not use the Shutter plugin
                	if ( ($this->options['thumbEffect'] == "shutter") && !function_exists('srel_makeshutter') ) {
                		wp_register_script('shutter', NGGALLERY_URLPATH .'shutter/shutter-reloaded.js', false ,'1.3.3');
                		wp_localize_script('shutter', 'shutterSettings', array(
                				'msgLoading' => __('L O A D I N G', 'nggallery'),
                				'msgClose' => __('Click to Close', 'nggallery'),
                				'imageCount' => '1'
                		) );
                		wp_enqueue_script( 'shutter' );
                	}
                
                	// required for the slideshow
                	if ( NGGALLERY_IREXIST == true && $this->options['enableIR'] == '1' && nggGallery::detect_mobile_phone() === false )
                		wp_enqueue_script('swfobject', NGGALLERY_URLPATH .'admin/js/swfobject.js', FALSE, '2.2');
                	else {
                		wp_register_script('jquery-cycle', NGGALLERY_URLPATH .'js/jquery.cycle.all.min.js', array('jquery'), '2.9995');
                		wp_enqueue_script('ngg-slideshow', NGGALLERY_URLPATH .'js/ngg.slideshow.min.js', array('jquery-cycle'), '1.05');
                
                	}
                
                	// Load AJAX navigation script, works only with shutter script as we need to add the listener
                	//if ( $this->options['galAjaxNav'] ) {
                
                	$pid = get_query_var('pid');

                	if ( !empty($pid) ) {
                		if ( ($this->options['thumbEffect'] == "shutter") || function_exists('srel_makeshutter') ) {
                			wp_enqueue_script ( 'ngg_script', NGGALLERY_URLPATH . 'js/ngg.js', array('jquery'), '2.1');
                			wp_localize_script( 'ngg_script', 'ngg_ajax', array('path'		=> NGGALLERY_URLPATH,
                					'callback'  => home_url() . '/' . 'index.php?callback=ngg-ajax&tags='.$_GET['tags'],
                					'loading'	=> __('loading', 'nggallery'),
                			) );
                		}
                	}
                
                }

                function check_request( $wp ) {


                	if ( !array_key_exists('callback', $wp->query_vars) ){
                		
                		return;
                	}
                	if ( $wp->query_vars['callback'] == 'imagerotator') {
                		require_once (dirname (__FILE__) . '/xml/imagerotator.php');
                		exit();
                	}
                
                	if ( $wp->query_vars['callback'] == 'json') {
                		require_once (dirname (__FILE__) . '/xml/json.php');
                		exit();
                	}
                
                	if ( $wp->query_vars['callback'] == 'image') {
                		require_once (dirname (__FILE__) . '/nggshow.php');
                		exit();
                	}
                
                	//TODO:see trac #12400 could be an option for WP3.0
                	if ( $wp->query_vars['callback'] == 'ngg-ajax') {
                		//require_once (dirname (__FILE__) . '/xml/ajax.php');
                		$this->load_ajax();
                		
                		exit();
                	}
                
                }                
                
            

            function load_ajax(){
            	
            	// check if we have all needed parameter
            	if ( !defined('ABSPATH') || (!isset($_GET['galleryid']) || !is_numeric($_GET['galleryid'])) || (!isset($_GET['p']) || !is_numeric($_GET['p'])) || !isset($_GET['type'])){
            		// if it's not ajax request, back to main page
            		if($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')
            			header('Location: http://'. $_SERVER['HTTP_HOST']);
            		die();
            	}
            	
            	switch ($_GET['type']) {
            		case 'gallery':
            	
            			// get the navigation page
            			set_query_var('nggpage', intval($_GET['nggpage']));
            	
            			// get the current page/post id
            			set_query_var('pageid', intval($_GET['p']));
            			set_query_var('show', 'gallery');
            			$GLOBALS['id'] = intval($_GET['p']);
            	
            			echo nggShowGallery( intval($_GET['galleryid']) );
            	
            			break;
            		case 'browser':
            	
            			// which image should be shown ?
            			set_query_var('pid', intval($_GET['pid']));
            	
            			// get the current page/post id
            			set_query_var('pageid', intval($_GET['p']));
            			$GLOBALS['id'] = intval($_GET['p']);
            				
            			//echo nggShowImageBrowser( intval($_GET['galleryid']) );
            	
            			echo nggShowImageBrowserMod( intval($_GET['galleryid']), '', $_GET['tags'] );
            			
            			break;
            		default:
            			echo 'Wrong request type specified.';
            	}            	
            	
            }
            }
            
            global $ngg;
            
            $ngg = new FLSP_nggLoader();
            
            add_action('template_redirect', array($ngg, 'load_scripts'), 1 );
            add_action('parse_request',  array($ngg, 'check_request'), 1 );
            add_action( 'plugins_loaded', array($ngg, 'start_plugin'), 1 );            
            
                
                
                
    ?>
