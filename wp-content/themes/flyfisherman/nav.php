<div class="community-header">
	<div class="header-section community-logo">
		<a href="/photos/"><img src="/wp-content/themes/flyfisherman/images/ff-photosflies-logo.png" alt="Flyfisherman Photos & Flies" title="Flyfisherman Photos & Flies" /></a>
		<?php if( !mobile() ){ ?>

		<?php } ?>
		<div class="community-mobile-menu"><div class="select-arrow"></div>Photos Menu</div>
		<div class="sponsor"><?php imo_dart_tag("240x60"); ?></div>
	</div>
	<?php $photos = get_field("photos_menu", "options"); ?>
	<div class="header-section menu-hunt">
		<h3><a href="/photos#fish-photos">Photos</a></h3>
		<?php if( $photos ){ 
			foreach( $photos as $photo ){  
				$categoryList = get_term_by('id', $photo, 'category');
				if($categoryList->slug == "scenic-photos"){ ?>
					<a href="/photos#<?php echo $categoryList->slug; ?>&all" class="photo-menu" slug="<?php echo $categoryList->slug; ?>"><?php echo $categoryList->name; ?></a>	
				<?php }else{ ?>
					<a href="/photos#<?php echo $categoryList->slug; ?>&fish-photos" class="photo-menu" slug="<?php echo $categoryList->slug; ?>"><?php echo $categoryList->name; ?></a>	
				<?php } 
				} 
			} ?>
    </div>
	<?php $flies = get_field("flies_menu", "options"); ?>
	<div class="header-section menu-fish">
		<h3><a href="/photos#flies">Flies</a></h3>
		<?php if( $flies ){ 
			foreach( $flies as $fly ){  
				$categoryList = get_term_by('id', $fly, 'category'); ?>
				<a href="/photos#<?php echo $categoryList->slug; ?>&flies" class="photo-menu" slug="<?php echo $categoryList->slug; ?>"><?php echo $categoryList->name; ?></a>	
			<?php } ?>
		<?php } ?>
	</div>
</div>