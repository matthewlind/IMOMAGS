<?php // Custom Community Topics Widget



class community_topics_Widget extends WP_Widget {
	function community_topics_Widget() {
		$widget_ops = array('classname' => 'widget_community_topics', 'description' => 'Community Topics Widget.' );
		$this->WP_Widget('community_topics', 'Community Topics', $widget_ops);
	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		
		
		
		$hostname = $_SERVER['SERVER_NAME'];


//Get Post Count Data
$requestURL = "http://$hostname/slim/api/superpost/count/general";

$file = file_get_contents($requestURL);
$generalCount = json_decode($file);
$generalCount = $generalCount[0];

$requestURL2 = "http://$hostname/slim/api/superpost/count/report";

$file2 = file_get_contents($requestURL2);
$reportCount = json_decode($file2);
$reportCount = $reportCount[0];

$requestURL3 = "http://$hostname/slim/api/superpost/count/question";

$file3 = file_get_contents($requestURL3);
$questionCount = json_decode($file3);
$questionCount = $questionCount[0];

$requestURL4 = "http://$hostname/slim/api/superpost/count/trophy";

$file4 = file_get_contents($requestURL4);
$trophyCount = json_decode($file4);
$trophyCount = $trophyCount[0];

$requestURL5 = "http://$hostname/slim/api/superpost/count/tip";

$file5 = file_get_contents($requestURL5);
$tipCount = json_decode($file5);
$tipCount = $tipCount[0];

$requestURL6 = "http://$hostname/slim/api/superpost/count/lifestyle";

$file6 = file_get_contents($requestURL6);
$lifestyleCount = json_decode($file6);
$lifestyleCount = $lifestyleCount[0];

$requestURL7 = "http://$hostname/slim/api/superpost/count/gear";

$file7 = file_get_contents($requestURL7);
$gearCount = json_decode($file7);
$gearCount = $gearCount[0];






?>

    <aside id="community-topics" class="community-topics-widget">
     	<div class="sidebar-header">
		    <h2>Browse the Community</h2>
		</div>

	        <ul>
				<li id="rut" class="title"><h2><a href="/community/report/">State Rut Reports</a></h2><span class="points"><?php echo $reportCount->post_count.' Posts'; ?></li>
				<li id="experts" class="title"><h2><a href="/community/question/">Q&A</a></h2><span class="points"><?php echo $questionCount->post_count.' Posts'; ?></li>	
				<li id="tips-tactics" class="title"><h2><a href="/community/tip/">Tips & Tactics</a></h2><span class="points"><?php echo $tipCount->post_count.' Posts'; ?></li>
				<li id="general" class="title"><h2><a href="/community/general/">General Discussion</a></h2><span class="points"><?php echo $generalCount->post_count.' Posts'; ?></li>
				<!--<li id="" class="title"><h2><a href="/community/contest/">Contest</a></h2><span class="points"><?php echo $contestCount->post_count.' Posts'; ?></li>-->
			</ul>	          
	   </aside>

<?php	}
 
}
register_widget('community_topics_Widget');