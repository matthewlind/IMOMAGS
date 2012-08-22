<?php

include("mysql.php");

$profilePicURL = "";

try {

	$db = dbConnect();
	
	$uid = $_GET['uid'];


	$sql = "SELECT meta_value FROM wp_usermeta WHERE user_id = ? AND meta_key = 'facebook_profile_image_URL'";

	$stmt = $db->prepare($sql);
	$stmt->execute(array($uid));

	$profilePicURL = $stmt->fetchColumn();

	//echo json_encode($posts);

	//echo $profilePicURL;
	
	if (empty($profilePicURL)) {
		
		$sql = "SELECT user_email FROM wp_users WHERE ID = ?";
		
		$stmt = $db->prepare($sql);
		$stmt->execute(array($uid));
	
		$email = $stmt->fetchColumn();
		
		$default = urlencode("http://" . $_SERVER['SERVER_NAME'] . '/wp-content/themes/imo-mags-northamericanwhitetail/img/naw_default_avatar.png');
		
		$profilePicURL = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=$default&s=100";
		
	}
	
	

	$db = "";

} catch(PDOException $e) {
	echo $e->getMessage();
}

//http://www.gravatar.com/avatar/5f4d99fbe16dfb6512dd4c01e0706e26.jpg?s=50&d=identicon

header("Location: $profilePicURL");