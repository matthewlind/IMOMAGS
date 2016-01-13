<?php 
$dartDomain = $_GET['ad_code'];

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
  googletag.cmd.push(function() {

    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 250], '300_btf').addService(googletag.pubads());

    googletag.pubads().enableSingleRequest();
    googletag.pubads().setTargeting('sect', ['<?php echo 'home'; ?>']);
    googletag.pubads().collapseEmptyDivs(); 
    googletag.pubads().enableSyncRendering();
    googletag.enableServices();
  });
</script>

</head>
<body>
<div id='300_btf'>
		<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('300_btf'); });
		</script>
	</div>

</body>
</html>
