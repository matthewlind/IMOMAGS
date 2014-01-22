//Most of the JavaScript in the file doesn't use jQuery. This allows us to set the U.S. State before almost all of the other scripts run.

if (readCookie('userState')) {

	//alert("there is cookie! No need to do anything.");

} else {

	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(function(position){
	    	//console.log(position);
	    	var lat = position.coords.latitude;
	    	var lng = position.coords.longitude;

	    	setStateFromCoords(lat,lng);


		});
	} else {
		//alert("No geolocation in browser. So sad.");
	}


}

function setStateFromCoords(latitude,longitude) {
    var xmlhttp;

    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //if request is good, do stuff

            var response = xmlhttp.responseText;

            var closestLocation = JSON.parse(response);


            console.log(closestLocation);

            var stateAbbrev = closestLocation.state;
		    createCookie('userState',stateAbbrev,30,'/',window.location.host);
		    userState = stateAbbrev;

        }
    }

    var url = "/wpdb/gps-to-zip.php?lat=" + latitude +  "&lon=" + longitude ;

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}



function createCookie(name, value, expires, path, domain) {
  var cookie = name + "=" + escape(value) + ";";

  if (expires) {
    // If it's a date
    if(expires instanceof Date) {
      // If it isn't a valid date
      if (isNaN(expires.getTime()))
       expires = new Date();
    }
    else
      expires = new Date(new Date().getTime() + parseInt(expires) * 1000 * 60 * 60 * 24);

    cookie += "expires=" + expires.toGMTString() + ";";
  }

  if (path)
    cookie += "path=" + path + ";";
  if (domain)
    cookie += "domain=" + domain + ";";


  document.cookie = cookie;

  location.reload();
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}



jQuery( document ).ready(function() {


  jQuery(".not-your-state").on("click",function(ev){
    ev.preventDefault();
    jQuery(".choose-your-state").slideDown();
  });

  jQuery(".choose-your-state").on("change",function(ev){

    var stateAbbrev = jQuery(".choose-your-state option:selected").val();


    ev.preventDefault();

    createCookie('userState',stateAbbrev,30,'/',window.location.host);
    userState = stateAbbrev;


  });

});



