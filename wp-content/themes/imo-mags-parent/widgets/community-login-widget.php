<?php // Community login widget

class Community_Login_Widget extends WP_Widget {
	function Community_Login_Widget() {
		$widget_ops = array('classname' => 'community_login_widget', 'description' => 'Community Login Widget.' );
		$this->WP_Widget('login widget', 'Community Login Widget', $widget_ops);
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

    $displayStyle = "display:none";
	$loginStyle = "";

	if ( is_user_logged_in() ) {

		$displayStyle = "";
		$loginStyle = "display:none";

		wp_get_current_user();

		$current_user = wp_get_current_user();
	    if ( !($current_user instanceof WP_User) )
	         return;
	    }
	    ?>
	    <div id="join" class="join-box fb-join-widget-box" style="<?php echo $loginStyle; ?>">
			<a href="/photos" class="horz-logo"></a>
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
		<div class="join-box join-logged-in" style="<?php echo $displayStyle; ?>">
	        <h3><span>YOU ARE</span> LOGGED IN</h3>
	        <div class="profile-panel">
	            <div class="profile-photo">
	                <a href="/profile/<?php echo $data->user_nicename; ?>"><img src="/avatar?uid=<?php echo $data->ID; ?>" alt="<?php echo $data->display_name; ?>" title="<?php echo $data->display_name; ?>" /></a>
	            </div>
	            <div class="profile-data">
	                <h4><a href="/profile/<?php echo $data->username; ?>"><?php echo $data->display_name; ?></a></h4>
	                <strong class="user-points"><?php echo $niceScore; ?></strong>
	            </div>
	        </div>
	        <div class="edit-section">
	            <a href="/edit-profile/?action=profile">edit profile</a>
	        </div>
	    </div>
	    <div id="join" class="join-box join-logged-in" style="<?php echo $displayStyle; ?>">
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
				<a class="singl-post-photo"><span>Share Your Catch</span></a>
				<input id="image-upload" class="common-image-upload" type="file" name="photo-upload">
            </label>
        </div>
<?php	}

}
register_widget('Community_Login_Widget');
