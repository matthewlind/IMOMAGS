<?php 
$dartDomain = $_GET['ad_code'];
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
  googletag.cmd.push(function() {

    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [320, 50], 'gallery_320').addService(googletag.pubads().setTargeting('sect', ['galleries']));

    googletag.pubads().enableSingleRequest();
    googletag.pubads().setTargeting('sect', ['<?php echo $term; ?>']);
    googletag.pubads().collapseEmptyDivs(); 
    googletag.pubads().enableSyncRendering();
    googletag.enableServices();
  });
</script>
</head>
<body>

	<div id='gallery_320'>
		<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('gallery_320'); });
		</script>
	</div>


</body>
</html>
