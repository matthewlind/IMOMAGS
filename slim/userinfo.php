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


		$sql = "select * from slim.allcounts as posts
				JOIN imomags.wp_users as users on (users.`ID` = posts.user_id)
				WHERE users.ID = ?
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


		$sql = "select score from slim.userscore as userscore
				JOIN imomags.wp_users as users on (users.`ID` = userscore.user_id)
				WHERE users.ID = ?
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