// JavaScript Document
(function($){
	$.fn.jfollow = function(follow){
		
		return this.each(function(){
			
			var that = $(this);
			followme = $(follow);	
			followHeight = $('.advert').height() + 500; //for infish, fishing dude needs more height. that damn fishing dude.
			
				var followfn = function(){
					// hide sidebar until scrolling
					//that.css({display: 'none'});
					
					//scrolling
					if($(window).scrollTop() >= followme.offset().top && $(window).scrollTop() < $('#footer').offset().top - followHeight){
						that.css({
							display: 'block',
							position: 'fixed',
							top: 10,
							left: followme.offset().left
												
						});
					//stop at footer
					}else if($(window).scrollTop() > $('#footer').offset().top - followHeight){
						that.css({
							position: 'absolute',
							top: '',
							bottom: 240,
							left: ''
						});
					//snap back to top 
					}else if($(window).scrollTop() < $('#responderfollow').offset().top){
						that.css({
							display: 'block',
							position: '',
							top: '',
							bottom: '',
							left: ''
												
						});

					};
				};
			
			
			$(window).bind('resize scroll', followfn);
		});
	};
})(jQuery);


					
					
					
					
					
					
					
					
					
					
					
					
					