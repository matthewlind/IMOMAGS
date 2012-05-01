<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post(); ?>

<div class="page-template-page-right-php right-sidebar-gallery">
  <div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('cc-sidebar')) : else : ?><?php endif; ?>
	</div>
	<div id="content">
	<h1 class="seo-h1">Caption Contest</h1>
		<div <?php post_class('entry entry-full'); ?>>
			<div class="entry-content">
				<div class="cfct-module cfct-html section-title posts">
					<div class="cfct-mod-content">
						<h4>
 							<div class="icon"></div>
  								<span>Caption Contest</span>
						</h4>
					</div>
				</div>

				<?php
				the_content(__('Continued&hellip;', 'carrington-business'));
				wp_link_pages(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>