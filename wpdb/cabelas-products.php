<?php




$app->get('/products', function () {
	header('Access-Control-Allow-Origin: *');

	$slugClause = "";

	//Grab the parameters
	$params = Slim::getInstance()->request()->get();

	//Overwrite the default settings with the new ones
	extract($params,EXTR_OVERWRITE);


	//sanitize inputs
	if (preg_match("/^[0-9a-z-]{1,42}$/", $slug) && !empty($slug)) {
		$slugClause = "WHERE slug = '$slug' ";
	} else {
	    header('HTTP 1.1/400 Bad Request', true, 400);
	    exit();
	}


	$db = dbConnect();

	$sql = "SELECT * FROM `cabelas_products` $slugClause";



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






