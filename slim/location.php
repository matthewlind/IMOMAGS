<?php





//*********************************
//*** Autocomplete City ***
//*********************************
$app->get('/api/superpost/autocomplete/city/:search_string',function($search_string){

	header('Access-Control-Allow-Origin: *');  

	try {

		$db = dbConnect();



		$sql = "select CONCAT (name , ', ' , parent_1) as city from us_cities 
				WHERE name like ? and parent_1 <> ''
				ORDER BY name ASC LIMIT 20";

		$stmt = $db->prepare($sql);
		$stmt->execute(array("$search_string%"));
	
		$cities = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($cities);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});