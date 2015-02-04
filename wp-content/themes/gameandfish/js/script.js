jQuery(document).ready(function($) {
	
	/*** Community menu ***/	
	
	//Toggle Photos Menu
	jQuery('.community-mobile-menu').on('click touchstart', function(e){
		e.preventDefault();
		jQuery('.menu-hunt, .menu-fish').toggle();
	});
	
	jQuery('#state-select').bind('change', function () {
	var url = jQuery(this).val(); // get selected value
	if (url) { // require a URL
		window.location = url; // redirect
	}
	return false;
	});	
	//replace category links from WP menu with community link urls
	jQuery("#menu-hunting-community-menu li a, #menu-fishing-community-menu li a").each(function() {
		var href = jQuery(this).attr('href');
		var site = document.domain;
		href = href.replace(site, "");
		href = href.replace("http://", "");
		jQuery(this).attr('href', '/photos' + href);
	});
	
	//layout in columns
	if(jQuery(window).width() > 610){
	    var num_cols = 3,
	    container = jQuery('.community-header ul.menu'),
	    listItem = 'li',
	    listClass = 'sub-list';
	    container.each(function() {
	        var items_per_col = new Array(),
	        items = jQuery(this).find(listItem),
	        min_items_per_col = Math.floor(items.length / num_cols),
	        difference = items.length - (min_items_per_col * num_cols);
	        for (var i = 0; i < num_cols; i++) {
	            if (i < difference) {
	                items_per_col[i] = min_items_per_col + 1;
	            } else {
	                items_per_col[i] = min_items_per_col;
	            }
	        }
	        for (var i = 0; i < num_cols; i++) {
	            jQuery(this).append(jQuery('<ul ></ul>').addClass(listClass));
	            for (var j = 0; j < items_per_col[i]; j++) {
	                var pointer = 0;
	                for (var k = 0; k < i; k++) {
	                    pointer += items_per_col[k];
	                }
	                jQuery(this).find('.' + listClass).last().append(items[j + pointer]);
	            }
	        }
	    });
	    jQuery(".community-header").show().css("overflow","visible");
	}	
	
});


