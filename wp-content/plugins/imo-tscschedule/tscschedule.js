//jQuery(document).ready(function() {

function makeTonightBar() {
  var day = moment();
  var fday = day.format("YYYY/MM/DD");
  var mday = day.format("ddd,MMM DD");
  mday = mday.split(",");
  
  var deferTonightBarEvents = jQuery.Deferred();
  deferTonightBarEvents.done(function(){
	  jQuery('.tonight-schedule').flexslider({
        animation: "slide",
		animationLoop: false,
		itemWidth: 300,
		itemMargin: 0,
        animationSpeed: 200,
        slideshow: false,
        controlNav: false,   
		directionNav: true
    });
    

  });
  
  var today = moment().format("YYYY/MM/DD");
  var tshows = new Array();
      
  jQuery.each(sdata, function(idx, row) {
        
    jQuery.each(row.Timeslots, function(tidx, tval){
					
      var tslot = tval.src.split(" ");

      if(tval.rdate == today && tval.rtime > "18:30") {
        var ttime = tslot[1].split(":");
        var ohour = ttime[0];
        var shour = ("00"+ohour).slice(-2);
        var smin  = ttime[1].substr(0,2);
        var ampm  = ttime[1].substr(2,2);
        var smhour = (ampm == "PM")? parseInt(shour)+12:shour;
        var mslot = smhour+":"+smin;
    
        tshows.push({"Slot": mslot, "rtime": tval.rtime, "rdate": tval.rdate, "time": ohour+":"+smin, "ampm": ampm, "Show": row});
      }
    });
  });
      
  tshows.sort(function(a,b) { if(a.rtime > b.rtime) return 1;else if(a.rtime < b.rtime) return -1; else return 0 } );
  //console.log(tshows);
		
  var ul = "";
  var lastshow = "";
  var showslots = new Array();
  jQuery.each(tshows, function(tsidx, tsval) {

	var showhour = parseInt(tsval.rtime.substr(0,2));
	var centralhoura = tsval.time.split(":");
	centralhoura[0] = parseInt(centralhoura[0])+1;
	centraltime = centralhoura.join(":");

    ul+= '<li class="tiled-grid-entry clr span_1_of_4 col">'
      +  '<span class="show-time">'+tsval.time+'&nbsp;'+tsval.ampm+' EP</span>'
      +  '<span class="show-title"><a href="/shows/'+tsval.Show.PostName+'">'
      +  tsval.Show.SeriesTitle+'</a></span>'
      +  '</li>';
  });

  jQuery('.tonight-schedule .slides').append(ul);
  
  deferTonightBarEvents.resolve();

}


function makeDayBar() {
  var deferDayBarEvents = jQuery.Deferred();
  deferDayBarEvents.done(function(){
    jQuery('.daybaritem').click(function() {
      var wday = jQuery(this).data('wday').toUpperCase();
      var dayidx = jQuery(this).data('dayidx');
      var rdate = jQuery(this).data('rdate');
      var wshows = new Array();
      
      jQuery.each(sdata, function(idx, row) {
        
        jQuery.each(row.Timeslots, function(tidx, tval){
				
          var tslot = tval.src.split(" ");

          if(tval.rdate == rdate) {
            var ttime = tslot[1].split(":");
            var ohour = ttime[0];
            var shour = ("00"+ohour).slice(-2);
            var smin  = ttime[1].substr(0,2);
            var ampm  = ttime[1].substr(2,2);
            var smhour = (ampm == "PM")? parseInt(shour)+12:shour;
            var mslot = smhour+":"+smin;
			
            wshows.push({"DayID": dayidx, "Slot": mslot, "rtime": tval.rtime, "time": ohour+":"+smin, "ampm": ampm, "Show": row});
          }
        });
      });
      
      wshows.sort(function(a,b) { if(a.rtime > b.rtime) return 1;else if(a.rtime < b.rtime) return -1; else return 0 } );
      
	  jQuery.each(wshows, function(oidx, orow) {
		  var diff = "";
		  if(oidx>0) {
		  	diff = moment(rdate+" "+orow.rtime).diff(moment(rdate+" "+wshows[oidx-1].rtime), "minutes");
		  	wshows[oidx-1].dur = diff;
		  }
	  });
	  //console.log(wshows);

      var sw = "";
      var ptime = "";
      var airnowed = false;
      
      now = moment().tz("America/New_York");

      jQuery.each(wshows, function(sidx, srow) {
        
        var airnow = "";
        var earlier = "";
        var endtime;
        if(srow.DayID=="0") {//alert(now);
          rdate = rdate.replace(/\//g, "-");
          showtime = moment(rdate+"T"+srow.rtime+"-04:00");
          endtime = moment(rdate+"T"+srow.rtime+"-04:00").add("m", parseInt(srow.dur));
          if(now.isAfter(showtime) && now.isBefore(endtime)) {airnow = "Airing Now"}
          if(endtime.isBefore(now)) earlier = "earlier";
        }
        var allnew = (srow.Show.NewEpisode=="YES")? " - All New":"";
		var featimage = "";
		if(srow.Show.FeatImage.indexOf(".jpg")>-1 || srow.Show.FeatImage.indexOf(".png")>-1)
			featimage = '<img src="/wp-content/uploads/'
						+srow.Show.FeatImage+'" alt="" title="" />';
		var plink = '<a href="/shows/'+srow.Show.PostName
					+'/" title="'+srow.Show.SeriesTitle+'">'+srow.Show.SeriesTitle+'</a>';
		
        var showdesc = srow.Show.EpisodeDescription;
        if(showdesc.length > 360) {
	        var bspace = showdesc.indexOf(" ",350);
	        var desc1 = showdesc.substr(0,bspace);
	        var desc2 = showdesc.substr(bspace);
	        showdesc = desc1
	        	+'<a class="read-more-show" href="#">&nbsp;[...more]</a><span class="read-more-content">'
	        	+desc2
	        	+'<a class="read-more-hide" href="#">&nbsp;[less]</a></span>';
        }
        
        sw += '<article class="schedule-content tiled-grid padded-tile clr '+earlier+'">'
           + '<div class="content clr">'
           + '  <div class="left">'
           + '    <span class="time">'+srow.time+' '+srow.ampm.toLowerCase()+'</span>'
           + '    <span class="airing">'+airnow+'</span>'
           + '  </div>'
           + '    <div class="show-content right">'
           + 		featimage
           + '      <h2><a href="#">'+plink+'<span class="all-new">'+allnew+'</span></a></h2>'
           + '      <div class="episode">'+srow.Show.EpisodeTitle+'</div>'
           + '      <div class="episode-description">'+showdesc+'</div>'
           + '    </div>'
           + '  </div>'
           + '</article>';
				
      });
      jQuery('.day').removeClass("active");
      jQuery(this).addClass("active");
      jQuery('#daycontent').html(sw);
      
      jQuery('.schedule').flexslider({
        animation: "slide",
		animationLoop: false,
		itemWidth: 100,
		itemMargin: 5,
        animationSpeed: 200,
        slideshow: false,
        controlNav: false,   
		directionNav: true
      });
            
      jQuery('.read-more-content').addClass('rmhide')
      jQuery('.read-more-show, .read-more-hide').removeClass('rmhide')

      jQuery('.read-more-show').on('click', function(e) {
        jQuery(this).next('.read-more-content').removeClass('rmhide');
        jQuery(this).addClass('rmhide');
        e.preventDefault();
      });

      jQuery('.read-more-hide').on('click', function(e) {
        var p = jQuery(this).parent('.read-more-content');
        p.addClass('rmhide');
        p.prev('.read-more-show').removeClass('rmhide'); // Hide only the preceding "Read More"
        e.preventDefault();
      });

    });
	        
  });

  
    var daylist = "";
	
    for(var i=0; i < 9; i++) {			

      var day = moment().add("days", i)
      var fday = day.format("YYYY/MM/DD");
      var mday = day.format("ddd,MMM DD");
      mday = mday.split(",");
			
      daylist += '<li><div data-wday="'+mday[0]+'" data-dayidx="'+i+'" data-rdate="'+fday+'" '
      if(i==0) daylist += ' id ="firstday"';
      daylist += ' class="day daybaritem';
      if(i==0) daylist += ' active';
      daylist += '" >'+mday[0].toUpperCase()+'<span class="date">'+mday[1]+'</span></div></li>';
			
    }
    jQuery('#daybar').html(daylist);
    deferDayBarEvents.resolve();
   
    deferDayBarEvents.done(function() {
      jQuery('#firstday').trigger("click");
    });
  }    
    
//});
