jQuery(document).ready(function ($) {

	//TRADING POST PAGE
	if($(".trading-post").length){
		//trading post social icons
		$(".trading-post .entry-content .wpsocialite.small").remove();
		
		$(document).bind('scroll',function(e){
		    $('.post').each(function(){
		        if (
		           $(this).offset().top < window.pageYOffset + 10
					//begins before top
					&& $(this).offset().top + $(this).height() > window.pageYOffset + 10
					//but ends in visible area
					//+ 10 allows you to change hash before it hits the top border
					        ) {
		            slug = $(this).attr("data-slug");
		            title = $(this).find(".entry-title a").attr("data-title");
					// Detecting IE
				    var oldIE;
				    if ($('html').is('#ie6, #ie7, #ie8, #ie9')) {
				        oldIE = true;
				    }
					if(!oldIE){
						updateURL(slug,title);
					}
		        }
		    });
		});
				
				
		function updateURL(slug,title){
			// strip out the current slug and push the new slug
		    var url = window.location.pathname.toString();
		    var newSlug = url.replace(url, slug);
			//change the url
			window.history.pushState({ slug: slug }, title, "/trading-post/" + newSlug );
			$('title').text(title);
			_gaq.push(['_trackPageview', window.location.pathname + slug]);
			//track back/foward browser history 
			window.onpopstate = function(event) {
	        	slug = event.state.slug;
	        	$('title').text(title);
	        	//console.log("#" + slug);
				$('html, body').animate({
			        scrollTop: $("#" + slug).offset().top
			    }, 0);
			};
		}
	
	
		
		$('select.trading-post-filter').on('change', function (e) {
			var catID = this.value;
			var tradingPostName = "Trading Post";
			$(".loading-gif").show();
			cat_ajax_get(tradingPostName,catID);
		});
				
							
		function cat_ajax_get(tradingPostName,catID) {
			var data;
			var ajaxurl = '/wp-admin/admin-ajax.php';
		    $.ajax({
		        type: 'POST',
		        url: ajaxurl,
		        data: {"action": "cat-filter", tradingPost: tradingPostName, cat: catID },
		        success: function(response) {
	
					if(!data){
						console.log("help!");
					}
		        	$(".main-content-preppend").html("");
	              	$(response).appendTo(".main-content-preppend");	        
			        $(".loading-gif").hide();
					//_gaq.push(['_trackPageview', window.location.pathname + slug]);
				
							
		        return false;
		        }
		    });
		}
	}
});