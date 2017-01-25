jQuery( document ).ready(function($) {


	/*** Community menu ***/
	
	//Toggle Photos Menu
	$('.community-mobile-menu').on('click touchstart', function(e){
		e.preventDefault();
		$('.menu-hunt, .menu-fish').toggle();
	});
		
	//layout in columns
	if($(window).width() > 610){
	    var num_cols = 6,
	    container = $('.community-header ul.menu'),
	    listItem = 'li',
	    listClass = 'sub-list';
	    container.each(function() {
	        var items_per_col = new Array(),
	        items = $(this).find(listItem),
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
	            $(this).append($('<ul ></ul>').addClass(listClass));
	            for (var j = 0; j < items_per_col[i]; j++) {
	                var pointer = 0;
	                for (var k = 0; k < i; k++) {
	                    pointer += items_per_col[k];
	                }
	                $(this).find('.' + listClass).last().append(items[j + pointer]);
	            }
	        }
	    });
	    $(".community-header").show().css("overflow","visible");
	}

});