jQuery(document).ready(function($) {

	//Get post_type from community config
	var postTypes = IMO_COMMUNITY_CONFIG.post_types;

	postAttachments = [];

	//*******************************************************
	//****************** DISPLAY THE FORM *******************
	//*******************************************************
	var formTemplate = _.template( $("#new-post-template").html() , { post:null, post_types:postTypes } );//Use the post types from the configuration
	$("#form-container").append(formTemplate);

	//*******************************************************
	//****************** NEW POST SUBMISSION ****************
	//*******************************************************
	$("#new-post-form").submit(function(){

		var formDataObject = $("#new-post-form").formParams();
		var newPostData = $.extend(formDataObject,userIMO);

		newPostData.attachments = postAttachments;

		//console.log(newPostData);

		$.post("http://" + document.domain + "/community-api/posts",newPostData,function(data){

			var postData = $.parseJSON(data);




			//alert("New Post Added! Replace this alert with a redirect to something!")

			window.location.href = "/photos/" + postData.id;
		});

		return false;

	});

	//*******************************************************
	//****************** UPLOAD IMAGES **********************
	//*******************************************************
	$("#new-post-form #image-upload").change(function(ev){//After the user selects a file

		var fileInput = ev.currentTarget;

		if (!fileInput.value) {
			//If they don't select anything... Do nothing
		    //console.log("Choose an Image to upload.");
		} else {

			$('#progressBar').fadeIn();

			filepicker.setKey('ANCtGPesfQI6nKja0ipqBz');

		    filepicker.store(fileInput, function(FPFile){//Begin the upload


		    		//If upload is good:
		            //console.log("Store successful:", FPFile);

		            //Create the attachment data

		            var newAttachment = {};
		            newAttachment.img_url = FPFile.url;
		            newAttachment.post_type = "photo";


		            //get template for attachment
		            var attachmentTemplate = _.template( $("#single-attachment-template").html() , {attachment: newAttachment} );
		            var $attachmentTemplate = $(attachmentTemplate);


		            //display attachment
		            $("#attachments").append($attachmentTemplate);

		            //add event to edit caption on change
		            $attachmentTemplate.find(".caption-field").change(function(ev){
		            	var caption = ev.currentTarget.value;
		            	newAttachment.body = caption;
		            });

		            //Add Event to Delete Attachment
		            $attachmentTemplate.find(".delete-attachment").click(function(ev){

		            	ev.preventDefault();

		            	var attachmentIndex = postAttachments.indexOf(newAttachment);
		            	postAttachments.splice(attachmentIndex,1);
		            	$attachmentTemplate.remove();

		            });

		            postAttachments.push(newAttachment);//add the attachments to the list
					$('#progressBar').fadeOut();

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