<?php

_deprecated_file( sprintf( __( 'Theme without %1$s' ), basename(__FILE__) ), '3.0', null, sprintf( __('Please include a %1$s template in your theme.'), basename(__FILE__) ) );
?>
			</div><!-- #main -->
			<div class="content-banner-section footer-728">
	        	<div class="mdl-banner">
					 <?php imo_ad_placement("728_btf"); ?>
				</div>
			</div>
		</div><!-- .layout-frame -->

		<div id="footer" class="footer" role="contentinfo">

		        <div class="intermedia">
		            <div class="frame">
		                <h4>Outdoor Sportsman Group Network</h4>
		                <div class="foot-columns">
		                    <div class="f-two-columns">
		                        <div class="column">
		                            <h5>Hunt</h5>
		                            <ul class="intermedia-list">
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
		                            <ul class="intermedia-list">
		                                <li class="f-handguns"><a target="_blank" href="http://www.handgunsmag.com/"><span>Handguns</span></a></li>
		                                <li class="f-rifleshooter"><a target="_blank" href="http://www.rifleshootermag.com/"><span>Rifleshooter</span></a></li>
		                                <li class="f-shooting-times"><a target="_blank" href="http://www.shootingtimes.com/"><span>Shooting Times</span></a></li>
		                                <li class="f-firearms-news"><a target="_blank" href="http://www.shotgunnews.com/"><span>Firearms News</span></a></li>
		                                <li class="f-guns-and-ammo"><a target="_blank" href="http://www.gunsandammo.com/"><span>Guns &amp; Ammo</span></a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="f-two-columns">
		                        <div class="column column3">
		                            <h5>Fish</h5>
		                            <ul class="intermedia-list">
		                                <li class="f-in-fisherman"><a href="http://www.in-fisherman.com" target="_blank"><span>In-Fisherman</span></a></li>
		                                <li class="f-fly-fisherman"><a target="_blank" href="http://www.flyfisherman.com"><span>Fly Fisherman</span></a></li>
		                                <li class="f-florida-sportsman"><a target="_blank" href="http://www.floridasportsman.com/"><span>Florida Sportsman</span></a></li>
		                                <li class="f-bass-fan"><a target="_blank" href="http://www.bassfan.com/"><span>BassFan</span></a></li>
		                            </ul>
		                        </div>
		                        <div class="column column4">
		                            <h5>TV & More</h5>
		                            <ul class="intermedia-list">
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
		        </div>
		        <div class="f-nav-section clearfix">
		            <ul class="foot-nav">
		                <li><a href="http://www.imoutdoors.com/" target="_blank">ABOUT</a></li>
		                <li><a href="http://www.imoutdoors.com/" target="_blank">ADVERTISE</a></li>
		                <li><a href="http://www.imoutdoors.com/about/contact" target="_blank">CONTACT</a></li>
		                <li><a href="http://www.imoutdoors.com/about/careers" target="_blank">CAREERS</a></li>
						<li><a href="http://www.imoutdoors.com/about/privacy" target="_blank">PRIVACY POLICY</a></li>
		                <!--<li class="mobile-element-320"><a href="#">SPONSORSHIP/ADVERTISING</a></li>
		                <li class="mobile-element-320"><a href="#">TERMS OF USE</a></li>
		                <li class="mobile-element-320"><a href="#">LINK TO US</a></li>
		            </ul>
		            <a href="#" class="f-single-link">Conservation Partners</a>-->
		        </div>
		        <div class="copyright-section clearfix">
		            <div class="copyright">
		                <p>&copy; <?php echo date("Y"); ?> Outdoor Sportsman Group. All Rights Reserved</p>
		            </div>
		        </div>

			</div><!-- #footer -->
		</div><!-- .wrapper -->
	</div><!-- #page -->
	<?php if( get_field("display_survey","options") == true ){ ?><div id="imo-modal"><a class="modal-close" href="javascript:void(0);" title="Collapse bottom bar"><img src="/wp-content/themes/imo-mags-parent/images/ico/close_icon_small.png" alt="Collapse bottom bar"></a><a target="_blank" href="<?php echo get_field("survey_url","options"); ?>"><img class="survey-img" src="<?php echo get_field("survey_image","options"); ?>" alt="survey" title="Survey" /></a></div><?php } ?>


    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.tipTip.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/breakpoints.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/ezmark/js/jquery.ezmark.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/classie.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/helper.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/jquery.placeholder.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/jquery.touchSwipe.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/Smart-jQuery-Brightcove-Video-Plugin/jquery.brightcove-video.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/video-portal.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/script.js"></script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/script.js"></script>
    <link rel="STYLESHEET" type="text/css" href="<?php bloginfo('template_directory'); ?>/js/plugins/ezmark/css/ezmark.css">
	<!--[if lt IE 9]><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->

	<?php wp_footer(); ?>
	<?php if(get_field("scroll_tracking","options")){ ?>
	<script src="<?php bloginfo('template_directory'); ?>/js/jquery.scrolldepth.js"></script>
	<script>
		jQuery.scrollDepth();
	</script>
	<?php } ?>
	</body>
</html>
