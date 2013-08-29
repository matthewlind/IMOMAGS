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
	$defaults = array( 'header' => __('Bowhunter TV', 'example'), 'banner' => __('', 'example'), 'playerID' => __(2625100402001, 'example'), 'playerKey' => __('AQ~~,AAAAAETeEfI~,i-5J2ubuAMu0ls65wqRSCQ-u4W5ZRGuf', 'example'), 'moreURL' => __('', 'example'));
	
	
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Header: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'header' ); ?>"><?php _e('Header:', 'example'); ?></label>
		<input id="<?php echo $this->get_field_id( 'header' ); ?>" name="<?php echo $this->get_field_name( 'header' ); ?>" value="<?php echo $instance['header']; ?>" style="width:80%;" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'banner' ); ?>"><?php _e('banner:', 'example'); ?></label>
		<input id="<?php echo $this->get_field_id( 'banner' ); ?>" name="<?php echo $this->get_field_name( 'banner' ); ?>" value="<?php echo $instance['banner']; ?>" style="width:80%;" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'playerID' ); ?>"><?php _e('playerID:', 'example'); ?></label>
		<input id="<?php echo $this->get_field_id( 'playerID' ); ?>" name="<?php echo $this->get_field_name( 'playerID' ); ?>" value="<?php echo $instance['playerID']; ?>" style="width:80%;" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'playerKey' ); ?>"><?php _e('playerKey:', 'example'); ?></label>
		<input id="<?php echo $this->get_field_id( 'playerKey' ); ?>" name="<?php echo $this->get_field_name( 'playerKey' ); ?>" value="<?php echo $instance['playerKey']; ?>" style="width:80%;" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'moreURL' ); ?>"><?php _e('more url:', 'example'); ?></label>
		<input id="<?php echo $this->get_field_id( 'moreURL' ); ?>" name="<?php echo $this->get_field_name( 'moreURL' ); ?>" value="<?php echo $instance['moreURL']; ?>" style="width:80%;" />
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
		$instance['banner'] = $new_instance['banner'];
		$instance['playerID'] = $new_instance['playerID'];
		$instance['playerKey'] = $new_instance['playerKey'];
		$instance['moreURL'] = $new_instance['moreURL'];
		
		return $instance;
    }

    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget($args, $instance) {
        extract( $args );
	
	$header = $instance['header'];
	$banner = $instance['banner'];
	$playerID = $instance['playerID'];
	$playerKey = $instance['playerKey'];
	$moreURL = $instance['moreURL'];
	
        print $before_widget;
?>
<script>
function popwin(loc,winname,w,h,scroll,resize) {
	var newwin = window.open( loc, winname, "width="+w+",height="+h+",top="+((screen.height - h) / 2)+",left="+((screen.width - w) / 2)+",location=no,scrollbars="+scroll+",menubar=no,toolbar=no,resizable="+resize);
} // function..popwin
</script>

<div class="header-image"><img src="<?php print $banner; ?>" alt="<?php print $header;?>" title="<?php print $header;?>" /></div>
<h3 class="video-title"><?php print $header;?></h3>
<!-- Start of Brightcove Player -->
<div class="bc-player">
	<div style="display:none">
	
	</div>
	
	<!--
	By use of this code snippet, I agree to the Brightcove Publisher T and C 
	found at https://accounts.brightcove.com/en/terms-and-conditions/. 
	-->
	
	<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
	
	<object id="myExperience" class="BrightcoveExperience">
	  <param name="bgcolor" value="#FFFFFF" />
	  <param name="width" value="300" />
	  <param name="height" value="220" />
	  <param name="playerID" value="<?php print $playerID; ?>" />
	  <param name="playerKey" value="<?php print $playerKey; ?>" />
	  <param name="isVid" value="true" />
	  <param name="isUI" value="true" />
	  <param name="dynamicStreaming" value="true" />
	  
	</object>
	
	<!-- 
	This script tag will cause the Brightcove Players defined above it to be created as soon
	as the line is read by the browser. If you wish to have the player instantiated only after
	the rest of the HTML is processed and the page load is complete, remove the line.
	-->
	<script type="text/javascript">brightcove.createExperiences();</script>
</div>
<!-- End of Brightcove Player -->
<p class="more-url"><a href="<?php print $moreURL; ?>">more video and showtimes</a></p>
<div id="locateChannel">
    <div id="channelControlsContainer">
	
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

wp_enqueue_style('channel-widget',plugins_url('styles.css', __FILE__));
add_action("widgets_init", function() {
    return register_widget("imo\IMOSportsmanWidget");
});


