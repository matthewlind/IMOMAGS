/**
 * Scripts.js
 */

var dartadsgen_rand = Math.floor((Math.random()) * 100000000), pr_tile = 1, dartadsgen_site="hunting";


/*****
**
** Background click through
**
*****/

	jQuery(document).ready(function($){
	
		//clickable expiration date
		var currentTime = new Date();
		var month = currentTime.getMonth() + 1;
		var day = currentTime.getDate();
		var year = currentTime.getFullYear();
		var expDate = month + "/" + day + "/" + year;
		
		//enter expiration date - uses 1-12 for month
        if(expDate < "4/8/2013"){

			url = "http://www.newfoundlandlabrador.com/ThingsToDo/Hunting?utm_source=www.imoutdoorsmedia.com&utm_medium=displayad&utm_content=2091-63&utm_campaign=NLT-2091";
			$(".clickable-bg").click(function(event){	
				window.location = url;
			});
		
		}
	});
