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
	<meta name="viewport" content="width=device-width" />
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
	?>
	<script src="<?php echo get_template_directory_uri(); ?>/js/dart.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.jfollow.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/flash_heed.js" type="text/javascript"></script>
	<?php if ( defined('JETPACK_SITE') && mobile() == false && tablet() == false): ?>
		<script type='text/javascript' src='http://ads.jetpackdigital.com/sites/<?php print JETPACK_SITE; ?>/jpd.js'></script>
	<?php endif; ?>
</head>

<body <?php body_class(); ?>  >
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="mobileContainer">
	<div id="slidingMenu">
		<div id="slidingMenuContent">
			<div class="mobile-menu-banner">
				<?php $dartDomain = get_option("dart_domain", $default = false); ?>
				<iframe id="menu-iframe-ad" width="320" height="50" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-menu.php?size=320x50&ad_code=<?php echo $dartDomain; ?>"></iframe>
			</div>
	
	        <div class="mob-aside-menu">
	            <?php
	            if(has_nav_menu( 'Mobile Menu' )){
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
	            <a href="<?php print SUBS_LINK;?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/pic/journals.png" alt="" /><span>Subscribe Now!</span></a>
	        </div>
	        <?php wp_nav_menu(array(
	            'menu_class'=>'menu',
	            'theme_location'=>'top',
	        ));   ?>
	        <div class="aside-socials">
	            <strong>Connect</strong>
	            <?php social_networks(); ?>
	        </div>

			</div><!-- #slidingMenuContent-->
	</div><!-- slidingMenu -->

<div id="page" class="smooth-menu">

	<div class="hfeed wrapper" data-role="content" role="main">
	    <div class="layout-frame">
	        <div id="branding" class="header clearfix" role="banner">
	
                <div class="clearfix">
                   <a class="show-menu-button open-menu">open menu</a>
                    <strong class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a></strong>
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
                        <?php parent_theme_get_search_form(); ?>
                        </div>
                    <?php
                        else :
                    ?>
					<a href="#" class="open-search jq-open-search">search</a>
					<div id="subscribe-area" class="widget widget_text header-elements">
						<div class="subscribe-box">
						    <div class="clearfix">
						        <div class="journal">
						        <img src="<?php bloginfo('stylesheet_directory'); ?>/images/pic/journals.png" alt="">
						    </div>
						    <div class="subscribe-now">
						        <p><span class="stag-bold">SUBSCRIBE </span><span class="stag-reg">&amp;  SAVE 70% OFF</span> <b>the Cover Price</b></p>
						        <a href="<?php print SUBS_LINK;?>" class="btn-base">Subscribe <span>Now!</span></a>
						    </div>
						    </div>
						    <ul class="subscribe-links">
						        <li><a href="<?php print GIFT_LINK;?>">Give a Gift <span>&raquo;</span></a></li>
						        <li><a href="<?php print SERVICE_LINK; ?>">Subscriber Services <span>&raquo;</span></a></li>
						    </ul>
						</div>
					</div>

                        <div class="h-mdl-widget">
                            <div class="socials-hold">
                            	<?php social_networks(); ?>
							</div>
                            <div class="h-search-form">
                                <?php parent_theme_get_search_form(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div><!-- #branding -->

                    <?php wp_nav_menu(array(
                        'menu_class'=>'menu',
                        'theme_location'=>'top',
                    ));   ?>
                <!-- #access -->

                    <?php
                    wp_nav_menu(array(
                        'menu_class'=>'menu',
                        'theme_location'=>'bottom',
                        'walker'=> new AddParentClass_Walker()
                    ));   ?>
                <!-- #access -->
        </div><!-- #branding -->
	
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