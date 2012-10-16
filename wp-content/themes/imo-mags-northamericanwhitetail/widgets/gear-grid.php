<?php // Custom Gear Grid Widget

class Gear_Grid_Widget extends WP_Widget {
	function Gear_Grid_Widget() {
		$widget_ops = array('classname' => 'widget_gear_grid', 'description' => 'Gear Grid Widget' );
		$this->WP_Widget('gear_grids', 'Gear Grid Widget', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
?>

    <aside id="gear-grid-nav" class="gear-grid-widget">
	    <div class="sidebar-header">
			<h2>Gear Reviews</h2>
    	</div>
    	<ul class="gear-grid">	
 			<?php
			
				$args = array(
					'category_name' => 'gear',
					'post_status'  => 'publish',
					'posts_per_page' => 4,
					'orderby' => 'date',
					'order' => 'DESC'
				);
				$query = new WP_Query( $args );
				if ( $query->have_posts() ) :
				
				while ( $query->have_posts() ) : $query->the_post(); ?>
					<li><a href="<?php the_permalink(); ?>">
						<span>
							<?php 
							$shorttitle = substr(the_title('','',FALSE),0,60);
							echo $shorttitle; if (strlen($shorttitle) > 59){ echo '&hellip;'; } 
							?>
						</span><?php the_post_thumbnail('gallery-grid'); ?></a></li>

				<?php 
				
				endwhile;
				endif;
				// Reset Post Data
				wp_reset_postdata();
				?>
        </ul>
        <div class="footer">
        	<a href="/gear">Show More Gear<span></span></a>
        </div>

    </aside>

<?php	}
 
}
register_widget('Gear_Grid_Widget');