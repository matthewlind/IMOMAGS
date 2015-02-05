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

function register_recipes_widget() {
    register_widget( 'Recipes_Widget' );
}

class Recipes_Widget extends WP_Widget
{
    function __construct() {
        $widget_ops = array( 'classname' => 'recipes', 'description' => __('A widget that displays related recipes & gear ', 'recipes') );

        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'recipes-widget' );

        $this->WP_Widget( 'recipes-widget', __('Related Recipes & Gear Widget', 'recipes'), $widget_ops, $control_ops );
    }

    function widget() {

		// Let's get the Primary Category
		$postID = get_the_ID();
		$categoryID = get_post_meta($postID);
		$catID = $categoryID["_category_permalink"];
		$primaryCat = $catID[0];
		$primary = get_term_by('id', $catID[0], 'category');
		$primaryName = $primary->name;
		$recipes = 112;
		$gear = 20;
		$category = get_category( get_query_var( 'cat' ) );
		$slug = $category->slug;
		$id = $category->term_id;

		$primaryAndRecipes = array(
				'category__and' => array($primaryCat,$recipes),
				'posts_per_page' => 1,
				'orderby' => 'rand'
				);

		$categoryAndRecipes = array(
				'category__and' => array($id,$recipes),
				'posts_per_page' => 1,
				'orderby' => 'rand'
				);
		if($_SERVER['REQUEST_URI'] == "/".$slug."/" && ($slug == "walleye" || $slug == "panfish" || $slug == "catfish" || $slug == "pike" || $slug == "trout" || $slug == "salmon" || $slug == "trout-salmon" || $$slug == "pike-muskie")){
			$query = new WP_Query( $categoryAndRecipes );
		}else if($primaryName == "Walleye" || $primaryName == "Panfish" || $primaryName == "Catfish" || $primaryName == "Pike" || $primaryName == "Trout" || $primaryName == "Salmon" || $primaryName == "Trout & Salmon" || $primaryName == "Pike & Muskie"){
			$query = new WP_Query( $primaryAndRecipes );
		}else{
			$query = new WP_Query( 'category_name=recipes&posts_per_page=1&orderby=rand' );
		}

        if ($query->have_posts()):
        ?>
        <div class="recipes-holder js-responsive-section widget">
            <h3 class="widget-title">Recipes</h3>
            <div class="recipes-box">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php the_post_thumbnail(); ?>
                    <div class="recipes-text">
                        <h3><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
                        <!--<div class="comment-count"><?php echo get_comments_number(); ?> Comments</div>-->
                    </div>
            <?php endwhile; ?>
            </div>
        </div>
        <?php endif;
        /* Restore original Post Data */
		wp_reset_postdata();

		$primaryAndGear = array(
				'category__and' => array($primaryCat,$gear),
				'posts_per_page' => 1,
				'orderby' => 'rand'
				);

		$categoryAndGear = array(
				'category__and' => array($id,$gear),
				'posts_per_page' => 1,
				'orderby' => 'rand'
				);

		if($_SERVER['REQUEST_URI'] == "/".$slug."/" && ($slug == "walleye" || $slug == "panfish" || $slug == "catfish" || $slug == "pike" || $slug == "trout" || $slug == "salmon" || $slug == "trout-salmon" || $$slug == "pike-muskie")){
			$query = new WP_Query( $categoryAndGear );
		}else if($primaryName == "Walleye" || $primaryName == "Panfish" || $primaryName == "Catfish" || $primaryName == "Pike" || $primaryName == "Trout" || $primaryName == "Salmon" || $primaryName == "Trout & Salmon" || $primaryName == "Pike & Muskie"){
			$query = new WP_Query( $primaryAndGear );
		}else{
			$query = new WP_Query( 'category_name=gear-accessories&posts_per_page=1&orderby=rand' );
		}

        if ($query->have_posts()):
        ?>
        <div class="recipes-holder js-responsive-section widget">
            <h3 class="widget-title">Gear & Accessories</h3>
            <div class="recipes-box">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php the_post_thumbnail(); ?>
                    <div class="recipes-text">
                        <h3><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
                        <!--<div class="comment-count"><?php echo get_comments_number(); ?> Comments</div>-->
                    </div>
            <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="js-responsive-section widget">
        <?php
        if(in_category("bass") || is_category("bass")){
	        $bcoveID = 2296641582001;
	        $bcoveValue = "AQ~~,AAAA-01d-uE~,FiwRPPEEyN7iVOxfzxjuTdxs15Rsp9C-";
	        echo $before_widget . '<h3 class="widget-title">Bass Video</h3>';
        }else if(in_category("walleye") || is_category("walleye")){
	        $bcoveID = 2288756669001;
	        $bcoveValue = "AQ~~,AAAA-01d-uE~,FiwRPPEEyN6t2_JKertfYNQSC0Z9-9sQ";
	        echo $before_widget . '<h3 class="widget-title">Walleye Video</h3>';
        }else if(in_category("pike-muskie") || is_category("pike-muskie") || in_category("muskie") || is_category("muskie") || in_category("northern-pike") || is_category("northern-pike")){
	        $bcoveID = 2296641609001;
	        $bcoveValue = "AQ~~,AAAA-01d-uE~,FiwRPPEEyN6BqJAlU1eBzQjM6JqWBeKy";
	        echo $before_widget . '<h3 class="widget-title">Pike & Muskie Video</h3>';
	    }else if(in_category("panfish") || is_category("panfish")){
	        $bcoveID = 2288756671001;
	        $bcoveValue = "AQ~~,AAAA-01d-uE~,FiwRPPEEyN5kh63oQSJLKGB-A-dR9uMg";
	        echo $before_widget . '<h3 class="widget-title">Panfish Video</h3>';
	    }else if(in_category("catfish") || is_category("catfish")){
	        $bcoveID = 2288756670001;
	        $bcoveValue = "AQ~~,AAAA-01d-uE~,FiwRPPEEyN5hceFGFRR5K3KxPIZYGAkv";
	        echo $before_widget . '<h3 class="widget-title">Catfish Video</h3>'	;
	    }else if(in_category("trout-salmon") || is_category("trout-salmon") || in_category("salmon") || is_category("salmon") || in_category("trout") || is_category("trout") || in_category("lake-trout") || is_category("lake-trout") || in_category("brown-trout-salmon") || is_category("brown-trout") || in_category("rainbow-trout-steelhead") || is_category("rainbow-trout-steelhead")){
	        $bcoveID = 2296641611001;
	        $bcoveValue = "AQ~~,AAAA-01d-uE~,FiwRPPEEyN6EtzuPp5suAl2U2bK-AGVJ";
	        echo $before_widget . '<h3 class="widget-title">Trout & Salmon Video</h3>';
	    }else if(in_category("ice-fishing") || is_category("ice-fishing")){
	        $bcoveID = 2288756675001;
	        $bcoveValue = "AQ~~,AAAA-01d-uE~,FiwRPPEEyN7hI3ZdHnSfpvjTaN5j8yA_";
	        echo $before_widget . '<h3 class="widget-title">Ice Fishing Video</h3>';
	    }else{
		    $bcoveID = 2296641582001;
	        $bcoveValue = "AQ~~,AAAA-01d-uE~,FiwRPPEEyN7iVOxfzxjuTdxs15Rsp9C-";
	        echo $before_widget . '<h3 class="widget-title">Bass Video</h3>';
	    }

        ?>
		<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
		<object id="myExperience" class="BrightcoveExperience">
		  <param name="bgcolor" value="#FFFFFF" />
		  <param name="width" value="300" />
		  <param name="height" value="540" />
		  <param name="playerID" value="<?php echo $bcoveID; ?>" />
		  <param name="playerKey" value="<?php echo $bcoveValue; ?>" />
		  <param name="isVid" value="true" />
		  <param name="isUI" value="true" />
		  <param name="dynamicStreaming" value="true" />
		</object>
		<script type="text/javascript">brightcove.createExperiences();</script>
        <?php echo $after_widget;?>
        </div>
        <?php /* Restore original Post Data */
			wp_reset_postdata();
    }

}

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

// In-Fisherman Reader Photo pagination
add_action( 'wp_ajax_nopriv_fishhead-photos-filter', 'prefix_load_fishhead_photos_posts' );
add_action( 'wp_ajax_fishhead-photos-filter', 'prefix_load_fishhead_photos_posts' );
function prefix_load_fishhead_photos_posts () {
	

	$cat_id = $_POST[ 'cat' ];
    $offset = $_POST[ 'offset' ];
    
    if($cat_id){
	    $args = array(
			'post_type' => 'fish_head_photos',
			'offset' => $offset,
			'showposts' => 10,
			'tax_query' => array(
			  'relation' => 'AND',
			  array(
			     'taxonomy' => 'category',
			     'field' => 'slug',
			     'terms' => array( $cat_id )
			  )
			)
		);

    }else{
	    $args = array(
			'post_type' => 'fish_head_photos',
			'offset' => $offset,
			'showposts' => 10,
		);

    }
			
	$posts = get_posts( $args );
	
	
	global $post;
	
	ob_start ();
	
	$i = $offset;
	

	foreach ( $posts as $post ) {
		$i++;
		setup_postdata( $post ); 
		?>
		
		<div class="dif-post post">
	        <div class="feat-img">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("list-thumb"); ?></a>
	        </div>
	        <div class="dif-post-text">
	            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	            <div class="profile-panel">
	                <div class="profile-data">
	                    <ul class="prof-like">
	                    	<li>
	                    		<div class="fb-like fb_iframe_widget" data-href="<?php echo get_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
	                       </li>
	                    </ul>
	                </div>
	            </div>
	            <?php if(in_category("master-angler")){ ?><span class="badge"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/pic/badge-ma.png" alt="Master Angler" /></span><?php } ?>
	        </div>
	    </div>

					
	<?php } 
	wp_reset_postdata();

	$response = ob_get_contents();
	ob_end_clean();
	
	echo $response;
	die(1);
}

//Configure infish community
//This section does nothing unless imo-community plugin is enabled
add_action("init","infish_community_init",0);
function infish_community_init() {

		
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//NOTE: Configuration order matters! More specific URLs should appear before less specific urls on the same path.
	// For example, the "single" page_type below needs to appear before "listing" page type on the same path.
	//Also, solunar-calendar-mobile should appear before solunar-calendar
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



	///////////////////////////////////////////
	//Underscore Testing Page Configuration
	///////////////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "underscore_test";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = "Underscore"; //On single pages, title is taken from Post
	$IMO_COMMUNITY_CONFIG['template'] = '/infish/underscore-test.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'infish_community';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'infishcommunity';
	$IMO_COMMUNITY_CONFIG['post_types'] = $inFishPostTypes;


	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		//Third Part Scripts
		array(
			"script-name" => "underscore-js",
			"script-path" => "js/underscore-min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "underscore-testing-js",
			"script-path" => "infish/js/underscore-test.js",
			"script-dependencies" => array('jquery',"underscore-js")
		)
	);


	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['underscore-test'] = $IMO_COMMUNITY_CONFIG;


	

	
	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['solunar-calendar-ipad'] = $IMO_COMMUNITY_CONFIG;
	/////////////////////////////////////////////////
	/////////////////////////////////////////////////




	//////////////////////////////////
	//Mobile Solunar Calendar config
	//////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "solunar-calendar-mobile";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = 'Best Times';
	$IMO_COMMUNITY_CONFIG['template'] = '/solunar-mobile/solunar-template-mobile.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'solunar_calendar';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'solunarcalendar';
	$IMO_COMMUNITY_CONFIG['post_types'] = null;

	global $IMO_COMMUNITY;

	$IMO_COMMUNITY['solunar-calendar-mobile'] = $IMO_COMMUNITY_CONFIG;
	/////////////////////////////////////////////////



	//////////////////////////////////
	//Solunar Calendar config
	//////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "solunar-calendar";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = 'Solunar Calendar';
	$IMO_COMMUNITY_CONFIG['template'] = '/solunar/solunar-template.php';
	$IMO_COMMUNITY_CONFIG['post_types'] = null;
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'solunar_calendar';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'solunarcalendar';
	$IMO_COMMUNITY_CONFIG['additional_scripts'] = array(
		array(
			"script-name" => "jquery-mousewheel-zf",
			"script-path" => "solunar/js/plugins/zfselect/js/jquery.mousewheel.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "jquery-zfselect",
			"script-path" => "solunar/js/plugins/zfselect/js/jquery.zfselect.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "jquery-carousel-fred",
			"script-path" => "solunar/js/plugins/carouFredSel/jquery.carouFredSel-6.2.0-packed.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "lodash",
			"script-path" => "solunar/js/lodash.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "solunar-googletag",
			"script-path" => "solunar/js/googletag.js",
			"script-dependencies" => null,
			"show-in-header" => true
		),
		array(
			"script-name" => "solunar-app",
			"script-path" => "solunar/js/script.js",
			"script-dependencies" => array('jquery','lodash','jquery-carousel-fred','jquery-zfselect','jquery-mousewheel-zf')
		),

	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "solunar-style-css",
			"style-path" => "solunar/css/styles.css?v=2",
			"style-dependencies" => null
		),
		array(
			"style-name" => "zfselect-css",
			"style-path" => "solunar/js/plugins/zfselect/css/zfselect.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "flexslider-css",
			"style-path" => "solunar/js/plugins/flexslider/flexslider.css",
			"style-dependencies" => null
		),
	);
	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['solunar-calendar'] = $IMO_COMMUNITY_CONFIG;
	/////////////////////////////////////////////////
	/////////////////////////////////////////////////






}


