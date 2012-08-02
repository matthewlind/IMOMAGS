<?php
function dbConnect() {

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = '';

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