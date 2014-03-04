<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post(); ?>
<div class="page-template-page-right-php right-sidebar-landing">
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('shooting-sidebar')) : else : ?><?php endif; ?>
	</div>
	<div id="content">
		<h1 class="seo-h1">Shooting</h1>
		<div <?php post_class('entry entry-full'); ?>>
			<div class="entry-content">
			<div class="cfct-module cfct-html section-title posts">
					<div class="cfct-mod-content">
						<h4>
 							<div class="icon"></div>
  								<span><?php the_title(); ?></span>
						</h4>
					</div>
				</div>
				<?php the_content(__('Continued&hellip;', 'carrington-business')); ?>
		


					
										
<hr>
<div class="c4-1234 cfct-block-abc cfct-block block-0">
			<div class="cfct-module cfct-html section-title posts">
				<div class="cfct-mod-content"><h4>
  						<div class="icon"></div>
  						<span>Latest Reviews</span>
				</h4></div>
			</div>	
		<?php
		
	$the_query = new WP_Query( array( 'guntype' => '1911-reviews' ) );
	while ( $the_query->have_posts() ) : $the_query->the_post();
	
	?>
		<li class="page-reviews">
		<?php if (has_post_thumbnail()) :
		echo '<a href="', the_permalink(),'">', the_post_thumbnail('post-thumbnail', array('class' => 'entry-img')), '</a>'; ?>
		<?php endif; ?>
		<a class="title" rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title() ?></a><br />
		<a class="comments" href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
		</li>

	<?php 
	endwhile;

// Reset Post Data
wp_reset_postdata();
cfct_misc('nav-posts'); ?>
</div> <!-- end div col-abc-->
</div> <!-- end class="page-template-page-right-php" -->

<?php
get_footer();
?>