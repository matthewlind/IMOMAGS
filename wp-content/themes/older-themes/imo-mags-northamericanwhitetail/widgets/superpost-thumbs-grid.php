<?php // Custom Superpost Thumbs Grid Widget

class Superpost_Thumbs_Grid_Widget extends WP_Widget {
	function Superpost_Thumbs_Grid_Widget() {
		$widget_ops = array('classname' => 'widget_superpost_thumbs_grid', 'description' => 'Superpost Thumbs Grid Widget.' );
		$this->WP_Widget('superpost_thumbs_grid', 'Superpost Thumbs Grid', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
?>
	<aside id="superpost-thumbs-grid" class="superpost-thumbs-grid-widget">
	     <h2>NAW+ Community</h2>
 		<ul id="sidebar-grid" class="thumbs-grid" term="all">	
 			<?php 
            for ($i = 1; $i <= 9; $i++) {
                echo '<li><a href=""><span>Views</span><img src=""></a></li>';
			} ?>
        </ul>
        <div class="footer">
        	<a href="/community">Browse The Community</a>
        </div>
    </aside>
    <div class="clearfix" style="margin-bottom: 10px;"></div>
<?php	}
 
}
register_widget('Superpost_Thumbs_Grid_Widget');