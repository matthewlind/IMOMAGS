jQuery(document).ready(function($) {

	//jQuery('.loading-gif').removeClass('loading-gif');

	//Get post_type from community config
	var postTypes = IMO_COMMUNITY_CONFIG.post_types;

	postAttachments = [];
	postData = [];

	postData.master = 1;

	//*******************************************************
	//****************** DISPLAY THE FORM *******************
	//*******************************************************

	var formTemplate = _.template( $("#new-post-template").html() , { post:null, post_types:postTypes, species:speciesDataList } );//Use the post types from the configuration
	$("#form-container").append(formTemplate);

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


	if (typeof userState !== 'undefined') {

		if (userState != null) {

			$("select#ma-state").val(userState);
		}

  	}

	//*******************************************************
	//****************** NEW POST SUBMISSION ****************
	//*******************************************************
	$("#new-post-form").submit(function(ev){
		ev.preventDefault();

		var formDataObject = $("#new-post-form").formParams();
		var newPostData = $.extend(formDataObject,userIMO,postData);


		newPostData.attachments = postAttachments;

		//console.log(newPostData);

		// console.log(newPostData);
		// console.log(speciesData);








		//Validate form data and submit
		if (validateFormData(newPostData)) {
			$('.btn-submit').fadeOut();
			$('.loading-gif').fadeIn();



			if (newPostData.post_type_hunting.length > 0) {
				newPostData.post_type = newPostData.post_type_hunting;
			}
			if (newPostData.post_type_fishing.length > 0) {
				newPostData.post_type = newPostData.post_type_fishing;
			}


			newPostData.state_address = newPostData.state;



			newPostData.secondary_post_type = speciesData[newPostData.post_type].secondary;
			newPostData.tertiary_post_type = speciesData[newPostData.post_type].tertiary;


						var newBody = "<p>"+ newPostData.body + "</p>"
									+ "<p class='post-detail'><span>Species:</span> " +  newPostData.post_type + "</p>"
									+ "<p class='post-detail'><span>Taken at:</span> " +  newPostData.body_of_water + "</p>"
									+ "<p class='post-detail'><span>Taken On:</span> " +  newPostData.month + "/" + newPostData.day + "/" +  newPostData.year + "</p>"
									+ "<p class='post-detail'><span>With:</span> " +  newPostData.nearest_town + "</p>";


			newPostData.body = newBody;

			$.post("http://" + document.domain + "/community-api/posts",newPostData,function(data){

				var postData = $.parseJSON(data);


				//alert("New Post Added! Replace this alert with a redirect to something!")

				var newPostURL = "/photos/" + newPostData.tertiary_post_type + "/" + newPostData.secondary_post_type + "/" + newPostData.post_type + "/" + postData.id;

				if (newPostData.secondary_post_type == null) {
					var newPostURL = "/photos/" + newPostData.tertiary_post_type + "/" + newPostData.post_type + "/" + postData.id;
				}

				if (postData)
					window.location.href = newPostURL;
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






		//Check form fields
		if (formData.img_url == undefined || formData.img_url.length < 1) {
			alert("Please attach a photo.");
			return false;
		} else if (formData.title.length < 1) {
			alert("Please give this post a title.");
			return false;
		} else if (formData.body == undefined || formData.body.length < 1) {
			alert("Please tell Your Story.");
			return false;
		} else if (formData.post_type_fishing.length < 1 && formData.post_type_hunting.length < 1) {
			alert("Please select a species.");
			return false;
		} else if (formData.state.length < 1) {
			alert("Please Choose a state.");
			return false;
		} else if (userIMO.username.length < 1) {
			alert("Please login before you post.");
			return false;
		} else if (formData.agreeToTerms == undefined || formData.agreeToTerms.length < 1) {
			alert("Please agree to Terms.");
			return false;
		} else {
			return true;
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
		            $('.loading-gif div').css("width",progress*3 + "px");
		            $('.loading-gif span').text("Uploading: "+progress+"%");

		        }
		   );

		}
	});


});


