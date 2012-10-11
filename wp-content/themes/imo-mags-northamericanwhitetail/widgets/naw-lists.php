<?php // Custom Naw List Widget

class Naw_List_Widget extends WP_Widget {
	function Naw_List_Widget() {
		$widget_ops = array('classname' => 'widget_naw_list', 'description' => 'Naw Lists Widget' );
		$this->WP_Widget('naw_lists', 'Naw Lists Widget', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
?>

    <aside id="naw-list-nav" class="naw-list-widget">
	    <div class="sidebar-header">
			<h2>The NAW Lists</h2>
    	</div>
    	<ul class="naw-grid">	
 			<?php
			
				$args = array(
					'category_name' => 'galleries',
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
        	<a href="/naw-lists">Show More Lists<span></span></a>
        </div>

    </aside>

<?php	}
 
}
register_widget('Naw_List_Widget');