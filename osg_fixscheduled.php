<?php

$db = new mysqli('74.217.47.93','imomags-wp','poyZCVe4578dEMM','imomags');
$db->autocommit(TRUE);

$blogs = array(
	 "2", //gunsandammo
	 "3", //bowhunter
	 "4", //petersensbowhunting
	 "5", //gundog
	 "6", //northamericanwhitetail
	 "7", //petersenshunting
	 "8", //wildfowl
	 "9", //handguns
	"10", //rifleshooter
	"11", //shootingtimes
	"12", //firearmsnews
	//"13", //floridasportsman
	"14", //gameandfish
	"15", //infisherman
	"16" //flyfisherman
	
);

foreach($blogs as $blog) {
	
	$sql = "UPDATE wp_".$blog."_posts SET post_status = 'publish' WHERE post_status = 'future' AND post_date < NOW();";
	$result = $db->query($sql);
	
}

?>
