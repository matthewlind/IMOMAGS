window.fbAsyncInit = function() {
  FB.init({
    appId      : '127971893974432',
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
	  
		  //This section moved to imo-fb-login
		  
	  }//End if response.status == connected
	  
	  
	});//End facebook event subscribe



  
};//END window.fbAsyncInit



function authSuccess(data,$clickedButton){
    //console.log(data);
    
    userIMO = data;
    
    $submit = $('.superpost-form input[type="submit"]');
    var $userWidget = $("#user-info-widget");
    //var $userBar = $("ul#user-bar");
 				            
 	$userWidget.find(".user-info-area a").attr("href","/profile/" + data.username);
 	$userWidget.find(".name").attr("href","/profile/" + data.username);
    $userWidget.find(".name").text(data.display_name);
    $userWidget.find("img.recon-gravatar").attr("src","/avatar?uid=" + data.user_id);
 	$userWidget.find(".user-points").text(data.score);		
 	            
    /*$userBar.find("a").attr("href","/profile/" + data.username);
    $userBar.find("#current-user-name").text(data.display_name);
    $userBar.find("img.recon-gravatar").attr("src","/avatar?uid=" + data.user_id);*/
    			            
    $("#imo-fb-login-button").fadeOut(500,function(){
        $(".imo-fb-login-button").fadeOut(400);
        $(".join-widget-fb-login").fadeOut(400);
        $(".choose-fb").fadeOut(400);
        $(".email-login").fadeOut(400);
        $(".email-signup").fadeOut(400);
        $("#community-menu-nav small").fadeOut(400);
        //$userBar.fadeIn();
        $submit.fadeIn();

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
		    		
		
		
		    	$({animatedScore: 0}).animate({animatedScore: score}, {
					duration: duration,
					easing:'jswing', // can be anything
					step: function() { // called on every step
						// Update the element's text with rounded-up value:
						$(".user-points").text(Math.ceil(this.animatedScore));
					}
				});
		
		    });
		
							            
							            
		    }  
							            
		);
        
        
    });
    
            
    //replace when App is live
     $(".fb-join-widget-box").fadeOut(500);
    //$(".fb-join-widget-box .widget_gravity_form").fadeOut(500,function(){

        
      //  $.get('/static-widgets/get-the-app.html', function(data) {
		  
		//  $(data).prependTo(".fb-join-widget-box").fadeIn();

		//});
   // });
   
   
		//If this was a login&post button, submit the form
		if ($clickedButton.hasClass("fast-login-then-post-button")) {
    	//alert("fast login used!");
    	
    	//console.log("clicked button:",$clickedButton );
    	
    	//console.log("Submitted Forms:",$("#fileUploadForm"));
    	
    	$("#fileUploadForm").first().submit();
        
    }
    
    //
    
   	    	
    if ($clickedButton.hasClass("fb-login-community-modal") || $clickedButton.hasClass("email-redirect")) {
    	window.location="http://www.northamericanwhitetail.com/community-post/";		
    	}
    
    $(".fast-login-then-post-button").fadeOut(400,function(){
        
        //$(".submit").css({ opacity: 0.5 });
        $(".submit").fadeIn();
        

        
        
        
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
	    
	    
 	//TESTING TO SEE IF THINGS WORK.
/*
	$("a").click(function(event){
		//alert("hey");
		
		$.getJSON("/imo-email-login.json",function(data){
			alert("login?");
			console.log(data);
		});
		
		event.preventDefault();
	});
*/


	jQuery(".imo-fb-login-button, .fast-login-then-post-button, .join-widget-fb-login").click(function(){
						

		
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

  



(function(d){
   var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   d.getElementsByTagName('head')[0].appendChild(js);
 }(document));

