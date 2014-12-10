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
(function() {
var useSSL = 'https:' == document.location.protocol;
var src = (useSSL ? 'https:' : 'http:') +
'//www.googletagservices.com/tag/js/gpt.js';
document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
})();
</script>
<script type='text/javascript'>
googletag.defineSlot('/4930/<?php echo $code; ?>/BTF_Medium_Rectangle_300x250', [[300, 250], [300, 600]], 'div-btf_medium_rectangle_300x250').addService(googletag.pubads());

googletag.pubads().setTargeting("sect","<?php echo $title; ?>");
googletag.pubads().setTargeting("Audience segment","<?php echo $title; ?>");

googletag.pubads().enableSingleRequest();
googletag.pubads().enableSyncRendering();

googletag.pubads().enableVideoAds();
googletag.enableServices();
</script>

</head>
<body>
<div id='div-btf_medium_rectangle_300x250'>
		<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-btf_medium_rectangle_300x250'); });
		</script>
	</div>

</body>
</html>
