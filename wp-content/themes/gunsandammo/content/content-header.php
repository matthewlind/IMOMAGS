<?php 
	$magazine_img = get_option('magazine_cover_uri' );
	$subs_link = get_option('subs_link'); 
	$iMagID = get_option('iMagID' );
	$deal_copy = get_option('deal_copy' );
	$gift_link = get_option('gift_link' );
	$service_link = get_option('service_link' );
	$subs_form_link = get_option('subs_form_link' );
	$i4ky = get_option('i4ky' );
	$dartDomain = get_option("dart_domain", $default = false);	
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="snap-drawers">
    <div class="snap-drawer snap-drawer-left" id="left-drawer">
        <div>
	        <div class="mob-aside-menu">
	            <?php
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
	            <a href="<?php print $subs_link . get_option("mobile_menu_key"); ?>" target="_blank" onClick="_gaq.push(['_trackEvent', 'Subscribe', 'Location', 'Mobile Menu']);"><img src="<?php print $magazine_img;?>" alt="Subscribe" /><span>Subscribe Now!</span></a>
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
</div>
<div class="imo-superheader">
	<?php imo_ad_placement("superheader"); ?>
</div>

<?php 
	include_once get_stylesheet_directory() . "/network-bar.php";
	fixed_connect_footer(); 
?>

<div id="page" class="snap-content smooth-menu">
	<div class="hfeed wrapper <?php if(get_field("full_width") == true){ echo ' full-width full-content'; }else if( is_page_template('show-page.php') || is_category("tv") || is_category("show-galleries") || (is_single() && (has_post_format( 'video' ) || in_category("show-galleries")) ) ){ echo ' tv-show full-content'; } ?>" data-role="content" role="main">

	    <div class="layout-frame">
	        <div id="branding" class="header clearfix" role="banner">
	
                <div class="clearfix">

                    <a id="open-left" class="open-menu">open menu</a>
                    <strong class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a></strong>
                    <?php 
                    wp_nav_menu(array(
	                    'menu_class'=>'menu',
	                    'theme_location'=>'bottom',
	                    'walker'=> new AddParentClass_Walker()
	                )); 
                    	 if ( function_exists('imo_community_template') ){ ?>
							<a id="comm-mob-menu" class="user-btn" <?php if( is_user_logged_in() ) { echo 'style="background:url(/avatar?uid=' . $data->ID . ') no-repeat center center;"'; } ?>>user</a>
							<div class="community-tooltip"></div>
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
							        <img src="<?php echo $magazine_img; ?>" alt="Subscribe">
							    </div>

							    <div class="subscribe-now">
									<span><?php print $deal_copy;?></span>
									<a href="<?php print $subs_link . get_option("header_key"); ?>" target="_blank" class="btn-base" onClick="_gaq.push(['_trackEvent', 'Subscribe', 'Location', 'Header Right']);">Subscribe <span>Now!</span></a>
									<ul class="subscribe-links">
								        <li><a href="<?php print $gift_link;?>" target="_blank">Give a Gift <span>&raquo;</span></a></li>
								        <li><a href="<?php print $service_link; ?>" target="_blank">Subscriber Services <span>&raquo;</span></a></li>
								    </ul>
							    </div>
						    </div>
						</div>
					</div>
                    <?php endif; ?>
			</div><!-- .clearfix -->
			<div class="ga-submenu">
                	<div class="menu-top-menu-container subscribe-left">
						<ul class="menu">
							<li class="menu-item"><a href="<?php echo $subs_link . get_option("menu_key"); ?>" target="_blank" onClick="_gaq.push(['_trackEvent', 'Subscribe', 'Location', 'Header Left']);">Subscribe!</a></li>
						</ul>
					</div>
				<?php
				if(has_nav_menu( 'top' )){
                	wp_nav_menu(array(
                        'menu_class'=>'menu',
                        'theme_location'=>'top',
					));  
               } ?>
				<div class="h-mdl-widget">
				    <div class="socials-hold">
				    	<?php social_networks(); ?>
					</div>
				    <div class="h-search-form">
				        <?php parent_theme_get_search_form(); ?>
				    </div>
				</div>
			</div>
        </div><!-- #branding -->
		
        <div class="content-banner-section">
			<?php if(mobile()){ ?>
		        	<div class="mob-mdl-banner">
						<?php iframe_ad("320_atf"); ?>
					</div>
				<?php } ?>
				<div class="mdl-banner">
					<?php 
					if(!mobile() && !tablet()){
					 	iframe_ad("billboard");
					 }
					if(tablet()){
						iframe_ad("leaderboard");	
					 }
					 
					
					?>

			</div>
        </div>
        <div id="main" class="main clearfix js-responsive-layout">