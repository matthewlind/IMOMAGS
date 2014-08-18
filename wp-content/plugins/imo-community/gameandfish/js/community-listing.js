jQuery(document).ready(function($) {


    //Set the filter to the default settings
    filter = {};
    filterReset();
    function filterReset() {
        filter.order_by = "created";
        filter.sort = "DESC";
        filter.master = 0;
        filter.state = "";
        filter.skip = 0;
        filter.post_type = "all";
        filter.secondary_post_type = "";
        filter.tertiary_post_type = "";
        filter.per_page=20;
        filter.post_count = 10000000;
    }

    //Highlight the default menu item
    $("ul.filter #filter-menu-default").addClass("active");


	//Place ads
	function adPlacement() {
			$("#posts-container .community-ad").remove();
			if ($(window).width() <  1096 ) {
				$('<div class="community-ad"><div class="image-banner"><iframe id="community-listing-ad" width=300 height=250 marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-community-ad.php?ad_code=imo.gameandfish"></iframe></div></div>')
				.insertAfter("#posts-container .dif-post:nth-child(5n)");
			}else{
				$('<div class="community-ad"><div class="image-banner"><iframe id="community-listing-ad" width=300 height=250 marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-community-ad.php?ad_code=imo.gameandfish"></iframe></div></div>')
				.insertAfter("#posts-container .dif-post:nth-child(9n)");
			}
	}

    if ($("#posts-container").attr("posttype").length > 0) {
        filter.post_type = $("#posts-container").attr("posttype");
    }
    if ($("#posts-container").attr("secondaryposttype").length > 0 && $("#posts-container").attr("secondaryposttype") != undefined) {

        filter.secondary_post_type = $("#posts-container").attr("secondaryposttype");
    }
    if ($("#posts-container").attr("tertiaryposttype").length > 0 && $("#posts-container").attr("secondaryposttype").length != undefined) {
        filter.tertiary_post_type = $("#posts-container").attr("tertiaryposttype");
    }

    //Get the JSON using the above filter configuration and append the photos.
    getPhotosAndAppend();

    loadMoreCheck();
    function getPhotosAndAppend() {
        var url = "http://" + document.domain + "/community-api/posts?skip="+filter.skip+"&per_page="+filter.per_page+"&order_by="+filter.order_by+"&sort="+filter.sort+"&master="+filter.master+"&post_type="+filter.post_type+"&secondary_post_type="+filter.secondary_post_type+"&tertiary_post_type="+filter.tertiary_post_type+"&state="+filter.state;

        $.getJSON(url,function(posts){

            $.each(posts,function(index,post){

                var postURL = "/photos/" +  post.tertiary_post_type  + "/" + post.secondary_post_type +  "/" + post.post_type  + "/" +  post.id;

                if (post.secondary_post_type == null || post.secondary_post_type == "null" || post.secondary_post_type.length < 1) {
                    postURL = "/photos/" +  post.tertiary_post_type  + "/" + post.post_type  + "/" +  post.id;
                }

                post.post_url = postURL;
				
				var termURL = "/photos/" +  post.tertiary_post_type  + "/" + post.secondary_post_type +  "/" + post.post_type;

                if (post.secondary_post_type == null || post.secondary_post_type == "null" || post.secondary_post_type.length < 1) {
                    termURL = "/photos/" +  post.tertiary_post_type  + "/" + post.post_type;
                }
				
				post.term_url = termURL;
				

                var postHTML = _.template( $('#post-template').html() , { post: post });
                $("#posts-container").append(postHTML);

				addthis.toolbox('.addthis_toolbox');

            });

			adPlacement();
            //hide the ajax loading spinner
            $("#ajax-loader").hide();


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
        if ($menuItem.attr("state") != undefined) { filter.state = $menuItem.attr("state"); }
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
        $('html, body').animate({
	        scrollTop: $(".general-com").offset().top
	    }, 'slow');

    });

    //Loadmore button
  $("a.load-more").click(function(ev){
		ev.preventDefault();

		filter.skip = filter.skip + filter.per_page;
		getPhotosAndAppend();

		loadMoreCheck();
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

    //Check to see if loadmore needs to be hidden
    function loadMoreCheck() {
    	$('.loading-gif').fadeIn();
        var url = "http://" + document.domain + "/community-api/posts/counts?skip="+filter.skip+"&per_page="+filter.per_page+"&order_by="+filter.order_by+"&sort="+filter.sort+"&master="+filter.master+"&post_type="+filter.post_type+"&secondary_post_type="+filter.secondary_post_type+"&tertiary_post_type="+filter.tertiary_post_type+"&state="+filter.state;


        $.getJSON(url,function(countData){


            var totalPostCount = countData[0].post_count;
			
            //console.log(totalPostCount,filter.skip);
            $('.loading-gif').fadeOut();
			if(totalPostCount == 0){
				$("#posts-container").append('<h3 class="no-result">No Photos</h3>');
			}
            if (filter.skip + filter.per_page >= totalPostCount ) {
                $("a.load-more").hide();
            } else {
                $("a.load-more").show();
            }

        });

    }






 });