<?php

//*********************************
//**** Get all Posts of a Type from a state ****
//*********************************
$app->get('/api/superpost/state/:state/type/:post_type(/:count(/:start))',function($state,$post_type,$count = 20,$start = 0){




	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();

		$whereClause = "WHERE post_type = ?";

		if ($post_type == "all")
			$whereClause = "WHERE post_type != 'comment' AND post_type != 'answer' AND post_type != 'photo' AND post_type != 'youtube'";

		$limitClause = "LIMIT $start,$count";
		
		$andClause = "AND state = ?";


		$sql = "SELECT * FROM allcounts $whereClause $andClause ORDER BY id DESC $limitClause";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($post_type,$state));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});



//*********************************
//*** Get State Counts for a specific state***
//*********************************
$app->get('/api/superpost/state/counts/:state_id',function($state_id){

	header('Access-Control-Allow-Origin: *');  

	try {

		$db = dbConnect();


		$sql = "SELECT * FROM statecounts where state =  ?";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($state_id));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		
		
		$states = array();
		
		foreach ($posts as $post) {
			$state = $post->state;
			$post_type = $post->post_type;
			$count = $post->count;
			
			$states[$state][$post_type] = $count;
			
			
		
		}
		
		foreach ($states as $stateCode => $stateData) {
			$total = 0;
			foreach ($stateData as $post_type => $count) {
				$total += $count;
			}
			$states[$stateCode]['total'] = $total;
	
		}
		
		echo json_encode($states);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});


//*********************************
//*** Get State Counts for all states***
//*********************************
$app->get('/api/superpost/state/counts/',function(){

	header('Access-Control-Allow-Origin: *');  

	try {

		$db = dbConnect();


		$sql = "SELECT * FROM statecounts";

		$stmt = $db->prepare($sql);
		$stmt->execute();
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		
		
		$states = array();
		$high = 0;
		$low = 100000000;
		
		foreach ($posts as $post) {
			$state = $post->state;
			$post_type = $post->post_type;
			$count = $post->count;
			
			$states[$state][$post_type] = $count;
		
		}
		
		unset($states['']);
		
		foreach ($states as $stateCode => $stateData) {
			$total = 0;
			foreach ($stateData as $post_type => $count) {
				$total += $count;
			}
			$states[$stateCode]['total'] = $total;
			if ($total > $high)
				$high = $total;
				
			if ($total < $low)
				$low = $total;
		}
		
		if ($low >= 100000000) {
			$low = 0;
		}
		
		//Setup colorcode brackets
		
		//Get range
		$range = $high - $low;
		$rangeBlock = $range / 6;
		
		foreach ($states as $stateCode => $stateData) {
		
			$colorcode = 0;
			$total = $stateData['total'];
		
			for ($i = $low; $i <= $high; $i += $rangeBlock) {
				if ($total >= $i)
					$colorcode++;
			}
			
			$states[$stateCode]['colorcode'] = $colorcode;
			
		}
		
		echo json_encode($states);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});
