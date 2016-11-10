
var popsshown = readCookie("subpopshow");

jQuery(window).scroll(function (event) {
    if(!subsmarketing.scrollpct) return;
    
    var scroll = jQuery(window).scrollTop();
    var scrollpct = parseFloat(subsmarketing.scrollpct);

    if(scroll > (jQuery(document).height() * scrollpct) && popsshown == null){

		jQuery('#subs_popinst').popup({
			transition: 'all 0.3s',
			scrolllock: true,
			blur: false,
			opacity: 0.7,
			autozindex: true,
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
        		
        		jQuery('#subsmodalbtn').on("click", function(e) {
        			e.preventDefault();
        			jQuery('#subs_popinst').popup('hide');
        			
        			jQuery.ajax({ 
						type: "POST",
						datatype:"json", 
						url: "https://securesubs.osgimedia.com/api/mkt/logSubscribe",      
						data: {
							'key':'gh3vd45',
							'offerid':subsmarketing.offerid,
							'pkey': subsmarketing.pkey,
							'btntype': 'popover'
        				},
        				success: function() {
        					//nothing now
        				}
        				
        			});
        			
        			window.open(subsmarketing.orderpage+subsmarketing.pkey);
		  			
				});
			},
			onclose: function() {
				popsshown = 'true';
				
				if(parseInt(subsmarketing.expires)>0) {
					var now = new Date();
					now.setTime(now.getTime() + parseInt(subsmarketing.expires) * 3600 * 1000);
					document.cookie = "subpopshow=true; expires=" + now.toUTCString() + "; path=/";
				}
				//make API call to log close?
			}
		});
		
		jQuery('#subs_popinst').popup('show');

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
