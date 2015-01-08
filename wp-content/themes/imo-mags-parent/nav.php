<div class="community-header">
	<div class="header-section community-logo">
		<a href="/photos/"><img src="/wp-content/themes/gameandfish/images/yourphotos.png" alt="<?php echo $state ?> Game & Fish Photos" title="Game & Fish Photos" /></a>
		<div class="select-arrow"></div>
		<select id="state-select">
			<option value="" selected>Browse by State</option>
			<option value="/photos?arizona">Arizona</option>
			<option value="/photos?Alabama">Alabama</option>
			<option value="/photos?Alaska">Alaska</option>
			<option value="/photos?Arizona">Arizona</option>
			<option value="/photos?Arkansas">Arkansas</option>
			<option value="/photos?California">California</option>
			<option value="/photos?Colorado">Colorado</option>
			<option value="/photos?Connecticut">Connecticut</option>
			<option value="/photos?Delaware">Delaware</option>
			<option value="/photos?District-Of-Columbia">District Of Columbia</option>
			<option value="/photos?Florida">Florida</option>
			<option value="/photos?Georgia">Georgia</option>
			<option value="/photos?Hawaii">Hawaii</option>
			<option value="/photos?Idaho">Idaho</option>
			<option value="/photos?Illinois">Illinois</option>
			<option value="/photos?Indiana">Indiana</option>
			<option value="/photos?Iowa">Iowa</option>
			<option value="/photos?Kansas">Kansas</option>
			<option value="/photos?Kentucky">Kentucky</option>
			<option value="/photos?Louisiana">Louisiana</option>
			<option value="/photos?Maine">Maine</option>
			<option value="/photos?Maryland">Maryland</option>
			<option value="/photos?Massachusetts">Massachusetts</option>
			<option value="/photos?Michigan">Michigan</option>
			<option value="/photos?Minnesota">Minnesota</option>
			<option value="/photos?Mississippi">Mississippi</option>
			<option value="/photos?Missouri">Missouri</option>
			<option value="/photos?Montana">Montana</option>
			<option value="/photos?Nebraska">Nebraska</option>
			<option value="/photos?Nevada">Nevada</option>
			<option value="/photos?New-Hampshire">New Hampshire</option>
			<option value="/photos?New-Jersey">New Jersey</option>
			<option value="/photos?New-Mexico">New Mexico</option>
			<option value="/photos?New-York">New York</option>
			<option value="/photos?North-Carolina">North Carolina</option>
			<option value="/photos?North-Dakota">North Dakota</option>
			<option value="/photos?Ohio">Ohio</option>
			<option value="/photos?Oklahoma">Oklahoma</option>
			<option value="/photos?Oregon">Oregon</option>
			<option value="/photos?Pennsylvania">Pennsylvania</option>
			<option value="/photos?Rhode-Island">Rhode Island</option>
			<option value="/photos?South-Carolina">South Carolina</option>
			<option value="/photos?South-Dakota">South Dakota</option>
			<option value="/photos?Tennessee">Tennessee</option>
			<option value="/photos?Texas">Texas</option>
			<option value="/photos?Utah">Utah</option>
			<option value="/photos?Vermont">Vermont</option>
			<option value="/photos?Virginia">Virginia</option>
			<option value="/photos?Washington">Washington</option>
			<option value="/photos?West-Virginia">West Virginia</option>
			<option value="/photos?Wisconsin">Wisconsin</option>
			<option value="/photos?Wyoming">Wyoming</option>
		</select>

		<div class="community-mobile-menu"><div class="select-arrow"></div>Photos Menu</div>
	</div>
	<?php $hunting = get_field("hunting_menu", "options"); ?>
	<div class="header-section menu-hunt">
		<h3><a href="/photos?hunting">Hunting</a></h3>
		<ul class="menu">
			<?php if( $hunting ){ 
				foreach( $hunting as $hunt ){  
					$categoryList = get_term_by('id', $hunt, 'category'); ?>
					<li class="sub-list"><a href="/photos?<?php echo $categoryList->slug; ?>" class="photo-menu" slug="<?php echo $categoryList->slug; ?>"><?php echo $categoryList->name; ?></a></li>
				<?php } ?>
			<?php } ?>
		</ul>
	</div>
	<?php $fishing = get_field("fishing_menu", "options"); ?>
	<div class="header-section menu-fish">
		<h3><a href="/photos?fishing">Fishing</a></h3>
		<ul class="menu">
			<?php if( $fishing ){ 
				foreach( $fishing as $fish ){  
					$categoryList = get_term_by('id', $fish, 'category'); ?>
					<li class="sub-list"><a href="/photos?<?php echo $categoryList->slug; ?>" class="photo-menu" slug="<?php echo $categoryList->slug; ?>"><?php echo $categoryList->name; ?></a></li>
				<?php } ?>
			<?php } ?>
		</ul>
	</div>
</div>