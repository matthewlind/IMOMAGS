<div class="community-header">
	<div class="header-section community-logo">
		<a href="/rack-room/"><img src="/wp-content/themes/petersenshunting/images/logos/TheRackRoom.png" alt="Rack Room Photos" title="Rack Room Photos" /></a>
		<div class="community-mobile-menu"><div class="select-arrow"></div>Photos Menu</div>
	</div>
	<?php $hunting = get_field("hunting_menu", "options"); ?>
	<div class="header-section menu-hunt">
		<ul class="menu">
			<?php if( $hunting ){ 
				foreach( $hunting as $hunt ){  
					$categoryList = get_term_by('id', $hunt, 'category'); ?>
					<li class="sub-list"><a href="/rack-room?<?php echo $categoryList->slug; ?>" class="photo-menu" slug="<?php echo $categoryList->slug; ?>"><?php echo $categoryList->name; ?></a></li>
				<?php } ?>
			<?php } ?>
		</ul>
	</div>			
<div class="community-nav-below"><a href="/post-photo/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a></div>
</div>