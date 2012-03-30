<?php

//*********************************
//*** Get Specific Post with ID ***
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