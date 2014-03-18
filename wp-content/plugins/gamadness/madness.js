	jQuery(window).load(function() {
		jQuery('.ga-madness ul.rounds').css("overflow","visible");
	});
	
	jQuery(document).ready(function($) {
		jQuery('.gun-types select').change(function(){
			var value = jQuery(this).val();
			if(value)
			jQuery('html, body').animate({scrollTop: jQuery("h2#" + value).offset().top}, "slow");
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
				if(ismobile) {
					console.log("debug: .tabs-"+(parseInt(round)-1)+" .mreg"+region);
					jQuery("#tabs-"+(parseInt(round)-1)+" .mreg"+region).html(writeGAMBracket(resp.data));
				}
				else {
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
			}
			
		});

	}
	
	function getStats() {
		jQuery.ajax({
			type: "GET",
			url: "http://www.imoutdoors.com/bracket/getTotalVotes",
			data: {},
			dataType: "json",

			success: function(resp, status, jqxhr) {
				var seed = 123456;
				resp[0].tvotes = parseInt(resp[0].tvotes)+seed;
				var vcount = resp[0].tvotes.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				jQuery(".ga-madness-votestats").html("<strong>Total Votes:</strong><br />"+vcount+"");
			
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
			var activem = parseInt(row.status) == 1;
			
			outp+='<div class="matchup '+((activem)? "activem":"")
				+'" data-mid="'+row.id+'" data-region="'+row.region+'" data-idx="'+i+'">'
				+ '<div class="contender votepop">'
				if(activem) outp+='<div class="action-arrow"></div>';
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
	
	function makeGAMPopup() {
		 		 
		 jQuery(".activem").on("click", function() {
		 	var pdata;
		 	var region = jQuery(this).data("region");
		 	var mid = jQuery(this).data("mid");
		 	var slide = jQuery(this).data("idx");
		 	
		 	jQuery.ajax({
				type: "GET",
				url: "http://www.imoutdoors.com/bracket/getMatches",
				//data: {"format": "json", "round":jQuery(this).data("mid"), "region": "0"},
				data: {"format": "json", "round": "2", "region": region},
				dataType: "json",

				success: function(resp, status, jqxhr) {
					
					pdata = resp.data;
					//console.log(pdata);
					
					jQuery.each(pdata, function(i, row) {
						pdata[i].mid_data_mid = pdata[i].id;
						pdata[i].player1image_img = pdata[i].player1image;
						pdata[i].player2image_img = pdata[i].player2image;
						pdata[i].player1link_href = pdata[i].player1link;
						pdata[i].player2link_href = pdata[i].player2link;
						delete pdata[i].player1link;
						delete pdata[i].player2link;
						
					});
					
					var popads = {
						'handgunsmadness' : 'Laserlyte-GA-MAdness-popup-300x120.jpg',
						'riflesmadness' : 'Burris-GA-MAdness-popup-300x120.jpg',
						'arsmadness' : 'Pelican-GA-MAdness-popup-300x120.jpg',
						'shotgunsmadness' : 'Winchester-GA-MAdness-popup-300x120.jpg'
					}
					
					var campaigns = new Array('handgunsmadness', 'riflesmadness', 'arsmadness', 'shotgunsmadness');
					pdata[0].campaign = campaigns[parseInt(pdata[0].region)-1];
					
					jQuery.magnificPopup.open({
						items: pdata,
						inline: {
		            		markup: jQuery('#tmplGAMpopup').html()
						},
						closeBtnInside: true,
						prependTo: jQuery("#page"),
						alignTop: true,
						fixedContentPos: false,
						fixedBgPos: true,
						gallery: {
							enabled: true,
							preload: [0,0],
							navigateByImgClick: false,
							arrowMarkup: '',
							tPrev: '',
							tNext: ''
						},
						callbacks: {
							markupParse: function(template, values, item) {
								//console.log(item);
								region = parseInt(item.data.region);
								campaign = campaigns[region-1];
								campimg = "/wp-content/themes/gunsandammo/images/ga-madness/"+popads[campaign];
								template.find("#popupsponsor a").html('<img src="'+campimg+'" />');
							},
							open: function() {
								jQuery.magnificPopup.instance.goTo(slide);
								googletag.cmd.push(function() {
									//googletag.setTargeting("camp", pdata[0].campaign);
									googletag.display('div-gpt-ad-1386782139095-3'); 
								});
								jQuery(".next-matchup").on("click", function() {
									jQuery.magnificPopup.instance.next();
										
								});
								
							},
							change: function() {
								var item = jQuery.magnificPopup.instance.currItem;
								//console.log(item);
								setTimeout(function() {
									jQuery(".gunone img, .guntwo img").css({ opacity: 1 });
									var btn1 = '<div class="popup-vote-btn" data-mid="'+item.data.id+'" data-pnum="1">VOTE</div>';
									jQuery("#popvoteon1").html(btn1);
									var btn2 = '<div class="popup-vote-btn" data-mid="'+item.data.id+'" data-pnum="2">VOTE</div>';
									jQuery("#popvoteon2").html(btn2);
									
									jQuery(".popup-vote-btn").on("click", function() {
										logVote(jQuery(this).data("mid"),jQuery(this).data("pnum"));
									});
									jQuery(".next-matchup").hide();
									
									googletag.cmd.push(function() {
										googletag.display('div-gpt-ad-1386782139095-3');
									});
									
								}, 200);
							}	
						}
					});	
				}
		 	});
		 	
		});
	}
	
	function logVote(match, pnum) {

		jQuery.ajax({
			type: "GET",
			url: "http://www.imoutdoors.com/bracket/matchVote",
			data: {"format": "json", "id":match, "voted": pnum},
			dataType: "json",
			success: function(data) {
				var score1 = parseInt(data[0].player1score);
				var score2 = parseInt(data[0].player2score);
				//var scoretot = score1 + score2;
				//var per1 = ((score1/scoretot)*100).toFixed(0);
				//var per2 = ((score2/scoretot)*100).toFixed(0);
				if(pnum=="1") jQuery(".guntwo img").fadeTo("fast", "0.5");
				if(pnum=="2") jQuery(".gunone img").fadeTo("fast", "0.5");
				
				jQuery("#popvoteon1").html('<div class="popvoted '+((pnum=="2")? "popvoted-no":"")+'">'+score1+' Votes</div>');
				jQuery("#popvoteon2").html('<div class="popvoted '+((pnum=="1")? "popvoted-no":"")+'">'+score2+' Votes</div>');
				
				jQuery(".next-matchup").show();
				
			}
		});
	}
	
	

