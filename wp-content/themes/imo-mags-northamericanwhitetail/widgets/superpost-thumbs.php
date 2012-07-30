<?php // Custom Superpost Thumbs Widget

class Superpost_Thumbs_Widget extends WP_Widget {
	function Superpost_Thumbs_Widget() {
		$widget_ops = array('classname' => 'widget_superpost_thumbs', 'description' => 'Superpost Thumbs Widget.' );
		$this->WP_Widget('superpost_thumbs', 'Superpost Thumbs', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
?>

    <aside id="superpost-thumbs" class="superpost-thumbs-widget">
    	<h2>More from the community</h2>
 		<div id="scroll_mask-widget" class="scroll_mask">
 			<ul id="scroll-widget" class="scroll">
 				
 				<?php 
                 for ($i = 1; $i <= 36; $i++) {
                    echo '<li><a href=""><img src="#"></a></li>';
				} ?>
            </ul>
        </div>   
        <a id="prev-1" class="prev">PREV</a>
        <a id="next-1" class="next">NEXT</a> 
             	
							
      	<div class="footer">

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
	}
}
register_widget('Superpost_Thumbs_Widget');