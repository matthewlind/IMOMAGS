<?php

/**
 *head-includes.php makes special things special.
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }
?>
<meta name="apple-itunes-app" content="app-id=582716133">
<meta name="norton-safeweb-site-verification" content="lel6zw1429sky9cji3ahj0ygbtfbibkinjpss5j-ophp61v67avmtyky6egnjwftq791ihhmk8bkarb06wbmr5bb71u7fbuspaq1ycvu3tlwfdhm3j9zayxfxj67aoet" />
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Arvo:regular,bold&v1' rel='stylesheet' type='text/css'>

	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5816642-20']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_setAccount', 'UA-2409437-12']);
  _gaq.push(['_setDomainName', '.in-fisherman.com']);
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
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,700,800,600,300' rel='stylesheet' type='text/css'>