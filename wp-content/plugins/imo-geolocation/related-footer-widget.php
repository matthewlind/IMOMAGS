<?php

class imo_related_footer_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function imo_related_footer_widget() {
        parent::WP_Widget(false, $name = 'Related Footer Widget');
    }

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        //$set_id  = $instance['set_id'];


        $postCategories = get_the_category();

        $postID = get_the_ID();


        $primaryCategoryID = get_post_meta($postID,"_category_permalink",TRUE);

        $primaryCategoryObject = get_category($primaryCategoryID);


        $primaryCategorySlug = $primaryCategoryObject->slug;

        $stateSlugToAbbv = array("alabama"=>"AL",
"alaska"=>"AK","arizona"=>"AZ","arkansas"=>"AR","california"=>"CA","colorado"=>"CO","connecticut"=>"CT","delaware"=>"DE","district-of-columbia"=>"DC","florida"=>"FL","georgia"=>"GA","hawaii"=>"HI","idaho"=>"ID","illinois"=>"IL","indiana"=>"IN","iowa"=>"IA","kansas"=>"KS","kentucky"=>"KY","louisiana"=>"LA","maine"=>"ME","maryland"=>"MD","massachusetts"=>"MA","michigan"=>"MI","minnesota"=>"MN","mississippi"=>"MS","missouri"=>"MO","montana"=>"MT","nebraska"=>"NE","nevada"=>"NV","new-hampshire"=>"NH","new-jersey"=>"NJ","new-mexico"=>"NM","new-york"=>"NY","north-carolina"=>"NC","north-dakota"=>"ND","ohio"=>"OH","oklahoma"=>"OK","oregon"=>"OR","pennsylvania"=>"PA","rhode-island"=>"RI","south-carolina"=>"SC","south-dakota"=>"SD","tennessee"=>"TN","texas"=>"TX","utah"=>"UT","vermont"=>"VT","virginia"=>"VA","washington"=>"WA","west-virginia"=>"WV","wisconsin"=>"WI","wyoming"=>"WY","alberta"=>"AB","british-columbia"=>"BC","manitoba"=>"MB","new-brunswick"=>"NB","newfoundland-and-labrador"=>"NL","northwest-territories"=>"NT","nova-scotia"=>"NS","nunavut"=>"NU","ontario"=>"ON","prince-edward-island"=>"PE","quebec"=>"QC","saskatchewan"=>"SK","yukon"=>"YT");




        $firstChoiceCategory = "";
        $firstChoiceCount = 0;
        $firstChoiceCategorySlug = "";
        $firstChoiceCategoryKey = "";

        $secondChoiceCategory = "";
        $secondChoiceCount = 0;
        $secondChoiceCategorySlug = "";

        foreach ($postCategories as $key => $category) {
            $slug = $category->slug;

            if ($stateSlugToAbbv[$slug]) {
                unset($postCategories[$key]);
            }
        }

        foreach ($postCategories as $key => $category) {
            if ($category->count > $firstChoiceCount) {
                $firstChoiceCount = $category->count;
                $firstChoiceCategory = $category;
                $firstChoiceCategoryKey = $key;
            }
        }

        unset($postCategories[$firstChoiceCategoryKey]);

        foreach ($postCategories as $key => $category) {
            if ($category->count > $secondChoiceCount) {
                $secondChoiceCount = $category->count;
                $secondChoiceCategory = $category;
                $secondChoiceCategoryKey = $key;
            }
        }

        $firstChoiceCategorySlug = $firstChoiceCategory->slug;
        $secondChoiceCategorySlug = $secondChoiceCategory->slug;

        global $IMO_USER_STATE;
        global $IMO_USER_STATE_NICENAME;

        if (!empty($IMO_USER_STATE)) {


            $outputString = "";

            $domain = $_SERVER['HTTP_HOST'];
            $url = "http://$domain/wpdb/network-feed-cached.php?state=$IMO_USER_STATE&count=4&domain=www.gameandfishmag.com&post_set_merge=14-5&thumbnail_size=index-thumb&term=$primaryCategorySlug";
            $postJSON = file_get_contents($url);
            $posts = json_decode($postJSON);



            if (count($posts) < 6) {
                $url = "http://$domain/wpdb/network-feed-cached.php?state=$IMO_USER_STATE&count=4&domain=www.gameandfishmag.com&post_set_merge=14-5&thumbnail_size=index-thumb&term=$secondChoiceCategorySlug";
                $postJSON = file_get_contents($url);
                $posts = json_decode($postJSON);


            } elseif (count($posts) < 6) {
                $url = "http://$domain/wpdb/network-feed-cached.php?state=$IMO_USER_STATE&count=4&domain=www.gameandfishmag.com&post_set_merge=14-5&thumbnail_size=index-thumb&term=$firstChoiceCategorySlug";
                $postJSON = file_get_contents($url);
                $posts = json_decode($postJSON);


            } else if (count($posts) < 6) {
                $url = "http://$domain/wpdb/network-feed-cached.php?state=$IMO_USER_STATE&count=4&domain=www.gameandfishmag.com&thumbnail_size=index-thumb&post_set_merge=14-5";
                $postJSON = file_get_contents($url);
                $posts = json_decode($postJSON);


            }

            foreach($posts as $post) {


            $title = $post->post_title;
            $thumb = $post->img_url;
            $url = $post->post_url;

            $outputString .= "<a href='$url' onclick='_gaq.push(['_trackEvent','Special Features Widget','$title','$url']);'><li class='footer-featured' style=''>
                                        <div class='feat-post' style=''>
                                            <div class='feat-img' style=''><img  src='$thumb' alt='$title' /></div>
                                            <div class='footer-feat-text'>$title
                                        </div>
                                    </li></a>
                                    ";
            }




            $title = "You'll Like This:";




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






    }

    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;

    $instance['set_id'] = strip_tags($new_instance['set_id']);
        return $instance;
    }

    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {


        //$set_id  = esc_attr($instance['set_id']);

    }


} // end class example_widget




add_action('widgets_init', create_function('', 'return register_widget("imo_related_footer_widget");'));
