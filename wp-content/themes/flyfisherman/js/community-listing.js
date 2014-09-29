/**
 * jQuery Plugin to obtain touch gestures from iPhone, iPod Touch and iPad, should also work with Android mobile phones (not tested yet!)
 * Common usage: wipe images (left and right to show the previous or next image)
 *
 * @author Andreas Waltl, netCU Internetagentur (http://www.netcu.de)
 * @version 1.1.1 (9th December 2010) - fix bug (older IE's had problems)
 * @version 1.1 (1st September 2010) - support wipe up and wipe down
 * @version 1.0 (15th July 2010)
 *
 * Used to replace Flexslider left and right swipe events
 */
;(function($){$.fn.touchwipe=function(settings){var config={min_move_x:20,min_move_y:20,wipeLeft:function(){},wipeRight:function(){},wipeUp:function(){},wipeDown:function(){},preventDefaultEvents:true};if(settings)$.extend(config,settings);this.each(function(){var startX;var startY;var isMoving=false;function cancelTouch(){this.removeEventListener('touchmove',onTouchMove);startX=null;isMoving=false}function onTouchMove(e){if(config.preventDefaultEvents){e.preventDefault()}if(isMoving){var x=e.touches[0].pageX;var y=e.touches[0].pageY;var dx=startX-x;var dy=startY-y;if(Math.abs(dx)>=config.min_move_x){cancelTouch();if(dx>0){config.wipeLeft()}else{config.wipeRight()}}else if(Math.abs(dy)>=config.min_move_y){cancelTouch();if(dy>0){config.wipeDown()}else{config.wipeUp()}}}}function onTouchStart(e){if(e.touches.length==1){startX=e.touches[0].pageX;startY=e.touches[0].pageY;isMoving=true;this.addEventListener('touchmove',onTouchMove,false)}}if('ontouchstart'in document.documentElement){this.addEventListener('touchstart',onTouchStart,false)}});return this}})(jQuery);

/*(function() {
    var message = "We've detected that you have an ad blocker enabled! Please enable it to view this page";

        // Define a function for showing the message.
        // Set a timeout of 2 seconds to give adblocker
        // a chance to do its thing
        var tryMessage = function() {
            setTimeout(function() {
                if(!document.getElementsByClassName) return;
                var ads = document.getElementsByClassName('afs_ads'),
                    ad  = ads[ads.length - 1];

                if(!ad
                    || ad.innerHTML.length == 0
                    || ad.clientHeight === 0) {
                    //jQuery('<iframe id="sticky-iframe-ad" width="310" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-sticky.php?ad_code=imo.gameandfish"></iframe>').insertAfter('.iframe-community-ad').remove();
                    alert(message);
                    //window.location.href = '[URL of the donate page. Remove the two slashes at the start of thsi line to enable.]';
                } else {
                    ad.style.display = 'none';
                }

            }, 2000);
        }

        if(window.addEventListener) {
            window.addEventListener('load', tryMessage, false);
        } else {
            window.attachEvent('onload', tryMessage); //IE
        }
})();
*/
/**
 * Photo Slider
 * @url    : http://www.flyfisherman.com/photos/
 * @author : Joseph Luzquinos
 */

jQuery( document ).ready(function( $ ) {





	var PhotosGallery = (function(){
		var $   = jQuery,
		Private = {
			init: function(state){
				var self = this;
					
				//self.updateTerm();
				
				if(state){
					//Set state
					self.state = state;

					if(state == 'all'){
						$('.state-header').html('');
					}

					// Change State Name in header
					if(typeof(self.state) == 'object'){
						$('.state-header').html('');
					}else{
						$('.state-header').html( PhotoStateMenuBuild.getStateByCode(self.state) );
					}

					// Clear Containers
					self.refreshSlider();

					// Get Posts
					self.getPosts();

					if(	self.isMobile() && !self.isIpad() ){
						//Take to top of page
						window.scrollTo(0,170);
					}else{
						//Close Menu, bug fix for desktop
						if( $('#state-menu-bar').hasClass('isOpen') ){
							$('#state-list-menu').hide();
							$('#state-menu-bar').removeClass('isOpen');
						}

						//Take to top of page
						window.scrollTo(0,402);
					}

					//Close Menu
					return false;
				}

				//hide Thumb container in mobile and not iPad
				if( self.isMobile() && !self.isIpad() ){
					$('#photoSliderThumbsContainer').hide();
				}
			
				self.refreshSlider();
				self.getPosts();
				
			},
			url          : 'http://www.flyfisherman.fox/wpdb/network-feed-cached.php',
			state        : function(){								
						var terms = window.location.hash.substr(1);
						if(terms.indexOf('&') > -1){
							theTerms = terms.split('&');
							var term1 = theTerms[1];
							return term1;
						}else{
							return "all";
						}
					},

			startAt      : 0,
			count        : 10,
			slideCount   : 0,
			requestCount : 0,
			totalCount   : 0,
			skip         : 0,
			term         : function(){
							var terms = window.location.hash.substr(1);
							if(terms.indexOf('&') > -1){
								theTerms = terms.split('&');
								var term1 = theTerms[0];
								return term1;
							}else{
								return "all";
							}
			},
			currentSlide : 0,
			data         : [],
			isMobile     : function(){
			    if (navigator && navigator.userAgent && navigator.userAgent != null){
			    		var strUserAgent = navigator.userAgent.toLowerCase();
			    		var arrMatches   = strUserAgent.match(/(iphone|ipod|ipad|android)/);
			    		if(arrMatches != null){
			    			return true;
			    		}
			    }
			    return false;
			},
			isIpad     : function(){
			    if (navigator && navigator.userAgent && navigator.userAgent != null){
			    		var strUserAgent = navigator.userAgent.toLowerCase();
			    		var arrMatches   = strUserAgent.match(/(ipad)/);
			    		if(arrMatches != null){
			    			return true;
			    		}
			    }
			    return false;
			},
			showSpinner  : function(){
				$('#photoSlider').hide();
				$('#photoSliderThumbs').hide();
				$('.spinner').show();
			},
			hideSpinner  : function(){
				$('#photoSlider').show();
				$('#photoSliderThumbs').show();
				$('.spinner').fadeOut();
				$('.spinner').hide();
			},
			refreshSlider : function(){
				if($('#photoSlider').length){
					//$('#photoSlider').flexslider('destroy');
					$('#photoSlider').remove();
					$('#photoSliderContainer').html('<div id="photoSlider" class="flexslider"><ul class="slides"></ul></div>');

					//$('#photoSliderThumbs').flexslider('destroy');
					$('#photoSliderThumbs').remove();
					$('#photoSliderThumbsContainer').html('<div class="sliderPrev"></div><div id="photoSliderThumbs" class="flexslider"><ul class="slides"></ul></div><div class="sliderNext"></div>');

				}

				$('#photoSliderThumbs').width( $('#photoSliderThumbsContainer').width()-80 );
				window.onresize = function(event) {
					$('#photoSliderThumbs').width( $('#photoSliderThumbsContainer').width()-80 );
				};
			},
			removeSlider : function(element){
				/**
				 * FlexSlider does not have a remove function
				 * This function removes the instance and keeps previous content
				 */
				var $photoSlider = $(element);
				$photoSlider.removeData("flexslider");
				var $photoSlides = $photoSlider.find('.slides');
				$photoSlides.find('li').attr('style',''); // Clear styles left by Flexslider
			},
			getPostCount: function(args, callback){
				var self = this;
				// Get Count
				$.getJSON(self.url, args, function(data){
					var count = (parseInt(data[0].count) > 0) ? parseInt(data[0].count) : 0;

					if(count > 0){
						self.totalCount = count;
					}

					callback(self.totalCount);
				});
			},
			getPostData: function(args, count){
				var self = this;
				args.skip = (self.requestCount * self.count);

				// Total count for state
				if (typeof(self.state) == 'string'){
					args.count = count;
					args.skip  = 0;
					self.data  = [];
				}else{
					args.count = self.count;
				}

				//Remove get_count to get data
				delete args['get_count'];

				//Get Data
				$.getJSON(self.url, args, function(data){
					self.data = $.merge(self.data, data);
					self.refreshSlider();

					self.slideCount = 0;
					
					//Insert data into DOM
					$.each(self.data, function(i, v){
						v.slide_count  = self.slideCount;
						v.requestCount = self.requestCount;
						$('#photoSlider .slides').append( self.templateSlide(v) );
						$('#photoSliderThumbs .slides').append( self.templateThumbs(v) );
						


						self.slideCount++;
					});
					
				    // add one on every ajax request
				    self.requestCount++;
				    
					if($(".reader_photo-post").length){
	    				
	    				var thumbImage = $('.reader_photo-post .attachment-legacy-thumb ').attr("src");
	    				$('#photoSliderThumbs .slides li').removeClass('flex-active-slide');
	    				$("#photoSliderThumbs .slides").prepend('<li class="flex-active-slide"></li>');
	    				$("#photoSliderThumbs .flex-active-slide").append('<img src="' + thumbImage +'">');
						
						$("#photoSlider .slides li").removeClass('flex-active-slide');
						$("#photoSlider .slides").prepend('<li class="flex-active-slide"></li>');
						
						
						$("#photoSlider .slides li").removeAttr("slide-count");
						$("#photoSlider .slides li").each(function(i){
							$(this).attr('slide-count',i);
						});
						
						var singleImage = $(".reader_photo-post .attachment-community-square-retina").attr("src");
						$("#photoSlider .flex-active-slide").append('<img src="' + singleImage +'">');
						
						var title = $('.entry-title').text();
						$('#photoGalleryTitle a').text(title);
										
						cat1 = $('.cat-feat-label a:first-child').text();
						cat2 = $('.cat-feat-label a:nth(2)').text();
						$('.photoGalleryState').text(cat1).show();
						$('.photoGalleryCategory').text(cat2).show();
						
						var desc = $('.entry-content p').text();
						$('.photoGalleryDescription').text(desc);
						var styles = $("#photoSlider .slides li:nth-child(2)").attr("style");
	    				$('#photoSlider .flex-active-slide').attr("style",styles);

						var thumbStyles = $("#photoSliderThumbs .slides li:nth-child(2)").attr("style");
	    				$('#photoSliderThumbs .flex-active-slide').attr("style",thumbStyles);

						$('reader_photo-post').remove();
						//"/photos/" + window.location.pathname
						//console.log( $('#photoSliderThumbs .slides li').attr("id") );
						//if( $('#photoSliderThumbs .slides li').attr("slug") ==  "/photos/" + window.location.pathname){
							//$('/photos/' + window.location.pathname).remove();
							
						//}
					}
					// Load flexslider
					self.loadSlider();
					
				});
			},
			getPosts : function(){
				
				var self = this,
				args = {
					post_type	   : 'reader_photos',
					domain		   : 'www.flyfisherman.com',
					thumbnail_size : 'community-square-retina',
					term           : self.term,
					state          : self.state,
					skip           : self.skip,
				 	get_count      : 1
				};
				
				self.showSpinner();

				// Remmove PhotoSlider
				self.removeSlider('#photoSlider');
				self.removeSlider('#photoSliderThumbs');

				// Set State args
				if (typeof(self.state) == 'string'){
					args.state   = self.state;
					args.skip    = 0;
					self.startAt = 0;
				}

				self.getPostCount(args, function(count){
					self.getPostData(args, count);
				});

			},
			templateSlide : function(v){

				
				if (window.location.host != "www.flyfisherman.com") {

					v.img_url = v.img_url.replace("www.flyfisherman.com",window.location.host);
				};


				return '<li slug="" title="' + v.post_title + '" slide-count="' + v.slide_count + '">\
					<img src="' + v.img_url + '" />\
				</li>';
			},
			templateThumbs : function(v){


				if (window.location.host != "www.flyfisherman.com") {

					v.thumb = v.thumb.replace("www.flyfisherman.com",window.location.host);
				};


				return '<li slug="' + v.post_name + '">\
					<img src="' + v.thumb + '" />\
				</li>';
			},
			templateLikeButton : function(v){
				return '<div class="fb-like" data-href="' + v.post_url + '" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>';
			},
			templateBottomContent : function(v){
				return '<p class="photoGalleryDescription">' + v.post_content + '</p>';
			},
			loadSlider : function(){
				var self = this;

				//self.hideSpinner();

				// Load Thumbs Flexslider
				$('#photoSliderThumbs').flexslider({
					animation     : "slide",
					controlNav    : false,
					animationLoop : false,
					slideshow     : false,
					useCSS        : false,
					itemWidth     : 77,
					itemMargin    : 0,
					//startAt       : self.startAt,
					asNavFor      : '#photoSlider',
					minItems      : 7,
	    				maxItems      : 7,
	    				start         : function(slider){
	    					$('#photoSliderThumbsContainer .sliderPrev').on('click touchend', function(event){
							event.preventDefault();
							slider.flexAnimate( slider.getTarget("prev") );
						});

						$('#photoSliderThumbsContainer .sliderNext').on('click touchend', function(event){
							event.preventDefault();
							slider.flexAnimate( slider.getTarget("next") );
						});
	    				}
				});

				// Load Photos Flexslider
				$('#photoSlider').flexslider({
					animation      : "slide",
					controlNav     : false,
					animationLoop  : false,
					animationSpeed : 300,
					slideshow      : false,
					useCSS         : false,
					touch          : false,
					sync           : "#photoSliderThumbs",
					startAt        : self.startAt,
					before         : function(slider){
						if(slider.animatingTo > 0){
							$('#photoTopControls .sliderPrev').show();
						}
						
					},
					after          : function(slider){
						$("#photoSlider .slides li:first-child").removeClass('flex-active-slide');
						
						self.parseSlider(slider);
						
						slideData = self.data[parseInt(slider.currentSlide)];
						//console.log(slideData);
						term = slideData.terms[0].slug;
						//console.log(term);

						self.updateURL(slideData.post_name,term);
						// Hide Show Controls
						if(slider.currentSlide > 0){
							$('#photoTopControls .sliderPrev').show();
						}else{
							$('#photoTopControls .sliderPrev').hide();
						}

						if(self.totalCount == (slider.currentSlide + 1)){
							$('#photoTopControls .sliderNext').hide();
						}else{
							$('#photoTopControls .sliderNext').show();
						}
					},
					start : function(slider){
						
						//Parse first slide
						self.parseSlider(slider);

						if(self.startAt == 0){
							//Hide Previous Contro button onload
							$('#photoTopControls .sliderPrev').hide();

							self.hideSpinner();
						}else{
							slider.flexAnimate(slider.getTarget("next"), true);
							setTimeout(function(){
								slider.flexAnimate(slider.getTarget("prev"), true);
								self.hideSpinner();
							},1000);
						}

						//Enable swipe in mobile
						if( self.isMobile() ){
							$('#photoGalleryBody').touchwipe({
								 wipeLeft: function() {
								 	slider.flexAnimate(slider.getTarget("next"));
								 },
								 wipeRight: function() {
								 	slider.flexAnimate(slider.getTarget("prev"));
								 },
								 preventDefaultEvents: false
							});
						}
						
						$('#photoTopControls .sliderNext').on('click', function(event){
							event.preventDefault();


							var nextSlide = parseInt( $('#photoSlider .flex-active-slide').attr('slide-count')) + 1;

							// //This condition is to fix bug not selecting second slide
							if(nextSlide == 1){
								$('#photoSliderThumbs').find('.flex-active-slide').next().addClass('flex-active-slide');
								$('#photoSliderThumbs').find('.flex-active-slide').prev().removeClass('flex-active-slide');
							}

							slider.flexAnimate(slider.getTarget("next"));
						});

						$('#photoTopControls .sliderPrev').on('click', function(event){
							event.preventDefault();
	        					slider.flexAnimate(slider.getTarget("prev"));
						});
					
				
						
					},
					end : function(slider){
						var slidesInDOMCount = $('#photoSlider .slides li').length;

						// skip if it has reached the end
						if(slidesInDOMCount >= self.totalCount){
							return false;
						}

						if( slidesInDOMCount == slider.count ){
							if(self.state == null){
								self.currentSlide = slider.animatingTo;
								self.skip         = slider.count + 10;
								self.startAt      = slider.animatingTo;
								self.getPosts();
							}
						}
					}
				});
			},
			parseTerms : function(terms, callback){
				/*
				 * If any property in terms is missing it will cause errors.
				 * Try and Catch (Hide if errors)
				 */
				try{
					$('#photoGalleryTitle .photoGalleryState').html( terms[1].name.toUpperCase() );
					$('#photoGalleryTitle .photoGalleryCategory').html( terms[0].name.toUpperCase() );
					$('#photoGalleryTitle .photoGalleryState').show();
					$('#photoGalleryTitle .photoGalleryCategory').show();

					//self.slug = (typeof terms[0].slug != 'undefined') ? terms[0].slug : '';
					var slug = terms[0].slug;

					callback(slug);

				}catch(e){
					if(e){
						$('#photoGalleryTitle .photoGalleryState').hide();
						$('#photoGalleryTitle .photoGalleryCategory').hide();
					}

					callback('all');
				}
			},
			parseSlider : function(slider){
				var self = this,

				slideData = self.data[parseInt(slider.currentSlide)];
				
				if(typeof(slideData) == 'object'){
					slide = $('#photoSlider .slides').find("li").attr("slide-count");
					if(slide == slider.currentSlide){
						slidez = $(this).attr("title");
					}
					console.log(slide);
					$('#photoGalleryTitle h2 a').html(slidez);
					$('#photoGalleryTitle h2 a').attr("href",slideData.post_url);
					$('#photoGalleryLike .photoGalleryLikeRight').html('');
					$('#photoGalleryLike .photoGalleryLikeRight').html( self.templateLikeButton(slideData) );
					$('#photoGalleryBottomContent').html( self.templateBottomContent(slideData) );
					//$('#photoGalleryTitle .photoGalleryState').html( slideData.terms[1].name.toUpperCase() );
					//$('#photoGalleryTitle .photoGalleryCategory').html( slideData.terms[0].name.toUpperCase() );
					$('#photoSlider .slides li').css('display','table');
					// Parse only State and Category in the bottom
					self.parseTerms(slideData.terms, function(slug){
						
						//Refresh Ad
						//var _gaq = _gaq || [];
					    _gaq.push(['_trackPageview', window.location.pathname + slideData.post_name]);
					    //console.log(  _gaq );
						//document.getElementById('community-iframe-ad').contentWindow.location.reload();
					});

					/*$("#photoGalleryTitle .bookmark").click(function() {
				    	console.log(slideData.post_url);
						window.prompt("Copy to clipboard: Ctrl+C, Enter", slideData.post_url);
					});
					*/
					//Parse current slide like button
					try{
						$('meta[property=og\\:url]').attr('content',slideData.post_url);
						$('meta[property=og\\:title]').attr('content',slideData.post_title);
						$('meta[property=og\\:image]').attr('content',slideData.img_url);
						$('#photoGalleryTitle .fb-share-button').attr("data-href",slideData.post_url);
						FB.XFBML.parse();
				    }catch(e){
				    		//console.log(e);
				    }

			   }
			},
			updateURL: function(slug,term){
				var self = this;
				
				// strip out the current slug and push the new slug
			    var url = window.location.pathname.toString();
			    var newSlug = url.replace(url, slug);
				//change the url
				var stateObj = { slug: slug, term: term };
				window.history.replaceState(stateObj, null, "/photos/" + newSlug );
				//track back/foward browser history and reload the videos
				//window.onpopstate = function(event) {
		          // $("#photoSlider").text();
				  // $("#photoGalleryTitle h2 a").text(event.state.title);
				  // $(".photoGalleryDescription").text(event.state.description);
				  // $("#photoSlider li img").attr("src",post_url);
		         // _gaq.push(['_trackPageview', window.location.pathname + slug]);
				//};
				
			},
			singlePage: function(){
				var self = this;
				
								
			}
		};

		return {
			init: function(state){
				Private.init(state);
			}
		};
	});



	/**
	 * Photos State Menu
	 * @author : Joseph Luzquinos
	 */
	var PhotoStateMenu = (function(){
		var $   = jQuery,
		Private = {
			stateCount : 0,
			buildMenu  : function(element){
				var self = this;

				//Clear Menu
				$(element).html('');
				//$(element).css('overflow','hidden');

				var stateCount = 0;

				//Add All States Option
				$(element).append( self.tempateSelectAll );

				//Build Menu
				$.each(self.states, function(i,v){
					var stateCount = 1;

					$(element).append( self.templateMenu(i, v, stateCount) );

					$('#state-menu-bar').on('click', function(e){
						//e.preventDefault();
						if( !$(this).hasClass('isOpen') ){
							$('#state-list-menu').show();
							$(this).addClass('isOpen');
						}else{
							$('#state-list-menu').hide();
							$(this).removeClass('isOpen');
						}
					});

				});

			},
			getData: function(state,  callback){
				var self   = this,
					url    = 'http://www.flyfisherman.fox/wpdb/network-feed-cached.php',
					args   = {
						post_type	   : 'reader_photos',
						domain		   : 'www.flyfisherman.com',
						thumbnail_size : 'community-square-retina',
						//term           : self.term,
						count		   : 9999999,
					 	skip           : 0,
					 	state          : state,
					 	get_count      : 1
					};

				$.getJSON(url, args, function(data){
					if(data == 'bad term'){
						callback('No Photos');
					}

					var count = null;
					if(data[0].count == 0 || typeof(data[0].count) == 'undefined'){
						count = 'No Photos';
					}else{
						count = parseInt(data[0].count);
					}
					callback( count );
				});
			},
			tempateSelectAll : function(){
				return '<li>\
					<a href="/photos/">All States</a>\
				</li><div class="divider"></div>';
			},
			templateMenu : function(i,v, stateCount){
				var state = '<li>\
					<a href="" onclick="PhotoGallery.init(\''+i.toUpperCase()+'\'); return false;" class="filter-menu" state="'+ i +'">'+ v +'</a>\
				</li><div class="divider"></div>';

				var no_photos = '<li>\
					<a href="/add-new-photo" class="filter-menu" state="#">'+ v +' ('+ stateCount +') Share Photo</a>\
				</li><div class="divider"></div>';

				return (stateCount == 'No Photos') ? no_photos : state;
			},
			states: {
				"AR" : "Arizona",
				"AL" : "Alabama",
				"AK" : "Alaska",
				"AZ" : "Arizona",
				"AR" : "Arkansas",
				"CA" : "California",
				"CO" : "Colorado",
				"CT" : "Connecticut",
				"DE" : "Delaware",
				"DC" : "District Of Columbia",
				"FL" : "Florida",
				"GA" : "Georgia",
				"HI" : "Hawaii",
				"ID" : "Idaho",
				"IL" : "Illinois",
				"IN" : "Indiana",
				"IA" : "Iowa",
				"KS" : "Kansas",
				"KY" : "Kentucky",
				"LA" : "Louisiana",
				"ME" : "Maine",
				"MD" : "Maryland",
				"MA" : "Massachusetts",
				"MI" : "Michigan",
				"MN" : "Minnesota",
				"MS" : "Mississippi",
				"MO" : "Missouri",
				"MT" : "Montana",
				"NE" : "Nebraska",
				"NV" : "Nevada",
				"NH" : "New Hampshire",
				"NJ" : "New Jersey",
				"NM" : "New Mexico",
				"NY" : "New York",
				"NC" : "North Carolina",
				"ND" : "North Dakota",
				"OH" : "Ohio",
				"OK" : "Oklahoma",
				"OR" : "Oregon",
				"PA" : "Pennsylvania",
				"RI" : "Rhode Island",
				"SC" : "South Carolina",
				"SD" : "South Dakota",
				"TN" : "Tennessee",
				"TX" : "Texas",
				"UT" : "Utah",
				"VT" : "Vermont",
				"VA" : "Virginia",
				"WA" : "Washington",
				"WV" : "West Virginia",
				"WI" : "Wisconsin",
				"WY" : "Wyoming"
			}
		};

		return {
			init : function(element){
				return Private.buildMenu(element);
			},
			getStateByCode : function(code){
				return Private.states[code];
			}
		};

	});

	var ReaderPhotos = (function(e){
		var $ = jQuery;

		var ReaderPhotos = {
			init: function(){
				this.requestData();
			},
			getData : function(data){
				var self     = this,
					total    = data.length,
					count    = 0,
					$content = $('#photoAlbumGallery');

				$.each(data, function(i,v){
					count++;
					$content.find('#slider ul.slides').append(self.template(v));
					$content.find('#carousel ul.slides').append(self.templateThumb(v));
					if(v.ID == self.getHash()){
						self.default_slide = v.count;
					}
					if(count == total){
						self.loadSlider( self.default_slide );
					}
				});

			},
			getHash: function(){
				var hashString   = window.location.hash;
				var hashVal      = hashString.slice(1); // remove #
				return (typeof hashVal == 'string') ? hashVal : '';
			},
			setHash: function(id){
				window.location.hash = id;
			},
			requestData : function(){
				var self = this;
				$.getJSON( "/wp-admin/admin-ajax.php",{
					action : "get_photos"
				}, function(json){
					self.getData(json);
				});
			},
			loadSlider: function(default_slide){
				var self = this;

				$('#carousel').flexslider({
					animation: "slide",
					controlNav: false,
					animationLoop: false,
					slideshow: false,
					itemWidth: 80,
					itemMargin: 5,
					asNavFor: '#slider'
				});

				$('#slider').flexslider({
					animation: "slide",
					controlNav: false,
					animationLoop: false,
					slideshow: false,
					sync: "#carousel",
					startAt: default_slide,
					start: function(){
						$('.spinner').hide();
						$('#photoTopControls .sliderNext').on('click', function(e){
							$('.flex-next').trigger('click');
						});
						$('#photoTopControls .sliderPrev').on('click', function(e){
							$('.flex-prev').trigger('click');
						});
					},
					after: function(e){
						var ID = $('#photoAlbumGallery .flex-slide[the_count="'+e.currentSlide+'"]').attr('the_id');
						self.setHash(ID);
					}
				});
			},
			template : function(data){
				return '<li class="flex-slide" the_count="'+data.count+'" the_id="'+data.ID+'"><div><a href="' + data.permalink + '#' + data.ID + '">' + data.title + '</a></div><div class="the_slide">' + data.photo_url + '</div></li>';
			},
			templateThumb: function(data){
				return '<li>' + data.thumbnail + '</li>';
			}		};

		return {
			init: function(){
				ReaderPhotos.init();
			}
		}
	});

	//Instantiate
	var ReaderPhoto         = new ReaderPhotos;
	var PhotoGallery        = new PhotosGallery;
	var PhotoStateMenuBuild = new PhotoStateMenu;

	jQuery( document ).ready(function( $ ){

		//Initialize
		ReaderPhoto.init();
		PhotoGallery.init();
		PhotoStateMenuBuild.init('#main .dropdown-menu');
		
				//Toggle Photos Menu
		jQuery('.community-mobile-menu').on('click touchstart', function(e){
			e.preventDefault();
			jQuery('.menu-hunt, .menu-fish').toggle();
		});


		// $('body').touchwipe({
			 // wipeLeft: function() {
			 	// alert('left');
			 	// //slider.flexAnimate(slider.getTarget("next"));
			 // },
			 // wipeRight: function() {
			 	// alert('right');
			 	// //slider.flexAnimate(slider.getTarget("prev"));
			 // },
			 // preventDefaultEvents: false
		// });

	});


});

