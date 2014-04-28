<div class="community-header">
	<div class="header-section community-logo">
		<a href="/photos/"><img src="/wp-content/themes/gameandfish/images/yourphotos.png" alt="<?php echo $state ?> Game & Fish Photos" title="Game & Fish Photos" /></a>
		<div class="community-mobile-menu"><div class="select-arrow"></div>Photos Menu</div>
		<div class="sponsor"><?php imo_dart_tag("240x60"); ?></div>
	</div>
	<div class="header-section menu-hunt">
		<h3><a href="/photos/hunting">Hunting</a></h3>
		<?php if(has_nav_menu( 'hunting' )){
	    	wp_nav_menu(array(
	            'menu_class'=>'menu',
	            'theme_location'=>'hunting',
			));  
        } ?>
	</div>

	<div class="header-section menu-fish">
		<h3><a href="/photos/fishing">Fishing</a></h3>
		<?php if(has_nav_menu( 'fishing' )){
	    	wp_nav_menu(array(
	            'menu_class'=>'menu',
	            'theme_location'=>'fishing',
			));  
        } ?>
	</div>
</div>