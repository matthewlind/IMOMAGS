<?php // A widget to promote the G&A Vault Contest post type

class ga_vault_Widget extends WP_Widget {
	function ga_vault_Widget() {
		$widget_ops = array('classname' => 'widget_ga_vault', 'description' => 'Promote a G&A Vault Contest.' );
		$this->WP_Widget('ga_vault', 'G&A Vault', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args);
 
    $contestID = empty($instance['contestID']) ? '' : $instance['contestID']; // Remove '6805', should just be empty quotes ''
    
    if (!empty($contestID)) : ?>
    
    <aside id="ga_vault_promo" class="widget widget_ga_vault">
      <!-- <?php print_r(get_post_custom_keys($contestID)); ?> -->
      
      <div class="banner">
        <h4>G&A Vault Contest</h4>
        <p>Enter your caption for a chance to win!</p>
      </div>
      
      <?php $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($contestID), "medium"); ?>
      <a href="<?php echo get_page_link($contestID); ?>">
        <img src="<?php echo $img_src[0]; ?>" class="wp-post-image" alt="<?php the_title(); ?>" />
      </a>
	    
	    
	    <div class="prize">
        <h6>This Week&rsquo;s Prize:</h6>
        <p><?php echo get_post_meta($contestID, 'product_name', true); ?></p>
	    </div>
	    
	    <a href="<?php echo get_page_link($contestID); ?>" class="button">Enter The Contest <span></span></a>
    <p class="view-all-p"><a href="/ga-vault" class="view-all">View All G&A Vault Contests</a>
	   <div class="sponsor"><?php echo get_imo_dart_tag("240x60",1,false,array("sect"=>"","camp"=>"ga_vault")); ?></div>
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
    
    // Get G&A Vault Contest posts so we can display them in a drop down menu
    $contests = get_posts('post_type=imo_ga_vault'); ?>
    
    <select name="<?php echo $this->get_field_name('contestID'); ?>" id="<?php echo $this->get_field_id('contestID'); ?>">
    	<option value="">-- Select a G&A Vault Contest --</option>
    	<?php foreach ($contests as $contest) : ?>
    	<option value="<?php echo esc_attr($contest->ID); ?>" <?php if ($contestID == $contest->ID) echo "selected"?>><?php echo $contest->post_title; ?></option>
    	<?php endforeach; ?>
    </select>

<?php
	}
}
register_widget('ga_vault_Widget');