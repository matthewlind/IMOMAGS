<?php // A widget to promote the Caption Contest post type

class Caption_Contest_Widget extends WP_Widget {
	function Caption_Contest_Widget() {
		$widget_ops = array('classname' => 'widget_caption_contest', 'description' => 'Promote a Caption Contest.' );
		$this->WP_Widget('caption_contest', 'Caption Contest', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args);
 
    $contestID = empty($instance['contestID']) ? '' : $instance['contestID']; // Remove '6805', should just be empty quotes ''
    
    if (!empty($contestID)) : ?>
    
    <aside id="caption_contest_promo" class="widget_caption_contest">
      <!-- <?php print_r(get_post_custom_keys($contestID)); ?> -->
      
      <div class="banner">
        <h4>Caption Contest</h4>
        <p>Enter your caption for a chance to win!</p>
      </div>
      
      <?php $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($contestID), "medium"); ?>
      <a href="<?php echo get_permalink($contestID); ?>">
        <img src="<?php echo $img_src[0]; ?>" class="wp-post-image" alt="<?php the_title(); ?>" />
      </a>
	    
	    
	    <div class="prize">
        <h6>This Week&rsquo;s Prize:</h6>
        <p><?php echo get_post_meta($contestID, 'product_name', true); ?></p>
	    </div>
	    
	    <a href="<?php echo get_permalink($contestID); ?>" class="button">Enter The Contest <span></span></a>
      <p class="view-all-p"><a href="/caption-contest" class="view-all">View All Caption Contests</a>
    </p>
    </aside>
    
    <?php endif;
  
  }
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['contestID'] = $new_instance['contestID'];
		return $instance;
	}
 
	function form($instance) {
    $instance = wp_parse_args((array) $instance, array('contestID' => ''));
    
    $contestID = $instance['contestID'];
    
    // Get Caption Contest posts so we can display them in a drop down menu
    $contests = get_posts('post_type=imo_caption_contest'); ?>
    
    <select name="<?php echo $this->get_field_name('contestID'); ?>" id="<?php echo $this->get_field_id('contestID'); ?>">
    	<option value="">-- Select a Caption Contest --</option>
    	<?php foreach ($contests as $contest) : ?>
    	<option value="<?php echo esc_attr($contest->ID); ?>" <?php if ($contestID == $contest->ID) echo "selected"?>><?php echo $contest->post_title; ?></option>
    	<?php endforeach; ?>
    </select>

<?php
	}
}
register_widget('Caption_Contest_Widget');