<?php header('Content-Type: text/javascript'); ?>
<?php

if (!function_exists('add_action'))
{
    require_once("../../../../../../wp-config.php");
}
?>
<?php
global $wpdb;
/*
 *
 */
$querystr = "SELECT * FROM wp_posts where post_type = 'attachment' and post_mime_type LIKE '%image%'";

$pageposts = $wpdb->get_results($querystr, OBJECT);

$i=1;

?>

var tinyMCEImageList = new Array(
    <?php foreach($pageposts as $post) :?>
    ["<?php echo $post->post_name; ?>","<?php echo $post->guid; ?>"]<?php if ($i<count($pageposts)) echo ',';$i++ ?>
    <?php endforeach; ?> 
);