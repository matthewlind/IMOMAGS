jQuery(document).ready(function($) {
	
	var currentPosition = 0;
	var showAtOnce = 3;
	var sort = "post_date";
	var feedData;

	//Check to see if network-topics-widget exists:
	if ($(".network-topics").length > 0) {
		//if yes, display some things
		displayCrossSiteFeed(currentPosition);
	}

	
	function displayCrossSiteFeed(start,sort) {
		sort = typeof sort !== 'undefined' ? sort : 'post_date'; //If sort is not set, set sort to post_date		
		 	
		
		//First get any extra term
		var gunTerm = $("#guns-network").attr("term");
		var gearTerm = $("#gear-network").attr("term");
		var pdTerm = $("#personal-defense-network").attr("term");
		var cpTerm = $("#culture-politics-network").attr("term");
		var survTerm = $("#survival-network").attr("term");
		
	
		var gunFileName = "/wpdb/shooting-network-json.php?t=" + gunTerm;
		var gearFileName = "/wpdb/shooting-network-json.php?t=" + gearTerm;
		var pdFileName = "/wpdb/shooting-network-json.php?t=" + pdTerm;
		var cpFileName = "/wpdb/shooting-network-json.php?t=" + cpTerm;
		var survFileName = "/wpdb/shooting-network-json.php?t=" + survTerm;
		
		//Gun Network
		var getdata = $.getJSON(gunFileName, function(data) {
		    var count = 0;

		    var end = start + showAtOnce;

		    for (i = start; i < end; i++) {
		        count++;
		
		        
		        var $articleTemplate = $("li#nt-widget-template").clone();

		        $articleTemplate.attr("id","nt-" + data[i].post_name + count);
		        $articleTemplate.find("a.title").attr("href",data[i].post_url);
		        if(data[i].img_url){
		        	$articleTemplate.find("a.network-thumb").attr("href",data[i].post_url);
		        	$articleTemplate.find("img").attr("src",data[i].img_url).attr("alt",data[i].post_title);
		        }	        
		        $articleTemplate.find("a.title").text(data[i].post_title);
		        
		        if (data[i].domain != document.domain) {
		        	$articleTemplate.find(".site a").text(data[i].brand + " Magazine");
		        	$articleTemplate.find(".site a").attr("href","http://" + data[i].domain);

					$articleTemplate.find("a").attr("target","_blank");
				}else{
					$articleTemplate.find(".site a").hide();
				}
				
				$articleTemplate.appendTo("#guns-network").fadeIn();

		    }


		
		});
		
		//Gear Network
		var getdata = $.getJSON(gearFileName, function(data) {
        		    
		    var count = 0;

		    var end = start + showAtOnce;

		    for (i = start; i < end; i++) {
		        count++;
		
		        
		        var $articleTemplate = $("li#nt-widget-template").clone();

		        $articleTemplate.attr("id","nt-" + data[i].post_name + count);
		        $articleTemplate.find("a.title").attr("href",data[i].post_url);
		        if(data[i].img_url){
		        	$articleTemplate.find("a.network-thumb").attr("href",data[i].post_url);
		        	$articleTemplate.find("img").attr("src",data[i].img_url).attr("alt",data[i].post_title);
		        }	    
		        		        
		        $articleTemplate.find("a.title").text(data[i].post_title);
		        
		        if (data[i].domain != document.domain) {
		        	$articleTemplate.find(".site a").text(data[i].brand + " Magazine");
		        	$articleTemplate.find(".site a").attr("href","http://" + data[i].domain);

					$articleTemplate.find("a").attr("target","_blank");
				}else{
					$articleTemplate.find(".site a").hide();
				}
				
				$articleTemplate.appendTo("#gear-network").fadeIn();

		    }


		
		});


		//Personal Defense Network
		var getdata = $.getJSON(pdFileName, function(data) {
        		    
		    var count = 0;

		    var end = start + showAtOnce;

		    for (i = start; i < end; i++) {
		        count++;
		
		        
		        var $articleTemplate = $("li#nt-widget-template").clone();

		        $articleTemplate.attr("id","nt-" + data[i].post_name + count);
		        $articleTemplate.find("a.title").attr("href",data[i].post_url);
		        if(data[i].img_url){
		        	$articleTemplate.find("a.network-thumb").attr("href",data[i].post_url);
		        	$articleTemplate.find("img").attr("src",data[i].img_url).attr("alt",data[i].post_title);
		        }	    
		        		        
		        $articleTemplate.find("a.title").text(data[i].post_title);
		        
		        if (data[i].domain != document.domain) {
		        	$articleTemplate.find(".site a").text(data[i].brand + " Magazine");
		        	$articleTemplate.find(".site a").attr("href","http://" + data[i].domain);

					$articleTemplate.find("a").attr("target","_blank");
				}else{
					$articleTemplate.find(".site a").hide();
				}
				
				$articleTemplate.appendTo("#personal-defense-network").fadeIn();

		    }


		
		});


		//Personal Defense Network
		var getdata = $.getJSON(cpFileName, function(data) {
        		    
		    var count = 0;

		    var end = start + showAtOnce;

		    for (i = start; i < end; i++) {
		        count++;
		
		        
		        var $articleTemplate = $("li#nt-widget-template").clone();

		        $articleTemplate.attr("id","nt-" + data[i].post_name + count);
		        $articleTemplate.find("a.title").attr("href",data[i].post_url);
		        if(data[i].img_url){
		        	$articleTemplate.find("a.network-thumb").attr("href",data[i].post_url);
		        	$articleTemplate.find("img").attr("src",data[i].img_url).attr("alt",data[i].post_title);
		        }	    
		        		        
		        $articleTemplate.find("a.title").text(data[i].post_title);
		        
		        if (data[i].domain != document.domain) {
		        	$articleTemplate.find(".site a").text(data[i].brand + " Magazine");
		        	$articleTemplate.find(".site a").attr("href","http://" + data[i].domain);

					$articleTemplate.find("a").attr("target","_blank");
				}else{
					$articleTemplate.find(".site a").hide();
				}
				
				$articleTemplate.appendTo("#culture-politics-network").fadeIn();

		    }


		
		});
		
		
		//Survival Network
		var getdata = $.getJSON(survFileName, function(data) {
        		    
		    var count = 0;

		    var end = start + showAtOnce;

		    for (i = start; i < end; i++) {
		        count++;
		
		        
		        var $articleTemplate = $("li#nt-widget-template").clone();

		        $articleTemplate.attr("id","nt-" + data[i].post_name + count);
		        $articleTemplate.find("a.title").attr("href",data[i].post_url);
		        if(data[i].img_url){
		        	$articleTemplate.find("a.network-thumb").attr("href",data[i].post_url);
		        	$articleTemplate.find("img").attr("src",data[i].img_url).attr("alt",data[i].post_title);		        	
		        }	    
		        		        
		        $articleTemplate.find("a.title").text(data[i].post_title);
		        
		        if (data[i].domain != document.domain) {
		        	$articleTemplate.find(".site a").text(data[i].brand + " Magazine");
		        	$articleTemplate.find(".site a").attr("href","http://" + data[i].domain);

					$articleTemplate.find("a").attr("target","_blank");
				}else{
					$articleTemplate.find(".site a").hide();
				}
				
				$articleTemplate.appendTo("#survival-network").fadeIn();

		    }


		
		});


	}





});