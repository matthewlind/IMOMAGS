jQuery(document).ready(function($) {

	var url = "http://" + document.domain + "/community-api/posts?skip=0&per_page=21&order_by=created&sort=DESC";

	$.getJSON(url,function(posts){

		$.each(posts,function(index,post){

			var postHTML = _.template( $('#post-template').html() , { post: post });
			$("#posts-container").append(postHTML);

		});

	});
	
    $('.browse-panel').on("click", ".jq-open-filer", function(){
        $(".browse-item").removeClass("item-active");
        $(this).addClass("item-active");
        $(".browse-holder").addClass("browse-panel-opened");
        $(".filter-fade-out").addClass("filter-fade-in");
        $(".layout-frame").addClass("filter-popup-opened");
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });
    
    $('body').on("click", ".jq-filter", function(e){
        $(".browse-holder").addClass("browse-panel-opened");
        $(".filter-fade-out").addClass("filter-fade-in");
        $(".layout-frame").addClass("filter-popup-opened");
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });
    
    $('.browse-panel').on("click", ".jq-close-filter", function(e){
        $(".browse-item").removeClass("item-active");
        $(".browse-holder").removeClass("browse-panel-opened");
        $(".filter-fade-out").removeClass("filter-fade-in");
        $(".layout-frame").removeClass("filter-popup-opened");
        e.preventDefault();
    });
    
    $('.basic-popup').on("click", ".jq-close-popup", function(e){
        $(".basic-popup").removeClass("popup-opened");
        $(".filter-fade-out").removeClass("filter-fade-in");
        $(".layout-frame").removeClass("filter-popup-opened");
        e.preventDefault();
    });
    
    $('body').on("click", ".jq-open-reg-popup", function(e){
        $(".reg-popup").addClass("popup-opened");
        $(".filter-fade-out").addClass("filter-fade-in");
        $(".layout-frame").addClass("filter-popup-opened");
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });
    
 });