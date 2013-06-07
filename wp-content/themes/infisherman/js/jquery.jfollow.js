// JavaScript Document
(function($){
	$.fn.jfollow = function(follow){
		
		return this.each(function(){
			
			var that = $(this);
			followme = $(follow);	
			followHeight = $('.advert').height() + 280;
				
				var followfn = function(){
					// hide sidebar until scrolling
					//that.css({display: 'none'});
					if($(window).scrollTop() >= followme.offset().top && $(window).scrollTop() < $('#footer').offset().top - followHeight){
							that.css({
							display: 'block',
							position: 'fixed',
							top: 10,
							left: followme.offset().left
												
						});
					}else{
					that.css({
							position: '',
							top: '',
							left: ''
						});

					};
				};
				
				//use for other sites w/ that dumb fishing dude.
				
				/*var followfn = function(){
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
							display: '',
							position: '',
							top: '',
							bottom: '',
							left: ''
												
						});

					};
				};*/
			
			
			$(window).bind('resize scroll', followfn);
		});
	};
})(jQuery);


					
					
					
					
					
					
					
					
					
					
					
					
					