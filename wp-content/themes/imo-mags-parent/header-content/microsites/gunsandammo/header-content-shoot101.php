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
			<div class="shoot101-logo">
				<a href="/shoot101/" title="shoot101"><img  src="/wp-content/themes/gunsandammo/images/shoot101/Shoot101-logo-light.png"></a>
			</div>
<!-- 			<div class="nav-container"> -->
				<nav id="site-navigation" class="main-nav" role="navigation">
					<?php wp_nav_menu( array( 'theme_location' => 'shoot101_menu', 'container' => '0' ) ); ?>
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