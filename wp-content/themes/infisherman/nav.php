<div class="community-header">
	<div class="header-section community-logo">
		<a href="/photos/"><img src="/wp-content/themes/infisherman/images/fishhead-logo.png" alt="fishhead-logo" alt="In-Fisherman Photos" title="In-Fisherman Photos" /></a>
		<div class="community-mobile-menu"><div class="select-arrow"></div>Photos Menu</div>
	</div>
	<?php $photos = get_field("photos_menu", "options"); ?>
	<div class="header-section menu-hunt">
		<ul class="menu">
			<?php if( $photos ){ 
				foreach( $photos as $photo ){  
					$categoryList = get_term_by('id', $photo, 'category'); ?>
						<li class="sub-list"><a href="/photos?<?php echo $categoryList->slug; ?>" class="photo-menu" slug="<?php echo $categoryList->slug; ?>"><?php echo $categoryList->name; ?></a></li>	
				<?php } 
			} ?>
		</ul>	
    </div>
    <div class="community-nav-below">
		<a href="/post-photo/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a>
		<a href="/entry-form/"><span class="singl-post-photo"><span>Enter Master Angler</span></span></a>
	</div>
</div>