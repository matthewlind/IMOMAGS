<?php

class featured_sidebar_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function featured_sidebar_widget() {
        parent::WP_Widget(false, $name = 'Featured Sidebar Widget');
    }



    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args ); 
        
        $features = get_field('sidebar_featured_stories','options' );
        $featuredTitle = get_field('sidebar_featured_title','options' );

        if( $features ): 
        	echo $before_widget;
			if ( $featuredTitle )
                echo $before_title . $featuredTitle . $after_title; ?>
        	<ul class="sidebar-widget-featured-thumbs">
	        	<?php foreach( $features as $feature ):
		   	 		$title = $feature->post_title;
		
		   	 		if ($feature->promo_title) {
		   	 			$title = $feature->promo_title;
		   	 		}
		
		   	 		$url = $feature->guid;
					$thumb = get_the_post_thumbnail($feature->ID,"legacy-thumb");
					$tracking = "_gaq.push(['_trackEvent','Special Features Homepage','$title','$url']);"; ?>
					
			        <a href="<?php echo $url; ?>" onclick="<?php echo $url; ?>">
				        <li class="sidebar-featured">
				            <div class="feat-post">
				                <div class="feat-img"><?php echo $thumb; ?></div>
				                <div class="feat-text"><p><?php echo $title; ?></p></div>
				            </div>
				        </li>
			        </a>
		        <?php endforeach; ?>
        	</ul>
        <?php endif; ?>
		
					
      <?php echo $after_widget; 
          
    }

    function form() {



        echo '<p style="font-weight:bold;"><a href="/wp-admin/admin.php?page=acf-options">Set featured stories on the options page.</p></a>';
      
    }



} // end class example_widget


add_action('widgets_init', create_function('', 'return register_widget("featured_sidebar_widget");'));
