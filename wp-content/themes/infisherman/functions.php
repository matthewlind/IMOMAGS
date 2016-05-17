<?php

define('TIMELY_FEATURES', 'timely-features');
define('MASTER_ANGLERS', 'master-angler');
define('FEATURED', 'featured');
define('CATFISH', 'catfish');
define('ICE_FISHING', 'ice-fishing');
define('TRTUT_SALMON', 'trout-salmon');
define('PANFISH', 'panfish');
define('WALLEYE', 'walleye');

define("JETPACK_SITE", "infisherman");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=01469&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=01469&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0Njk0NDY5NSZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 70% off<br/> the Cover Price");
define("DRUPAL_SITE", TRUE);
define("FACEBOOK_LINK", "https://www.facebook.com/InFisherman");
define("SITE_NAME", "In-Fisherman");

define("FACEBOOK_APP_ID","172626882923364");
define("FACEBOOK_APP_SECRET","60a79f156a44dc9a57096bf9ed3d1a80");

include_once("widgets/if-community-slider.php");
include_once("wordpress-community.php");


//community menus
register_nav_menus(array(
    'photos' => 'Photos Community Menu',
    'flies' => 'Flies Community Menu'
));

/* This function allows for logging when debugging mode is on */
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

function social_networks(){
	echo '<div class="socials">';
		echo '<a href="'.FACEBOOK_LINK.'" class="facebook">Facebook</a>';
	    echo '<a href="https://www.twitter.com/@InFishermanTV" class="twitter">Twitter</a>';
	    echo '<a href="http://www.youtube.com/user/InFishermanTV" class="youtube">YouTube</a>';
	    echo '<a href="http://www.in-fisherman.com/feed/" class="rss">RSS</a>';
	echo '</div>';
}

function social_footer(){ ?>
	<div class="foot-social clearfix">
		<strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
		<div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
		<?php social_networks(); ?>
	</div>
<?php }

function infisherman_get_categories($categories_list, $show_featured = true)
{
    $categories = implode(' ',
        array_map(
            function($item){
                return '<span class="category-name-box"><a class="category-name-link" href="'.esc_url(get_category_link(get_cat_ID($item->name))).'">'.$item->name.'</a></span>';
            },
            array_filter(
                $categories_list,
                function ($item) use ($show_featured) {
                    if (($item->slug == TIMELY_FEATURES || $item->slug == FEATURED) && !$show_featured) {
                        return false;
                    }
                    return true;
                }
            )
        )
    );

    return $categories;
}

function infisherman_get_more_posts_query($limit = 4)
{
    $query = new WP_Query(array(
        'category__not_in' =>
            get_categories_ids(array(
                MASTER_ANGLERS, TIMELY_FEATURES, FEATURED
            )),
        'posts_per_page' => $limit )
    );
    return $query;
}

function infish_get_category_title_by_slug($slug)
{
    $category = get_category_by_slug($slug);
    return $category->name;
}

// [navionics zoom="0" long="12.0" lat="46.0"]
function navionics_func( $atts ) {
    $a = shortcode_atts( array(
	    'zoom' => '',
        'long' => '',
        'lat' => '',
    ), $atts );

    $output = '<iframe id="navionics" src="/iframe-navionics.php?zoom='.$a["zoom"].'&long='.$a["long"].'&lat='.$a["lat"].'"></iframe>';
    
    return $output;
}
add_shortcode( 'navionics', 'navionics_func' );

//page template in solunar directory
add_filter( 'page_template', 'My_custom_page_template' );
function My_custom_page_template( $page_template )
{
    if ( is_page( 'my-custom-page-slug' ) ) {
        $page_template = 'solunar/solunar-template.php';
    }
    return $page_template;
}

//Configure Solunar Calendar
function themeslug_enqueue_script() {
	if(is_page("solunar-calendar")){ 
		wp_enqueue_script( 'underscore-js', 'https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js', array('jquery') );
		wp_enqueue_script( 'jquery-carousel-fred', '/wp-content/themes/infisherman/solunar/js/plugins/carouFredSel/jquery.carouFredSel-6.2.0-packed.js', array('jquery')  );
		wp_enqueue_script( 'lodash', '/wp-content/themes/infisherman/solunar/js/lodash.min.js', array('jquery')  );
		wp_enqueue_script( 'solunar-googletag', '/wp-content/themes/infisherman/solunar/js/googletag.js', array('jquery')  );
		wp_enqueue_script( 'solunar-app', '/wp-content/themes/infisherman/solunar/js/script.js', array('jquery','lodash','jquery-carousel-fred')  );
	}
}
add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );