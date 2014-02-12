<?php

class imo_geolocation_sidebar_widget extends WP_Widget {


    /** constructor -- name this the same as the class above */
    function imo_geolocation_sidebar_widget() {
        parent::WP_Widget(false, $name = 'Geolocation Sidebar Widget');
    }

    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {
        extract( $args );
        //$set_id  = $instance['set_id'];




        global $IMO_USER_STATE;
        global $IMO_USER_STATE_NICENAME;

        if (!empty($IMO_USER_STATE)) {


            $outputString = "";

            $domain = $_SERVER['HTTP_HOST'];
            $url = "http://$domain/wpdb/network-feed-cached.php?state=$IMO_USER_STATE&count=2&domain=www.gameandfishmag.com";

            $postSetID = get_option( $IMO_USER_STATE . "_state_post_set",false);



            if ($postSetID) {

                $url = "http://$domain/wpdb/get-post-set.php?setID=$postSetID";
                $postJSON = file_get_contents($url);

                $postSet = json_decode($postJSON);
                $posts = $postSet->posts;
            } else {
                $url = "http://$domain/wpdb/network-feed-cached.php?state=$IMO_USER_STATE&count=2&domain=www.gameandfishmag.com";
                $postJSON = file_get_contents($url);

                $posts = json_decode($postJSON);
            }




            foreach($posts as $post) {


            $title = $post->post_title;
            $thumb = $post->img_url;
            $url = $post->post_url;

            $outputString .= "<a href='$url' onclick='_gaq.push(['_trackEvent','Special Features Widget','$title','$url']);'><li class='sidebar-featured' style=''>
                                        <div class='feat-post' style=''>
                                            <div class='feat-img' style=''><img  src='$thumb' alt='$title' /></div>
                                            <div class='feat-text'><p>$title</p>
                                        </div>
                                    </li></a>
                                    ";
            }




            $title = "$IMO_USER_STATE_NICENAME: The Latest";




            ?>
                  <?php echo $before_widget; ?>
                      <?php if ( $title )
                            echo $before_title . $title . $after_title; ?>
                                <a href="#" class="not-your-state" >Not Your State?</a>

                                <div class="choose-your-state" style="display:none;">


                                    <select>
                                        <option value="">Select Your State</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District Of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                </div>

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




add_action('widgets_init', create_function('', 'return register_widget("imo_geolocation_sidebar_widget");'));
