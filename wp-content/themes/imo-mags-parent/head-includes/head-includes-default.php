<?php
    /* We add some JavaScript to pages with the comment form
     * to support sites with threaded comments (when in use).
     */
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
/*
    wp_enqueue_script("jquery");
    wp_head();
*/
    $postID = get_the_ID();
    $dartDomain = get_option("dart_domain", $default = false);
    $magazine_img = get_option('magazine_cover_uri' );
    if($dartDomain == "imo.gunsandammo" || $dartDomain == "imo.in-fisherman" || $dartDomain == "imo.shotgunnews" || $dartDomain == "imo.shootingtimes"){
	    $subs_link = get_option('subs_link');
    }else{
		$subs_link = get_option('subs_link') . "/?pkey=";
    }
	$iMagID = get_option('iMagID' );
	$deal_copy = get_option('deal_copy' );
	$gift_link = get_option('gift_link' );
	$service_link = get_option('service_link' );
	$subs_form_link = get_option('subs_form_link' );
	$i4ky = get_option('i4ky' );
	include_once get_template_directory() . "/head-includes.php";
	include_once get_stylesheet_directory() . "/head-includes.php";
	?>
<link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<!-- Font Awsome Icons -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<script src="<?php echo get_template_directory_uri(); ?>/js/dart.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.jfollow.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/flash_heed.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/snap.js"></script>
<!-- Begin comScore Tag -->
<script>
  var _comscore = _comscore || [];
  _comscore.push({ c1: "2", c2: "8031814" });
  (function() {
    var s = document.createElement("script"), el = document.getElementsByTagName("script")[0]; s.async = true;
    s.src = (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js";
    el.parentNode.insertBefore(s, el);
  })();
</script>
<noscript>
  <img src="http://b.scorecardresearch.com/p?c1=2&c2=8031814&cv=2.0&cj=1" />
</noscript>
<!-- End comScore Tag -->
 
<?php if ( defined('JETPACK_SITE') && mobile() == false && tablet() == false): ?>
	<script type='text/javascript' src='http://ads.jetpackdigital.com/sites/<?php print JETPACK_SITE; ?>/jpd.js'></script>
<?php endif; ?>