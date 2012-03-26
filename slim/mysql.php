<?php
function dbConnect() {

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = '';

/*** mysql database ***/
$database = 'slim';

	try {
	    $db = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
	    
	     return $db;

    } catch(PDOException $e) {
    	echo $e->getMessage();
    }
}

function dbClose(&$db) {

	$db = "";
}



?>