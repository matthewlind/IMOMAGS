<?php 
$code = $_GET['ad_code'];
$title = $_GET['gallery_title'];
?>
<html>
<head>
<script type='text/javascript'>
(function() {
var useSSL = 'https:' == document.location.protocol;
var src = (useSSL ? 'https:' : 'http:') +
'//www.googletagservices.com/tag/js/gpt.js';
document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
})();
</script>
<script type='text/javascript'>

googletag.defineSlot('/4930/<?php echo $code; ?>/Photo_Gallery_Medium_Rectangle', [300, 250], 'div-photo_gallery_medium_rectangle').addService(googletag.pubads());

googletag.pubads().setTargeting("sect","<?php echo $title; ?>");
googletag.pubads().setTargeting("Audience segment","<?php echo $title; ?>");

googletag.pubads().enableSingleRequest();
googletag.pubads().enableSyncRendering();

googletag.pubads().enableVideoAds();
googletag.enableServices();


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
