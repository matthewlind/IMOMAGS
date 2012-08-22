<?php // Custom Questions Widget powered by Gravity Forms

class Questions_Widget extends WP_Widget {
	function Questions_Widget() {
		$widget_ops = array('classname' => 'widget_questions', 'description' => 'Questions Widget.' );
		$this->WP_Widget('questions', 'Questions', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
?>

    <aside id="questions-widget" class="box question-module widget_questions">
		<div class="questions-slider">
		    <div class="slides-container-f">
		    	<h2>Recent Questions</h2>
		         	<ul id="slides-questions" class="jcarousel-skin-tango questions-feed">
		            	<?php 
		         		for ($i = 1; $i <= 4; $i++) {
		             		echo '<li>';
		             		echo '<div class="quote-area">';
								echo '<div class="top"></div>';
								echo '<div class="mdl">';
									echo '<h4 class="quote">&#8220;Can anyone suggest a good camo bat-suit for hunting in the forest? I am having trouble hunting in the day time.&#8221;</h4>';
								echo '</div>';
								echo '<div class="btm"></div>';
								echo '<div class="pointer"></div>';
								echo '</div>';
							echo '<div class="user-info">';
								echo '<a href="/profile/username"><img class="superclass-gravatar_hash recon-gravatar" alt="user avatar" src="http://www.northamericanwhitetail.fox/wp-content/themes/imo-mags-northamericanwhitetail/img/user-temp.jpg"></a>';
								echo '<a class="username">Batman</a><span> asks...</span>';
							echo '</div>';
							
							echo '<div class="answers-area">';
								echo '<div class="answers-count">';
									echo '<div class="answers">Answers</div><div class="count"><a href="#">18</a></div>';
								echo '</div>';
								echo '<a href="#" class="answers-link">Answer This Question</a>'; 
								echo '<div class="see-all-area"><a href="/community/question" class="see-all home-see-all">See All Questions</a></div>';
							echo '</div>';
						echo '</li>';
						} ?>
		            </ul>
		        </div>    
		    </div>
        </aside>

<?php	}
}
register_widget('Questions_Widget');