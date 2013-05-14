<?php




$app->get('/products', function () {
	header('Access-Control-Allow-Origin: *');

	$slugClause = "";

	//Grab the parameters
	$params = Slim::getInstance()->request()->get();

	//Overwrite the default settings with the new ones
	extract($params,EXTR_OVERWRITE);

	$site = $_SERVER['SERVER_NAME'];

	if (strstr($site,"in-fisherman")) {

	}


	//sanitize inputs
	if (!empty($slug) && preg_match("/^[0-9a-z-,]{1,42}$/", $slug)) {


		//Set default inputs for certain sites:
		if (strstr($site,"in-fisherman") && !strstr($slug,"bass")) {
			$slug = "fresh-water,freshwater";
		}
		if (strstr($site,"flyfisherman")) {
			$slug = "flyfishing";
		}
		if (strstr($site,"floridasportsman")) {
			$slug = "saltwater";
		}


		$slugParts = explode(",",$slug);
		$slugArrayString = "";

		foreach ($slugParts as $slug) {
			$slugArrayString .= "'$slug',";
		}

		$slugArrayString = rtrim($slugArrayString,",");

		$slugClause = "WHERE slug IN ($slugArrayString) ";



	}





	$db = dbConnect();

	$sql = "SELECT * FROM `cabelas_products` $slugClause ORDER BY slug,weight";

	//echo $sql;

	$stmt = $db->prepare($sql);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_OBJ);

	echo json_encode($data);

	$db = "";


});


$app->get('/products/slug/:slug', function ($slug) {
	header('Access-Control-Allow-Origin: *');


	//sanitize inputs
	if (preg_match("/^[0-9a-z-]{1,42}$/", $slug)) {
	} else {
	    header('HTTP 1.1/400 Bad Request', true, 400);
	    exit();
	}

	$db = dbConnect();

	$sql = "SELECT * FROM `cabelas_products` WHERE slug = '$slug'";

	//echo $sql;

	$stmt = $db->prepare($sql);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_OBJ);

	echo json_encode($data);

	$db = "";


});



//GET a single post by ID
$app->get('/products/:id', function ($id) {
	header('Access-Control-Allow-Origin: *');

	if (is_numeric($id)) {
	} else {
	    header('HTTP 1.1/400 Bad Request', true, 400);
	    exit();
	}

	$db = dbConnect();

	$sql = "SELECT * FROM `cabelas_products` WHERE id = $id";

	//echo $sql;

	$stmt = $db->prepare($sql);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_OBJ);

	echo json_encode($data);

	$db = "";

});


// POST request to ADD a new post
$app->post('/products',function() {
	header('Access-Control-Allow-Origin: *');

	//$params = Slim\Slim::getInstance()->request()->post();

	$requestJSON = Slim::getInstance()->request()->getBody();

	$params = json_decode($requestJSON,true);

	extract($params,EXTR_OVERWRITE);


	$userIsEditor = userIsEditor($params['username'],$params['timecode'],$params['editor_hash']);

	//Get the user info and authenticate
	if (!$userIsEditor) {
	    header('HTTP 1.1/400 Bad Request', true, 400);
	    echo "BAD USER AUTH";
	    exit();
	}



	$sql = "INSERT into cabelas_products (product_name,product_url,product_img,slug,weight) VALUES (\"$product_name\",'$product_url','$product_img','$slug','$weight')";
		echo $sql;
	$db = dbConnect();
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$db = "";



});



//UPDATE a single post by ID
$app->put('/products/:id', function ($id) {
	header('Access-Control-Allow-Origin: *');

	if (is_numeric($id)) {
	} else {
	    header('HTTP 1.1/400 Bad Request', true, 400);
	    exit();
	}


	$requestJSON = Slim::getInstance()->request()->getBody();

	$params = json_decode($requestJSON,true);

	extract($params,EXTR_OVERWRITE);


	$userIsEditor = userIsEditor($params['username'],$params['timecode'],$params['editor_hash']);

	//Get the user info and authenticate
	if (!$userIsEditor) {
	    header('HTTP 1.1/400 Bad Request', true, 400);
	    echo "BAD USER AUTH";
	    exit();
	}



	$sql = "REPLACE into cabelas_products (id,product_name,product_url,product_img,slug,weight) VALUES ('$id',\"$product_name\",'$product_url','$product_img','$slug','$weight')";
		echo $sql;
	$db = dbConnect();
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$db = "";


});

// DELETE request to delete a post
$app->delete('/products/:id', function ($id) {
	header('Access-Control-Allow-Origin: *');

	$requestJSON = Slim::getInstance()->request()->getBody();

	$params = json_decode($requestJSON,true);

	$userIsEditor = userIsEditor($params['username'],$params['timecode'],$params['editor_hash']);


	if ($userIsEditor) {

		$db = dbConnect();

		$sql = "SELECT FROM cabelas_products WHERE id = ? LIMIT 1";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($id));
		$data = $stmt->fetchAll(PDO::FETCH_OBJ);

		$sql = "DELETE FROM cabelas_products WHERE id = ? LIMIT 1";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($id));

		$db = "";

		echo json_encode($data);

	} else {
	    header('HTTP 1.1/400 Bad Request', true, 400);
	    echo "BAD USER AUTH";
	    exit();
	}


});






function sanitizeURL($url) {
	if (preg_match("\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))", $url)) {

		return $url;
	} else {
	    header('HTTP 1.1/400 Bad Request', true, 400);
	    echo "Bad URL: $url";
	    exit();
	}

}


function sanitizeText($text) {

	if ($text) {

		return mysqli_real_escape_string($text);
	} else {
		echo "bad slug: $slug";
	    header('HTTP 1.1/400 Bad Request', true, 400);
	    exit();
	}
}


function sanitizeSlug($slug) {

	if (preg_match("/^[0-9a-z-]{1,42}$/", $slug)) {

		return $slug;
	} else {
		echo "bad slug: $slug";
	    header('HTTP 1.1/400 Bad Request', true, 400);
	    exit();
	}
}








