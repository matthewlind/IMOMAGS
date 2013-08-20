<?php

require 'Slim/Slim.php';
include 'mysql.php';
include 'auth.php';
include 'images.php';
include 'video.php';


\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

include 'users.php';

// GET a list of posts. 20 by default
//Note, $post_type = "all" does not fetch comments or answers
$app->get('/posts', function () {

	//Default Settings
	$post_type = "all"; // e.g. "report","question"
	$state = NULL; // e.g. "GA","NY"
	$skip = 0; //Start Number
	$per_page = 20;
	$require_images = FALSE; //Only return posts with images, use 1 or 0 in query string
	$order_by = "id"; //e.g. "created","view_count"
	$sort = "DESC";

	//Grab the parameters
	$params = \Slim\Slim::getInstance()->request()->get();

	//Overwrite the default settings with the new ones
	extract($params,EXTR_OVERWRITE);

	//This header allows this file to be accessed via AJAX from other domains.
	header('Access-Control-Allow-Origin: *');

	//////////////////////////////////////////////////////
	//Validate the parameters to prevent MySQL injection//
	//////////////////////////////////////////////////////

	//If $post_type is all lowercase and it's less than 20 char, it's GOOD
	if (ctype_lower($post_type) && strlen($post_type) < 20) {

		$postTypeClause = " post_type = '$post_type'";

		if ($post_type == "all")
			$postTypeClause = " post_type != 'comment' AND post_type != 'answer' AND post_type != 'photo' AND post_type != 'youtube' ";

	} else {
		header('HTTP 1.1/400 Bad Request', true, 400);
		exit();
	}

	//If state is 2 letters
	$stateClause = "";
	if (ctype_alpha($state) && strlen($state) <= 2) {
		//If state is only alphabetic characters and only 2 characters, IT's good
		$stateClause = "AND state = '$state'";
	}

	//If require images is true
	if ($require_images) {
		$requireImagesClause = "AND img_url IS NOT NULL";
	} else {
		$requireImagesClause = "";
	}

	//if sort is a valid sort
	if ($sort == "DESC" || $sort == "ASC" || $sort == "asc" || $sort == "desc") {
		//Those are good sorts!
		$sortClause = $sort;
	} else {
		header('HTTP 1.1/400 Bad Request', true, 400);
		exit();
	}

	//IF order_by  is less than 22 characters and is only lowercase letters and underscores
	if (preg_match("/^[a-z_]{1,22}$/", $order_by)) {

		$orderByClause = "ORDER BY $order_by";
	} else {
		header('HTTP 1.1/400 Bad Request', true, 400);
		exit();
	}

	//Make sure these integers are not evil strings
	$per_page = intval($per_page);
	$skip = intval($skip);
	$limitClause = "LIMIT $skip,$per_page";

	//////////////////////////////////////////////////////
	///End Data Validation////////////////////////////////
	//////////////////////////////////////////////////////

	//Try to query the database
	try {

		$db = dbConnect();


		$sql = "SELECT *,CONCAT(allcounts2.post_type,'/',allcounts2.id) as url FROM allcounts2 WHERE $postTypeClause $stateClause $requireImagesClause $orderByClause $sortClause $limitClause";



		$stmt = $db->prepare($sql);
		$stmt->execute(array());

		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts,JSON_NUMERIC_CHECK);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }
});



//GET a single post by ID
$app->get('/posts/:id', function ($id) {

	//Default Settings
	$update_viewcount = TRUE; // use 1 or 0 in query string
	$get_attachments = TRUE; // use 1 or 0 in query string
	$get_comments = FALSE; // use 1 or 0 in query string

	header('Access-Control-Allow-Origin: *');


	//Grab the parameters
	$params = \Slim\Slim::getInstance()->request()->get();

	//Overwrite the default settings with the new ones
	extract($params,EXTR_OVERWRITE);

	$posts = '';


	//Get the post
	try {

		$db = dbConnect();


		$sql = "SELECT * FROM allcounts2 WHERE id = ? ORDER BY id DESC";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($id));

		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);



		$db = '';

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

    //If we need to, get the attachments
   	if ($get_attachments) {
	   	try {

			$db = dbConnect();


			//$sql = "SELECT *,CONCAT(allcounts2.post_type,'/',allcounts2.id) as url FROM superposts WHERE parent = ? AND post_type IN ('photo','youtube') ORDER BY id ASC";
			$sql = "SELECT * FROM superposts WHERE parent = ? AND post_type IN ('photo','youtube') ORDER BY id ASC";

			$stmt = $db->prepare($sql);
			$stmt->execute(array($id));

			$attachments = $stmt->fetchAll(PDO::FETCH_OBJ);

			//Set the attachments to the post
			$posts[0]->attachments = $attachments;

			$db = '';

		} catch(PDOException $e) {
	    	echo $e->getMessage();
	    }
   	}

   	if ($get_comments) {
	   	try {

			$db = dbConnect();



			$sql = "SELECT posts.ID post_id, posts.gravatar_hash gravatar_hash,
					comments.ID comment_id, comments.post_type comment_post_type, comments.body comment_body, comments.username comment_username, comments.user_id comment_user_id,comments.display_name comment_display_name,
					attachments.ID attachment_id, attachments.post_type, attachments.img_url , attachments.meta, attachments.body
					FROM superposts as posts
					LEFT JOIN allcounts2 as comments ON posts.id = comments.parent
					LEFT JOIN superposts as attachments ON comments.id = attachments.parent
					WHERE posts.ID = ?
					AND comments.post_type = 'comment'";

			$stmt = $db->prepare($sql);
			$stmt->execute(array($id));



			$post_comments = $stmt->fetchAll(PDO::FETCH_OBJ);

			$postComments = array();
			$comment = array();
			$comment['id'] = 0;


			//The data returned by the above query is difficult to use.
			//This foreach loop organizes the attachments so that it's useful.
			foreach ($post_comments as $post) {


				if ($post->comment_id != $comment['id'])
					$comment['attachments'] = array();


				$attachmentID = $post->attachment_id;

				$comment['id'] = $post->comment_id;
				$comment['body'] = $post->comment_body;
				$comment['username'] = $post->comment_username;
				$comment['display_name'] = $post->comment_display_name;
				$comment['user_id'] = $post->comment_user_id;
				$comment['gravatar_hash'] = $post->gravatar_hash;

				if ($post->attachment_id) {
					$comment['attachments'][$attachmentID]['img_url'] = $post->img_url;
					$comment['attachments'][$attachmentID]['body'] = $post->body;
					$comment['attachments'][$attachmentID]['post_type'] = $post->post_type;
					$comment['attachments'][$attachmentID]['meta'] = $post->meta;
					$comment['attachments'][$attachmentID]['id'] = $post->attachment_id;
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

			//Set the attachments to the post
			$posts[0]->comments = $postCommentsArray;


			$db = '';

		} catch(PDOException $e) {
	    	echo $e->getMessage();
	    }

   	}//end if get_comments


    //Update the viewcount
    if ($update_viewcount) {
	    try {

			$db = dbConnect();

			//update the view count
			$sql = "UPDATE superposts SET view_count = view_count + 1 WHERE id = ?";

			$stmt = $db->prepare($sql);
			$stmt->execute(array($id));

			$db = '';

		} catch(PDOException $e) {
	    	echo $e->getMessage();
	    }
    }



    echo json_encode($posts[0], JSON_NUMERIC_CHECK);




});

// POST request to ADD a new post
$app->post('/posts',function() {
	header('Access-Control-Allow-Origin: *');

	$params = Slim\Slim::getInstance()->request()->post(); //jQuery sends data this way
	$requestJSON = Slim\Slim::getInstance()->request()->getBody(); //Backbone sends data this way

	if (json_decode($requestJSON)) {

		$params = json_decode($requestJSON,true);
	}




	_log( $params);

	//Get the user info and authenticate
	if (!empty($params['username']) && !empty($params['userhash'])) {
		$userIsGood = userIsGood($params['username'],$params['userhash']);
	} else {
		$userIsGood = FALSE;
	}


	$requestIsGood = TRUE;

	$postHash = '';



	$params['useragent'] = $_SERVER['HTTP_USER_AGENT'];
	$params['domain'] = $_SERVER['HTTP_HOST'];
	$params['posthash'] = '';

	if ($params['post_type'] != "youtube" && $params['post_type'] != "photo" && $params['post_type'] != "comment") {
			date_default_timezone_set('America/New_York');
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
		$params['ip'] = ip2long($_SERVER['REMOTE_ADDR']);

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

			$params['body'] = '';
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
			"video_url",
			"domain",
			"useragent",
			"posthash"
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

		$sql = substr_replace($sql ,'',-1);
		$sql2 = substr_replace($sql2 ,'',-1);

		$sql .= ") ";
		$sql2 .= ")";

		$sql = $sql . $sql2;

		_log($sql);

		$stmt = $db->prepare($sql);



		foreach ($paramList as $parameter) {

			if (!empty($params[$parameter])) {
				$stmt->bindParam($parameter,$params[$parameter]);
			}
		}




		if (empty($params['title']) && empty($params['body']) && empty($params['img_url']))
			$requestIsGood = FALSE;


		if ($requestIsGood) {

			_log('REQUEST IS GOOD');

			$stmt->execute();
	        $superpostID = $db->lastInsertId();

	        //If there are attachments, set the parent of the attachemnts
/*
	     	if (!empty($params['attachment_id'])) {
				$attachmentIDstring = $params['attachment_id'];
				setAttachment($superpostID, $attachmentIDstring);

			}
*/

			$params['id'] = $superpostID;
			$params['ip'] = long2ip($params['ip']);


			$response = $params;


			if ($params['post_type'] == "comment") {//If this is a comment, add an event!


				$post_id = $params['parent'];
				$etype = "comment";
				$user_id = $params['user_id'];

				$eventHash = getEventHash($post_id, $etype, $user_id);


				$oFlagger = new postFlagger();
				$rtn = $oFlagger->insertEvent($params['parent'], "comment", $params['user_id'],$eventHash);
			}

			if (!empty($params['attachments']))
				process_attachments($params['attachments'], $superpostID);


			$db = '';
			echo json_encode($response, JSON_NUMERIC_CHECK);

		} else {
			json_encode("nope");
		}



	} else { //if user is not good
		_log("USER IS BAD");
		json_encode("nope");
	}



});

// PUT request to modify a post
$app->put('/posts/:id',function($id) {
	header('Access-Control-Allow-Origin: *');

	//$params = Slim\Slim::getInstance()->request()->post();

	$requestJSON = Slim\Slim::getInstance()->request()->getBody();

	$params = json_decode($requestJSON,true);

	_log("Update field started");
	_log($params);

	$post_id = $id;
	$user_id = $params['user_id'];
	$post_type = '';

	$userHasGoodPerms = FALSE;


	$userIsGood = userIsGood($params['username'],$params['userhash']);
	$userIsEditor = userIsEditor($params['username'],$params['timecode'],$params['editor_hash']);



	//Grab the post
	try {

		$db = dbConnect();


		$sql = "SELECT * FROM superposts WHERE id = ? LIMIT 1";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($post_id));
		$post = $stmt->fetchObject();


		$db = '';

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
	        if (!empty($params['attachments']))
	        	process_attachments($params['attachments'], $post_id);


/*
	     	if (!empty($params['attachment_id'])) {
				$attachmentIDstring = $params['attachment_id'];
				setAttachment($post_id, $attachmentIDstring);

			}
*/

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


			echo json_encode($params, JSON_NUMERIC_CHECK);

			$db = '';

		} catch(PDOException $e) {
	    	echo $e->getMessage();
	    }

	}

});


// DELETE request to delete a post
$app->delete('/posts/:id', function ($id) {
	header('Access-Control-Allow-Origin: *');

	$requestJSON = Slim\Slim::getInstance()->request()->getBody();

	$params = json_decode($requestJSON,true);



	if (!$params) {
		//Grab the parameters
		$params = \Slim\Slim::getInstance()->request()->post();
	}

	//Grab the post
	try {

		$db = dbConnect();


		$sql = "SELECT * FROM superposts WHERE id = ? LIMIT 1";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($post_id));
		$post = $stmt->fetchObject();


		$db = '';

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

	$userIsEditor = userIsEditor($params['username'],$params['timecode'],$params['editor_hash']);


	if ($userIsEditor) {

		$db = dbConnect();

		$sql = "DELETE FROM superposts WHERE id = ? LIMIT 1";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($id));

		$sql = "DELETE FROM superposts WHERE parent = ?";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($id));

		$db = "";


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


		//echo $sql;
	} else {
		echo "NOT EDITOR";
	}




});




function process_attachments($attachmentArray, $parentID) {


	$db2 = dbConnect();

	if (!empty($attachmentArray[0])) {//If there is an single attachment, give the post a thumbnail


		$sql = "UPDATE superposts SET img_url = ? WHERE id = ?";

		$stmt = $db2->prepare($sql);

		$stmt->execute(array($attachmentArray[0]['img_url'] . "/convert?w=300&h=300&fit=crop",$parentID));

		$row = $stmt->fetch(PDO::FETCH_OBJ);

	}

	foreach ($attachmentArray as $attachment) {

		extract($attachment);

		_log("ATTACHMENT DATA:");
		_log($attachment);

		if (empty($attachment['id'])) { //If this attachment has no id, it's not in the database yet. Create a new post for it.

			if (empty($body))
				$body = '';

			$sql = "INSERT INTO superposts (parent,post_type,body,img_url) values (? , ? , ? , ?)";


			$stmt = $db2->prepare($sql);

			$stmt->execute(array($parentID,$post_type,$body,$img_url));

			$row = $stmt->fetch(PDO::FETCH_OBJ);

		} else { //If it does have an id, just update it

			$sql = "UPDATE superposts SET body = ? , img_url = ? WHERE id = ?";

			$stmt = $db2->prepare($sql);

			_log($sql);

			$stmt->execute(array($body,$img_url,$id));

			$row = $stmt->fetch(PDO::FETCH_OBJ);

		}


	}

	$db2 = "";
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
