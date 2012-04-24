<?php
/**
 * subscribeHeader.php
 *
 * Html formatting template for the subscribe widgets.
 */
$magazine_img = get_option("magazine_cover_uri", get_stylesheet_directory_uri(). "/img/magazine.png" );
if (empty($magazine_img)) {
    $magazine_img = get_stylesheet_directory_uri(). "/img/magazine.png";
}
?>

<!-- Header Widget -->
<div id="header-sub" class="subscription-block"> 
	<div class='right' >
	<a href="<?php print get_option("subs_link");?>"><img src='<?php print $magazine_img; ?>' alt="Magazine Cover"></a> 
	</div> 
	<div class="left" >
	<p class='title'><?php print get_option("deal_copy", "Save up to 70%<br/> Off the Cover Price!"); ?></p> 
		<p ><a href="<?php print get_option("subs_link"); ?>" target="_blank">Subscribe Now!</a></p> 
		<p style="margin-bottom:2px;"><a href="<?php print get_option("gift_link");?>" target="_blank">Give a Gift</a></p> 
		<p><a href="<?php print get_option("service_link"); ?>" target="_blank">Subscriber Services</a></p> 
	</div>	
</div> 
<!-- End Header Widget -->
