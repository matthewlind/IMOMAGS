jQuery(document).ready(function(){


//*******************************************************
//****************** NEW COMMENT SUBMISSION ****************
//*******************************************************
    $("#comment-form").submit(function(){

		$("#comment-form .btn-submit").hide();
        $(".loading-gif").fadeIn();

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

            $(".loading-gif").fadeOut('fast');
            $("#comment-form .btn-submit").delay(700).fadeIn();

        });

        return false;

    });


//*******************************************************
//****************** COMMENT EDITOR TOOLS ****************
//*******************************************************
//Add editor tools for single posts
$(".editor-functions").change(function(){



    var etype = $(this).val();


    var postData = userIMO;

    postData.post_id = $(this).attr("spid");
    postData.etype = etype;

    if (etype == "edit") {

        var url = "/edit-your-post/?post_id=" + postData.post_id;
        window.location = url;

    } else if (etype == "delete") {

        $.ajax({
            url: '/community-api/posts/' + postData.post_id,
            type: 'DELETE',
            data: postData,
            success: function(data) {
                if (data.error) {
                    alert(data.error);
                } else {
                    alert("Delete done! Reload the page and it should be blank.");
                }
            }
        });

    } else if (etype == "contact") {

        window.location.href = "mailto:" + $(this).attr("email");

    } else {
        $.post("/slim/api/post/flagadmin", postData, function(data){

            if (data.error) {
                alert(data.error);
            } else {
                alert(etype + " done!");
            }
        });
    }



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