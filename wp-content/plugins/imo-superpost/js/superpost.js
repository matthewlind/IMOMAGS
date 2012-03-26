jQuery(document).ready(function($) {

$('.post-container').masonry({
                      itemSelector: '.superpost-box',
                      isAnimated: true,
                  });

   //Add a new post
  var caption;

  $(function() {      

    $('#fileUploadForm').ajaxForm({                 
      beforeSubmit: ShowRequest,
      success: SubmitSuccesful,
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

  function SubmitSuccesful(responseText, statusText) {     
    alert("SuccesMethod:\n\n" + responseText);

    var response = jQuery.parseJSON(responseText);
    console.log(response);

    addNewBox(response);


  }

  function addNewBox(response) {

    
    response.gravatar_hash = "http://www.gravatar.com/avatar/" + response.gravatar_hash + ".jpg?s=25&d=identicon";
    
    console.log(response);


    var cloneTarget = $("." + response.clone_target);
    var attachTarget = $("." + response.attach_target);
    var attachPoint = response.attachment_point;

    var clone = cloneTarget.clone();

    $.each(response, function(index,value){
      console.log(index + ":" + value);

      var targetElement = $(clone).find(index);

      if (targetElement.is("img")) {
        targetElement.attr("src",value);
      } else {
        targetElement.html(value);
      }


    });//end each

    console.log("CLONE:");
    console.log(clone);

    attachTarget.prepend(clone).imagesLoaded( function(){
          $(attachTarget).masonry("reload");
    });



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