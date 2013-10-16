jQuery(document).ready(function () {
////////////////////////////////////


var colors = new Array();

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
stateAbbrev.DC="district of columbia";
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
stateAbbrev.NH="new hampshire";
stateAbbrev.NJ="new jersey";
stateAbbrev.NM="new mexico";
stateAbbrev.NY="new york";
stateAbbrev.NC="north carolina";
stateAbbrev.ND="north dakota";
stateAbbrev.OH="ohio";
stateAbbrev.OK="oklahoma";
stateAbbrev.OR="oregon";
stateAbbrev.PA="pennsylvania";
stateAbbrev.RI="rhode island";
stateAbbrev.SC="south carolina";
stateAbbrev.SD="south dakota";
stateAbbrev.TN="tennessee";
stateAbbrev.TX="texas";
stateAbbrev.UT="utah";
stateAbbrev.VT="vermont";
stateAbbrev.VA="virginia";
stateAbbrev.WA="washington";
stateAbbrev.WV="west virginia";
stateAbbrev.WI="wisconsin";
stateAbbrev.WY="wyoming";
stateAbbrev.CN="canada";
stateAbbrev.AB="alberta";
stateAbbrev.BC="british columbia";
stateAbbrev.MB="manitoba";
stateAbbrev.NB="new brunswick";
stateAbbrev.NL="newfoundland and labrador";
stateAbbrev.NT="northwest territories";
stateAbbrev.NS="nova scotia";
stateAbbrev.NU="nunavut";
stateAbbrev.ON="ontario";
stateAbbrev.PE="prince edward island";
stateAbbrev.QC="quebec";
stateAbbrev.SK="saskatchewan";
stateAbbrev.YT="yukon";
stateAbbrev.AG="aguascalientes";
stateAbbrev.BJ="baja california";
stateAbbrev.BS="baja california sur";
stateAbbrev.CP="campeche";
stateAbbrev.CH="chiapas";
stateAbbrev.CI="chihuahua";
stateAbbrev.CU="coahuila";
stateAbbrev.CL="colima";
stateAbbrev.DF="distrito federal";
stateAbbrev.DG="durango";
stateAbbrev.GJ="guanajuato";
stateAbbrev.GR="guerrero";
stateAbbrev.HG="hidalgo";
stateAbbrev.JA="jalisco";
stateAbbrev.EM="mexico";
stateAbbrev.MH="michoacán";
stateAbbrev.MR="morelos";
stateAbbrev.NA="nayarit";
stateAbbrev.NL="nuevo león";
stateAbbrev.OA="oaxaca";
stateAbbrev.PU="puebla";
stateAbbrev.QA="querétaro";
stateAbbrev.QA="queretaro";
stateAbbrev.QR="quintana roo";
stateAbbrev.SL="san luis potosi";
stateAbbrev.SI="sinaloa";
stateAbbrev.SO="sonora";
stateAbbrev.TA="tabasco";
stateAbbrev.TM="tamaulipas";
stateAbbrev.TL="tlaxcala";
stateAbbrev.VZ="veracruz";
stateAbbrev.YC="yucatan";
stateAbbrev.ZT="zacatecas";
 
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
	        st[0].style.cursor = "pointer";
		    st[0].onmouseover = function () {
		      st.animate({fill: st.color}, 50);
		      st.toFront();
		      R.safari();
		      jQuery("p.state-name").text(stateAbbrev[state.toUpperCase()]);
		    };
		    var $test = "/" + stateAbbrev[state.toUpperCase()].replace(" ","") + "/";

			jQuery(st[0]).click(function() {
		        jQuery(this).toggleClass('hover_effect');
				window.location = $test;	
			});
			/*jQuery(st[0]).bind('touchstart touchend', function(e) {
			        e.preventDefault();
			        jQuery(this).toggleClass('hover_effect');
					window.location = postURL;
				});*/

			st[0].onmouseout = function () {
		    	colorcode = 1;
		    	st.animate({fill: colors[colorcode]}, 500);
				st.toFront();
				R.safari();
				jQuery("p.state-name").text("");
			};
		               
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



if (jQuery("#us-map-ubermenu-container").length > 0) {

		
	getMapForContainer("us-map-ubermenu-container");
		
	
}
  



////////////////////////////////////
});