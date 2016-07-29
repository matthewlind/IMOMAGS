<?php
global $term, $camp;
$dartDomain = get_option("dart_domain", $default = false);	

if(is_home()){
		$page = "homepage";
	}else if ( is_category() || is_author() || get_post_type() == "reader_photos" ){
		$page = "category";
	}else if(is_single()){
		$page = "article";
	}
	$is_custom_img_and_url 	= get_field('is_custom_img_and_url','options');	

if ($is_custom_img_and_url) {
	$f_img		= get_field('foot_post_img','options'); 	
	$f_url 		= get_field('foot_post_url','options');
	$f_title	= get_field('foot_post_title','options');
	$f_thumb	= "<img src='$f_img'>";
	$foot_post_btn_txt	= get_field('foot_post_btn_txt','options'); 
} else {
	$f_post 	= get_field('footer_post_or_page','options' );
	$f_p_id		= $f_post[0];
	$f_url		= get_permalink($f_p_id);
	$f_title	= get_the_title($f_p_id);
	$f_thumb	= get_the_post_thumbnail($f_p_id,"footer-thumb");
	$foot_post_btn_txt	= 'Read Now!';
}
	
$site_name	= trim(get_bloginfo('name'), "Magazine");
		if(!is_page()){	
?>			
			<div class="pre-footer">
				<div class="section-inner-wrap">
		        	<ul>
			        	<li class="f-newsletter">
			        		<h3>Get the <?php echo $site_name; ?> Email!</h3>
							<p>Get the Top Stories from <?php echo $site_name; ?> Delivered to Your Inbox Every Week</p>
							<?php get_template_part("content/redesign/content", "newsletter");?>
			        	</li>
			        	<li class="f-feat-page"><?php echo "<h3><a href='$f_url'>$f_title</a></h3><a href='$f_url'>$f_thumb</a><a class='link-to-all' href='$f_url'>$foot_post_btn_txt</a>"; ?></li>
			        	<li class="ad-wrap"><span class="ad-span">Advertisement</span><div class="ad-inner"><iframe class="iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?term=<?php echo $term; ?>&camp=<?php echo $camp; ?>&ad_code=<?php echo $dartDomain; ?>&ad_unit=mediumRectangle&page=<?php echo $page; ?>"></iframe></div></li>
		        	</ul>
				</div>
			</div>
		<?php } ?>
			<footer id="footer" class="footer" role="contentinfo">
				<div class="network">
		            <div class="frame">
		                <h4>Outdoor Sportsman Group Network</h4>
		                <div class="foot-columns">
	                        <div class="column">
	                            <h5>Hunt</h5>
	                            <ul class="network-list">
	                                <li class="f-p-bowhunting"><a target="_blank" href="http://www.bowhuntingmag.com/"><span>Petersen's Bowhunting</span></a></li>
	                                <li class="f-na-whitetaile"><a target="_blank" href="http://www.northamericanwhitetail.com/"><span>North American Whitetail</span></a></li>
	                                <li class="f-gun-dog"><a target="_blank" href="http://www.gundogmag.com/"><span>Gun Dog</span></a></li>
	                                <li class="f-wildfowl"><a target="_blank" href="http://www.wildfowlmag.com/"><span>Wildfowl</span></a></li>
	                                <li class="f-bowhunter"><a target="_blank" href="http://www.bowhunter.com/"><span>Bowhunter</span></a></li>
	                                <li class="f-hunting"><a target="_blank" href="http://www.petersenshunting.com/"><span>Petersen's Hunting</span></a></li>
	                            </ul>
	                        </div>
	                        <div class="column">
	                            <h5>Shoot</h5>
	                            <ul class="network-list">
	                                <li class="f-handguns"><a target="_blank" href="http://www.handgunsmag.com/"><span>Handguns</span></a></li>
	                                <li class="f-rifleshooter"><a target="_blank" href="http://www.rifleshootermag.com/"><span>Rifleshooter</span></a></li>
	                                <li class="f-shooting-times"><a target="_blank" href="http://www.shootingtimes.com/"><span>Shooting Times</span></a></li>
	                                <li class="f-firearms-news"><a target="_blank" href="http://www.shotgunnews.com/"><span>Firearms News</span></a></li>
	                                <li class="f-guns-and-ammo"><a target="_blank" href="http://www.gunsandammo.com/"><span>Guns &amp; Ammo</span></a></li>
	                            </ul>
	                        </div>
	                        <div class="column column3">
	                            <h5>Fish</h5>
	                            <ul class="network-list">
	                                <li class="f-in-fisherman"><a href="http://www.in-fisherman.com" target="_blank"><span>In-Fisherman</span></a></li>
	                                <li class="f-fly-fisherman"><a target="_blank" href="http://www.flyfisherman.com"><span>Fly Fisherman</span></a></li>
	                                <li class="f-florida-sportsman"><a target="_blank" href="http://www.floridasportsman.com/"><span>Florida Sportsman</span></a></li>
	                                <li class="f-bass-fan"><a target="_blank" href="http://www.bassfan.com/"><span>BassFan</span></a></li>
	                            </ul>
	                        </div>
	                        <div class="column column4">
	                            <h5>TV & More</h5>
	                            <ul class="network-list">
	                            	<li class="f-outdoor-channel"><a target="_blank" href="http://www.outdoorchannel.com/"><span>Outdoor Channel</span></a></li>
	                            	<li class="f-sportsman-ch"><a target="_blank" href="http://www.thesportsmanchannel.com/"><span>The Sportsman Channel</span></a></li>
	                            	<li class="f-wfn"><a target="_blank" href="http://www.worldfishingnetwork.com/"><span>World Fishing Network</span></a></li>
	                                <li class="f-game-and-fish"><a target="_blank" href="http://www.gameandfishmag.com/"><span>Game &amp; Fish</span></a></li>
	                                <li class="f-imo-store"><a target="_blank" href="http://store.imoutdoors.com/"><span>The IMO Store</span></a></li>
	                            </ul>
	                        </div>
		                </div>
		            </div>
		        </div>
	            <ul class="foot-nav">
	                <li><a href="http://www.outdoorsg.com/" target="_blank">Outdoor Sportsman Group</a></li>
	                <li><a href="http://www.outdoorsg.com/advertise/" target="_blank">Advertise</a></li>
	                <li><a href="http://www.outdoorsg.com/about/what-we-do/" target="_blank">About</a></li>
	                <li><a href="http://www.outdoorsg.com/about/contact/" target="_blank">Contanct</a></li>
	            </ul>
	            <div class="copyright">
	                <p>&copy; <?php echo date("Y"); ?> Outdoor Sportsman Group. All Rights Reserved</p>
	            </div>
			</footer><!-- #footer -->
		</div><!-- .wrapper -->	
		<!-- defer script to prevent render blocking-->
		<script aysync src="<?php bloginfo('template_directory'); ?>/js/redesign/all-pages.js" type="text/javascript"></script>
		<?php 
    	include_once get_stylesheet_directory() . "/footer-includes.php";

	    if(is_single()){
	    	imo_ad_placement("teads");
	    }
		wp_footer(); 
	?>
	</body>
</html>
