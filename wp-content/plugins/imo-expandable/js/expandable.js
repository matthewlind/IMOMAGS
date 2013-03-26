/*** GA MADNESS SUPER AD ***/
jQuery(document).ready(function($) {
	
	//add the super header ad
	//$(".super-ad").insertAfter("header");
	
	if( $(".super-ad").length > 0 ){
		if( $.cookie("expandable") ){
	
			$(".super-ad .expanded").hide();
			$(".super-ad .collapsed").show();
			$(".super-ad .super-ad-exp").show();
		}else{
			$(".super-ad .collapsed").hide();
			$(".super-ad .super-ad-exp").hide();
			$(".super-ad .expanded").show();
			$(".super-ad .super-ad-close").show();
		}
	
			$(".super-ad .super-ad-close").click(function(){
				$.cookie("expandable", 1);
				$(".super-ad div img").slideUp('fast', function() {
					$(".super-ad .super-ad-close").hide();
					$(".super-ad .super-ad-exp").show();
					
					$(this).css("height","70px");
					$(".super-ad .expanded").hide();
					$(".super-ad .collapsed").fadeIn();
					
				});
				
			});
			
			$(".super-ad .super-ad-exp, .super-ad .collapsed img").click(function(){
				//$.removeCookie("expandable");
				$(".super-ad .super-ad-close").show();
				
				$(".super-ad div img").slideDown('fast', function() {
					$(".super-ad .super-ad-exp").hide();
					
					$(this).css("height","276px");
					$(".super-ad .expanded").fadeIn();
					$(".super-ad .collapsed").hide();
					
					});
			});
	
		}
});