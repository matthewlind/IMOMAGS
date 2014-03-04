<?php

/**
 *head-includes.php makes special things special.
 */
$appArgument = "whitetailplus://www.northamericanwhitetail.com" . $_SERVER['REQUEST_URI'];
?>
<meta name="apple-itunes-app" content="app-id=582721507">
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5816642-20']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_setAccount', 'UA-2409437-15']);
  _gaq.push(['_setDomainName', '.northamericanwhitetail.com']);
  <?php

		$author = get_the_author();
		echo " _gaq.push(['_setCustomVar', 1,'author','". addslashes($author) . "', 3]);";

		//$category = get_the_category();
		//echo " _gaq.push(['_setCustomVar', 2,'category','". $category[0]->cat_name . "', 3]);";

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
 var Tynt=Tynt||[];Tynt.push('d0GR6eRaSr4Agcacwqm_6l');Tynt.i={"ap":"Read more:"};
 (function(){var s=document.createElement('script');s.async="async";s.type="text/javascript";s.src='http://tcr.tynt.com/ti.js';var h=document.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);})();
}
</script>
<!-- END Tynt Script -->
<!--
/* @license
 * MyFonts Webfont Build ID 2288984, 2012-05-09T13:35:45-0400
 * 
 * The fonts listed in this notice are subject to the End User License
 * Agreement(s) entered into by the website owner. All other parties are 
 * explicitly restricted from using the Licensed Webfonts(s).
 * 
 * You may obtain a valid license at the URLs below.
 * 
 * Webfont: Proxima Nova A Thin by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/a-thin/
 * Licensed pageviews: 100,000
 * 
 * Webfont: Proxima Nova S Thin by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/s-thin/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova A Extrabold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/a-extrabld/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova S Extrabold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/s-extrabld/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova S Semibold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/s-semibold/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova S Black by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/s-black/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova A Regular by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/a-regular/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova A Black by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/a-black/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova S Light by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/s-light/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova A Light by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/a-light/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova S Bold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/s-bold/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova A Bold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/a-bold/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova A Semibold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/a-semibold/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova S Regular by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/s-regular/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova Thin by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/thin/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova Extrabold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/extrabld/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova Regular by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/regular/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova Semibold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/semibold/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova Black by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/black/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova Light by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/light/
 * Licensed pageviews: unspecified
 * 
 * Webfont: Proxima Nova Bold by Mark Simonson
 * URL: http://www.myfonts.com/fonts/marksimonson/proxima-nova/bold/
 * Licensed pageviews: unspecified
 * 
 * 
 * License: http://www.myfonts.com/viewlicense?type=web&buildid=2288984
 * Webfonts copyright: Copyright (c) Mark Simonson, 2005. All rights reserved.
 * 
 * ? 2012 Bitstream Inc
*/

-->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('url'); ?>/wp-content/themes/imo-mags-northamericanwhitetail/MyFontsWebfontsKit.css">
