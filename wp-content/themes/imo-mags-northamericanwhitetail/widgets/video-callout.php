<?php // Custom Video Callout Widget

class Video_Callout_Widget extends WP_Widget {
	function Video_Callout_Widget() {
		$widget_ops = array('classname' => 'widget_video_callout', 'description' => 'Video Callout Widget.' );
		$this->WP_Widget('video_callout', 'Video Callout', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); ?>

    <aside id="video-callout" class="video-widget">
      <div class="content_wrapper">
      	<div class="header"></div>
      	
	      	<?php
				$args = array(
				'post_type' => 'post',
				'category_name' => 'video',
				'post_status' => 'publish',
				'orderby' => 'date',
				'order' => 'DESC',
				'posts_per_page' => 1,
				);
				// The Query
				$the_query = new WP_Query( $args );

				// The Loop
				while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	
				<div class="content">		
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('video-widget-thumb'); ?>
						<div class="title"><?php the_title(); ?><p>Naw TV</p></div>
						<span></span>
					</a>
				</div>
				<?php endwhile;
				// Reset Post Data
				wp_reset_postdata(); 
				
				?>

      	<div class="footer">
	      	<a href="/video/">More Video<span></span></a>
      	</div>
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
register_widget('Video_Callout_Widget');