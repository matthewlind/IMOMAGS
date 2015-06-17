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
		$instance = wp_parse_args((array) $instance, array('title' => ''));
		$title = strip_tags($instance['title']);
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
		<?php
	}
    /**
     * Updates the contents of the widget.
     * @See WP_Widget:update
     */
    function update($new_instance, $old_instance) {
    	$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;

    }
    
    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget($args, $instance) {
        extract( $args );
        print $before_widget;
        
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        
?>
<h3 class="widget-title">
	<?php if(!empty($title)) { ?>
		<span><?php echo $title; ?></span>
	<?php } ?>
</h3>
<div style="" id="imoprodgallery">
</div>
<!---->
<?php/* if(is_category("tv") || in_category("tv") || is_page_template( "show-page.php" )) */ 
<?php if ($tv_page){ ?>
	<script src="http://store.intermediaoutdoors.com/pg/prodgallery148.js" type="text/javascript"></script>
<?php }else{ ?>
	<script src="http://shop.intermediaoutdoors.com/pg1/imoprodgallery.js" type="text/javascript"></script>
<?php } ?>

<?php
        print $after_widget;
    }
}


add_action("widgets_init", function() {
    return register_widget("imo\IMOStoreWidget");
});

