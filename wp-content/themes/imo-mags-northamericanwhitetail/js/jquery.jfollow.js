// JavaScript Document
(function($){
	$.fn.jfollow = function(follow){
		
		return this.each(function(){
			
			var that = $(this);
			followme = $(follow);	
			followHeight = $('.advert').height();
			
				var followfn = function(){
					that.css({display: 'none'});
					if($(window).scrollTop() >= followme.offset().top && $(window).scrollTop() < $('.end-scroll').offset().top - followHeight){
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
			
			
			$(window).bind('resize scroll', followfn);
		});
	};
})(jQuery);


					
					
					
					
					
					
					
					
					
					
					
					
					