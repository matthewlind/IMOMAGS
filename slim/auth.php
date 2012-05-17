<?php

function userIsGood($user_login,$givenHash) {

	$salt = "jYSe38xE3:lfsbEV2u.nUB^?80AXr3<%_VA4!)cfX.z";
	$generatedhash = md5($user_login . $salt);

	

	if ($generatedhash == $givenHash && !empty($user_login))
		return true;
	else
		return false;

}