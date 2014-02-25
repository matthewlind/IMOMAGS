<?php // Community slider for sidebar

class IF_Community_Slider extends WP_Widget {
	function IF_Community_Slider() {
		$widget_ops = array('classname' => 'community_slider', 'description' => 'In-Fisherman Community Slider Widget.' );
		$this->WP_Widget('if-community-slider', 'In-Fisherman Community Slider', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

    $hostname = $_SERVER['SERVER_NAME'];
	
	//User Info
	$userInfo = wp_get_current_user();

	$username = $userInfo->user_nicename;

	$apiURL = "http://$hostname/community-api/users/$username?get_comments=1";

	$file = file_get_contents($apiURL);

	$data = json_decode($file);

	if($data->score == 1){
		$niceScore = '<b>'.$data->score.'</b> Point';
	}else{
		$niceScore = '<b>'.$data->score.'</b> Points';
	}
	
	
	//Community Photos
	$jsonData = file_get_contents('http://'.$hostname.'/community-api/posts?per_page=10&sort=DESC');
	$pictures = json_decode($jsonData);
	
	$crop = "/convert?w=119&h=119&fit=crop&rotate=exif";
?>
    <div id="join" class="join-box fb-join-widget-box">
    	<a href="/photos" class="horz-logo"></a>
        <div class="explore-posts loading-block">
            <div class="jq-explore-slider-sidebar onload-hidden">
                <ul class="slides">
                	<?php $i=1; foreach ($pictures as $picture) { $i++; 
	                	if($picture->img_url){ ?>
                			<li><a href="/photos/<?php echo $picture->id; ?>"><img width="119" src="<?php echo $picture->img_url . $crop; ?>" alt="<?php echo $picture->title; ?>" /></a></li>
                		<?php } ?>
                	<?php if($i==11){ echo '<li class="slider-view-more"><a href="/photos">View More</a></li>'; } } ?>
                </ul>
            </div>
		</div>
		

    </div>
    <div class="share-photo-btn">
		<a href="/photos/new" class="singl-post-photo"><span>Share Your Photo</span></a>
    </div>
<?php	}

}
register_widget('IF_Community_Slider');