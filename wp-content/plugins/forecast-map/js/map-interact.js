jQuery(document).ready(function () {
	
	
	// Quick feature detection
	function isTouchEnabled() {
	 	return (('ontouchstart' in window)
	      	|| (navigator.MaxTouchPoints > 0)
	      	|| (navigator.msMaxTouchPoints > 0));
	}
	
	jQuery(function(){
				addEvent('map_1');
				addEvent('map_2');
				addEvent('map_3');
				addEvent('map_4');
				addEvent('map_5');
				addEvent('map_6');
				addEvent('map_7');
				addEvent('map_8');
				addEvent('map_9');
				addEvent('map_10');
				addEvent('map_11');
				addEvent('map_12');
				addEvent('map_13');
				addEvent('map_14');
				addEvent('map_15');
				addEvent('map_16');
				addEvent('map_17');
				addEvent('map_18');
				addEvent('map_19');
				addEvent('map_20');
				addEvent('map_21');
				addEvent('map_22');
				addEvent('map_23');
				addEvent('map_24');
				addEvent('map_25');
				addEvent('map_26');
				addEvent('map_27');
				addEvent('map_28');
				addEvent('map_29');
				addEvent('map_30');
				addEvent('map_31');
				addEvent('map_32');
				addEvent('map_33');
				addEvent('map_34');
				addEvent('map_35');
				addEvent('map_36');
				addEvent('map_37');
				addEvent('map_38');
				addEvent('map_39');
				addEvent('map_40');
				addEvent('map_41');
				addEvent('map_42');
				addEvent('map_43');
				addEvent('map_44');
				addEvent('map_45');
				addEvent('map_46');
				addEvent('map_47');
				addEvent('map_48');
				addEvent('map_49');
				addEvent('map_50');
				addEvent('map_51');
	})
	
	jQuery(function(){
		//lakes's color and border color
		if(jQuery('#lakes').find('path').eq(0).attr('fill') != 'undefined'){
			jQuery('#lakes').find('path').attr({'fill':map_config['default']['lakescolor']}).css({'stroke':map_config['default']['bordercolor']});
		}
	
		//*//configuration for title text's shadow
		jQuery('.tip').css({
			'box-shadow':'1px 2px 4px '+map_config['default']['namesShadowColor'],
			'-moz-box-shadow':'2px 3px 6px '+map_config['default']['namesShadowColor'],
			'-webkit-box-shadow':'2px 3px 6px '+map_config['default']['namesShadowColor'],
		});
	
		//configuration for map shadow
		if(jQuery('#shadow').find('path').eq(0).attr('fill') != 'undefined'){
			var shadowOpacity = map_config['default']['shadowOpacity'];
			var shadowOpacity = parseInt(shadowOpacity);
			if (shadowOpacity >=100){shadowOpacity = 1;}else if(shadowOpacity <=0){shadowOpacity =0;}else{shadowOpacity = shadowOpacity/100;}
			
			jQuery('#shadow').find('path').attr({'fill':map_config['default']['shadowcolor']}).css({'fill-opacity':shadowOpacity})
		}
	});
	
	function addEvent(id,relationId){
			
		var _obj = jQuery('#'+id);
		var _Textobj = jQuery('#'+id+','+'#'+map_config[id]['namesId']);
		var _h = jQuery('#map').height();
	
		jQuery('#'+map_config[id]['namesId']).find('tspan').attr({'fill':map_config['default']['namescolor']});
	
			_obj.attr({'fill':map_config[id]['upcolor'],'stroke':map_config['default']['bordercolor']});
			_Textobj.attr({'cursor':'default'});
			if(map_config[id]['enable'] == true){
				if (isTouchEnabled()) {
					//clicking effect
					_Textobj.on('touchstart', function(e){
						var touch = e.originalEvent.touches[0];
						var x=touch.pageX-20, y=touch.pageY+(-38);
						var tipw=jQuery('#tip').outerWidth(), tiph=jQuery('#tip').outerHeight(), 
						x=(x+tipw>jQuery(document).scrollLeft()+jQuery(window).width())? x-tipw-(20*2) : x
						y=(y+tiph>jQuery(document).scrollTop()+jQuery(window).height())? jQuery(document).scrollTop()+jQuery(window).height()-tiph-10 : y
						jQuery('#'+id).css({'fill':map_config[id]['downcolor']});
						jQuery('#tip').show().html(map_config[id]['name']);
						jQuery('#tip').css({left:x, top:y})
					})
					_Textobj.on('touchend', function(){
						jQuery('#'+id).css({'fill':map_config[id]['upcolor']});
						if(map_config[id]['target'] == '_blank'){
							if(jQuery(".forecast-map").hasClass("year-2014")){
								window.open(map_config[id]['url']);	
							}else if(jQuery(".forecast-map").hasClass("year-2013")){
								window.open(map_config_2013[id]['url']);	
							}
						}else{
							window.location.href=map_config[id]['url'];
						}
						jQuery('#tip').hide();
					})
				} else {
					_Textobj.attr({'cursor':'pointer'});
					_Textobj.hover(function(){
						//moving in/out effect
						jQuery('#tip').show().html(map_config[id]['name']);
						_obj.css({'fill':map_config[id]['overcolor']})
					},function(){
						jQuery('#tip').hide();
						jQuery('#'+id).css({'fill':map_config[id]['upcolor']});
					})
					//clicking effect
					_Textobj.mousedown(function(){
						jQuery('#'+id).css({'fill':map_config[id]['downcolor']});
					})
					_Textobj.mouseup(function(){
						jQuery('#'+id).css({'fill':map_config[id]['overcolor']});
						if(map_config[id]['target'] == '_blank'){
							if(jQuery(".forecast-map").hasClass("year-2014")){
								window.open(map_config[id]['url']);	
							}else if(jQuery(".forecast-map").hasClass("year-2013")){
								window.open(map_config_2013[id]['url']);	
							}
							
						}else{
							window.location.href=map_config[id]['url'];
						}
					})
					_Textobj.mousemove(function(e){
						var x=e.pageX-20, y=e.pageY+(-38);
						var tipw=jQuery('#tip').outerWidth(), tiph=jQuery('#tip').outerHeight(), 
						x=(x+tipw>jQuery(document).scrollLeft()+jQuery(window).width())? x-tipw-(20*2) : x
						y=(y+tiph>jQuery(document).scrollTop()+jQuery(window).height())? jQuery(document).scrollTop()+jQuery(window).height()-tiph-10 : y
						jQuery('#tip').css({left:x, top:y})
					})
				}
			}	
	}
});