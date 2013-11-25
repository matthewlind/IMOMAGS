jQuery(document).ready(function(){


//*******************************************************
//****************** NEW COMMENT SUBMISSION ****************
//*******************************************************
    $("#comment-form").submit(function(){

        var formDataObject = $("#comment-form").formParams();
        var newPostData = $.extend(formDataObject,userIMO);

        $.post("http://" + document.domain + "/community-api/posts",newPostData,function(data){

            var postData = $.parseJSON(data);

			
			$("ul.replies-list").append('<li id="new-comment"></li>');
			$("ul.replies-list li#new-comment").hide().append('<div class="profile-photo"><a href="/profile/' + postData.username + '"><img src="/avatar?uid=' + postData.user_id + '" alt="' + postData.display_name + '"></a></div><div class="reply-text"><h3><a href="/profile/' + postData.username + '">' + postData.display_name + '</a></h3><p>' + postData.body + '</p></div></li>').fadeIn("slow");
			
			$('html, body').animate({
				scrollTop: $("#new-comment").offset().top
			});
			$("#new-comment").removeAttr("id");
			$("#comment-form textarea").val("");
            
        });

        return false;

    });


//*************************************************
//***********Animate interface Elements************
//*************************************************

    $('.basic-popup').on("click", ".jq-close-popup .filter-fade-in", function(e){
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

    $('body').on("click", ".jq-open-cat-popup", function(){
        $(".cat-popup").addClass("popup-opened");
        $(".filter-fade-out").addClass("filter-fade-in");
        $(".layout-frame").addClass("filter-popup-opened");
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });

    $('body').on("click", ".jq-open-state-popup", function(){
        $(".state-popup").addClass("popup-opened");
        $(".filter-fade-out").addClass("filter-fade-in");
        $(".layout-frame").addClass("filter-popup-opened");
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });

   /* $('body').on("click", ".jq-open-reply-slide", function(){
        $(".post-reply-slide").addClass("slide-opened");
       // $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });*/

    $('body').on("click", ".jq-open-login-popup", function(){
        $(".login-popup").addClass("popup-opened");
        $(".filter-fade-out").addClass("filter-fade-in");
        $(".layout-frame").addClass("filter-popup-opened");
        $('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });

    $('.jq-custom-form select').zfselect({
        rows:6
    });


});