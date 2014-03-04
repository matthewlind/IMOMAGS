<?php
$magazine_img = get_option("magazine_cover_uri", get_stylesheet_directory_uri(). "/img/magazine.png" );
if (empty($magazine_img)) {
    $magazine_img = get_stylesheet_directory_uri(). "/img/magazine.png";
}
?>
<aside id="header-sub" class="subscription-block"> 
  <img src="<?php print $magazine_img; ?>"> 
  <a class="cta" href="<?php print SUBS_LINK; ?>" target="_blank">Subscribe Now <span></span></a>
  <p class="drop-down"><!-- <a href="<?php print SERVICE_LINK; ?>">The Magazine</a> --></p>
</aside>
<span class="title"><?php print SUBS_DEAL_STRING; ?></span>
