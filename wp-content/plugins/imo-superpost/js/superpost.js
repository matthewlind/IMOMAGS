jQuery(document).ready(function($) {

 //**************************
  //Set the state on new post forms.


  if (userIMO.default_state)
  	$('option[value="' + userIMO.default_state + '"]').attr("selected","selected");;
  //**************************


  //**************************
  //EDIT POSTS for community-post-edit.php
  //**************************

  //Populate form:

  //First get post id
  if ($('.superpost-edit-form').length > 0) {//Do stuff only if the edit for is on the page.
	  var postID = $(".superpost-edit-form .post_id").val();

	  //First get the post data,
	  $.getJSON('/slim/api/superpost/post_only/' + postID, function(data) {

	  	  var postData = data[0];

	  	  $('#superpostEditForm #edit-state option').removeAttr("selected");
	  	  $('#superpostEditForm option[value="' + postData.state + '"]').attr("selected","selected");
	  	  $('#superpostEditForm #edit-state').trigger("liszt:updated");


		  $.each(postData,function(index,value){


			  var selector = '#superpostEditForm [name="' + index + '"]';



			  $(selector).val(value);


		  });

		  console.log(postData);

		  if (postData.post_type == "comment") {
		  	  $("#superpostEditForm #title").remove();
			  $("#superpostEditForm .modal_post_type").remove();
			  $("#superpostEditForm .state-dropdown-container").remove();
		  }

	  });

	  //Then get the attachment data
	  //http://$hostname/slim/api/superpost/children/not_comment/$spid

	  $.getJSON('/slim/api/superpost/children/not_comment/' + postID, function(data) {


    	  var attachmentData = data;
    	  var attachmentIDs;


    	  $.each(attachmentData,function(index,attachment){



            //Then, add the image IDs to the new post form
            //Without this step, the images will not be attached to the post

             if (attachmentIDs) {
              attachmentIDs = attachmentIDs + "," + attachment.id;
             } else {
              attachmentIDs = attachment.id;
             }
            $("input.attachment_id").val(attachmentIDs);



            var $imageTag = $("<div><a href='" + attachment.img_url + "' class='thickbox'><img src='" + attachment.img_url + "' height=75 width=75 style='' class='image-thumb'></a>\
                              <a href='#' class='image-delete-button'>&nbsp;asfg</a>\
                              <form method='POST' action='/slim/api/superpost/update_caption' enctype='multipart/form-data' class='superpost-caption-form thumb-caption'>\
                              <input class='caption-field' name='body' type='text' placeholder='Caption (optional)'>\
                              <input type='hidden' name='form_id' value='fileUploadForm'>\
                              <input type='hidden' name='post_id' class='post_id' value='321'>\
                              </form>\
                              </a></div>");


            $imageTag.hide().delay(20).appendTo(".attached-photos").fadeIn();

             //Then change the value of the caption's post_id hidden field
            $imageTag.find('.post_id').val(attachment.id);

            //set the caption field value
            $imageTag.find('.caption-field').val(attachment.body);

            //Add the ajax form event to the caption form
            $imageTag.find('.superpost-caption-form').ajaxForm({
              beforeSubmit: ShowEditBody,
              success: CaptionSubmitSuccessful,
              dataType: 'json',
              error: AjaxError
            });

            //Add the remove image event
            $imageTag.find('.image-delete-button').click(function(event){
                 event.preventDefault();
                $(this).closest("div").fadeOut().remove();

                var attachmentIDstring = $("input.attachment_id").val();
                var attachmentIDarray = attachmentIDstring.split(",");

                remove(attachmentIDarray,$(this).closest("div").find('.post_id').val());



                var newAttachmentIDstring;

                $.each(attachmentIDarray,function(index,attachmentID){
                    if (newAttachmentIDstring) {
                          newAttachmentIDstring = newAttachmentIDstring + "," + attachmentID;
                         } else {
                          newAttachmentIDstring = attachmentID;
                         }
                });

                $("input.attachment_id").val(newAttachmentIDstring);

             });


            //Then, add the change event to the caption field
            $imageTag.find('.caption-field').change(function(){
              $(this).closest('.superpost-caption-form').submit();
            });


		  });

	  });


	  //Ajax Form Submission
	  $('.superpost-edit-form').ajaxForm({
	    beforeSubmit: EditShowRequest,
	    success: EditSubmitSuccessful,
	    error: AjaxError,
	    dataType: 'json'
	  });
  }


function remove(arr, what) {
    var found = arr.indexOf(what);

    while (found !== -1) {
        arr.splice(found, 1);
        found = arr.indexOf(what);
    }
}

function ShowEditBody(formData, jqForm, options){



      	//Add the userdata so that we can authenticate
  	options.extraData = $.extend(true, {}, options.extraData, userIMO);



}

//Called after form submission is successful
function EditSubmitSuccessful(responseText, statusText) {

	var response = responseText;


    if (response.post_type == "comment") {
	    alert("COMMENT EDIT SUCCESSFUL! Keep in mind that it may take 10 minutes before the change is live on the site.");

    } else {
	    var url = "/community/post/" + response.post_id;
	    window.location = url;

    }








}

function EditShowRequest(formData, jqForm, options) {

	//////console.log(  $(userIMO) );


  	//Add the userdata so that we can authenticate
  	options.extraData = $.extend(true, {}, options.extraData, userIMO);


    var queryString = $.param(formData);
    //alert('BeforeSend method: \n\nAbout to submit: \n\n' + queryString);



}

  //**************************
  //SHOW NEW POST MODAL
  //**************************
  $("#new-post-button").click(function(){
      $(".new-superpost-box").modal({
        opacity: 50,
        overlayClose: true,
        autoPosition: true,
        onShow: SetupPostForm
      });
  });
	// set default option when clicking on a specific post type.
	$('.new-post.question').click(function(){
		$(".new-superpost-box").modal({
	    opacity: 50,
	    overlayClose: true,
	    autoPosition: true,
	    onShow: SetupPostForm
	    });

		$("#body").css("display","none");
		$("#title").attr("placeholder","Your Question");
		$(".modal_post_type .question").attr("selected","selected");
	});
	$('.new-post.trophy').click(function(){
		$(".new-superpost-box").modal({
		opacity: 50,
		overlayClose: true,
		autoPosition: true,
		onShow: SetupPostForm
		});

		$(".modal_post_type .trophy").attr("selected","selected");
		$(".chzn-container span").text("Oh! Where are you reporting from?");
		$(".state-dropdown-container").slideDown();
		$(".simplemodal-container").animate({height: "630px"});
	});

	$('.new-post.report').click(function(){
		$(".new-superpost-box").modal({
		opacity: 50,
		overlayClose: true,
		autoPosition: true,
		onShow: SetupPostForm
		});

		$(".modal_post_type .report").attr("selected","selected");
		$(".chzn-container span").text("Oh! Where are you reporting from?");
		$(".state-dropdown-container").slideDown();
		$(".simplemodal-container").animate({height: "630px"});
	});

	$('.new-post.lifestyle').click(function(){
		$(".new-superpost-box").modal({
		opacity: 50,
		overlayClose: true,
		autoPosition: true,
		onShow: SetupPostForm
		});

		$(".modal_post_type .lifestyle").attr("selected","selected");
	});

	$('.new-post.tip').click(function(){
		$(".new-superpost-box").modal({
		opacity: 50,
		overlayClose: true,
		autoPosition: true,
		onShow: SetupPostForm
		});

		$(".modal_post_type .tip").attr("selected","selected");
	});

	$('.new-post.general').click(function(){
		$(".new-superpost-box").modal({
		opacity: 50,
		overlayClose: true,
		autoPosition: true,
		onShow: SetupPostForm
		});

		$(".modal_post_type .general").attr("selected","selected");
	});




  //You can't add jQuery events to elements that don't exist.
  //As such, this function runs after the New Post modal appears
  function SetupPostForm() {

    //Setup State Dropdown with chosen
   $(".state-chzn").chosen();
   $(".simplemodal-container").css({width:"590px",height: "410px"});
    //Setup post type dropdown to show location when certain options are selected
    $(".modal_post_type").change(function(){
    	//if post is a question, hide the textarea
  	if ($(".modal_post_type").val() == "question") {
	    	$("#simplemodal-container #fileUploadForm textarea#body").css("display","none");
	    	$("#simplemodal-container #title").attr("placeholder","Ask the Community");
	    	$("#simplemodal-container").animate({height: "290px"});
	    	$('#simplemodal-container #fileUploadForm').css("height","78px");
	    	$('#simplemodal-container #simplemodal-container .media-section').css("padding-top","0px");
        	$('#simplemodal-container input.submit').css("margin-top","-160px");
        	$('#simplemodal-container .fast-login-then-post-button').css("top","60px");
        	$('#simplemodal-container .new-superpost-modal-container').css("padding-bottom","6px");
	}else{
			$("#simplemodal-container #fileUploadForm textarea#body").css("display","block");
			$("#simplemodal-container #title").attr("placeholder","Title");
			$("#simplemodal-container").animate({height: "410px"});
			$('#simplemodal-container #fileUploadForm').css("height","178px");
			$('#simplemodal-container .media-section').css("padding-top","30px");
			$('#simplemodal-container input.submit').css('margin-top','-31px');
			$('#simplemodal-container .fast-login-then-post-button').css("top","50px");
			$('#simplemodal-container .new-superpost-modal-container').css("padding-bottom","20px");
	}

      if ($(".modal_post_type").val() == "report" || $(".modal_post_type").val() == "trophy") {

        	$("#simplemodal-container .state-dropdown-container").slideDown();
        	$("#simplemodal-container").animate({height: "450px"});
        	$('#simplemodal-container .media-section').css("padding-top","70px");
        	$('#simplemodal-container .fast-login-then-post-button').css("top","50px");
        	$('#simplemodal-container input.submit').css("margin-top","11px");
     }else{
      //hide when not neccesary
	      $("#simplemodal-container .state-dropdown-container").slideUp();
	      $('#simplemodal-container .media-section').css("padding-top","30px");
	      $('#simplemodal-container input.submit').css("margin-top","37px");
	      //$('#simplemodal-container .fast-login-then-post-button').css("top","60px");
	      //$('#simplemodal-container .fast-login-then-post-button').css("top","26px");
	     // $('.media-section').css("margin-top","7px");
	      //$(".simplemodal-container").animate({height: "420px"});
      }

      ////console.log($(".post_type").val());
    });


  }//End SetupPostFOrm





  //When image is selected, immediately upload it.
  $("input#image-upload").change(function(){
    $(this).closest('.superpost-image-form').submit();
  });


  //When a URL is pasted into video box, immediately submit
  $("input#video-body").bind("input",function(){

  	var $videoBody = this;

    if ($("input#video-body").val().length > 7) {
      //Then submit the form!
      ////console.log($(this).closest('.superpost-image-form'));
      ////console.log($("input#video-body").val());
      $(this).closest('.superpost-image-form').submit();


      $(".video-url-form-holder-container").fadeOut(function(){
        $("input#video-body").val("");
      });
    }

  });



      // $(".new-superpost-modal-container").modal({
      //   opacity: 50,
      //   overlayClose: true,
      //   onShow: SetupPostForm
      // });

  //Activate masonry on container that holds superposts
  $('.masonry-container').masonry({
      itemSelector: '.superpost-box',
      isAnimated: true,
  });

   //Add a new post
  var caption;


  //Show Video Form
  $(".video-button").click(function(){
    $(".video-url-form-holder-container").fadeIn();
  });
  //Hide Video Form
  $(".video-close-button").click(function(){
    $(".video-url-form-holder-container").fadeOut();
  });




  //**************************
  //NEW POST FORM AJAX REQUEST
  //**************************
  $('.superpost-form').ajaxForm({
    beforeSubmit: ShowRequest,
    success: SubmitSuccessful,
    error: AjaxError,
    dataType: 'json'
  });

  //This is called before the new post form is sent.
  //It doesn't actually do anything but it's useful for debugging
  function ShowRequest(formData, jqForm, options) {

	//////console.log(  $(userIMO) );


  	//Add the userdata so that we can authenticate
  	options.extraData = $.extend(true, {}, options.extraData, userIMO);


    var queryString = $.param(formData);
    //alert('BeforeSend method: \n\nAbout to submit: \n\n' + queryString);

    if($("#fileUploadForm #title").val().length == 0){
    	alert("Please Enter a Title");
	    return false;
    }else{
	   return true;
    }


  }

  //Called when ajax fails.
  function AjaxError() {
    alert("An AJAX error occured.");
  }

  //Called after form submission is successful
  function SubmitSuccessful(responseText, statusText) {
    //alert("SuccesMethod:\n\n" + responseText);

    var response = responseText;

    var url = "/plus/" + response.post_type + "/" + response.id + "#share";


    window.location = url;

    $('.superpost-form').clearForm();
    //addNewBox(response);
  }

  //******************************
  //IMAGE ATTACHMENT AJAX REQUEST
  //******************************
  $('.superpost-image-form').ajaxForm({
    beforeSubmit: BeforeImageSubmit,
    success: ImageSubmitSuccessful,
    dataType: 'json',
    error: AjaxError,
    beforeSerialize: function($form, options) {
    	////console.log("BEFORE SERIALIZE:",$form,options);
    }
  });

  function BeforeImageSubmit(formData, jqForm, options) {

  ////console.log("MEDIA SUBMIT DATA: ",formData,jqForm);

    if (formData[1].value == "youtube") {
      $(".photo-attachement-header").text("Media");
      options.extraData = $.extend(true, {}, options.extraData, {"video_url":formData[0].value});
    }

    $(".photo-attachement-header").fadeIn(1000);
    $('input.submit').css('top','+=90');
    $('.email-login').css('top','+=90');
    $('.choose-fb').css('top','+=90');
    $('.col-abc.super-post .entry-content').css('margin-top','+=90');

    var $loadingTag = $("<div class='loading-box' style=''><img src='/wp-content/themes/imo-mags-northamericanwhitetail/img/loader.gif'></div>");
    //$(".attached-photos").append($loadingTag);

    $loadingTag.hide().appendTo(".attached-photos").slideDown(1000);

    //create more height on community page forms for additions

   var newHeight = '';

    //Add the userdata so that we can authenticate
  	options.extraData = $.extend(true, {}, options.extraData, userIMO);

    return true;
  }

  function ImageSubmitSuccessful(responseText, statusText) {

    var response = responseText;

    ////console.log(response);

    //first, get the image element and the caption form
    var $imageTag = $("<div><a href='" + response.img_url + "' class='thickbox'><img src='" + response.img_url + "' height=75 width=75 style='' class='image-thumb'></a>\
                      <form method='POST' action='/slim/api/superpost/update_caption' enctype='multipart/form-data' class='superpost-caption-form thumb-caption'>\
                      <input class='caption-field' name='body' type='text' placeholder='Caption (optional)'>\
                      <input type='hidden' name='form_id' value='fileUploadForm'>\
                      <input type='hidden' name='post_id' class='post_id' value='321'>\
                      </form>\
                      </a></div>");

    //If this is a comment, don't show the caption form
    //and don't show the animations
    if (response.source_form == "comment") {
	    $imageTag.find("form.thumb-caption").remove();
    } else {
	    $('.simplemodal-container').css('height','+=90');
	}


    //Then Append the image & caption form
    $(".loading-box").fadeOut(function(){
      $(this).hide(1,function(){
	      $imageTag.hide().delay(530).appendTo(".attached-photos").fadeIn();
      });


    });


    //Then, add the image IDs to the new post form
    //Without this step, the images will not be attached to the post
    var attachmentIDs = $("input.attachment_id").val();
     if (attachmentIDs) {
      attachmentIDs = attachmentIDs + "," + response.id;
     } else {
      attachmentIDs = response.id;
     }
    $("input.attachment_id").val(attachmentIDs);

    //Then change the value of the caption's post_id hidden field
    $imageTag.find('.post_id').val(response.id);

    //Add the ajax form event to the caption form
    $imageTag.find('.superpost-caption-form').ajaxForm({
      beforeSubmit: CaptionShowRequest,
      success: CaptionSubmitSuccessful,
      dataType: 'json',
      error: AjaxError
    });

    //Then, add the change event to the caption field
    $imageTag.find('.caption-field').change(function(){
      $(this).closest('.superpost-caption-form').submit();
    });





    ////console.log("response Image YO!");
    ////console.log(response);

  }

    function CaptionShowRequest(formData, jqForm, options) {

	//////console.log(  $(userIMO) );


  	//Add the userdata so that we can authenticate
  	options.extraData = $.extend(true, {}, options.extraData, userIMO);


    var queryString = $.param(formData);
    //alert('BeforeSend method: \n\nAbout to submit: \n\n' + queryString);



  }


  function CaptionSubmitSuccessful(responseText, statusText) {
    //alert("Yay! caption added!");
  }


  //**************************
  //COMMENT FORM AJAX REQUEST
  //**************************
  $('.superpost-comment-form').ajaxForm({
    beforeSubmit: CommentShowRequest,
    success: CommentSubmitSuccessful,
    dataType: 'json',
    error: AjaxError
  });
  //This is run after a comment is succesfully submitted
  //It can add a new box to the page
  function CommentSubmitSuccessful(responseText, statusText) {
    //alert("SuccesMethod:\n\n" + responseText);

    var response = responseText;

    $('.superpost-comment-form').clearForm();

	    addNewBox(response);
  }


  function addNewBox(response) {
    if (response == null) {
      //alert("You may not be logged in.");
    }

    response.gravatar_hash = "/avatar?uid=" + response.user_id;

    if (response.img_url) {
	    response.body = response.body + "<p>[Reload page to see your images]</p>"
    }


    var cloneTarget = $("." + response.clone_target).last();
    var attachTarget = $("." + response.attach_target);
    var attachPoint = response.attachment_point;

    var clone = cloneTarget.clone();


    //This loop should handle updating the clone in most situations
    $.each(response, function(index,value){
     // console.log(index + ":" + value);

      var targetElement = $(clone).find(".superclass-" + index);

      if (targetElement.is("img")) {
        targetElement.attr("src",value);
      } else {
        targetElement.html(value);
      }



    });//end each

    //Hide images that don't exist:
    var imgElement = $(clone).find(".superclass-img_url");
    if (typeof response.img_url === "undefined") {
      imgElement.hide();
    } else {
      imgElement.show();
    }


    //For clone elements with a ID in a url:
    if ($(clone).find(".superclass-id_url").length > 0 ) {
      var idLinks = $(clone).find(".superclass-id_url");
      if (typeof idLinks != 'undefined') {
        var oldURL = idLinks.first().attr("href");
        var newURL = oldURL.replace(/\d*$/, '') + response.id;
        idLinks.attr("href",newURL);
      }


    }


    //alert(response.masonry);

    //Attach the clone!
    if (response.masonry == true || response.masonry == "true") {
      attachTarget.append(clone).imagesLoaded( function(){
          $(attachTarget).masonry("reload");

      });
    } else {
       attachTarget.append(clone);
    }

    //Clean up the form
    var form = $("#" + response.form_id);
    resetForm(form);

    //Finally show the new post
    clone.hide().slideDown();



  }



  function CommentShowRequest(formData, jqForm, options) {

	//////console.log(  $(userIMO) );


  	//Add the userdata so that we can authenticate
  	options.extraData = $.extend(true, {}, options.extraData, userIMO);


    var queryString = $.param(formData);
    //alert('BeforeSend method: \n\nAbout to submit: \n\n' + queryString);




  }


  //Clear the forms.
function resetForm($form) {
    $form.find('input:text, input:password, input:file, select').val('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
}





});//End document ready
