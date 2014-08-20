<?php
define("DARTADGEN_SITE", "imo.shotgunnews");
define("JETPACK_SITE", "shotgunnews");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=27701&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=27701&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=Mjc3MDE0NDc4NSZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 80% off<br/> the Cover Price");

define("FACEBOOK_LINK", "https://www.facebook.com/ShotgunNews");
define("RSS_LINK", "http://www.shotgunnews.com/feed/");
define("SITE_LINK", "shotgunnews.com");
define("SITE_NAME", "Shotgun News");

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
