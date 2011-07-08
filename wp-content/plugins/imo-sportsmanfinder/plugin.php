<?php
/*
Plugin Name: IMO Sportsman Channel Finder
Plugin URI: http://dev.imomags.com
Description: Creates a sportsman channel finder widget for IMO sites.
Version: 1.0
Author: Jacob Angel
Author URI: http://imomags.com
*/
namespace imo;

/**
 * IMOSportsmanWidget
 *
 * Creates the store wdiget for a page. 
 */
class IMOSportsmanWidget extends \WP_Widget {

    function __construct()
    {
        parent::__construct("store-widget", "Store Widget");
    }

    /**
     * renders administrative form for the widget
     */
    function form($instance) {
        
    }

    /**
     * Updates the contents of the widget.
     * @See WP_Widget:update
     */
    function update($new_instance, $old_instance) {
    }

    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget($args, $instance) {
        extract( $args );
        print $before_widget;
?>
<form>
<input type="text" value="Zipcode" />
<input type="button" class="find-zipcode" value="Find It" />
</form>
<?php
        print $after_widget;
    }
}


add_action("widgets_init", function() {
    return register_widget("imo\IMOSportsmanWidget");
});

