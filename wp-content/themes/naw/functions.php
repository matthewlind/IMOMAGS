<?php
define("JETPACK_SITE", "flyfisherman");
define("SUBS_LINK", "http://subs.flyfisherman.com/");
define("GIFT_LINK", "http://subs.flyfisherman.com/gift");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0MkE0NDY5MyZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 70% off<br/> the Cover Price");
define("DRUPAL_SITE", TRUE);

define("FACEBOOK_LINK", "https://www.facebook.com/NAWhitetail");
define("TWITTER_LINK", "https://www.twitter.com/@NAWhitetail");
define("RSS_LINK", "http://www.northamericanwhitetail.com/feed/");
define("SITE_LINK", "northamericanwhitetail.com");
define("SITE_NAME", "North American Whitetail");


/***
**
** Enqueue Scripts
**
***/
function naw_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script("cross-site-feed", get_template_directory_uri() . "/js/cross-site-feed.js");

}
add_action('wp_enqueue_scripts', 'naw_scripts_method');

function imo_sidebar($type){
	//Speed up mobile load time by not loading sidebar in the background
	if(!mobile()){
		$dartDomain = get_option("dart_domain", $default = false);
		echo '<div class="sidebar-area">';
			echo '<div class="sidebar">';
				echo '<div class="widget_advert-widget">';
				imo_dart_tag("300x250");
				echo '</div>';
			echo '</div>';
		    get_sidebar($type);

			    	echo '<div id="responderfollow"></div>';
					echo '<div class="sidebar advert">';
			    	//the_widget( 'Community_Slider' );
						echo '<div class="widget_advert-widget">';
							echo '<iframe id="sticky-iframe-ad" width="310" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-sticky.php?ad_code='.$dartDomain.'"></iframe>';
						echo '</div>';
					echo '</div>';

		echo '</div>';
	}
}

function social_networks(){
	echo '<div class="socials">';
		echo '<a href="'.FACEBOOK_LINK.'" class="facebook">Facebook</a>';
	    echo '<a href="'.TWITTER_LINK.'" class="twitter">Twitter</a>';
	    echo '<a href="'.RSS_LINK.'" class="rss">RSS</a>';
	echo '</div>';
}

function sub_footer(){ ?>
	<div class="sub-boxes">
		<div class="sub-box banner-box">
			<?php imo_dart_tag("300x250",array("pos"=>"mid")); ?>
			</div>
			<div class="sub-box fb-box">
			<div class="fb-recommendations" data-site="<?php echo RSS_LINK; ?>" data-width="309" data-height="252" data-header="true" data-font="arial"></div>
		</div>
	</div>

	<div class="foot-social clearfix">
		<strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
		<div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
		<?php social_networks(); ?>
	</div>
	<div class="newsletter-box bottom-newsletter">
		<?php the_widget("Signup_Widget_Header", "title=GET THE NEWSLETTER!"); ?>
	</div>
	<?php
}

function social_footer(){ ?>
	<div class="foot-social clearfix">
		<strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
		<div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
		<?php social_networks(); ?>
	</div>
<?php }


//Configure naw community
//This section does nothing unless imo-community plugin is enabled
add_action("init","naw_community_init",0);
function naw_community_init() {

	//////////////////////////////////
	//Community Configuration
	//////////////////////////////////

	//This Post Types array is used in multiple configurations
	$nawPostTypes = array(

		"report" => array(
			"display_name" => "Rut Report",
			"post_list_style" => "tile"
		),

		"general" => array(
			"display_name" => "General Discussion",
			"post_list_style" => "tile"
		),

		"question" => array(
			"display_name" => "Questions",
			"post_list_style" => "tile"
		)
	);


	//External Community Configurations

	include("community-config/report.php");
	include("community-config/general.php");
	include("community-config/question.php");
	include("community-config/new-post.php");
	include("community-config/single.php");
	include("community-config/profile.php");
	include("community-config/edit-profile.php");
	include("community-config/admin.php");
	include("community-config/listing.php");
	include("community-config/state-report.php");

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//NOTE: Configuration order matters! More specific URLs should appear before less specific urls on the same path.
	// For example, the "single" page_type below needs to appear before "listing" page type on the same path.
	//Also, solunar-calendar-mobile should appear before solunar-calendar
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}


