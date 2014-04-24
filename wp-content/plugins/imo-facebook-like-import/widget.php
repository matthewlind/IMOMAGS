<?php

class imo_like_leaderboard_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function imo_like_leaderboard_widget() {
        parent::WP_Widget(false, $name = 'FB Likes Leaderboard');
    }

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        $banner		= apply_filters('widget_banner', $instance['banner']);
        $title 		= apply_filters('widget_title', $instance['title']);
        $link		= apply_filters('widget_title', $instance['link']);
        $link_title	= apply_filters('widget_title', $instance['link_title']);
        $count 		= apply_filters('widget_count', $instance['count']);
        $message 	= $instance['message'];
        ?>
              <?php echo $before_widget; ?>
							<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>
			  				<div class="banner">
			  					<img src="<?php echo "$banner"; ?>" alt="<?php echo "$title"; ?>" title="<?php echo "$title"; ?>" />
			  					 <h3><?php echo "$message"; ?></h3>
			  				</div>
   							<a class="enter" href="/photos/add-new-photo">Submit yours now</a>
                         <h2><?php echo "$title"; ?></h2>
							<ul class="leaderboard-list">
                                <?php

                                    global $wpdb;

                                    $sql = "SELECT *,CONVERT(likes.meta_value, UNSIGNED INTEGER) as like_count FROM wp_14_posts as posts
                                            JOIN wp_14_postmeta AS likes ON (posts.ID = likes.post_id AND likes.meta_key = 'facebook_like_count')
                                            WHERE post_type = 'reader_photos'
                                            ORDER BY like_count DESC LIMIT $count";

                                    $posts = $wpdb->get_results($sql);

                                    foreach ($posts as $post) {


                                        $thumb_id = get_post_thumbnail_id($post->ID);
                                        $thumb_url = wp_get_attachment_image_src($thumb_id,"imo-mini-slider-thumb");
                                        $thumbnailURL = $thumb_url[0];

                                        echo "<li>
                                        		<div class='like-wrap'><span class='like-count'>{$post->like_count}</span> <img src='/wp-content/plugins/imo-facebook-like-import/images/like@2x.png' class='like-icon'></div>
                                        		<div class='fb-like' data-href='{$post->guid}' data-width='40px' data-layout='button' data-action='like' data-show-faces='true' data-share='false'></div>
	                                            <a href='{$post->guid}' class='leaderboard-link'><img class='leaderboard-thumb' src='$thumbnailURL'></a>
	                                           
	                                            
                                              </li>";
                                    }


                                ?>
                                <li class="footer-link"><a href="<?php echo "$link"; ?>"><?php echo "$link_title"; ?></a> | <a href="/game-fish-camera-corner-fishing-giveaway">Rules</a></li>
							</ul>
              <?php echo $after_widget; ?>
        <?php
    }


    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['banner'] = strip_tags($new_instance['banner']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['link'] = strip_tags($new_instance['link']);
		$instance['link_title'] = strip_tags($new_instance['link_title']);
		$instance['message'] = strip_tags($new_instance['message']);
		$instance['count'] = strip_tags($new_instance['count']);
        return $instance;
    }

    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {
		$banner		= esc_attr($instance['banner']);
        $title 		= esc_attr($instance['title']);
        $link		= esc_attr($instance['link']);
        $link_title 		= esc_attr($instance['link_title']);        
        $message	= esc_attr($instance['message']);
        $count		= esc_attr($instance['count']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('banner'); ?>"><?php _e('Banner url:'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('banner'); ?>" name="<?php echo $this->get_field_name('banner'); ?>" type="text" value="<?php echo $banner; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Promo Message'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>" type="text" value="<?php echo $message; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('How many entries to show?'); ?></label>
          <input class="widefat" style="width:10%;" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('link_title'); ?>"><?php _e('Link Title'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('link_title'); ?>" name="<?php echo $this->get_field_name('link_title'); ?>" type="text" value="<?php echo $link_title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link URL'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
        </p>
        <?php
    }


} // end class imo_like_leaderboard_widget
add_action('widgets_init', create_function('', 'return register_widget("imo_like_leaderboard_widget");'));
