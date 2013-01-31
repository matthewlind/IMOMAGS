<?php

function extractVideoID($dataString) {

	error_log($dataString);

	preg_match('#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $dataString, $matches);
	return $matches[2];
}

function getYoutubeVideo($videoID) {

	$video = array();

	$video['embed'] = '<iframe width="480" height="360" src="http://www.youtube.com/embed/' . $videoID . '" frameborder="0" allowfullscreen></iframe>';
	$video['thumbnailUrl'] = "http://i.ytimg.com/vi/$videoID/0.jpg";

	$img = "images/tmp/$videoID.jpg";
	if (file_put_contents($img, file_get_contents($video['thumbnailUrl']))) {
		$video['temp_image_path'] = $img;
	} else {
		$video['temp_image_path'] = false;
	}
	


	return $video;
}