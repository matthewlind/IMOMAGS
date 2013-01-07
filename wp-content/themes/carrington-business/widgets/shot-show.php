<?php // Custom Related Products Widget

class Shot_Show_Widget extends WP_Widget {
	function Shot_Show_Widget() {
		$widget_ops = array('classname' => 'widget_shot_show', 'description' => 'Shot Show Widget' );
		$this->WP_Widget('shot_show', 'Shot Show', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
	?>
		<aside id="shot-show-widget">
			<div class="widget-header shot-show">
			<h4>SHOT Show 2013</h4>
			<div class="sub-header">New Products & Daily Updates</div>
			<div class="widget-border"></div>
			<div class="presented-by">Presented By</div>
			<?php //if( is_category("military-arms") ){ echo " <h4>Military Arms</h4>"; }?>
			<!--<div class="desc">Your destination for the newest guns and gear coming out of the industry's biggest event of the year!</div>-->
			<div class="sponsor-logo"></div>
		</div>
		<ul>		
			<?php
			$args = array(
				"category_name" => "shot-show-2013",
				"posts_per_page" => 4,
				"orderby" => "date",
				"order" => "DESC"
				
			);

			// The Query
			$the_query = new WP_Query( $args );
			
			// The Loop
			while ( $the_query->have_posts() ) : $the_query->the_post();
				$url = get_permalink();
				$title = the_title(null,null,FALSE);
				echo "<li><a href='$url'>$title</a></li>";

			endwhile;
			
			// Reset Post Data
			wp_reset_postdata();
			
			?>
			
			</ul>
			<div class="see-all"><a href="#">See All 2013 SHOT Show Coverage</a><span></span></div>
		</aside>
		<div style="clear:both;"></div>
		
	<?php	
		}
}
register_widget('Shot_Show_Widget');