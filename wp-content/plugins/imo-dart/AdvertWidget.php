<?php
/**
 * AdvertWidget
 *
 * Dynamically include a modifiable advert.
 * Set the size in the widget.
 */
namespace imo;
class AdvertWidget extends \WP_Widget {
    public $intervals = array(
        45, 60, 75, 90, 105, 120, 135, 150, 165, 180
    );
    public $sizes = array(
        "Box Ad" => "300x250", "Skyscraper" => "160x600", "Leaderboard" => "728x90",
        "Rectangle" => "180x150", "Wide Skyscraper" => "300x600", "Button2" => "120x60",
    );

    function __construct()
    {
        parent::__construct("advert-widget", "Advertisement");
    }


    /**
     * Updates the contents of the widget.
     * @See WP_Widget:update
     */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['size'] = $new_instance['size'];
        $instance['iframe'] = $new_instance['iframe'];
        $instance['refresh'] = $new_instance['refresh'];
        return $instance;
    }

    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget($args, $instance) {
        extract( $args );
        print $before_widget;
        print imo_dart_tag($instance['size'], $instance['iframe']=="iframe", array("refresh"=>$instance['refresh']));
        print $after_widget;
    }


    /**
     * renders administrative form for the widget
     */
    function form($instance) {
?>
    <p><label for="ad-size"><strong>Size</strong></label>
    <select name="<?php echo $this->get_field_name('size'); ?>">
<?php 
        foreach($this->sizes as $key=>$size) {
            if ($size == $instance['size']) {
                print "<option value='$size' selected='selected' default>";
            }
            else {
                print "<option value='$size'>";
            }
            print "$key ($size)</option>";
        }
?>
</select>
</p>
<p>
<label><input type="radio" name="<?php echo $this->get_field_name('iframe'); ?>" value="normal" <?php if($instance['iframe']!=="iframe") print "checked='true'"; ?> /> Standard Ad</label><br />
<label><input type="radio" name="<?php echo $this->get_field_name('iframe'); ?>" value="iframe" <?php if($instance['iframe']=="iframe") print "checked='true'"; ?> /> Ride-Share Ad</label>
</p> 
<p>
<label><strong>Refresh Rate</strong></label>

    <select name="<?php echo $this->get_field_name('refresh'); ?>">
 <?php 
        foreach($this->intervals as $key=>$time) {
            if ($time == $instance['refresh']) {
                print "<option value='$time' selected='selected' default>";
            }
            else {
                print "<option value='$time'>";
            }
            print "$time seconds</option>";
        }
?>
    </select>
</p>
<?php
    }
}

add_action("widgets_init", function() {
    return register_widget("imo\AdvertWidget");
});

