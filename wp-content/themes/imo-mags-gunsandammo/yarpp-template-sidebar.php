<h3 class="widget-title"><span>Related Blog Articles</span></h3>
<?php if ($related_query->have_posts()) :?>

	<?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
	  <article id="post-excerpt-<?php the_ID(); ?>" <?php post_class('entry entry-excerpt') ?>>

    	<?php	if (has_post_thumbnail()) :
    		echo '<a href="', the_permalink(),'">', the_post_thumbnail('post-thumb', array('class' => 'entry-img')), '</a>';
    	endif; ?>

    	<div class="entry-summary">
    	  <span class="entry-category"><?php the_category(', '); ?></span>
    		<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
    	</div>

    </article>
	<?php endwhile; ?>
<?php else : ?>
<p>No related posts.</p>
<?php endif; ?>