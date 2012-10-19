<?php

//$user_timecode_hash = md5($user_login .$timecode . $salt);

function userIsGood($user_login,$givenHash) {

	$salt = "jYSe38xE3:lfsbEV2u.nUB^?80AXr3<%_VA4!)cfX.z";
	$generatedhash = md5($user_login . $salt);

	

	if ($generatedhash == $givenHash && !empty($user_login))
		return true;
	else
		return false;

}

function postIsRepeat($postHash) {
		try {

		$db = dbConnect();

		
		
		$sql = "SELECT id FROM superposts WHERE posthash = ?";

		$stmt = $db->prepare($sql);
		$stmt->execute(array($postHash));
	
		$posts = $stmt->fetchAll(PDO::FETCH_OBJ);
		
	

		$db = "";
		
		if (count($posts) == 1) {
			return TRUE;
		} else {
			return FALSE;
		}

	} catch(PDOException $e) {
    	return FALSE;
    }
	
}




function userIsEditor($user_login,$timecode,$givenHash) {

	$timeCodeIsValid = FALSE;

	$salt = "jYSe38xE3:lfsbEV2u.nUB^?80AXr3<%_VA4!)cfX.z";
	$editorSalt = "AspenMichiganS252yysSl2*252sgcv222@#@!xx";
	
	
	$generatedhash = md5($user_login .$timecode . $editorSalt);

	$currentTime = time();
	
	if ($currentTime < $timecode + 90)
		$timeCodeIsValid = TRUE;

	if ($generatedhash == $givenHash && !empty($user_login) && !empty($timecode) && $timeCodeIsValid)
		return true;
	else
		return false;

}