<div class="community-header">
	<div class="header-section community-logo">
		<a href="/photos/"><img src="/wp-content/themes/flyfisherman/images/ff-photosflies-logo.png" alt="Flyfisherman Photos & Flies" title="Flyfisherman Photos & Flies" /></a>
		<label class="upload-button"><a href="/post-photo/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a></label>
		<div class="community-mobile-menu"><div class="select-arrow"></div>Photos Menu</div>
	</div>
	<?php $photos = get_field("photos_menu", "options"); ?>
	<div class="header-section menu-hunt">
		<h3><a href="/photos?fish-photos">Photos</a></h3>
		<ul class="menu">
			<?php if( $photos ){ 
				foreach( $photos as $photo ){  
					$categoryList = get_term_by('id', $photo, 'category'); ?>
						<li class="sub-list"><a href="/photos?<?php echo $categoryList->slug; ?>&fish-photos" class="photo-menu" slug="<?php echo $categoryList->slug; ?>"><?php echo $categoryList->name; ?></a></li>	
				<?php } 
			} ?>
			<li class="sub-list"><a href="/photos?scenic-photos" class="photo-menu" slug="scenic-photos">Scenic Photos</a></li>
		</ul>	
    </div>
	<?php $flies = get_field("flies_menu", "options"); ?>
	<div class="header-section menu-fish">
		<h3><a href="/photos?flies">Flies</a></h3>
			<ul class="menu">
			<?php if( $flies ){ 
				foreach( $flies as $fly ){  
					$categoryList = get_term_by('id', $fly, 'category'); ?>
					<li class="sub-list"><a href="/photos?<?php echo $categoryList->slug; ?>&flies" class="photo-menu" slug="<?php echo $categoryList->slug; ?>"><?php echo $categoryList->name; ?></a></li>
				<?php } ?>
			<?php } ?>
		</ul>
	</div>
</div>