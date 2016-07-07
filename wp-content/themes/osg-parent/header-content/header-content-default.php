<?php 
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
	<?php if(function_exists('imo_community_template')){
	
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
		        <div class="mob-aside-menu">
		            <div class="menu-community-menu-container">
			       		<ul id="menu-community-menu" class="menu">
					   		<li class="hot-link main-menu-item menu-item-even menu-item-depth-0 menu-item">
						   		<?php if($dartDomain == "imo.northamericanwhitetail"){ ?>
					   				<a href="/community" class="menu-link main-menu-link">Community Photos</a>
					   			<?php }else{ ?>
					   				<a href="/photos" class="menu-link main-menu-link">Latest Photos</a>
					   			<?php } ?>
				   			</li>
				   			<li class="mob-share main-menu-item menu-item-even menu-item-depth-">
				   				<div class="fileupload-buttonbar fileupload-sidebar">
							        <label class="upload-button">
										<a href="<?php if($dartDomain == "imo.northamericanwhitetail"){ echo '/community/new'; }else{ echo '/photos/new'; } ?>/" class="singl-post-photo"><span><?php if($dartDomain == "imo.northamericanwhitetail"){ echo 'Share Your Photos'; }else{ echo 'Share Your Catch'; } ?></span></a>
							        </label>
							    </div>
				   			</li>
				   			<?php if($dartDomain == "imo.in-fisherman"){ ?>
				   			<li class="main-menu-item menu-item-even menu-item-depth-">
				   				<a href="/master-angler" class="menu-link main-menu-link">Master Angler</a>
				   			</li>	
				   			<?php } ?>		   				 
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
		            <a href="<?php print $subs_link . get_option("mobile_menu_key"); ?>" target="_blank" onClick="_gaq.push(['_trackEvent', 'Subscribe', 'Location', 'Mobile Community Menu']);"><img src="<?php print $magazine_img;?>" alt="" /><span>Subscribe Now!</span></a>
		        </div>
		        <div class="mob-aside-menu" style="<?php echo $displayStyle; ?>">
			        <div class="menu-community-menu-container">
			       		<ul id="menu-community-menu" class="menu">
		       				<li class="main-menu-item menu-item-even menu-item-depth-0 menu-item">
				   				<a href="/profile/<?php echo $username; ?>#my-photos" class="menu-link main-menu-link">My Photos</a>
				   			</li>
			   				<!--<li class="main-menu-item menu-item-even menu-item-depth-0 menu-item">
			   					<a href="/edit-profile/?action=profile" class="menu-link main-menu-link">Edit Profile</a>
			   				</li>-->
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
	<?php } ?>
</div>
<?php fixed_connect_footer(); ?>
<div id="page" class="snap-content smooth-menu">
	<div class="imo-superheader">
		<?php imo_ad_placement("superheader"); ?>
	</div>
	<?php include_once get_stylesheet_directory() . "/network-bar.php"; ?>
	<div class="hfeed wrapper <?php if(get_field("full_width") == true){ echo ' full-width full-content'; }else if( is_page_template('show-page.php') || is_category("tv") || is_category("show-galleries") || (is_single() && (has_post_format( 'video' ) || in_category("show-galleries")) ) ){ echo ' tv-show full-content'; } ?>" data-role="content" role="main">
	    <div class="layout-frame">
	        <div id="branding" class="header clearfix" role="banner">
	
                <div class="clearfix">

                   <a id="open-left" class="open-menu">open menu</a>
                    <strong class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" /></a></strong>
                    	<?php if ( function_exists('imo_community_template') ){ ?>
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
	                	<div class="menu-top-menu-container subscribe-left">
							<ul class="menu">
								<li class="menu-item"><a href="<?php echo $subs_link . get_option("menu_key"); ?>" target="_blank">Subscribe!</a></li>
							</ul>
						</div>
					<?php if(has_nav_menu( 'top' )){
                    	wp_nav_menu(array(
	                        'menu_class'=>'menu',
	                        'theme_location'=>'top',
						));  
                    } ?>
                <!-- #access -->

                    <?php
                    wp_nav_menu(array(
                        'menu_class'=>'menu',
                        'theme_location'=>'bottom',
                        'walker'=> new AddParentClass_Walker()
                    ));   ?>
                <!-- #access -->
				</div><!-- #branding -->
		<?php if(get_field("full_width") != true){ ?>
	        <div class="content-banner-section">
	        	<div class="mob-mdl-banner">
					<?php imo_ad_placement("320_atf"); ?>
				</div>
				<div class="mdl-banner">
					<?php 
					imo_ad_placement("leaderboard"); 
					imo_ad_placement("billboard"); 
					?>
				</div>
	        </div>
        <?php } ?>
        <div id="main" class="main clearfix js-responsive-layout">