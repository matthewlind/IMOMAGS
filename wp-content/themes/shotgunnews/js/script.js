var tradingPost = (function(e){
	var $ = jQuery;

		
	var tradingPost = {
		init: function(){	
		
			this.scrollPage();
			this.filterCats();
		},
		scrollPage : function(e){
			
			var self = this;
			var tradingPostName = "Trading Post"
			var catID = "";
			var postoffset = 0;
			//Infinate Pagination
			$(window).scroll(function(){
                if($(window).scrollTop() > $(".foot-social").offset().top - 1000){
                    postoffset = postoffset + 10;
					$("#ajax-loader").show();
					self.filterCall(tradingPostName,catID,postoffset);
                }
            }); 
            
			$(document).on('scroll',function(e){
				
			    $('.post').each(function(e){
			   
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
							self.updateURL(slug,title);
						}
			        }
			    });
			});

					
		},
		updateURL: function(slug,title){
			// strip out the current slug and push the new slug
		    var url = window.location.pathname.toString();
		    var newSlug = url.replace(url, slug);
			//change the url
			window.history.replaceState({ slug: slug }, title, "/trading-post/" + newSlug );
			$('title').text(title);
			_gaq.push(['_trackPageview', window.location.pathname + slug]);
			//track back/foward browser history 
			window.onpopstate = function(event) {
	        	slug = event.state.slug;
	        	$('title').text(title);
				$('html, body').animate({
			        scrollTop: $("#" + slug).offset().top
			    }, 0);
			};
		
	
			},
		filterCats: function(slug,title){
			var self = this;
			var tradingPostName = "Trading Post"
			var catID = "";
			var postoffset = 0;
			$("a.paginate-posts").click(function(){
				postoffset = postoffset + 10;
				$("#ajax-loader").show();
				self.filterCall(tradingPostName,catID,postoffset);
			});
			
			$('select.trading-post-filter').on('change', function (e) {
				postoffset = 0;
				catID = this.value;
				$(".loading-gif").show();
				$(".main-content-preppend").html("");
				self.filterCall(tradingPostName,catID,postoffset);
			});
			
		},
		filterCall: function(tradingPostName,catID,postoffset){
			var self = this;
			var data;
			var ajaxurl = '/wp-admin/admin-ajax.php';
		    $.ajax({
		        type: 'POST',
		        url: ajaxurl,
		        data: {"action": "cat-filter", tradingPost: tradingPostName, cat: catID, offset: postoffset },
		        success: function(response) {
					if(!response){
						$("#ajax-loader").remove();
					}
	              	$(response).appendTo(".main-content-preppend");	        
			        $("#ajax-loader, .loading-gif").hide();
			        FB.XFBML.parse();
			        twttr.widgets.load();
			        $(".trading-post .entry-content .wpsocialite.small").remove();
					//_gaq.push(['_trackPageview', window.location.pathname + slug]);
					return false;
		        }
		    });

		
		}

	};

	return {
		init: function(){
			tradingPost.init();
		}
	}
});

//Instantiate
var onPageLoad = new tradingPost;


jQuery( document ).ready(function( $ ){
	
	//Initialize
	if($(".trading-post").length){
		$(".trading-post .entry-content .wpsocialite.small").remove();
		onPageLoad.init();
	}
});