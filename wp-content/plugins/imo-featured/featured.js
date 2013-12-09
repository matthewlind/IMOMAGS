jQuery( document ).ready(function( $ ) {




	if ($.QueryString["action"] == "update" || $.QueryString["action"] == "delete") {

		document.location = "/wp-admin/options-general.php?page=imo-featured-manager";
	}




    //If we are on the set listing page:
    if ( $("div.set-list-container").length > 0 ){


		var $setContainer = $("<div class='set-container'><p class='id-block'>ID: <span class='set-id'></span></p><h2 class='set-title'></h2><div class='posts-container'></div></div>");

		//var $postItemTemplate = $("<div class='post-item-template'><img src=''><p class='post-title'>HEY WHAT UP</p></div>");

		var $postItemTemplate = $("<div class='media post-item-template'><a class='pull-left' href='#'><img class='media-object' src=''></a><div class='media-body post-title'></div></div>");

		var allSetsURL = "/wpdb/get-all-sets.php";

		$.getJSON(allSetsURL,function(sets){


			//console.log(sets);
			var setsObject = $.extend({}, sets);
			//console.log(setsObject);

			$setsObject = $(setsObject);

			$.each(setsObject,function(index,setData){

				//console.log(index,set);

				var set = setData.posts;
				var name = setData.name;

				var $newSetContainer = $setContainer.clone();



				$newSetContainer.find(".set-id").text(index);
				$newSetContainer.find(".set-title").html(name);




				//alert(index);

				$newSetContainer.on("click",function(ev){
					ev.preventDefault();

					window.open("/wp-admin/options-general.php?page=imo-featured-manager&setID=" + index,"_self");
				});

				$.each(set,function(index,post){



					var $newPostItem = $postItemTemplate.clone();

					$newPostItem.find("img").attr("src",post.thumb);
					$newPostItem.find(".post-title").html(post.title);



					$newSetContainer.find(".posts-container").append($newPostItem);

				});

				var setID = index;
				$deleteButton = $('<a set_id=' + setID + ' class="btn btn-delete btn-danger" href="">X</a>');
				$newSetContainer.append($deleteButton);

				$deleteButton.on("click",function(ev){
					ev.preventDefault();
					ev.stopPropagation();

					if (confirm('Are you sure you want to delete this set?')) {
					    document.location = "/wp-admin/options-general.php?page=imo-featured-manager&action=delete&setID=" + setID;
					} else {
					    // Do nothing!
					}


				});

				$("div.set-list-container").prepend($newSetContainer);


			});


			$masonryContainer = $(".set-list-container");

			$masonryContainer.masonry({

			  itemSelector: '.set-container'
			});


		});

	}


    //If we are on the add/edit set page
    if ($("div.post-search").length > 0) {


		//var listItemTemplate = '<li post_id="" style="" class="list-item" role="menuitem"><span class="ui-icon ui-icon-arrowthick-2-n-s" style=""></span><a target="_new" class="ui-corner-all" tabindex="-1"><img src="/files/2012/11/Carry-gear-150x150.jpg"><span class="post-title">Gear Essentials: What You Need for Everyday Carry</span></a><a post_id="" class="btn btn-delete btn-danger" href="">X</a></li>';

		var listItemTemplate = "<div class='media post-item-template list-item'><span class='ui-icon ui-icon-arrowthick-2-n-s' style=''></span><a class='pull-left' href='#'><img class='media-object' src=''></a><div class='media-body post-title'></div><a post_id='' class='btn btn-delete btn-danger' href=''>X</a></div>";

		jQuery.ui.autocomplete.prototype._resizeMenu = function () {
		  var ul = this.menu.element;
		  ul.outerWidth(this.element.outerWidth());
		}

		var setID = getParameterByName("setID");

		if (!isNaN(setID)) {//if setID is a number, load the poosts

			var setURL = "/wpdb/get-post-set.php?setID=" + setID;

			$.getJSON(setURL,function(setData){

				var posts = setData.posts;

				$("#name").val(setData.name);
				$(".edit-set-header").append(setData.name);

				$.each(posts,function(index,post){

			        $listTemplate = $(listItemTemplate);

			        $listTemplate.find("img").attr("src",post.thumb);
			        $listTemplate.find("a").attr("href",post.url);
			        $listTemplate.find("a.btn-delete").attr("post_id",post.id);
			        $listTemplate.attr("post_id",post.id);
			        $listTemplate.find(".post-title").html(post.title);

			        $("ul#sortable").append($listTemplate);

			        attachDeleteEvent($listTemplate.find("a.btn-delete"));

			        updateForm();
				});
			});

		}

		var autoComplete = $( "#featured-search" ).autocomplete({
		    minLength: 0,
		    source: "/wpdb/autocomplete.php",
		    // focus: function( event, ui ) {
		    //     $( "#featured-search" ).val( ui.item.value );
		    //     return false;
		    // },
		    select: function( event, ui ) {
		        $( "#featured-search" ).val( "" );

		        $listTemplate = $(listItemTemplate);

		        $listTemplate.find("img").attr("src",ui.item.thumb);
		        $listTemplate.find("a").attr("href",ui.item.url);
		        $listTemplate.find("a.btn-delete").attr("post_id",ui.item.id);
		        $listTemplate.attr("post_id",ui.item.id);
		        $listTemplate.find(".post-title").html(ui.item.title);

		        $("ul#sortable").prepend($listTemplate);

		        attachDeleteEvent($listTemplate.find("a.btn-delete"));

		        updateForm();

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


	    function updateForm() {

	    	$items = $(".list-item");
	    	//console.log($items);

	    	var postIDString = "";

	    	$items.each(function(index,item){

	    		//console.log(index,item);
	    		postIDString += $(item).attr("post_id");
	    		postIDString += ",";
	    	});

	    	postIDString = postIDString.toString().slice(0, -1);

	    	console.log(postIDString);
	    	$("input#post_ids").val(postIDString);

	    }

	    function getParameterByName(name) {
		    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
		    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
		}

		function attachDeleteEvent(deleteButton) {
			$(deleteButton).on("click",function(ev){
				ev.preventDefault();

				$(this).closest("div.list-item").remove();
				updateForm();

			});
		}


    }





});

(function($) {
    $.QueryString = (function(a) {
        if (a == "") return {};
        var b = {};
        for (var i = 0; i < a.length; ++i)
        {
            var p=a[i].split('=');
            if (p.length != 2) continue;
            b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
        }
        return b;
    })(window.location.search.substr(1).split('&'))
})(jQuery);