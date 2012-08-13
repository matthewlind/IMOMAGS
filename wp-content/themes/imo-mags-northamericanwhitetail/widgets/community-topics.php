<?php // Custom Community Topics Widget

class community_topics_Widget extends WP_Widget {
	function community_topics_Widget() {
		$widget_ops = array('classname' => 'widget_community_topics', 'description' => 'Community Topics Widget.' );
		$this->WP_Widget('community_topics', 'Community Topics', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
?>

    <aside id="community-topics" class="community-topics-widget">
     	<div class="sidebar-header">
		    <h2>Browse the Community</h2>
		</div>
		 <div class="post_type_styled_select">
         <select class="post_type" name="post_type">
            <option value="general" class="general">General Discussion</option>
            <option value="question" class="question">Q&A</option>
            <option value="report" class="report">Rut Reports</option>
            <option value="tip" class="tip">Tips & Tactics</option>
            <option value="lifestyle" class="lifestyle">Lifestyle</option>
            <option value="trophy" class="trophy">Trophy Bucks</option>
            <!--<option value="gear" class="gear">Gear</option>-->
          </select>
        </div>
        <div class="buttons">
	     	<a href="#" class="ask-question">Ask a Question</a>
	     	<a href="#" class="share-photo">Share a Photo</a>        
        </div>
        </aside>

<?php	}
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
 
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array('title' => ''));
		$title = strip_tags($instance['title']);
	}
}
register_widget('community_topics_Widget');