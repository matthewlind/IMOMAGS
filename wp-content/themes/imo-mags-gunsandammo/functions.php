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


//Add Scripts for Reviews Section
add_action( 'init', 'imo_mags_ga_scripts' );
function imo_mags_ga_scripts() {
  wp_enqueue_script(
    'imo-ga-reviews',
    get_stylesheet_directory_uri() . '/js/reviews.js',
    array('jquery')
  );
}



// Add new image size for post lists
add_image_size('post-thumb', 226, 147, true);
add_image_size('post-slide', 640, 350, true);
add_image_size('huge-thumb', 648, 370, true);

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
      'id' => 'sidebar-ad',
      'name' => 'Homepage Trending Ad',
      'description' => 'Shown on the left of the trending section on the Homepage.',
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
  
  register_sidebar(array_merge($sidebar_defaults, array(
  		'name' => 'Reviews Sidebar',
		'id' => 'reviews_sidebar',
		'description' => 'Appears on pages that are Reviews',
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
add_action( 'widgets_init', 'ga_cfct_widgets_init' );


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


<<<<<<< HEAD
function my_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );
}    
 
add_action('wp_enqueue_scripts', 'my_scripts_method');
=======

/*
** Add JSON feeds for AJAX requests
**
*/
add_action("init", "imo_ga_json");

function imo_ga_json() {

    //caliber.json
    if (preg_match("/^\/caliber\.json(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) {
        header('Content-type: application/json');
    
        if($_GET['manufacturer']){
         

            $parentSlug = $_GET['manufacturer'];

            $terms = array();
  
            $parentTerm = get_term_by("slug",$parentSlug,"manufacturer");

            $id = $parentTerm->term_id;
            $taxonomyName = 'manufacturer';
            $termchildren = get_term_children( $id, "manufacturer" );
                foreach ($termchildren as $child) {
                    $term = get_term_by( 'id', $child, $taxonomyName );
                    $terms[] = $term;
                }

            $json = json_encode($terms);
            print $json;
                
        }


        die();

    }   

    //reviews.json
    if (preg_match("/^\/reviews\.json(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) {
        header('Content-type: application/json');

        $args['post_type'] = 'reviews';

        if($_GET['manufacturer']) {
            $args['manufacturer'] = $_GET['manufacturer'];
        }

        if($_GET['guntype']) {
            $args['guntype'] = $_GET['guntype'];
        }        

        $query = new WP_Query( $args );

        $dataArray = array();

        while ( $query->have_posts() ) : $query->the_post();



            $review = array();
            
            $review['title'] = get_the_title();
            $review['id'] = get_the_ID();
            $review['date'] = get_the_time('F jS, Y');
            $review['permalink'] = get_permalink();
            $review['comment_count'] = get_comments_number();
            $review['thumbnail'] = get_the_post_thumbnail(null,null, array('class' => 'entry-img'));


            $review['excerpt'] = get_the_excerpt();
            

            $dataArray[] = $review;
        endwhile;

        // $dataArray = array();

        // foreach ($poll_answers as $data) {
        //     $dataArray[] = array($data->polla_answers,(int)$data->polla_votes);
        // }

         $json = json_encode($dataArray);



         print $json;
        die();
    } 


}
>>>>>>> aa223ef3428fe6f5c557aecbc3abe91cf67df9ad

/*
** QUERY MULTIPLE TAXONOMIES WITH POST TYPE
**
*/
function wpse_5057_match_multiple_taxonomy_terms($where_clause, $wp_query) {

    // If the query obj exists
    if (isset($wp_query->query)) {

        $multi_query = $wp_query->query;

        if (is_array($multi_query) && isset($multi_query['multiple_terms'])) {

            global $wpdb;
            $arr_terms = $multi_query['multiple_terms'];

            foreach($arr_terms as $key => $value) {

                $sql = "AND $wpdb->posts.ID IN(
                    SELECT tr.object_id
                    FROM $wpdb->term_relationships AS tr
                    INNER JOIN $wpdb->term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
                    INNER JOIN $wpdb->terms AS t ON tt.term_id = t.term_id
                    WHERE tt.taxonomy='%s' AND t.term_id='%s')";

                $where_clause .= $wpdb->prepare($sql, $key, $value); // add to the where

            }
        }

    }

    return $where_clause; // return the filtered where

}
add_action('posts_where','wpse_5057_match_multiple_taxonomy_terms',10,2); // Hook this to posts_where

