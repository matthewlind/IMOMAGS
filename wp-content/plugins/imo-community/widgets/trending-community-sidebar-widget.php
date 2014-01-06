<?php

class trending_community_sidebar_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function trending_community_sidebar_widget() {
        parent::WP_Widget(false, $name = 'Trending Community');
    }


//array('description'=>'Shows an even number of side-by-side post thumbnails in the sidebar.')


    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        $num_of_posts = $instance['num_of_posts'];

        $title = "Trending Community Posts";

        $json = file_get_contents("http://www.northamericanwhitetail.deva/community-api/posts?skip=0&per_page=5&order_by=score_week&sort=DESC&post_type=all&require_images=1");

        $posts = json_decode($json);

        $outputString = "";



        foreach($posts as $post) {

        //$thumb = getWidgetThumbnailThumb(unserialize($post->attachment_meta));
          $title = $post->title;

        if (!empty($post->promo_title))
            $title = $post->promo_title;

          $url = $post->url;

          $comment_count = $post->comment_count;

          $thumb = $post->img_url;
          $outputString .= "<a href='$url' onclick='_gaq.push(['_trackEvent','Trending Community Widget','$title','$url']);'><li class='sidebar-featured' style=''>
                                    <div class='feat-post' style=''>
                                        <div class='feat-img' style=''><img style='height:90px;width:90px;' src='$thumb' alt='$title' /></div>
                                        <div class='feat-text'><p>$title</p><p>$comment_count Comments</p></div>

                                </li></a>
                                ";
        }




        $title = stripslashes($setData["name"]);

        $title = "Trending Community Posts";


        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
							<ul class="sidebar-widget-featured-thumbs" style="">
								<?php echo $outputString; ?>
							</ul>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;

    $instance['num_of_posts'] = strip_tags($new_instance['num_of_posts']);
        return $instance;
    }

    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {

        $defaults = array("num_of_posts" => 5);
        $instance = wp_parse_args( (array) $instance, $defaults );

        $num_of_posts  = esc_attr($instance['num_of_posts']);

        $input = "<input type='text' value='$num_of_posts'>";

        ?>

        <p>
          <label for="<?php echo $this->get_field_id('set_id'); ?>"><?php _e('Choose number of posts:'); ?></label>

          <?php echo $input; ?>
        </p>
        <?php
    }


} // end class example_widget




add_action('widgets_init', create_function('', 'return register_widget("trending_community_sidebar_widget");'));
