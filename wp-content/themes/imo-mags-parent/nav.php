<div class="community-header">
	<div class="header-section community-logo">
		<a href="/photos/"><img src="/wp-content/themes/gameandfish/images/yourphotos.png" alt="<?php echo $state ?> Game & Fish Photos" title="Game & Fish Photos" /></a>
		<div class="btn-group btn-bar">
		    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
		    <span class="menu-title browse-community" style="text-transform:normal;">Browse by State</span> <span class="caret"></span>
		    </button>
		    <ul class="dropdown-menu filter" role="menu">
		        <li><a href="" class="filter-menu" state="AL">alabama</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="AK">alaska</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="AZ">arizona</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="AR">arkansas</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="CA">california</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="CO">colorado</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="CT">connecticut</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="DE">delaware</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="DC">district of columbia</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="FL">florida</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="GA">georgia</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="HI">hawaii</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="ID">idaho</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="IL">illinois</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="IN">indiana</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="IA">iowa</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="KS">kansas</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="KY">kentucky</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="LA">louisiana</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="ME">maine</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="MD">maryland</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="MA">massachusetts</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="MI">michigan</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="MN">minnesota</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="MS">mississippi</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="MO">missouri</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="MT">montana</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="NE">nebraska</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="NV">nevada</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="NH">new hampshire</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="NJ">new jersey</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="NM">new mexico</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="NY">new york</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="NC">north carolina</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="ND">north dakota</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="OH">ohio</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="OK">oklahoma</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="OR">oregon</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="PA">pennsylvania</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="RI">rhode island</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="SC">south carolina</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="SD">south dakota</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="TN">tennessee</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="TX">texas</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="UT">utah</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="VT">vermont</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="VA">virginia</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="WA">washington</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="WV">west virginia</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="WI">wisconsin</a></li><div class="divider"></div>
		        <li><a href="" class="filter-menu" state="WY">wyoming</a></li><div class="divider"></div>
		    </ul>
		</div>
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