jQuery(document).ready(function($) {


    //Set the filter to the default settings
    filter = {};
    filterReset();
    function filterReset() {
        filter.order_by = "created";
        filter.sort = "DESC";
        filter.master = 0;
        filter.skip = 0;
        filter.post_type = "report";
        filter.per_page=20;
        filter.post_count = 10000000;

    }

    //Highlight the default menu item
    $("ul.filter #filter-menu-default").addClass("active");


	//Place ads
	function adPlacement() {
			$("#posts-container .community-ad").remove();
			if ($(window).width() <  1096 ) {
				$('<div class="community-ad"><div class="image-banner"><iframe id="community-listing-ad" width=300 height=250 marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-community-ad.php?ad_code=imo.in-fisherman"></iframe></div></div>')
				.insertAfter("#posts-container .dif-post:nth-child(5n)");
			}else{
				$('<div class="community-ad"><div class="image-banner"><iframe id="community-listing-ad" width=300 height=250 marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-community-ad.php?ad_code=imo.in-fisherman"></iframe></div></div>')
				.insertAfter("#posts-container .dif-post:nth-child(9n)");
			}
	}



    //Get the JSON using the above filter configuration and append the photos.
    getPhotosAndAppend();

    loadMoreCheck();
    function getPhotosAndAppend() {
        var url = "http://" + document.domain + "/community-api/posts?skip="+filter.skip+"&per_page="+filter.per_page+"&order_by="+filter.order_by+"&sort="+filter.sort+"&master="+filter.master+"&post_type="+filter.post_type;

        $.getJSON(url,function(posts){

            $.each(posts,function(index,post){

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
		window.location = $(this).attr("href");
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
        var url = "http://" + document.domain + "/community-api/posts/counts?skip="+filter.skip+"&per_page="+filter.per_page+"&order_by="+filter.order_by+"&sort="+filter.sort+"&master="+filter.master+"&post_type="+filter.post_type;

        $.getJSON(url,function(countData){


            var totalPostCount = countData[0].post_count;
			if(totalPostCount == 0){
				$("#posts-container").append('<h3 class="no-result">No Photos</h3>');
			}
            //console.log(totalPostCount,filter.skip);
			$('.loading-gif').fadeOut();
            if (filter.skip + filter.per_page >= totalPostCount ) {
                $("a.load-more").hide();
            } else {
                $("a.load-more").show();
            }

        });
        

    }






 });