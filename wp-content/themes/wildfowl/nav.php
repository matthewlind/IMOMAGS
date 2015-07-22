<div class="community-header">
	<div class="header-section community-logo">
		<a href="/photos/"><img src="/wp-content/themes/wildfowl/images/wildfowl-photos.png" alt="Reader Photos" title="Reader Photos" /></a>
		<div class="community-mobile-menu"><div class="select-arrow"></div>Photos Menu</div>
	</div>
	<?php $photosMenu = get_field("photos_menu", "options"); ?>
	<div class="header-section menu-hunt">
		<ul class="menu">
			<?php if( $photosMenu ){ 
				foreach( $photosMenu as $menu ){  
					$categoryList = get_term_by('id', $menu, 'category'); ?>
					<li class="sub-list"><a href="/photos?<?php echo $categoryList->slug; ?>" class="photo-menu" slug="<?php echo $categoryList->slug; ?>"><?php echo $categoryList->name; ?></a></li>
				<?php } ?>
			<?php } ?>
		</ul>
	</div>			
<div class="community-nav-below"><a href="/post-photo/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a></div>
</div>