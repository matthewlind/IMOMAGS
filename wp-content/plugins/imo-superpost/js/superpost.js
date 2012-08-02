jQuery(document).ready(function($) {

  //**************************
  //SHOW NEW POST MODAL
  //**************************
  $("#new-post-button").click(function(){
      $(".new-superpost-modal-container").modal({
        opacity: 50, 
        overlayClose: true,
        autoPosition: true,
        onShow: SetupPostForm
      });
  });

  //You can't add jQuery events to elements that don't exist.
  //As such, this function runs after the New Post modal appears
  function SetupPostForm() {
    //Setup State Dropdown with chosen
   $(".state-chzn").chosen();

    //Setup post type dropdown to show location when certain options are selected
    $("select.post_type").change(function(){
      if ($("select.post_type").val() == "report" || $("select.post_type").val() == "trophy") {

        if (($("select.post_type").val() == "report")) {
          $(".chzn-container span").text("Oh! Where are you reporting from?");
        }

        $(".state-dropdown-container").slideDown();
      }
    });


  }//End SetupPostFOrm

  //When image is selected, immediately upload it.
  $("input#image-upload").change(function(){
    $(this).closest('.superpost-image-form').submit();
  });


  //When a URL is pasted into video box, immediately submit
  $("input#video-body").bind("input",function(){

    if ($("input#video-body").val().length > 7) {
      //Then submit the form!
      console.log($(this).closest('.superpost-image-form'));
      console.log($("input#video-body").val());
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
    data:userIMO,
    error: AjaxError,
    dataType: 'json'                               
  });    

  //This is called before the new post form is sent.
  //It doesn't actually do anything but it's useful for debugging
  function ShowRequest(formData, jqForm, options) {
    var queryString = $.param(formData);
    //alert('BeforeSend method: \n\nAbout to submit: \n\n' + queryString);
    return true;
  }

  //Called when ajax fails. 
  function AjaxError() {
    alert("An AJAX error occured.");
  }

  //Called after form submission is successful
  function SubmitSuccessful(responseText, statusText) {     
    //alert("SuccesMethod:\n\n" + responseText);

    var response = responseText;

    var url = "/plus/" + response.post_type + "/" + response.id;


    window.location = url;
    //addNewBox(response);
  }

  //******************************
  //IMAGE ATTACHMENT AJAX REQUEST
  //******************************
  $('.superpost-image-form').ajaxForm({                 
    beforeSubmit: BeforeImageSubmit,
    success: ImageSubmitSuccessful,
    data:userIMO,
    dataType: 'json',
    error: AjaxError                               
  });

  function BeforeImageSubmit(formData, jqForm, options) {

    if (formData[1].value == "youtube") {
      $(".photo-attachement-header").text("Media");
    }
    
    $(".photo-attachement-header").fadeIn(1000);


    var $loadingTag = $("<div class='loading-box' style=''><img src='/wp-content/themes/imo-mags-northamericanwhitetail/img/loader.gif'></div>");
    //$(".attached-photos").append($loadingTag);

    $loadingTag.hide().appendTo(".attached-photos").slideDown(1000);


    return true;
  }

  function ImageSubmitSuccessful(responseText, statusText) {

    var response = responseText;

    //Make the new post post wider
    $(".new-superpost-modal-container").animate({
      width: "760px"
    }, 500 );

    //Also change width of media section so that it fits in the wider new post box
    $(".media-section").animate({
      width: "320px"
    }, 500 );


    //first, get the image element and the caption form
    var $imageTag = $("<div><img src='" + response.img_url + "' height=75 width=75 style='' class='image-thumb'>\
                      <form method='POST' action='/slim/api/superpost/update_caption' enctype='multipart/form-data' class='superpost-caption-form thumb-caption'>\
                      <input class='caption-field' name='body' type='text' placeholder='Caption (optional)'>\
                      <input type='hidden' name='form_id' value='fileUploadForm'>\
                      <input type='hidden' name='post_id' class='post_id' value='321'>\
                      </form>\
                      </a></div>");

    //Then Append the image & caption form
    $(".loading-box").fadeOut(function(){
      $(this).remove();
      $imageTag.hide().appendTo(".attached-photos").fadeIn();

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
      beforeSubmit: ShowRequest,
      success: CaptionSubmitSuccessful,
      data:userIMO,
      dataType: 'json',
      error: AjaxError                               
    });    

    //Then, add the change event to the caption field
    $imageTag.find('.caption-field').change(function(){
      $(this).closest('.superpost-caption-form').submit();
    });



    console.log("response Image YO!");
    console.log(response);

  }


  function CaptionSubmitSuccessful(responseText, statusText) {
    //alert("Yay! caption added!");
  }


  //**************************
  //COMMENT FORM AJAX REQUEST
  //**************************
  $('.superpost-comment-form').ajaxForm({                 
    beforeSubmit: ShowRequest,
    success: CommentSubmitSuccessful,
    data:userIMO,
    dataType: 'json',
    error: AjaxError                               
  });    
  //This is run after a comment is succesfully submitted
  //It can add a new box to the page
  function CommentSubmitSuccessful(responseText, statusText) {     
    //alert("SuccesMethod:\n\n" + responseText);

    var response = responseText;


    addNewBox(response);
  }


  function addNewBox(response) {

    if (response == null) {
      alert("You may not be logged in.");
    }

    response.gravatar_hash = "http://www.gravatar.com/avatar/" + response.gravatar_hash + ".jpg?s=25&d=identicon";
    


    var cloneTarget = $("." + response.clone_target).last();
    var attachTarget = $("." + response.attach_target);
    var attachPoint = response.attachment_point;

    var clone = cloneTarget.clone();


    //This loop should handle updating the clone in most situations
    $.each(response, function(index,value){
      //console.log(index + ":" + value);

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
      attachTarget.prepend(clone).imagesLoaded( function(){
          $(attachTarget).masonry("reload");

      });
    } else {
       attachTarget.prepend(clone);
    }
    
    //Clean up the form
    var form = $("#" + response.form_id);
    resetForm(form);

    //Finally show the new post
    clone.hide().slideDown();



  }



  //Clear the forms.
function resetForm($form) {
    $form.find('input:text, input:password, input:file, select').val('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
}





});//End document ready

