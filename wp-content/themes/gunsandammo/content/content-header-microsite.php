<?php 
	//fixed_connect_footer();
	if ( mobile() ) { ?><div class="mobile-adhesion"><?php imo_ad_placement("mobile_adhesion_320x50"); ?></div><?php } ?>

<div class="top-panel">
	<a href="http://www.gunsandammo.com/" class="icon-arrow-left">Back to Guns & Ammo</a>
</div>
<div class="s101 <?php /* if (is_category( 'shoot101' )) { echo "cat-shoot101"; } */ if ( in_category( 'shoot101' )) { echo "cat-shoot101";}?>">
	
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
						<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php print(urlencode(get_permalink())); ?>&title=<?php print(urlencode(the_title())); ?>" class="icon-facebook"></a></li>
						<li><a href="http://twitter.com/intent/tweet?status=<?php print(urlencode(the_title())); ?>+<?php print(urlencode(get_permalink())); ?>" class="icon-twitter"></a></li>
						<li><a href="mailto:?subject=Article I came across&body=Check out this article! Title: '<?php the_title(); ?>'. Link: <?php the_permalink(); ?>" class="icon-mail"></a></li>
					</ul>
				</div>
<!-- 			</div> -->
		</div>
	</header>