<?php // Custom Signup Form Widget powered by Gravity Forms

class Signup_Widget extends WP_Widget {
	function Signup_Widget() {
		$widget_ops = array('classname' => 'widget_gravity_form', 'description' => 'Add a Gravity Form email signup form.' );
		$this->WP_Widget('newsletter_signup', 'Newsletter Signup', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); 
    
	$formID = get_option('newsletter_id');
	
	$url = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; 
	//string urlencode ( string $url );
	//$url.str_replace("errorcode=4&errorcontrol=Email%20Address", "", $url);
    $errorcode = isset($_GET["errorcode"])? $_GET["errorcode"]:"";
    $errorcontrol = isset($_GET["errorControl"])? $_GET["errorControl"]:"" ;

    switch($errorcode) {

        case "1" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
        case "2" : $strError = "The list provided does not exist."; break;
        case "3" : $strError = "Information was not provided for a mandatory field. (".$errorcontrol.")"; break;
        case "4" : $strError = "Please provide a valid email address.".$errorcontrol; break;
        case "5" : $strError = "Information provided is not unique. (".$errorcontrol.")"; break;
        case "6" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
        case "7" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
        case "8" : $strError = "Subscriber already exists."; break;
        case "9" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
        case "10" : $strError = "An error has occurred while attempting to save your subscriber information."; break;
          //case "11" : This error does not exist.
        case "12" : $strError = "The subscriber you are attempting to insert is on the master unsubscribe list or the global unsubscribe list."; break;
        default : $strError = "Other"; break;
          //case "13" : Check that the list ID and/or MID specified in your code is correct.
	}
?>
		
<div id="newsletter-signup" class="widget newsletter-sidebar">	
	<form action="http://cl.exct.net/subscribe.aspx?lid=<?php echo $formID; ?>" name="subscribeForm" method="post">
		<input type="hidden" name="thx" value="<?php echo $url; ?>#subscribe-success" />
		<input type="hidden" name="err" value="<?php echo $url; ?>" />
		<input type="hidden" name="MID" value="6283180" />
        <div class="signup-box jq-custom-form">
	        <fieldset>
	             <?php if(!empty($title)) : ?>
				 	<h3><?php echo $title; ?></h3>
				 <?php endif; ?>
	            <div class="signup-mdl">
	                <p class="intro-text">Sign up to receive the latest updates from <?php echo SITE_NAME; ?></p>
	                <div class="f-row">
						<input alt="Email Address" type="text" name="Email Address" size="25" maxlength="100" value="" placeholder="Enter Your Email..." >
	                </div>
	                <!--<div class="f-row check-row">
	                    <input alt="Third Party" type="checkbox" checked="checked" value="22697" name="interests" id="receive" />
	                    <input type="hidden" name="OptoutInfo" value="">
	                    <label for="receive">Yes, I'd like to receive offers from your partners</label>
	                </div>-->
	             </div>
	                <div class="signup-btn-row">
	                    <span class="btn-base"><input type="submit" value="Sign Up" /></span>
	                </div>
					<input type="radio" name="SubAction" value="sub_add_update" checked="checked" style="display:none;" />

			</fieldset>
	    
		</div>
	</form>
</div>

<?php	}
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
 
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array('title' => ''));
		$title = strip_tags($instance['title']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
	}
}
register_widget('Signup_Widget');