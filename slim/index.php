<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$DOMAIN = "deva";

require 'Slim/Slim.php';
include 'mysql.php';
include 'auth.php';
include 'images.php';

$app = new Slim();


function get_IP() {
	$headers = apache_request_headers(); 
	$XFFip = $headers["X-Forwarded-For"];

	if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1")
		return $XFFip;
	else
		return $_SERVER['REMOTE_ADDR'];

}


$app->get('/',function(){
	echo "<h1>Hello Berry!</h1>";
});



//*********************************
//********* Get all Posts *********
//*********************************
$app->get('/api/superpost/all(/:count(/:start/))',function($count = 20,$start = 0){

	header('Access-Control-Allow-Origin: *');  

	try {

		$db = dbConnect();

		$sql = "SELECT * FROM superposts ORDER BY id DESC";
		$stmt = $db->query($sql);
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});

//*********************************
//**** Get all Posts of a Type ****
//*********************************
$app->get('/api/superpost/type/:post_type',function($post_type){

	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();


		$sql = "SELECT * FROM superposts WHERE post_type = ? ORDER BY id DESC";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($post_type));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});



//*********************************
//*** Get Specific Post with ID ***
//*********************************
$app->get('/api/superpost/post/:id',function($id){

	header('Access-Control-Allow-Origin: *');  

	try {

		$db = dbConnect();


		$sql = "SELECT * FROM superposts WHERE id = ? ORDER BY id DESC";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($id));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});

//**************************************
//**** Get all Child Posts of a Type ***
//**************************************
$app->get('/api/superpost/children/:post_type/:parent_id',function($post_type,$parent_id){

	header('Access-Control-Allow-Origin: *');

	try {

		$db = dbConnect();


		$sql = "SELECT * FROM superposts WHERE post_type = ? AND parent = ? ORDER BY id DESC";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($post_type,$parent_id));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);

		echo json_encode($posts);

		$db = "";

	} catch(PDOException $e) {
    	echo $e->getMessage();
    }

});




//*********************************
//**********Add new Posts**********
//*********************************
$app->post('/api/superpost/add',function() {
	header('Access-Control-Allow-Origin: *');

	$params = Slim::getInstance()->request()->post();

	

	//Get the user info an authenticate
	if (userIsGood($params['username'],$params['userhash'])) {

		//Set additional parameters
		$params['ip'] = ip2long(get_IP());

		
		//Handle the uploaded file
		$fileName = $_FILES['photo-upload']['name'];
		$tmpName = $_FILES['photo-upload']['tmp_name'];

		$target_path = "images/tmp/";
		$target_path = $target_path . basename( $fileName ); 
		
		$imgURL = "";
		if (!empty($_FILES['photo-upload']['name'])) { //Check if file exists
			if(move_uploaded_file($tmpName, $target_path)) { //check if file upload failed
				//Then resize and move the file!
				$imgURL = resizeImages($target_path);
			} else{
			    error_log("There was an error uploading the file, please try again!");
			}
		}
	
		$paramList = array(
			"parent",
			"post_type",
			"title",
			"body",
			"user_id",
			"username",
			"gravatar_hash",
			"img_url",
			"ip",
			"state",
			"video_url"
		);

		if (!empty($fileName)) {
			$params['img_url'] = $imgURL;
		}
		
		$db = dbConnect();

		//BUILD THE PERFECT QUERY FOR THE PARAMETERS GIVEN
		$sql = "INSERT INTO superposts (";
		$sql2 = "VALUES (";

		foreach ($paramList as $parameter) {

			if (!empty($params[$parameter])) {
				$sql .= $parameter . ",";
				$sql2 .= ":$parameter,";
			}
		}

		$sql = substr_replace($sql ,"",-1);
		$sql2 = substr_replace($sql2 ,"",-1);

		$sql .= ") ";
		$sql2 .= ")";

		$sql = $sql . $sql2;

		$stmt = $db->prepare($sql);



		foreach ($paramList as $parameter) {

			if (!empty($params[$parameter])) {
				$stmt->bindParam($parameter,$params[$parameter]);
			}
		}


		//THIS IS THE END RESULT OF THE ABOVE LOOP MADNESS:
		//$sql = "INSERT INTO superposts (parent, post_type, title, body, img_url, author_id, author, gravatar_hash) 
		//                       VALUES (:parent,:post_type,:title,:body,:img_url,:author_id,:author,:gravatar_hash)";

		// $stmt->bindParam("parent",$params['parent']);
		// $stmt->bindParam("post_type",$params['post_type']);
		// $stmt->bindParam("title",$params['title']);
		// $stmt->bindParam("body",$params['body']);
		
		// $stmt->bindParam("user_id",$params['user_id']);
		// $stmt->bindParam("username",$params['username']);
		// $stmt->bindParam("gravatar_hash",$params['gravatar_hash']);


			

        $stmt->execute();
        $superpostID = $db->lastInsertId();

		$db = "";

		$params['id'] = $superpostID;
		$response = $params;

		$params['ip'] = long2ip($params['ip']);

		echo json_encode($response);

	

	} else { //if user is not good
		json_encode("nope");
	}

});










$app->run();