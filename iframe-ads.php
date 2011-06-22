<?php

if (!empty($_REQUEST['dartadgen_site']))
    $dartSite = $_REQUEST['dartadgen_site'];
else
    $dartSite = "imo.gunsandammo";
    
if (!empty($_REQUEST['ad_size']))    
    $adSize = $_REQUEST['ad_size'];
else
    $adSize = "300x250";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="refresh" content="45">
    </head>
    <body style="margin:0px;border:0px;">
        <script language="javascript">
        <!--
        var randomdate=new Date();
        var randomtime=randomdate.getTime();
        var pr_tile=1;
        var dartadsgen_rand=randomtime;
        document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/<?php print $dartSite; ?>/;sect=;page=index;subs=;sz=<?php print $adSize; ?>;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
        -->
        </script>
    </body>
</html>
