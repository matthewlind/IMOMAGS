//	console.log("init subsmarketing ", subsmkt_vars);

var popsshown = readCookie("subpopshow");
popsshown = null;

jQuery(window).scroll(function (event) {
    if(!subsmarketing.scrollpct) return;
    
    var scroll = jQuery(window).scrollTop();
    var scrollpct = parseFloat(subsmarketing.scrollpct);
    
    if(scroll > (jQuery(document).height() * scrollpct) && popsshown == null){

		jQuery('#subs_popinst').popup({
			transition: 'all 0.3s',
			scrolllock: true,
			opacity: 0.8,
			onopen: function() {
				//make API call to log views
				jQuery.ajax({ 
					type: "POST",
					datatype:"json", 
					url: "https://securesubs.osgimedia.com/api/mkt/logPopupDislay",      
					data: {
						'key':'gh3vd45',
						'offerid':subsmarketing.offerid,
						'pkey': subsmarketing.pkey
          			}
          		});
			},
			onclose: function() {
				popsshown = 'true';
				document.cookie = "subpopshow=true;expires=1";
				//make API call to log close?
			}
		});
		
		jQuery('#subs_popinst').popup('show');
		jQuery('#subsmodalbtn').on("click", function() {
			//
		});
	}
});

function logPopResponse() {
	
	//we could log clicks, etc
	
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}
