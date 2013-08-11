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

function imo_sidebar($type){
	$dartDomain = get_option("dart_domain", $default = false);
	echo '<div class="sidebar-area">';
		echo '<div class="sidebar">';
			echo '<div class="widget_advert-widget">';
			imo_dart_tag("300x250");
			echo '</div>';
		echo '</div>';
	    get_sidebar($type);
	    	if(!mobile()){
		    	echo '<div id="responderfollow"></div>';
				echo '<div class="sidebar advert">';
		    	echo '<div class="widget"><iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Finfisherman&amp;width=310&amp;height=184&amp;colorscheme=light&amp;show_faces=true&amp;show_border=false&amp;stream=false&amp;header=false&amp;appId=218070564894418" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:310px; height:184px;" allowTransparency="true" id="fb-sidebar"></iframe></div>';

					echo '<div class="widget_advert-widget">';
						echo '<iframe id="sticky-iframe-ad" width="310" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-sticky.php?ad_code='.$dartDomain.'"></iframe>';
					echo '</div>';
				echo '</div>';
			}
	echo '</div>';
}

function social_networks(){
	echo '<div class="socials">';
		echo '<a href="'.FACEBOOK_LINK.'" class="facebook">Facebook</a>';
	    echo '<a href="https://www.twitter.com/@InFishermanTV" class="twitter">Twitter</a>';
	    echo '<a href="http://www.youtube.com/user/InFishermanTV" class="youtube">YouTube</a>';
	    echo '<a href="http://www.in-fisherman.com/feed/" class="rss">RSS</a>';
	echo '</div>';
}

function sub_footer(){ ?>
	<div class="sub-boxes">
		<div class="sub-box banner-box">
			<?php imo_dart_tag("300x250",array("pos"=>"mid")); ?>
			</div>
			<div class="sub-box fb-box">
			<div class="fb-recommendations" data-site="in-fisherman.com" data-width="309" data-height="252" data-header="true" data-font="arial"></div>
		</div>
	</div>

	<div class="foot-social clearfix">
		<strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
		<div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
		<?php social_networks(); ?>
	</div>
	<a href="/newsletter-signup" class="get-newsletter">Get the In-Fisherman <br />Newsletter</a>
	<a href="<?php print SUBS_LINK;?>" class="subscribe-banner">
		<img src="<?php bloginfo('stylesheet_directory'); ?>/images/pic/subscribe-banner.jpg" alt="" />
	</a>
	<a href="#" class="back-top jq-go-top">back to top</a>
<?php }

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


//Configure infish community
//This section does nothing unless imo-community plugin is enabled
add_action("init","infish_community_init",0);
function infish_community_init() {

	//////////////////////////////////
	//Community Configuration
	//////////////////////////////////

	//This Post Types array is used in multiple configurations
	$inFishPostTypes = array(

		"report" => array(
			"display_name" => "Rut Reports",
			"post_list_style" => "tile"
		),

		"question" => array(
			"display_name" => "Q&A",
			"post_list_style" => "list"
		),

		"general" => array(
			"display_name" => "General",
			"post_list_style" => "list"
		),
		"all" => array(
			"display_name" => "All",
			"post_list_style" => "list"
		),
		"trending" => array(
			"display_name" => "Trending",
			"post_list_style" => "list"
		)
	);


	//NOTE: Configuration order matters! More specific URLs should appear before less specific urls on the same path.
	// For example, the "single" below needs to appear before listing


	///////////////////////////////////////////
	//Community Single Post Page Configuration
	///////////////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "community";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_type'] = 'single';
	$IMO_COMMUNITY_CONFIG['page_title'] = NULL; //On single pages, title is taken from Post
	$IMO_COMMUNITY_CONFIG['template'] = '/infish/single.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'infish_community';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'infishcommunity';
	$IMO_COMMUNITY_CONFIG['post_types'] = $inFishPostTypes;

	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['community-single'] = $IMO_COMMUNITY_CONFIG;




	///////////////////////////////////////////
	//Main Community Page Configuration
	///////////////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "community";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_type'] = 'listing';
	$IMO_COMMUNITY_CONFIG['page_title'] = 'In-Fisherman Community';
	$IMO_COMMUNITY_CONFIG['template'] = '/infish/listing.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'infish_community';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'infishcommunity';
	$IMO_COMMUNITY_CONFIG['post_types'] = $inFishPostTypes;

	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['community-main'] = $IMO_COMMUNITY_CONFIG;









	///////////////////////////////////////////
	//Admin Page Testing
	///////////////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "community-testing";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = 'In-Fisherman Community';
	$IMO_COMMUNITY_CONFIG['template'] = '/templates/blank-template.php';
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
			"script-name" => "backbone-js",
			"script-path" => "js/backbone-min.js",
			"script-dependencies" => array('jquery','underscore-js')
		),
		array(
			"script-name" => "form-params-js",
			"script-path" => "js/formParams.min.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "filepicker-io-js",
			"script-path" => "js/filepicker.js",
			"script-dependencies" => array('jquery')
		),
		array(
			"script-name" => "imo-community-grid-js",
			"script-path" => "js/backgrid.min.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js')
		),
		//Application specific scripts
		array(
			"script-name" => "imo-community-common",
			"script-path" => "js/common.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js')
		),
		array(
			"script-name" => "imo-community-models",
			"script-path" => "js/models.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-common')
		),
		array(
			"script-name" => "imo-community-mod",
			"script-path" => "js/mod2.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-models','imo-community-common')
		),
		array(
			"script-name" => "imo-community-community",
			"script-path" => "js/community.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-models','imo-community-common','imo-community-mod')
		),
		array(
			"script-name" => "imo-community-routes",
			"script-path" => "js/routes.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-community','imo-community-mod')
		),
		array(
			"script-name" => "backgrid-select-all",
			"script-path" => "js/backgrid-select-all.js",
			"script-dependencies" => array('jquery','backbone-js','underscore-js','imo-community-grid-js','custom.js','jquery.timeago.js')
		)

	);

	$IMO_COMMUNITY_CONFIG['additional_styles'] = array(
		array(
			"style-name" => "imo-community-stylesheet-main",
			"style-path" => "css/bootstrap.min.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "stylesheet_responsive",
			"style-path" => "css/bootstrap-responsive.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "imo-community-grid-css",
			"style-path" => "css/backgrid.min.css",
			"style-dependencies" => null
		),
		array(
			"style-name" => "styles-select-all",
			"style-path" => "css/styles-select-all.css",
			"style-dependencies" => array('custom.css')
		),
		array(
			"style-name" => "stylesheet_custom",
			"style-path" => "css/custom.css",
			"style-dependencies" => null
		)
	);
	global $IMO_COMMUNITY;
	$IMO_COMMUNITY['beta-community'] = $IMO_COMMUNITY_CONFIG;
	/////////////////////////////////////////////////



	//////////////////////////////////
	//Solunar Calendar iPad Embed config
	//////////////////////////////////
	$IMO_COMMUNITY_CONFIG = NULL;
	$IMO_COMMUNITY_CONFIG['community_home_slug'] = "solunar-calendar-ipad";//This slug will override ANY setting in wordpress.
	$IMO_COMMUNITY_CONFIG['page_title'] = 'Solunar Calendar';
	$IMO_COMMUNITY_CONFIG['template'] = '/solunar/solunar-template-minimal.php';
	$IMO_COMMUNITY_CONFIG['dart_page'] = 'solunar_calendar';
	$IMO_COMMUNITY_CONFIG['dart_sect'] = 'solunarcalendar';
	$IMO_COMMUNITY_CONFIG['post_types'] = null;
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
			"style-name" => "solunar-base-css",
			"style-path" => "solunar/css/css-php.css",
			"style-dependencies" => null
		),
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
	$IMO_COMMUNITY['solunar-calendar-ipad'] = $IMO_COMMUNITY_CONFIG;
	/////////////////////////////////////////////////
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
			"style-name" => "solunar-base-css",
			"style-path" => "solunar/css/css-php.css",
			"style-dependencies" => null
		),
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




}


