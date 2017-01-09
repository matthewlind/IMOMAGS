<?php 
$dartDomain = $_GET['ad_code'];
$term = $_GET['term'];
if($_GET['camp']){
	$camp = $_GET['camp'];
}
$windowWidth = $_GET['windowWidth'];
$adUnit = $_GET['ad_unit'];
$page = $_GET['page'];
if($_GET['pos']){
	$pos = $_GET['pos'];
}
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

var w = <?php echo $windowWidth; ?>

googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/<?php echo $page; ?>', [300, 250], 'mediumRectangle').addService(googletag.pubads().setTargeting('pos', ['<?php if($pos) { echo $pos; } ?>']));

if (w>=1100)
{
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/<?php echo $page; ?>', [[970, 250], [728, 90]], 'billboard').addService(googletag.pubads());
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/<?php echo $page; ?>', [300, 600], 'sticky').addService(googletag.pubads());
}
if (w>=600 && w<=1099)
{
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/<?php echo $page; ?>', [728, 90], 'billboard').addService(googletag.pubads());
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/<?php echo $page; ?>', [300, 250], 'sticky').addService(googletag.pubads());
}
if (w<=599)
{
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/<?php echo $page; ?>', [320, 100], 'billboard').addService(googletag.pubads());
    googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/<?php echo $page; ?>', [300, 250], 'sticky').addService(googletag.pubads());
}
    googletag.pubads().enableSingleRequest();
    googletag.pubads().setTargeting('sect', ['<?php echo $term; ?>']).setTargeting('camp', ['<?php echo $camp; ?>']);
    googletag.pubads().collapseEmptyDivs();
    googletag.enableServices();
  });
</script>
</head>
<body>
	<div id='<?php echo $adUnit; ?>'>
		<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('<?php echo $adUnit; ?>'); });
		</script>
	</div>
</body>
</html>
