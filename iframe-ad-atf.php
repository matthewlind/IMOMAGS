<?php 
$dartDomain = $_GET['ad_code'];
$term = $_GET['term'];
$camp = $_GET['camp'];
?>
<html>
<head>
<meta http-equiv="refresh" content="30">
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
	googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [[300, 600], [300, 250]], '300_atf').addService(googletag.pubads());
	googletag.pubads().enableSingleRequest();
	googletag.pubads().setTargeting('sect', ['<?php echo $term; ?>']).setTargeting('camp', ['<?php echo $camp; ?>']);
	googletag.pubads().collapseEmptyDivs(); 
	googletag.pubads().enableSyncRendering();
	googletag.enableServices();
});
</script>

</head>
<body>
<div id='300_atf'>
		<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('300_atf'); });
		</script>
	</div>

</body>
</html>
