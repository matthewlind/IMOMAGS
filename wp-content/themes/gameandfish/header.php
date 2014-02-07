<?php
?><!DOCTYPE html>
<!-- bid: <?php global $blog_id; print $blog_id ?>; env: <?php if(defined("WEB_ENV")) { print WEB_ENV; } else { print "production"; } ?> -->
<!-- X-Device-Type Varnish Header Found: <?php global $varnishHeaderExists; echo ($varnishHeaderExists ? "YES" : 'NO'); ?> -->
<!-- Mobile Detected: <?php echo (mobile() ? "YES" : 'NO'); ?> -->
<!-- Tablet Detected: <?php echo (tablet() ? "YES" : 'NO'); ?> -->
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
	<meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
	<title><?php
	    /*
	     * Print the <title> tag based on what is being viewed.
	     */
	    global $page, $paged;

	    wp_title( '| ', true, 'right' );

	    // Add the blog name.
	    //bloginfo( 'name' );

	    // Add the blog description for the home/front page.

	    if ( $site_description && ( is_home() || is_front_page() ) )
	        get_bloginfo( 'description', 'display' );

	    // Add a page number if necessary:
	    if ( $paged >= 2 || $page >= 2 )
	        echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	    ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<!--[if IE 8]><style type="text/css">img{max-width: none !important;}.BCLvideoWrapper object{width:480px !important;}</style><![endif]-->
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<?php
		include_once get_stylesheet_directory() . "/head-includes.php";
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
	    wp_enqueue_script("jquery");
	    wp_head();

        global $IMO_USER_STATE;

        $sportsmanStates = array("GA","MI","MN","WI","AR","TN","TX");

        $magazine_img = get_option('magazine_cover_uri');

         if (in_array($IMO_USER_STATE, $sportsmanStates)) {
            $magazine_img = get_option('magazine_cover_alt_uri');
        }




		$subs_link = get_option('subs_link') . "/?pkey=";
		$iMagID = get_option('iMagID' );
		$deal_copy = get_option('deal_copy' );
		$gift_link = get_option('gift_link' );
		$service_link = get_option('service_link' );
		$subs_form_link = get_option('subs_form_link' );
		$i4ky = get_option('i4ky' );
		$dartDomain = get_option("dart_domain", $default = false);

	?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/dart.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.jfollow.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/flash_heed.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/snap.js"></script>
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
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [1, 1], 'div-gpt-ad-1386782139095-0').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [240, 60], 'div-gpt-ad-1386782139095-1').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 120], 'div-gpt-ad-1386782139095-2').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 250], 'div-gpt-ad-1386782139095-3').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 300], 'div-gpt-ad-1386782139095-4').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 600], 'div-gpt-ad-1386782139095-5').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [300, 602], 'div-gpt-ad-1386782139095-6').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [728, 90], 'div-gpt-ad-1386782139095-7').addService(googletag.pubads());
			googletag.defineSlot('/4930/<?php echo $dartDomain; ?>', [1080, 90], 'div-gpt-ad-1386782139095-8').addService(googletag.pubads());
			googletag.pubads().enableSingleRequest();
			googletag.pubads().enableVideoAds();
			googletag.enableServices();
		});
	</script>
	<?php if ( defined('JETPACK_SITE') && mobile() == false && tablet() == false): ?>
		<script type='text/javascript' src='http://ads.jetpackdigital.com/sites/<?php print JETPACK_SITE; ?>/jpd.js'></script>
	<?php endif; ?>
</head>

<body <?php body_class(); ?>  >
<div class="snap-drawers">
    <div class="snap-drawer snap-drawer-left" id="left-drawer">
        <div>
			<div class="mobile-menu-banner">

				<iframe id="menu-iframe-ad" width="320" height="50" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-menu.php?size=320x50&ad_code=<?php echo $dartDomain; ?>"></iframe>
			</div>

	        <div class="mob-aside-menu">
	        <?php //if(mobile()){ ?>
	         <div>
	        	<ul id="menu-main-menu" class="menu">
			   		<li class="main-menu-item menu-item-even">
		   				<a href="#" class="menu-link main-menu-link has-drop">Your State</a>
		   				<div class="drop-down">
			   		<ul class="sub-menu menu-odd">
			    		<li><a class="region" href="/new-england/">NEW ENGLAND</a></li>
			    		<li><a class="state-chooser" state="CT" href="/connecticut/">connecticut</a></li>
			    		<li><a class="state-chooser" state="ME" href="/maine/">maine</a></li>
			    		<li><a class="state-chooser" state="MA" href="/massachusetts/">massachusetts</a></li>
			    		<li><a class="state-chooser" state="NH" href="/newhampshire/">new hampshire</a></li>
						<li><a class="state-chooser" state="RI" href="/rhodeisland/">rhode island</a></li>
			    		<li><a class="state-chooser" state="VT" href="/vermont/">vermont</a></li>
			    		<li><a class="region" href="/northeast/">NORTHEAST</a></li>
			    		<li><a class="state-chooser" state="DE" href="/delaware/">delaware</a></li>
						<li><a class="state-chooser" state="MD" href="/maryland/">maryland</a></li>
						<li><a class="state-chooser" state="NJ" href="/newjersey/">new jersey</a></li>
						<li><a class="state-chooser" state="NY" href="/newyork/">new york</a></li>
						<li><a class="state-chooser" state="PA" href="/pennsylvania/">pennsylvania</a></li>
						<li><a class="region" href="/midwest/">MIDWEST</a></li>
						<li><a class="state-chooser" state="IL" href="/illinois/">illinois</a></li>
						<li><a class="state-chooser" state="IN" href="/indiana/">indiana</a></li>
						<li><a class="state-chooser" state="IA" href="/iowa/">iowa</a></li>
						<li><a class="state-chooser" state="KS" href="/kansas/">kansas</a></li>
						<li><a class="state-chooser" state="MI" href="/michigan/">michigan</a></li>
						<li><a class="state-chooser" state="MN" href="/minnesota/">minnesota</a></li>
						<li><a class="state-chooser" state="MO" href="/missouri/">missouri</a></li>
						<li><a class="state-chooser" state="NE" href="/nebraska/">nebraska</a></li>
						<li><a class="state-chooser" state="ND" href="/northdakota/">north dakota</a></li>
						<li><a class="state-chooser" state="OH" href="/ohio/">ohio</a></li>
						<li><a class="state-chooser" state="WI" href="/wisconsin/">wisconsin</a></li>
						<li><a class="state-chooser" state="SD" href="/southdakota/">south dakota</a></li>
						<li><a class="region" href="/rocky-mountains/">ROCKY MOUNTAINS</a></li>
						<li><a class="state-chooser" state="CO" href="/colorado/">colorado</a></li>
						<li><a class="state-chooser" state="ID" href="/idaho/">idaho</a></li>
						<li><a class="state-chooser" state="MT" href="/montana/">montana</a></li>
						<li><a class="state-chooser" state="UT" href="/utah/">utah</a></li>
						<li><a class="state-chooser" state="WY" href="/wyoming/">wyoming</a></li>
						<li><a class="region"  href="/south/">SOUTH</a></li>
			    		<li><a class="state-chooser" state="AL" href="/alabama/">alabama</a></li>
						<li><a class="state-chooser" state="AR" href="/arkansas/">arkansas</a></li>
						<li><a class="state-chooser" state="FL" href="/florida/">florida</a></li>
						<li><a class="state-chooser" state="GA" href="/georgia/">georgia</a></li>
						<li><a class="state-chooser" state="KY" href="/kentucky/">kentucky</a></li>
						<li><a class="state-chooser" state="LA" href="/louisiana/">louisiana</a></li>
						<li><a class="state-chooser" state="MS" href="/mississippi/">mississippi</a></li>
						<li><a class="state-chooser" state="NC" href="/northcarolina/">north carolina</a></li>
						<li><a class="state-chooser" state="SC" href="/southcarolina/">south carolina</a></li>
						<li><a class="state-chooser" state="TN" href="/tennessee/">tennessee</a></li>
						<li><a class="state-chooser" state="VA" href="/virginia/">virginia</a></li>
						<li><a class="state-chooser" state="WV" href="/westvirginia/">west virginia</a></li>
						<li><a class="region" href="/southwest/">SOUTHWEST</a></li>
			    		<li><a class="state-chooser" state="AZ" href="/arizona/">arizona</a></li>
						<li><a class="state-chooser" state="NV" href="/nevada/">nevada</a></li>
						<li><a class="state-chooser" state="NM" href="/newmexico/">new mexico</a></li>
						<li><a class="state-chooser" state="OK" href="/oklahoma/">oklahoma</a></li>
						<li><a class="state-chooser" state="TX" href="/texas/">texas</a></li>
			    		<li><a class="region" href="/westcoast/">WEST COAST</a></li>
						<li><a class="state-chooser" state="CA" href="/california/">california</a></li>
						<li><a class="state-chooser" state="OR" href="/oregon/">oregon</a></li>
						<li><a class="state-chooser" state="WA" href="/washington/">washington</a></li>
					</ul>
   				</div>
	   		</li>
    	</ul>
    </div>
				<?php //}
	            if(has_nav_menu( 'mobile' )){
	                wp_nav_menu(array(
	                    'menu_class'=>'menu',
	                    'theme_location'=>'mobile',
	                    'walker'=> new AddParentClass_Walker()
	                ));
	            }else{
	                wp_nav_menu(array(
	                'menu_class'=>'menu',
	                'theme_location'=>'bottom',
	                'walker'=> new AddParentClass_Walker()
	            ));
	            }

	            ?>
	        </div>

	        <div class="menu-subscribe">
	            <a href="<?php print $subs_link . get_option("mobile_menu_key"); ?>" target="_blank"><img src="<?php echo $magazine_img; ?>" alt="" /><span>Subscribe Now!</span></a>
	        </div>
	        <?php wp_nav_menu(array(
	            'menu_class'=>'menu',
	            'theme_location'=>'top',
	        ));   ?>
	        <div class="aside-socials">
	            <strong>Connect</strong>
	            <?php social_networks(); ?>
	        </div>

		</div>
	</div>
	<?php
	$hostname = $_SERVER['SERVER_NAME'];

	$userInfo = wp_get_current_user();

	$username = $userInfo->user_nicename;

	$apiURL = "http://$hostname/community-api/users/$username?get_comments=1";

	$file = file_get_contents($apiURL);

	//SET TEMPLATE VARIABLES
	$data = json_decode($file);

	if($data->score == 1){
		$niceScore = '<b>'.$data->score.'</b> Point';
	}else{
		$niceScore = '<b>'.$data->score.'</b> Points';
	}

    $displayStyle = "display:none";
	$loginStyle = "";

	if ( is_user_logged_in() ) {

		$displayStyle = "";
		$loginStyle = "display:none";

		wp_get_current_user();

		$current_user = wp_get_current_user();
	    if ( !($current_user instanceof WP_User) )
	         return;
	    }

	?>
	<div class="snap-drawer snap-drawer-right" id="right-drawer">
		 <div>
			<div class="mobile-menu-banner">

				<iframe id="menu-iframe-ad" width="320" height="50" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-menu.php?size=320x50&ad_code=<?php echo $dartDomain; ?>"></iframe>
			</div>

	        <div class="mob-aside-menu">
	            <div class="menu-community-menu-container">
		       		<ul id="menu-community-menu" class="menu">
				   		<li class="hot-link main-menu-item menu-item-even menu-item-depth-0 menu-item">
			   				<a href="/photos" class="menu-link main-menu-link">Latest Photos</a></li>
			   			<li class="mob-share main-menu-item menu-item-even menu-item-depth-">
			   				<div class="fileupload-buttonbar fileupload-sidebar">
						        <label class="upload-button">
									<a class="singl-post-photo"><span>Share Your Catch</span></a>
									<input id="image-upload" class="common-image-upload" type="file" name="photo-upload">
						        </label>
						    </div>
			   			</li>
			   			<li class="main-menu-item menu-item-even menu-item-depth-">
			   				<a href="/master-angler" class="menu-link main-menu-link">Master Angler</a>
			   			</li>
				   		<!--<li class="main-menu-item menu-item-even menu-item-depth-" style="<?php echo $displayStyle; ?>">
			   				<a href="#" class="menu-link main-menu-link has-drop">My Interests</a>
			   				<div class="drop-down">
			   					<ul class="sub-menu menu-odd menu-depth-1">
				   					<li class="sub-menu-item menu-item-odd menu-item-depth-1 menu-item">
				   						<a href="#" class="menu-link sub-menu-link">Bass</a>
				   					</li>
				   					<li class="sub-menu-item menu-item-odd menu-item-depth-1 menu-item">
				   						<a href="#" class="menu-link sub-menu-link">Walleye</a>
				   					</li>
				   					<li class="sub-menu-item menu-item-odd menu-item-depth-1 menu-item">
				   						<a href="#" class="menu-link sub-menu-link">Catfish</a>
				   					</li>
				   				</ul>
				   			</div>
			   			</li>-->
			   		</ul>
		       </div>
	        </div>
	        <div class="menu-subscribe">
	            <a href="<?php print $subs_link . get_option("mobile_menu_key"); ?>" target="_blank"><img src="<?php echo $magazine_img; ?>" alt="" /><span>Subscribe Now!</span></a>
	        </div>
	        <div class="mob-aside-menu" style="<?php echo $displayStyle; ?>">
		        <div class="menu-community-menu-container">
		       		<ul id="menu-community-menu" class="menu">
	       				<li class="main-menu-item menu-item-even menu-item-depth-0 menu-item">
			   				<a href="/profile/<?php echo $username; ?>#my-photos" class="menu-link main-menu-link">My Photos</a></li>
			   				<li class="main-menu-item menu-item-even menu-item-depth-0 menu-item">
			   				<a href="/edit-profile/?action=profile" class="menu-link main-menu-link">Edit Profile</a></li>
			   			<li class="main-menu-item menu-item-even menu-item-depth-">
			   				<a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="menu-link main-menu-link">Sign Out</a>
			   			</li>
			   		</ul>
			   	</div>
	        </div>

	        <div class="aside-socials">
	            <strong>Connect</strong>
	            <?php social_networks(); ?>
	        </div>

		</div>
	</div>

</div>

<?php fixed_connect_footer(); ?>
<!-- Site - Bowhunter -->
<div id='div-gpt-ad-1386788577276-9'>
	<script type='text/javascript'>
		googletag.cmd.push(function() { googletag.display('div-gpt-ad-1386788577276-9'); });
	</script>
</div>

<div id="page" class="snap-content smooth-menu">
<?php if (mobile() == false && tablet() == false) {
	imo_dart_tag("1x1",false,array("pos"=>"skin"));
	echo '<div class="expandable">';
		imo_dart_tag("1080x90");
	echo '</div>';
} ?>
	<div class="hfeed wrapper" data-role="content" role="main">
	    <div class="layout-frame">
	        <div id="branding" class="header clearfix" role="banner">

                <div class="clearfix">

                   <a id="open-left" class="open-menu">open menu</a>

                    <strong class="logo">
						<h1 class="state-logo"><?php global $IMO_USER_STATE_NICENAME; echo $IMO_USER_STATE_NICENAME; ?></h1>
						<?php

							$logo = "logo.png";

							global $IMO_USER_STATE;

							$sportsmanStates = array("GA","MI","MN","WI","AR","TN","TX");

							//echo "USERSTATE: $IMO_USER_STATE";

							if (in_array($IMO_USER_STATE, $sportsmanStates)) {
								$logo = "logo-sportsman.png";
							}

						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<?php if(mobile()){ ?>
								<h1 class="mobile-state"><?php echo $IMO_USER_STATE; ?></h1>
							<?php }else{ ?>
								<h1 class="mobile-state"><?php echo $IMO_USER_STATE_NICENAME; ?></h1>
							<?php } ?>

							<img src="<?php bloginfo('stylesheet_directory'); ?>/images/<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" /><?php if(!mobile() && !tablet()){ ?><span class="state-drop"></span><?php } ?></a>

						<?php if(!mobile() && !tablet()){ ?>
						<div class="gf-drop-down">
							<aside id="us-map-nav" class="us-map-widget">
							    <div class="state-info">
							    	<p class="state-name">Select Your State</p>
							    	<div class="state-list">

								    	<ul<?php if(tablet()){ echo ' style="padding:0 40px;"'; } ?>>
								    		<li>NEW ENGLAND</li>
								    		<li><a class="state-chooser" state="CT" href="/connecticut/">connecticut</a></li>
								    		<li><a class="state-chooser" state="ME" href="/maine/">maine</a></li>
								    		<li><a class="state-chooser" state="MA" href="/massachusetts/">massachusetts</a></li>
								    		<li><a class="state-chooser" state="NH" href="/newhampshire/">new hampshire</a></li>
											<li><a class="state-chooser" state="RI" href="/rhodeisland/">rhode island</a></li>
								    		<li><a class="state-chooser" state="VT" href="/vermont/">vermont</a></li>
								    		<li>NORTHEAST</li>
								    		<li><a class="state-chooser" state="DE" href="/delaware/">delaware</a></li>
											<li><a class="state-chooser" state="MD" href="/maryland/">maryland</a></li>
											<li><a class="state-chooser" state="NY" href="/newjersey/">new jersey</a></li>
											<li><a class="state-chooser" state="NY" href="/newyork/">new york</a></li>
											<li><a class="state-chooser" state="PE" href="/pennsylvania/">pennsylvania</a></li>
											<li>MIDWEST</li>
											<li><a class="state-chooser" state="IL" href="/illinois/">illinois</a></li>
											<li><a class="state-chooser" state="IN" href="/indiana/">indiana</a></li>
											<li><a class="state-chooser" state="IA" href="/iowa/">iowa</a></li>
											<li><a class="state-chooser" state="KS" href="/kansas/">kansas</a></li>
											<li><a class="state-chooser" state="MI" href="/michigan/">michigan</a></li>
										</ul>
								    	<ul<?php if(tablet()){ echo ' style="padding:0 40px;"'; } ?>>
											<li><a class="state-chooser" state="MN" href="/minnesota/">minnesota</a></li>
											<li><a class="state-chooser" state="MO" href="/missouri/">missouri</a></li>
											<li><a class="state-chooser" state="NE" href="/nebraska/">nebraska</a></li>
											<li><a class="state-chooser" state="ND" href="/northdakota/">north dakota</a></li>
											<li><a class="state-chooser" state="OH" href="/ohio/">ohio</a></li>
											<li><a class="state-chooser" state="WI" href="/wisconsin/">wisconsin</a></li>
											<li><a class="state-chooser" state="SD" href="/southdakota/">south dakota</a></li>
											<li>ROCKY MOUNTAINS</li>
											<li><a class="state-chooser" state="CO" href="/colorado/">colorado</a></li>
											<li><a class="state-chooser" state="ID" href="/idaho/">idaho</a></li>
											<li><a class="state-chooser" state="MT" href="/montana/">montana</a></li>
											<li><a class="state-chooser" state="UT" href="/utah/">utah</a></li>
											<li><a class="state-chooser" state="WY" href="/wyoming/">wyoming</a></li>
											<li>SOUTH</li>
								    		<li><a class="state-chooser" state="AL" href="/alabama/">alabama</a></li>
											<li><a class="state-chooser" state="AK" href="/arkansas/">arkansas</a></li>
											<li><a class="state-chooser" state="FL" href="/florida/">florida</a></li>
											<li><a class="state-chooser" state="GA" href="/georgia/">georgia</a></li>
										</ul>
								    	<ul<?php if(tablet()){ echo ' style="padding:0 40px;"'; } ?>>
											<li><a class="state-chooser" state="KY" href="/kentucky/">kentucky</a></li>
											<li><a class="state-chooser" state="LA" href="/louisiana/">louisiana</a></li>
											<li><a class="state-chooser" state="MS" href="/mississippi/">mississippi</a></li>
											<li><a class="state-chooser" state="NC" href="/northcarolina/">north carolina</a></li>
											<li><a class="state-chooser" state="SC" href="/southcarolina/">south carolina</a></li>
											<li><a class="state-chooser" state="TN" href="/tennessee/">tennessee</a></li>
											<li><a class="state-chooser" state="VA" href="/virginia/">virginia</a></li>
											<li><a class="state-chooser" state="WV" href="/westvirginia/">west virginia</a></li>
											<li>SOUTHWEST</li>
								    		<li><a class="state-chooser" state="AZ" href="/arizona/">arizona</a></li>
											<li><a class="state-chooser" state="NV" href="/nevada/">nevada</a></li>
											<li><a class="state-chooser" state="NM" href="/newmexico/">new mexico</a></li>
											<li><a class="state-chooser" state="OK" href="/oklahoma/">oklahoma</a></li>
											<li><a class="state-chooser" state="TX" href="/texas/">texas</a></li>
								    		<li>WEST COAST</li>
											<li><a class="state-chooser" state="CA" href="/california/">california</a></li>
											<li><a class="state-chooser" state="OR" href="/oregon/">oregon</a></li>
											<li><a class="state-chooser" state="WA" href="/washington/">washington</a></li>
								    	</ul>

							    	</div>
							    </div>
							     	<?php if(mobile() == false && tablet() == false){ ?><div id="us-map-ubermenu-container" style="min-width: 686px;height: 420px;margin-left: 448px;padding-top:110px;"></div><?php } ?>
							    </aside>
						</div><?php } ?>
					</strong>
					<?php
                    wp_nav_menu(array(
                        'menu_class'=>'menu',
                        'theme_location'=>'bottom',
                        'walker'=> new AddParentClass_Walker()
                    ));   ?>
					<?php if ( function_exists('imo_community_template') ){ ?>
						<a id="comm-mob-menu" class="user-btn" <?php if( is_user_logged_in() ) { echo 'style="background:url(/avatar?uid=' . $data->ID . ') no-repeat center center;"'; } ?>>user</a>
					<?php }else{ ?>
						<a id="comm-mob-menu" class="user-btn" style="display:none;">
					<?php } ?>

					<?php
                        // Check to see if the header image has been removed
                        $header_image = get_header_image();
                        if ( ! empty( $header_image ) ) :
                    ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php
                            // The header image
                            // Check if this is a post or page, if it has a thumbnail, and if it's a big one
                            if ( is_singular() &&
                                    has_post_thumbnail( $post->ID ) &&
                                    ( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( HEADER_IMAGE_WIDTH, HEADER_IMAGE_WIDTH ) ) ) &&
                                    $image[1] >= HEADER_IMAGE_WIDTH ) :
                                // Houston, we have a new header image!
                                echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
                            else : ?>
                            <img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
                        <?php endif; // end check for featured image or standard header ?>
                    </a>
                    <?php endif; // end check for removed header image ?>

                    <?php
                        // Has the text been hidden?
                        if ( 'blank' == get_header_textcolor() ) :
                    ?>
                        <div class="only-search<?php if ( ! empty( $header_image ) ) : ?> with-image<?php endif; ?>">
	                        <script>
							  (function() {
							    var cx = '000784987907684239526:o5vka_nc6h4';
							    var gcse = document.createElement('script');
							    gcse.type = 'text/javascript';
							    gcse.async = true;
							    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
							        '//www.google.com/cse/cse.js?cx=' + cx;
							    var s = document.getElementsByTagName('script')[0];
							    s.parentNode.insertBefore(gcse, s);
							  })();

							</script>
							<gcse:search></gcse:search>
	                        <?php //parent_theme_get_search_form(); ?>
                        </div>
                    <?php
                        else :
                    ?>


					<div id="subscribe-area" class="widget widget_text header-elements">
						<div class="subscribe-box">
						    <div class="clearfix">
						       	<div class="journal">
							        <img src="<?php echo $magazine_img; ?>" alt="Subscribe">
							    </div>

							    <div class="subscribe-now">
									<p><span class="stag-reg"><?php print $deal_copy;?></span></p>
									<a href="<?php print $subs_link . get_option("header_key"); ?>" target="_blank"  class="subs-btn">Subscribe Now!<span></span></a>
									<a class="subs-links" href="<?php print $gift_link;?>" target="_blank">Give a Gift <span>&raquo;</span></a>
							        <a class="subs-links" href="<?php print $service_link; ?>" target="_blank">Subscriber Services <span>&raquo;</span></a>
							    </div>
						</div>
					</div>
				</div>
                    <?php endif; ?>
                </div><!-- .clearfix -->
				<div class="gf-bottom-menu">
					<?php if(get_option("menu_key")){ ?>
					<div class="menu-top-menu-container subscribe-left">
						<ul class="menu">
							<li class="menu-item"><a href="<?php echo $subs_link . get_option("menu_key"); ?>" target="_blank">Subscribe!</a></li>
						</ul>
					</div>
					<?php }
					wp_nav_menu(array(
                        'menu_class'=>'menu',
                        'theme_location'=>'top',
                    ));   ?>
                    <div class="h-mdl-widget">
                        <div class="socials-hold">
                        	<?php social_networks(); ?>
						</div>
					</div>
					<a href="#" class="open-search jq-open-search">search</a>
					<div class="h-search-form">
						<script>
						  (function() {
						    var cx = '000784987907684239526:o5vka_nc6h4';
						    var gcse = document.createElement('script');
						    gcse.type = 'text/javascript';
						    gcse.async = true;
						    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
						        '//www.google.com/cse/cse.js?cx=' + cx;
						    var s = document.getElementsByTagName('script')[0];
						    s.parentNode.insertBefore(gcse, s);
						  })();
						</script>
						<gcse:search></gcse:search>
                        <?php //parent_theme_get_search_form(); ?>
                    </div>
				</div>
			</div><!-- #branding -->
		<div class="location-services">
           Your Location: <strong>You're in the jungle, baby!</strong>
           <a href="#">X</a>
       </div>
        <div class="content-banner-section">
         	<?php if (mobile() == false) { ?>
        	<div class="mdl-banner">
				 <?php imo_dart_tag("728x90"); ?>
			</div>
			<?php }else{ ?>
				<div class="mob-mdl-banner">
					<?php imo_dart_tag("320x50",true); ?>
				</div>
			<?php } ?>
        </div>

       <div id="main" class="main clearfix js-responsive-layout">
