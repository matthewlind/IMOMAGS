<?php
define("JETPACK_SITE", "gunsammo");
define("DARTADGEN_SITE", "imo.gunsandammo");
define("SUBS_LINK", "http://subs.gunsandammo.com");
define("GIFT_LINK", "http://subs.gunsandammo.com/gift");
define("SERVICE_LINK", "http://subs.gunsandammo.com/service");
define("SUBS_DEAL_STRING", "Save 80%");
define("DRUPAL_SITE", TRUE);


define("FACEBOOK_LINK", "http://www.facebook.com/GunsAndAmmoMag");
define("TWITTER_LINK", "http://twitter.com/gunsandammomag");
define("RSS_LINK", "http://feeds.feedburner.com/GunsAndAmmoMag");
define("SITE_LINK", "gunsandammo.com");
define("SITE_NAME", "Guns & Ammo");

include_once('taxonomies.php');
include_once('widgets/caption-contest.php');
include_once('widgets/ga-vault.php');
include_once('widgets/ipad-app.php');
include_once('widgets/ipad-app-reloaded.php');

function social_networks(){
	echo '<div class="socials">';
		echo '<a href="'.FACEBOOK_LINK.'" class="facebook">Facebook</a>';
	    echo '<a href="'.TWITTER_LINK.'" class="twitter">Twitter</a>';
	    echo '<a href="'.RSS_LINK.'" class="rss">RSS</a>';
	echo '</div>';
}



function social_footer(){ ?>
	<div class="foot-social clearfix">
		<strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
		<div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
		<?php social_networks(); ?>
	</div>
	<?php 
}

/*New Menu for TV*/

add_action( 'init', 'register_rt_menu' );

function register_rt_menu() {
	register_nav_menu( 'tv-menu', __( 'TV Menu' ) );
	register_nav_menu( 'shoot101_menu', __( 'Shoot101' ) );
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

//Add Scripts for Reviews Section
add_action( 'init', 'imo_mags_ga_scripts' );
function imo_mags_ga_scripts() {
  wp_enqueue_script(
    'imo-ga-reviews',
    get_stylesheet_directory_uri() . '/js/reviews.js',
    array('jquery')
  );
}

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
            $review['thumbnail'] = get_the_post_thumbnail(null,"post-home-small-thumb", array('class' => 'attachment-list-thumb wp-post-image'));
            $review['imo_slider_thumb'] = get_the_post_thumbnail(null,"post-home-small-thumb", array('class' => 'entry-img'));

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


// adding single post template for category shoot101. Every post that is in cat shoot101 will use this template.
/*
add_action('template_include', 'load_single_template');
  function load_single_template($template) {
    $new_template = '';

    // single post template
    if( is_single() ) {
      global $post;
      // 'shoot101' is category slug

      if( has_term('shoot101', 'category', $post) ) {
        $new_template = locate_template(array('single-shoot101.php' ));
      }

    }
    return ('' != $new_template) ? $new_template : $template;
}
*/

add_filter('img_caption_shortcode', 'fix_img_caption_shortcode', 10, 3);

function fix_img_caption_shortcode($val, $attr, $content = null) {
    extract(shortcode_atts(array(
        'id'    => '',
        'align' => '',
        'width' => '',
        'caption' => ''
    ), $attr));

    if ( 1 > (int) $width || empty($caption) ) return $val;

    return '<div id="' . $id . '" class="wp-caption ' . esc_attr($align) . '" style="width: ' . (0 + (int) $width) . 'px">' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}
