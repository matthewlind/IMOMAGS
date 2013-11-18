jQuery( document ).ready(function( $ ) {


    //If we are on the set listing page:
    if ( $("div.set-list-container").length > 0 ){


		var $setContainer = $("<div class='set-container'><h2>Set ID: <span class='set-id'></span></h2><div class='posts-container'></div></div>");

		var $postItemTemplate = $("<div class='post-item-template'><img src=''><p class='post-title'>HEY WHAT UP</p></div>");

		var allSetsURL = "/wpdb/get-all-sets.php";

		$.getJSON(allSetsURL,function(sets){


			console.log(sets);
			var setsObject = $.extend({}, sets);
			console.log(setsObject);

			$setsObject = $(setsObject);

			$.each(setsObject,function(index,set){

				console.log(index,set);

				var $newSetContainer = $setContainer.clone();



				$newSetContainer.find(".set-id").text(index);




				//alert(index);

				$newSetContainer.on("click",function(ev){
					ev.preventDefault();

					window.open("/wp-admin/options-general.php?page=imo-featured-manager&setID=" + index,"_self");
				});

				$.each(set,function(index,post){



					var $newPostItem = $postItemTemplate.clone();

					$newPostItem.find("img").attr("src",post.thumb);
					$newPostItem.find("p").html(post.title);



					$newSetContainer.find(".posts-container").append($newPostItem);

				});



				$("div.set-list-container").prepend($newSetContainer);


			});


			$masonryContainer = $(".set-list-container");

			$masonryContainer.masonry({

			  itemSelector: '.set-container'
			});


		});

	}


    //If we are on the add/new set page
    if ($("div.post-search").length > 0) {


		var listItemTemplate = '<li post_id="" style="" class="list-item" role="menuitem"><span class="ui-icon ui-icon-arrowthick-2-n-s" style=""></span><a target="_new" class="ui-corner-all" tabindex="-1"><img src="/files/2012/11/Carry-gear-150x150.jpg"><span class="post-title">Gear Essentials: What You Need for Everyday Carry</span></a><a post_id="" class="btn btn-delete btn-danger" href="">X</a></li>';

		jQuery.ui.autocomplete.prototype._resizeMenu = function () {
		  var ul = this.menu.element;
		  ul.outerWidth(this.element.outerWidth());
		}

		var setID = getParameterByName("setID");

		if (!isNaN(setID)) {//if setID is a number, load the poosts

			var setURL = "/wpdb/get-post-set.php?setID=" + setID;

			$.getJSON(setURL,function(posts){

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

				$(this).closest("li").remove();
				updateForm();

			});
		}


    }





});