jQuery(document).ready(function($) {
	
	$(function() {
    	$( "#tabs" ).tabs();
    });
  
	var currentPosition = 0;
	var showAtOnce = 3;
	var sort = "post_date";
	var feedData;

	//Check to see if network-topics-widget exists:
	if ($("#gift-guide").length > 0) {
		//if yes, display some things
		displayCrossSiteFeed(currentPosition);
	}

	
	function displayCrossSiteFeed(start,sort) {
		sort = typeof sort !== 'undefined' ? sort : 'post_date'; //If sort is not set, set sort to post_date		
		 	
		
		//First get any extra term
		var shootTerm = $("#tabs-1").attr("term");
		var huntTerm = $("#tabs-2").attr("term");
		var fishTerm = $("#tabs-3").attr("term");
		
		
	
		var shootFileName = "/wpdb/shooting-network-taxonomy-json.php?term=" + shootTerm + "&taxonomy=campaign";
		var huntFileName = "/wpdb/hunting-network-taxonomy-json.php?term=" + huntTerm + "&taxonomy=campaign";;
		var fishFileName = "/wpdb/fishing-network-taxonomy-json.php?term=" + fishTerm + "&taxonomy=campaign";;
		
		
		//Shoot
		var getdata = $.getJSON(shootFileName, function(data) {
		    var count = 0;
		    var end = start + showAtOnce;
		    
		    for (i = start; i < end; i++) {
		        count++;
		
		        
		        var $articleTemplate = $("li#gg-widget-template").clone();

		        $articleTemplate.attr("id","gg-" + data[i].post_name + count);
		        $articleTemplate.find("a.title").attr("href",data[i].post_url);
		        if(data[i].img_url){
		        	$articleTemplate.find("a.network-thumb").attr("href",data[i].post_url);
		        	$articleTemplate.find("img").attr("src",data[i].img_url).attr("alt",data[i].post_title);
		        }	        
		        $articleTemplate.find("a.title").text(data[i].post_title);
		        
		        if (data[i].domain != document.domain) {
		        	$articleTemplate.find("a.site").text(data[i].brand + " Magazine");
		        	$articleTemplate.find("a.site").attr("href","http://" + data[i].domain);

					$articleTemplate.find("a").attr("target","_blank");
				}else{
					$articleTemplate.find("a.site").hide();
				}
				
				$articleTemplate.prependTo("#tabs-1").fadeIn();

		    }


		
		});
		
		//Hunt
		var getdata = $.getJSON(huntFileName, function(data) {
        		    
		    var count = 0;

		    var end = start + showAtOnce;

		    for (i = start; i < end; i++) {
		        count++;
		
		        
		        var $articleTemplate = $("li#gg-widget-template").clone();

		        $articleTemplate.attr("id","gg-" + data[i].post_name + count);
		        $articleTemplate.find("a.title").attr("href",data[i].post_url);
		        if(data[i].img_url){
		        	$articleTemplate.find("a.network-thumb").attr("href",data[i].post_url);
		        	$articleTemplate.find("img").attr("src",data[i].img_url).attr("alt",data[i].post_title);
		        }	    
		        		        
		        $articleTemplate.find("a.title").text(data[i].post_title);
		        
		        if (data[i].domain != document.domain) {
		        	$articleTemplate.find("a.site").text(data[i].brand + " Magazine");
		        	$articleTemplate.find("a.site").attr("href","http://" + data[i].domain);

					$articleTemplate.find("a").attr("target","_blank");
				}else{
					$articleTemplate.find("a.site").hide();
				}
				
				$articleTemplate.prependTo("#tabs-2").fadeIn();

		    }


		
		});


		//Fish
		var getdata = $.getJSON(fishFileName, function(data) {
        		    
		    var count = 0;

		    var end = start + showAtOnce;

		    for (i = start; i < end; i++) {
		        count++;
		
		        
		        var $articleTemplate = $("li#gg-widget-template").clone();

		        $articleTemplate.attr("id","gg-" + data[i].post_name + count);
		        $articleTemplate.find("a.title").attr("href",data[i].post_url);
		        if(data[i].img_url){
		        	$articleTemplate.find("a.network-thumb").attr("href",data[i].post_url);
		        	$articleTemplate.find("img").attr("src",data[i].img_url).attr("alt",data[i].post_title);
		        }	    
		        		        
		        $articleTemplate.find("a.title").text(data[i].post_title);
		        
		        if (data[i].domain != document.domain) {
		        	$articleTemplate.find("a.site").text(data[i].brand + " Magazine");
		        	$articleTemplate.find("a.site").attr("href","http://" + data[i].domain);

					$articleTemplate.find("a").attr("target","_blank");
				}else{
					$articleTemplate.find("a.site").hide();
				}
				
				$articleTemplate.prependTo("#tabs-3").fadeIn();

		    }


		});
		
		
		

	}





});