/**
 * Photo Slider
 * @url    : http://www.gameandfishmag.com/photos/
 * @author : Joseph Luzquinos
 */
var PhotosGallery = (function(){
	var $ = jQuery;
	var PhotosGallery = {
		init: function(){
			var self = this;
			
			self.getPosts();
			
			$('a.filter-menu').on('click', function(e){
				e.preventDefault();
				self.state = $(this).attr('state');
				
				$('#photoSlider .slides').html('');
				$('#photoSliderThumbs .slides').html('');
				self.getPosts();
			});
		},
		state        : null,
		startAt      : 0,
		count        : 10,
		slideCount   : 0,
		requestCount : 0,
		totalCount   : 0,
		skip         : 0,
		term         : $(".posts-list").attr("slug"),
		currentSlide : 0,
		data         : [],
		showSpinner  : function(){
			$('#photoSlider').hide();
			$('#photoSliderThumbs').hide();
			$('.spinner').show();
		},
		hideSpinner  : function(){
			$('#photoSlider').show();
			$('#photoSliderThumbs').show();
			$('.spinner').hide();
		},
		removeSlider : function(element){
			/**
			 * FlexSlider does not have a remove function
			 * This function removes the instance and keeps previous content
			 */
			var $photoSlider = $(element);
			$photoSlider.removeData("flexslider");
			var $photoSlides = $photoSlider.find('.slides');
			$photoSlides.find('li').attr('style','');         // Clear styles left by Flexslider
			var slides = $photoSlider.find('.slides').html(); // Save Slides
			
			// If thumbnail slider add, controls
			if(element == '#photoSliderThumbs'){
				$photoSlider.html('<div class="sliderPrev"></div><ul class="slides"></ul><div class="sliderNext"></div>');    // Remove everything and add new ul
			}else{
				$photoSlider.html('<ul class="slides"></ul>');    // Remove everything and add new ul
			}
			
			$photoSlider.find('.slides').append( slides );    // Append saved slides to ul
		},
		getPosts     : function(){
			var self = this,
				url  = '/wpdb/network-feed-cached.php',
				args = {
					post_type	   : 'reader_photos',
					domain		   : 'www.gameandfishmag.com',
					thumbnail_size : 'community-square-retina',
					term           : self.term,
					count		   : self.count,
				 	skip           : self.skip,
				 	get_count      : 1
				};

			if (self.state != null){
				args.state = self.state;
				args.count = 99999;
				args.skip  = 0;
			}
			
			self.showSpinner();
			
			// Remmove PhotoSlider
			self.removeSlider('#photoSlider');
			self.removeSlider('#photoSliderThumbs');
			
			//Get total Count
			$.getJSON(url, args, function(data){
				self.totalCount = (parseInt(data[0].count) > 0) ? parseInt(data[0].count) : 0;
			});
			
			//Change Get Count to 0 to request data
			args.get_count = 0;

			// Make the request and append values
			$.getJSON(url, args, function(data){
				self.data = $.merge(self.data, data);
				
				$.each(data, function(i, v){
					v.slide_count  = self.slideCount;
					v.requestCount = self.requestCount;
					$('#photoSlider .slides').append( self.templateSlide(v) );
					$('#photoSliderThumbs .slides').append( self.templateThumbs(v) );
					self.slideCount++;
				});
				
			    // add one on every ajax request
			    self.requestCount++;
				
				// Load flexslider
				self.loadSlider();
				
			});
		},
		templateSlide : function(v){
			return '<li slide-count="' + v.slide_count + '">\
				<a href="' + v.post_url + '">\
					<img src="' + v.img_url + '" />\
				</a>\
			</li>';
		},
		templateThumbs : function(v){
			return '<li>\
				<img src="' + v.thumb + '" />\
			</li>';
		},
		templateLikeButton : function(v){
			return '<div class="fb-like" data-href="' + v.post_url + '" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>';
		},
		templateBottomContent : function(v){
			return '<p class="photoGalleryDescription">' + v.post_content + '</p>\
			<p class="photoGalleryExtras">\
				Taken At: <span>' + v.camera_corner_taken + '</span><br/>\
				Taken On: <span>' + v.camera_corner_when + '</span><br/>\
				With: <span>' + v.camera_corner_who + '</span><br/>\
			</p>';
		},
		loadSlider: function(){
			var self = this;
			
			self.hideSpinner();

			// Load Thumbs Flexslider
			$('#photoSliderThumbs').flexslider({
				animation     : "slide",
				controlNav    : false,
				animationLoop : false,
				slideshow     : false,
				itemWidth     : 77,
				itemMargin    : 3,
				startAt       : self.startAt,
				asNavFor      : '#photoSlider',
				minItems      : 7,
    				maxItems      : 8,
    				start         : function(slider){
    					$('#photoSliderThumbs .sliderPrev').on('click', function(event){
						event.preventDefault();
						$('#photoSliderThumbs .flex-prev').trigger('click');
					});
					
					$('#photoSliderThumbs .sliderNext').on('click', function(event){
						event.preventDefault();
						$('#photoSliderThumbs .flex-next').trigger('click');
					});
    				}
			});

			// Load Photos Flexslider
			$('#photoSlider').flexslider({
				animation     : "slide",
				controlNav    : false,
				animationLoop : false,
				slideshow     : false,
				sync          : "#photoSliderThumbs",
				startAt       : self.startAt,
				start         : function(slider){
					//Parse first slide
					self.parseSlider(slider);
					
					$('#photoTopControls .sliderNext').on('click', function(event){
						event.preventDefault();
						var nextSlide = parseInt( $('#photoSlider .flex-active-slide').attr('slide-count')) + 1;
						
						//This condition is to fix bug not selecting second slide
						if(nextSlide == 1){
							$('#photoSliderThumbs').find('.flex-active-slide').next().addClass('flex-active-slide');
							$('#photoSliderThumbs').find('.flex-active-slide').prev().removeClass('flex-active-slide');
						}
        					slider.flexAnimate(nextSlide, false);
					});
					
					$('#photoTopControls .sliderPrev').on('click', function(event){
						event.preventDefault();
						var prevSlide = parseInt( $('#photoSlider .flex-active-slide').attr('slide-count')) - 1;
        					slider.flexAnimate(prevSlide, false);
					});
				},
				after : function(slider){
					//Add values after each slide
					self.parseSlider(slider);
				},
				end : function(slider){
					if($('#photoSlider .slides li').length == slider.count){
						if(self.state == null){
							
							if(slider.count == (slider.currentSlide + 2)){
								self.currentSlide = slider.currentSlide;
								self.skip         = slider.count + 10;
								self.startAt      = slider.currentSlide + 1;
								self.getPosts();
							}
						}
					}
				}
			});
		},
		parseSlider : function(slider){
			var self      = this,
				slideData = self.data[parseInt(slider.currentSlide)],
				slug      = (slideData.terms[0].slug) ? slideData.terms[0].slug : '';
			
			// Handle if term 1 is not defined
			if(slideData.terms[1].name){
				slideData.location = slideData.terms[0].name;
			}else{
				slideData.location = slideData.terms[1].name;
			}
			
			$('#photoGalleryTitle h2').html(slideData.post_title);
			$('#photoGalleryLike .photoGalleryLikeRight').html('');
			$('#photoGalleryLike .photoGalleryLikeRight').html( self.templateLikeButton(slideData) );
			$('#photoGalleryBottomContent').html( self.templateBottomContent(slideData) );
			
			//Parse current slide like button
			try{
				FB.XFBML.parse();
		    }catch(e){
		    		//console.log(e);
		    }
		        
		    //Refresh Ad
		    _gaq.push(['_trackPageview',"/photos/" +  slug  ]);
			document.getElementById('community-iframe-ad').contentWindow.location.reload();
		}
	};
	
	return {
		init: function(){
			PhotosGallery.init();
		}
	}
});
var PhotoGallery = new PhotosGallery;

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
			$.getJSON( "http://www.gameandfishmag.devf/wp-admin/admin-ajax.php",{
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
		}
	};
	
	return {
		init: function(){
			ReaderPhotos.init();
		}
	}
});
var ReaderPhoto = new ReaderPhotos;

jQuery( document ).ready(function( $ ) {
	ReaderPhoto.init();
	PhotoGallery.init();

	var $postTemplateCopy = $(".dif-post").first().clone();

	var querySettings = {};

	querySettings.state = null;
	querySettings.skip = 0;
	querySettings.showAtOnce = 10;
	querySettings.totalCount = 999999;
	querySettings.term = $(".posts-list").attr("slug");

	//alert("ok");

	// $("a.filter-menu").click(function(ev){
// 
		// $(".posts-list").empty();
		// //console.log("clear");
// 
		// ev.preventDefault();
// 
// 
// 
		// querySettings.state = $(this).attr('state');
		// querySettings.skip = 0;
// 
// 
// 
		// getPosts();
// 
	// });


	$("#community-nav").on("change",function(ev){

		var url = $(this).val();
		window.location.href = url;


	});


	$(".community-pager .more").click(function(ev){

		ev.preventDefault();

		if (querySettings.skip == 0) {

			getTotalCount();
		}

		querySettings.skip += querySettings.showAtOnce;

		getPosts();

		if (querySettings.skip + querySettings.showAtOnce > querySettings.totalCount) {

			$(".community-pager .more").fadeOut();
		}

	});

	function getTotalCount() {

		var url =  "/wpdb/network-feed-cached.php?post_type=reader_photos&domain=www.gameandfishmag.com&thumbnail_size=community-square-retina"

				 + "&term=" + querySettings.term
				 + "&get_count=1";

		if (querySettings.state != null) {
			url += "&state=" + querySettings.state;
		}

		$.getJSON(url,function(countArray){

			var count = countArray[0].count;
			querySettings.totalCount = count;
		});




	}

	function getPosts() {
			
		var url =  "/wpdb/network-feed-cached.php?post_type=reader_photos&domain=www.gameandfishmag.com&thumbnail_size=community-square-retina"

				 + "&term=" + querySettings.term
				 + "&count=" + querySettings.showAtOnce
				 + "&skip=" + querySettings.skip;

		if (querySettings.state != null) {
			url += "&state=" + querySettings.state;
		}



		//console.log(url);
		$.getJSON(url,function(posts){

			if(typeof posts =='object')
			{



				$.each(posts,function(index,post){


					console.log(post);

					$postTemplate = $postTemplateCopy.clone();

					var imgURL = post.img_url;
					imgURL.replace("www.gameandfishmag.com",document.domain);

					var userURL = "/author/" + post.user_nicename + "/";


					$postTemplate.find("div.feat-img img").attr("src",imgURL.replace("www.gameandfishmag.com",document.domain));
					$postTemplate.find("div.feat-img img").attr("alt",post.post_title);
					$postTemplate.find(".dif-post-text h3 a").html(post.post_title);
					$postTemplate.find(".prof-like li").remove();
					$postTemplate.find(".prof-like").append("<li><div addthis:url='" + post.post_url + "' addthis:title='" + post.post_title + "' class='addthis_toolbox addthis_default_style' id='posts-container'><a class='addthis_button_facebook_like'fb:like:layout='button_count'></a></div></li>");
					$postTemplate.find(".profile-data h4 a").html(post.author);
					$postTemplate.find(".profile-photo img").attr("src","/avatar?uid=" + post.user_id);
					$postTemplate.find("ul.replies li a").html(post.comment_count + "replies");

					$postTemplate.find("a").attr("href","/photos/" + post.post_name);
					
					$postTemplate.find("a.author-link").attr("href",userURL);

					$postTemplate.find("ul.prof-tags").html("");



					$.each(post.terms,function(index,term){


						
						$postTemplate.find("ul.prof-tags").append("<li>" + term.name + "</li>");

					});

					
					

					$(".posts-list").append($postTemplate);
					addthis.toolbox('.addthis_toolbox');
				});
				//$(".community-pager .more").fadeIn();

			} else if (querySettings.state != null) {



				var catName = $(".page-title").attr("cat-title");

				var resultsString = "<h2>Sorry, we don't have any " + catName + " photos in " + querySettings.state + ". <br><a href='/photos/new'>Want to post one?</a></h2>";

				$(".posts-list").append(resultsString);

				$(".community-pager .more").fadeOut();


			}




		});


	}



});