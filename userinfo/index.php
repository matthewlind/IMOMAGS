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
include 'mysql.php';
/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, and `Slim::delete`
 * is an anonymous function.
 */
 
$response = $app->response();
$response['Content-Type'] = 'application/json';

$app->get('/hometown(/:userid)', function ($userid) {
	//$sort = mysql_real_escape_string($sort);
	date_default_timezone_set('America/New_York'); 
    header('Access-Control-Allow-Origin: *');  

    try {

        $db = dbConnect();
        
        $sql = "(SELECT meta_key,meta_value FROM wp_usermeta WHERE meta_key = 'city' AND user_id = ?)UNION(SELECT meta_key,meta_value FROM wp_usermeta WHERE meta_key = 'state' AND user_id = ?)";
        
        $stmt = $db->prepare($sql);
		$stmt->execute(array($userid,$userid));
	
		$data = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($data);
		
		$db = "";
	
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
});







$app->run();
