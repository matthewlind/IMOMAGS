jQuery(document).ready(function($) {

  function SetupPostForm() {
    $("input#image-upload").change(function(){
      
    });
  }

  $(".new-superpost-modal-container").modal({
    opacity: 50, 
    overlayClose: true,
    onShow: SetupPostForm
  });


  $('.masonry-container').masonry({
      itemSelector: '.superpost-box',
      isAnimated: true,
  });

   //Add a new post
  var caption;

  $(function() {      

    $('.superpost-form').ajaxForm({                 
      beforeSubmit: ShowRequest,
      success: SubmitSuccesful,
      data:userIMO,
      error: AjaxError                               
    });    

    $('.superpost-image-form').ajaxForm({                 
      beforeSubmit: ShowRequest,
      success: SubmitSuccessful,
      data:userIMO,
      error: AjaxError                               
    });    

  });            

  

  function ShowRequest(formData, jqForm, options) {
    var queryString = $.param(formData);
    alert('BeforeSend method: \n\nAbout to submit: \n\n' + queryString);
    return true;
  }

  function AjaxError() {
    alert("An AJAX error occured.");
  }

  function SubmitSuccessful(responseText, statusText) {     
    //alert("SuccesMethod:\n\n" + responseText);

    var response = jQuery.parseJSON(responseText);

    console.log("response YO!");
    console.log(response);

    addNewBox(response);
  }


  function ImageSubmitSuccessful(responseText, statusText) {

    var response = jQuery.parseJSON(responseText);

    console.log("response YO!");
    console.log(response);

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


  //Show username
  $(".welcome-header").text("Welcome to Recon Network, " + userIMO.username);


  //Clear the forms.
  function resetForm($form) {
    $form.find('input:text, input:password, input:file, select').val('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
}

});//End document ready