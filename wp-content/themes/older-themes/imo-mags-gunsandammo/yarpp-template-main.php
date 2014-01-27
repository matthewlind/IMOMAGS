<?php if ($related_query->have_posts()) : $i = 0; ?>
<div class="related-posts-container">
  <h4 class="related-title">Related [term]</h4>
  <div class="related-posts">
  	<?php while ($related_query->have_posts() && $i < 3) : $related_query->the_post(); ?>
  	  <article id="post-excerpt-<?php the_ID(); ?>" <?php post_class('entry entry-excerpt') ?>>

      	<?php	if (has_post_thumbnail()) :
      		echo '<a href="', the_permalink(),'">', the_post_thumbnail('post-thumb', array('class' => 'entry-img')), '</a>';
      	endif; ?>

      	<div class="entry-summary">
      	  <span class="entry-category"><?php the_category(', '); ?></span>
      		<h6 class="entry-title"><a rel="bookmark" href="<?php the_permalink() ?>"><?php the_title() ?></a></h6>
      	</div>

      </article>
  	<?php $i++; endwhile; ?>
  </div>
</div>
<?php endif; ?>
