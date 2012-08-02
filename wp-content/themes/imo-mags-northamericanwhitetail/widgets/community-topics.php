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
    	<ul class="community-cats">
				<li id="rut" class="title"><div></div><h2><a href="/report/">Rut Reports</a></h2></li>
				<!--<li class="new-post post selected points report">+ POST</li>-->
			</ul>
			
			<ul class="community-cats">
				<li id="tips-tactics" class="title"><div></div><h2><a href="/tip/">Tips & Tactics</a></h2></li>
				<!--<li class="new-post post selected points tip">+ POST</li>-->
			</ul>
			
			<ul class="community-cats">
				<li id="lifestyle" class="title"><div></div><h2><a href="/lifestyle/">Lifestyle</a></h2></li>
				<!--<li class="new-post post selected points lifestyle">+ POST</li>-->
			</ul>
			
			<ul class="community-cats">
				<li id="tbucks" class="title"><div></div><h2><a href="/trophy/">Trophy Bucks</a></h2></li>
				<!--<li class="new-post post selected points trophy">+ POST</li>-->
			</ul>
			
			<!-- <ul class="community-cats">
				<li id="gear" class="title"><div></div><h2><a href="/gear/">Gear</a></h2></li>
				<li class="new-post post selected points">+ POST</li>
			</ul> -->
			
			<ul class="community-cats">
				<li id="general" class="title"><div></div><h2><a href="/general/"">General Discussion</a></h2></li>
				<!--<li class="new-post post selected points general">+ POST</li>-->
			</ul>
			
			<ul class="community-cats">
				<li id="experts" class="title"><div></div><h2><a href="/question/">Ask The Experts</a></h2></li>
				<!--<li class="new-post post selected points question">+ POST</li>-->
			</ul>
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