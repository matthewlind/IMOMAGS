<?php
/*
Plugin Name: IMO Store Widget
Plugin URI: http://dev.imomags.com
Description: Creates a store widget for IMO sites.
Version: 1.0
Author: Jacob Angel
Author URI: http://imomags.com
*/
namespace imo;

/**
 * IMOStoreWidget
 *
 * Creates the store wdiget for a page. 
 */
class IMOStoreWidget extends \WP_Widget {

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
<div style="" id="imoprodgallery">
</div>
<script src="http://shop.intermediaoutdoors.com/pg1/imoprodgallery.js" type="text/javascript"></script>
<?php
        print $after_widget;
    }
}


add_action("widgets_init", function() {
    return register_widget("imo\IMOStoreWidget");
});

