	<?php get_template_part('_subfooter'); ?>
	<div class="clear"></div>
	<footer id="footer">
		<div class="container">
			<div id="footer-inner" class="fix">
				
				<?php wp_nav_menu(array('container'=>'nav','container_id'=>'nav-footer','theme_location'=>'wpb-nav-footer','menu_id'=>'nav-alt','menu_class'=>'pad fix', 'fallback_cb'=>FALSE)); ?>
				
				<div id="footer-bottom">
					<div class="pad fix">
						<div class="grid">
							<?php if ( wpb_option('footer-logo') ): ?>
								<img id="footer-logo" src="<?php echo wpb_option('footer-logo'); ?>" alt="<?php get_bloginfo('name'); ?>">
							<?php endif; ?>
							
							<?php echo wpb_social_media_links(array('id'=>'footer-social')); ?>
						</div>
						<div class="grid">
							<p id="copy"><?php echo wpb_footer_text(); ?></p>
						</div>
					</div>
					<div class="clear"></div>
					<a id="to-top" href="#"><i class="icon-top"></i></a>
				</div>
			</div><!--/footer-inner-->
		</div>
	</footer><!--/footer-->
	
</div><!--/wrap-->
<?php wp_footer(); ?>
</body>
</html>