<?php 
$code = $_GET['ad_code'];
$bracket = $_GET['bracket'];
$size = $_GET['size'];

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
googletag.defineSlot('/4930/<?php echo $code; ?>/<?php echo $bracket; ?>/<?php echo $size; ?>', [300, 250], 'div-<?php echo $size; ?>').addService(googletag.pubads());

googletag.pubads().setTargeting("sect","<?php echo $bracket; ?>");
googletag.pubads().setTargeting("Audience segment","<?php echo $bracket; ?>");

googletag.pubads().enableSingleRequest();
googletag.pubads().enableVideoAds();
googletag.enableServices();
});
</script>

</head>
<body>
<div id='div-<?php echo $size; ?>'>
		<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-<?php echo $size; ?>'); });
		</script>
	</div>

</body>
</html>
