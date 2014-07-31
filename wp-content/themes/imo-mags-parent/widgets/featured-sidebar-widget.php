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
			if ( $featuredTitle ){
                echo $before_title . $featuredTitle . $after_title; 
             } ?>
        	<ul class="sidebar-widget-featured<?php if( $instance['select'] == "Small Images" ){ echo '-thumbs'; } ?>">
	        	<?php foreach( $features as $feature ):
		   	 		$title = $feature->post_title;
		
		   	 		if ($feature->promo_title) {
		   	 			$title = $feature->promo_title;
		   	 		}
		
		   	 		$url = $feature->guid;
		   	 		
		   	 		if( $instance['select'] == "Small Images" ){ 
						$thumb = get_the_post_thumbnail($feature->ID,"legacy-thumb");
					}else if( $instance['select'] == "Large Images" ){
						$thumb = get_the_post_thumbnail($feature->ID,"post-thumb");
					}
					
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


    function form($instance) {

		echo '<p style="font-weight:bold;"><a href="/wp-admin/admin.php?page=acf-options">Set featured stories on the options page.</p></a>';
		

		// Check values
		if( $instance) {
		     $select = esc_attr($instance['select']); 
		} else {
		     $select = '';
		}
		?>
		
				
		<p>
			<label for="<?php echo $this->get_field_id('select'); ?>"><?php _e('Select', 'wp_widget_plugin'); ?></label>
			<select name="<?php echo $this->get_field_name('select'); ?>" id="<?php echo $this->get_field_id('select'); ?>" class="widefat">
				<?php
				$options = array('Large Images', 'Small Images');
				foreach ($options as $option) {
				echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
			?>
			</select>
		</p>
		<?php
	}
	
	
	// update widget
	function update($new_instance, $old_instance) {
	
	      $instance = $old_instance;
	
	      // Fields
	      $instance['select'] = strip_tags($new_instance['select']);
	
	     return $instance;
	
	}
}
add_action('widgets_init', create_function('', 'return register_widget("featured_sidebar_widget");'));
