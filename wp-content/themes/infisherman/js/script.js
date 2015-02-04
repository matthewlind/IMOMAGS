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

	//Master Angler Page
	//Set the filter to the default settings
	
		
    //Set the filter to the default settings
    filter = {};
    filterReset();
    function filterReset() {
        filter.order_by = "created";
        filter.sort = "DESC";
        filter.master = 1;
        filter.skip = 0;
        filter.post_type = "all";
        filter.per_page = 9;
        filter.post_count = 10000000;
    }

	
	//Place ads
	function adPlacement() {
		jQuery("#ma-entries .community-ad").remove();
		if (jQuery(window).width() <  1096 ) {
			jQuery('<div class="community-ad"><div class="image-banner"><iframe id="community-listing-ad" width=300 height=250 marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-community-ad.php?ad_code=imo.in-fisherman"></iframe></div></div>')
			.insertAfter("#ma-content:nth-child(5n)");
		}
	}
	
    //Get the JSON using the above filter configuration and append the photos.
    getPhotosAndAppend();
    loadMoreCheck();
    function getPhotosAndAppend() {
    	
        var url = "http://" + document.domain + "/community-api/posts?skip="+filter.skip+"&per_page="+filter.per_page+"&order_by="+filter.order_by+"&sort="+filter.sort+"&master="+filter.master+"&post_type="+filter.post_type;
		var desc;
        jQuery.getJSON(url,function(posts){

            jQuery.each(posts,function(index,post){
            	
            	if(post.body){
            		desc = post.body;
					if(desc.length > 201){
						desc = '<p>' + desc.substring(0, 200) + '<a href="/photos/' + post.id + '"> more <span class="meta-nav">&raquo;</span></a>';
					}
				}else{
					desc = '';
				}
				
				jQuery('#ma-entries').append('<div id="ma-content" class="post article-brief clearfix"><a href="/photos/' + post.id + '"><img class="attachment-list-thumb wp-post-image" src="' + post.img_url + '/convert?w=440&h=270&fit=crop&rotate=exif" alt="" /></a><div class="article-holder"><div class="clearfix"><span class="cat-feat-label"><a class="category-name-link primary-cat" href="/master-angler" unescape(  onclick="_gaq.push([\'_trackEvent\',\'Category\',\'master-angler\']);"  )>Master Angler</a> <a class="category-name-link" href="/' + post.post_type + '"unescape(  onclick="_gaq.push([\'_trackEvent\',\'Category\',\'' + post.post_type + '\']);"  )>' + post.post_type + '</a></span></div><h3 class="entry-title"><a href="/photos/' + post.id + '" rel="bookmark">' + post.title + '</a></h3><a class="comment-count" href="/photos/' + post.id + '#reply_field">' + post.comment_count + '</a><div class="entry-content"></a></p></div><div class="entry-meta">' + desc + '</div></div>');
				 
			});
         
			adPlacement();
			
            //hide the ajax loading spinner
            jQuery("#ajax-loader").hide();

        });
    }

    //Loadmore button
    jQuery("a.load-more").click(function(ev){
		ev.preventDefault();
		
		filter.skip = filter.skip + filter.per_page;
		getPhotosAndAppend();
		console.log("getPhotosAndAppend");
		loadMoreCheck();
		console.log("loadMoreCheck");
		//refresh the sticky ad on load more
		if (jQuery(window).width() >  610 ) {
			document.getElementById('sticky-iframe-ad').contentWindow.location.reload();
			jQuery(".sidebar.advert").css({
		    	display: 'block',
				position: 'fixed',
				top: 10
			});
		}
    });

	
    //CHeck to see if loadmore needs to be hidden
    function loadMoreCheck() {
        var url = "http://" + document.domain + "/community-api/posts/counts?skip="+filter.skip+"&per_page="+filter.per_page+"&order_by="+filter.order_by+"&sort="+filter.sort+"&master="+filter.master+"&post_type="+filter.post_type;


        jQuery.getJSON(url,function(countData){


            var totalPostCount = countData[0].post_count;

            //console.log(totalPostCount,filter.skip);

            if (filter.skip + filter.per_page >= totalPostCount ) {
                jQuery("a.load-more").hide();
            } else {
                jQuery("a.load-more").show();
            }

        });
    }


	//*******************************************************
	//****************** UPLOAD COMMUNITY IMAGES **********************
	//*******************************************************
	jQuery(".common-image-upload").change(function(ev){//After the user selects a file

		var fileInput = ev.currentTarget;

		if (!fileInput.value) {
			//If they don't select anything... Do nothing
		    //console.log("Choose an Image to upload.");
		} else {

			jQuery('#progressBar').fadeIn();

			filepicker.setKey('ANCtGPesfQI6nKja0ipqBz');

			jQuery('#loadingModal').modal();

			jQuery("html, body").animate({ scrollTop: 0 }, "slow");

		    filepicker.store(fileInput, function(FPFile){//Begin the upload


		    		if (FPFile.mimetype.indexOf("image") != -1) {

			            var img_url = FPFile.url;

			            var n = img_url.lastIndexOf('/');
						var FPID = img_url.substring(n + 1);


						//alert(FPID);

						jQuery('#loadingModal').append("<img src='" + img_url + "' width=1 height=1>");

						document.location = "/photos/new#" + FPID;
						//alert(FPID);

					} else {
						alert("Only images can be posted. Other file types are not allowed.");
						jQuery('#loadingModal').modal('hide');
					}

		        }, function(FPError) {
		            //console.log(FPError.toString());
		        }, function(progress) {
		        	//upload progress
		            //console.log("Loading: "+progress+"%");//PROGRESS INDICATOR!!!!!

		            //progress bar
		            jQuery('#progressBar div').css("width",progress*3 + "px");
		            jQuery('#progressBar span').text(""+progress+"%");

		        }
		   );

		}
	});

});
//Ink Filepicker
(function(a){if(window.filepicker){return}var b=a.createElement("script");b.type="text/javascript";b.async=!0;b.src=("https:"===a.location.protocol?"https:":"http:")+"//api.filepicker.io/v1/filepicker.js";var c=a.getElementsByTagName("script")[0];c.parentNode.insertBefore(b,c);var d={};d._queue=[];var e="pick,pickMultiple,pickAndStore,read,write,writeUrl,export,convert,store,storeUrl,remove,stat,setKey,constructWidget,makeDropPane".split(",");var f=function(a,b){return function(){b.push([a,arguments])}};for(var g=0;g<e.length;g++){d[e[g]]=f(e[g],d._queue)}window.filepicker=d})(document);


//Bootstrap Modal
+function(a){"use strict";var b=function(b,c){this.options=c,this.jQueryelement=a(b),this.jQuerybackdrop=this.isShown=null,this.options.remote&&this.jQueryelement.load(this.options.remote)};b.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},b.prototype.toggle=function(a){return this[this.isShown?"hide":"show"](a)},b.prototype.show=function(b){var c=this,d=a.Event("show.bs.modal",{relatedTarget:b});this.jQueryelement.trigger(d);if(this.isShown||d.isDefaultPrevented())return;this.isShown=!0,this.escape(),this.jQueryelement.on("click.dismiss.modal",'[data-dismiss="modal"]',a.proxy(this.hide,this)),this.backdrop(function(){var d=a.support.transition&&c.jQueryelement.hasClass("fade");c.jQueryelement.parent().length||c.jQueryelement.appendTo(document.body),c.jQueryelement.show(),d&&c.jQueryelement[0].offsetWidth,c.jQueryelement.addClass("in").attr("aria-hidden",!1),c.enforceFocus();var e=a.Event("shown.bs.modal",{relatedTarget:b});d?c.jQueryelement.find(".modal-dialog").one(a.support.transition.end,function(){c.jQueryelement.focus().trigger(e)}).emulateTransitionEnd(300):c.jQueryelement.focus().trigger(e)})},b.prototype.hide=function(b){b&&b.preventDefault(),b=a.Event("hide.bs.modal"),this.jQueryelement.trigger(b);if(!this.isShown||b.isDefaultPrevented())return;this.isShown=!1,this.escape(),a(document).off("focusin.bs.modal"),this.jQueryelement.removeClass("in").attr("aria-hidden",!0).off("click.dismiss.modal"),a.support.transition&&this.jQueryelement.hasClass("fade")?this.jQueryelement.one(a.support.transition.end,a.proxy(this.hideModal,this)).emulateTransitionEnd(300):this.hideModal()},b.prototype.enforceFocus=function(){a(document).off("focusin.bs.modal").on("focusin.bs.modal",a.proxy(function(a){this.jQueryelement[0]!==a.target&&!this.jQueryelement.has(a.target).length&&this.jQueryelement.focus()},this))},b.prototype.escape=function(){this.isShown&&this.options.keyboard?this.jQueryelement.on("keyup.dismiss.bs.modal",a.proxy(function(a){a.which==27&&this.hide()},this)):this.isShown||this.jQueryelement.off("keyup.dismiss.bs.modal")},b.prototype.hideModal=function(){var a=this;this.jQueryelement.hide(),this.backdrop(function(){a.removeBackdrop(),a.jQueryelement.trigger("hidden.bs.modal")})},b.prototype.removeBackdrop=function(){this.jQuerybackdrop&&this.jQuerybackdrop.remove(),this.jQuerybackdrop=null},b.prototype.backdrop=function(b){var c=this,d=this.jQueryelement.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var e=a.support.transition&&d;this.jQuerybackdrop=a('<div class="modal-backdrop '+d+'" />').appendTo(document.body),this.jQueryelement.on("click.dismiss.modal",a.proxy(function(a){if(a.target!==a.currentTarget)return;this.options.backdrop=="static"?this.jQueryelement[0].focus.call(this.jQueryelement[0]):this.hide.call(this)},this)),e&&this.jQuerybackdrop[0].offsetWidth,this.jQuerybackdrop.addClass("in");if(!b)return;e?this.jQuerybackdrop.one(a.support.transition.end,b).emulateTransitionEnd(150):b()}else!this.isShown&&this.jQuerybackdrop?(this.jQuerybackdrop.removeClass("in"),a.support.transition&&this.jQueryelement.hasClass("fade")?this.jQuerybackdrop.one(a.support.transition.end,b).emulateTransitionEnd(150):b()):b&&b()};var c=a.fn.modal;a.fn.modal=function(c,d){return this.each(function(){var e=a(this),f=e.data("bs.modal"),g=a.extend({},b.DEFAULTS,e.data(),typeof c=="object"&&c);f||e.data("bs.modal",f=new b(this,g)),typeof c=="string"?f[c](d):g.show&&f.show(d)})},a.fn.modal.Constructor=b,a.fn.modal.noConflict=function(){return a.fn.modal=c,this},a(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(b){var c=a(this),d=c.attr("href"),e=a(c.attr("data-target")||d&&d.replace(/.*(?=#[^\s]+jQuery)/,"")),f=e.data("modal")?"toggle":a.extend({remote:!/#/.test(d)&&d},e.data(),c.data());b.preventDefault(),e.modal(f,this).one("hide",function(){c.is(":visible")&&c.focus()})}),a(document).on("show.bs.modal",".modal",function(){a(document.body).addClass("modal-open")}).on("hidden.bs.modal",".modal",function(){a(document.body).removeClass("modal-open")})}(window.jQuery)
