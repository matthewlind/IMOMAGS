(function ($, undefined) {
    $.fn.getCursorPosition = function () {
        var el = $(this).get(0);
        var pos = 0;
        if ('selectionStart' in el) {
            pos = el.selectionStart;
        } else if ('selection' in document) {
            el.focus();
            var Sel = document.selection.createRange();
            var SelLength = document.selection.createRange().text.length;
            Sel.moveStart('character', -el.value.length);
            pos = Sel.text.length - SelLength;
        }
        return pos;
    }
})(jQuery);

jQuery( document ).ready(function( $ ) {


    //If we are on the add/edit set page
    if ($("div.post-search").length > 0) {


		//var listItemTemplate = '<li post_id="" style="" class="list-item" role="menuitem"><span class="ui-icon ui-icon-arrowthick-2-n-s" style=""></span><a target="_new" class="ui-corner-all" tabindex="-1"><img src="/files/2012/11/Carry-gear-150x150.jpg"><span class="post-title">Gear Essentials: What You Need for Everyday Carry</span></a><a post_id="" class="btn btn-delete btn-danger" href="">X</a></li>';

		var listItemTemplate = "<div class='wp-caption inline-post' style='padding:10px'><img src='' style='float:left;margin-right:10px;'><div class='inline-details'><h1 class='post-title'></h1><p class='post-content'></p></div></div>";;

		jQuery.ui.autocomplete.prototype._resizeMenu = function () {
		  var ul = this.menu.element;
		  ul.outerWidth(this.element.outerWidth());
		}

		var autoComplete = $( "#featured-search" ).autocomplete({
		    minLength: 0,
		    source: "/wpdb/autocomplete-inline.php",
		    // focus: function( event, ui ) {
		    //     $( "#featured-search" ).val( ui.item.value );
		    //     return false;
		    // },
		    select: function( event, ui ) {
		        $( "#featured-search" ).val( "" );

		        $listTemplate = $(listItemTemplate);

		        console.log(ui.item);


		        $listTemplate.find("img").attr("src",ui.item.thumb);
		        $listTemplate.find("a").attr("href",ui.item.url);
		        $listTemplate.find(".inline-post").attr("post_id",ui.item.id);
		        $listTemplate.attr("post_id",ui.item.id);
		        $listTemplate.find(".post-title").html(ui.item.title);
		        $listTemplate.find(".post-content").html(ui.item.post_content);

		        $listTemplate.find(".post-title").attr("contentEditable",true)
		        $listTemplate.find(".post-content").attr("contentEditable",true)

		      	$(".preview-container").html("")
			    $(".preview-container").append($listTemplate);



			    $(".post-search").html("Edit the Preview Text:");
			    $(".insert-button").fadeIn();

		        return false;
		    },

		    _resizeMenu: function() {
			  this.menu.element.outerWidth( 550 );
			}
		})
		.data( "autocomplete" )._renderItem = function( ul, item ) {
		    return $( "<li style='height:50px;margin-top:5px;margin-bottom:5px;'></li>" )
		        .data( "item.autocomplete", item )
		        .append( "<a href='" + item.url + "'><img width=50 height=50 style='margin-right:10px' src='" + item.thumb + "'><span class='post-title'>" + item.title + "</span></a>" )
		        .appendTo( ul );
		};


	    $( "#sortable" ).sortable({
	    	update: function( event, ui ) {

		    	updateForm();
		    }
	    });
	    $( "#sortable" ).disableSelection();


	    $(".insert-button").on("click",function(ev){
	    	self.parent.tb_remove();

	    	var id = $listTemplate.attr("post_id");
	    	var title = $listTemplate.find(".post-title").html();
	    	var body = $listTemplate.find(".post-content").html();

	    	var shortcodeString = buildShortcode(id,title,body);

	    	insertAtcursor(shortcodeString);

	    });



    }


	function insertAtcursor(text) {
		//The TinyMCE Editor and HTML editor are totally separate

		var $wpEditorArea = $(".wp-editor-area",window.parent.document);

		//Insert into HTML Editor
		if ($wpEditorArea.length > 0) {
			var position = $wpEditorArea.getCursorPosition()
	  	var content = $wpEditorArea.val();
		var newContent = content.substr(0, position) + text + content.substr(position);
		$wpEditorArea.val(newContent);
		}

	//Insert into TinyMCE Editor
		parent.tinymce.activeEditor.execCommand('mceInsertContent', false, text);
	}


	function buildShortcode(id,title,body) {

		var shortcode = "[inline-post id=" + id + " title=\"" + title.replace("\"","'") + "\" body=\""+ body.replace("\"","'") + "\"]";
		return shortcode;
	}


});







