<div class="community-header">
	<div class="header-section community-logo">
		<a href="/photos/"><img src="/wp-content/themes/gameandfish/images/yourphotos.png" alt="<?php echo $state ?> Game & Fish Photos" title="Game & Fish Photos" /></a>
		<?php if( !mobile() ){ ?>
			<div id="state-menu-bar" class="btn-group btn-bar">
			    <button type="button" class="btn btn-default desktop">
			    <span class="menu-title browse-community" style="text-transform:normal;">Browse by State</span> <span class="caret"></span>
			    </button>
			</div>
			
			<!-- <div id="state-menu-bar" class="btn-group btn-bar">
			    <button type="button" class="btn btn-default desktop" data-toggle="dropdown">
			    <span class="menu-title browse-community" style="text-transform:normal;">Browse by State</span> <span class="caret"></span>
			    </button>
			</div> -->
		<?php } ?>
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
	<?php if( !mobile() ):?>
		<ul id="state-list-menu" class="dropdown-menu filter desktop"></ul>
	<?php endif; ?>
</div>