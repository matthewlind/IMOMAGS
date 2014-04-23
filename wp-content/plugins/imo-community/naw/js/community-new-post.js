jQuery(document).ready(function($) {

	
	//Get post_type from community config
	var postTypes = IMO_COMMUNITY_CONFIG.post_types;

	postAttachments = [];
	postData = [];

	postData.master = 0;

	//*******************************************************
	//****************** DISPLAY THE FORM *******************
	//*******************************************************
	var questionPost = window.location.href.indexOf("question") > -1;
	
	var formTemplate = _.template( $("#new-post-template").html() , { post:null, post_types:postTypes, species:masterAnglerData } );//Use the post types from the configuration
	$("#form-container").append(formTemplate);
	
	if(questionPost){
		$("#ma-species").hide();
		$("#ma-species").html("");
		$("#ma-species").prepend('<option value="question">Question</option>');
		$("#post-photo").val("Ask Your Question");
	}
	
	//If user is logged in, hide the FB login button
	if (userIMO.username.length > 0) {
		$(".imo-community-new-post.btn-fb-login").hide();
	}
	
	//*******************************************************
	//*********** ACTIVATE FB LOGIN IN THE FORM *************
	//*******************************************************
	$(".imo-fb-login-button, .fast-login-then-post-button, .join-widget-fb-login").click(function(){

		var $clickedButton = $(this);

		$(".imo-fb-login-button").css({ opacity: 0.5 });
		$(".join-widget-fb-login").css({ opacity: 0.5 });
		//$(".fast-login-then-post-button").css({ opacity: 0.5 });

			FB.login(function(response) {
			   if (response.authResponse) {

			   	if ($clickedButton.hasClass("fast-login-then-post-button")) {
			   		$("img.submit-icon").attr("src","/wp-content/themes/imo-mags-northamericanwhitetail/img/submit-throbber.gif");
			   	}

			     //console.log('Welcome!  Fetching your information.... ');
			     FB.api('/me', function(response) {
			       //console.log('FB FETCH INFO RESPONSE: ' + response.name + '.');

			       	if (userIMO.username.length > 0) {//If user is logged in


					  } else { //if user is not logged in

					  	  //$(".user-login-modal-container").modal.close();

					  	  //$.modal.close();


						  jQuery.getJSON('/facebook-usercheck.json', function(data){
							  authSuccess(data,$clickedButton);
						  });

					  }//End if user is logged in

			     });
			   } else {
			     //console.log('User cancelled login or did not fully authorize.');
			   }
			 }, {scope: 'email,user_hometown'});

	});

	//*******************************************************
	//********  CHECK FOR IMAGE FROM PREVIOUS PAGE  *********
	//*******************************************************
	if (window.location.hash) {
		var hashValue = window.location.hash.substring(1);

		if (hashValue == "master") {
			$(".master-angler-form-container").slideDown();
		} else {
			var imageID = window.location.hash.substring(1);
			var imgURL = "https://www.filepicker.io/api/file/" + imageID ;

			var newAttachment = {};

			newAttachment.img_url = imgURL;

			//get template for attachment
	        var attachmentTemplate = _.template( $("#single-attachment-template").html() , {attachment: newAttachment} );
	        var $attachmentTemplate = $(attachmentTemplate);


	        //display attachment
	        $attachmentTemplate.hide().appendTo("#attachments").slideDown();
			
	        //hide the attach photo button
	        $(".photo-link-area").slideUp();

	        //Track the data
	        postData.img_url = imgURL;

	        //add event to edit caption on change
	        $attachmentTemplate.find(".caption-field").change(function(ev){
	        	var caption = ev.currentTarget.value;
	        	postData.body = caption;
	        });

	        //Add Event to Delete Attachment
	        $attachmentTemplate.find(".delete-attachment").click(function(ev){

	        	ev.preventDefault();

	        	$(".photo-link-area").slideDown();


	        	$attachmentTemplate.slideUp();

	        });
		}


	}
	//*******************************************************
	//*********** ATTACH MORE EVENTS TO FORM ****************
	//*******************************************************
	$(".no-thanks").click(function(ev){


		ev.preventDefault();

		$(".enter-master-angler").slideUp();
		$(".master-angler-form-container").slideUp();
	});

	//*******************************************************
	//****************** NEW POST SUBMISSION ****************
	//*******************************************************
	$("#new-post-form").submit(function(ev){

		ev.preventDefault();

		var formDataObject = $("#new-post-form").formParams();
		var newPostData = $.extend(formDataObject,userIMO,postData);

		newPostData.attachments = postAttachments;

		//Validate form data and submit
		if (validateFormData(newPostData)) {
			$('.btn-submit').fadeOut();
			$('.loading-gif').fadeIn();
			
			$.post("http://" + document.domain + "/community-api/posts",newPostData,function(data){

				var postData = $.parseJSON(data);


				//alert("New Post Added! Replace this alert with a redirect to something!")

				if (postData)
					window.location.href = "/community/post/" + postData.id;
				else
					alert("Could not post photo. Are you logged in?");
			});
		}


		return false;

	});

	//*******************************************************
	//************* FORM VALIDATION *****************
	//*******************************************************
	function validateFormData(formData) {

		if(formData.post_type == "question" || questionPost){
			formData.img_url = "";
			if (formData.title.length < 1) {
				alert("Please give this post a title.");
				return false;
			}else if (formData.state.length < 1) {
				alert("Please Choose a state.");
				return false;
			} else if (userIMO.username.length < 1) {
				alert("Please login before you post.");
				return false;
			} else {
				return true;
			}
		}else{
			//Check form fields
			if (formData.title.length < 1) {
				alert("Please give this post a title.");
				return false;
			} else if(formData.img_url.length < 1) {
				alert("Please attach a photo.");
				return false;
			} else if (formData.state.length < 1) {
				alert("Please Choose a state.");
				return false;
			} else if (userIMO.username.length < 1) {
				alert("Please login before you post.");
				return false;
			} else {
				return true;
			}
		}

	}

	//*******************************************************
	//****************** UPLOAD IMAGES **********************
	//*******************************************************
	$("#new-post-form #image-upload").change(function(ev){//After the user selects a file

		var fileInput = ev.currentTarget;

		if (!fileInput.value) {
			//If they don't select anything... Do nothing
		    //console.log("Choose an Image to upload.");
		} else {

			$('.loading-gif').fadeIn();

			filepicker.setKey('ANCtGPesfQI6nKja0ipqBz');

		    filepicker.store(fileInput, function(FPFile){//Begin the upload


		    		//If upload is good:
		            //console.log("Store successful:", FPFile);

		            //Create the attachment data


		            //Check if post is image
		            if (FPFile.mimetype.indexOf("image") != -1) {

			            var newAttachment = {};
			            newAttachment.img_url = FPFile.url;
			            newAttachment.post_type = "photo";


			            //get template for attachment
			            var attachmentTemplate = _.template( $("#single-attachment-template").html() , {attachment: newAttachment} );
			            var $attachmentTemplate = $(attachmentTemplate);


			            //display attachment
			            $attachmentTemplate.hide().appendTo("#attachments").slideDown();
						$(".title-input").slideDown();
						
			            //add event to edit caption on change
			            $attachmentTemplate.find(".caption-field").change(function(ev){
			            	var caption = ev.currentTarget.value;
			            	postData.body = caption;
			            });

			            //Add Event to Delete Attachment
			            $attachmentTemplate.find(".delete-attachment").click(function(ev){

			            	ev.preventDefault();

			            	$(".add-photo-link").slideDown();


			            	$attachmentTemplate.slideUp();

			            });

			            //Hide Attachment Button
			            $(".add-photo-link").slideUp();

			            //postAttachments.push(newAttachment);//add the attachments to the list
			            postData.img_url = FPFile.url;
						$('.loading-gif').fadeOut();


		            } else {
		            	alert("Only images can be posted. Other file types are not allowed.");
		            	$('.loading-gif').fadeOut();
		            }


		        }, function(FPError) {
		            //console.log(FPError.toString());
		        }, function(progress) {
		        	//upload progress
		            //console.log("Loading: "+progress+"%");//PROGRESS INDICATOR!!!!!

		            //progress bar
		            $('#progressBar div').css("width",progress*3 + "px");
		            $('#progressBar span').text("Uploading: "+progress+"%");

		        }
		   );

		}
	});
		
});


