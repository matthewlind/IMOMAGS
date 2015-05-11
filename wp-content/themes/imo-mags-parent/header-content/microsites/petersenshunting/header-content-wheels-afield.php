<?php 
	//fixed_connect_footer();
	if ( mobile() ) { ?><div class="mobile-adhesion"><?php imo_ad_placement("mobile_adhesion_320x50"); ?></div><?php } ?>

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