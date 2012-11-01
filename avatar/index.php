<?php

include("mysql.php");

function user_avatar_avatar_exists($id){
	
	$avatar_folder_dir = "/data/wordpress/imomags/wp-content/uploads/avatars/{$id}/";
	$return = false;
	
	
	
	if ( is_dir( $avatar_folder_dir ) && $av_dir = opendir( $avatar_folder_dir ) ) {
			
			// Stash files in an array once to check for one that matches
			$avatar_files = array();
			while ( false !== ( $avatar_file = readdir($av_dir) ) ) {
				// Only add files to the array (skip directories)
				if ( 2 < strlen( $avatar_file ) )
					$avatar_files[] = $avatar_file;
			}
			
			// Check for array
			if ( 0 < count( $avatar_files ) ) {
				// Check for current avatar
				if( is_array($avatar_files) ):
					foreach( $avatar_files as $key => $value ) {
						if(strpos($value, "-bpfull")):
							$return =  $value;
						endif;
					}
				endif;
				
			}

		// Close the avatar directory
		closedir( $av_dir );

	}
	
	return $return;
}





$profilePicURL = "";

try {

	$db = dbConnect();
	
	$uid = $_GET['uid'];
	
	
	//First Check for uploaded Avatar
	if ($localAvatar = user_avatar_avatar_exists($uid)) {
		$profilePicURL = "/wp-content/uploads/avatars/$uid/"  . $localAvatar;
	} else {
		
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
	}
	



	
	

	$db = "";

} catch(PDOException $e) {
	echo $e->getMessage();
}

//http://www.gravatar.com/avatar/5f4d99fbe16dfb6512dd4c01e0706e26.jpg?s=50&d=identicon

header("Location: $profilePicURL");