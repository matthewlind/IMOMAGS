jQuery(document).ready(function($) {



if($(".user-points-profile").length > 0){

	//First, get the user score
	var dataURL = "/slim/api/superpost/user/score/" + username.profileUser;  	

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
				$(".user-points-profile").text(Math.ceil(this.animatedScore));
			}
		});

    });
}


if($(".user-points").length > 0){

	//First, get the user score
	var dataURL = "/slim/api/superpost/user/score/" + username.authUser;  	

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



});//End doc Ready