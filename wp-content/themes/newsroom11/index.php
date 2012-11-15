<?php get_header(); ?>

<div id="page">
	<div class="container">
		<div id="page-inner">

			<div class="main fix <?php echo wpb_option('general-sidebar','sidebar-right'); ?>">
			
				<div class="content-part">
					<?php if ( wpb_option('featured-slider-enable') ) { get_template_part('_featured'); } ?>
					<?php
						if ( wpb_option('post-structure-home') ) {
							get_template_part('_loop-alt');
						} else {
							get_template_part('_loop');
						}
					?>
				</div><!--/content-part-->
				
				<div class="sidebar">	
					<?php get_sidebar(); ?>
				</div><!--/sidebar-->
			
			</div><!--/main-->
			
		</div><!--/page-inner-->
	</div><!--/container-->
</div><!--/page-->

<?php get_footer(); ?>