<?php

//Resizes images, returns thumbnail URL
function resizeImages($localImage){

	$DOMAIN = "deva";

	$imageName = uniqid();
	$subDir = substr($imageName, 0,2);

	$imageSizes = array();
	$imageSizes['thumb'] = 350;
	$imageSizes['retina_thumb'] = 700;

	// Original image
	$filename = $localImage;

	// Get dimensions of the original image
	list($current_width, $current_height) = getimagesize($filename);

	// The x and y coordinates on the original image where we
	// will begin cropping the image
	$left = $current_width/2;
	$top = $current_height/2;

	// This will be the final size of the image (e.g. how many pixels
	// left and down we will be going)


	if ($current_width > $current_height) { //If landscape
		$top = 0;
		$left = ($current_width - $current_height) / 2;
		$crop_width = $current_height;
		$crop_height = $current_height;

	} else { //if portrait
		$left = 0;
		$top = ($current_height - $current_width) / 2;
		$crop_height = $current_width;
		$crop_width = $current_width;

	}

	//Create the new image
	$canvas = imagecreatetruecolor($crop_width, $crop_height);
	$current_image = imagecreatefromjpeg($filename);

	//Before Crop, Save Full Size Image
	$dir = "full";
	if (!is_dir("images/$dir/" . $subDir)) 
			mkdir("images/$dir/" . $subDir);

	imagejpeg($current_image, "images/$dir/$subDir/$imageName.jpg", 80);



	// Crop the image
	imagecopy($canvas, $current_image, 0, 0, $left, $top, $current_width, $current_height);



	// Resample
	foreach ($imageSizes as $dir => $new_size) {

		if (!is_dir("images/$dir/" . $subDir)) 
			mkdir("images/$dir/" . $subDir);

		$canvasResized = imagecreatetruecolor($new_size, $new_size);
		imagecopyresampled($canvasResized, $canvas, 0, 0, 0, 0, $new_size, $new_size, $crop_width, $crop_height);

		imagejpeg($canvasResized, "images/$dir/$subDir/$imageName.jpg", 80);


	}

	$thumbURL = "/slim/images/thumb/$subDir/$imageName.jpg";

	return $thumbURL;
}


