<?php

$code = $_GET['ad_code'];

if (!empty($_GET['size'])) {
  $size = $_GET['size'];
} else {
  $size = "300x250";
}


if (!empty($_GET['camp'])) {
  $campString = "camp=" . $_GET['camp'] . ";" ;
} else {
  $campString = "";
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
document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/<?php echo $code; ?>/;sect=;page=index;<?php echo $campString; ?>subs=;sz=<?php echo $size; ?>;pos=;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
-->

</script>
</head>
<body>

</body>
</html>
