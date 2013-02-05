<?php
/**
 * functions.php 
 */

define("JETPACK_SITE", "gunsammo");
define("DARTADGEN_SITE", "imo.gunsandammo");
define("SUBS_LINK", "http://subs.gunsandammo.com");
define("GIFT_LINK", "http://subs.gunsandammo.com/gift");
define("SERVICE_LINK", "http://subs.gunsandammo.com/service");
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

add_action( 'init', 'register_pd_menu' );

function register_pd_menu() {
	register_nav_menu( 'pdtv-menu', __( 'PD Menu' ) );
}

/*Remove Pages From Search*/
function ga_remove_pages_from_search() {
    global $wp_post_types;
    $wp_post_types['page']->exclude_from_search = true;
}
add_action('init', 'ga_remove_pages_from_search');


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
		'id' => 'reviews-sidebar',
		'description' => 'Appears on pages that are Reviews',
)));
  register_sidebar(array_merge($sidebar_defaults, array(
  		'name' => 'Shooting Sidebar',
		'id' => 'shooting-sidebar',
		'description' => 'Appears on pages that are Shooting',
)));
  register_sidebar(array_merge($sidebar_defaults, array(
  		'name' => 'Caption Contest Sidebar',
		'id' => 'cc-sidebar',
		'description' => 'Appears on pages that are Caption Contests',
)));
  register_sidebar(array_merge($sidebar_defaults, array(
  		'name' => 'Affiliate Sidebar',
		'id' => 'affiliate-sidebar',
		'description' => 'Appears on Affiliate Page',
)));
 register_sidebar(array_merge($sidebar_defaults, array(
		'name' => 'Shot Show Sidebar',
		'id' => 'shot-show-sidebar',
		'description' => 'Shot Show Sidebar',
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
include_once get_stylesheet_directory().'/widgets/ipad-app-reloaded.php';
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
	        <h3 class="month">'.date("F, Y").'</h3>
	        <img src="'.$magazine_img.'" alt />
	        </div>
	        <ul class="subscriber-links">
	        <li class="subscribe"><a href="'.SUBS_LINK.'">Subscribe</a></li>
	        <li><a href="'.SUBS_LINK.'">Give a Gift</a></li>
          <li><a href="'.SERVICE_LINK.'">Subscriber Services</a></li>
	        </ul>';
}

add_shortcode("mm-current-issue", "mm_current_issue");



/***
**
** Enqueue Scripts
**
***/
function my_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script("cross-site-feed", get_stylesheet_directory_uri() . "/js/cross-site-feed.js");
}    
 
add_action('wp_enqueue_scripts', 'my_scripts_method');


/*
** Add JSON feeds for AJAX requests
**
*/
add_action("init", "imo_ga_json");

function imo_ga_json() {

    //manufacturer.json
    if (preg_match("/^\/manufacturer\.json(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) {
        header('Content-type: application/json');
    
        if($_GET['guntype']){
         

            $guntypeSlug = $_GET['guntype'];

            $terms = array();

            $guntypeTerm = get_term_by("slug",$guntypeSlug,"guntype");
            $guntypeTermID = $guntypeTerm->term_taxonomy_id;

            global $wpdb;

            $sql = $wpdb->prepare("SELECT DISTINCT term_slug, term_name FROM `wp_2_term_relationships` tr
                                            RIGHT JOIN `wp_2_manufacturer_posts` mp ON mp.post_id = tr.`object_id`
                                            WHERE `term_taxonomy_id` = '%d' ",$guntypeTermID);

            $rows = $wpdb->get_results($sql);

     
  
            $parentTerm = get_term_by("slug",$parentSlug,"manufacturer");


            foreach ($rows as $row) {
                //$term = get_term_by( 'id', $child, $taxonomyName );
                $row->name = $row->term_name;
                $row->slug = $row->term_slug;
                $terms[] = $row;
            }

            $json = json_encode($terms);
            print $json;
                
        }


        die();

    }   

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
            $review['thumbnail'] = get_the_post_thumbnail(null,"post-thumb", array('class' => 'entry-img'));
            $review['imo_slider_thumb'] = get_the_post_thumbnail(null,"imo-slider-thumb", array('class' => 'entry-img'));

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

// Add to admin_init function
add_action('save_post', 'save_category_data', 50 );
 
function save_category_data($post_id) {  
    // verify this came from the our screen and with proper authorization.
    if ( !wp_verify_nonce( array($_POST['post_category[]']), $post_id )) {
        return $post_id;
    }

    // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
        return $post_id;
     
    // Check permissions
    if ( !current_user_can( 'edit_post', $post_id ) )
        return $post_id;
   
       
  
    // OK, we're authenticated: we need to find and save the data   
    $post = get_post($post_id);

    //if ($post->post_type == 'post') { 
        //update_post_meta($post_id, '_gallery_type', esc_attr($_POST['gallery_type']) );
                //return(esc_attr($_POST['gallery_type']));
     $terms = array($_POST['post_category[]']); 
     wp_set_post_categories($post_id, $terms);
    return(esc_attr($terms));
        	
   // }

    return $post_id;
   
}

// remove the old CATEGORY box
function remove_default_categories_box() {
    remove_meta_box('categorydiv', 'post', 'side');
}
add_action( 'admin_head', 'remove_default_categories_box' );



// add the new box
function add_custom_categories_box() {
    add_meta_box('customcategorydiv', 'Post Placement', 'custom_post_categories_meta_box', 'post', 'side', 'high', array( 'taxonomy' => 'category' ));
}
add_action('admin_menu', 'add_custom_categories_box');

/**
 *
 * Post Placement custom list.
 *
*/
function custom_terms_checklist($post_id = 0, $args = array()) {
	        $defaults = array(
	                'descendants_and_self' => 0,
	                'selected_cats' => false,
	                'popular_cats' => false,
	                'walker' => null,
	                'taxonomy' => 'category',
	                'checked_ontop' => true
	        );
	        $args = apply_filters( 'custom_terms_checklist_args', $args, $post_id );
	        
	        //Convert the slugs to ids for the list
	        $featured = get_term_by( 'slug', 'featured', 'category' );
	        $galleries = get_term_by( 'slug', 'galleries', 'category' );
	        $ga_lists = get_term_by( 'slug', 'ga-lists', 'category' );
	        $blogs = get_term_by( 'slug', 'blogs', 'category' );
	        $defend_thyself = get_term_by( 'slug', 'defend-thyself', 'category' );
	        $competition = get_term_by( 'slug', 'for-the-love-of-competition', 'category' );
	        $history = get_term_by( 'slug', 'history-books', 'category' );
	        $news_brief = get_term_by( 'slug', 'news-brief', 'category' );
	        $soga = get_term_by( 'slug', 'sons-of-guns-and-ammo', 'category' );
	        $front_lines = get_term_by( 'slug', 'the-front-lines', 'category' );
	        $zombie = get_term_by( 'slug', 'zombie-nation', 'category' );
	        $video = get_term_by( 'slug', 'video', 'category' );
	        $gatv = get_term_by( 'slug', 'ga-tv', 'category' );
	        $pdtv = get_term_by( 'slug', 'pd-tv', 'category' );
	        $affiliates = get_term_by( 'slug', 'affiliates', 'category' );
	        $perspectives = get_term_by( 'slug', 'perspectives', 'category' );
	        $mots = get_term_by( 'slug', 'man-on-the-street', 'category' );
		        
		    // Create the ID array
		    $include = array(
		    	$featured->term_id,$galleries->term_id,$ga_lists->term_id,$blogs->term_id,
		        $defend_thyself->term_id,$competition->term_id,$history->term_id,$news_brief->term_id,
		        $soga->term_id,$front_lines->term_id,$zombie->term_id,$video->term_id,$gatv->term_id,
		        $pdtv->term_id,$affiliates->term_id,$perspectives->term_id,$mots->term_id
		    );
		    
	        extract( wp_parse_args($args, $defaults), EXTR_SKIP );
	
	        if ( empty($walker) || !is_a($walker, 'Walker') )
	                $walker = new Walker_Category_Checklist;
	
	        $descendants_and_self = (int) $descendants_and_self;
	
	        $args = array('taxonomy' => $taxonomy);
	
	        $tax = get_taxonomy($taxonomy);
	        $args['disabled'] = !current_user_can($tax->cap->assign_terms);
	        
	        if ( is_array( $selected_cats ) )
	                $args['selected_cats'] = $selected_cats;
	        elseif ( $post_id )
	                $args['selected_cats'] = wp_get_object_terms($post_id, $taxonomy, array_merge($args, array('fields' => 'ids')));
	        else
	                $args['selected_cats'] = array();
	
	        if ( is_array( $popular_cats ) )
	                $args['popular_cats'] = $popular_cats;
	        else
	                $args['popular_cats'] = get_terms( $taxonomy, array( 'fields' => 'ids', 'orderby' => 'count', 'order' => 'DESC', 'number' => 10, 'hierarchical' => false ) );
	
	        if ( $descendants_and_self ) {
	                $categories = (array) get_terms($taxonomy, array( 'child_of' => $descendants_and_self, 'hierarchical' => 0, 'hide_empty' => 0 ) );
	                $self = get_term( $descendants_and_self, $taxonomy );
	                array_unshift( $categories, $self );
	        } else {
	        	
	        	    $categories = (array) get_terms($taxonomy, array( 'child_of' => $descendants_and_self, 'include' => $include));
	        }
	
	        if ( $checked_ontop ) {
	                // Post process $categories rather than adding an exclude to the get_terms() query to keep the query the same across all posts (for any query cache)
	                $checked_categories = array();
	                $keys = array_keys( $categories );
	
	                foreach( $keys as $k ) {
	                        if ( in_array( $categories[$k]->term_id, $args['selected_cats'] ) ) {
	                                $checked_categories[] = $categories[$k];
	                                unset( $categories[$k] );
	                        }
	                }
	
	                // Put checked cats on top
	                echo call_user_func_array(array(&$walker, 'walk'), array($checked_categories, 0, $args));
	        }
	        // Then the rest of them
	        echo call_user_func_array(array(&$walker, 'walk'), array($categories, 0, $args));
}

/**
 * Display CUSTOM post categories form fields.
 *
 * @since 2.6.0
 *
 * @param object $post
*/
function custom_post_categories_meta_box( $post, $box ) {
    $defaults = array('taxonomy' => 'category');
    if ( !isset($box['args']) || !is_array($box['args']) )
        $args = array();
    else
        $args = $box['args'];
    extract( wp_parse_args($args, $defaults), EXTR_SKIP );
    $tax = get_taxonomy($taxonomy);

    ?>
    <div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv">
       
        <div id="<?php echo $taxonomy; ?>-pop" class="tabs-panel" style="display: none;">
            <ul id="<?php echo $taxonomy; ?>checklist-pop" class="categorychecklist form-no-clear" >
                <?php $popular_ids = wp_popular_terms_checklist($taxonomy); ?>
            </ul>
        </div>

        <div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
            <?php
            $name = ( $taxonomy == 'category' ) ? 'post_category' : 'tax_input[' . $taxonomy . ']';
            echo "<input type='hidden' name='{$name}' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
            ?>
            <ul id="<?php echo $taxonomy; ?>checklist" class="list:<?php echo $taxonomy?> categorychecklist form-no-clear">
                <?php custom_terms_checklist($post->ID, array( 'taxonomy' => $taxonomy, 'popular_cats' => $popular_ids ) ) ?>
            </ul>
        </div>
         
    </div>
    <?php 
}







// add the new box
function add_custom_gun_terminology_box() {
    add_meta_box('customcategorydiv2', 'Gun Terminology', 'custom_post_gun_terminology_meta_box', 'post', 'side', 'high', array( 'taxonomy' => 'category' ));
}
add_action('admin_menu', 'add_custom_gun_terminology_box');

/**
 *
 * Post Placement custom list.
 *
*/
function custom_gun_terminology_checklist($post_id = 0, $args = array()) {
	        $defaults = array(
	                'descendants_and_self' => 0,
	                'selected_cats' => false,
	                'popular_cats' => false,
	                'walker' => null,
	                'taxonomy' => 'category',
	                'checked_ontop' => true
	        );
	        $args = apply_filters( 'custom_gun_terminology_checklist_args', $args, $post_id );
	
	        extract( wp_parse_args($args, $defaults), EXTR_SKIP );
	
	        if ( empty($walker) || !is_a($walker, 'Walker') )
	                $walker = new Walker_Category_Checklist;
	
	        $descendants_and_self = (int) $descendants_and_self;
	
	        $args = array('taxonomy' => $taxonomy);
	
	        $tax = get_taxonomy($taxonomy);
	        $args['disabled'] = !current_user_can($tax->cap->assign_terms);
	
	        if ( is_array( $selected_cats ) )
	                $args['selected_cats'] = $selected_cats;
	        elseif ( $post_id )
	                $args['selected_cats'] = wp_get_object_terms($post_id, $taxonomy, array_merge($args, array('fields' => 'ids')));
	        else
	                $args['selected_cats'] = array();
	
	        if ( is_array( $popular_cats ) )
	                $args['popular_cats'] = $popular_cats;
	        else
	                $args['popular_cats'] = get_terms( $taxonomy, array( 'fields' => 'ids', 'orderby' => 'count', 'order' => 'DESC', 'number' => 10, 'hierarchical' => false ) );
	
	        if ( $descendants_and_self ) {
	                $categories = (array) get_terms($taxonomy, array( 'child_of' => $descendants_and_self, 'hierarchical' => 0, 'hide_empty' => 0 ) );
	                $self = get_term( $descendants_and_self, $taxonomy );
	                array_unshift( $categories, $self );
	        } else {
	                $categories = (array) get_terms($taxonomy, array( 'child_of' => $descendants_and_self, 'include' => array(2829,1)));
	        }
	
	        if ( $checked_ontop ) {
	                // Post process $categories rather than adding an exclude to the get_terms() query to keep the query the same across all posts (for any query cache)
	                $checked_categories = array();
	                $keys = array_keys( $categories );
	
	                foreach( $keys as $k ) {
	                        if ( in_array( $categories[$k]->term_id, $args['selected_cats'] ) ) {
	                                $checked_categories[] = $categories[$k];
	                                unset( $categories[$k] );
	                        }
	                }
	
	                // Put checked cats on top
	                echo call_user_func_array(array(&$walker, 'walk'), array($checked_categories, 0, $args));
	        }
	        // Then the rest of them
	        echo call_user_func_array(array(&$walker, 'walk'), array($categories, 0, $args));
}

/**
 * Display CUSTOM post categories form fields.
 *
 * @since 2.6.0
 *
 * @param object $post
*/
function custom_post_gun_terminology_meta_box( $post, $box ) {
    $defaults = array('taxonomy' => 'category');
    if ( !isset($box['args']) || !is_array($box['args']) )
        $args = array();
    else
        $args = $box['args'];
    extract( wp_parse_args($args, $defaults), EXTR_SKIP );
    $tax = get_taxonomy($taxonomy);

    ?>
    <div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv">
       
        <div id="<?php echo $taxonomy; ?>-pop" class="tabs-panel" style="display: none;">
            <ul id="<?php echo $taxonomy; ?>checklist-pop" class="categorychecklist form-no-clear" >
                <?php $popular_ids = wp_popular_terms_checklist($taxonomy); ?>
            </ul>
        </div>

        <div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
            <?php
            $name = ( $taxonomy == 'category' ) ? 'post_cat' : 'tax_input[' . $taxonomy . ']';
            echo "<input type='hidden' name='{$name}' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
            ?>
            <ul id="<?php echo $taxonomy; ?>checklist" class="list:<?php echo $taxonomy?> categorychecklist form-no-clear">
                <?php custom_gun_terminology_checklist($post->ID, array( 'taxonomy' => $taxonomy, 'popular_cats' => $popular_ids ) ) ?>
            </ul>
        </div>
         
    </div>
    <?php 
}



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
