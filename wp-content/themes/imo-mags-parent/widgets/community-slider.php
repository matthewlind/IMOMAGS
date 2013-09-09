<?php // Community slider for sidebar

class Community_Slider extends WP_Widget {
	function Community_Slider() {
		$widget_ops = array('classname' => 'community_slider', 'description' => 'Community Slider Widget.' );
		$this->WP_Widget('community-slider', 'Community Slider', $widget_ops);
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

?>
    <div id="join" class="join-box fb-join-widget-box">
    	<h2>Explore Photos</h2>
        <div class="explore-posts loading-block">
            <div class="jq-explore-slider-sidebar onload-hidden">
                <ul class="slides">
                	<?php foreach ($pictures as $picture) { ?>
                		<li><a href="/photos/<?php echo $picture->id; ?>"><img width="119" src="<?php echo $picture->img_url; ?>/convert?w=119&h=119&fit=crop" alt="<?php echo $picture->title; ?>" /></a></li>
                	<?php } ?>
                </ul>
            </div>
		</div>
		

    </div>
	<div class="fileupload-buttonbar fileupload-sidebar">
        <label class="upload-button">
			<a class="singl-post-photo"><span class="add-photo-link">Share Photo</span></a>
			<input id="image-upload" class="common-image-upload" type="file" name="photo-upload">
        </label>
    </div>



<?php	}

}
register_widget('Community_Slider');