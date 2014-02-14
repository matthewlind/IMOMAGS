jQuery(document).ready(function($) {
	
	$(".ask-quesiton").click(function(){
		$("#form-container").slideDown();
		$(".ask-quesiton").hide();
	});
	
    //Set the filter to the default settings
    filter = {};
    filterReset();
    function filterReset() {
        filter.order_by = "created";
        filter.sort = "DESC";
        filter.master = 0;
        filter.skip = 0;
        filter.post_type = "question";
        filter.per_page=20;
        filter.post_count = 10000000;
    }

    //Highlight the default menu item
    $("ul.filter #filter-menu-default").addClass("active");
	
	
	//Place ads
	function adPlacement() {
			$("#posts-container .community-ad").remove();
			if ($(window).width() <  1096 ) {
				$('<div class="community-ad"><div class="image-banner"><iframe id="community-listing-ad" width=300 height=250 marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-community-ad.php?ad_code=imo.in-fisherman"></iframe></div></div>')
				.insertAfter("#posts-container .dif-post:nth-child(5n)");
			}else{
				$('<div class="community-ad"><div class="image-banner"><iframe id="community-listing-ad" width=300 height=250 marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-community-ad.php?ad_code=imo.in-fisherman"></iframe></div></div>')
				.insertAfter("#posts-container .dif-post:nth-child(9n)");
			}
	}
	
	

    //Get the JSON using the above filter configuration and append the photos.
    getPhotosAndAppend();
    
    loadMoreCheck();
    function getPhotosAndAppend() {
        var url = "http://" + document.domain + "/community-api/posts?skip="+filter.skip+"&per_page="+filter.per_page+"&order_by="+filter.order_by+"&sort="+filter.sort+"&master="+filter.master+"&post_type="+filter.post_type;

        $.getJSON(url,function(posts){

            $.each(posts,function(index,post){

                var postHTML = _.template( $('#post-template').html() , { post: post });
                $("#posts-container").append(postHTML);
				
				addthis.toolbox('.addthis_toolbox');

            });
                        			
			adPlacement();
            //hide the ajax loading spinner
            $("#ajax-loader").hide();
            

        });
    }

    //Change the filter configuration
    $(".filter-menu").click(function(ev){

        ev.preventDefault();

        //Grab the selected menu item
        var $menuItem = $(ev.currentTarget);

        //Change the actively selected menu item
        $("ul.filter li.active").removeClass("active");
        $menuItem.closest("li").addClass("active");

        //reset the filter
        filterReset();


        //Change the filter configuration according to the attributes of the clicked menu item
        if ($menuItem.attr("sort") != undefined) { filter.sort = $menuItem.attr("sort"); }
        if ($menuItem.attr("order_by") != undefined) { filter.order_by = $menuItem.attr("order_by"); }
        if ($menuItem.attr("master") != undefined) { filter.master = $menuItem.attr("master"); }
        if ($menuItem.attr("skip") != undefined) { filter.skip = $menuItem.attr("skip"); }
        if ($menuItem.attr("post_type") != undefined) { filter.post_type = $menuItem.attr("post_type"); }
        if ($menuItem.attr("per_page") != undefined) { filter.per_page = $menuItem.attr("per_page"); }


        //Clear the HTML and append posts
        $("#posts-container").html("");
        getPhotosAndAppend();
		
        //Change menu title to reflect filter
        $(".menu-title.browse-community").html($menuItem.html());

        loadMoreCheck();
    });

    //Loadmore button
  $("a.load-more").click(function(ev){
		ev.preventDefault();
		
		filter.skip = filter.skip + filter.per_page;
		getPhotosAndAppend();
		
		loadMoreCheck();
		//refresh the sticky ad on load more
		if (jQuery(window).width() >  610 ) {
			document.getElementById('sticky-iframe-ad').contentWindow.location.reload();
			jQuery(".sidebar.advert").css({
		    	display: 'block',
				position: 'fixed',
				top: 10
			});
		}
    });
	
    //Check to see if loadmore needs to be hidden
    function loadMoreCheck() {
        var url = "http://" + document.domain + "/community-api/posts/counts?skip="+filter.skip+"&per_page="+filter.per_page+"&order_by="+filter.order_by+"&sort="+filter.sort+"&master="+filter.master+"&post_type="+filter.post_type;
		

        $.getJSON(url,function(countData){


            var totalPostCount = countData[0].post_count;
			
            //console.log(totalPostCount,filter.skip);

            if (filter.skip + filter.per_page >= totalPostCount ) {
                $("a.load-more").hide();
            } else {
                $("a.load-more").show();
            }

        });
        
    }


	//Get post_type from community config
	var postTypes = IMO_COMMUNITY_CONFIG.post_types;

	postAttachments = [];
	postData = [];

	postData.master = 0;

	//*******************************************************
	//****************** DISPLAY THE FORM *******************
	//*******************************************************

	var formTemplate = _.template( $("#new-post-template").html() , { post:null, post_types:postTypes } );//Use the post types from the configuration
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
					window.location.href = "/community/" + postData.id;
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
		if (formData.title.length < 1) {
			alert("Please give this post a title.");
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


