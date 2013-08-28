<?php

$app->get('/posts/counts', function () {

	//Default Settings
	$post_type = "all"; // e.g. "report","question"
	$state = NULL; // e.g. "GA","NY"
	$skip = 0; //Start Number
	$per_page = 20;
	$require_images = FALSE; //Only return posts with images, use 1 or 0 in query string
	$order_by = "id"; //e.g. "created","view_count"
	$sort = "DESC";
	$domain = convertDevDomainToDotCom($_SERVER['HTTP_HOST']);

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


	//Check if Valid domain

	if (preg_match("/^(?:[a-zA-Z0-9]+(?:\-*[a-zA-Z0-9])*\.)+[a-zA-Z]{2,6}$/", $domain)) {

		$domainClause = "and domain = '$domain'";
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


		$sql = "SELECT count(*) as post_count FROM allcounts2 WHERE $postTypeClause $stateClause $domainClause $requireImagesClause $orderByClause $sortClause ";



		$stmt = $db->prepare($sql);
		$stmt->execute(array());

		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts,JSON_NUMERIC_CHECK);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }
});
