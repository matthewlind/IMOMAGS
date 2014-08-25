jQuery(document).ready(function ($) {
	
	//var _gaq = _gaq || [];
	
	//brightcove video portal
	if( $("#video-gallery").length ){
	
		var player,
		video_id,
		title,
		description,
		slug,
		img_url,			
		post_url;
		
		$(".wpsocialite.small").remove();	

		var bcID;
		var video_ids = [];
		$( "#video-thumbs li a" ).each(function( index ) {
			video_ids.push($(this).attr("data-videoid"));	
		});
		
		(function() {
			
			var mediaAPI = "http://api.brightcove.com/services/library?command=find_videos_by_ids&video_ids=" + video_ids + "&callback=?";		
			$.getJSON( mediaAPI, {
			    token: "7oKam2ROupxh4_WO4dCRtYbABPwtXXxxQ1XBp_Md28jGiX_j4jWTGg..",
			    fields: "id,thumbnailURL",
			    media_delivery: "http",
			    format: "jsonp"
			})
			.done(function( data ) {
				//$.each( data.items, function( index, value ) {
					//$( "#video-thumbs #thumb-" + index ).find("a").prepend("<img src=" + value.thumbnailURL + " />");
				//});
		    });
		})();

		loadVideoOnPageLoad();
		
		//load the data differently for category and single pages
		function loadVideoOnPageLoad(){
			if($(".single-format-video").length){
				video_id = $(".video-title").attr("data-videoid");
				title = $(".video-title").attr("data-title");
				description = $(".video-title").parent().find(".data-description").html();
				slug = $(".video-title").attr("data-slug");
				img_url = $(".video-title").attr("data-img_url");
				post_url = $(".video-title").attr("data-post_url");
				videoInit();
			}else{
				video_id = $("#video-thumbs li").first().find("a").attr("data-videoid");
				title = $("#video-thumbs li").first().find("a").attr("data-title");
				description = $("#video-thumbs li").first().parent().find(".data-description").html();
				slug = $("#video-thumbs li").first().find("a").attr("data-slug");
				img_url = $("#video-thumbs li").first().find("a").attr("data-img_url");
				post_url = $("#video-thumbs li").first().find("a").attr("data-post_url");
				videoInit();
			}
			
		}
		
		jQuery(window).bind('orientationchange', function() {
			loadVideo(video_id);
		});
		
		//initiate video on click
		$("a.video-thumb").click(function(){
			video_id = $(this).attr("data-videoid");
			title = $(this).attr("data-title");
			description = $(this).parent().find(".data-description").html();
			slug = $(this).attr("data-slug");
			img_url = $(this).attr("data-img_url");
			post_url = $(this).attr("data-post_url");
			
			// place data into html
			$("h1.video-title").text(title);
			$(".video-description").html(description);
			
			videoInit();
			$('html, body').animate({
		        scrollTop: $("#when-to-watch").offset().top
		    }, 0);
			_gaq.push(['_trackPageview', window.location.pathname + slug]);
		});
			
		function videoInit(){
			$('html, body').animate({
		        scrollTop: $("#show-destination").offset().top
		    }, 0);
			moreContent();
			loadVideo(video_id);
			updateSocial(slug,title,post_url,img_url);
			updateURL();
		}
		
		function updateURL(){
			// strip out the current slug and push the new slug
		    var url = window.location.pathname.toString();
		    var newSlug = url.replace(url, slug);
			//change the url
			window.history.pushState({ id: video_id, slug: slug, title: title, description: description, post_url: post_url, img_url: img_url }, title, "/tv/" + newSlug );
			//track back/foward browser history and reload the videos
			window.onpopstate = function(event) {
	            video_id = event.state.id;
	            loadVideo(video_id);
	            // place data into html
				$("h1.video-title").text(event.state.title);
				$(".video-description").html(event.state.description);
				slug = event.state.slug;
				title = event.state.title;
				post_url = event.state.post_url;
				img_url = event.state.img_url;
				$('title').text(title);
				_gaq.push(['_trackPageview', window.location.pathname + slug]);
				updateSocial(slug,title,post_url,img_url);
			};
		}
		
		function updateSocial(slug,title,post_url,img_url){
						
			try{
				$('title').text(title);
				$('meta[property=og\\:url]').attr('content',post_url);
				$('meta[property=og\\:title]').attr('content',title);
				$('meta[property=og\\:image]').attr('content',img_url);	
				$('#photoGalleryTitle .fb-share-button').attr("data-href",post_url);
				FB.XFBML.parse();
			}catch(e){
				//console.log(e);
			}
			//video portal
			$(".sidebar .fb-like").attr("data-href",post_url);
			$(".sidebar .twitter-share-button").remove();
			$('<a href="https://twitter.com/share" class="twitter-share-button" data-url="' + post_url + '">Tweet</a>').insertAfter(".sidebar .fb-like");
			//show page
			$(".reload-fb").attr("href","http://www.facebook.com/sharer.php?u=" + post_url + "&t=" + title);
			$(".reload-twitter").attr("href","http://twitter.com/home/?status=" + title + " - " + post_url);
			$(".reload-google").attr("href","https://plus.google.com/share?url=" + post_url);
		}
		
		//load videos
		function loadVideo(id){
		    
		    var playerID = $("#show-destination").attr("playerID");
		    videoLink = $("#show-destination").attr("videoLink");
		    adServerURL = $("#show-destination").attr("adServerURL");
		    		    
		    var htm = '';
		   
		    htm = '<object id="myExperience" class="BrightcoveExperience">'
		    +  '<param name="bgcolor" value="#000000" />'
		    +  '<param name="wmode" value="transparent">'
		    +  '<param name="width" value="100%" />'
		    +  '<param name="height" value="350" />'
		    +  '<param name="playerID" value="' + playerID + '" />'
		    +  '<param name="isVid" value="true" />'
		    +  '<param name="isUI" value="true" />'
		    +  '<param name="quality" value="high">'
		    +  '<param name="linkBaseURL" value="' + videoLink + '" />'
			+  '<param name="@videoPlayer" value="' + id + '" /></object>'
			+  '<param name="adServerURL" value="' + adServerURL + '" />';
		    
		
			$("#player").html(htm);
			player = brightcove.createExperiences();
			
		}
	
		//hide long description content
		function moreContent(){
			if($(".content-height").height() > 340){
				$(".video-more-content").show();
				$(".content-height").css("max-height", "285px");
			}else if($(".content-height").height() < 340){
				$(".video-more-content").hide();
				$(".content-height").css("max-height","100%");
			}
	
			$(".video-more-content .more-link").click(function(){
				$(".video-more-content").hide();
				$(".content-height").css("max-height","100%");
			});
		}
		
		//video filter
		var catID = "all";
		var postoffset = 0;
		$("a.paginate-videos").click(function(){
			postoffset = postoffset + 8;
			$(".loading-gif").show();
			cat_ajax_get(catID);
		});
		
		$('select.seasons-filter').on('change', function (e) {
			postoffset = 0;
			var catID = this.value;
			$(".loading-gif").show();
			cat_ajax_get(catID);
			$("a.paginate-videos").show();
		});
		
		$(".video-ajax").click(function(){
			$("#video-filter a").removeClass("video-thumb-active");
			$(this).addClass("video-thumb-active");
			postoffset = 0;
			catID = $(this).attr("slug");
			$(".loading-gif").show();
			cat_ajax_get(catID);
			$("a.paginate-videos").show();
		});
		
		function cat_ajax_get(catID) {
			var pollInterval;
		    var ajaxurl = '/wp-admin/admin-ajax.php';
		    $.ajax({
		        type: 'POST',
		        url: ajaxurl,
		        data: {"action": "load-filter", cat: catID, offset: postoffset },
		        success: function(response) {
                  
		            if(postoffset > 1){
		            	if(!response){
		            		$("a.paginate-videos").hide();
			            	$('<h3 class="no-mo-videos">No more videos, please try a different category.</h3>').appendTo("#video-thumbs");
		            	}else{
			            	$(response).appendTo("#video-thumbs");
		            	}
		            }else{
		            	$("#video-thumbs").html(response);
		            }
		            $(".loading-gif").hide();
					//initiate video on click
					$("a.video-thumb").on("click", function(){
						video_id = $(this).attr("data-videoid");
						title = $(this).attr("data-title");
						description = $(this).parent().find(".data-description").html();
						slug = $(this).attr("data-slug");
						img_url = $(this).attr("data-img_url");
						post_url = $(this).attr("data-post_url");
						
						// place data into html
						$("h1.video-title").text(title);
						$(".video-description").html(description);
						
						_gaq.push(['_trackPageview', window.location.pathname + slug]);
						videoInit();
						
					});
		            return false;
		        }
		    });
		}
		

	}
	
	//Gallery Page
    if( $("#show-gallery").length ){
    	$(".wpsocialite.small").remove();	
    
		if( $(".category-show-galleries").length ){
			title =  $(".video-title").text();
			slug = $("#show-gallery").attr("slug");
			window.history.replaceState(null, title, slug );
		}
		
		$('#carousel').flexslider({
		    animation: "slide",
		    controlNav: false,
		    directionNav: true, 
		    animationLoop: false,
		    slideshow: false,
		    itemWidth: 200,
		    asNavFor: '#show-gallery'
		});
		
		$('#show-gallery').flexslider({
	        animation: "slide",
	        animationSpeed: 200,
	        slideshow: false,
	        controlNav: false,
	        sync: "#carousel",
	        start: function(){
	        	$("#show-gallery .flex-direction-nav").appendTo("#show-gallery .flex-viewport");
	    		imageTitle = $(".flex-active-slide").find(".image-title").text();
		    	$(".side-title").text(imageTitle);
	        },
	        after: function(){
		        imageTitle = $(".flex-active-slide").find(".image-title").text();
		    	$(".side-title").text(imageTitle);
	        }
	    });
	    
	    $('#more-galleries').flexslider({
	    	animation: "slide",
	        animationSpeed: 200,
	        slideshow: false,
	        controlNav: false,
	        start: function(){
	        	$("#more-galleries .flex-direction-nav").appendTo("#more-galleries .flex-viewport");
	        }
	     });
	}
	
});

	
	
	
	
	
	
	
	
	
	
	
	
	
	
