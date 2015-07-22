<div class="top-panel">
	<a href="<?php echo site_url(); ?>" class="icon-arrow-left">Back to Wildfowl</a>
</div>
<div class="wheels-afield">
	
	<header class="main-header">
		
		<div class="menu-area clearfix">
			<div class="microsite-logo">
				<a href="/gear-guide/" title="shoot101"><img src="/wp-content/themes/imo-mags-parent/images/microsites/wildfowl/gear-guide/wildfowl-gear-guide-logo.png"></a>
			</div>
			<div class="nav-container clearfix">
				<nav id="site-navigation" class="main-nav" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'microsite', 'container' => '0' ) ); ?>					
					<div class="m-buymag-drop">
						<ul>
							<li class="clearfix">
								<i class="icon-cross"></i>
								<?php //echo do_shortcode('[osgimpubissue bipad="34837" alias="head" vertical="down"]'); ?>
							</li>
							<li class="m-buy-online">
								<a href="https://store.intermediaoutdoors.com/products.php?product=Wheels-Afield-2015" target="_blank">Order Print Magazine Online</a>
							</li>
							<li> 
								<span>Get The Digital Edition:</span>
								<div class="m-list-dig">
									<ul>
										<li><a href="https://itunes.apple.com/us/app/wildfowl/id582719568?mt=8" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/itunes-logo.png"><span>iTunes</span></a></li>
										<li><a href="https://play.google.com/store/apps/details?id=com.imo.wifp&hl=en" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/google_play_icon.png"><span>Google Play</span></a></li>
										<li><a href="http://apps.microsoft.com/windows/en-us/app/wildfowl/c5bb5e65-71d4-47cb-957d-876fc1e1c432" target="_blank"><img src="/wp-content/themes/imo-mags-parent/images/microsites/digit-store-icons/windows-store-icon.png"><span>Windows Store</span></a></li>
									</ul>
								</div>
							</li>
						</ul>
					</div><!-- .m-buymag-drop -->
				</nav>
				<div class="social-buttons">
					<ul>
						<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo (urlencode(site_url())) . '/gear-guide'; ?>&title=Wildfowl Gear Guide" class="icon-facebook" target="_blank"></a></li>
						<li><a href="http://twitter.com/intent/tweet?status=Wildfowl Gear Guide+http://www.wildfowlmag.com/gear-guide/" class="icon-twitter" target="_blank"></a></li>
						<li><a href="mailto:?subject=Website I came across&body=Check out this website! Wildfowl Gear Guide <?php echo (urlencode(site_url())) . '/gear-guide'; ?>" class="icon-mail" target="_blank"></a></li>
					</ul>
				</div><!-- .m-social-buttons -->
			</div><!-- .nav-container -->
		</div><!-- .menu-area -->
	</header>