<?php

define("JETPACK_SITE", "flyfisherman");
define("SUBS_LINK", "http://subs.flyfisherman.com/");
define("GIFT_LINK", "http://subs.flyfisherman.com/gift");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0MkE0NDY5MyZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 70% off<br/> the Cover Price");
define("DRUPAL_SITE", TRUE);

define("FACEBOOK_LINK", "https://www.facebook.com/pages/Fly-Fisherman-Magazine/106893798196");
define("RSS_LINK", "http://www.flyfisherman.com/feed/");
define("SITE_LINK", "flyfisherman.com");
define("SITE_NAME", "Fly Fisherman");

define("FACEBOOK_APP_ID","1434587330141886");
define("FACEBOOK_APP_SECRET","f2e131f499d466e6cc939becd5e7e53d");

include_once("wordpress-community.php");


//community menus
register_nav_menus(array(
    'photos' => 'Photos Community Menu',
    'flies' => 'Flies Community Menu'
));

function imo_community_sidebar(){
	$dartDomain = get_option("dart_domain", $default = false);
	echo '<div class="sidebar-area">';
		echo '<div class="afs_ads">&nbsp</div>';
		echo '<label class="upload-button">';
        echo '<a href="/post-photo/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a>';
        //echo '<input id="image-upload" class="common-image-upload" type="file" name="photo-upload">';
		echo '</label>';
		echo '<div class="sidebar">';
			echo '<div class="widget_advert-widget">';
			echo '<iframe id="community-iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?ad_code='.$dartDomain.'"></iframe>';
			echo '</div>';
		echo '</div>';
		get_sidebar("community");
	echo '</div>';
}

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
						echo '<div class="widget_advert-widget">';
							echo '<iframe id="sticky-iframe-ad" width="310" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-sticky.php?ad_code='.$dartDomain.'"></iframe>';
						echo '</div>';
						get_sidebar("sticky");
					echo '</div>';
		echo '</div>';
	}
}

function social_networks(){
	echo '<div class="socials">';
		echo '<a href="'.FACEBOOK_LINK.'" class="facebook">Facebook</a>';
	    echo '<a href="'.RSS_LINK.'" class="rss">RSS</a>';
	echo '</div>';
}

function sub_footer(){ ?>
	<div class="sub-boxes">
		<div class="sub-box banner-box">
			<?php imo_dart_tag("300x250",array("pos"=>"mid")); ?>
		</div>
		<div class="sub-box fb-box">
			<div class="newsletter-box bottom-newsletter">
				<?php the_widget("Signup_Widget_Header", "title=GET THE NEWSLETTER!"); ?>
			</div>
		</div>
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

