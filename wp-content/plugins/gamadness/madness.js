	jQuery(window).load(function() {
		jQuery('.ga-madness ul.rounds').css("overflow","visible");
	});
	
	jQuery(document).ready(function($) {
		jQuery('.gun-types select').change(function(){
			var value = jQuery(this).val();
			if(value)
			jQuery('html, body').animate({scrollTop: jQuery("h2#" + value).offset().top}, "slow");
		});
		
	    jQuery('body').on("click", "body, .overlay, .jq-close-popup", function(e){
	    	jQuery(".overlay").hide();
	        jQuery(".basic-popup").removeClass("popup-opened");
	        jQuery(".filter-fade-out").removeClass("filter-fade-in");
	        jQuery(".layout-frame").removeClass("filter-popup-opened");
	        jQuery("#wpadminbar, #imo-tophat, .fixed-connect").slideDown();
	        jQuery("#imo-tophat").css({overflow: "visible"});
	        e.preventDefault();
	    });
	
	    jQuery('body').on("click", ".vote-pop, .action-arrow, .rank", function(e){
		    jQuery(".overlay").show();
		    var modalPlacement = jQuery(this).offset().top;
		    jQuery(".basic-popup").css({top: modalPlacement + "px"})
	    	jQuery(".reg-popup").addClass("popup-opened");
	        jQuery(".filter-fade-out").addClass("filter-fade-in");
	        jQuery(".layout-frame").addClass("filter-popup-opened");
	        jQuery("#wpadminbar, #imo-tophat, .fixed-connect").slideUp();
	        jQuery('html, body').animate({scrollTop: jQuery(".basic-popup").offset().top}, "slow");
		    return false;
	    });
	
	});
	
	function getGAMData(region, round) {
		jQuery.ajax({
			type: "GET",
			url: "http://www.imoutdoors.com/bracket/getMatches",
			data: {"format": "json", "round":round, "region": region},
			dataType: "json",

			success: function(resp, status, jqxhr) {
				//console.log(resp.data);

				if(resp.type == "finals"){
					var finalone = {};finalone[0] = resp.data[0];
					var finaltwo = {};finaltwo[0] = resp.data[1];
					var finall   = {};finall[0]   = resp.data[2];

					jQuery(".match61").html(writeGAMBracket(finalone));
					jQuery(".match62").html(writeGAMBracket(finaltwo));
					jQuery(".match63").html(writeGAMBracket(finall));

				}
				else {
					jQuery(".region"+region+" .column"+(parseInt(round)-1)).html(writeGAMBracket(resp.data));
				}
			}
			
		});

	}
	
	function writeGAMBracket(data) {
		var outp = "";
		jQuery.each(data, function(i, row) {
			if(row.player1name == null) row.player1name = "&nbsp;";
			if(row.player2name == null) row.player2name = "&nbsp;";
			if(parseInt(row.status) < 1 && row.player1score == "0") row.player1score = "&nbsp;";
			if(parseInt(row.status) < 1 && row.player2score == "0") row.player2score = "&nbsp;";
			if(row.player1seed == null) row.player1seed = "&nbsp;";
			if(row.player2seed == null) row.player2seed = "&nbsp;";
			var winner = 0;
			if(parseInt(row.status) > 1) {
				winner = (parseInt(row.player1score)>parseInt(row.player2score))? 1:2;
			}
			
			outp+='<div class="matchup">'
				+ '<div class="contender votepop"> '
				if(parseInt(row.status) == 1) outp+='<div class="action-arrow"></div>';
			outp+='<div class="rank rank-top '+((winner==1)?"matchwinner":"")+'">'
				+ '<span>'+row.player1seed+'</span>'
				+ '<div>'+row.player1name+'</div>'
				//+ row.player1score+'</span>'
				+ '</div>'
				+ '<div class="rank rank-bottom '+((winner==1)?"matchwinner":"")+'">'
				+ '<span>'+row.player2seed+'</span>'
				+ '<div>'+row.player2name+'</div>'
				//+ row.player2score+'</span></div>'
				+ '</div>'
				+ '</div>'
				+ '</div>';

		});
		
		return outp;
		
	}

