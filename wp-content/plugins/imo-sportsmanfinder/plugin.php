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
        parent::__construct("channel-widget", "Channel Widget");
    }

    /**
     * renders administrative form for the widget
     */
    function form($instance) {
	/* Set up some default widget settings. */
	$defaults = array( 'header' => __('Guns & Ammo TV is Available on', 'example'),);
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Header: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'header' ); ?>"><?php _e('Header:', 'example'); ?></label>
		<input id="<?php echo $this->get_field_id( 'header' ); ?>" name="<?php echo $this->get_field_name( 'header' ); ?>" value="<?php echo $instance['header']; ?>" style="width:100%;" />
	</p>

<?php
    }

    /**
     * Updates the contents of the widget.
     * @See WP_Widget:update
     */
    function update($new_instance, $old_instance) {
	
		$instance = $old_instance;


		$instance['header'] = $new_instance['header'];

		return $instance;
    }

    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget($args, $instance) {
        extract( $args );
	
	$header = $instance['header'];
	
        print $before_widget;
?>
<script>
function popwin(loc,winname,w,h,scroll,resize) {
	var newwin = window.open( loc, winname, "width="+w+",height="+h+",top="+((screen.height - h) / 2)+",left="+((screen.width - w) / 2)+",location=no,scrollbars="+scroll+",menubar=no,toolbar=no,resizable="+resize);
} // function..popwin
</script>
<div id="locateChannel">
    <div id="channelControlsContainer">
	<h3><?php print $header;?></h3>
	<div id="channelControls">
	    <input type="text" name="zip" id="zip" onfocus="if(this.value == this.defaultValue) this.value = '';" value="Enter Your ZIP" class="searchbox" />
	    <a href="#" onclick="javascript:popwin('http://thesportsmanchannel.viewerlink.tv/?zip='+document.getElementById('zip').value,'indicator',615,550,'yes','yes');"><input type="submit" value="GO!" class="button" /></a>
	</div>
    </div>
</div>

<?php
        print $after_widget;
    }
}


add_action("widgets_init", function() {
    return register_widget("imo\IMOSportsmanWidget");
});

