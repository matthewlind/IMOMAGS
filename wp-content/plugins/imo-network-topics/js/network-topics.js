

jQuery(document).ready(function($) {


	var currentPosition = 0;

	if($("#network-topics-3-col").length > 0){
		var showAtOnce = 3;
	}else{
		var showAtOnce = 10;
	}

	//Check to see if network-topics-widget exists:
	if ($(".network-topics").length > 0 || $(".network-topics-widget").length > 0) {
		//if yes, display some things
		displayCrossSiteFeed(currentPosition);
	}

	function displayCrossSiteFeed(start,sort) {

			sort = typeof sort !== 'undefined' ? sort : 'post_date'; //If sort is not set, set sort to post_date

			var term = "the-guns-network";

			var $sections = $("ul.network-topics");

			$sections.each(function(index){

				var term =  $(this).attr("term") ;


				var URL = "/wpdb/shooting-network-json.php?t=" + term;


				var getdata = $.getJSON(URL, function(data) {
			    var count = 0;
			    var end = start + showAtOnce;

			    for (i = start; i < end; i++) {
			        count++;
					if(data[i].post_title.length > 41){
				        title = jQuery.trim(data[i].post_title).substring(0, 40).split(" ").slice(0, -1).join(" ") + "...";
			        }else{
				        title = data[i].post_title;
			        }

			        var templateString = '<li id="nt-widget-template" style="display:none;"><a class="network-thumb" href="http://www.northamericanwhitetail.deva/2012/03/13/deer-of-the-day-buckeye-brute-alexa-perry/" onclick=""><img src="http://www.handgunsmag.com/files/2013/04/Picking-duty-pistols-190x120.jpg" alt="title" /></a><div class="site"><a href="http://gunsandammo.com" onclick="">www.gunsandammo.com</a></div><a class="title" rel="bookmark" href="http://www.northamericanwhitetail.deva/2012/03/13/deer-of-the-day-buckeye-brute-alexa-perry/" onclick="">Deer of the Day Buckeye Brute, Alexa Perry</a><!-- undefined = magazine/site going to --></li>';

			        var $articleTemplate = $(templateString);

			        $articleTemplate.attr("id","nt-" + data[i].post_name + count);
			        $articleTemplate.find("a.title").attr("href",data[i].post_url);
			        if(data[i].img_url){
			        	$articleTemplate.find("a.network-thumb").attr("href",data[i].post_url);
			        	$articleTemplate.find("img").attr("src",data[i].img_url).attr("alt",title);
			        }
			        $articleTemplate.find("a.title").text(title);

			         if (data[i].domain != document.domain) {
			        	$articleTemplate.find(".site a").text(data[i].brand + " Mag");
			        	$articleTemplate.find(".site a").attr("href","http://" + data[i].domain);

						$articleTemplate.find("a").attr("target","_blank");

					}else{

						$articleTemplate.find(".site a").hide();
					}

					if($("#network-topics-3-col").length > 0){
			        		$articleTemplate.find("a.title,a.network-thumb").attr("onclick","_gaq.push(['_trackEvent','Network Topics','Homepage: "+ data[i].slug +"','" + data[i].post_url + "']);");
			        	}else{
				        	$articleTemplate.find("a.title,a.network-thumb").attr("onclick","_gaq.push(['_trackEvent','Network Topics','Widget: "+ data[i].slug +"','" + data[i].post_url + "']);");
			        	}

					$articleTemplate.appendTo("#" + term).show();

			    }

				jQuery('.'+ term + '-flexslider').flexslider({
					animation: "slide",
					easing: "swing",
			        animationSpeed: 200,
			        slideshow: false,
			        itemWidth: 140,
			        itemMargin: 0,
			        minItems: 2,
			        maxItems: 2

				});

			});

		});
	}
});




