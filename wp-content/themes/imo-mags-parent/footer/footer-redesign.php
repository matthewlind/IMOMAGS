<?php
$site_name	= trim(get_bloginfo('name'), "Magazine");
$f_post 	= get_field('footer_post_or_page','options' );
$f_p_id		= $f_post[0];
$f_thumb	= get_the_post_thumbnail($f_p_id,"list-thumb");
$f_url		= get_permalink($f_p_id);
$f_title	= get_the_title($f_p_id);	
?>			
			<div class="pre-footer">
				<div class="section-inner-wrap">
		        	<ul>
			        	<li class="f-newsletter">
			        		<h3>Get the <?php echo $site_name; ?> Email!</h3>
							<p>Get the Top Stories from <?php echo $site_name; ?> Delivered to Your Inbox Every Week</p>
							<?php get_template_part("content/redesign/content", "newsletter");?>
			        	</li>
			        	<li class="f-feat-page"><?php echo "<h3><a href='$f_url'>$f_title</a></h3><a href='$f_url'>$f_thumb</a><a class='link-to-all' href='$f_url'>Explore!</a>"; ?></li>
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
