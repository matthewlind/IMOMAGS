</div><!-- end .s101 -->
<footer class="s-footer clearfix">
	<div class="s-mag clearfix">
		<div class="s-mag-cover">
			<img src="<?php bloginfo('template_directory');?>/images/microsites/gameandfish/crossbow-revolution/crossbow-revolution-cover-min.jpg">
		</div>
		<div class="s-mag-descr">
			<h1>Wheels Afield Magazine</h1>
			<p>What is Wheels Afield? It is overland vehicles and equipment, field sports, and adventure travel. In short, if it involves the outdoors and requires a vehicle to access it, it is Wheels Afield.</p>
		</div>
		<div class="s-mag-buy">			
			<h2>NOW AVAILABLE ON NEWSSTANDS!</h2>
			<?php echo do_shortcode('[osgimpubissue bipad="34837" alias="foot" vertical="up" gotxt="GO!"]'); ?>
			<div class="s-or">
				<div>OR</div>			
			</div>
			<div class="s-mag-btns clearfix">
				<div class="s-buy-btn">
					<a href="https://store.intermediaoutdoors.com/products.php?product=Game-%26-Fish-Crossbow-Revolution-2015" target="_blank">BUY THE MAGAZINE NOW!</a>
				</div>
				<div class="s-buy-btn">
					<a href=""> GET THE DIGITAL EDITION! </a>
					<div class="buy-mag-drop">
						<ul>
							<li><a href="https://itunes.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=985774523&mt=8" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/itunes-logo.png"><span>iTunes</span></a></li>
							<li><a href="https://play.google.com/store/apps/details?id=com.imo.wheelsafield" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/google_play_icon.png"><span>Google Play</span></a></li>
							<li><a href="http://apps.microsoft.com/windows/en-us/app/wheels-afield/865f31ca-7ea7-462f-9bad-0712025e3fd4" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/windows-store-icon.png"><span>Windows Store</span></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div><!-- end .s-mag-descr -->
	</div><!-- end .s-mag-descr -->
	<div class="footer-message clearfix">
		<h2>Love Guns, Gear, & Vehicles? Then Share it!</h2>
		<div class="f-social-buttons">
			<ul>
				<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo (urlencode(site_url())) . '/gear-accessories/gear-hunting/crossbows/'; ?>&title=Crossbow Revolution Magazine" class="icon-facebook" target="_blank"></a></li>
				<li><a href="http://twitter.com/intent/tweet?status=Crossbow Revolution Magazine+http://www.gameandfishmag.com/gear-accessories/gear-hunting/crossbows/" class="icon-twitter" target="_blank"></a></li>
				<li><a href="mailto:?subject=Website I came across&body=Check out this website! Crossbow Revolution Magazine. <?php echo (urlencode(site_url())) . '/gear-accessories/gear-hunting/crossbows/'; ?>" class="icon-mail" target="_blank"></a></li>
			</ul>
		</div><!-- .m-social-buttons -->
	</div>
	<div class="m-footer-bottom">
		<div class="m-logo-nav">
<!--
			<div class="m-imo-logo">
				<a href="http://www.imoutdoors.com/"><img src="/wp-content/themes/gunsandammo/images/shoot101/imo-logo.png"></a>
			</div>
-->
			<div class="m-footer-nav">
				<ul>
					<li><a href="http://www.imoutdoors.com/about/what-we-do/" target="_blank">ABOUT</a></li>
					<li><a href="http://www.imoutdoors.com/advertise/" target="_blank">ADVERTISE</a></li>
					<li><a href="http://www.imoutdoors.com/about/contact/" target="_blank">CONTACT</a></li>
					<li><a href="http://www.imoutdoors.com/about/careers/" target="_blank">CAREERS</a></li>
					<li><a href="http://www.imoutdoors.com/about/privacy/" target="_blank">PRIVACY POLICY</a></li>
				</ul>
			</div>
		</div><!-- end .m-logo-nav -->
		<div class="m-copyright">
	        <p>© 2015 Outdoor Sportsman Group. All Rights Reserved</p>
	    </div>
	</div><!-- end .m-footer-bottom -->
</footer>
<!-- 	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/microsite-js/gameandfish/script-crossbows.js"></script> -->
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
