<?php
define("JETPACK_SITE", "gundogmag");
define("DARTADGEN_SITE", "imo.gundogmag");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=014HS&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=014HS&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0SFM0NDY5NiZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 60% off<br/> the Cover Price");

define("FACEBOOK_LINK", "https://www.facebook.com/GunDogMag");
define("TWITTER_LINK", "https://www.twitter.com/@gundogmag");
define("RSS_LINK", "http://www.gundogmag.com/feed/");
define("SITE_LINK", "gundogmag.com");
define("SITE_NAME", "Gun Dog Magazine");

function imo_sidebar($type){
	//Speed up mobile load time by not loading sidebar in the background
	if(!mobile()){
		$dartDomain = get_option("dart_domain", $default = false); ?>
		<div class="sidebar-area">
			<div class="sidebar">
				<div class="widget_advert-widget">
					<!-- Site - Gundog/home/home_Rectangle_ATF -->
					<div id='div-300x50-rectangle-atf'>
						<script type='text/javascript'>
							googletag.cmd.push(function() { googletag.display('div-300x50-rectangle-atf'); });
						</script>
					</div>
				</div>
			</div>
		    <?php get_sidebar($type);

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
