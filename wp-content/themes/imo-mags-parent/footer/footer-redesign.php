<?php
	
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
	$f_thumb	= get_the_post_thumbnail($f_p_id,"list-thumb");
	$foot_post_btn_txt	= 'Read Now!';
}
	
$site_name	= trim(get_bloginfo('name'), "Magazine");
	
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
			        	<li class="ad-wrap"><span class="ad-span">Advertisement</span><div class="ad-inner"></div></li>
		        	</ul>
				</div>
			</div>
			<footer id="footer" class="footer" role="contentinfo">
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
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/redesign/all-pages.js"></script>
	<?php wp_footer(); ?>
	</body>
</html>
