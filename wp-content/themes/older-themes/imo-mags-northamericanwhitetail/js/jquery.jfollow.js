// JavaScript Document
(function($){
	$.fn.jfollow = function(follow){
		
		return this.each(function(){
			
			var that = $(this);
			followme = $(follow);	
			followHeight = $('.advert').height() + 100;
			
				var followfn = function(){
					
					if($(window).scrollTop() >= followme.offset().top && $(window).scrollTop() < $('.end-scroll').offset().top - followHeight){
							that.css({
						
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
			
			
			$(window).bind('resize scroll', followfn);
		});
	};
})(jQuery);


					
					
					
					
					
					
					
					
					
					
					
					
					