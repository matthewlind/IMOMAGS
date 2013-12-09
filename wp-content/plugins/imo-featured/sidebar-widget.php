<?php

class imo_featured_sidebar_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function imo_featured_sidebar_widget() {
        parent::WP_Widget(false, $name = 'Featured Set Sidebar Widget');
    }

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        $set_id  = $instance['set_id'];



      $setData = get_option("featured_set_{$set_id}");

      $postIDString = $setData['post_id_string'];

      $outputString = "";

      global $wpdb;

        $query = "SELECT
            posts.ID as id,
            posts.post_title as title,
            posts.guid as url,
            posts.post_type as type,
            attachmentmeta.meta_value as attachment_meta,
            posts.guid as url,
            postmeta2.meta_value as promo_title
            FROM {$wpdb->posts} as posts
            JOIN {$wpdb->postmeta} as postmeta ON (posts.ID = postmeta.post_id)
            JOIN {$wpdb->posts} as attachments ON (attachments.ID = postmeta.meta_value)
            JOIN {$wpdb->postmeta} as attachmentmeta ON (attachments.ID = attachmentmeta.post_id)
            LEFT JOIN {$wpdb->postmeta} as postmeta2 ON (posts.ID = postmeta2.post_id AND postmeta2.meta_key = 'promo_title')
            WHERE posts.ID IN ($postIDString)
            AND posts.post_status = 'publish'
            AND postmeta.meta_key = '_thumbnail_id'
            AND attachmentmeta.meta_key = '_wp_attachment_metadata'
            ORDER BY FIELD (posts.ID,$postIDString)";



        $posts = $wpdb->get_results( $query );



        foreach($posts as $post) {

        $thumb = getWidgetThumbnail(unserialize($post->attachment_meta));
          $title = $post->title;

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




        $title = $setData["name"];




        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
							<ul class="sidebar-widget-featured" style="">
								<?php echo $outputString; ?>
							</ul>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;

    $instance['set_id'] = strip_tags($new_instance['set_id']);
        return $instance;
    }

    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {


        $set_id  = esc_attr($instance['set_id']);


        $fileURL = "http://" . $_SERVER['SERVER_NAME'] . "/wpdb/get-all-sets.php";
        $json = file_get_contents($fileURL);

        $allSetData = json_decode($json);

        //echo $fileURL;
        //echo "panther";
        //print_r($allSetData);

        $select = "<select class='widefat' id='{$this->get_field_id('set_id')}' name='{$this->get_field_name('set_id')}'>";

        foreach ($allSetData as $index => $set) {

          $selected = "";

          if ($index == $set_id)
            $selected = "selected";

          $select .= "<option $selected value='$index'>$index - {$set->name}</option>";
        }



        $select .= "</select>";


        ?>

        <p>
          <label for="<?php echo $this->get_field_id('set_id'); ?>"><?php _e('Choose a Set:'); ?></label>

          <?php echo $select; ?>
        </p>
        <?php
    }


} // end class example_widget



        function getWidgetThumbnail($dataArray) {

            $filepath = $dataArray['file'];

            $filepathParts = explode("/",$filepath);

            $filename = $dataArray['sizes']['thumb']['file'];

            $fullPath = "/files/" . $filepathParts[0] . "/" . $filepathParts[1] . "/" . $filename;

            if (empty($filename)) {
                $fullPath = "/files/" . $filepath;
            }

            return $fullPath;
        }

add_action('widgets_init', create_function('', 'return register_widget("imo_featured_sidebar_widget");'));
