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
		set_post_thumbnail_size( 190, 120, true );
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

/**
function restrict_posts_by_column() {
		global $typenow;
		$post_type = 'post'; // change HERE
		$taxonomy = 'column'; // change HERE
		if ($typenow == $post_type) {
			$selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
			$info_taxonomy = get_taxonomy($taxonomy);
			wp_dropdown_categories(array(
				'show_option_all' => __("Show All {$info_taxonomy->label}"),
				'taxonomy' => $taxonomy,
				'name' => $taxonomy,
				'orderby' => 'name',
				'selected' => $selected,
				'show_count' => true,
				'hide_empty' => true,
			));
		};
	}

	add_action('restrict_manage_posts', 'restrict_posts_by_column');
	
	 */

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



    add_rewrite_rule( '(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/?$','index.php?$matches[1]=$matches[2]&$matches[3]=$matches[4]&$matches[5]=$matches[6]&$matches[7]=$matches[8]&$matches[9]=$matches[10]&$matches[11]=$matches[12]&$matches[13]=$matches[14])', 'top');
    add_rewrite_rule('(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/?$' , 'index.php?$matches[1]=$matches[2]&$matches[3]=$matches[4]&$matches[5]=$matches[6]&$matches[7]=$matches[8]&$matches[9]=$matches[10]&$matches[11]=$matches[12]', 'top');
    add_rewrite_rule('(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/?$' , 'index.php?$matches[1]=$matches[2]&$matches[3]=$matches[4]&$matches[5]=$matches[6]&$matches[7]=$matches[8]&$matches[9]=$matches[10]', 'top');
    
    add_rewrite_rule('(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/?$' , 'index.php?$matches[1]=$matches[2]&$matches[3]=$matches[4]&$matches[5]=$matches[6]&$matches[7]=$matches[8]', 'top');
    
    add_rewrite_rule('(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/?$' , 'index.php?$matches[1]=$matches[2]&$matches[3]=$matches[4]&$matches[5]=$matches[6]', 'top');
    add_rewrite_rule('(show|region|species|marketplace|activity|gear|column)/(.+)/(show|region|species|marketplace|activity|gear|column)/(.+)/?$' , 'index.php?$matches[1]=$matches[2]&$matches[3]=$matches[4]', 'top'); 
    add_rewrite_rule('(show|region|species|marketplace|activity|gear|column)/(.+)/?$' , 'index.php?$matches[1]=$matches[2]', 'top');
    

    //add_rewrite_tag('%gallery%','([^/]+)');
    //add_rewrite_tag('%album%','([^/]+)');




   // add_rewrite_rule('^galleries/([^/]+)/?$', 'index.php?pagename=galleries&album=1&gallery=$matches[1]','top');
    //add_rewrite_rule('^tag/([^/]+)/?$', 'index.php?pagename=galleries/photos-by-tag&gallerytag=$matches[1]','top');
    //add_rewrite_rule('^galleries/tag/([^/]+)/?$', 'index.php?pagename=galleries&gallerytag=$matches[1]','top');


    

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
                                                                                                                                                  
                        );


    $show_ui = true;
    // globalize it so that we can call methods on the returned object
    global $my_cpt_filters;
    
    
    $my_cpt_filters = tribe_setup_apm('post', $filter_array );
    $my_cpt_filters->add_taxonomies = false;


}
