jQuery(document).ready(function () {
////////////////////////////////////


var colors = new Array();

colors[8] = "#000000";
colors[7] = "#444444";
colors[6] = "#444444";
colors[5] = "#666666";
colors[4] = "#888888";
colors[3] = "#aaaaaa";
colors[2] = "#cccccc";
colors[1] = "#eeeeee";

var stateAbbrev = new Object();
stateAbbrev.AL="alabama";
stateAbbrev.AK="alaska";
stateAbbrev.AZ="arizona";
stateAbbrev.AR="arkansas";
stateAbbrev.CA="california";
stateAbbrev.CO="colorado";
stateAbbrev.CT="connecticut";
stateAbbrev.DE="delaware";
stateAbbrev.DC="district-of-columbia";
stateAbbrev.FL="florida";
stateAbbrev.GA="georgia";
stateAbbrev.HI="hawaii";
stateAbbrev.ID="idaho";
stateAbbrev.IL="illinois";
stateAbbrev.IN="indiana";
stateAbbrev.IA="iowa";
stateAbbrev.KS="kansas";
stateAbbrev.KY="kentucky";
stateAbbrev.LA="louisiana";
stateAbbrev.ME="maine";
stateAbbrev.MD="maryland";
stateAbbrev.MA="massachusetts";
stateAbbrev.MI="michigan";
stateAbbrev.MN="minnesota";
stateAbbrev.MS="mississippi";
stateAbbrev.MO="missouri";
stateAbbrev.MT="montana";
stateAbbrev.NE="nebraska";
stateAbbrev.NV="nevada";
stateAbbrev.NH="new-hampshire";
stateAbbrev.NJ="new-jersey";
stateAbbrev.NM="new-mexico";
stateAbbrev.NY="new-york";
stateAbbrev.NC="north-carolina";
stateAbbrev.ND="north-dakota";
stateAbbrev.OH="ohio";
stateAbbrev.OK="oklahoma";
stateAbbrev.OR="oregon";
stateAbbrev.PA="pennsylvania";
stateAbbrev.RI="rhode-island";
stateAbbrev.SC="south-carolina";
stateAbbrev.SD="south-dakota";
stateAbbrev.TN="tennessee";
stateAbbrev.TX="texas";
stateAbbrev.UT="utah";
stateAbbrev.VT="vermont";
stateAbbrev.VA="virginia";
stateAbbrev.WA="washington";
stateAbbrev.WV="west-virginia";
stateAbbrev.WI="wisconsin";
stateAbbrev.WY="wyoming";


String.prototype.capitalize = function(){
	return this.replace( /(^|\s)([a-z])/g , function(m,p1,p2){ return p1+p2.toUpperCase(); } );
 };

function getMapForContainer(containerNameString) {
    var R = Raphael(containerNameString),
	  attr = {
	  "fill": "#d3d3d3",
	  "stroke": "#555",
	  "stroke-opacity": "1",
	  "stroke-linejoin": "round",
	  "stroke-miterlimit": "4",
	  "stroke-width": "0.75",
	  "stroke-dasharray": "none"
	  },
    usRaphael = {};
    R.setViewBox(0,0,680,680,false);
    
    //Draw Map and store Raphael paths
    for (var state in usMap) {
		attr.fill = colors[1];
		usRaphael[state] = R.path(usMap[state]).attr(attr);
    }
    
    //Do Work on Map
    for (var state in usRaphael) {
    	usRaphael[state].color = "#333333";
    	
       (function (st, state) {
	       	if(state == "md" || state == "de" || state == "nj" || state == "co" || state == "wy" || state == "id" || state == "ut" || state == "mt" || state == "nv"){
		       	st[0].style.cursor = "cursor";
		       	st[0].style.opacity = "0.3";
	       	}else{
		       	st[0].style.cursor = "pointer";
			    st[0].onmouseover = function () {
					st.animate({fill: st.color}, 50);
					st.toFront();
					R.safari();
					jQuery("p.state-name").text(stateAbbrev[state.toUpperCase()].replace("-"," "));
		       	}
		        
			};
		
			var $region = stateAbbrev[state.toUpperCase()];
			if($region == "connecticut"){$region = "new-england"}
			if($region == "maine"){$region = "new-england"}
			if($region == "massachusetts"){$region = "new-england"}
			if($region == "new-hampshire"){$region = "new-england"}
			if($region == "vermont"){$region = "new-england"}
			if($region == "rhode-island"){$region = "new-england"}
			if($region == "kansas"){$region = "great-plains"}
			if($region == "nebraska"){$region = "great-plains"}
			if($region == "north-dakota"){$region = "great-plains"}
			if($region == "south-dakota"){$region = "great-plains"}
			if($region == "washington"){$region = "washington-oregon"}
			if($region == "oregon"){$region = "washington-oregon"}
			if($region == "arizona"){$region = "rocky-mountain"}
			if($region == "new-mexico"){$region = "rocky-mountain"}
			
			//get the post urls
			var postURL = "/deer-forecast/" + $region + "-deer-forecast-2013/#forecast";

			if(state != "md" || state != "de" || state != "nj" || state != "co" && state != "wy" && state != "id" && state != "ut" && state != "mt" && state != "nv"){
				jQuery(st[0]).click(function(){
					window.location = postURL;
				});
			
			
				st[0].onmouseout = function () {
			    	colorcode = 1;
			    	st.animate({fill: colors[colorcode]}, 500);
					st.toFront();
					R.safari();
					jQuery("p.state-name").text("");
				};
			}           
		})(usRaphael[state], state);
	}
	
	function getStateData(state) {
		var $output = jQuery("<div class='popup-state-data'></div>");
		var report;
		report = 0;
		/*if (stateData[state.toUpperCase()]) {
			currentStateData = stateData[state.toUpperCase()];
			if (currentStateData.report)
				report = currentStateData.report;
			else
				report = 0;
		} else {
			report = 0;
		}*/

		//$output.find("ul").append("<li>" + report + " Rut Reports</li>");
		//console.log("$output");
		//console.log($output);

		$output.prepend("<h2>" + stateAbbrev[state.toUpperCase()].capitalize() + "</h2>");

		return $output;
	}
	
//});

}; //end function getMapForContainer



if (jQuery("#us-map-forecast").length > 0) {

		
	getMapForContainer("us-map-forecast");
		
	
}
  



////////////////////////////////////
});