<?php // Custom Gallery loop Widget

class Gallery_Loop_Widget extends WP_Widget {
	function Gallery_Loop_Widget() {
		$widget_ops = array('classname' => 'widget_gallery_loop', 'description' => 'Gallery Loop Widget.' );
		$this->WP_Widget('gallery_loop', 'Gallery Loop', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); ?>

    <aside id="gallery-loop" class="gallery-loop-widget">
      	<?php if(!empty($title)) : ?>
        <h3 class="widget-title">
          <span><?php echo $title; ?></span>
        </h3>
        <?php endif; ?>

	      	<?php
				$args = array(
				'post_type' => 'post',
				'category_name' => 'galleries',
				'post_status' => 'publish',
				'orderby' => 'date',
				'order' => 'DESC',
				'posts_per_page' => 3,
				);
				// The Query
				$the_query = new WP_Query( $args );

				// The Loop
				while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<article id="post-excerpt-<?php the_ID(); ?>" <?php post_class('entry entry-excerpt') ?>>
								<?php if (has_post_thumbnail()) : ?>
								<div class="thumb">
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
								</div>
								<?php endif; ?>
								<div class="entry-summary">
									<h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
									<a class="comments" href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
								</div>
			 			 		
							</article>
			
				<?php endwhile;
				// Reset Post Data
				wp_reset_postdata(); 
				
				?>

      	<div class="footer">
	      	<a href="/category/galleries/">More Galleries<span></span></a>
      	</div>
    </aside>

<?php	}
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
 
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array('title' => ''));
		$title = strip_tags($instance['title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
	}
}
register_widget('Gallery_Loop_Widget');