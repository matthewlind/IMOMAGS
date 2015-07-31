	var madnessround;
	var bracket = 4;
	var popads = [];
	
	
	
	jQuery(window).load(function() {
		jQuery('.ga-madness ul.rounds').css("overflow","visible");
		
	});
	
	jQuery(document).ready(function($) {
		jQuery('.gun-types select').change(function(){
			var value = jQuery(this).val();
			if(value)
				jQuery('html, body').animate({scrollTop: jQuery("h2#" + value).offset().top}, "slow");
		});
		jQuery.ajax({
			type: "GET",
			url: "http://apps.imoutdoors.com/bracket/getActiveRound",
			data: {"format": "json", "bracketid": bracket},
			dataType: "json",
			
			success: function(resp, status, jqxhr) {
				madnessround = resp[0].activeround;
				jQuery('#madtabs').tabs({active: (madnessround - 2)});
			}

		});	
		
				
	});


	function closeInterstitial() {
		jQuery('#popupAD').css('display', 'none');
		jQuery('.next-matchup').hide();
		jQuery('.filler').show();
		jQuery('.mfp-close').css('display', 'block');
	}
	
	function getGAMData(region, round) {
		jQuery.ajax({
			type: "GET",
			url: "http://apps.imoutdoors.com/bracket/getMatches",
			data: {"format": "json", "round":round, "region": region, "bracketid": bracket},
			dataType: "json",

			success: function(resp, status, jqxhr) {
				if(ismobile) {
					if(resp.type == "finals"){
						var finalone = {};finalone[0] = resp.data[0];
						var finaltwo = {};finaltwo[0] = resp.data[1];
						var finall   = {};finall[0]   = resp.data[2];
	
						jQuery(".match186").html(writeGAMBracket(finalone));
						jQuery(".match187").html(writeGAMBracket(finaltwo));
						jQuery(".match188").html(writeGAMBracket(finall));
					}
					else {
						jQuery("#madtabs-"+(parseInt(round)-1)+" .mreg"+region).html(writeGAMBracket(resp.data));
					}
				}
				else {
					if(resp.type == "finals"){
						var finalone = {};finalone[0] = resp.data[0];
						var finaltwo = {};finaltwo[0] = resp.data[1];
						var finall   = {};finall[0]   = resp.data[2];
	
						jQuery(".match186").html(writeGAMBracket(finalone));
						jQuery(".match187").html(writeGAMBracket(finaltwo));
						jQuery(".match188").html(writeGAMBracket(finall));
						
					}
					else {
						jQuery(".region"+region+" .column"+(parseInt(round)-1)).html(writeGAMBracket(resp.data));
					}
				}
			},
			fail: function() {
				//alert("Communication Failure");
				console.log("Communication Failure");
			},
			error: function(jqXHR, textStatus, errorThrown) {
				//alert("error " + errorThrown);
				console.log(errorThrown);
			}
			
		});

	}
	
	function getStats() {
		jQuery.ajax({
			type: "GET",
			url: "http://apps.imoutdoors.com/bracket/getTotalVotes",
			data: {"bracketid":bracket},
			dataType: "json",

			success: function(resp, status, jqxhr) {
				var seed = 123456;
				resp[0].tvotes = parseInt(resp[0].tvotes);
				var vcount = resp[0].tvotes.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				jQuery(".ga-madness-votestats").html("<strong>Total Votes:</strong><br />"+vcount+"");
			
			}
		});		
	}
	
	function autoPopup() {
	   var location = window.location.href;
	   var fullHash = location.split('#')[1];
	   
	   if(typeof(fullHash) != 'undefined') {
	   	var hashNumber = fullHash.substring(5);
	   		
	   	if(jQuery.cookie('isHuman') == "true") {
	   		jQuery("#match"+hashNumber).trigger("click");
		} else {
		   	verifyHuman(hashNumber);
		}
	   }
	   	
	   
	   
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
			var matchclass = "";
			if(parseInt(row.status) == 1) matchclass = "activem";
			if(parseInt(row.status) == 2) matchclass = "closedm";
			
			outp+='<div class="matchup '+matchclass
				+'"id=match'+row.id+' data-mid="'+row.id+'" data-region="'+row.region+'" data-idx="'+i+'" data-round="'+row.round+'">'
				+ '<div class="contender votepop">'
				if(row.status==1) outp+='<div class="action-arrow"></div>';
				if(row.status==2) outp+='<div class="action-closed"></div>';
				
			outp+='<div class="rank rank-top '
				+ ((row.status==2)? ((winner==1)?"matchwinner":"matchloser"):"")+'">'
				//+ '<span>'+row.player1seed+'</span>'
				+ '<div>'+row.player1name+'</div>'
				//+ row.player1score+'</span>'
				+ '</div>'
				+ '<div class="rank rank-bottom '
				+ ((row.status==2)? ((winner==2)?"matchwinner":"matchloser"):"")+'">'
				//+ '<span>'+row.player2seed+'</span>'
				+ '<div>'+row.player2name+'</div>'
				//+ row.player2score+'</span></div>'
				+ '</div>'
				+ '</div>'
				+ '</div>';
		});
		
		return outp;
	}
	
	navigator.sayswho= (function(){
    	var ua= navigator.userAgent, tem, 
		M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*([\d\.]+)/i) || [];
		if(/trident/i.test(M[1])){
        	tem=  /\brv[ :]+(\d+(\.\d+)?)/g.exec(ua) || [];
			return 'IE '+(tem[1] || '');
	    }
		M= M[2]? [M[1], M[2]]:[navigator.appName, navigator.appVersion, '-?'];
		if((tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
		return M.join(' ');
	})();
	
	function removeCookie() {
		jQuery.cookie('isHuman', false);
		grecaptcha.reset();
	}

	function verifyHuman(mid) {
		
		jQuery('#captchaWrapper').css("display","block");
		jQuery('#faded').css("display","block");
		var scroll = jQuery(window).scrollTop();
		jQuery('#captchaWrapper').css('margin-top',scroll);
				
		jQuery("#proceed").on("click", function() {
			jQuery.ajax({
		   	type: "GET",
		   	url: "http://apps.imoutdoors.com/bracket/getHuman",
		   	data: {"captchaResponse": grecaptcha.getResponse()},
		   	dataType: "json",
		   	success: function(data) {
			   		var isHuman = data.success;
			   		if(isHuman) {
				   		jQuery.cookie('isHuman', true, { expires: 1 }); // Cookie expires in one day 
			   			jQuery('#captchaWrapper').css("display","none");
			   			jQuery('#faded').css("display","none");
			   			jQuery('#match'+mid).trigger("click");
			   		}
			   		else {
			   			jQuery('#captchaWrapper').css("display","block");
			   			jQuery('#faded').css("display","block");
			   		}
		   		}
		   });
		}); 		 	
 	}
 	
 	
	function votePopup(pdata, region, mid, round, slide, slidecnt) {
	 	jQuery.ajax({
		type: "GET",
		url: "http://apps.imoutdoors.com/bracket/getMatches",
		//data: {"format": "json", "round":jQuery(this).data("mid"), "region": "0"},
		data: {"format": "json", "round": round, "region": region, "bracketid": bracket},
		dataType: "json",

		success: function(resp, status, jqxhr) {					
			
			pdata = resp.data;
			
			jQuery.each(pdata, function(i, row) {
				pdata[i].mid_data_mid = pdata[i].id;
				pdata[i].player1image_img = pdata[i].player1image;
				pdata[i].player2image_img = pdata[i].player2image;
				pdata[i].player1link_href = pdata[i].player1link;
				pdata[i].player2link_href = pdata[i].player2link;
				delete pdata[i].player1link;
				delete pdata[i].player2link;
				
			});
			
			
			
			var regions = {'1':'Compound', '2':'Crossbows', '3':'Compound', '4':'Crossbows'}
			var roundtitles = {/*'2':'First Round', */'3':'First Round', '4':'Sweet Sixteen', '5':'Elite Eight', '6':'Final Four', '8':'Championship'}
			
			var campaigns = new Array('handgunsmadness', 'riflesmadness', 'arsmadness', 'shotgunsmadness');
			if(parseInt(pdata[0].region) == 5) {
				var fregion = (Math.random() < 0.5)? 1 : 2;
				pdata[0].campaign = campaigns[fregion-1];
			}
			else if(parseInt(pdata[0].region) == 6) {
				var fregion = (Math.random() < 0.5)? 3 : 4;
				pdata[0].campaign = campaigns[fregion-1];
			}
			else if(parseInt(pdata[0].region) == 7) {
				var fregion = 0;
				var rand = Math.random();
				if(rand < 0.25) fregion = 1;
				else if(rand < 0.5) fregion = 2;
				else if(rand < 0.75) fregion = 3;
				else fregion = 4;
				pdata[0].campaign = campaigns[fregion-1];
			}
			else
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
					tNext: '',
					tCounter: '%curr% of %total% '
				},
				callbacks: {
					markupParse: function(template, values, item) {
						region = parseInt(item.data.region);
						round = parseInt(item.data.round);
						//campaign = campaigns[region-1];
						campaign = item.data.campaign;
						
						popads[0] = 'bowning-BoB-popup-358x90.jpg';
						popads[1] = 'carbon-express-BoB-popup-358x90.jpg';
						popads[2] = 'OMP-BoB-popup-358x90.jpg';
						popads[3] = 'realtree-BoB-popup-358x90.jpg';
						popads[4] = 'slash-BoB-popup-358x90.jpg';
						
						var randomInt = Math.floor(Math.random() * 5);
						//console.log("Random Number= " + randomInt);
						//var randomPopad = ;

						
						campimg = "/wp-content/plugins/bowmadness/ads/" + popads[randomInt];
						template.find("#popupsponsor a").html('<img src="'+campimg+'" />');
														
						var roundtitle = roundtitles[round];
						var regiontitle = (round<6)? (regions[region]+": "):"";
						template.find("#popuptitle").html(regiontitle+roundtitle);
					},
					open: function() {
						slidecnt--;
						jQuery.magnificPopup.instance.goTo(slide);
						
						//googletag.cmd.push(function() {
						//	googletag.display('div-gpt-ad-1386782139095-3');
						//});
							
						//var bidadtag = '<script src=http://ad.doubleclick.net/adj/imo.gunsandammo/bracket;'
						//+'camp='+pdata[0].campaign+';sect=;manf=;pos=;page=ga_madness;subs=;sz=300x250;'
						//+'dcopt=;tile=1;ord='+(Math.floor((Math.random()) * 100000000))+'></script>';
						//postscribe('#div-gpt-ad-1386782139095-3',bidadtag);
						
						jQuery(".next-matchup").on("click", function() {
							if(region==6) {
								jQuery("div[data-region='5'][data-idx='0'][data-round='6']").trigger("click");
							}
							else if(slidecnt<(16/(Math.pow(2,(round-1)))))
								jQuery.magnificPopup.instance.next();
							else {
								slidecnt = 0;
								
								if(!jQuery.cookie("slideCount")) {
									jQuery.cookie("slideCount",0,{ expires: 1 }); // Create a cookie that expires in a day
								}
								
								var nextRegion = parseInt(region)+1;
								if(nextRegion == 5) nextRegion = 1;
								
								region = nextRegion.toString();
								jQuery("div[data-region='"+region+"'][data-idx='0'][data-round='"+round+"']").trigger("click");				
							}
						});
						jQuery(".vote-again").on("click", function() {
							jQuery("div[data-mid='63']").trigger("click");
						});
						if(round == 8) {
							jQuery(".next-matchup").html("Vote again &raquo;");
							jQuery(".close-ad").text("Close");
						}

						
					},
					close: function() {
						jQuery.removeCookie('slideCount');	
					},
					change: function() {
						
						
						
						///////////////////////////
						// This change function is what rotates ads when you 
						// go to the next match.  Every X clicks will popup
						// an ad.
						///////////////////////////
						
						
						
						
						var item = jQuery.magnificPopup.instance.currItem;
						slidecnt++;
						
						var incrementedCount = jQuery.cookie("slideCount");
						incrementedCount++;

						jQuery.cookie("slideCount", incrementedCount);
												
						remainder = incrementedCount % 4; // Popup an ad every 4th click
						switch(remainder) {
							case 0:
								waitUntilExists("popupAD",function(){
									jQuery("#popupAD").css("display", "block");	
									
									jQuery(".mfp-close").css("display", "none");
									
									//jQuery('#popupAD').html("Ad should be here<br /><div id='div-gpt-ad-1426097842267-0' style='width:300px; height:250px;'></div> <div class='close-ad' onclick='closeInterstitial();'>Go to the next matchup <span>&raquo;</span></div>");
									
									setTimeout(function() {
										jQuery(".next-matchup").show();
										jQuery('.filler').hide();
									}, 201);						
									
									
								});
								setTimeout(function() {
									//alert('pushing the google ad now');
									googletag.cmd.push(function() {
										googletag.display('div-gpt-ad-1438288024184-0');
									});
									jQuery("#div-gpt-ad-1438288024184-0").css("z-index", "9999");
								}, 500);
								
								break;
							default:
								waitUntilExists("popupAD",function(){
									jQuery("#popupAD").css("display", "none");
									jQuery(".mfp-close").css("display", "block");	
								});
								
						}
						
						region = parseInt(item.data.region);
						campaign = campaigns[region-1];
						
						_gaq.push(['_trackPageview',"/" + window.location.pathname + "/match"+item.data.id]);
						
						setTimeout(function() {
							jQuery(".gunone img, .guntwo img, .gunone h2, .guntwo h2").css({ opacity: 1 });
							var btn1 = '<div class="popup-vote-btn" data-mid="'+item.data.id+'" data-pnum="1">VOTE</div>';
							jQuery("#popvoteon1").html(btn1);
							var btn2 = '<div class="popup-vote-btn" data-mid="'+item.data.id+'" data-pnum="2">VOTE</div>';
							jQuery("#popvoteon2").html(btn2);
							
							jQuery(".popup-vote-btn").on("click", function() {
								logVote(jQuery(this).data("mid"),jQuery(this).data("pnum"));
								//console.log("clicked on " + jQuery(this).data("mid"),jQuery(this).data("pnum"));
							});
							jQuery(".next-matchup").hide();
							jQuery('.filler').show();
							jQuery(".vote-again").hide();
							
							//jQuery('#gpt-ad-1386782139095-3').empty();
							//var bidadtag = '<script src=http:ad.doubleclick.net/adj/imo.gunsandammo/bracket;'
							//+'camp='+campaign+';sect=;manf=;pos=;page=ga_madness;subs=;sz=300x250;'
							//+'dcopt=;tile=1;ord='+(Math.floor((Math.random()) * 100000000))+'></script>';
							//postscribe('#gpt-ad-1386782139095-3',bidadtag);
							
							googletag.cmd.push(function() {
								googletag.display('div-gpt-ad-1386782139095-3');
							});
							
						}, 200);
					}
				}
			});	
		}
 	});
 	}	 	
		
	function makeGAMPopup() {
		 
		 jQuery(".closedm").on("click", function() {
			var pdata;
		 	var region = jQuery(this).data("region");
		 	var mid = jQuery(this).data("mid");
		 	var round = jQuery(this).data("round");
		 	
		 	jQuery.ajax({
				type: "GET",
				url: "http://apps.imoutdoors.com/bracket/getMatches",
				data: {"format": "json", "round":jQuery(this).data("mid"), "region": "0", "bracketid": bracket},
				//data: {"format": "json", "round": "2", "region": region},
				dataType: "json",

				success: function(resp, status, jqxhr) {					
					pdata = resp.data[0];
					pdata.mid_data_mid = pdata.id;
					pdata.player1image_img = pdata.player1image;
					pdata.player2image_img = pdata.player2image;
					pdata.player1link_href = pdata.player1link;
					pdata.player2link_href = pdata.player2link;
					delete pdata.player1link;
					delete pdata.player2link;
					
					var randomInt = Math.floor((Math.random() * 4) + 0);
					var randomPopad = popads[randomInt];

					var regions = {'1':'Compound', '2':'Crossbows', '3':'Compound', '4':'Crossbows'}
					var roundtitles = {'2':'First Round', '3':'Second Round', '4':'Sweet Sixteen', '5':'Elite Eight', '6':'Final Four', '8':'Championship'}
					
					var campaigns = new Array('handgunsmadness', 'riflesmadness', 'handgunsmadness', 'riflesmadness');
					pdata.campaign = campaigns[parseInt(pdata.region)-1];
					
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
							enabled: false
						},
						callbacks: {
							markupParse: function(template, values, item) {
								region = parseInt(item.data.region);
								round = parseInt(item.data.round);
								
								popads[0] = 'GA-MAdness-popup-358x90-burris.jpg';
								popads[1] = 'GA-MAdness-popup-358x90-galco.jpg';
								popads[2] = 'GA-MAdness-popup-358x90-laserlyte.jpg';
								popads[3] = 'GA-MAdness-popup-358x90-pelican.jpg';
								popads[4] = 'GA-MAdness-popup-358x90-winchester.jpg';
								
								var randomInt = Math.floor(Math.random() * 5);
								console.log("Random Number= " + randomInt);
						
								campaign = campaigns[region-1];
								campimg = "/wp-content/plugins/gamadness/ads/enter/" + popads[randomInt];
								template.find("#popupsponsor a").html('<img src="'+campimg+'" />');
																
								var roundtitle = roundtitles[round];
								var regiontitle = (round<6)? (regions[region]+": "):"";
								template.find("#popuptitle").html(regiontitle+roundtitle);
								template.find(".next-matchup").hide();
								jQuery('.filler').show();
								template.find(".vote-again").hide();
								
								var score1 = parseInt(pdata.player1score);
								var score2 = parseInt(pdata.player2score);
								var scoretot = score1 + score2;
								var per1 = ((score1/scoretot)*100).toFixed(0);
								var per2 = ((score2/scoretot)*100).toFixed(0);
								pwin = ((score1>score2)? "1":"2");
								if(pwin=="1") template.find(".guntwo img, .guntwo h2").fadeTo("fast", "0.5");
								if(pwin=="2") template.find(".gunone img, .gunone h2").fadeTo("fast", "0.5");
								
								template.find("#popvoteon1").html('<div class="popvoted '+((pwin=="2")? "popvoted-no":"")+'">'+per1+"% ("+score1+' Votes)</div>');
								template.find("#popvoteon2").html('<div class="popvoted '+((pwin=="1")? "popvoted-no":"")+'">'+per2+"% ("+score2+' Votes)</div>');
							},
							open: function() {

								
								jQuery('#popupAD').remove();
								
								//googletag.cmd.push(function() {
								//	googletag.display('div-gpt-ad-1386782139095-3');
								//});
								//_gaq.push(['_trackPageview',"/" + window.location.pathname + "/match"+pdata.mid_data_mid]);
								//
							}
						}
					});
				}
			 });
		 });
		 		 		  	 
		 jQuery(".activem").on("click", function() {
			 
			
			 
			var pdata;
		 	var region = jQuery(this).data("region");
		 	var mid = jQuery(this).data("mid");
		 	var round = jQuery(this).data("round");
		 	var slide = jQuery(this).data("idx");
		 	var slidecnt = 0;
		 	var yourBrowser = navigator.sayswho;
		 	if(yourBrowser.substring(0,6)=="MSIE 8") {
			 	var msg = "Unfortunately, bracket voting requires a modern web browser.\r\n\r\n"
			 			+ "You need to upgrade your browser in order to continue.";
			 	//alert("Message: " + msg);	
			 	console.log(msg);
		 	}
		 	
		 	// reCAPTCHA 
		 	
		 	if(jQuery.cookie('isHuman') == "true") {
			 	votePopup(pdata, region, mid, round, slide, slidecnt);
		 	} else {
			 	verifyHuman(mid);
		 	}
		 		 	
		 	
		});
		 
	}
	
	function logVote(match, pnum) {
		
		jQuery.ajax({
			type: "GET",
			url: "http://apps.imoutdoors.com/bracket/matchVote",
			data: {"format": "json", "id":match, "voted": pnum, "bracketid": bracket, "madness": madness },
			dataType: "json",
			success: function(data) {
				//console.log("logVote success return = " + data);
				var score1 = parseInt(data[0].player1score);
				var score2 = parseInt(data[0].player2score);

				if(pnum=="1") jQuery(".guntwo img, .guntwo h2").fadeTo("fast", "0.5");
				if(pnum=="2") jQuery(".gunone img, .gunone h2").fadeTo("fast", "0.5");
				
				jQuery("#popvoteon1").html('<div class="popvoted '+((pnum=="2")? "popvoted-no":"")+'">'+score1+' Votes</div>');
				jQuery("#popvoteon2").html('<div class="popvoted '+((pnum=="1")? "popvoted-no":"")+'">'+score2+' Votes</div>');
				
				if(match=="63") {
					jQuery(".vote-again").show();
				}
				else {
					jQuery(".next-matchup").show();
					jQuery('.filler').hide();
				}
			}
		});
	}