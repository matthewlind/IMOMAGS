<?php // Custom Superpost Thumbs Grid Widget

class Superpost_Thumbs_Grid_Widget extends WP_Widget {
	function Superpost_Thumbs_Grid_Widget() {
		$widget_ops = array('classname' => 'widget_superpost_thumbs_grid', 'description' => 'Superpost Thumbs Grid Widget.' );
		$this->WP_Widget('superpost_thumbs_grid', 'Superpost Thumbs Grid', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
?>

    <aside id="superpost-thumbs-grid" class="superpost-thumbs-grid-widget">
	     <?php if(!empty($title)) : ?>
	     <h2><?php echo $title; ?></h2>
	     <?php endif; ?>
 		<ul class="thumbs-grid">	
 			<?php 
            for ($i = 1; $i <= 9; $i++) {
                echo '<li><a href=""><img src="#"></a></li>';
			} ?>
        </ul>
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
register_widget('Superpost_Thumbs_Grid_Widget');