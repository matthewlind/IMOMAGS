<?php 
	//fixed_connect_footer();
	if ( mobile() ) { ?><div class="mobile-adhesion"><?php imo_ad_placement("mobile_adhesion_320x50"); ?></div><?php } ?>

<div class="top-panel">
	<a href="http://www.gunsandammo.com/" class="icon-arrow-left">Back to Guns & Ammo</a>
</div>
<div class="s101 <?php if ( in_category( 'shoot101' )) { echo "cat-shoot101";}?>">
	
	<header class="main-header">
		
		<div class="menu-area clearfix">
			<?php
			    $category_id = get_cat_ID( 'shoot101' );				
			    $category_link = get_category_link( $category_id );
			?>
			<div class="microsite-logo">
				<a href="/shoot101/" title="shoot101"><img  src="/wp-content/themes/gunsandammo/images/shoot101/Shoot101-logo-light.png"></a>
			</div>
<!-- 			<div class="nav-container"> -->
				<nav id="site-navigation" class="main-nav" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'shoot101_menu', 'container' => '0' ) ); ?>
					<div class="m-buymag-drop">
						<ul>
							<li class="clearfix">
								<i class="icon-cross"></i>
								<?php echo do_shortcode('[osgimpubissue bipad="30314" alias="head" vertical="down"]'); ?>
							</li>
							<li class="m-buy-online">
								<a href="https://store.intermediaoutdoors.com/products.php?product=Wheels-Afield-2015" target="_blank">Order Print Magazine Online</a>
								<div class="unavailble-mag">
									<p>The print magazine is temporarily unavailable in the online store. Instead find it in your area using your zip code, or get the digital edition.</p>
								</div>
							</li>
							<li> 
								<span>Get The Digital Edition:</span>
								<div class="m-list-dig">
									<ul>
										<li><a href="https://itunes.apple.com/us/app/shoot-101/id980668053?ls=1&mt=8" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/itunes-logo.png"><span>iTunes</span></a></li>
										<li><a href="https://play.google.com/store/apps/details?id=com.imo.shooting101" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/google_play_icon.png"><span>Google Play</span></a></li>
										<li><a href="http://apps.microsoft.com/windows/en-us/app/shoot-101/0560cb9d-d461-4856-9abd-d3efb69862d9" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/windows-store-icon.png"><span>Windows Store</span></a></li>
									</ul>
								</div><!-- .m-list-dig -->
							</li>
						</ul>						
					</div><!-- .m-buymag-drop -->					
				</nav>
				<div class="social-buttons">
					<ul>
						<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo (urlencode(site_url())) . '/shoot101'; ?>&title=Shoot101: A starter's guide every new shooter should read." class="icon-facebook" target="_blank"></a></li>
						<li><a href="http://twitter.com/intent/tweet?status=Shoot101: A starter's guide every new shooter should read.+http://www.gunsandammo.com/shoot101/" class="icon-twitter" target="_blank"></a></li>
						<li><a href="mailto:?subject=Article I came across&body=Shoot101: A starter's guide every new shooter should read. <?php echo (urlencode(site_url())) . '/shoot101'; ?>" class="icon-mail" target="_blank"></a></li>
					</ul>
				</div>
<!-- 			</div> -->
		</div>
	</header>