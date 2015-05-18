<div class="top-panel">
	<a href="<?php echo site_url(); ?>" class="icon-arrow-left">Back to Petersen's Hunting</a>
</div>
<div class="wheels-afield">
	
	<header class="main-header">
		
		<div class="menu-area clearfix">
			<div class="microsite-logo">
				<a href="/wheels-afield/" title="shoot101"><img src="/wp-content/themes/petersenshunting/images/wheels-afield/wheels-afield-logo.png"></a>
			</div>
			<div class="nav-container clearfix">
				<nav id="site-navigation" class="main-nav" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'wheels_afield', 'container' => '0' ) ); ?>
					
					<div class="m-buymag-drop">
						<ul>
							<li class="clearfix">
								<i class="icon-cross"></i>
								<?php echo do_shortcode('[osgimpubissue bipad="34837" alias="head" vertical="down"]'); ?>
							</li>
							<li>
								<a href="https://store.intermediaoutdoors.com/products.php?product=Wheels-Afield-2015" target="_blank">Order Print Magazine Online</a>
							</li>
							<li> 
								<span>Get The Digital Edition:</span>
								<div class="m-list-dig">
									<ul>
										<li><a href="https://itunes.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=985774523&mt=8" target="_blank"><img src="/wp-content/themes/gunsandammo/images/shoot101/itunes-logo.png"><span>iTunes</span></a></li>
										<li><a href="https://play.google.com/store/apps/details?id=com.imo.wheelsafield" target="_blank"><img src="/wp-content/themes/gunsandammo/images/shoot101/google_play_icon.png"><span>Google Play</span></a></li>
										<li><a href="http://apps.microsoft.com/windows/en-us/app/wheels-afield/865f31ca-7ea7-462f-9bad-0712025e3fd4" target="_blank"><img src="/wp-content/themes/gunsandammo/images/shoot101/windows-store-icon.png"><span>Windows Store</span></a></li>
									</ul>
								</div>
							</li>
						</ul>
						
					</div>
						
				</nav>
				<div class="social-buttons">
					<ul>
						<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&title=Wheels Afield Magazine" class="icon-facebook" target="_blank"></a></li>
						<li><a href="http://twitter.com/intent/tweet?status=Wheels Afield Magazine" class="icon-twitter" target="_blank"></a></li>
						<li><a href="mailto:?subject=Website I came across&body=Check out this website! Wheels Afield Magazine. <?php echo site_url() . "/wheels-afield"; ?>" class="icon-mail" target="_blank"></a></li>
					</ul>
				</div><!-- .m-social-buttons -->
			</div><!-- .nav-container -->
		</div><!-- .menu-area -->
	</header>