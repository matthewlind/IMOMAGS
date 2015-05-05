<?php
	$category_id = get_cat_ID( 'shoot101' );
	$category_link = get_category_link( $category_id );	
?>
</div><!-- end .s101 -->
<footer class="s-footer clearfix">
	<div class="s-mag clearfix">
		<div class="s-mag-cover">
			<img src="/wp-content/themes/gunsandammo/images/shoot101/mag-cover.jpg">
		</div>
		<div class="s-mag-descr">
			<h1>Learn, Train, Live</h1>
			<p>Know someone interested in the shooting sports? Start them off right with Shoot 101, the ideal magazine for mastering the basics of safe, responsible shooting. Compiled by the publishers of Guns & Ammo and filled with educational, entertaining articles, Shoot 101 is a wealth of information for novice and expert shooters alike.</p>
		</div>
		<div class="s-mag-buy">
			<h2>NOW AVAILABLE ON NEWSSTANDS!</h2>
			<div class="s-or">
				<div>OR</div>			
			</div>
			<div class="s-mag-btns clearfix">
				<a class="orange-btn" href="https://store.intermediaoutdoors.com/products.php?product=Shoot-101" target="_blank">BUY THE MAGAZINE NOW!</a>
				<div class="orange-btn">
					GET THE DIGITAL EDITION!
					<div class="buy-mag-drop">
						<ul>
							<li><a href="https://itunes.apple.com/us/app/shoot-101/id980668053?ls=1&mt=8" target="_blank"><img src="/wp-content/themes/gunsandammo/images/shoot101/itunes-logo.png"><span>iTunes</span></a></li>
							<li><a href="https://play.google.com/store/apps/details?id=com.imo.shooting101" target="_blank"><img src="/wp-content/themes/gunsandammo/images/shoot101/google_play_icon.png"><span>Google Play</span></a></li>
							<li><a href="http://apps.microsoft.com/windows/en-us/app/shoot-101/0560cb9d-d461-4856-9abd-d3efb69862d9" target="_blank"><img src="/wp-content/themes/gunsandammo/images/shoot101/windows-store-icon.png"><span>Windows Store</span></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div><!-- end .s-mag-descr -->
	</div><!-- end .s-mag-descr -->
	<div class="footer-message clearfix">
		<h2>Help grow shooting in America. Share this with a new shooter!</h2>
		<div class="f-social-buttons">
			<ul>
				<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&title=<?php if(is_category("shoot101")){ echo "Shoot101: A starter's guide every new shooter should read."; }else{ print(urlencode(the_title())); } ?>" class="icon-facebook" target="_blank"></a></li>
						<li><a href="http://twitter.com/intent/tweet?status=<?php if(is_category("shoot101")){ echo "Shoot101: A starter's guide every new shooter should read."; }else{ print(urlencode(the_title())); } ?>+<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" class="icon-twitter" target="_blank"></a></li>
						<li><a href="mailto:?subject=Article I came across&body=Check out this article! Title: '<?php the_title(); ?>'. Link: <?php the_permalink(); ?>" class="icon-mail" target="_blank"></a></li>
			</ul>
		</div>
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
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/shoot101.js"></script>
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
