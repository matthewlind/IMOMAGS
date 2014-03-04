<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();
global $post;

// Test if this is a blog homepage (a child of Blogs landing page)
$blog = $post->post_parent == get_id_by_slug('blogs') ? "blog" : null;

the_post(); ?>

<?php if (!$blog) : ?>
<header id="masthead">
	<h1><?php the_title(); ?></h1>
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
</header>
<?php endif; ?>

<div id="carrington-modules" class="col-abc <?php echo $blog; ?>">
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