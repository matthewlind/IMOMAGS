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
         <select id="dynamic_select" class="post_type" name="post_type">
         	<option value="" selected>Choose a Topic</option>        
         	<option value="/general">General Discussion</option>
            <option value="/question">Q&A</option>
            <option value="/report">Rut Reports</option>
            <option value="/tip"">Tips & Tactics</option>
            <option value="/lifestyle">Lifestyle</option>
            <option value="/trophy">Trophy Bucks</option>
            <!--<option value="/gear" class="gear">Gear</option>-->
          </select>
        </div>
        <div class="buttons">
	     	<a href="#" class="ask-question post new-post question">Ask a Question</a>
	     	<a href="#" class="share-photo post new-post general">Share a Photo</a>        
        </div>
        </aside>

<?php	}
 
}
register_widget('community_topics_Widget');