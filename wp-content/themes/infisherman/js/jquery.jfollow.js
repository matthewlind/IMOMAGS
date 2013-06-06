// JavaScript Document
(function($){
	$.fn.jfollow = function(follow){
		
		return this.each(function(){
			
			var that = $(this);
			followme = $(follow);	
			followHeight = $('.advert').height() + 320;
			
				var followfn = function(){
					// hide sidebar until scrolling
					//that.css({display: 'none'});
					if($(window).scrollTop() >= followme.offset().top && $(window).scrollTop() < $('#footer').offset().top - followHeight){
							that.css({
							display: 'block',
							position: 'fixed',
							top: 10,
							bottom: '',
							left: followme.offset().left
												
						});
					}else{
					that.css({
							position: '',
							display: 'block',
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


					
					
					
					
					
					
					
					
					
					
					
					
					