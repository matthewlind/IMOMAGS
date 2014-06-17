<?php

class imo_featured_3_sidebar_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function imo_featured_3_sidebar_widget() {
        parent::WP_Widget(false, $name = 'Featured Posts (Small Thumbnail)');
    }

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        $set_id  = $instance['set_id'];
        $selected_feature = $instance['selected_feature'];

        $feature_title      = apply_filters('widget_title', $instance['feature_title']);

        echo "<H1>$feature_title</H1>";


        $posts = null;

        $posts = get_field($selected_feature,"options");

        //print_r($field);

        foreach($posts as $post) {



            $thumb = getWidgetThumbnail2(unserialize($post->attachment_meta));
            $title = $post->post_title;

            $postID = $post->ID;

            $url = get_permalink($postID);


            $thumb_id = get_post_thumbnail_id($postID);

            $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);

            $thumb = $thumb_url[0];


            if (!empty($post->promo_title))
                $title = $post->promo_title;


              $url = $post->url;
              $outputString .= "<a href='$url' onclick='_gaq.push(['_trackEvent','Special Features Widget','$title','$url']);'><li class='sidebar-featured' style=''>
                                        <div class='feat-post' style=''>
                                            <div class='feat-img' style=''><img  src='$thumb' alt='$title' /></div>
                                            <div class='feat-text'><p>$title</p>
                                        </div>
                                    </li></a>
                                    ";
        }




        $title = stripslashes($setData["name"]);




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

    $instance['set_id'] = strip_tags($new_instance['set_id']);
    $instance['selected_feature'] = strip_tags($new_instance['selected_feature']);
    $instance['feature_title'] = strip_tags($new_instance['feature_title']);
        return $instance;
    }

    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {


        $set_id  = esc_attr($instance['set_id']);
        $selected_feature = esc_attr($instance['selected_feature']);
        $feature_title = esc_attr($instance['feature_title']);


        $fileURL = "http://" . $_SERVER['SERVER_NAME'] . "/wpdb/get-all-sets.php";
        $json = file_get_contents($fileURL);

        $allSetData = json_decode($json);

        $fields = get_field_objects("options");


        //echo $feature_title;
        //echo $fileURL;
        //echo "panther";
        //print_r($allSetData);


        $input = "<input class='widefat' id='{$this->get_field_id('feature_title')}' name='{$this->get_field_name('feature_title')}' value='{$feature_title}''>";
        $select = "<select class='widefat' id='{$this->get_field_id('selected_feature')}' name='{$this->get_field_name('selected_feature')}'>";


        foreach ($fields as $fieldName => $fieldData) {
            if (strpos($fieldName, "featured")) {
                $fieldLabel = $fieldData['label'];

                $selected = "";

                if ($fieldName == $selected_feature)
                    $selected = "selected";

                $select .= "<option $selected value='$fieldName'>$fieldLabel</option>";

            }
        }

        // foreach ($allSetData as $index => $set) {

        //   $selected = "";

        //   if ($index == $set_id)
        //     $selected = "selected";

        //   $select .= "<option $selected value='$index'>$index - {$set->name}</option>";
        // }



        $select .= "</select>";


        ?>

        <p>
          <label for="<?php echo $this->get_field_id('selected_feature'); ?>"><?php _e('Choose a Feature:'); ?></label>

          <?php echo $select; ?>

          <p>Note: Only Custom fields with "feature" in the name will appear on this list.</p>

          <label for="<?php echo $this->get_field_id('feature_title'); ?>"><?php _e('Widget Title:'); ?></label>

          <?php echo $input; ?>

        </p>

        <?php
    }


} // end class example_widget




add_action('widgets_init', create_function('', 'return register_widget("imo_featured_3_sidebar_widget");'));
