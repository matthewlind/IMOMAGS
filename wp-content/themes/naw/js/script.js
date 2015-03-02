jQuery(document).ready(function($) {
	var postoffset = 0;
	var catID = jQuery(".posts-list").attr("id");
	
	jQuery("a.paginate-photos").click(function(){
		postoffset = postoffset + 10;
		jQuery(".loading-gif").show();
		var data;
	    jQuery.ajax({
	        type: 'POST',
	        url: '/wp-admin/admin-ajax.php',
	        data: {"action": "fishhead-photos-filter", cat: catID, offset: postoffset},
	        success: function(response) {
            	if(response.length <= 1){
            		jQuery(".pager-holder").hide();
	            	jQuery('<h3 class="no-mo-videos">No more photos, please try a different category.</h3>').appendTo(".main-content-preppend");
            	}else{
	            	jQuery(response).appendTo(".main-content-preppend");
            	}
	            jQuery("#ajax-loader").hide();
	            //refresh the sticky ad on load more
                if (jQuery(window).width() >  610 ) {
                	document.getElementById('sticky-iframe-ad').contentWindow.location.reload();
                	jQuery(".sidebar.advert").css({
                    	display: 'block',
						position: 'fixed',
						top: 10
					});
                }
				FB.XFBML.parse();
	            return false;
	        }
	    });
     
	       
	});
	

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
	
	//layout in columns
	if(jQuery(window).width() > 610){
	    var num_cols = 4,
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
