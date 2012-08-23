<?php



//Resizes images, returns thumbnail URL
function resizeImages($localImage, $isVideo = false){

	$DOMAIN = "deva";

	$portrait = false;
	$landscape = false;

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
		$landscape = TRUE;

	} else { //if portrait
		$left = 0;
		$top = ($current_height - $current_width) / 2;
		$crop_height = $current_width;
		$crop_width = $current_width;
		$portrait = TRUE;

	}

	//Create the new image
	$canvas = imagecreatetruecolor($crop_width, $crop_height);
	
	//get the file extension
	$file_extension = pathinfo($filename, PATHINFO_EXTENSION);
	$file_extension = strtolower($file_extension);
	
	if ($file_extension == "jpg" || $file_extension == "jpeg")
		$current_image = imagecreatefromjpeg($filename);
	
	if ($file_extension == "png")
		$current_image = imagecreatefrompng($filename);
		
	if ($file_extension == "gif")
		$current_image = imagecreatefromgif($filename);

	//Before Crop, Save Full Size Image
	//resize image but keep aspect ratio
	$dir = "full";
	if (!is_dir("images/$dir/" . $subDir)) 
			mkdir("images/$dir/" . $subDir);

	if ($current_height > 2600 || $current_width > 2600) { //if images needs to be shrunk, then shrink it
		if ($portrait) {
			$newHeight = 2600;
			$newWidth = (2600 * $current_width) / $current_height;
		}
		if ($landscape) {
			$newWidth = 2600;
			$newHeight = (2600 * $current_height) / $current_width;
		}
	} else { //else, just keep the sizes
		$newWidth = $current_width;
		$newHeight = $current_height;
	}

	$resized_image = imagecreatetruecolor($newWidth, $newHeight);
	imagecopyresampled($resized_image, $current_image, 0, 0, 0, 0, $newWidth, $newHeight, $current_width, $current_height);
	imagejpeg($resized_image, "images/$dir/$subDir/$imageName.jpg", 80);

	//Then, do the same for medium size
	$dir = "medium";
	if (!is_dir("images/$dir/" . $subDir)) 
			mkdir("images/$dir/" . $subDir);

	if ($current_height > 1024 || $current_width > 1024) { //if images needs to be shrunk, then shrink it
		if ($portrait) {
			$newHeight = 1024;
			$newWidth = (1024 * $current_width) / $current_height;
		}
		if ($landscape) {
			$newWidth = 1024;
			$newHeight = (1024 * $current_height) / $current_width;
		}
	} else { //else, just keep the sizes
		$newWidth = $current_width;
		$newHeight = $current_height;
	}

	$resized_image = imagecreatetruecolor($newWidth, $newHeight);
	imagecopyresampled($resized_image, $current_image, 0, 0, 0, 0, $newWidth, $newHeight, $current_width, $current_height);
	imagejpeg($resized_image, "images/$dir/$subDir/$imageName.jpg", 80);


	// Crop the image
	imagecopy($canvas, $current_image, 0, 0, $left, $top, $current_width, $current_height);




	// Resample
	foreach ($imageSizes as $dir => $new_size) {

		if (!is_dir("images/$dir/" . $subDir)) 
			mkdir("images/$dir/" . $subDir);

		$canvasResized = imagecreatetruecolor($new_size, $new_size);
		imagecopyresampled($canvasResized, $canvas, 0, 0, 0, 0, $new_size, $new_size, $crop_width, $crop_height);

		//If there is video
		if ($isVideo) {

			if ($dir == "retina_thumb") {
				$videoMark = imagecreatefrompng("resources/play_button_retina.png");
				imagecopy($canvasResized, $videoMark, 0, 0, 0, 0, $new_size, $new_size);
			}

			if ($dir == "thumb") {
				$videoMark = imagecreatefrompng("resources/play_button.png");
				imagecopy($canvasResized, $videoMark, 0, 0, 0, 0, $new_size, $new_size);
			}

		}

		imagejpeg($canvasResized, "images/$dir/$subDir/$imageName.jpg", 80);


	}

	$thumbURL = "/slim/images/thumb/$subDir/$imageName.jpg";

	return $thumbURL;
}


