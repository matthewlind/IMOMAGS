<?php

/**
 * head-includes.php contains all the customizations tat a single site needs.
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }
?>

	<!-- FONTS -->

	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5816642-20']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_setAccount', 'UA-2409437-9']);
  _gaq.push(['_setDomainName', '.gundogmag.com']);
  <?php
  	if (is_single()) {
		$author = get_the_author();
		echo " _gaq.push(['_setCustomVar', 1,'author','". $author . "', 3]);";
		
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

