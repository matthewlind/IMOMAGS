<?php
?><!DOCTYPE html>
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

    wp_title( '|', true, 'right' );

    // Add the blog name.
    bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

    ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
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
    wp_enqueue_script("jquery"); 
    wp_head();
?>
</head>

<body <?php body_class('cbp-spmenu-push'); ?>>
    <!-- mobile menu start (copy of main menu, displays only in mobile orientation) -->
<div class="cbp-spmenu-vertical" id="cbp-spmenu-s1">
    <div class="mobile-menu-banner">
        <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/pic/mobile-menu-banner.jpg" alt="" /></a>
    </div>
    <div class="menu-main-menu-container">
        <ul>
            <li><a href="/">Home</a></li>
        </ul>
    </div>
    <?php 
        wp_nav_menu(array(
            'menu_class'=>'menu',  
            'theme_location'=>'bottom',
            'walker'=> new AddParentClass_Walker()
        ));   ?>
    
    <div class="menu-subscribe">
        <a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/pic/journals.png" alt="" /><span>Subscribe Now!</span></a>
    </div>
    
    <?php wp_nav_menu(array(
            'menu_class'=>'menu',  
            'theme_location'=>'top', 
        ));   ?>
    
    <div class="aside-socials">
        <strong>Connect</strong>
        <div class="socials">
            <a class="facebook" href="#">Facebook</a>
            <a class="twitter" href="#">Twitter</a>
            <a class="youtube" href="#">YouTube</a>
            <a class="rss" href="#">RSS</a>
        </div>
    </div>
    
</div>
<!-- mobile menu end -->
<div id="page" class="hfeed wrapper">
    <div class="layout-frame">
        <div id="branding" class="header clearfix" role="banner">
                
                <div class="clearfix">
                    <a href="#" id="showLeftPush" class="open-menu">open menu</a>
                    <strong class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a></strong>
                    
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
                        <?php infisherman_get_search_form(); ?>
                        </div>
                    <?php
                        else :
                    ?>
                    <a href="#" class="user-btn">user</a>
                    <a href="#" class="open-search jq-open-search">search</a>
                         <?php if ( is_active_sidebar( 'sidebar-header-2' ) ) : ?>
                            <?php dynamic_sidebar( 'sidebar-header-2' ); ?>
                        <?php endif; ?>
                        
                        <div class="h-mdl-widget">
                            <div class="socials-hold">
                                <?php if ( is_active_sidebar( 'sidebar-header-1' ) ) : ?>
                                    <?php dynamic_sidebar( 'sidebar-header-1' ); ?>
                                <?php endif; ?>
                            </div>
                            
                            <div class="h-search-form">
                                <?php infisherman_get_search_form(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
               
                
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
            <a class="mdl-banner" href="#"><img src="<?php bloginfo('template_directory'); ?>/images/pic/banner-galco.jpg" alt="" /></a>
            <div class="swipe-out"></div>
        </div>
    
        <div id="main" class="main clearfix js-responsive-layout">
            <div class="swipe-out"></div>