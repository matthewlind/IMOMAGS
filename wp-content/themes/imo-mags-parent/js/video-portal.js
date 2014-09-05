var videoPortal = (function(e){
	var $ = jQuery;
	var player,
		video_id,
		title,
		description,
		slug,
		img_url,			
		post_url;
		
	var videoPortal = {
		init: function(){	
			
			this.loadVideoOnPageLoad();
			this.videoFilter();
			this.thumbClick();

		},
		loadVideoOnPageLoad : function(){

			var self = this;
			self.brightcoveRequest();
			$(".wpsocialite.small").remove();	
			if($(".single-format-video").length){
				video_id = $(".video-title").attr("data-videoid");
				title = $(".video-title").attr("data-title");
				description = $(".video-title").parent().find(".data-description").html();
				slug = $(".video-title").attr("data-slug");
				img_url = $(".video-title").attr("data-img_url");
				post_url = $(".video-title").attr("data-post_url");
			}else{
				video_id = $("#video-thumbs li").first().find("a").attr("data-videoid");
				title = $("#video-thumbs li").first().find("a").attr("data-title");
				description = $("#video-thumbs li").first().parent().find(".data-description").html();
				slug = $("#video-thumbs li").first().find("a").attr("data-slug");
				img_url = $("#video-thumbs li").first().find("a").attr("data-img_url");
				post_url = $("#video-thumbs li").first().find("a").attr("data-post_url");
			}
					
			self.videoInit(video_id,slug,title,description,post_url,img_url);
			jQuery(window).bind('orientationchange', function() {
				self.loadVideo(video_id);
			});
			Socialite.load();
		},
		thumbClick : function(){
			var self = this;
			//initiate video on click
			$("a.video-thumb").click(function(){
				$('html, body').animate({
			        scrollTop: $("#when-to-watch").offset().top
			    }, 0);
				video_id = $(this).attr("data-videoid");
				title = $(this).attr("data-title");
				description = $(this).parent().find(".data-description").html();
				slug = $(this).attr("data-slug");
				img_url = $(this).attr("data-img_url");
				post_url = $(this).attr("data-post_url");
				
				// place data into html
				$("h1.video-title").text(title);
				$(".video-description").html(description);
				
				self.videoInit(video_id,slug,title,description,post_url,img_url);
				self.socialite(video_id,slug,title,description,post_url,img_url);
			    
			
			//show page default
				_gaq.push(['_trackPageview', window.location.pathname + slug]);
			});
		},
		socialite : function(video_id,slug,title,description,post_url,img_url){
			$(".wpsocialite.small").remove();	
			//socialite
			$(".social-buttons li").remove();
			$('<li><a href="http://twitter.com/share" class="socialite twitter-share reload-twitter" data-text="' + title + '" data-url="' + post_url + '" data-count="none" rel="nofollow" target="_blank"><span class="vhidden"></span></a></li><li><a href="https://plus.google.com/share?url=<' + post_url + '" data-annotation="none" class="socialite googleplus-one g-plusone reload-google" data-href="' + post_url + '" rel="nofollow" target="_blank"><span class="vhidden"></span></a></li> <li><a href="http://www.facebook.com/sharer.php?u=' + post_url + '&t=' + title + '" class="socialite facebook-like reload-fb" data-href="' + post_url + '" data-send="false" data-layout="button" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden"></span></a></li>').appendTo(".social-buttons");
			Socialite.load();
		},
		videoFilter : function(){
			var self = this;
			//video filter
			var catID = "all";
			var postoffset = 0;
			$("a.paginate-videos").click(function(){
				postoffset = postoffset + 8;
				$(".loading-gif").show();
				self.getAJAX(catID,postoffset);
			});
			
			$('select.seasons-filter').on('change', function (e) {
				$("#video-filter a").removeClass("video-thumb-active");
				$("#video-filter a").first().addClass("video-thumb-active");
				postoffset = 0;
				var catID = this.value;
				$(".loading-gif").show();
				self.getAJAX(catID,postoffset);
				$("a.paginate-videos").show();
			});
			
			$(".video-ajax").click(function(){
				$("#video-filter a").removeClass("video-thumb-active");
				$(this).addClass("video-thumb-active");
				$('select.seasons-filter').val( $(".seasons-filter option:first").val() );
				postoffset = 0;
				catID = $(this).attr("slug");
				$(".loading-gif").show();
				self.getAJAX(catID,postoffset);
				$("a.paginate-videos").show();
			});
		},
		getAJAX : function(catID,postoffset){
			var self = this;
			var pollInterval;
		    var ajaxurl = '/wp-admin/admin-ajax.php';
		    $.ajax({
		        type: 'POST',
		        url: ajaxurl,
		        data: {"action": "load-filter", cat: catID, offset: postoffset },
		        xhrFields: {
				onprogress: function (e) {
						if (e.lengthComputable) {
							console.log(e.loaded / e.total * 100 + '%');
						}
					}
				},
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
					$("a.video-thumb").bind('click', self.thumbClick());
						
		            return false;
		        }
		    });
		
		},
		brightcoveRequest: function(){
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
		},
		videoInit: function(video_id,slug,title,description,post_url,img_url){
			var self = this;
			
			// Detecting IE
		    var oldIE;
		    if ($('html').is('#ie6, #ie7, #ie8, #ie9')) {
		        oldIE = true;
		    }
			if(!oldIE){
		    	self.updateURL(video_id,slug,title,description,post_url,img_url);
		    }
			self.updateSocial(slug,title,post_url,img_url);
			self.loadVideo(video_id);
			
		},
		updateURL: function(video_id,slug,title,description,post_url,img_url ){
			var self = this;
			
			// strip out the current slug and push the new slug
		    var url = window.location.pathname.toString();
		    var newSlug = url.replace(url, slug);
			//change the url
			var stateObj = { video_id: video_id, slug: slug, title: title, description: description, post_url: post_url, img_url: img_url };
			window.history.pushState(stateObj, title, "/tv/" + newSlug );
			//track back/foward browser history and reload the videos
			window.onpopstate = function(event) {
	            video_id = event.state.video_id;
	            self.loadVideo(video_id);
	            // place data into html
				$("h1.video-title").text(event.state.title);
				$(".video-description").html(event.state.description);
				slug = event.state.slug;
				title = event.state.title;
				post_url = event.state.post_url;
				img_url = event.state.img_url;
				$('title').text(title);
				_gaq.push(['_trackPageview', window.location.pathname + slug]);
			};
			
		},
		updateSocial: function(slug,title,post_url,img_url){
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
			
			
			/*$(".reload-fb").attr("href","http://www.facebook.com/sharer.php?u=" + post_url + "&t=" + title);
			$(".reload-twitter").attr("href","http://twitter.com/home/?status=" + title + " - " + post_url);
			$(".reload-google").attr("href","https://plus.google.com/share?url=" + post_url);*/
		},
		loadVideo: function(video_id){
			//load videos
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
			+  '<param name="@videoPlayer" value="' + video_id + '" /></object>'
			+  '<param name="adServerURL" value="' + adServerURL + '" />';
		
			$("#player").html(htm);
			player = brightcove.createExperiences();
			
		}

	};

	return {
		init: function(){
			videoPortal.init();
		}
	}
});

//Gallery Page
var showGallery = (function(e){
	var $ = jQuery;
	
	var showGallery = {
		init: function(){	
			
			this.loadGallery();

		},
		loadGallery : function(){
	
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

	};

	return {
		init: function(){
			showGallery.init();
		}
	}
});


//Instantiate
var onPageLoadVideo       = new videoPortal;
var onPageLoadGallery     = new showGallery;

jQuery( document ).ready(function( $ ){

	//Initialize
	if( $("#video-gallery").length ){
		onPageLoadVideo.init();
	}
	//Initialize
	if( $("#show-gallery").length ){
		onPageLoadGallery.init();
	}
	
	
		//hide long description content
		/*function moreContent(){
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
		}*/
});
