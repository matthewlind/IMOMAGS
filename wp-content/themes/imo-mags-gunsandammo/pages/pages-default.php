<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();
global $post;
the_post(); ?>
<div class="page-template-page-right-php right-sidebar-landing">
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('reviews-sidebar')) : else : ?><?php endif; ?>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php imo_dart_tag("300x250",false,array("pos"=>"btf")); ?>
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
		</div>
	</div>
	
	<div id="content">
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
			<?php
			the_content(__('Continued&hellip;', 'carrington-business'));
			wp_link_pages(); ?>
			</div><!-- .entry-content -->
			<?php edit_post_link(__('Edit', 'carrington-business')); ?>
		</div><!-- .post-class -->
	</div><!-- #content -->
</div>

<?php get_footer(); ?>