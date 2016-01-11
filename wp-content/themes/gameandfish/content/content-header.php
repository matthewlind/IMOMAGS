<?php
	global $IMO_USER_STATE;

    $sportsmanStates = array("GA","MI","MN","WI","AR","TN","TX");

    $magazine_img = get_option('magazine_cover_uri');

     if (in_array($IMO_USER_STATE, $sportsmanStates)) {
        $magazine_img = get_option('magazine_cover_alt_uri');
    }	
    
    $deal_copy = get_option('deal_copy' );
	
?>

<div class="snap-drawers">
    <div class="snap-drawer snap-drawer-left" id="left-drawer">
        <div>
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
	            <a href="<?php print $subs_link . get_option("mobile_menu_key"); ?>" target="_blank" onClick="_gaq.push(['_trackEvent', 'Subscribe', 'Location', 'Mobile Menu']);"><img src="<?php echo $magazine_img; ?>" alt="" /><span>Subscribe Now!</span></a>
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

<?php fixed_connect_footer(); ?>

<div id="page" class="snap-content smooth-menu">
	<div class="imo-superheader">
		<?php imo_ad_placement("superheader"); ?>
	</div>
	<div class="hfeed wrapper <?php if(get_field("full_width") == true){ echo ' full-width full-content'; }else if(is_single() && has_post_format( 'video' ) || is_category("tv")){ echo ' tv-show full-content'; } ?>" data-role="content" role="main">
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
					
					<a id="comm-mob-menu" class="user-btn" <?php if( is_user_logged_in() ) { echo 'style="background:url(/avatar?uid=' . $data->ID . ') no-repeat center center;"'; } ?>>user</a>

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
									<a href="<?php print $subs_link . get_option("header_key"); ?>" target="_blank"  class="subs-btn" onClick="_gaq.push(['_trackEvent', 'Subscribe', 'Location', 'Header Right']);">Subscribe Now!<span></span></a>
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
							<li class="menu-item"><a href="<?php echo $subs_link . get_option("menu_key"); ?>" target="_blank" onClick="_gaq.push(['_trackEvent', 'Subscribe', 'Location', 'Header Left']);">Subscribe!</a></li>
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
		<div id="main" class="main clearfix js-responsive-layout">