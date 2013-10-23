<?php
$gallery = $_GET['gallery'];
global $wpdb;
$prefix = $wpdb->prefix;
//echo do_shortcode('[imo-slideshow gallery=43]');
//imo_flex_gallery($_GET['gallery'], false);
//include('plugin.php');
  	$pictures = $wpdb->get_results($wpdb->prepare(
      "SELECT * , CONCAT('/' , path, '/' , filename) as img_url, CONCAT('/' , path, '/thumbs/thumbs_' , filename) as thumbnail, meta_data, pictures.description as photo_desc
      from {$prefix}ngg_gallery as gallery
      JOIN `{$prefix}ngg_pictures` as pictures ON (gallery.gid = pictures.galleryid)
      WHERE gallery.gid = %d
      ORDER BY sortorder asc",
      $gallery
      )
    );
	foreach ($pictures as $picture) {
	echo $picture->img_url;
	}
	echo 'done';
?>