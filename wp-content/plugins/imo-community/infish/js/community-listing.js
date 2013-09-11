jQuery(document).ready(function($) {
	

    //Set the filter to the default settings
    filter = {};
    filterReset();
    function filterReset() {
        filter.order_by = "created";
        filter.sort = "DESC";
        filter.master = 0;
        filter.skip = 0;
        filter.post_type = "all";
        filter.per_page=10;
        filter.post_count = 10000000;
    }

    //Highlight the default menu item
    $("ul.filter #filter-menu-default").addClass("active");

    //Get the JSON using the above filter configuration and append the photos.
    getPhotosAndAppend();
    loadMoreCheck();
    function getPhotosAndAppend() {
        var url = "http://" + document.domain + "/community-api/posts?skip="+filter.skip+"&per_page="+filter.per_page+"&order_by="+filter.order_by+"&sort="+filter.sort+"&master="+filter.master+"&post_type="+filter.post_type;

        $.getJSON(url,function(posts){

            $.each(posts,function(index,post){

                var postHTML = _.template( $('#post-template').html() , { post: post });
                $("#posts-container").append(postHTML);

            });

            //hide the ajax loading spinner
            $("#ajax-loader").hide();
            
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
    }

    //Change the filter configuration
    $(".filter-menu").click(function(ev){

        ev.preventDefault();

        //Grab the selected menu item
        var $menuItem = $(ev.currentTarget);

        //Change the actively selected menu item
        $("ul.filter li.active").removeClass("active");
        $menuItem.closest("li").addClass("active");

        //reset the filter
        filterReset();


        //Change the filter configuration according to the attributes of the clicked menu item
        if ($menuItem.attr("sort") != undefined) { filter.sort = $menuItem.attr("sort"); }
        if ($menuItem.attr("order_by") != undefined) { filter.order_by = $menuItem.attr("order_by"); }
        if ($menuItem.attr("master") != undefined) { filter.master = $menuItem.attr("master"); }
        if ($menuItem.attr("skip") != undefined) { filter.skip = $menuItem.attr("skip"); }
        if ($menuItem.attr("post_type") != undefined) { filter.post_type = $menuItem.attr("post_type"); }
        if ($menuItem.attr("per_page") != undefined) { filter.per_page = $menuItem.attr("per_page"); }


        //Clear the HTML and append posts
        $("#posts-container").html("");
        getPhotosAndAppend();

        //Change menu title to reflect filter
        $(".menu-title.browse-community").html($menuItem.html());

        loadMoreCheck();
    });

    //Loadmore button
    $("a.load-more").click(function(ev){
    	ev.preventDefault();

	    filter.skip = filter.skip + filter.per_page;
	    getPhotosAndAppend();
	
	    loadMoreCheck();
    });
    

/*
	var infiniteScroll = function(){
		 
		if($(window).scrollTop() >= $("a.load-more").offset().top - 500){
					
			filter.skip = filter.skip + filter.per_page;
			getPhotosAndAppend();
			
			loadMoreCheck();
			
			
		}		
	}	
	$(window).bind('scroll', infiniteScroll);	*/


	
    //CHeck to see if loadmore needs to be hidden
    function loadMoreCheck() {
        var url = "http://" + document.domain + "/community-api/posts/counts?skip="+filter.skip+"&per_page="+filter.per_page+"&order_by="+filter.order_by+"&sort="+filter.sort+"&master="+filter.master+"&post_type="+filter.post_type;


        $.getJSON(url,function(countData){


            var totalPostCount = countData[0].post_count;

            //console.log(totalPostCount,filter.skip);

            if (filter.skip + filter.per_page >= totalPostCount ) {
                $("a.load-more").hide();
            } else {
                $("a.load-more").show();
            }

        });
    }






 });