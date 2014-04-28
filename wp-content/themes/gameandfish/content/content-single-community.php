<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
$postID = get_the_ID();
$byline = get_post_meta($postID, 'ecpt_byline', true);
?>

<style type="text/css" media="screen">
	.flex-direction-nav{
		display:none;
	}
	
	#photoTopControls .sliderPrev{
		display: inline-block;
		width: 33px;
		height: 46px;
		border-radius:3px;
		border:1px solid #5A5A5A;
		cursor:pointer;
		background: #5A5A5A url('http://www.gameandfishmag.com/wp-content/plugins/imo-flex-gallery/img/imo-flex-next-prev.png') no-repeat -3px 9px !important;
	}
	
	#photoTopControls .sliderNext{
		display: inline-block;
		width: 33px;
		height: 46px;
		border-radius:3px;
		border:1px solid #5A5A5A;
		cursor:pointer;
		background: #5A5A5A url('http://www.gameandfishmag.com/wp-content/plugins/imo-flex-gallery/img/imo-flex-next-prev.png') no-repeat -43px 9px !important;
	}
	
	.flex-slide img {
		position: relative;
		display: inline !important;
		max-width: 99.5%;
		width: auto;
		height: auto !important;
		max-height: 435px;
		vertical-align: middle;
	}
	
	#photoAlbumGallery #carousel .slides img{
		width:75px !important;
	}
	
	#photoAlbumGallery .the_slide{
		text-align:center;
	}
	
	#photoAlbumGallery .flex-slide img{
		width:auto !important;
	}
</style>

<div class="spinner">
  <h2>Loading, Please Wait.</h2>
</div>
<div id="photoTopControls" style="text-align: right;">
	<div class="sliderPrev"></div>
	<div class="sliderNext"></div>
</div>
<div>
  Like Goes Here
</div><div id="photoAlbumGallery">
	<div id="slider" class="flexslider">
		<ul class="slides"></ul>
	</div>
	
	<div id="carousel" class="flexslider">
		<ul class="slides"></ul>
	</div>
</div>