<?php


$app->get('/users', function () {

	//Default Settings

	$skip = 0; //Start Number
	$per_page = 20;
	$order_by = "user_registered"; //e.g. "score_week","score","score_month","user_registered","post_count"
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

  //IF order_by  is less than 22 characters and is only lowercase letters and underscores
	if (preg_match("/^[a-z_]{1,22}$/", $order_by)) {

		$orderByClause = "ORDER BY $order_by";
	} else {
		header('HTTP 1.1/400 Bad Request', true, 400);
		exit();
	}


	//if sort is a valid sort
	if ($sort == "DESC" || $sort == "ASC" || $sort == "asc" || $sort == "desc") {
		//Those are good sorts!
		$sortClause = $sort;
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


	try {

		$db = dbConnect();


    $sql = "SELECT ID,user_login,user_nicename,user_registered,user_status,display_name,score,score_today,score_week,score_month,comment_count,post_count,CONCAT('users/',community_users.user_nicename) as url FROM community_users $orderByClause $sortClause $limitClause";

		$stmt = $db->prepare($sql);
		$stmt->execute();

		$users = $stmt->fetchAll(PDO::FETCH_OBJ);


		$db = '';

	} catch(PDOException $e) {
    	echo $e->getMessage();
  }


  echo json_encode($users, JSON_NUMERIC_CHECK);

});




//GET a single post by ID
$app->get('/users/:id', function ($id) {



	//Default Settings
	$get_posts = TRUE; // use 1 or 0 in query string
	$get_comments = FALSE; // use 1 or 0 in query string

	header('Access-Control-Allow-Origin: *');


	//Grab the parameters
	$params = \Slim\Slim::getInstance()->request()->get();

	//Overwrite the default settings with the new ones
	extract($params,EXTR_OVERWRITE);


	if (is_numeric($id)) {
		$whereString = "WHERE id = ?";
	} else {
		$whereString = "WHERE user_nicename = ?";
	}


  //Get the user
	try {

		$db = dbConnect();


		$sql = "SELECT ID,user_login,user_nicename,user_registered,user_status,display_name,city,state,score,score_today,score_week,score_month,comment_count,post_count,CONCAT('users/',community_users.user_nicename) as url FROM community_users $whereString ORDER BY id DESC";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($id));

		$users = $stmt->fetchAll(PDO::FETCH_OBJ);



		$db = '';

	} catch(PDOException $e) {
    	echo $e->getMessage();
  }

  $id = $users[0]->ID;


  //If we need to, get the posts
  if ($get_posts) {
    try {

    $db = dbConnect();


    //$sql = "SELECT *,CONCAT(allcounts.post_type,'/',allcounts.id) as url FROM superposts WHERE parent = ? AND post_type IN ('photo','youtube') ORDER BY id ASC";
    $sql = "SELECT * FROM allcounts2 WHERE user_id = ? AND post_type NOT IN ('photo','youtube','comment') ORDER BY id DESC";

    $stmt = $db->prepare($sql);
    $stmt->execute(array($id));

    $posts = $stmt->fetchAll(PDO::FETCH_OBJ);

    //Set the attachments to the post
    $users[0]->posts = $posts;

    $db = '';

  } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }

    //If we need to, get the posts
  if ($get_comments) {
    try {

    $db = dbConnect();


    //$sql = "SELECT *,CONCAT(allcounts.post_type,'/',allcounts.id) as url FROM superposts WHERE parent = ? AND post_type IN ('photo','youtube') ORDER BY id ASC";
    $sql = "SELECT * FROM allcounts2 WHERE user_id = ? AND post_type = 'comment' ORDER BY id DESC";

    $stmt = $db->prepare($sql);
    $stmt->execute(array($id));

    $comments = $stmt->fetchAll(PDO::FETCH_OBJ);

    //Set the attachments to the post
    $users[0]->comments = $comments;

    $db = '';

  } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }


  echo json_encode($users[0],JSON_NUMERIC_CHECK);




  });



