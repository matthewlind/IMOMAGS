<?php

$code = $_GET['ad_code'];


if (!empty($_GET['size'])) {
  $size = $_GET['size'];
} else {
  $size = "300x250";
}


?>
<html>
<head>
<script language="javascript">
<!--
var randomdate=new Date();
var randomtime=randomdate.getTime();
var pr_tile=1;
var dartadsgen_rand=randomtime;
document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/<?php echo $code; ?>/;sect=ajax_gallery;page=index;subs=;sz=<?php echo $size; ?>;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
-->

</script>
</head>
<body>

</body>
</html>
