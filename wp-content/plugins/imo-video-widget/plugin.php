<?php
/*
Plugin Name: IMO Video Widget
Plugin URI: http://dev.imomags.com
Description: Creates a widget to display BC Videos
Version: 1.0
Author: Aaron Baker
Author URI: http://imomags.com
*/
namespace imo;

/**
 * IMOVideoWidget
 *
 * Creates the store wdiget for a page. 
 */
class IMOVideoWidget extends \WP_Widget {

    function __construct()
    {
        parent::__construct("imo-video-widget", "Video Widget");
    }

    /**
     * renders administrative form for the widget
     */
    function form($instance) {
	/* Set up some default widget settings. */
	$defaults = array( 'videoID' => __('111111122224', 'example'),);
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Video ID: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'videoID' ); ?>"><?php _e('Video ID:', 'example'); ?></label>
		<input id="<?php echo $this->get_field_id( 'videoID' ); ?>" name="<?php echo $this->get_field_name( 'videoID' ); ?>" value="<?php echo $instance['videoID']; ?>" style="width:100%;" />
	</p>

<?php
    }

    /**
     * Updates the contents of the widget.
     * @See WP_Widget:update
     */
    function update($new_instance, $old_instance) {
	
		$instance = $old_instance;


		$instance['videoID'] = $new_instance['videoID'];

		return $instance;
    }

    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget($args, $instance) {
        extract( $args );
	
	$videoID = $instance['videoID'];
	
        print $before_widget;
?>




<!-- Start of Brightcove Player -->

<div style="display:none">
Use for individual episode pages, sponsor pages and other pages requiring a single video. 
</div>

<!--
By use of this code snippet, I agree to the Brightcove Publisher T and C 
found at https://accounts.brightcove.com/en/terms-and-conditions/. 
-->

<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>

<object id="myExperience<?php print $videoID; ?>" class="BrightcoveExperience">
  <param name="bgcolor" value="#FFFFFF" />
  <param name="width" value="620" />
  <param name="height" value="350" />
  <param name="playerID" value="1303927212001" />
  <param name="playerKey" value="AQ~~,AAAA-01d-uE~,FiwRPPEEyN5Ul9VdpuUBJrfHQ9_peuY-" />
  <param name="isVid" value="true" />
  <param name="isUI" value="true" />
  <param name="dynamicStreaming" value="true" />
  
  <param name="@videoPlayer" value="<?php print $videoID; ?>" />
</object>

<!-- 
This script tag will cause the Brightcove Players defined above it to be created as soon
as the line is read by the browser. If you wish to have the player instantiated only after
the rest of the HTML is processed and the page load is complete, remove the line.
-->
<script type="text/javascript">brightcove.createExperiences();</script>

<!-- End of Brightcove Player -->






<?php
        print $after_widget;
    }
}


add_action("widgets_init", function() {
    return register_widget("imo\IMOVideoWidget");
});

