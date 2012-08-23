<?php // Custom Questions Widget powered by Gravity Forms

class Questions_List_Widget extends WP_Widget {
	function Questions_List_Widget() {
		$widget_ops = array('classname' => 'widget_list_questions', 'description' => 'Questions List Widget.' );
		$this->WP_Widget('questions list', 'Questions List', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
 
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']); ?>

    <aside id="questions-list-widget" class="box" style="display:none;">
    	<div class="sidebar-header">
			<h2>Latest Questions</h2>
    	</div>
    	<div class="loop">
			<ul>
				<li class="img"><img src="#" /></li>
				<li class="title"><a href="#">The title</a></li>
				<li class="replies">13 Replies</li>
			</ul>
    	</div>
    	<div class="loop">
			<ul>
				<li class="img"><img src="#" /></li>
				<li class="title"><a href="#">The title</a></li>
				<li class="replies">13 Replies</li>
			</ul>
    	</div>
    	<div class="loop">
			<ul>
				<li class="img"><img src="#" /></li>
				<li class="title"><a href="#">The title</a></li>
				<li class="replies">13 Replies</li>
			</ul>
    	</div>
    	<div class="loop">
			<ul>
				<li class="img"><img src="#" /></li>
				<li class="title"><a href="#">The title</a></li>
				<li class="replies">13 Replies</li>
			</ul>
    	</div>
		<div class="footer">
			<a class="ask" href="/community/question">Ask a Question</a>
			<a class="more" href="/community/question">More Questions</a>
		</div>
	</aside>

<?php	}
}
register_widget('Questions_List_Widget');