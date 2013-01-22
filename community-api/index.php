<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
require 'Slim/Slim.php';

include 'mysql.php';

\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, and `Slim::delete`
 * is an anonymous function.
 */

// GET a list of posts. 20 by default
//Note, this does not fetch comments or answers
$app->get('/posts', function () {
	//Default Settings
	$post_type = "all";
	$skip = 0;
	$per_page = 20;
	$require_images = FALSE;
	$order_by = "id";
	$sort = "DESC";
	
	//This header allows this file to be accessed via JSON from other domains.
	header('Access-Control-Allow-Origin: *');
	
	//Grab the parameters
	$params = \Slim\Slim::getInstance()->request()->get();
	
	//Overwrite the default settings with the new ones
	extract($params,EXTR_OVERWRITE);
	
	//Validate the parameters to prevent MySQL injection
	if (ctype_lower($post_type) && strlen($post_type) < 20) {
		//If $post_type is all lowercase and it's less than 20 char, it's GOOD
	} else {
		header('HTTP 1.1/400 Bad Request', true, 400);
		exit();
	}
		
	//Make sure these integers are not evil strings
	$per_page = intval($per_page);
	$skip = intval($skip);
	
	if ($require_images) {
		$requireImagesClause = "AND img_url IS NOT NULL";
	} else {
		$requireImagesClause = "";
	}
	
	if ($sort == "DESC" || $sort = "ASC") {
		//Those are good sorts!
		$sortClause = $sort;
	} else {
		header('HTTP 1.1/400 Bad Request', true, 400);
		exit();	
	}
	
	if (preg_match("/^[a-z_]{1,20}$/", $order_by)) {
		//This order is less than 20 characters and is only lowercase letters and underscores
		//That means it's good!
		$orderByClause = "ORDER BY $order_by";
	} else {
		header('HTTP 1.1/400 Bad Request', true, 400);
		exit();			
	}
	
	//Try to query the database
	try {

		$db = dbConnect();

		$postTypeClause = " post_type = '$post_type'";
		
		if ($post_type == "all")
			$postTypeClause = " post_type != 'comment' AND post_type != 'answer' AND post_type != 'photo' AND post_type != 'youtube' ";
			

		$limitClause = "LIMIT $skip,$per_page";
				
		$sql = "SELECT * FROM allcounts WHERE $postTypeClause $requireImagesClause $orderByClause $sortClause $limitClause";


		$stmt = $db->prepare($sql);
		$stmt->execute(array());
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }
});

//GET a single post by ID
$app->get('/posts/:id', function ($id) {
	

});

// POST request to add a new post
$app->post('/posts', function () {
    echo 'This is a POST route';
});

// PUT request to modifiy a post
$app->put('/posts', function () {
    echo 'This is a PUT route';
});

// DELETE request to delete a post
$app->delete('/posts', function () {
    echo 'This is a DELETE route';
});



$app->run();
