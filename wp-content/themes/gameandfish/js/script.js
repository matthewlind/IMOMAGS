jQuery(document).ready(function($) {
	
	/*** Community menu ***/	
	//jQuery(function($) {
		
		//replace category links from WP menu with community link urls
		jQuery("#menu-hunting-community-menu li a, #menu-fishing-community-menu li a").each(function() {
			var href = jQuery(this).attr('href');
			var site = document.domain;
			href = href.replace(site, "");
			href = href.replace("http://", "");
			jQuery(this).attr('href', '/photos' + href);
		});
		
		//layout in columns
		if(jQuery(window).width() > 610){
		    var num_cols = 3,
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
	//});


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

						document.location = "/community/new#" + FPID;
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