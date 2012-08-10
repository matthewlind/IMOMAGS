window.fbAsyncInit = function() {
  FB.init({
    appId      : '127971893974432',
    status     : true, 
    cookie     : true,
    xfbml      : true,
    oauth      : true,
  });


  FB.Event.subscribe('auth.authResponseChange', function(response) {
    console.log('authResponseChange: The status of the session is: ' + response.status);
  });
  
    FB.Event.subscribe('auth.prompt', function(response) {
    console.log('auth.prompt: The status of the session is: ' + response.status);
  });

  
	FB.Event.subscribe('auth.statusChange', function(response) {
	  console.log('STATUS CHANGE: The status of the session is: ' + response.status);
	  
	  if (response.status == "not_authorized") {
	  
		  if (userIMO.username.length > 0 && userIMO.facebook_id.length > 0) {//If user is logged in and not a FB user
	
	  	  	jQuery.getJSON('/logout.json', function(data) {
	            $("#tophat").hide();
	            console.log("FB: LOG OUT");
	        });
	        	  
		  }
	  
	  }
	  
	  if (response.status == "connected") {
	  
		  //This section moved to imo-fb-login
		  
	  }//End if response.status == connected
	  
	  
	});//End facebook event subscribe



  
};//END window.fbAsyncInit


jQuery(document).ready(function($) {

	jQuery(".imo-fb-login-button").click(function(){
						
		imo_fb_login();

	
		function imo_fb_login() {
		
		$(".imo-fb-login-button").css({ opacity: 0.5 });
		
			FB.login(function(response) {
			   if (response.authResponse) {
			     console.log('Welcome!  Fetching your information.... ');
			     FB.api('/me', function(response) {
			       console.log('Good to see you, ' + response.name + '.');
			       
			       
			       
			       	if (userIMO.username.length > 0) {//If user is logged in 
	
		  
					  } else { //if user is not logged in
					  
					  	  //$(".user-login-modal-container").modal.close();
					  	  
					  	  //$.modal.close();
					  	  
					  	 
					  	  
						  
						  jQuery.getJSON('/facebook-usercheck.json', function(data) {
				            console.log(data);
				            
				            userIMO = data;
				            
				            
				            var $userBar = $("ul#user-bar");
				            
				            $userBar.find("a").attr("href","/profile/" + data.username);
				            $userBar.find("#current-user-name").text(data.display_name);
				            $userBar.find("img.recon-gravatar").attr("src","/avatar?uid=" + data.user_id);
				            
				            $(".imo-fb-login-button").fadeOut(500,function(){
					            
					            $userBar.fadeIn();
				            });
				            

				       			            
				            
				            
				          });
						  
					  }//End if user is logged in
						       
			       
			       
			         
			     });
			   } else {
			     console.log('User cancelled login or did not fully authorize.');
			   }
			 }, {scope: 'email,user_hometown'});
		}//END imo_fb_login
	});

});

  



(function(d){
   var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   d.getElementsByTagName('head')[0].appendChild(js);
 }(document));

