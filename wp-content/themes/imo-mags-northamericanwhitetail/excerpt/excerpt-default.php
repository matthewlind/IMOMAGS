<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }
?>
<article id="post-excerpt-<?php the_ID(); ?>" <?php post_class('entry entry-excerpt') ?>>
	<?php if (has_post_thumbnail()) : ?>
		<a href="<?php the_permalink(); ?>"<?php if( in_category('video') ){echo ' class="video-excerpt"';} ?>><?php the_post_thumbnail('post-thumbnail', array('class' => 'entry-img')); if( in_category('video') ){echo '<span></span>';} ?></a>

	<?php endif; ?>
	<div class="entry-summary">
	  <span class="entry-category"><?php the_category(' &middot; '); ?></span>
		<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
		<span class="author vcard"><?php the_time(get_option('date_format')); ?> <span class="fn">by <?php the_author(); ?></span></span>
		<?php the_excerpt(); ?>
	</div>
  <a class="comment-count" href="<?php comments_link(); ?>"><?php echo get_comments_number(); ?></a>
</article>