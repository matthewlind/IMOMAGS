
//***********************************
//** FACEBOOK INIT **
//***********************************
window.fbAsyncInit = function() {

  //set default whitetail app id
  var appID = '127971893974432';

  //use facebook appId from settings
  if (fb_auth.length > 0);
  	appID = fb_auth.app_id;

  FB.init({
    appId      : appID,
    status     : true,
    cookie     : true,
    xfbml      : true,
    oauth      : true,
  });

  FB.Event.subscribe('auth.authResponseChange', function(response) {
    //console.log('authResponseChange: The status of the session is: ' + response.status);
  });

    FB.Event.subscribe('auth.prompt', function(response) {
    //console.log('auth.prompt: The status of the session is: ' + response.status);
  });

	FB.Event.subscribe('auth.statusChange', function(response) {
	  //console.log('STATUS CHANGE: The status of the session is: ' + response.status);

	  if (response.status == "not_authorized") {

		  if (userIMO.username.length > 0 && userIMO.facebook_id.length > 0) {//If user is logged in and not a FB user

	  	  	jQuery.getJSON('/logout.json', function(data) {
	            $("#tophat").hide();
	            //console.log("FB: LOG OUT");
	        });

		  }

	  }

	  if (response.status == "connected") {

	  }//End if response.status == connected

	});//End facebook event subscribe

};//END window.fbAsyncInit

(function(d){
   var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   d.getElementsByTagName('head')[0].appendChild(js);
 }(document));

//*****************************************************
//** AFTER FACEBOOK LOGIN BUTTON IS CLICKED, **********
//** THE authSuccess() FUNCTION IS CALLED IF LOGIN WAS SUCCESSFUL **
//*****************************************************
function authSuccess(data,$clickedButton){
    //console.log(data);

    userIMO = data;

    $submit = jQuery('.superpost-form input[type="submit"]');
    var $userWidget = jQuery("#user-info-widget");
    //var $userBar = $("ul#user-bar");



 	$userWidget.find(".user-info-area a").attr("href","/profile/" + data.username);
 	$userWidget.find(".name").attr("href","/profile/" + data.username);
    $userWidget.find(".name").text(data.display_name);
    $userWidget.find("img.recon-gravatar").attr("src","/avatar?uid=" + data.user_id);
 	$userWidget.find(".user-points").text(data.score);

    /*$userBar.find("a").attr("href","/profile/" + data.username);
    $userBar.find("#current-user-name").text(data.display_name);
    $userBar.find("img.recon-gravatar").attr("src","/avatar?uid=" + data.user_id);*/

    jQuery("#imo-fb-login-button").fadeOut(500,function(){
        jQuery(".imo-fb-login-button").fadeOut(400);
        jQuery(".join-widget-fb-login").fadeOut(400);
        jQuery(".choose-fb").fadeOut(400);
        jQuery(".email-login").fadeOut(400);
        jQuery(".email-signup").fadeOut(400);
        jQuery("#community-menu-nav small").fadeOut(400);
        //$userBar.fadeIn();
        $submit.fadeIn();



                jQuery(".browse-item").removeClass("item-active");
        jQuery(".browse-holder").removeClass("browse-panel-opened");
        jQuery(".filter-fade-out").removeClass("filter-fade-in");
        jQuery(".layout-frame").removeClass("filter-popup-opened");


        jQuery("#new-post-form").submit();
        jQuery("#comment-form").submit();

        jQuery(".btn-submit").fadeIn();

        jQuery(".login-message").fadeOut();
        jQuery(".join-logged-in").find(".profile-photo img").attr("src","/avatar?uid=" + data.user_id);
        jQuery(".join-logged-in").fadeIn(function(){

        });

        //$userBar.fadeIn();
        $userWidget.fadeIn(500,function(){

        	var postsURL = "/slim/api/superpost/user/posts/" + data.username;

			//First, get the user score
			var dataURL = "/slim/api/superpost/user/score/" + data.username;

		    var getdata = $.getJSON(dataURL, function(data){

		    	var score = data[0].score;

		    	var duration = 1000;
		    	if (score > 50) {
		    		duration = 2000;
		    	}
		    	if (score > 200) {
		    		duration = 3000;
		    	}



		    	jQuery({animatedScore: 0}).animate({animatedScore: score}, {
					duration: duration,
					easing:'jswing', // can be anything
					step: function() { // called on every step
						// Update the element's text with rounded-up value:
						jQuery(".user-points").text(Math.ceil(this.animatedScore));
					}
				});

		    });



		    }

		);


    });


    //replace when App is live
     jQuery(".fb-join-widget-box").fadeOut(500);

		//If this was a login&post button, submit the form
		if ($clickedButton.hasClass("fast-login-then-post-button")) {
    		jQuery("#fileUploadForm").first().submit();
    	}

		//If this was a login&post button, submit the form
		if ($clickedButton.hasClass("fast-login-then-imo-community-post")) {
    		jQuery("#new-post-form").submit();
    	}

    //

    if ($clickedButton.hasClass("fb-login-community-modal") || $clickedButton.hasClass("email-redirect")) {
    	window.location="http://www.northamericanwhitetail.com/community-post/";
    	}

    if ($clickedButton.hasClass("go-to-profile")) {
    	window.location="/login/?action=edit-profile";
    }
    if ($clickedButton.hasClass("go-to-profile-naw")) {
    	window.location="/login/?action=edit-profile";
    }

    jQuery(".fast-login-then-post-button").fadeOut(400,function(){

        //jQuery(".submit").css({ opacity: 0.5 });
        jQuery(".submit").fadeIn();

    });

}

jQuery(document).ready(function($) {

	$(".email-signup-redirect").click(function(event){
		$("input#lwa_wp-submit").addClass("email-redirect");
		$('#imo-ajax-login-form').addClass("email-redirect");
	    $("input#hidden-redirect").addClass("hidden-redirect");
	    $(".hidden-redirect").val("http://www.northamericanwhitetail.com/community-post");
	});

    $("input.email-redirect").submit(function(){
	    window.location="http://www.northamericanwhitetail.com/community-post";
    });

//**************************
//NEW STYLE EMAIL LOGIN MODAL POPUP
//**************************



	//**************************
	//LOGIN FORM AJAX REQUEST
	//**************************
	$('#imo-ajax-login-form').ajaxForm({
		beforeSubmit: AjaxLoginShowRequest,
	success: AjaxLoginSuccessful,
	error: AjaxLoginError,
	dataType: 'json'
	});

	var jqueryForm;

	function AjaxLoginShowRequest(formData, jqForm, options) {
	  var queryString = $.param(formData);

	  jqueryForm = jqForm;
	  //alert('BeforeSend method: \n\nAbout to submit: \n\n' + queryString);
	}

	function AjaxLoginSuccessful(responseText, statusText) {


	  if (responseText.error != undefined && responseText.error.length > 0)
	  	alert(responseText.error);
	  else {


	  	  $('#login-modal').modal('hide');

		  $clickedButton = $('#imo-ajax-login-form #lwa_wp-submit');

		  //console.log($clickedButton);
		  authSuccess(responseText,jqueryForm);
	  }

	}

	function AjaxLoginError() {
	  //alert("error");
	}

	//**************************
	//Register FORM AJAX REQUEST
	//**************************
	$('#imo-ajax-register-form').ajaxForm({
		beforeSubmit: AjaxRegisterShowRequest,
	success: AjaxRegisterSuccessful,
	error: AjaxRegisterError,
	dataType: 'json'
	});

	function AjaxRegisterShowRequest(formData, jqForm, options) {
	  var queryString = $.param(formData);
	  //alert('Register BeforeSend method: \n\nAbout to submit: \n\n' + queryString);
	}

	function AjaxRegisterSuccessful(responseText, statusText) {


	  if (responseText.error != undefined && responseText.error.length > 0)
	  	alert(responseText.error);
	  else {
		  $('#login-modal').modal('hide');
		  authSuccess(responseText);
	  }

	}

	function AjaxRegisterError() {
	  //alert("error");
	}








//**************************
//EMAIL LOGIN MODAL POPUP
//**************************
if ($(".user-login-modal-container").length > 0){


	$(".email-login a, .email-signup").click(function(event){
		$('#login-modal').modal();

		//**************************
		//LOGIN FORM AJAX REQUEST
		//**************************
		$('#imo-ajax-login-form').ajaxForm({
			beforeSubmit: AjaxLoginShowRequest,
		success: AjaxLoginSuccessful,
		error: AjaxLoginError,
		dataType: 'json'
		});

		var jqueryForm;

		function AjaxLoginShowRequest(formData, jqForm, options) {
		  var queryString = $.param(formData);

		  jqueryForm = jqForm;
		  //alert('BeforeSend method: \n\nAbout to submit: \n\n' + queryString);
		}

		function AjaxLoginSuccessful(responseText, statusText) {


		  if (responseText.error != undefined && responseText.error.length > 0)
		  	alert(responseText.error);
		  else {


		  	  $('#login-modal').modal('hide');

			  $clickedButton = $('#imo-ajax-login-form #lwa_wp-submit');

			  //console.log($clickedButton);
			  authSuccess(responseText,jqueryForm);
		  }

		}

		function AjaxLoginError() {
		  //alert("error");
		}

		//**************************
		//Register FORM AJAX REQUEST
		//**************************
		$('#imo-ajax-register-form').ajaxForm({
			beforeSubmit: AjaxRegisterShowRequest,
		success: AjaxRegisterSuccessful,
		error: AjaxRegisterError,
		dataType: 'json'
		});

		function AjaxRegisterShowRequest(formData, jqForm, options) {
		  var queryString = $.param(formData);
		  //alert('Register BeforeSend method: \n\nAbout to submit: \n\n' + queryString);
		}

		function AjaxRegisterSuccessful(responseText, statusText) {


		  if (responseText.error != undefined && responseText.error.length > 0)
		  	alert(responseText.error);
		  else {
			  $('#login-modal').modal('hide');
			  authSuccess(responseText);
		  }

		}

		function AjaxRegisterError() {
		  //alert("error");
		}




	});


	$(".email-login a, .email-signup").click(function(event){
		event.preventDefault();

		if ($("#community-modal").length > 0){
			$.modal.close();
		}
    	$(".user-login-modal-container").modal({
	        opacity: 50,
	        overlayClose: true,
	        autoPosition: true,
	        height: 'auto',
	        width: 376,
	        onShow: function(dialog) {
	        	$("#simplemodal-container").css({
		        	 height: 'auto',
		        	 width: 376,
	        	});
		        $(".user-login-modal-container a.hide-this").click(function(){
			        $.modal.close();
		        });


		        //alert("BOB");

			  //**************************
			  //LOGIN FORM AJAX REQUEST
			  //**************************
			  $('#imo-ajax-login-form').ajaxForm({
			  	beforeSubmit: AjaxLoginShowRequest,
			    success: AjaxLoginSuccessful,
			    error: AjaxLoginError,
			    dataType: 'json'
			  });

			  var jqueryForm;

			  function AjaxLoginShowRequest(formData, jqForm, options) {
			      var queryString = $.param(formData);

			      jqueryForm = jqForm;
			      //alert('BeforeSend method: \n\nAbout to submit: \n\n' + queryString);
			  }

			  function AjaxLoginSuccessful(responseText, statusText) {


				  if (responseText.error != undefined && responseText.error.length > 0)
				  	alert(responseText.error);
				  else {
					  $.modal.close();
					  $clickedButton = $('#imo-ajax-login-form #lwa_wp-submit');

					  console.log($clickedButton);
					  authSuccess(responseText,jqueryForm);
				  }

			  }

			  function AjaxLoginError() {
				  //alert("error");
			  }


			  //**************************
			  //Register FORM AJAX REQUEST
			  //**************************
			  $('#imo-ajax-register-form').ajaxForm({
			  	beforeSubmit: AjaxRegisterShowRequest,
			    success: AjaxRegisterSuccessful,
			    error: AjaxRegisterError,
			    dataType: 'json'
			  });

			  function AjaxRegisterShowRequest(formData, jqForm, options) {
			      var queryString = $.param(formData);
			      //alert('Register BeforeSend method: \n\nAbout to submit: \n\n' + queryString);
			  }

			  function AjaxRegisterSuccessful(responseText, statusText) {


				  if (responseText.error != undefined && responseText.error.length > 0)
				  	alert(responseText.error);
				  else {
					  $.modal.close();
					  authSuccess(responseText);
				  }

			  }

			  function AjaxRegisterError() {
				  //alert("error");
			  }



	        },
	     });
     });
}



//***********************************
//** FACEBOOK LOGIN BUTTON CLICKED **
//***********************************
	jQuery(".imo-fb-login-button, .fast-login-then-post-button, .join-widget-fb-login").click(function(ev){

		ev.preventDefault();

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

});







