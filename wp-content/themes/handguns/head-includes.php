<?php

/**
 *head-includes.php makes special things special.
 */
if (is_single()) { 
	$author = get_the_author(); ?>
  	<script type="text/javascript">
  		var _gaq = _gaq || [];
		<?php 
		echo " _gaq.push(['_setCustomVar', 1,'author','". addslashes($author) . "', 3]);"; 
		//$category = get_the_category();
		//echo " _gaq.push(['_setCustomVar', 2,'category','". $category[0]->cat_name . "', 3]);"; 
		?>
		_gaq.push(['_trackPageview']);
	</script>
<?php } ?>

<!-- BEGIN Tynt Script -->
<script type="text/javascript">
if(document.location.protocol=='http:'){
 var Tynt=Tynt||[];Tynt.push('b6Fe3ERaWr4z4Kacwqm_6r');Tynt.i={"ap":"Read more:"};
 (function(){var s=document.createElement('script');s.async="async";s.type="text/javascript";s.src='http://tcr.tynt.com/ti.js';var h=document.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);})();
}
</script>
<!-- END Tynt Script -->
