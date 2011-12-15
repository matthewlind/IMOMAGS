<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();

the_post(); ?>

<header id="masthead">
	<h1><?php the_title(); ?></h1>
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
</header>

<div id="carrington-modules" class="col-abc">
	<div <?php post_class('entry entry-full'); ?>>
		<div class="entry-content">
			<?php
			the_content(__('Continued&hellip;', 'carrington-business'));
			wp_link_pages(); ?>
		</div>
		<?php edit_post_link(__('Edit', 'carrington-business')); ?>
	</div>
</div>

<?php get_footer(); ?>