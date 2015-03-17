</div>
<footer class="s-footer">
	<h1>This is footer</h1>
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
