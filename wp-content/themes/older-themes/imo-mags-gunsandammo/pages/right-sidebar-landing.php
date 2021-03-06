<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post(); ?>

<div class="page-template-page-right-php right-sidebar-landing">

  <header id="masthead">
    <h1><?php the_title(); ?></h1>
  </header>
  <div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-landing')) : else : ?><?php endif; ?>
	</div>
	<div id="content">
		<div <?php post_class('entry entry-full'); ?>>
			<div class="entry-content">
				<?php
				the_content(__('Continued&hellip;', 'carrington-business'));
				<?php wp_link_pages(); ?>
				
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>