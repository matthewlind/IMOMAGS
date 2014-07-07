<div class="community-header">
	<div class="header-section community-logo">
		<a href="/photos/"><img src="/wp-content/themes/flyfisherman/images/ff-photosflies-logo.png" alt="Flyfisherman Photos & Flies" title="Flyfisherman Photos & Flies" /></a>
		<?php if( !mobile() ){ ?>

		<?php } ?>
		<div class="community-mobile-menu"><div class="select-arrow"></div>Photos Menu</div>
		<div class="sponsor"><?php imo_dart_tag("240x60"); ?></div>
	</div>
	<div class="header-section menu-hunt">
		<h3><a href="/photos/fish-photos">Photos</a></h3>
		<?php if(has_nav_menu( 'photos' )){
	    	wp_nav_menu(array(
	            'menu_class'=>'menu',
	            'theme_location'=>'photos',
			));
        } ?>
	</div>

	<div class="header-section menu-fish">
		<h3><a href="/photos/flies">Flies</a></h3>
		<?php if(has_nav_menu( 'flies' )){
	    	wp_nav_menu(array(
	            'menu_class'=>'menu',
	            'theme_location'=>'flies',
			));
        } ?>
	</div>
</div>