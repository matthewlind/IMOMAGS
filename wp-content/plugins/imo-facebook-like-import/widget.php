<?php

class imo_like_leaderboard_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function imo_like_leaderboard_widget() {
        parent::WP_Widget(false, $name = 'FB Likes Leaderboard');
    }

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        $title 		= apply_filters('widget_title', $instance['title']);
        $message 	= $instance['message'];
        ?>
              <?php echo $before_widget; ?>

                            <h2><?php echo "$title"; ?></h2>
                            <h3><?php echo "$message"; ?></h3>
							<ul class="leaderboard-list">
                                <?php

                                    global $wpdb;

                                    $sql = "SELECT *,CONVERT(likes.meta_value, UNSIGNED INTEGER) as like_count FROM wp_14_posts as posts
                                            JOIN wp_14_postmeta AS likes ON (posts.ID = likes.post_id AND likes.meta_key = 'facebook_like_count')
                                            WHERE post_type = 'reader_photos'
                                            ORDER BY like_count DESC LIMIT 5";

                                    $posts = $wpdb->get_results($sql);

                                    foreach ($posts as $post) {


                                        $thumb_id = get_post_thumbnail_id($post->ID);
                                        $thumb_url = wp_get_attachment_image_src($thumb_id,"imo-mini-slider-thumb");
                                        $thumbnailURL = $thumb_url[0];

                                        echo "<li>

                                                        <a href='{$post->guid}' class='leaderboard-link'><img class='leaderboard-thumb' src='$thumbnailURL'><span class='entry-title'>{$post->post_title}</span></a>
                                                        <span class='like-count'>{$post->like_count}</span> <img src='/wp-content/plugins/imo-facebook-like-import/like@2x.png' class='like-icon'>





                                              </li>";

                                    }


                                ?>

                                <li><a href="">Top 25</a></li>
							</ul>
              <?php echo $after_widget; ?>
        <?php
    }


    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['message'] = strip_tags($new_instance['message']);
        return $instance;
    }

    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {

        $title 		= esc_attr($instance['title']);
        $message	= esc_attr($instance['message']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Promo Message'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>" type="text" value="<?php echo $message; ?>" />
        </p>
        <?php
    }


} // end class imo_like_leaderboard_widget
add_action('widgets_init', create_function('', 'return register_widget("imo_like_leaderboard_widget");'));
