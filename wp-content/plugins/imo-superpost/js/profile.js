jQuery(document).ready(function($) {


if(username.length > 0){
	var postsURL = "/slim/api/superpost/user/posts/" + username;

	//First, get the user score
	var dataURL = "/slim/api/superpost/user/score/" + username;  	

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