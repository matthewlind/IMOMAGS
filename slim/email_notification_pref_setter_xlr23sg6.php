<?php


include 'mysql.php';

$db = dbConnect();


$sql = "DELETE FROM `wp_usermeta` WHERE `meta_key` = 'send_community_updates';";
$stmt = $db->prepare($sql);
$stmt->execute();

$sql = "SELECT * from imomags.wp_users";
$stmt = $db->prepare($sql);
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_OBJ);

foreach ($users as $user) {


	$sql2 = "REPLACE INTO imomags.wp_usermeta (user_id,meta_key,meta_value) VALUES ($user->ID,'send_community_updates',1)";

	echo $sql2 . "<br>";

	$stmt2 = $db->prepare($sql2);
	$stmt2->execute();
}


$db = "";