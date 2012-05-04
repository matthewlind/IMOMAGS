<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();
global $post;
the_post(); ?>

<div id="carrington-modules" class="col-abc <?php echo $post->post_name; ?>">
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