<?php // Custom Signup Form Widget powered by Gravity Forms

class Signup_Widget extends WP_Widget {
	function Signup_Widget() {
		$widget_ops = array('classname' => 'widget_gravity_form', 'description' => 'Add a Gravity Form email signup form.' );
		$this->WP_Widget('newsletter_signup', 'Newsletter Signup', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); ?>

   <div class="signup-box jq-custom-form">
    <form action="#">
        <fieldset>
             <?php if(!empty($title)) : ?>
			 	<h3><?php echo $title; ?></h3>
			 <?php endif; ?>
            <div class="signup-mdl">
                <p class="intro-text">Sign up to receive the latest updates from In-Fisherman</p>
                <div class="f-row">
                    <?php if (function_exists('gravity_form')) gravity_form(12, false, false, false, '', true, 200); ?>
                </div>
                <!--<div class="f-row check-row">
                    <input type="checkbox" id="receive" />
                    <label for="receive">Yes, I'd like to receive offers from your partners</label>
                </div>-->
            </div>
		</fieldset>
    </form>
</div>
<script type="text/javascript">
	jQuery(document).ready(function () {

		if(jQuery(".gform_footer").length){
		    jQuery(".gform_footer").addClass("btn-base");
	    }
    });	
	
	
</script>
        
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