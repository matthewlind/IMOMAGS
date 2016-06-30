<?php
/**
 * Subscribe.php
 * Contains class files for the subscribe widget.
 */

namespace imo;

/**
 * SubscribeHeaderWidget
 *
 * Creates he little block at the top of the page.
 */
class SubscribeHeaderWidget extends \WP_Widget {

    function __construct()
    {
        parent::__construct("subscribe-header", "Subscribe Header");
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
        include('subscribeHeader.tpl.php');
        print $after_widget;
    }
}

class SubscribeWidget extends \WP_Widget {

    function __construct()
    {
        parent::__construct("subscribe-form", "Subscription Form");
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
        include('subscribeForm.tpl.php');
        print $after_widget;
    }
}

add_action("widgets_init", function() {
    return register_widget("imo\SubscribeWidget");
});

add_action("widgets_init", function() {
    return register_widget("imo\SubscribeHeaderWidget");
});
