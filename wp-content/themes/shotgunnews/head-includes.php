<?php

/**
 *head-includes.php makes special things special.
 */

?>
<link href='http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5816642-20']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_setAccount', 'UA-2409437-5']);
  _gaq.push(['_setDomainName', '.shotgunnews.com']);
  <?php
  	if (is_single()) {
		$author = get_the_author();
		echo " _gaq.push(['_setCustomVar', 1,'author','". addslashes($author) . "', 3]);";
		
		//$category = get_the_category();
		//echo " _gaq.push(['_setCustomVar', 2,'category','". $category[0]->cat_name . "', 3]);";
	}
  ?>
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- BEGIN Tynt Script -->
<script type="text/javascript">
if(document.location.protocol=='http:'){
 var Tynt=Tynt||[];Tynt.push('bJkW_4RaWr4y-6acwqm_6l');Tynt.i={"ap":"Read more:"};
 (function(){var s=document.createElement('script');s.async="async";s.type="text/javascript";s.src='http://tcr.tynt.com/ti.js';var h=document.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);})();
}
</script>
<!-- END Tynt Script -->

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
googletag.defineSlot('/4930/imo.shotgunnews', [1, 1], 'div-gpt-ad-1386782139095-0').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.shotgunnews', [240, 60], 'div-gpt-ad-1386782139095-1').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.shotgunnews', [300, 120], 'div-gpt-ad-1386782139095-2').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.shotgunnews', [300, 250], 'div-gpt-ad-1386782139095-3').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.shotgunnews', [300, 300], 'div-gpt-ad-1386782139095-4').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.shotgunnews', [300, 600], 'div-gpt-ad-1386782139095-5').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.shotgunnews', [300, 602], 'div-gpt-ad-1386782139095-6').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.shotgunnews', [728, 90], 'div-gpt-ad-1386782139095-7').addService(googletag.pubads());
googletag.defineSlot('/4930/imo.shotgunnews', [1080, 90], 'div-gpt-ad-1386782139095-8').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.pubads().enableVideoAds();
googletag.enableServices();
});
</script>


