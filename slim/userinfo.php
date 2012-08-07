<?php

//*********************************
//*** Get User Counts ***
//*********************************
$app->get('/api/superpost/user/counts/:user_id',function($user_id){

	header('Access-Control-Allow-Origin: *');  

	try {

		$db = dbConnect();


		$sql = "SELECT post_type,count FROM usercounts WHERE user_id = ?";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($user_id));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});


//*********************************
//*** Get All Posts by a user ***
//*********************************
$app->get('/api/superpost/user/posts/:userid',function($userid){

	header('Access-Control-Allow-Origin: *');  

	try {

		$db = dbConnect();
		
		if (is_numeric($userid)) {
			$whereClause = "WHERE users.ID = ?";
		} else {
			$whereClause = "WHERE users.user_nicename = ?";

		}


		$andClause = "AND post_type != 'comment' AND post_type != 'answer' AND post_type != 'photo' AND post_type != 'youtube'";

		$sql = "select * from slim.allcounts as posts
				JOIN imomags.wp_users as users on (users.`ID` = posts.user_id)
				$whereClause
				$andClause
				";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($userid));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});


//*********************************
//*** Get All Comments by a user ***
//*********************************
$app->get('/api/superpost/user/comments/:userid',function($userid){

	header('Access-Control-Allow-Origin: *');  

	try {

		$db = dbConnect();
		
		if (is_numeric($userid)) {
			$whereClause = "WHERE users.ID = ?";
		} else {
			$whereClause = "WHERE users.user_nicename = ?";

		}

		$sql = "select posts.id, posts.body as comment_body, posts.share_count as shares, posts.created as date, parent.post_type as rent_type from slim.allcounts as posts
		
				JOIN imomags.wp_users as users on (users.`ID` = posts.user_id)
				
				JOIN slim.allcounts as parent on (posts.parent = parent.id)
				
				$whereClause
				
				AND posts.post_type = 'comment'
		
				";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($userid));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});

//*********************************
//*** Get User Score ***
//*********************************
$app->get('/api/superpost/user/score/:userid',function($userid){

	header('Access-Control-Allow-Origin: *');  

	try {

		$db = dbConnect();
		
		
		if (is_numeric($userid)) {
			$whereClause = "WHERE users.ID = ?";
		} else {
			$whereClause = "WHERE users.user_nicename = ?";

		}


		$sql = "select score from slim.userscore as userscore
				JOIN imomags.wp_users as users on (users.`ID` = userscore.user_id)
				$whereClause
				";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($userid));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});