<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

?>
<div <?php post_class('entry entry-full clearfix') ?>>
	<div class="entry-header">
		<?php
		// If we're not showing this particular single post page, link the title
		$this_post_is_not_single = (!is_single(get_the_ID()));
		if ($this_post_is_not_single) { ?>
			<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title() ?></a></h2>
		<?php
		} else {
		?>
			<h1 class="entry-title"><?php the_title() ?></h1>
		<?php
		}
		?>
		<div class="entry-info">
            <?php if (! in_category("What's Biting Now")): ?>
			<span class="author vcard"><span class="fn">by <?php the_author_link(); ?></span></span>
			<span class="spacer">|</span>
            <?php endif; ?>
			<time class="published" datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></time>
		</div>
		<a class="comment-count" href="#idc-container"><?php echo get_comments_number(); ?></a>
	</div>
	<?php if (function_exists('imo_add_this')) {imo_add_this();} ?>
	<div class="entry-content">
		<?php
		// Un-comment this if you want featured images to automatically appear on full posts
		// the_post_thumbnail('thumbnail', array('class' => 'entry-img'));
		the_content(__('Continued&hellip;', 'carrington-business'));
		
		?>
	</div>
  <!-- <div class="entry-footer">
    <?php _e('In', 'carrington-business'); ?>
    <?php
    the_category(', ');
    the_tags(__(' <span class="spacer">&bull;</span> Tagged ', 'carrington-business'), ', ', '');
    wp_link_pages();
    ?>
  </div> -->
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
</div>