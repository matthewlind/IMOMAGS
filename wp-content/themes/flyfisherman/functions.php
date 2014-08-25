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


function social_networks(){
	echo '<div class="socials">';
		echo '<a href="'.FACEBOOK_LINK.'" class="facebook">Facebook</a>';
	    echo '<a href="'.RSS_LINK.'" class="rss">RSS</a>';
	echo '</div>';
}



function social_footer(){ ?>
	<div class="foot-social clearfix">
		<strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
		<div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
		<?php social_networks(); ?>
	</div>
<?php }

