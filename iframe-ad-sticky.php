<?php 
$code = $_GET['ad_code'];

if (!empty($_GET['size'])) {
  $size = $_GET['size'];
} else {
  $size = "300x250";
}
?>
<html>
<head>
<script type='text/javascript'>
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
(function() {
var gads = document.createElement('script');
gads.async = true;
gads.type = 'text/javascript';
var useSSL = 'https:' == document.location.protocol;
gads.src = (useSSL ? 'https:' : 'http:') + 
'//www.googletagservices.com/tag/js/gpt.js';
var node = document.getElementsByTagName('script')[0];
node.parentNode.insertBefore(gads, node);
})();
</script>
<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/4930/<?php echo $code; ?>/Photo_Gallery_Medium_Rectangle', [[300, 250], [320, 50]], 'div-photo_gallery_medium_rectangle').addService(googletag.pubads());

googletag.pubads().enableSingleRequest();
googletag.pubads().enableVideoAds();
googletag.enableServices();
});
</script>

</head>
<body>
<div id='div-photo_gallery_medium_rectangle'>
		<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-photo_gallery_medium_rectangle'); });
		</script>
	</div>

</body>
</html>
