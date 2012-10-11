<?php // A widget to promote the Score This Buck Contest post type

class Buck_Contest_Widget extends WP_Widget {
	function Buck_Contest_Widget() {
		$widget_ops = array('classname' => 'widget_buck_contest', 'description' => 'Score This Buck Contest.' );
		$this->WP_Widget('buck_contest', 'Buck Contest', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args);
 
    $contestID = empty($instance['contestID']) ? '' : $instance['contestID']; // Remove '6805', should just be empty quotes ''
    
    if (!empty($contestID)) : ?>
    
    <aside id="buck_contest_promo" class="widget_buck_contest">
      <!-- <?php print_r(get_post_custom_keys($contestID)); ?> -->
      
      <div class="banner">
        <h4>Score This Buck</h4>
        <p>Score This Buck for a chance to win!</p>
      </div>
      
      <?php $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($contestID), "medium"); ?>
      <div class="contest-img">
      	<a href="<?php echo get_page_link($contestID); ?>"><img src="<?php echo $img_src[0]; ?>" class="wp-post-image" alt="<?php the_title(); ?>" /></a>
      </div>
	    
	    
	  <div class="prize">
        <h6>This Week&rsquo;s Prize:</h6>
        <p><?php echo get_post_meta($contestID, 'product_name', true); ?></p>
	  </div>
	    
	  <a href="<?php echo get_page_link($contestID); ?>" class="button">Enter The Contest <span></span></a>
      <p class="view-all-p"><a href="/score-this-buck-contest" class="view-all">View All Score This Buck Contests</a></p>
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
    
    // Get Buck Contest posts so we can display them in a drop down menu
    $contests = get_posts('post_type=imo_buck_contest'); ?>
    
    <select name="<?php echo $this->get_field_name('contestID'); ?>" id="<?php echo $this->get_field_id('contestID'); ?>">
    	<option value="">-- Select a Contest --</option>
    	<?php foreach ($contests as $contest) : ?>
    	<option value="<?php echo esc_attr($contest->ID); ?>" <?php if ($contestID == $contest->ID) echo "selected"?>><?php echo $contest->post_title; ?></option>
    	<?php endforeach; ?>
    </select>

<?php
	}
}
register_widget('Buck_Contest_Widget');