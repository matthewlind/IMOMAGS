<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); } ?>

<article id="post-excerpt-<?php the_ID(); ?>" <?php post_class('entry entry-excerpt clearfix') ?>>
		
	<?php	if (has_post_thumbnail())
		echo '<a href="', the_permalink(),'">', the_post_thumbnail('post-thumbnail', array('class' => 'entry-img')), '</a>'; ?>
			
	<div class="entry-summary">
	  <span class="entry-category"><?php the_category(', '); ?></span>
		<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
		<?php the_excerpt(); ?>
	</div>
  
  <a class="comments" href="<?php comments_link(); ?>"><?php comments_number('0', '1', '%'); ?></a>

	<?php edit_post_link(__('Edit', 'carrington-business')); ?>

</article>