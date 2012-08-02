window.fbAsyncInit = function() {
  FB.init({
    appId      : '127971893974432',
    status     : true, 
    cookie     : true,
    xfbml      : true,
    oauth      : true,
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
  
	  if (userIMO.username.length > 0) {//If user is logged in 

	  
	  } else { //if user is not logged in
	  
	  	  //$(".user-login-modal-container").modal.close();
	  	  
	  	  $.modal.close();
	  	  
	  	  
	  	  
	  	  
	  	  
		  
		  jQuery.getJSON('/facebook-usercheck.json', function(data) {
            console.log(data);
            
            $("#current-user-name").text(data.display_name);
            $("#tophat img.avatar").attr("src","http://0.gravatar.com/avatar/" + data.gravatar_hash + "?s=35");
            
            $("#tophat").slideDown();
            
            
            
          });
		  
	  }
	  
  }
  
  
});

/*

  
  FB.Event.subscribe('auth.login', function (response) {
      console.log("HEY THERE!");
      console.log(response);
      
      
              FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                  FB.api('/me', function(response) {
                     console.log('You\'re already logged in to FB and this App has previously authenticated, ' + response.name + '.');
                   });

                  jQuery.getJSON('/facebook-usercheck.json', function(data) {
                    console.log(data);
                  });
                  // the user is logged in and has authenticated your
                  // app, and response.authResponse supplies
                  // the user's ID, a valid access token, a signed
                  // request, and the time the access token 
                  // and signed request each expire
                  var uid = response.authResponse.userID;
                  var accessToken = response.authResponse.accessToken;
                } else if (response.status === 'not_authorized') {
                  imo_fb_login();
                  console.log("logged in to fb, app not authenticated");
                  // the user is logged in to Facebook, 
                  // but has not authenticated your app
                } else {
                  imo_fb_login();
                  console.log("not logged in to fb");
                  // the user isn't logged in to Facebook.
                }
               });

              function imo_fb_login() {
                FB.login(function(response) {
                   if (response.authResponse) {
                     console.log('Welcome!  Fetching your information.... ');
                     FB.api('/me', function(response) {
                       console.log('Good to see you, ' + response.name + '.');
                     });
                   } else {
                     console.log('User cancelled login or did not fully authorize.');
                   }
                 }, {scope: 'email'});
              }
      
  });
*/
  
  
  
};


(function(d){
   var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   d.getElementsByTagName('head')[0].appendChild(js);
 }(document));

