/*
 * Thickbox 3.1 - One Box To Rule Them All.
 * By Cody Lindley (http://www.codylindley.com)
 * Copyright (c) 2007 cody lindley
 * Licensed under the MIT License: http://www.opensource.org/licenses/mit-license.php
*/

if ( typeof tb_pathToImage != 'string' ) {
	var tb_pathToImage = thickboxL10n.loadingAnimation;
}
if ( typeof tb_closeImage != 'string' ) {
	var tb_closeImage = thickboxL10n.closeImage;
}

/*!!!!!!!!!!!!!!!!! edit below this line at your own risk !!!!!!!!!!!!!!!!!!!!!!!*/

var tb_options = {
	auto_resize: true,
	click_img: "close",
	click_end: "loop",
	click_bg: "close",
	wheel_img: "prev_next",
	keys_close: [27, 13], // Esc, Enter
	keys_prev: [188, 37], // < , Left
	keys_next: [190, 39], // > , Right
	keys_first: [36], // Home
	keys_last: [35], // End
	move_img: false,
	move_content: false,
	resize_img: false,
	resize_content: false,
	effect_open: "none",
	effect_close: "fade",
	effect_trans: "none",
	effect_speed: "fast"
};

//on page load call tb_init
jQuery(document).ready(function(){
	tb_init('a.thickbox, area.thickbox, input.thickbox');//pass where to apply thickbox
	imgLoader = new Image();// preload image
	imgLoader.src = tb_pathToImage;
});

//add thickbox to href & area elements that have a class of .thickbox
function tb_init(domChunk){
	jQuery(domChunk).live('click', tb_click);
}

function tb_click(){
	var t = this.title || this.name || null;
	var a = this.href || this.alt;
	var g = this.rel || false;
	tb_show(t,a,g);
	this.blur();
	return false;
}

function tb_show(caption, url, imageGroup) {//function called when the user clicks on a thickbox link

	try {
		if (typeof document.body.style.maxHeight === "undefined") {//if IE 6
			jQuery("body","html").css({height: "100%", width: "100%"});
			jQuery("html").css("overflow","hidden");
			if (document.getElementById("TB_HideSelect") === null) {//iframe to hide select elements in ie6
				jQuery("body").append("<iframe id='TB_HideSelect'>"+thickboxL10n.noiframes+"</iframe><div id='TB_overlay'></div><div id='TB_window'></div>");
				if (tb_options.click_bg == "close")
					jQuery("#TB_overlay").click(tb_remove);
			}
		}else{//all others
			if(document.getElementById("TB_overlay") === null){
				jQuery("body").append("<div id='TB_overlay'></div><div id='TB_window'></div>");
				if (tb_options.click_bg == "close")
					jQuery("#TB_overlay").click(tb_remove);
			}
		}

		if(tb_detectMacXFF()){
			jQuery("#TB_overlay").addClass("TB_overlayMacFFBGHack");//use png overlay so hide flash
		}else{
			jQuery("#TB_overlay").addClass("TB_overlayBG");//use background and opacity
		}

		if(caption===null){caption="";}
		jQuery("body").append("<div id='TB_load'><img src='"+imgLoader.src+"' /></div>");//add loader to the page
		jQuery('#TB_load').show();//show loader

		var baseURL;
	   if(url.indexOf("?")!==-1){ //ff there is a query string involved
			baseURL = url.substr(0, url.indexOf("?"));
	   }else{
	   		baseURL = url;
	   }

	   var urlString = /\.jpg$|\.jpeg$|\.png$|\.gif$|\.bmp$|\.webp$/;
	   var urlType = baseURL.toLowerCase().match(urlString);

		if(urlType == '.jpg' || urlType == '.jpeg' || urlType == '.png' || urlType == '.gif' || urlType == '.bmp' || urlType == '.webp'){//code to show images

			TB_PrevCaption = "";
			TB_PrevURL = "";
			TB_PrevHTML = "";
			TB_NextCaption = "";
			TB_NextURL = "";
			TB_NextHTML = "";
			TB_imageCount = "";
			TB_FoundURL = false;
			TB_FirstCaption = "";
			TB_FirstURL = "";
			TB_LastCaption = "";
			TB_LastURL = "";
			if(imageGroup){
				TB_TempArray = jQuery("a[rel="+imageGroup+"]").get();
				for (TB_Counter = 0; ((TB_Counter < TB_TempArray.length) && (TB_NextHTML === "")); TB_Counter++) {
					var urlTypeTemp = TB_TempArray[TB_Counter].href.toLowerCase().match(urlString);
						if (!(TB_TempArray[TB_Counter].href == url)) {
							if (TB_FoundURL) {
								TB_NextCaption = TB_TempArray[TB_Counter].title;
								TB_NextURL = TB_TempArray[TB_Counter].href;
								TB_NextHTML = "<span id='TB_next'>&nbsp;&nbsp;<a href='#'>"+thickboxL10n.next+"</a></span>";
							} else {
								TB_PrevCaption = TB_TempArray[TB_Counter].title;
								TB_PrevURL = TB_TempArray[TB_Counter].href;
								TB_PrevHTML = "<span id='TB_prev'>&nbsp;&nbsp;<a href='#'>"+thickboxL10n.prev+"</a></span>";
							}
						} else {
							TB_FoundURL = true;
							TB_imageCount = thickboxL10n.image + ' ' + (TB_Counter + 1) + ' ' + thickboxL10n.of + ' ' + (TB_TempArray.length);
						}
				}
				TB_FirstCaption = TB_TempArray[0].title;
				TB_FirstURL = TB_TempArray[0].href;
				TB_LastCaption = TB_TempArray[TB_TempArray.length - 1].title;
				TB_LastURL = TB_TempArray[TB_TempArray.length - 1].href;
			}

			imgPreloader = new Image();
			imgPreloader.onload = function(){
			imgPreloader.onload = null;

			// Resizing large images - orginal by Christian Montoya edited by me.
			var pagesize = tb_getPageSize();
			var x = pagesize[0] - 150;
			var y = pagesize[1] - 150;
			var imageWidth = imgPreloader.width;
			var imageHeight = imgPreloader.height;
			if (tb_options.auto_resize) {
			if (imageWidth > x) {
				imageHeight = imageHeight * (x / imageWidth);
				imageWidth = x;
				if (imageHeight > y) {
					imageWidth = imageWidth * (y / imageHeight);
					imageHeight = y;
				}
			} else if (imageHeight > y) {
				imageWidth = imageWidth * (y / imageHeight);
				imageHeight = y;
				if (imageWidth > x) {
					imageHeight = imageHeight * (x / imageWidth);
					imageWidth = x;
				}
			}
			}
			// End Resizing

			TB_WIDTH = imageWidth + 30;
			TB_HEIGHT = imageHeight + 60;
			TB_Image = "<img id='TB_Image' src='"+url+"' width='"+imageWidth+"' height='"+imageHeight+"' alt='"+caption+"'/>";
			if (tb_options.click_img == "close" || (!imageGroup && tb_options.click_end == "close"))
				TB_Image = "<a href='' id='TB_ImageOff' title='"+thickboxL10n.close+"'>" + TB_Image + "</a>";
			jQuery("#TB_window").append(TB_Image + "<div id='TB_caption'>"+caption+"<div id='TB_secondLine'>" + TB_imageCount + TB_PrevHTML + TB_NextHTML + "</div></div><div id='TB_closeWindow'><a href='#' id='TB_closeWindowButton' title='"+thickboxL10n.close+"'><img src='" + tb_closeImage + "' /></a></div>");
			if (!imageGroup || !caption)
				jQuery("#TB_window").addClass("TB_singleLine");
			TB_WIDTH += jQuery("#TB_Image").outerWidth() - jQuery("#TB_Image").innerWidth(); // add left & right border-width of img
			TB_HEIGHT += jQuery("#TB_Image").outerHeight() - jQuery("#TB_Image").innerHeight(); // add top & bottom border-width of img

			jQuery("#TB_closeWindowButton").click(tb_remove);

			if (!(TB_PrevHTML === "")) {
				function goPrev(){
					jQuery(document).unbind('.thickbox');
					jQuery("#TB_window").remove();
					jQuery("body").append("<div id='TB_window' class='trans'></div>");
					tb_show(TB_PrevCaption, TB_PrevURL, imageGroup);
					return false;
				}
				jQuery("#TB_prev").click(goPrev);

				function goFirst(){
					jQuery(document).unbind('.thickbox');
					jQuery("#TB_window").remove();
					jQuery("body").append("<div id='TB_window' class='trans'></div>");
					tb_show(TB_FirstCaption, TB_FirstURL, imageGroup);
					return false;
				}
			}

			if (!(TB_NextHTML === "")) {
				function goNext(){
					jQuery(document).unbind('.thickbox');
					jQuery("#TB_window").remove();
					jQuery("body").append("<div id='TB_window' class='trans'></div>");
					tb_show(TB_NextCaption, TB_NextURL, imageGroup);
					return false;
				}
				jQuery("#TB_next").click(goNext);

				function goLast(){
					jQuery(document).unbind('.thickbox');
					jQuery("#TB_window").remove();
					jQuery("body").append("<div id='TB_window' class='trans'></div>");
					tb_show(TB_LastCaption, TB_LastURL, imageGroup);
					return false;
				}
			}

			if (imageGroup && tb_options.click_img == "next") {
				var id, title, handler;
				if (!(TB_NextHTML == "")) {
					id = "TB_ImageNext";
					title = thickboxL10n.next;
					handler = goNext;
				} else {
					if (tb_options.click_end == "close") {
						id = "TB_ImageClose";
						title = thickboxL10n.close;
						handler = tb_remove;
					} else if (tb_options.click_end == "loop") {
						id = "TB_ImageFirst";
						title = thickboxL10n.first;
						handler = goFirst;
					}
				}
				if (id && title && handler) {
					var height = jQuery("#TB_Image").outerHeight(true);
					jQuery("#TB_window").append("<div id='TB_ImageClick'><a href='' id='"+id+"' title='"+title+"' style='height:"+height+"px;'><span></span></a></div>");
					jQuery("#"+id).click(handler);
				}
			} else if (imageGroup && tb_options.click_img == "prev_next") {
				var id, title, handler, id2, title2, handler2;
				if (!(TB_PrevHTML == "")) {
					id = "TB_ImagePrev";
					title = thickboxL10n.prev;
					handler = goPrev;
				}
				if (!(TB_NextHTML == "")) {
					id2 = "TB_ImageNext";
					title2 = thickboxL10n.next;
					handler2 = goNext;
				}
				if (TB_PrevHTML == "") {
					if (tb_options.click_end == "close") {
						id = "TB_ImageClose";
						title = thickboxL10n.close;
						handler = tb_remove;
					} else if (tb_options.click_end == "loop") {
						id = "TB_ImageLast";
						title = thickboxL10n.last;
						handler = goLast;
					}
				} else if (TB_NextHTML == "") {
					if (tb_options.click_end == "close") {
						id2 = "TB_ImageClose";
						title2 = thickboxL10n.close;
						handler2 = tb_remove;
					} else if (tb_options.click_end == "loop") {
						id2 = "TB_ImageFirst";
						title2 = thickboxL10n.first;
						handler2 = goFirst;
					}
				}
				if ((id && title && handler) || (id2 && title2 && handler2)) {
					var height = jQuery("#TB_Image").outerHeight(true);
					var link = link2 = "";
					if (id && title && handler) link = "<a href='' id='"+id+"' class='TB_ImageLeft' title='"+title+"' style='height:"+height+"px;'></a>";
					if (id2 && title2 && handler2) link2 = "<a href='' id='"+id2+"' class='TB_ImageRight' title='"+title2+"' style='height:"+height+"px;'></a>";
					jQuery("#TB_window").append("<div id='TB_ImageClick'>"+link+link2+"</div>");
					if (link) jQuery("#"+id).click(handler);
					if (link2) jQuery("#"+id2).click(handler2);
					if (jQuery.browser.msie && parseInt(jQuery.browser.version) <= 7) // jQuery.browser is deprecated
						jQuery("#TB_ImageClick > a").focus(function() { this.blur(); }); // hide dotted lines around anchor
				}
			}

			jQuery(document).bind('keydown.thickbox', function(e){
				e.stopImmediatePropagation();

				if ( jQuery.inArray(e.which, tb_options.keys_close) != -1 ){ // close
					if ( ! jQuery(document).triggerHandler( 'wp_CloseOnEscape', [{ event: e, what: 'thickbox', cb: tb_remove }] ) )
						tb_remove();
				} else if ( jQuery.inArray(e.which, tb_options.keys_prev) != -1 // display previous image
					|| (e.shiftKey && jQuery.inArray(e.which, tb_options.keys_prev['shift']) != -1) ){ // check e.shiftKey ahead
					if(!(TB_PrevHTML == "")){
						goPrev();
					}
				} else if ( jQuery.inArray(e.which, tb_options.keys_next) != -1 ){ // display next image
					if(!(TB_NextHTML == "")){
						goNext();
					}
				} else if ( jQuery.inArray(e.which, tb_options.keys_first) != -1 ) { // display first image
					if(!(TB_PrevHTML == "")){
						goFirst();
					}
				} else if ( jQuery.inArray(e.which, tb_options.keys_last) != -1 ) { // display last image
					if(!(TB_NextHTML == "")){
						goLast();
					}
				}
				return false;
			});

			if (tb_options.wheel_img == "prev_next") {
				jQuery("#TB_window").bind('mousewheel.thickbox', function(e){
					e.stopImmediatePropagation();

					var delta = 0;
					if (!event) // for IE
						event = window.event;

					if (event.wheelDelta) {
						delta = event.wheelDelta;
					} else if (event.detail) { // Firefox
						delta = -event.detail; // minus sign
					}

					if (delta > 0) { // display previous image
						if(!(TB_PrevHTML == "")){
							goPrev();
							return false;
						}
					} else if (delta < 0) { // display next image
						if(!(TB_NextHTML == "")){
							goNext();
							return false;
						}
					}
				});
			}

			if (tb_options.move_img)
				jQuery("#TB_window").bind("mousedown.thickbox", function (e) { return tb_move(e, "image"); });
			if (tb_options.resize_img) {
				tb_resize_init();
				jQuery("#TB_Resize").bind("mousedown.thickbox", function (e) { return tb_resize(e, "image"); });
			}

			tb_position();
			jQuery("#TB_load").remove();
			if (tb_options.click_img == "close" || (!imageGroup && tb_options.click_end == "close"))
				jQuery("#TB_ImageOff").click(tb_remove);
			tb_open();
			};

			imgPreloader.src = url;
		}else{//code to show html

			var queryString = url.replace(/^[^\?]+\??/,'');
			var params = tb_parseQuery( queryString );

			TB_WIDTH = (params['width']*1) + 30 || 630; //defaults to 630 if no paramaters were added to URL
			TB_HEIGHT = (params['height']*1) + 40 || 440; //defaults to 440 if no paramaters were added to URL
			ajaxContentW = TB_WIDTH - 30;
			ajaxContentH = TB_HEIGHT - 45;

			if(url.indexOf('TB_iframe') != -1){// either iframe or ajax window
					urlNoQuery = url.split('TB_');
					jQuery("#TB_iframeContent").remove();
					if(params['modal'] != "true"){//iframe no modal
						jQuery("#TB_window").append("<div id='TB_title'><div id='TB_ajaxWindowTitle'>"+caption+"</div><div id='TB_closeAjaxWindow'><a href='#' id='TB_closeWindowButton' title='"+thickboxL10n.close+"'><img src='" + tb_closeImage + "' /></a></div></div><iframe frameborder='0' hspace='0' src='"+urlNoQuery[0]+"' id='TB_iframeContent' name='TB_iframeContent"+Math.round(Math.random()*1000)+"' onload='tb_showIframe()' style='width:"+(ajaxContentW + 29)+"px;height:"+(ajaxContentH + 17)+"px;' >"+thickboxL10n.noiframes+"</iframe>");
					}else{//iframe modal
					jQuery("#TB_overlay").unbind();
						jQuery("#TB_window").append("<iframe frameborder='0' hspace='0' src='"+urlNoQuery[0]+"' id='TB_iframeContent' name='TB_iframeContent"+Math.round(Math.random()*1000)+"' onload='tb_showIframe()' style='width:"+(ajaxContentW + 29)+"px;height:"+(ajaxContentH + 17)+"px;'>"+thickboxL10n.noiframes+"</iframe>");
					}
			}else{// not an iframe, ajax
					if(jQuery("#TB_window").css("display") != "block"){
						if(params['modal'] != "true"){//ajax no modal
						jQuery("#TB_window").append("<div id='TB_title'><div id='TB_ajaxWindowTitle'>"+caption+"</div><div id='TB_closeAjaxWindow'><a href='#' id='TB_closeWindowButton'><img src='" + tb_closeImage + "' /></a></div></div><div id='TB_ajaxContent' style='width:"+ajaxContentW+"px;height:"+ajaxContentH+"px'></div>");
						}else{//ajax modal
						jQuery("#TB_overlay").unbind();
						jQuery("#TB_window").append("<div id='TB_ajaxContent' class='TB_modal' style='width:"+ajaxContentW+"px;height:"+ajaxContentH+"px;'></div>");
						}
					}else{//this means the window is already up, we are just loading new content via ajax
						jQuery("#TB_ajaxContent")[0].style.width = ajaxContentW +"px";
						jQuery("#TB_ajaxContent")[0].style.height = ajaxContentH +"px";
						jQuery("#TB_ajaxContent")[0].scrollTop = 0;
						jQuery("#TB_ajaxWindowTitle").html(caption);
					}
			}

			jQuery("#TB_closeWindowButton").click(tb_remove);

				if(url.indexOf('TB_inline') != -1){
					jQuery("#TB_ajaxContent").append(jQuery('#' + params['inlineId']).children());
					jQuery("#TB_window").bind('tb_unload', function () {
						jQuery('#' + params['inlineId']).append( jQuery("#TB_ajaxContent").children() ); // move elements back when you're finished
					});
					tb_position();
					jQuery("#TB_load").remove();
					tb_open();
				}else if(url.indexOf('TB_iframe') != -1){
					tb_position();
					if (!("onload" in jQuery("#TB_iframeContent")[0]) && (typeof jQuery("#TB_iframeContent")[0]["onload"] != "function")) { // not support iframe onload - http://kangax.github.com/iseventsupported/
						tb_showIframe();
					}
				}else{
					var sign = (url.indexOf('?') == -1) ? '?' : '&';
					jQuery("#TB_ajaxContent").load(url += sign + "random=" + (new Date().getTime()),function(){//to do a post change this load method
						tb_position();
						jQuery("#TB_load").remove();
						tb_init("#TB_ajaxContent a.thickbox");
						tb_open();
					});
				}

			if (tb_options.move_content)
				jQuery("#TB_window").bind("mousedown.thickbox", function (e) { return tb_move(e, url.indexOf('TB_iframe') != -1 ? "iframe" : "ajax"); });
			if (tb_options.resize_content) {
				tb_resize_init();
				jQuery("#TB_Resize").bind("mousedown.thickbox", function (e) { return tb_resize(e, url.indexOf('TB_iframe') != -1 ? "iframe" : "ajax"); });
			}
		}

		if(!params['modal']){
			jQuery(document).bind('keyup.thickbox', function(e){

				if ( e.which == 27 ){ // close
					e.stopImmediatePropagation();
					if ( ! jQuery(document).triggerHandler( 'wp_CloseOnEscape', [{ event: e, what: 'thickbox', cb: tb_remove }] ) )
						tb_remove();

					return false;
				}
			});
		}

	} catch(e) {
		//nothing here
	}
}

//helper functions below
function tb_open() {
	if (jQuery("#TB_window").css("visibility") == "hidden") // for safety
		jQuery("#TB_window").css("visibility", "visible");

	var effect_type = jQuery("#TB_window").is(".trans") ? tb_options.effect_trans : tb_options.effect_open;
	tb_effectView(effect_type, false);
	var callback = function() { tb_effectView(effect_type); }
	switch (effect_type) {
		case "zoom":
			jQuery("#TB_window").height(jQuery("#TB_window").height()); // for image
			if (typeof document.body.style.maxHeight == "undefined")
				jQuery("#TB_window").css({marginTop: -jQuery("#TB_window").height() / 2, top: jQuery(window).height() / 2 + jQuery(document).scrollTop()});
			jQuery("#TB_Image").hide().show(tb_options.effect_speed);
			jQuery("#TB_window").show(tb_options.effect_speed, callback);
			break;
		case "slide":
			if (typeof document.body.style.maxHeight == "undefined")
				jQuery("#TB_window").css({marginTop: -jQuery("#TB_window").height() / 2, top: jQuery(window).height() / 2 + jQuery(document).scrollTop()});
			jQuery("#TB_window").slideDown(tb_options.effect_speed, callback);
			break;
		case "fade":
			jQuery("#TB_window").fadeIn(tb_options.effect_speed, callback);
			break;
		default:
			jQuery("#TB_window").show();
			break;
	}

	if (jQuery("#TB_window").css("display") == "none") // for safety
		jQuery("#TB_window").css("display", "block");
}

function tb_effectView(type, show) {
	show = typeof show == 'boolean' ? show : true;

	if (type != "none") {
		if (show)
			jQuery("#TB_ImageClick").show();
		else
			jQuery("#TB_ImageClick").hide();
	}

	if (window.chrome && (type == "zoom" || type == "fade")) {
		if (show) {
			jQuery("#TB_iframeContent").attr("scrolling", "auto");
			jQuery("body", jQuery("#TB_iframeContent").contents()).css("overflow", "auto");
			jQuery("#TB_ajaxContent").css("overflow", "");
		} else {
			jQuery("#TB_iframeContent").attr("scrolling", "no");
			jQuery("body", jQuery("#TB_iframeContent").contents()).css("overflow", "hidden");
			jQuery("#TB_ajaxContent").css("overflow", "hidden");
		}
	}
}

function tb_showIframe(){
	jQuery("#TB_load").remove();
	tb_open();
}

function tb_remove() {
	tb_effectView(tb_options.effect_close, false);
	var callback = function() {
		jQuery('#TB_window,#TB_overlay,#TB_HideSelect').trigger("tb_unload").unbind().remove();
		if (typeof document.body.style.maxHeight == "undefined") {//if IE 6
			jQuery("body","html").css({height: "auto", width: "auto"});
			jQuery("html").css("overflow","");
		}
	}
	switch (tb_options.effect_close) {
		case "zoom":
			jQuery("#TB_Image").hide(tb_options.effect_speed);
			jQuery("#TB_window").hide(tb_options.effect_speed, callback);
			break;
		case "slide":
			jQuery("#TB_window").slideUp(tb_options.effect_speed, callback);
			break;
		case "fade":
			jQuery("#TB_window").fadeOut(tb_options.effect_speed, callback);
			break;
		default:
			callback();
			break;
	}
	jQuery("#TB_load").remove();
	jQuery(document).unbind('.thickbox');
	return false;
}

function tb_position() {
var isIE6 = typeof document.body.style.maxHeight === "undefined";
jQuery("#TB_window").css({marginLeft: '-' + parseInt((TB_WIDTH / 2),10) + 'px', width: TB_WIDTH + 'px'});
	if ( ! isIE6 ) { // take away IE6
		jQuery("#TB_window").css({marginTop: '-' + parseInt((TB_HEIGHT / 2),10) + 'px'});
	}
}

function tb_parseQuery ( query ) {
   var Params = {};
   if ( ! query ) {return Params;}// return empty object

   // If query contains '?', extract string from index of '?' to the end.
   query = query.substring(query.indexOf('?') + 1);
   // URL: http://example.com/page.php?foo=bar#TB_inline?inlineId=id
   // query: "foo=bar#TB_inline?inlineId=id" => "inlineId=id"

   var Pairs = query.split(/[;&]/);
   for ( var i = 0; i < Pairs.length; i++ ) {
      var KeyVal = Pairs[i].split('=');
      if ( ! KeyVal || KeyVal.length != 2 ) {continue;}
      var key = unescape( KeyVal[0] );
      var val = unescape( KeyVal[1] );
      val = val.replace(/\+/g, ' ');
      Params[key] = val;
   }
   return Params;
}

function tb_getPageSize(){
	var de = document.documentElement;
	var w = window.innerWidth || self.innerWidth || (de&&de.clientWidth) || document.body.clientWidth;
	var h = window.innerHeight || self.innerHeight || (de&&de.clientHeight) || document.body.clientHeight;
	arrayPageSize = [w,h];
	return arrayPageSize;
}

function tb_detectMacXFF() {
  var userAgent = navigator.userAgent.toLowerCase();
  if (userAgent.indexOf('mac') != -1 && userAgent.indexOf('firefox')!=-1) {
    return true;
  }
}

function tb_move(event, source) {
	if (source == "image") {
		if (jQuery(event.target).parent().is("#TB_prev, #TB_next, #TB_closeWindowButton"))
			return true;
	} else {
		if (!jQuery(event.target).closest("#TB_title").length || jQuery(event.target).parent().is("#TB_closeWindowButton"))
			return true;
	}
	return tb_drag(event, source, "move");
}

function tb_resize(event, source) {
	var action;
	switch (event.target.id) {
		case "TB_ResizeN":
			action = "n-resize"; break;
		case "TB_ResizeE":
			action = "e-resize"; break;
		case "TB_ResizeW":
			action = "w-resize"; break;
		case "TB_ResizeS":
			action = "s-resize"; break;
		case "TB_ResizeNE":
			action = "ne-resize"; break;
		case "TB_ResizeNW":
			action = "nw-resize"; break;
		case "TB_ResizeSE":
			action = "se-resize"; break;
		case "TB_ResizeSW":
			action = "sw-resize"; break;
		default:
			return true;
	}
	return tb_drag(event, source, action);
}

function tb_resize_init() {
	jQuery("#TB_window").append("<div id='TB_Resize'><div id='TB_ResizeN'></div><div id='TB_ResizeE'></div><div id='TB_ResizeW'></div><div id='TB_ResizeS'></div><div id='TB_ResizeNE'></div><div id='TB_ResizeNW'></div><div id='TB_ResizeSE'></div><div id='TB_ResizeSW'></div></div>");
	if (typeof document.body.style.maxHeight == "undefined") // height:100% on position:absolute does not work in IE6
		jQuery("#TB_ResizeE, #TB_ResizeW").height(jQuery("#TB_window").height());
}

// @param source "image", "iframe" or "ajax" (inline)
// @param action "move" or "(n|e|w|s|ne|nw|se|sw)-resize" (same as CSS cursor propery)
function tb_drag(event, source, action) {
	if (event.which != 1) return true; // not left button

	TB_THRESHOLD = 5; // regarded as not drag
	MIN_WIDTH = MIN_HEIGHT = 100;
	var offsetLeft = jQuery("#TB_window").offset().left - parseInt(jQuery("#TB_window").css("marginLeft")); // cancel negative margin
	var offsetTop = jQuery("#TB_window").offset().top - parseInt(jQuery("#TB_window").css("marginTop"));
	if (typeof document.body.style.maxHeight != "undefined") { // IE6 has no scroll bar (width/height: 100%)
		offsetLeft -= jQuery(document).scrollLeft();
		offsetTop -= jQuery(document).scrollTop();
	}
	var startX = event.clientX;
	var startY = event.clientY;
	var startDrag = false;
	var cursorTargets = jQuery("#TB_window, #TB_overlay, " + (source == "image" ? "#TB_window a" : "#TB_closeWindowButton"));

	var moveX = action == "move" || action == "w-resize" || action == "nw-resize" || action == "sw-resize"; // move or west (northwest, southwest)
	var moveY = action == "move" || action == "n-resize" || action == "ne-resize" || action == "nw-resize"; // move or north (northwest, northeast)
	var resizeWidth = action != "move" && action != "n-resize" && action != "s-resize"; // not move, north and south
	var resizeHeight = action != "move" && action != "e-resize" && action != "w-resize"; // not move, east and west
	if (action != "move") {
		var startWidth = jQuery("#TB_window").width();
		var startHeight = jQuery("#TB_window").height();
		var resizeTarget = jQuery(source == "image" ? "#TB_Image" : (source == "iframe" ? "#TB_iframeContent" : "#TB_ajaxContent"));
		var startWidth2 = resizeTarget.width();
		var startHeight2 = resizeTarget.height();
		var signX = (action == "e-resize" || action == "ne-resize" || action == "se-resize") ? +1 : -1; // east (northeast, southeast) or not
		var signY = (action == "s-resize" || action == "se-resize" || action == "sw-resize") ? +1 : -1; // south (southeast, southwest) or not
		if (typeof document.body.style.maxHeight == "undefined")
			var startMarginTop = jQuery("#TB_window").css("marginTop");
	}

	jQuery(document).bind("mousemove.thickbox", function (e, clientX, clientY) {
		clientX = clientX ? clientX : e.clientX;
		clientY = clientY ? clientY : e.clientY;
		var offsetX = clientX - startX;
		var offsetY = clientY - startY;
		if (!startDrag) {
			offsetX = offsetX > TB_THRESHOLD ? offsetX - TB_THRESHOLD : (offsetX < -TB_THRESHOLD ? offsetX + TB_THRESHOLD : 0);
			offsetY = offsetY > TB_THRESHOLD ? offsetY - TB_THRESHOLD : (offsetY < -TB_THRESHOLD ? offsetY + TB_THRESHOLD : 0);
			if (Math.abs(offsetX) > 0 || Math.abs(offsetY) > 0) {
				startDrag = true;
				startX = clientX; // for smooth drag
				startY = clientY;
				cursorTargets.css("cursor", action);
			}
		}
		if (startDrag) {
			var skipMoveX = skipMoveY = false;
			if (resizeWidth) {
				var newWidth = startWidth + offsetX * signX;
				if (newWidth < MIN_WIDTH) {
					skipMoveX = true;
				} else {
					jQuery("#TB_window").width(newWidth);
					resizeTarget.width(startWidth2 + offsetX * signX);
				}
			}
			if (resizeHeight) {
				var newHeight = startHeight + offsetY * signY;
				if (newHeight < MIN_HEIGHT) {
					skipMoveY = true;
				} else {
					jQuery("#TB_window").height(newHeight);
					resizeTarget.height(startHeight2 + offsetY * signY);
					if (source == "image")
						jQuery("#TB_ImageClick > a").height(jQuery("#TB_Image").outerHeight(true));
					if (typeof document.body.style.maxHeight == "undefined") // undo rewritten marginTop in IE6
						jQuery("#TB_window").css("marginTop", startMarginTop);
				}
			}
			if (moveX && !skipMoveX)
				jQuery("#TB_window").css("left", offsetLeft + offsetX);
			if (moveY && !skipMoveY)
				jQuery("#TB_window").css("top", offsetTop + offsetY);
		}
		return false;
	});

	jQuery(document).bind("mouseup.thickbox", function (e) {
		jQuery(document).unbind("mousemove.thickbox mouseup.thickbox");
		if (source == "iframe")
			jQuery("#TB_iframeContent").contents().unbind("mousemove.thickbox mouseup.thickbox");

		if (!startDrag) return true;

		cursorTargets.css("cursor", "");

		var target = jQuery(e.target);
		if (!target.is(".TB_ImageLeft, .TB_ImageRight"))
			target = target.parent(); // e.g. #TB_ImageOff, #TB_prev, #TB_next, #TB_closeWindowButton
		var events = target.data("events");
		if (events && "click" in events && events["click"].length > 0) {
			var handlers = events["click"].concat(); // clone array
			target.unbind("click").one("click", function (e) { // prevent anchor jump
				e.stopImmediatePropagation();
				return false;
			});
			for (var i = 0; i < handlers.length; i++)
				target.click(handlers[i].handler); // rebind
		}
	});

	if (source == "iframe") {
		jQuery("#TB_iframeContent").contents()
			.bind("mousemove.thickbox", function (e) {
				e.clientX += jQuery("#TB_iframeContent").offset().left - jQuery(document).scrollLeft();
				e.clientY += jQuery("#TB_iframeContent").offset().top - jQuery(document).scrollTop();
				jQuery(document).trigger("mousemove.thickbox", [e.clientX, e.clientY]);
			})
			.bind("mouseup.thickbox", function (e) {
				jQuery(document).trigger("mouseup.thickbox");
			});
	}

	return false;
}
