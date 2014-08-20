<?php
define("JETPACK_SITE", "handgunsmag");
define("DARTADGEN_SITE", "imo.handgunsmag");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0146S&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=0146S&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0NlM0NDY5NCZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 70% off<br/> the Cover Price");

define("FACEBOOK_LINK", "https://www.facebook.com/HandgunsMag");
define("TWITTER_LINK", "http://twitter.com/handgunsmag");
define("RSS_LINK", "http://www.handgunsmag.com/feed/");
define("SITE_LINK", "handgunsmag.com");
define("SITE_NAME", "Handguns Magazine");

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
<?php }
