<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$DOMAIN = "deva";

require 'Slim/Slim.php';

$app = new Slim();
include 'mysql.php';
include 'auth.php';
include 'userinfo.php';
include 'images.php';
include 'video.php';
include 'state.php';
include 'location.php';
include 'clsFlagger.php';

function get_IP() {
	$headers = apache_request_headers(); 
	if (!empty($headers["X-Forwarded-For"]))
		$XFFip = $headers["X-Forwarded-For"];

	if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1" && !empty($headers["X-Forwarded-For"]))
		return $XFFip;
	else
		return $_SERVER['REMOTE_ADDR'];

}

$response = $app->response();
$response['Content-Type'] = 'application/json';



$app->get('/',function(){
	echo "<h1>Hello Berry!</h1>";
});





//*********************************
//********* Get all Posts *********
//*********************************
//Note, this does not fetch comments or answers
$app->get('/api/superpost/all(/:count(/:start))',function($count = 20,$start = 0){

	header('Access-Control-Allow-Origin: *');  

	try {

		$db = dbConnect();

		$limitClause = "LIMIT $start,$count";

		$sql = "SELECT * FROM allcounts ORDER BY id DESC $limitClause";
		$stmt = $db->query($sql);
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});


//******************************************************
//********* Get Posts by type with only images *********
//******************************************************
//Note, this does not fetch comments or answers
$app->get('/api/superpost/photos/:post_type(/:count(/:start))',function($post_type,$count = 20,$start = 0){




	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();

		$whereClause = "WHERE post_type = ?";
		
		if ($post_type == "all")
			$whereClause = "WHERE post_type != 'comment' AND post_type != 'answer' AND post_type != 'photo' AND post_type != 'youtube' AND img_url IS NOT NULL";

		$limitClause = "LIMIT $start,$count";
		

		$sql = "SELECT * FROM allcounts $whereClause ORDER BY id DESC $limitClause";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($post_type));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});



//****************************************************************
//********* Get Posts by type with only images by points *********
//****************************************************************
//Note, this does not fetch comments or answers
$app->get('/api/superpost/comment_count/:post_type(/:count(/:start))',function($post_type,$count = 20,$start = 0){




	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();

		$whereClause = "WHERE post_type = ?";
		
		if ($post_type == "all")
			$whereClause = "WHERE post_type != 'comment' AND post_type != 'answer' AND post_type != 'photo' AND post_type != 'youtube' AND img_url IS NOT NULL";

		$limitClause = "LIMIT $start,$count";
		

		$sql = "SELECT * FROM allcounts $whereClause ORDER BY comment_count DESC $limitClause";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($post_type));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});



//*********************************
//**** Get all Posts of a Type ****
//*********************************
$app->get('/api/superpost/type/:post_type(/:count(/:start))',function($post_type,$count = 20,$start = 0){




	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();

		$whereClause = "WHERE post_type = ?";

		if ($post_type == "all")
			$whereClause = "WHERE post_type != 'comment' AND post_type != 'answer' AND post_type != 'photo' AND post_type != 'youtube'";

		$limitClause = "LIMIT $start,$count";


		$sql = "SELECT * FROM allcounts $whereClause ORDER BY id DESC $limitClause";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($post_type));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});



//*********************************
//**** Get all Posts of a Type with only images by view count ****
//*********************************
$app->get('/api/superpost/views/:post_type(/:count(/:start))',function($post_type,$count = 20,$start = 0){




	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();

		$whereClause = "WHERE post_type = ?";

		if ($post_type == "all")
			$whereClause = "WHERE post_type != 'comment' AND post_type != 'answer' AND post_type != 'photo' AND post_type != 'youtube' AND img_url IS NOT NULL";

		$limitClause = "LIMIT $start,$count";
		
		$sql = "SELECT * FROM allcounts $whereClause ORDER BY view_count DESC $limitClause";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($post_type));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});

//*********************************
//**** Count all Posts of a Type ****
//*********************************
$app->get('/api/superpost/count/:post_type',function($post_type){




	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();

		$whereClause = "WHERE post_type = ?";

		
		$sql = "SELECT COUNT(post_type) AS post_count FROM allcounts $whereClause";
		
   		$stmt = $db->prepare($sql);
		$stmt->execute(array($post_type));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});

//*********************************
//********* Get Users by Score *********
//*********************************
/*$app->get('/api/superpost/top_users/all(/:count(/:start))',function($count = 10,$start = 0){

	header('Access-Control-Allow-Origin: *');  

	try {

		$db = dbConnect();

		$limitClause = "LIMIT $start,$count";

		$sql = "SELECT username, display_name, user_id as ids, score FROM allcounts as posts 
		LEFT JOIN userscore as topUser ON posts.ids = topUser.ids
		ORDER BY score DESC$limitClause";
		$stmt = $db->query($sql);
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});
*/
//*********************************
//*** Get Specific Post with ID ***
//*** THIS INCREMENTS VIEW COUNT ***
//*********************************
$app->get('/api/superpost/post/:id',function($id){

	header('Access-Control-Allow-Origin: *');  

	try {

		$db = dbConnect();


		$sql = "SELECT * FROM allcounts WHERE id = ? ORDER BY id DESC";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($id));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);
		
		//Also update the view count
		$sql = "UPDATE superposts SET view_count = view_count + 1 WHERE id = ?";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($id));
		
		
		
		
		
		

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});

//**************************************
//**** Get all Child Posts of a Type ***
//**************************************
$app->get('/api/superpost/children/:post_type/:parent_id',function($post_type,$parent_id){

	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();

		if ($post_type != "not_comment") {

			$sql = "SELECT * FROM superposts WHERE post_type = ? AND parent = ? ORDER BY id ASC";

			$stmt = $db->prepare($sql);
			$stmt->execute(array($post_type,$parent_id));
		} else { //If post_type == not_comment
			
			$sql = "SELECT * FROM superposts WHERE post_type != 'comment' AND parent = ? ORDER BY id ASC";

			$stmt = $db->prepare($sql);
			$stmt->execute(array($parent_id));
		}
		
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});

//**************************************
//**** Get Comments with attachments ***
//**************************************
$app->get('/api/superpost/comment_attachments/:parent_id',function($parent_id){

	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();



		$sql = "SELECT posts.ID post_id, posts.gravatar_hash gravatar_hash,
				comments.ID comment_id, comments.post_type comment_post_type, comments.body comment_body, comments.username comment_username, comments.user_id comment_user_id,comments.display_name comment_display_name,
				attachments.ID attachment_id, attachments.post_type attachment_post_type, attachments.img_url as attachment_img_url, attachments.meta as attachment_meta, attachments.body as attachment_body 
				FROM superposts as posts
				LEFT JOIN allcounts as comments ON posts.id = comments.parent
				LEFT JOIN superposts as attachments ON comments.id = attachments.parent
				WHERE posts.ID = ?
				AND comments.post_type = 'comment'";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($parent_id));

	
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		$postComments = array();
		$comment = array();
		$comment['comment_id'] = 0;
		foreach ($posts as $post) {

			
			if ($post->comment_id != $comment['comment_id'])
				$comment['attachments'] = array();

			
			$attachmentID = $post->attachment_id;
			
			$comment['comment_id'] = $post->comment_id;
			$comment['comment_body'] = $post->comment_body;
			$comment['comment_username'] = $post->comment_username;
			$comment['comment_display_name'] = $post->comment_display_name;
			$comment['comment_user_id'] = $post->comment_user_id;
			$comment['gravatar_hash'] = $post->gravatar_hash;

			if ($post->attachment_id) {
				$comment['attachments'][$attachmentID]['attachment_img_url'] = $post->attachment_img_url;
				$comment['attachments'][$attachmentID]['attachment_body'] = $post->attachment_body;
				$comment['attachments'][$attachmentID]['attachment_post_type'] = $post->attachment_post_type;
				$comment['attachments'][$attachmentID]['attachment_meta'] = $post->attachment_meta;
				$comment['attachments'][$attachmentID]['attachment_id'] = $post->attachment_id;
			}
				



			$postComments[$post->comment_id] = $comment;


		}
		
		//Improve json formatting for picky parsers
		$postCommentsArray = array();
		
		foreach ($postComments as $key => $comment) {
		
			$commentAttachmentArray = array();
		
			foreach($comment['attachments'] as $key => $attachment) {
				$commentAttachmentArray[] = $attachment;
			}
			$comment['attachments'] = $commentAttachmentArray;
			$postCommentsArray[] = $comment;
		}

		echo json_encode($postCommentsArray);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});


//*********************************
//**********Add new Posts**********
//*********************************
$app->post('/api/superpost/add',function() {
	header('Access-Control-Allow-Origin: *');

	$params = Slim::getInstance()->request()->post();

	_log("NEW POST STARTED!");
	_log( $params);


	//Get the user info and authenticate
	$userIsGood = userIsGood($params['username'],$params['userhash']);
	
	$requestIsGood = TRUE;
	
	if (!empty($params['body']))
		$params['body'] = nl2br($params['body']);
	
	if ($params['post_type'] == "youtube" || $params['post_type'] == "photo") {
		$userIsGood = TRUE;
	}
	
	if ($userIsGood) {
	
	_log("USER IS GOOD");

		//Set additional parameters
		$params['ip'] = ip2long(get_IP());

		//error_log($params);

		//Handle the uploaded file
		if (!empty($_FILES['photo-upload']['name'])) {
			$fileName = $_FILES['photo-upload']['name'];
			$tmpName = $_FILES['photo-upload']['tmp_name'];
			$target_path = "images/tmp/";
			$target_path = $target_path . basename( $fileName );

		}
		/////////////////////////////////////
		//If there is a video....
		$videoExists = false;
		if ($params['post_type'] == "youtube") {

			_log("VIDEO STUFF");
			_log($params);

			
			
			if (!empty($params['video_url']))
				$videoID = extractVideoID($params['video_url']);
			else
				$videoID = extractVideoID($params['body']);
			
			

			$video = getYoutubeVideo($videoID);

			$params['body'] = "";
			$params['meta'] = $videoID;

			$target_path = $video['temp_image_path'];

			_log($video);

			$imgURL = resizeImages($target_path, TRUE);

			$videoExists = TRUE;

		}

		 /////////////////////////////////////
		//If there is an image
		if (!empty($_FILES['photo-upload']['name'])) { //Check if file exists
			if(move_uploaded_file($tmpName, $target_path)) { //check if file upload failed
				//Then resize and move the file!
				$imgURL = resizeImages($target_path);
			} else{
			    error_log("There was an error uploading the file, please try again!");
			}
		}

		/////////////////////////////////////
		//If there are attachments, get the $imgURL
		if (!empty($params['attachment_id'])) {
			$attachmentIDstring = $params['attachment_id'];
			$attachmentIDs = explode(",", $attachmentIDstring);
		

			$imgURL = getImgURL($attachmentIDs[0]);
			$params['img_url'] = $imgURL;
			
			
		}

		
	
		$paramList = array(
			"parent",
			"post_type",
			"secondary_post_type",
			"title",
			"body",
			"user_id",
			"username",
			"gravatar_hash",
			"img_url",
			"ip",
			"meta",
			"state",
			"video_url"
		);

		if (!empty($fileName) || $videoExists) {
			$params['img_url'] = $imgURL;
		}
		
		$db = dbConnect();

		//BUILD THE PERFECT QUERY FOR THE PARAMETERS GIVEN
		$sql = "INSERT INTO superposts (";
		$sql2 = "VALUES (";

		foreach ($paramList as $parameter) {

			if (!empty($params[$parameter])) {
				$sql .= $parameter . ",";
				$sql2 .= ":$parameter,";
			}
		}

		$sql = substr_replace($sql ,"",-1);
		$sql2 = substr_replace($sql2 ,"",-1);

		$sql .= ") ";
		$sql2 .= ")";

		$sql = $sql . $sql2;

		$stmt = $db->prepare($sql);



		foreach ($paramList as $parameter) {

			if (!empty($params[$parameter])) {
				$stmt->bindParam($parameter,$params[$parameter]);
			}
		}
		


			
		if (empty($params['title']) && empty($params['body']) && empty($params['img_url']))
			$requestIsGood = FALSE;	
			
			
		if ($requestIsGood) {
			
			$stmt->execute();
	        $superpostID = $db->lastInsertId();
	        
	        
	        //If there are attachments, set the parent of the attachemnts
	     	if (!empty($params['attachment_id'])) {
				$attachmentIDstring = $params['attachment_id'];
				setAtttachment($superpostID, $attachmentIDstring);
				
			}
	        
	
			$db = "";
	
			$params['id'] = $superpostID;
			$params['ip'] = long2ip($params['ip']);
	
	
			$response = $params;
	
			
			echo json_encode($response);
			
		} else {
			json_encode("nope");
		}


	
	} else { //if user is not good
		_log("USER IS BAD");
		json_encode("nope");
	}
	


});


//*********************************
//**********Update Post Body**********
//*********************************
$app->post('/api/superpost/update_caption',function() {
	header('Access-Control-Allow-Origin: *');

	$params = Slim::getInstance()->request()->post();

	_log("NEW CAPTION STARTED");
	_log($params);

	$newBody = $params['body'];
	$post_id = $params['post_id'];


	//Get the user info an authenticate
	//REMOVED: userIsGood($params['username'],$params['userhash'])
	if (TRUE) {

		try {

			$db = dbConnect();


			$sql = "UPDATE superposts SET `body` = ? WHERE `id` = ? AND post_type IN ('youtube','photo')";

			$stmt = $db->prepare($sql);
			$stmt->execute(array($newBody,$post_id));
		
		

			echo json_encode("GOOD");

			$db = "";

		} catch(PDOException $e) {
	    	echo $e->getMessage();
	    }

	}



});

//*********************************
//handle post flagging - rating - etc
//*********************************

$app->post('/api/post/flag',function() {
	
	header('Access-Control-Allow-Origin: *');

	$params = Slim::getInstance()->request()->post();

	_log("FLAGGING STARTED");
	_log($params);
	


	if (!(isset($params['post_id']) && isset($params['etype']) && isset($params['user_id']))) {
		$rtn["error"] = "Invalid Request";

	}
	elseif (!($params['post_id']!="" && $params['etype']!="" && $params['user_id']!="")) {
		$rtn["error"] = "Invalid Parameters";
	
	}
	else {
	
		$post_id = $params['post_id'];
		$etype = isset($params['etype'])? $params['etype']:"flag";
		$user_id = isset($params['user_id'])? $params['user_id']:"1";
	
		//if (userIsGood($params['username'],$params['userhash'])) {
		
			$oFlagger = new postFlagger();
		
			$rtn = $oFlagger->insertEvent($post_id, $etype, $user_id);

		
		//}
		//else {
			//what if user is not good?
		//}
	}
	
	print json_encode($rtn);
	return true;

});

$app->post('/api/post/flagadmin',function() {
	
	header('Access-Control-Allow-Origin: *');

	$params = Slim::getInstance()->request()->post();

	_log("FLAGGING STARTED");
	_log($params);
	
		
	//Get the user info and authenticate
	$userIsGood = userIsGood($params['username'],$params['userhash']);
	$userIsEditor = userIsEditor($params['username'],$params['timecode'],$params['editor_hash']);
	
	

	if (!(isset($params['post_id']) && isset($params['etype']) && isset($params['user_id']))) {
		$rtn["error"] = "Invalid Request";

	}
	elseif (!($params['post_id']!="" && $params['etype']!="" && $params['user_id']!="")) {
		$rtn["error"] = "Invalid Parameters";
	
	}
	elseif (!$userIsGood) {
		$rtn["error"] = "Bad User Account.";
	}
	elseif (!$userIsEditor) {
		$rtn["error"] = "Expired Token. Reload the page to get a new token.";
	}
	else {
	
		$post_id = $params['post_id'];
		$etype = isset($params['etype'])? $params['etype']:"flag";
		$user_id = isset($params['user_id'])? $params['user_id']:"1";
	
		//if (userIsGood($params['username'],$params['userhash'])) {
			$oFlagger = new postFlagger();
			
			
			if($params['etype']=="reset")
				$rtn = $oFlagger->resetFlags($post_id);
		
			elseif($params['etype']=="teflon") 
				$rtn = $oFlagger->insulateFlags($post_id);

			elseif($params['etype']=="unapprove") 
				$rtn = $oFlagger->maxFlags($post_id);
		//}
		//else {
			//what if user is not good?
		//}
	}
	
	print json_encode($rtn);
	return true;

});








function setAtttachment($spid,$attachmentIDstring) {
	try {

		$attachIDs = explode(",", $attachmentIDstring);

		$db = dbConnect();


		foreach ($attachIDs as $attachmentID) {
			$sql = "UPDATE superposts SET parent = ? WHERE id IN(?)";

			$stmt = $db->prepare($sql);

			$stmt->execute(array($spid,$attachmentID));
		
			$row = $stmt->fetch(PDO::FETCH_OBJ);			
		}







		$db = "";
		
		return true;


	} catch(PDOException $e) {
    	echo $e->getMessage();
    	return false;
    }
	
}


function getImgURL($spid) {
	try {

		$db = dbConnect();


		$sql = "SELECT img_url FROM superposts WHERE id = ?";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($spid));
	
		$row = $stmt->fetch(PDO::FETCH_OBJ);

		$db = "";
		
		return $row->img_url;


	} catch(PDOException $e) {
    	echo $e->getMessage();
    }
}






/* Better Logging Function */
if(!function_exists('_log')){
  function _log( $message ) {
	  if( is_array( $message ) || is_object( $message ) ){

	  	$errorString = print_r( $message, true );

	    error_log( "$errorString",0);
	  } else {
	    error_log( $message );
	  }
  	}
}






$app->run();