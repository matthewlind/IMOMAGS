<div class="community-header">
	<div class="header-section community-logo">
		<a href="/community/"><img src="/wp-content/themes/naw/images/naw-community.jpg" alt="Reader Photos" title="Reader Photos" /></a>
		<div class="community-mobile-menu"><div class="select-arrow"></div>Community Menu</div>
	</div>
	<?php 
		$photosMainMenu = get_field("community_main_menu", "options"); 
		$photosMenu = get_field("community_menu", "options"); 
	?>
	<div class="header-section menu-main">
		<ul class="">
			<?php if( $photosMainMenu ){ 
				foreach( $photosMainMenu as $menu ){  
					$categoryList = get_term_by('id', $menu, 'category'); ?>
					<li class="sub-list"><a href="/community?<?php echo $categoryList->slug; ?>" class="photo-menu" slug="<?php echo $categoryList->slug; ?>"><?php echo $categoryList->name; ?></a></li>
				<?php } ?>
			<?php } ?>
		</ul>
	</div>
	<div class="header-section menu-hunt">
		<ul class="menu">
			<?php if( $photosMenu ){ 
				foreach( $photosMenu as $menu ){  
					$categoryList = get_term_by('id', $menu, 'category'); ?>
					<li class="sub-list"><a href="/community?<?php echo $categoryList->slug; ?>" class="photo-menu" slug="<?php echo $categoryList->slug; ?>"><?php echo $categoryList->name; ?></a></li>
				<?php } ?>
			<?php } ?>
		</ul>
	</div>
	<div class="community-nav-below">
		<a href="/post-photo/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a>
		<div class="community-state-drop">
			<div class="select-arrow"></div>
			<select id="state-select">
				<option value="" selected>Browse by State</option>
				<option value="/community?arizona">Arizona</option>
				<option value="/community?Alabama">Alabama</option>
				<option value="/community?Alaska">Alaska</option>
				<option value="/community?Arizona">Arizona</option>
				<option value="/community?Arkansas">Arkansas</option>
				<option value="/community?California">California</option>
				<option value="/community?Colorado">Colorado</option>
				<option value="/community?Connecticut">Connecticut</option>
				<option value="/community?Delaware">Delaware</option>
				<option value="/community?District-Of-Columbia">District Of Columbia</option>
				<option value="/community?Florida">Florida</option>
				<option value="/community?Georgia">Georgia</option>
				<option value="/community?Hawaii">Hawaii</option>
				<option value="/community?Idaho">Idaho</option>
				<option value="/community?Illinois">Illinois</option>
				<option value="/community?Indiana">Indiana</option>
				<option value="/community?Iowa">Iowa</option>
				<option value="/community?Kansas">Kansas</option>
				<option value="/community?Kentucky">Kentucky</option>
				<option value="/community?Louisiana">Louisiana</option>
				<option value="/community?Maine">Maine</option>
				<option value="/community?Maryland">Maryland</option>
				<option value="/community?Massachusetts">Massachusetts</option>
				<option value="/community?Michigan">Michigan</option>
				<option value="/community?Minnesota">Minnesota</option>
				<option value="/community?Mississippi">Mississippi</option>
				<option value="/community?Missouri">Missouri</option>
				<option value="/community?Montana">Montana</option>
				<option value="/community?Nebraska">Nebraska</option>
				<option value="/community?Nevada">Nevada</option>
				<option value="/community?New-Hampshire">New Hampshire</option>
				<option value="/community?New-Jersey">New Jersey</option>
				<option value="/community?New-Mexico">New Mexico</option>
				<option value="/community?New-York">New York</option>
				<option value="/community?North-Carolina">North Carolina</option>
				<option value="/community?North-Dakota">North Dakota</option>
				<option value="/community?Ohio">Ohio</option>
				<option value="/community?Oklahoma">Oklahoma</option>
				<option value="/community?Oregon">Oregon</option>
				<option value="/community?Pennsylvania">Pennsylvania</option>
				<option value="/community?Rhode-Island">Rhode Island</option>
				<option value="/community?South-Carolina">South Carolina</option>
				<option value="/community?South-Dakota">South Dakota</option>
				<option value="/community?Tennessee">Tennessee</option>
				<option value="/community?Texas">Texas</option>
				<option value="/community?Utah">Utah</option>
				<option value="/community?Vermont">Vermont</option>
				<option value="/community?Virginia">Virginia</option>
				<option value="/community?Washington">Washington</option>
				<option value="/community?West-Virginia">West Virginia</option>
				<option value="/community?Wisconsin">Wisconsin</option>
				<option value="/community?Wyoming">Wyoming</option>
			</select>
		</div>
	</div>
</div>			
