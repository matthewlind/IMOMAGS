</div>
<footer class="s-footer clearfix">
	<div class="s-mag clearfix">
		<div class="s-mag-cover">
			<img src="/wp-content/themes/gunsandammo/images/shoot101/mag-cover.jpg">
		</div>
		<div class="s-mag-descr">
			<h1>Learn, Train, Live</h1>
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis.</p>
		</div>
		<div class="s-mag-buy">
			<h2>NOW AVAILABLE ON NEWSSTANDS!</h2>
			<div class="s-or">
				<div>OR</div>			
			</div>
			<div class="s-mag-btns clearfix">
				<a class="orange-btn" href="">BUY THE MAGAZINE NOW!</a>
				<a class="orange-btn" href="">GET THE DIGITAL EDITION!</a>
			</div>
		</div><!-- end .s-mag-descr -->
	</div><!-- end .s-mag-descr -->
	<div class="footer-message clearfix">
		<h2>Help grow shooting in America. Share this with a new shooter!</h2>
		<div class="f-social-buttons">
			<ul>
				<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode(get_permalink())); ?>&title=<?php print(urlencode(the_title())); ?>" class="icon-facebook"></a></li>
				<li><a href="http://twitter.com/intent/tweet?status=<?php print(urlencode(the_title())); ?>+<?php print(urlencode(get_permalink())); ?>" class="icon-twitter"></a></li>
				<li><a class="icon-mail"></a></li>
			</ul>
		</div>
	</div>
	<div class="m-footer-bottom">
		<div class="m-logo-nav">
			<div class="m-imo-logo">
				<a href="http://www.imoutdoors.com/"><img src="/wp-content/themes/gunsandammo/images/shoot101/imo-logo.png"></a>
			</div>
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
	        <p>© 2015 InterMedia Outdoors. All Rights Reserved</p>
	    </div>
	</div><!-- end .m-footer-bottom -->

</footer>

<!--
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.tipTip.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.cookie.js"></script>
-->
<!--     <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/breakpoints.js"></script> -->
<!-- 	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/flexslider/jquery.flexslider.js"></script> -->
<!--
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/ezmark/js/jquery.ezmark.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/classie.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/helper.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/jquery.placeholder.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/jquery.touchSwipe.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/plugins/Smart-jQuery-Brightcove-Video-Plugin/jquery.brightcove-video.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/video-portal.js"></script>
-->
<!--
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/script.js"></script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/script.js"></script>
-->
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/shoot101.js"></script>
<!--
    <link rel="STYLESHEET" type="text/css" href="<?php bloginfo('template_directory'); ?>/js/plugins/flexslider/flexslider.css">
    <link rel="STYLESHEET" type="text/css" href="<?php bloginfo('template_directory'); ?>/js/plugins/ezmark/css/ezmark.css">
-->
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
