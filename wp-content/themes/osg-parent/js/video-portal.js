var playerID = jQuery("#show-destination").attr("playerID"),
	accountID = jQuery("#show-destination").attr("accountID");

var videoPortal = (function(e){
	var $ = jQuery;
	var player,
		video_id,
		videoLink,
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
			//self.brightcoveRequest();
			//$(".wpsocialite.small").remove();	
		
			if($(".single-format-video").length){
				video_id = $(".video-title").attr("data-videoid");
				//videoLink = $("#show-destination").attr("videoLink");
				//title = $(".video-title").attr("data-title");
				//description = $(".video-title").parent().find(".data-description").html();
				//slug = $(".video-title").attr("data-slug");
				//img_url = $(".video-title").attr("data-img_url");
				//post_url = $(".video-title").attr("data-post_url");
			}else{
				var filterSlug = window.location.hash.substr(1);
				if(filterSlug){
					postoffset = 0;
					$(".loading-gif").show();
					self.getAJAXonLoad(filterSlug,postoffset);
					$("a.paginate-videos").show();
					$("#video-filter a").removeClass("video-thumb-active");
					$("#video-filter a").removeClass("active-slug");
					$("#" + filterSlug + " a").addClass("video-thumb-active");
					$("#" + filterSlug + " a").addClass("active-slug");
				}
			
				video_id = $("#video-thumbs li").first().find("a").attr("data-videoid");
				//videoLink = $("#show-destination").attr("videoLink");
				title = $("#video-thumbs li").first().find("a").attr("data-title");
				description = $("#video-thumbs li").first().parent().find(".data-description").html();
				slug = $("#video-thumbs li").first().find("a").attr("data-slug");
				img_url = $("#video-thumbs li").first().find("a").attr("data-img_url");
				post_url = $("#video-thumbs li").first().find("a").attr("data-post_url");
			}
			self.loadVideo(video_id);	
			
			
			
			$("#player").mousedown(function (e){
				self.updateSocial(slug,title,post_url,img_url);
				// Detecting IE
			    var oldIE;
			    if ($('html').is('#ie6, #ie7, #ie8, #ie9')) {
			        oldIE = true;
			    }
				if(!oldIE){
			    	self.updateURL(video_id,slug,title,description,post_url,img_url);
			    }
			});
			
			$(window).bind('orientationchange', function() {
				self.loadVideo(video_id);
			});
			//Socialite.load();
		},
		thumbClick : function(){
			var self = this;
			//initiate video on click
			$("a.video-thumb").click(function(){
				var vid_player_offset = $("#when-to-watch").offset().top;
			    $("html, body").animate({scrollTop: vid_player_offset}, 1000, "swing");
				video_id = $(this).attr("data-videoid");
				//videoLink =  $(this).attr("data-post_url");
				title = $(this).attr("data-title");
				description = $(this).parent().find(".data-description").html();
				slug = $(this).attr("data-slug");
				img_url = $(this).attr("data-img_url");
				post_url = $(this).attr("data-post_url");
				fb_count = $(this).attr("data-fb-count");
				
				// place data into html
				$("h1.video-title").text(title);
				$(".video-description").html(description);
				
				self.videoInit(video_id,videoLink,slug,title,description,post_url,img_url,fb_count);
				//self.socialite(video_id,slug,title,description,post_url,img_url);
			    
				console.log(video_id);
				//show page default
				_gaq.push(['_trackPageview', window.location.pathname + slug]);
			});
		},
/*
		socialite : function(video_id,slug,title,description,post_url,img_url){
			$(".wpsocialite.small").remove();	
			//socialite
			$(".social-buttons li").remove();
			$('<li><a href="http://twitter.com/share" class="socialite twitter-share reload-twitter" data-text="' + title + '" data-url="' + post_url + '" data-count="none" rel="nofollow" target="_blank"><span class="vhidden"></span></a></li><li><a href="https://plus.google.com/share?url=<' + post_url + '" data-annotation="none" class="socialite googleplus-one g-plusone reload-google" data-href="' + post_url + '" rel="nofollow" target="_blank"><span class="vhidden"></span></a></li> <li><a href="http://www.facebook.com/sharer.php?u=' + post_url + '&t=' + title + '" class="socialite facebook-like reload-fb" data-href="' + post_url + '" data-send="false" data-layout="button" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden"></span></a></li>').appendTo(".social-buttons");
			Socialite.load();
		},
*/
		videoFilter : function(){
			var self = this;
			//video filter
			var catID = $(".active-slug").attr("slug");
			var postoffset = 0;
			$("a.paginate-videos").click(function(){
				postoffset = postoffset + 8;
				$(".loading-gif").show();
				self.getAJAX(catID,postoffset);
			});
			
			$('select.seasons-filter').on('change', function (e) {
				if(this.value != ""){
					$("#video-filter a").removeClass("video-thumb-active");
					$("#video-filter a").removeClass("active-slug");
					$("#video-filter a").first().addClass("video-thumb-active");
					postoffset = 0;
					var catID = this.value;
					$(".loading-gif").show();
					self.getAJAX(catID,postoffset);
					$("a.paginate-videos").show();
				}
			});
			
			$(".video-ajax").click(function(){
				$("#video-filter a").removeClass("video-thumb-active");
				$("#video-filter a").removeClass("active-slug");
				$(this).addClass("video-thumb-active");
				$(this).addClass("active-slug");
				$('select.seasons-filter').val( $(".seasons-filter option:first").val() );
				var slug = $(this).attr("slug");
				// Detecting IE
			    var oldIE;
			    if ($('html').is('#ie6, #ie7, #ie8, #ie9')) {
			        oldIE = true;
			    }
				if(!oldIE){
			    	self.updateFilterURL(slug,title,post_url);
			    }
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
		getAJAXonLoad : function(catID,postoffset){
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
		        	
                    $("#video-thumbs").html(response);
		            $(".loading-gif").hide();
							
		            return false;
		        }
		    });
		
		},
/*
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
*/
		videoInit: function(video_id,videoLink,slug,title,description,post_url,img_url,fb_count){
			var self = this;
			
			// Detecting IE
		    var oldIE;
		    if ($('html').is('#ie6, #ie7, #ie8, #ie9')) {
		        oldIE = true;
		    }
			if(!oldIE){
		    	self.updateURL(video_id,slug,title,description,post_url,img_url);
		    }
			self.updateSocial(slug,title,post_url,img_url,fb_count);
			self.updateVideo(video_id);
			
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
		updateFilterURL: function(slug,title,post_url ){
			var self = this;
			
			// strip out the current slug and push the new slug
		    var url = window.location.pathname.toString();
		    var newSlug = url.replace(url, slug);
			//change the url
			var stateObj = { slug: slug, title: title, post_url: post_url };
			window.history.pushState(stateObj, title, "/tv#" + newSlug );
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

		updateSocial: function(slug,title,post_url,img_url,fb_count){
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
			
			$("#fb_btn").attr("href","http://www.facebook.com/sharer.php?u=" + post_url + "&t=" + title);
			$("#twitter_btn").attr("href","http://twitter.com/home/?status=" + title + " - " + post_url);
			$("#email_btn").attr("href","mailto:?body=" + title + " " + post_url);
			$("#facebook_count").text(fb_count);
			if (fb_count > 0) {$(".social-single").removeClass("fb-zero");} else {$(".social-single").addClass("fb-zero");}
			
		},

		loadVideo: function(video_id){
			//load videos
		    var htm = '';
		    
		    htm = '<video id=\"tv_player\" data-video-id=\"' + video_id + '\" data-account=\"' + accountID + '\" data-player=\"' + playerID + '\" data-embed=\"default\" class=\"video-js\" controls style=\"width: 100%; height: 100%; position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px;\"></video>';
		    
			$("#player").html(htm);
			setTimeout(function(){
				myPlayer = videojs('tv_player');
				myPlayer.play();
				myPlayer.volume(.5);
			}, 1000);
		},
		
		updateVideo: function(video_id) {
			myPlayer = videojs('tv_player');
			myPlayer.catalog.getVideo(video_id, function(error, video) { 
				myPlayer.catalog.load(video);
				myPlayer.play();
			});
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
	
	    	//$(".wpsocialite.small").remove();	
	    
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
	var s = document.createElement('script');
	s.src = "//players.brightcove.net/" + accountID + "/" + playerID + "_default/index.min.js";
	document.body.appendChild(s);
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
