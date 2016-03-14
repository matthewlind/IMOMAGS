<?php 
$code = $_GET['ad_code'];
$bracket = $_GET['bracket'];
$size = $_GET['size'];

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
    googletag.defineSlot('/4930/imo.gunsandammo/guns_and_ammo_madness/gam_bracket_medium_rectangle', [300, 250], 'bracket_300').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.pubads().enableSyncRendering();
    googletag.enableServices();
  });
</script>

</head>
<body>
<div id='bracket_300'>
		<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('bracket_300'); });
		</script>
	</div>

</body>
</html>
