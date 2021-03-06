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

	if (!empty($headers["X-Forwarded-For"]))
		return $XFFip;
	else
		return $_SERVER['REMOTE_ADDR'];

}

$response = $app->response();

//If this is coming from the app, change the Content Type for JSON
if (!empty($_SERVER['HTTP_USER_AGENT'])) {
	$userAgentString = $_SERVER['HTTP_USER_AGENT'];
	$userAgentHasNAW = strpos($userAgentString,"NAW/");
	$userAgentHascomimoNAW = strpos($userAgentString,"com.imo.NAW");
	if ($userAgentHasNAW === false && $userAgentHascomimoNAW === false) {
		$response['Content-Type'] = "text/plain";
	} else {
		$response['Content-Type'] = 'text/json';
	}
} else {
	$response['Content-Type'] = "text/plain";
}



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

		$sql = "SELECT * FROM allcounts2 WHERE domain = 'www.northamericanwhitetail.com' ORDER BY id DESC $limitClause";
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


		$sql = "SELECT * FROM allcounts2 $whereClause AND domain = 'www.northamericanwhitetail.com' ORDER BY id DESC $limitClause";

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


		$sql = "SELECT * FROM allcounts2 $whereClause AND domain = 'www.northamericanwhitetail.com' ORDER BY comment_count DESC $limitClause";

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


		$sql = "SELECT * FROM allcounts2 $whereClause AND domain = 'www.northamericanwhitetail.com' ORDER BY id DESC $limitClause";

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
//**** Get all Posts Sorted by Most Active ****
//*********************************
$app->get('/api/superpost/active/type/:post_type(/:count(/:start))',function($post_type,$count = 20,$start = 0){




	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();

		$whereClause = "WHERE post_type = ?";

		if ($post_type == "all")
			$whereClause = "WHERE post_type != 'comment' AND post_type != 'answer' AND post_type != 'photo' AND post_type != 'youtube'";

		$limitClause = "LIMIT $start,$count";


		$sql = "SELECT * FROM allcounts2 $whereClause AND domain = 'www.northamericanwhitetail.com' ORDER BY score DESC $limitClause";

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

		$sql = "SELECT * FROM allcounts2 $whereClause AND domain = 'www.northamericanwhitetail.com' ORDER BY view_count DESC $limitClause";

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


//***********************************************
//*** Get Specific post WITHOUT UPDATING COUNT
//***********************************************
$app->get('/api/superpost/post_only/:id',function($id){

	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();


		$sql = "SELECT * FROM allcounts WHERE id = ? ORDER BY id DESC";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($id));

		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);





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
	if (!empty($params['username']) && !empty($params['userhash'])) {
		$userIsGood = userIsGood($params['username'],$params['userhash']);
	} else {
		$userIsGood = FALSE;
	}


	$requestIsGood = TRUE;

	$postHash = "";



	$params['useragent'] = $_SERVER['HTTP_USER_AGENT'];
	$params['domain'] = convertDevDomainToDotCom($_SERVER['HTTP_HOST']);
	$params['posthash'] = "";

	if ($params['post_type'] != "youtube" && $params['post_type'] != "photo" && $params['post_type'] != "comment") {
			$postDate = date("dmy");
			$postHash = md5("HELLOTHERE232bb" . $params['username'] . $postDate . $params['title']);
			$params['posthash'] = $postHash;

			if (postIsRepeat($postHash))
				$requestIsGood = FALSE;
	}


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


			_log( "THIS THIS");

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
			"video_url",
			"domain",
			"useragent",
			"posthash"
		);

    if (!empty($params['title']) && stristr($params['title'],"Nayarit")){

      $params['title'] = "Photo from App";
    }

    	_log($params);
    		_log( "THIS THIS3");

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


		_log("before exec");

		if (empty($params['title']) && empty($params['body']) && empty($params['img_url']))
			$requestIsGood = FALSE;


		if ($requestIsGood) {


			$stmt->execute();
	        $superpostID = $db->lastInsertId();


	        //If there are attachments, set the parent of the attachemnts
	     	if (!empty($params['attachment_id'])) {
				$attachmentIDstring = $params['attachment_id'];
				setAttachment($superpostID, $attachmentIDstring);

			}




			$params['id'] = $superpostID;
			$params['ip'] = long2ip($params['ip']);


			$response = $params;


			if ($params['post_type'] == "comment") {//If this is a comment, add an event!


				$post_id = $params['parent'];
				$etype = "comment";
				$user_id = $params['user_id'];

				$eventHash = getEventHash($post_id, $etype, $user_id);

				$commentID = $superpostID;


				$oFlagger = new postFlagger();
				$rtn = $oFlagger->insertEvent($params['parent'], "comment", $params['user_id'],$eventHash,$commentID);
			}

			$db = "";
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
//**********Update Any Field**********
//*********************************
$app->post('/api/superpost/update_field',function() {
	header('Access-Control-Allow-Origin: *');

	$params = Slim::getInstance()->request()->post();

	_log("Update field started");
	_log($params);

	$fieldName = $params['field_name'];
	$fieldValue = $params['field_value'];
	$post_id = $params['post_id'];
	$user_id = $params['user_id'];

	$userIsGood = userIsGood($params['username'],$params['userhash']);
	$userIsEditor = userIsEditor($params['username'],$params['timecode'],$params['editor_hash']);

	$userHasGoodPerms = FALSE;

	//Load the post
	try {

    	$db = dbConnect();


    	$sql = "SELECT * FROM superposts WHERE id = ? LIMIT 1";

    	$stmt = $db->prepare($sql);
    	$stmt->execute(array($post_id));
    	$post = $stmt->fetchObject();




    	$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }



	//Check for good perms
	if ($userIsEditor) {
		$userHasGoodPerms = TRUE;
	} else {
       if ($post->user_id == $user_id)
    	  $userHasGoodPerms = TRUE;
	}



	//Get the user info an authenticate
	//REMOVED: userIsGood($params['username'],$params['userhash'])
	if ($userHasGoodPerms && $userIsGood) {

		try {

			$db = dbConnect();


			$sql = "UPDATE superposts SET `?` = ? WHERE `id` = ? LIMIT 1";

			$stmt = $db->prepare($sql);
			$stmt->execute(array($fieldName,$fieldValue,$post_id));



			echo json_encode($params);

			$db = "";



		} catch(PDOException $e) {
	    	echo $e->getMessage();
	    }

	}

});

//*********************************
//**********Update Multiple Fields**********
//*********************************
$app->post('/api/superpost/update_post',function() {
	header('Access-Control-Allow-Origin: *');

	$params = Slim::getInstance()->request()->post();

	_log("Update field started");
	_log($params);

	$post_id = $params['post_id'];
	$user_id = $params['user_id'];
	$post_type = "";

	$userIsGood = userIsGood($params['username'],$params['userhash']);
	$userIsEditor = userIsEditor($params['username'],$params['timecode'],$params['editor_hash']);

	$userHasGoodPerms = FALSE;


	//Grab the post
	try {

		$db = dbConnect();


		$sql = "SELECT * FROM superposts WHERE id = ? LIMIT 1";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($post_id));
		$post = $stmt->fetchObject();


		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

	//Check if user has good perms
	if ($userIsEditor) {
		$userHasGoodPerms = TRUE;
	} else {
		if ($post->user_id == $user_id)
			$userHasGoodPerms = TRUE;
	}



	//Get the user info an authenticate
	//REMOVED: userIsGood($params['username'],$params['userhash'])
	if ($userHasGoodPerms && $userIsGood) {
		_log("GOOD PERMS");
		try {

			$db = dbConnect();

			$paramList = array(
				"parent",
				"post_type",
				"secondary_post_type",
				"title",
				"body",
				"img_url",
				"meta",
				"state",
				"video_url",
				"domain",
			);

			$sql = "UPDATE superposts SET";

			foreach ($params as $paramName => $paramValue) {
				if (in_array($paramName, $paramList)) {

					$sql = "UPDATE superposts SET";
					$sql .= " `$paramName` = ? ";
					$sql .= " WHERE `id` = ? LIMIT 1";
					_log("$paramName: $paramValue");
					_log($sql);

					$stmt = $db->prepare($sql);
					$stmt->execute(array($paramValue,$post_id));

				}
			}





	        //If there are attachments, set the parent of the attachemnts
	     	if (!empty($params['attachment_id'])) {
				$attachmentIDstring = $params['attachment_id'];
				setAttachment($post_id, $attachmentIDstring);

			}

			//CLEAR THE VARNISH CACHE!
			$postURL = "http://" . $post->domain . "/plus/" . $post->post_type . "/" . $post->id . "/";

			$curl = curl_init($postURL);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PURGE");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $curlResult = curl_exec($curl);

			$postURL = "http://" . $post->domain . "/slim/api/superpost/post/" . $post->id;

			$curl = curl_init($postURL);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PURGE");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $curlResult = curl_exec($curl);


            _log($postURL);
            $params['post_url'] = $postURL;


			echo json_encode($params);

			$db = "";

		} catch(PDOException $e) {
	    	echo $e->getMessage();
	    }

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
	$user_id = $params['user_id'];

	$userIsGood = userIsGood($params['username'],$params['userhash']);
	$userIsEditor = userIsEditor($params['username'],$params['timecode'],$params['editor_hash']);
	$userHasGoodPerms = FALSE;




	//First, check to see if attachment has parent
	//If it does, don't change it.

	$postHasParent = FALSE;


	$post = "";
	try {

		$db = dbConnect();


		$sql = "SELECT * FROM superposts WHERE id = ?";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($post_id));
		$post = $stmt->fetchObject();

		if (!empty($post->parent))
			$postHasParent = TRUE;


		$db = "";

		_log($post);

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

	if ($post->user_id == $user_id)
	   $userHasGoodPerms = TRUE;



    //If the attachment isn't yet part of a post, it can still be edited
	//Get the user info an authenticate
	//REMOVED: userIsGood($params['username'],$params['userhash'])
	if (!$postHasParent || $userHasGoodPerms || $userIsEditor) {

		try {

			$db = dbConnect();


			$sql = "UPDATE superposts SET `body` = ? WHERE `id` = ? AND post_type IN ('youtube','photo')";

			$stmt = $db->prepare($sql);
			$stmt->execute(array($newBody,$post_id));

			_log($sql);



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

/*
			$postDate = date("dmy");
			$postHash = md5("HELLOTHERE232bb" . $params['username'] . $postDate . $params['title']);
			$params['posthash'] = $postHash;

			if (postIsRepeat($postHash))
				$requestIsGood = FALSE;
*/

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
		$eventHash = getEventHash($post_id, $etype, $user_id);

		//if (userIsGood($params['username'],$params['userhash'])) {

		if (eventIsRepeat($eventHash)) {
			$rtn["error"] = "Repeat Event";
		} else {
			$oFlagger = new postFlagger();
			$rtn = $oFlagger->insertEvent($post_id, $etype, $user_id,$eventHash);
		}





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








function setAttachment($spid,$attachmentIDstring) {
	try {

		$attachIDs = explode(",", $attachmentIDstring);

		$db = dbConnect();

		//First Clear out any attachments
		$sql = "UPDATE superposts SET parent = null WHERE parent = ?";

        $stmt = $db->prepare($sql);

        $stmt->execute(array($spid));


		//Then, Add them All back
		foreach ($attachIDs as $attachmentID) {
			$sql = "UPDATE superposts SET parent = ? WHERE id IN(?)";

			$stmt = $db->prepare($sql);

			$stmt->execute(array($spid,$attachmentID));

			$row = $stmt->fetch(PDO::FETCH_OBJ);
		}

		if (!empty($attachIDs[0])) {
			$sql = "SELECT * from superposts WHERE id = ?";

			$stmt = $db->prepare($sql);
			$stmt->execute(array($attachIDs[0]));

			$row = $stmt->fetch(PDO::FETCH_OBJ);

			$imgURL = $row->img_url;

			$sql = "UPDATE superposts SET img_url = ? WHERE id = ?";

			$stmt = $db->prepare($sql);

			$stmt->execute(array($imgURL,$spid));

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

function getEventHash($post_id, $etype, $user_id) {

	date_default_timezone_set("America/New_York");
	$eventDate = date("dmy");
	$eventMinute = floor(((int)date("i")));

	$eventHash = md5("STRINGTHINGSgfid25s" . $post_id . $etype . $user_id . $eventDate . $eventMinute);

	return $eventHash;
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

function convertDevDomainToDotCom($domain) {

	$domain = str_replace(".deva",".com",$domain);
	$domain = str_replace(".fox",".com",$domain);
	$domain = str_replace(".salah",".com",$domain);
	$domain = str_replace(".devb",".com",$domain);
	$domain = str_replace(".devc",".com",$domain);
	$domain = str_replace(".dev-brock",".com",$domain);
	$domain = str_replace(".dev-kayla",".com",$domain);

	return $domain;
}




$app->run();
