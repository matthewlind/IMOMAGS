<?php
define("DARTADGEN_SITE", "imo.shootingtimes");
define("JETPACK_SITE", "shootingtimes");
define("SUBS_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=01407&i4Ky=IBZN");
define("GIFT_LINK", "https://secure.palmcoastd.com/pcd/eSv?iMagId=01407&i4Ky=IGZN");
define("SERVICE_LINK", "https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0MDc0NDc0NiZpVHlwZT1FTlRFUg==");
define("SUBS_DEAL_STRING", "Save Over 80% off<br/> the Cover Price");

define("FACEBOOK_LINK", "https://www.facebook.com/ShootingTimesMag");
define("TWITTER_LINK", "http://twitter.com/ShootingTimesUS");
define("RSS_LINK", "http://www.shootingtimes.com/feed/");
define("SITE_LINK", "shootingtimes.com");
define("SITE_NAME", "Shooting Times");

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
		$magazine_img = get_option('magazine_cover_uri' );
		$subs_link = get_option('subs_link'); 
		$iMagID = get_option('iMagID' );
		$deal_copy = get_option('deal_copy' );
		$gift_link = get_option('gift_link' );
		$service_link = get_option('service_link' );
		$subs_form_link = get_option('subs_form_link' );
		$i4ky = get_option('i4ky' );
	if(mobile()){
	?>

	<div class="subs-btm widget widget_text header-elements">
	    <div class="subs-wrap">
	        <div class="journal">
		        <img src="<?php echo $magazine_img; ?>" alt="Subscribe">
		    </div>
		    <div class="subscribe-now">
				<p><span class="stag-reg"><?php print $deal_copy;?></span></p>
				<a href="<?php print $subs_link;?>" target="_blank" class="subs-btn">Subscribe <span>Now!</span></a>
		    </div>
		    <div class="btm-subs-links">
		        <p><a href="<?php print $gift_link;?>" target="_blank">Give a Gift <span>&raquo;</span></a></p>
		        <p><a href="<?php print $service_link; ?>" target="_blank">Subscriber Services <span>&raquo;</span></a></p>
		    </div>
		</div>
	</div>				
					
	<a href="#" class="back-top jq-go-top">back to top</a>
<?php } }

function social_footer(){ ?>
	<div class="foot-social clearfix">
		<strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
		<div class="fb-like" data-href="<?php echo FACEBOOK_LINK; ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>
		<?php social_networks(); ?>
	</div>
<?php }
