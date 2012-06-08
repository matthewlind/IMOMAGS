/*
    jQuery `input` special event v1.1
 
http://whattheheadsaid.com/projects/input-special-event
 
    (c) 2010-2011 Andy Earnshaw
    MIT license
    www.opensource.org/licenses/mit-license.php
*/
(function($, udf) {
    var ns = ".inputEvent ",
        // A bunch of data strings that we use regularly
        dataBnd = "bound.inputEvent",
        dataVal = "value.inputEvent",
        dataDlg = "delegated.inputEvent",
        // Set up our list of events
        bindTo = [
            "input", "textInput", "propertychange", "paste", "cut", "keydown", "drop",
        ""].join(ns),
        // Events required for delegate, mostly for IE support
        dlgtTo = [ "focusin", "mouseover", "dragstart", "" ].join(ns),
        // Elements supporting text input, not including contentEditable
        supported = {TEXTAREA:udf, INPUT:udf},
        // Events that fire before input value is updated
        delay = { paste:udf, cut:udf, keydown:udf, drop:udf, textInput:udf };
 
    $.event.special.txtinput = {
        setup: function(data, namespaces, handler) {
            var triggerTimer,
                bndCount,
                changeTimer,
                // Get references to the element
                elem  = this,
                $elem = $(this),
                triggered = false;
 
            if (elem.tagName in supported) {
                bndCount = $.data(elem, dataBnd) || 0;
 
                if (!bndCount)
                    $elem.bind(bindTo, handler);
 
                $.data(elem, dataBnd, ++bndCount);
                $.data(elem, dataVal, elem.value);
            } else {
                $elem.bind(dlgtTo, function (e) {
                    var target = e.target;
                    if (target.tagName in supported && !$.data(elem, dataDlg)) {
                        bndCount = $.data(target, dataBnd) || 0;
 
                        if (!bndCount)
                            target.bind(bindTo, handler);
 
                        // make sure we increase the count only once for each bound ancestor
                        $.data(elem, dataDlg, true);
                        $.data(target, dataBnd, ++bndCount);
                        $.data(target, dataVal, target.value);
                    }
                });
            }
            function handler (e) {
                var elem = e.target;
 
                // Clear previous timers because we only need to know about 1 change
                window.clearTimeout(timer), timer = null;
 
                // Return if we've already triggered the event
                if (triggered)
                    return;
 
                // paste, cut, keydown and drop all fire before the value is updated
                if (e.type in delay && !timer) {
                    // ...so we need to delay them until after the event has fired
                    timer = window.setTimeout(function () {
                        if (elem.value !== $.data(elem, dataVal)) {
                            $(elem).trigger("txtinput");
                            $.data(elem, dataVal, elem.value);
                        }
                    }, 0);
                }
                else if (e.type == "propertychange") {
                    if (e.originalEvent.propertyName == "value") {
                        $(elem).trigger("txtinput");
                        $.data(elem, dataVal, elem.value);
                        triggered = true;
                        window.setTimeout(function () {
                            triggered = false;
                        }, 0);
                    }
                }
                else {
                    $(elem).trigger("txtinput");
                    $.data(elem, dataVal, elem.value);
                    triggered = true;
                    window.setTimeout(function () {
                        triggered = false;
                    }, 0);
                }
            }
        },
        teardown: function () {
            var elem = $(this);
            elem.unbind(dlgtTo);
            elem.find("input, textarea").andSelf().each(function () {
                bndCount = $.data(this, dataBnd, ($.data(this, dataBnd) || 1)-1);
 
                if (!bndCount)
                    elem.unbind(bindTo);
            });
        }
    };
 
    // Setup our jQuery shorthand method
    $.fn.input = function (handler) {
        return handler ? this.bind("txtinput", handler) : this.trigger("txtinput");
    }
})(jQuery);






jQuery(document).ready(function($) {

  function SetupPostForm() {
    $("input#image-upload").change(function(){
      $(this).closest('.superpost-image-form').submit();
    });


    // $("input#video-body").keydown(function(){
    //   if ($(this).val().length > 8) {
    //     alert("W00");
    //   }
      
    // });

    $("input#video-body").bind("input",function(){

        alert("W0asda0");

      
    });


  }

  function SubmitVideo() {
    $("input#video-body").closest('.superpost-image-form').submit();
  }

  
  $("#new-post-button").click(function(){
      $(".new-superpost-modal-container").modal({
        opacity: 50, 
        overlayClose: true,
        onShow: SetupPostForm
      });
  });

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


  //Show Video Form
  $(".video-button").click(function(){
    $(".video-url-form-holder-container").fadeIn();
  });

  $(".video-close-button").click(function(){
    $(".video-url-form-holder-container").fadeOut().stopPropagation();
  });
  



  $(function() {      

    $('.superpost-form').ajaxForm({                 
      beforeSubmit: ShowRequest,
      success: SubmitSuccessful,
      data:userIMO,
      error: AjaxError                               
    });    


    $('.superpost-comment-form').ajaxForm({                 
      beforeSubmit: ShowRequest,
      success: CommentSubmitSuccessful,
      data:userIMO,
      error: AjaxError                               
    });    

    $('.superpost-image-form').ajaxForm({                 
      beforeSubmit: BeforeImageSubmit,
      success: ImageSubmitSuccessful,
      data:userIMO,
      error: AjaxError                               
    });    

  });            

  

  function ShowRequest(formData, jqForm, options) {
    //var queryString = $.param(formData);
    //alert('BeforeSend method: \n\nAbout to submit: \n\n' + queryString);
    return true;
  }

  function AjaxError() {
    alert("An AJAX error occured.");
  }

  function SubmitSuccessful(responseText, statusText) {     
    //alert("SuccesMethod:\n\n" + responseText);

    var response = jQuery.parseJSON(responseText);

    var url = "/plus/" + response.post_type + "/" + response.id;


    window.location = url;
    //addNewBox(response);
  }

  function CommentSubmitSuccessful(responseText, statusText) {     
    //alert("SuccesMethod:\n\n" + responseText);

    var response = jQuery.parseJSON(responseText);


    addNewBox(response);
  }

  function BeforeImageSubmit(formData, jqForm, options) {
    
    $(".photo-attachement-header").fadeIn(1000);

    var $loadingTag = $("<div class='loading-box' style=''><img src='/wp-content/themes/imo-mags-northamericanwhitetail/img/loader.gif'></div>");
    //$(".attached-photos").append($loadingTag);

    $loadingTag.hide().appendTo(".attached-photos").slideDown(1000);


    return true;
  }

  function ImageSubmitSuccessful(responseText, statusText) {

    var response = jQuery.parseJSON(responseText);

    //first, get the image.
    var $imageTag = $("<div><img src='" + response.img_url + "' height=75 width=75 style=''></div>");

    //Then Append the image
    $(".loading-box").fadeOut(function(){
      //$(".attached-photos").append($imageTag.fadeIn());
      $(this).remove();
      $imageTag.hide().appendTo(".attached-photos").fadeIn();

    });
    

    //Then, add the image IDs to the new post form
    var attachmentIDs = $("input.attachment_id").val();
     if (attachmentIDs) {
      attachmentIDs = attachmentIDs + "," + response.id;
     } else {
      attachmentIDs = response.id;
     }
    $("input.attachment_id").val(attachmentIDs);


    console.log("response Image YO!");
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







  //Clear the forms.
  function resetForm($form) {
    $form.find('input:text, input:password, input:file, select').val('');
    $form.find('input:radio, input:checkbox')
         .removeAttr('checked').removeAttr('selected');
}

});//End document ready