<?php


$string2 = 'a:41:{s:5:"title";s:10:"Big Cheese";s:12:"photo-upload";s:24:"C:\\fakepath\\happykid.png";s:4:"meta";s:14:"redear-sunfish";s:5:"state";s:2:"ID";s:6:"weight";s:2:"23";s:6:"length";s:0:"";s:4:"zone";s:1:"3";s:10:"first_name";s:5:"Bobby";s:9:"last_name";s:5:"Jones";s:5:"email";s:16:"bjones@gmail.cmo";s:13:"confirm-email";s:16:"bjones@gmail.com";s:16:"street_address_1";s:13:"65 The By Way";s:16:"street_address_2";s:0:"";s:4:"city";s:7:"Atlanta";s:13:"state_address";s:7:"Georgia";s:3:"zip";s:5:"30303";s:5:"phone";s:12:"505-234-6342";s:5:"month";s:2:"10";s:3:"day";s:2:"23";s:4:"year";s:4:"1234";s:13:"body_of_water";s:12:"Chicory Lake";s:12:"nearest_town";s:12:"Pantherville";s:12:"kind_of_lure";s:6:"Cheese";s:4:"kept";s:1:"0";s:14:"yes_newsletter";s:1:"1";s:10:"yes_offers";s:1:"1";s:8:"username";s:13:"aaronbaker122";s:7:"user_id";s:4:"7123";s:8:"userhash";s:32:"514561c6872525f3958db579ab4d1610";s:13:"gravatar_hash";s:32:"5f4d99fbe16dfb6512dd4c01e0706e26";s:8:"timecode";s:10:"1386783640";s:13:"timecode_hash";s:32:"b4ae2a0c6bddc12808ee4375e9750a16";s:12:"display_name";s:11:"Aaron Baker";s:11:"facebook_id";s:10:"1070221586";s:13:"default_state";s:2:"GA";s:5:"perms";s:6:"editor";s:11:"editor_hash";s:32:"25e93713d2a2fc455c6d78f47b80d1c6";s:18:"user_timecode_hash";s:32:"158189a04f92f4ed1be2f8acafd137d4";s:6:"master";s:1:"1";s:7:"img_url";s:55:"https://www.filepicker.io/api/file/anjsWphTSNafMetJLoac";s:9:"post_type";s:7:"panfish";}';

$params = unserialize($string2);

print_r($params);


	$string = "<b>Name:</b><br>" . $params['first_name'] . " " . $params['last_name'] . "<p>";

	$string .= "<b>Email:</b><br>" . $params['email'] . "<p>";


	$string .= "<b>Address:</b><br>" . $params['street_address_1'] . "\n" . $params['street_address_2'] . "<br>";
	$string .= $params['city'] . ", " . $params['state_address'] . " " . $params['zip'] . "<p>";

	$string .= "<b>Phone:</b><br>" . $params['phone'] . "<p>";

	$string .= "<b>Title:</b><br>" . $params['title'] . "<p>";
	$string .= "<b>Your Story:</b><br>" . $params['body'] . "<p>";

	$string .= "<b>Species:</b><br>" . $params['meta'] . "<p>";

	$string .= "<b>Region:</b><br>" . $params['zone'] . "<p>";
	$string .= "<b>Date Caught:</b><br>" . $params['month'] . "/" . $params['day'] . "/" . $params['year'] . "<p>";

	$string .= "<b>Body of Water:</b><br>" . $params['body_of_water'] . "<p>";
	$string .= "<b>Nearest Town:</b><br>" . $params['nearest_town'] . "<p>";
	$string .= "<b>State Caught:</b><br>" . $params['state'] . "<p>";

	$string .= "<b>Length:</b><br>" . $params['length'] . "<p>";
	$string .= "<b>Weight:</b><br>" . $params['weight'] . "<p>";

	$string .= "<b>Lure or Bait:</b><br>" . $params['kind_of_lure'] . "<p>";

	$kORr = "released";
	if ($params['kept'] == 1)
		$kORr = "kept";

	$url = "http://www.in-fisherman.com/photos/" . $params['post_id'];

	$string .= "<b>Kept or Released:</b><br>" . $kORr . "<p>";

	$string .= "<b>Entry URL:</b><br><a href='". $url . "'>" . $url . "</a><p>";

	$string .= "<b>Photo:</b><br><img src='" . $params['img_url'] . "/convert?w=600&fit=scale&rotate=exif'><p>";


	echo $string;