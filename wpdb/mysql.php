<?php
function dbConnect() {

/*** mysql hostname ***/
$hostname = '74.217.47.93';

/*** mysql username ***/
$username = 'imomags-wp';

/*** mysql password ***/
$password = 'poyZCVe4578dEMM';

/*** mysql database ***/
$database = 'imomags';

	try {
	    $db = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password);
	    
	     return $db;

    } catch(PDOException $e) {
    	echo $e->getMessage();
    }
}

function dbClose(&$db) {

	$db = "";
}
?>
