<?php // Custom Superpost Thumbs Scroller Widget

class Superpost_Thumbs_Scroller_Widget extends WP_Widget {
	function Superpost_Thumbs_Scroller_Widget() {
		$widget_ops = array('classname' => 'widget_superpost_thumbs_scroller', 'description' => 'Superpost Thumbs Scroller Widget.' );
		$this->WP_Widget('superpost_thumbs_scroller', 'Superpost Thumbs Scroller', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
	$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
?>

    <aside id="superpost-thumbs" class="superpost-thumbs-widget">
    	<h2><?php echo $title; ?></h2>
 		<div id="scroll_mask-widget" class="scroll_mask">
 			<ul id="scroll-widget" class="scroll">
 				
 				<?php 
                 for ($i = 1; $i <= 12; $i++) {
                    echo '<li><a href=""><span>Views</span><img src="#"></a></li>';
				} ?>
            </ul>
        </div>   
        <a id="prev-1" class="prev">PREV</a>
        <a id="next-1" class="next">NEXT</a> 
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
register_widget('Superpost_Thumbs_Scroller_Widget');