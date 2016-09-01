(function($) {
////////////////////

var controller,
	flexslider,
	isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;

// Safari specific css.
if (isSafari == true){
	$('head').append('<link rel="stylesheet" href="/wp-content/themes/gunsandammo/remington/css/safari.css" type="text/css" />');
}

// ajax flexslider 
function modal_slider(ele, sn, th) {
	$(ele).flexslider({
		slideshow: false,
		directionNav: true,
		controlNav: false,
		prevText: "",
		nextText: "", 	
		manualControls: th,
		startAt: sn,
		start: function(slider) {
		    // allow all other slides to appear left and right of the main player
		    $(".flexslider").css("overflow","visible");
		    // Other slides are set opaque using jQuery outside of slider instantiation
		    // set start slide to visible
		    var thisSlide = $(parent).get(slider.currentSlide+1);
		    $(thisSlide).find("img").css("opacity","1");
		}
	});
}

window.onload = function() {
	$("#load_anim").fadeOut(500);
	setTimeout(function(){ $("#loading_cover").fadeOut(3000); }, 500)
};


$(document).ready(function() {
	
	$(".lazy").unveil(3500);
	
	var wh 		= $(window).innerHeight(),
		ww 		= $(window).innerWidth(),
		body	= $('body'),
		allDoc 	= $('html, body'),
		scene 	= $('.scene');
		
	
	// MODALS
	//---------------------------------------------//
	var modal_c	= $('.modal-center'),
		modal	= $('.modal');
		
	// Close Modal // using .bind("click touchstart", function()... instead of .click(function()... to make it work on touch devises
	if (ww >= 1100) { 
		$('.i-close, .modal').bind("click touchstart", function() {
			body.removeClass('modal-open');
			modal_c.stop(false, true).animate({ top: 40, opacity: 0 }, 700, function() {});
			modal.fadeOut(400);
			$("#timeline, #next_scene, #menu_rem").fadeIn(400);
		});
	} else {
		$('.i-close').bind("click touchstart", function() {
			body.removeClass('modal-open');
			modal_c.stop(false, true).animate({ top: 40, opacity: 0 }, 700, function() {});
			modal.fadeOut(400);
			$("#timeline, #menu_rem").fadeIn(400);
		});
	}
	
	modal_c.bind("click touchstart", function(e){e.stopPropagation();});
	
	
	// Open Modal
	$(".btn-info").bind("click touchstart", function(){
		var d 		= $(this), 
			sc_num	= d.data("scene"),
			sl_id	= "#slider_"+sc_num,
			sl_num 	= d.data("slide");
			modal 	= (d.hasClass('mri')) ? d.closest('.menu-wrap').find('.modal') : d.closest('.scene').find('.modal'),
			modal_c = modal.find('.modal-center'),
			modal_i = modal.find('.modal-inner'),
			has_sl	= modal.find('.modal-inner > div').attr('id');
		
		body.addClass('modal-open');
			
		if (modal_i[0]) {
			$("#next_scene, #timeline, #menu_rem").fadeOut(400);
			modal.css("display", "flex").hide().fadeIn(500);
			modal_c.stop(false, true).animate({ top: 0, opacity: 1 }, 800, function() {});
			// when you close the modal and then click on other btn-info, it will get you to the slide you chose
			if (has_sl) {
				var slider = $(sl_id).data('flexslider');
				slider.flexAnimate(sl_num);
			}
		} else {
			$.ajax({
				method: "POST",
				url: "/wp-content/themes/gunsandammo/remington/modals/s" + sc_num + ".html",
				cache: false
			})
			.done(function( response ) {
				modal_c.append(response);
				$("#next_scene, #timeline, #menu_rem").fadeOut(400);			
				modal.css("display", "flex").hide().fadeIn(500);
				modal_c.stop(false, true).animate({ top: 0, opacity: 1 }, 800, function() {});
				var slider_el = modal_c.find(".slider");
				if (slider_el[0]) {
					modal_slider(sl_id, sl_num);
				}
			})
			.fail(function() {
				body.removeClass("modal-open");
				d.find("span").append( $("<p/>", {
					text: "Something went wrong",
					style: "color: red;"
				}));
			});
		}
	});
	// END MODALS


	// ARROW ANIMATION
	function arrow_anim(controller, duration){
		var time_arrow	= $("#time_arrow");
		var ta_1816 = TweenMax.to(time_arrow, 1, {y: 87});
		new ScrollScene({
			triggerElement: "#s1828",
			duration: wh*duration[0],
			triggerHook: "onEnter",
			ease: Power0.easeNone
		})
		.setTween(ta_1816).addTo(controller);
		
		var ta_1858 = TweenMax.to(time_arrow, 1, {y: 174});
		new ScrollScene({
			triggerElement: "#next1858",
			duration: wh*duration[1],
			triggerHook: "onLeave",
			ease: Power0.easeNone
		})
		.setTween(ta_1858).addTo(controller);
		
		var ta_1871 = TweenMax.to(time_arrow, 1, {y: 261});
		new ScrollScene({
			triggerElement: "#next1871",
			duration: wh*duration[2],
			triggerHook: "onLeave",
			ease: Power0.easeNone
		})
		.setTween(ta_1871).addTo(controller);
		
		var ta_1905 = TweenMax.to(time_arrow, 1, {y: 350});
		new ScrollScene({
			triggerElement: "#next1905",
			duration: wh*duration[3],
			triggerHook: "onLeave",
			ease: Power0.easeNone
		})
		.setTween(ta_1905).addTo(controller);
		
		var ta_1934 = TweenMax.to(time_arrow, 1, {y: 437});
		new ScrollScene({
			triggerElement: "#next1934",
			duration: wh*duration[4],
			triggerHook: "onLeave",
			ease: Power0.easeNone
		})
		.setTween(ta_1934).addTo(controller);
		
		var ta_1959r = TweenMax.to(time_arrow, 1, {y: 524});
		new ScrollScene({
			triggerElement: "#next1959record",
			duration: wh*duration[5],
			triggerHook: "onLeave",
			ease: Power0.easeNone
		})
		.setTween(ta_1959r).addTo(controller);
		
		var ta_1970 = TweenMax.to(time_arrow, 1, {y: 611});
		new ScrollScene({
			triggerElement: "#next1970",
			duration: wh*duration[6],
			triggerHook: "onLeave",
			ease: Power0.easeNone
		})
		.setTween(ta_1970).addTo(controller);
		
		var ta_1988 = TweenMax.to(time_arrow, 1, {y: 698});
		new ScrollScene({
			triggerElement: "#next1988",
			duration: wh*duration[7],
			triggerHook: "onLeave",
			ease: Power0.easeNone
		})
		.setTween(ta_1988).addTo(controller);
		
		var ta_2011 = TweenMax.to(time_arrow, 1, {y: 785});
		new ScrollScene({
			triggerElement: "#next2011",
			duration: wh*duration[8],
			triggerHook: "onLeave",
			ease: Power0.easeNone
		})
		.setTween(ta_2011).addTo(controller);
	
	}	


	// 1959 RECORD ANIMATION
	var bEye = $(".b-eye"),
		bArm = $(".b-arm"),
		bArmBottom = $(".b-arm-bottom"),
		s4Block = $(".s1959r-block"),
		s4Boom = $(".s1959r-boom"),
		s4BoomBack = $(".s1959r-boom-back"),
		s4Gun = $(".s1959r-gun");
		
	function blockPerish() {
		s4Block.css("display", "none");
		$(".test2").css("background-color", "red");
	}
	function blockAppear() {
		s4Block.css("display", "block");
	}
	
    tlEyes = new TimelineMax({repeat: -1, repeatDelay: 2 });
    tlEyes.to(bEye, 0.2, {display: "none"});
    
    tlArm = new TimelineMax({onComplete: blockPerish, onStart: blockAppear,  repeat: -1, repeatDelay: 1, yoyo:false, delay: 1 });
    tlArm.from(bArm, 0.7, {rotation: 20, transformOrigin: "left top", ease:Back.easeInOut })
    	.from(bArmBottom, 0.5, {rotation: 30, transformOrigin: "10% 95%", ease:Back.easeIn }, 0)
    	.to(s4Gun, 0.1, {x:15, y:15}, 0.9)
    	.to(s4Gun, 0.1, {x:0, y:0}, 1)
    	.to(s4Block, 0.1, {opacity: 1}, 0)
    	.to(s4Block, 0.5, {bottom: "100%", rotation: 70, scale: 1.1, ease:Back.easeIn}, 0)
    	.to(s4Block, 0.7, {bottom: "180%", rotation: 170, scale: 1.4, ease:Back.easeOut}, 0.5)
    	.to(s4Boom, 0.2, {opacity: 0.3, scale: 1.8, marginLeft: "-2%", ease:Back.easeOut}, 1.15)
    	.to(s4Boom, 0.1, {opacity: 0, marginLeft: "-2%", ease:Expo.easeOut}, 1.35)
    	.to(s4Block, 1.2, {bottom: "207%", left: "-200%", opacity: 0, scale: 1.2, rotation: 1000}, 1.2)
		.pause();
		
	function shootAnim(e) {
		if (e.type == "enter") {
			tlEyes.play();
			tlArm.play();
		} else {
			tlEyes.pause();
			tlArm.restart();
			tlArm.pause();
		}
	}
	
	
	// 1871 ANIMATION
	var container1871 = $("#s1871"),
		tl;
	
	function getBullet() {
		var element = $('<img class="bullet" src="/wp-content/themes/gunsandammo/remington/images/1871/bullet.png">'),
			top_rand = Math.floor(Math.random() * (100 - 1) + 1),
			height_rand = Math.floor(Math.random() * 100) + 10,
			delay_rand	= Math.floor(Math.random() * 10),
			left_rand	= Math.floor(Math.random() * 250) + 70, // random between 70-250
			bull_speed	= 10;
			
		if (ww < 470) {
			height_rand = Math.floor(Math.random() * 70) + 5,
			bull_speed	= 5;
		}
		
		container1871.append(element);
		
		var bullet = new TweenMax.fromTo(element, bull_speed,
		    {
		        top: top_rand + "%",
		        height: height_rand + "px",
		        left: -left_rand	+ "%"	    
		    },
		    {
			    top: top_rand + "%",
		        left: '110%',
		        height: height_rand + "px",
		        ease: Power0.easeIn
		    }
		);
		return bullet;
	}
	
	//create a bunch of Bezier tweens and add them to a timeline
	function buildTimeline() {
		tl = new TimelineMax({repeat:300, delay: 0});
		for (i = 0 ; i< 40; i++){
			//start creature animation every 0.17 seconds
			tl.add(getBullet(), i * 0.7);
		}
	}
	
	
	

//-----------------------------------------------------------//
//	
// 						ANIMATION DESKTOP
//
//-----------------------------------------------------------//
// This animation is applied to the desktop size sreens in Chrome and Firefox. Safari animation is the same as on mobile, which is much simpler.
if (ww >= 1100 && isSafari == false) {
	// init controller
	controller = new ScrollMagic();	
	
	// TIMELINE NAVIGATION
	//---------------------------------------------------//
	function timeNav(year, offset, inset) {
		var scroll_el = $("#next_scene").data("next"),
			next_top = $("#"+scroll_el).offset().top,
			target_top = $("#s"+year).offset().top;
		
		if (next_top <= target_top) {
			allDoc.animate({ scrollTop: $("#s"+year).offset().top + wh * offset }, 2, "swing");
		} else {
			allDoc.animate({ scrollTop: $("#s"+year).offset().top - wh * inset }, 2, "swing");
		}	
		$("#s"+year+ " .lazy").trigger("unveil");
	}
	
	$("#c1816").click(function(){ timeNav('1816', 3.3, 1.5); });
	$("#c1856").click(function(){ timeNav('1856', 3, 2); });
	$("#c1867").click(function(){ timeNav('1867', 3, 2); });
	$("#c1875").click(function(){ timeNav('1875', 3, 2); });
	$("#c1933").click(function(){ timeNav('1933', 3, 2); });
	$("#c1959").click(function(){ timeNav('1959', 7, 3); });
	$("#c1966").click(function(){ timeNav('1966', 3, 2.8); });
	$("#c1987").click(function(){ timeNav('1987', 3.6, 2); });
	$("#c2010").click(function(){ timeNav('2010', 4, 3); });
	
	
	// NEXT SCENE BUTTON
	//---------------------------------------------------//
	$("#next_scene").click(function(){
		var scroll_el = $(this).data("next"),
			more = $(this).data("more"),
			backimg = $(this).data("back");
		allDoc.animate({ scrollTop: $("#"+scroll_el).offset().top + wh * more}, 5000, "swing");
	});
	
	var arr_dur_desk = [16, 22, 18, 66, 50, 45, 21, 14, 28];
	arrow_anim(controller, arr_dur_desk);	
	
		
	// Start ==========================================
	
	// Duration ignored / replaced by scene duration now
	var tween1 = TweenMax.to('#army, #start-back-image', 10, {
	    opacity: 0
	});
	var scene1 = new ScrollScene({
	    triggerElement: '#s1816',
	    duration: wh, // How many pixels to scroll / animate 
	    triggerHook: "onEnter"
	})
	.setTween(tween1).addTo(controller);
	
	// Birds ****
	var bird1 = TweenMax.to('#st-b1', 1, {
	    right: '-=47%',
	    top: '-=31%',
	    scale: 2,
	    ease: Linear.easeInOut
	});
	var bird2 = TweenMax.to('#st-b2', 1, {
	    right: '-=17%',
	    top: '-=35%',
	    scale: 1.5,
	    ease: Linear.easeInOut
	});
	var bird3 = TweenMax.to('#st-b3', 1, {
	    right: '-=30%',
	    top: '-=28%',
	    scale: 1.5,
	    ease: Linear.easeInOut
	});
	var bird4 = TweenMax.to('#st-b4', 1, {
	    right: '-=46%',
	    scale: 2.5,
	    ease: Linear.easeInOut
	});
	var bird5 = TweenMax.to('#st-b5', 1, {
	    right: '-=22%',
	    top: '-=18%',
	    scale: 1.5,
	    ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#start",
		triggerHook: "onLeave",
		duration: wh
	})
	.setTween([bird1, bird2, bird3, bird4, bird5]).addTo(controller);
						
	
	// SCENE 1816 
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1816",
		duration: wh * 5.2,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1816").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1828').data('more', 3);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/1828/1828-back.jpg)");
			$("#c1816").css({stroke: "#c14646",r: 13,strokeWidth: 4});
			$("#t1816").css({fill: "#c14646",fontSize: "20px"});
		} else {
			$("#c1816").css({stroke: "#ffffff",r: 11,strokeWidth: 3});
			$("#t1816").css({fill: "#1e3d05",fontSize: "17px"});
		}
	});

	
	// Left Green Bar ****
	var tween2_1 = TweenMax.from('.left-green-bar', 10, {
	    opacity: 0.8,
	    left: "-40%",
	    ease: Power1.easeInOut
	});
	var tween2_3 = TweenMax.from('.in-the-woods', 6, {
	    opacity: 0,
	    right: -50,
	    delay: 4,
	    ease: Power1.easeInOut
	});
	var tween2_3_1 = TweenMax.from('#in-the-woods-guy', 4, {
	    opacity: 0,
	    right: "18%",
	    ease: Power1.easeInOut,
	    delay: 6
	});
	new ScrollScene({
		triggerElement: "#next1816",
		duration: wh * 2,
		triggerHook: "onLeave"
	})
	.setTween([tween2_1, tween2_3, tween2_3_1]).addTo(controller);
	
	// In The Woods Guy 2 ****
	var tween2_3_2 = TweenMax.to('#in-the-woods-guy', 10, {
	    opacity: 0.4,
	    right: "-13%",
	    bottom: "8%",
	    scale: 0.5,
	    ease: Linear.easeInOut,
	});
	var tween2_3_3 = TweenMax.to('#s1816-squirrel', 4, {
	    bottom: "100%",
	    ease: Linear.easeInOut,
	});
	new ScrollScene({
		triggerElement: "#next1816",
		offset: wh * 4.2,
		duration: wh * 1.8,
		triggerHook: "onLeave"
	})
	.setTween([tween2_3_2, tween2_3_3]).addTo(controller);
	
	// Story ****
	var tween2_4 = TweenMax.from('#s1816-story-wrap', 10, {
	    opacity: 0,
	    top: "13%",
	    ease: Linear.easeIn,
	    delay: 1.5
	});
	var btn1816 = TweenMax.from('#s1816 .btn-info', 10, {
	    opacity: 0,
	    scale: 0.5,
	    ease: Linear.easeIn,
	    delay: 1.5
	});
	
	new ScrollScene({
		triggerElement: "#next1816",
		offset: wh * 2.1,
		duration: wh * 1.5,
		triggerHook: "onLeave"
	})
	.setTween([tween2_4, btn1816]).addTo(controller);
	
	
	
	// SCENE 1828 
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1828",
		duration: wh * 5.3,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1828").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1845').data('more', 2.5);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/1845/factory.jpg)");
		}
	});
	
	// Entering
	var s1828_back_img = TweenMax.from('#s1828-back-image', 10, {
	    opacity: 0,
	    ease: Linear.easeInOut
	});
	var s1828_year = TweenMax.from('#year_1828', 10, {
	    opacity: 0,
	    left: 200,
	    ease: Linear.easeInOut,
	    delay: 0.5
	});
	var s1828_text = TweenMax.from('#text_1828', 10, {
	    opacity: 0,
	    bottom: 0,
	    ease: Power2.easeInOut,
	    delay: 1
	});
	var btn1828 = TweenMax.from('#s1828 .btn-info', 10, {
	    opacity: 0,
	    scale: 0.5,
	    ease: Linear.easeInOut,
	    delay: 1
	});
	var st8 = TweenMax.staggerTo('.st8', 3, {
	    stroke: "#ffffff",
	    ease: Power1.easeInOut
	}, -0.5);
	var circles1 = TweenMax.staggerTo('.circle', 3, {
	    fill: "#1E3F14",
	    stroke: "#ffffff",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_text = TweenMax.staggerTo('.st20, #time_arrow', 3, {
	    fill: "#ffffff",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_line1 = TweenMax.to('#line', 3, {
	    stroke: "#ffffff",
	    ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1828",
		duration: wh * 2.5,
		triggerHook: "onLeave"
	})
	.setTween( [s1828_back_img, s1828_year, s1828_text, btn1828, st8, circles1, time_text, time_line1] ).addTo(controller);
	
	// Leaving
	var ls1828_back_img = TweenMax.to('#s1828-back-image', 10, {
	    opacity: 0,
	    ease: Linear.easeInOut
	});
	var ls1828_year = TweenMax.to('#year_1828', 1, {
	    opacity: 0,
	    left: -100,
	    ease: Linear.easeInOut,
	});
	var ls1828_text = TweenMax.to('#text_1828', 1, {
	    opacity: 0,
	    bottom: 0,
	    ease: Power2.easeInOut,
	});
	var lbtn1828 = TweenMax.to('#s1828 .btn-info', 1, {
	    opacity: 0,
	    bottom: '10%',
	    scale: 0.5,
	    ease: Linear.easeInOut,
	});
	var s1845back = TweenMax.from('.s1845-back-image', 10, {
	    opacity: 0,
	    right: '-100%',
	    ease: Linear.easeInOut,
	    delay: 2
	});
	new ScrollScene({
		triggerElement: "#next1828",
		duration: wh*1.5,
		offset: wh * 3.5,
		triggerHook: "onLeave"
	})
	.setTween( [ls1828_back_img, ls1828_year, ls1828_text, lbtn1828, s1845back] ).addTo(controller);
	
	
	
	// SCENE 1845 
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1845",
		duration: wh * 5,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1845").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1856').data('more', 3);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/1856/back.jpg)");
		}
	});
	
	// Entering
	var gun_1845 = TweenMax.from('#gun_1845', 10, {
	    top: "-28%",
	    scale: 1.5,
	    ease: Linear.easeInOut
	});
	var text_wrap_1845 = TweenMax.from('#text_wrap_1845', 10, {
	    opacity: 0,
	    top: "60%",
	    ease: Linear.easeInOut,
	});
	var btn1845 = TweenMax.from('.info-s1845', 5, {
	    opacity: 0,
	    scale: 0.5,
	    ease: Linear.easeInOut,
	    delay: 2.5
	});
	
	new ScrollScene({
		triggerElement: "#next1845",
		offset: -100,
		duration: wh * 2,
		triggerHook: "onLeave"
	})
	.setTween( [gun_1845, text_wrap_1845, btn1845] ).addTo(controller);
	
	var inner1845 = TweenMax.to('#s1845 .elements-inner', 10, {
	    opacity: 0,
	    top: -100,
	    ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1845",
		offset: wh * 3,
		duration: wh * 2,
		triggerHook: "onLeave"
	})
	.setTween(inner1845).addTo(controller);
	

	
	// SCENE 1856 
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1856",
		duration: wh * 5,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1856").addTo(controller)
	.on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1858').data('more', 2.5);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/1858/revolver.jpg)");
			$("#c1856").css({stroke: "#c14646",r: 13,strokeWidth: 4, fill: "#ffffff"});
			$("#t1856").css({fill: "#c14646",fontSize: "20px"});
		} else {
			$("#c1856").css({stroke: "#ffffff",r: 11,strokeWidth: 3, fill: "#1e3d05"});
			$("#t1856").css({fill: "#ffffff",fontSize: "17px"});
		}
	});
	
	// Entering
	var sons_img = TweenMax.staggerFrom('.son', 10, 
		{
		    top: -400,
		    scale: 0.2,
		    ease: Power1.easeInOut
		},
		0.5 
	);
	var year_1856 = TweenMax.from('#year_1856', 4, {
	    opacity: 0,
	    right: 20,
	    ease: Power1.easeInOut,
	    delay: 4
	});
	var txt1856 = TweenMax.from('#h1_1856, #text_1856', 6, {
	    opacity: 0,
	    top: '2%',
	    ease: Power1.easeInOut,
	    delay: 5
	});
	new ScrollScene({
		triggerElement: "#next1856",
		offset: -200,
		duration: wh * 2,
		triggerHook: "onLeave"
	})
	.setTween( [sons_img, year_1856, txt1856] ).addTo(controller);
	var all1856 = TweenMax.staggerTo('#year_1856, .son', 10, {
			opacity: 0,
			rotation: 360,
		    scale: 0.2,
		    ease: Power1.easeInOut
	},1.5 );
	var ltxt1856 = TweenMax.to('#h1_1856, #text_1856', 5, {
	    opacity: 0,
	    delay: 10
	});
	new ScrollScene({
		triggerElement: "#next1856",
		offset: wh * 3,
		duration: wh * 2,
		triggerHook: "onLeave"
	})
	.setTween( [all1856, ltxt1856] ).addTo(controller);
	
	
	// SCENE 1858 
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1858",
		duration: wh * 5,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1858").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1861').data('more', 2);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/1861/civil-war.jpg)");
		}
	});
	
	// Entering
	var all_1858 = TweenMax.staggerFrom('#year_1858, #text_1858', 3, {
		    left: 100,
		    opacity: 0,
		    ease: Linear.easeInOut
	}, 3);
	new ScrollScene({
		triggerElement: "#next1858",
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween(all_1858).addTo(controller);
	
	// Leaving
	var leave_all_1858 = TweenMax.staggerTo('#year_1858, #text_1858', 1, {
		    left: 100,
		    opacity: 0,
		    ease: Linear.easeInOut
	}, 0.5);
	var s1858_back = TweenMax.to('#s1858_back', 2, {
	    width: 0,
	    paddingTop: 0,
	    top: '50%',
	    left: '50%',
	    ease: Linear.easeInOut,
	    delay: 1
	});	
	var s1861_back = TweenMax.from('.s1861-back-image', 5, {
	    opacity: 0,
	    ease: Linear.easeInOut,
	    delay: 2
	});	
	new ScrollScene({
		triggerElement: "#next1858",
		duration: wh * 2,
		offset: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([leave_all_1858, s1858_back, s1861_back]).addTo(controller);
	
	
	
	// SCENE 1861 
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1861",
		duration: wh * 4,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1861").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1865').data('more', 3);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/1865/factory.jpg)");
		}
	});
	
	
	// Entering
	var all_1861 = TweenMax.staggerFrom('#year_1861, #text_1861, #btn_1861', 1, {
	    opacity: 0,
	    ease: Linear.easeInOut
	}, 2);
	new ScrollScene({
		triggerElement: "#next1861",
		offset: -wh /5,
		duration: wh / 4,
		triggerHook: "onLeave"
	})
	.setTween(all_1861).addTo(controller);
	
	// Leaving
	var l_all_1861 = TweenMax.to('#year_1861, #text_1861, #btn_1861', 1, {
	    opacity: 0,
	    ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1861",
		offset: wh*2,
		duration: wh *2,
		triggerHook: "onLeave"
	})
	.setTween(l_all_1861).addTo(controller);
	
	
	// SCENE 1865
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1865",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1865").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1867').data('more', 3);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/1867/UMC.jpg)");
		}
	});
	
	// Entering
	var all_1865 = TweenMax.staggerFrom('#year_1865, #text_1865', 1, {
		top: '29%',
	    opacity: 0,
	    ease: Linear.easeInOut
	}, 1);
	new ScrollScene({
		triggerElement: "#next1865",
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween(all_1865).addTo(controller);
	
	// Leaving
	var l_all_1865 = TweenMax.staggerTo('#year_1865, #text_1865', 1, {
		top: '55%',
	    opacity: 0,
	    ease: Linear.easeInOut
	}, 1);
	var back_1865 = TweenMax.to('#inner_1865', 1, {
	    rotation: 50,
	    top: '-100%',
	    left: '100%',
	    backgroundAttachment: 'initial',
	    delay: 1,
	    ease: Power4.easeIn
	});
	new ScrollScene({
		triggerElement: "#next1865",
		offset: wh*3,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([l_all_1865, back_1865]).addTo(controller);
	
	
	// SCENE 1867
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1867",
		duration: wh * 5,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1867").addTo(controller)
	.on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1871').data('more', 4);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/all/dark.jpg)");
			$("#c1867").css({stroke: "#c14646",r: 13,strokeWidth: 4, fill: "#ffffff"});
			$("#t1867").css({fill: "#c14646",fontSize: "20px"});
		} else {
			$("#c1867").css({stroke: "#ffffff",r: 11,strokeWidth: 3, fill: "#1e3d05"});
			$("#t1867").css({fill: "#ffffff",fontSize: "17px"});
		}
	});

	// Entering
	var inner_1867 = TweenMax.from('#inner_1867', 1, {
	    opacity: 0,
	    ease: Linear.easeInOut
	});
	var all_1867 = TweenMax.staggerFrom('#year_1867, #text_1867, #btn_1867', 1, {
		top: '+=10%',
	    opacity: 0,
	    delay: 2,
	    ease: Linear.easeInOut
	}, 1);
	new ScrollScene({
		triggerElement: "#next1867",
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([all_1867, inner_1867]).addTo(controller);
	
	// Leaving
	var l_all_1867 = TweenMax.to('#year_1867, #text_1867, #btn_1867', 1, {
		top: '-=10%',
	    opacity: 0,
	    ease: Linear.easeInOut
	});
	var back_1867 = TweenMax.to('#inner_1867', 1, {
	    opacity: 0,
	    delay: 1,
	    ease: Power3.easeIn
	});
	new ScrollScene({
		triggerElement: "#next1867",
		offset: wh*3,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([l_all_1867, back_1867]).addTo(controller);
	
	
	
	// SCENE 1871
	//-----------------------------------------------//
	buildTimeline();
	tl.pause();
	
	new ScrollScene({
		triggerElement: "#next1871",
		duration: wh*6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1871")
	.addTo(controller)
	.on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1873').data('more', 3.5);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/all/grey.jpg)");
		}
		e.type == "enter" ? tl.resume() : tl.pause();
	});
	
	var all_1871 = TweenMax.staggerFrom('#year_1871, #text_1871', 1, {
		top: '+=10%',
	    opacity: 0,
	    //delay: 2,
	    ease: Linear.easeInOut
	}, 1);
	
	new ScrollScene({
		triggerElement: "#next1871",
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween(all_1871).addTo(controller);
	
	var back_1871 = TweenMax.to('#back_1871', 1, {
		paddingTop: '150%',
		top: '-100%',
		left: '-25%',
		width: '150%',
	    ease: Power4.easeIn,
	    delay: 0.5
	});
	var l_all_1871 = TweenMax.to('#year_1871, #text_1871', 1, {
		opacity: 0,
	    ease: Power4.easeIn
	});
	new ScrollScene({
		triggerElement: "#next1871",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([back_1871, l_all_1871]).addTo(controller);
	
	
	
	// SCENE 1873
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1873",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1873").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1875').data('more', 3.5);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/1875/1875-back.jpg)");
		}
	});
	
	// Entering
	var inner_1873 = TweenMax.from('#inner_1873', 10, {
	    opacity: 0,
	    delay: 3,
	    ease: Linear.easeInOut
	});
	var year_1873 = TweenMax.from('#year_1873', 10, {
	    opacity: 0,
	    right: '5%',
	    delay: 4,
	    ease: Linear.easeInOut
	});
	var all_1873 = TweenMax.from('#text_1873', 10, {
		top: '+=10%',
	    opacity: 0,
	    delay: 8,
	    ease: Linear.easeInOut
	});
	var st8 = TweenMax.staggerTo('.st8', 5, {
	    stroke: "#1E3F14",
	    ease: Power1.easeInOut
	}, -0.5);
	var circles = TweenMax.staggerTo('.circle', 5, {
	    fill: "#ffffff",
	    stroke: "#1E3F14",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {
	    fill: "#1E3F14",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_line1 = TweenMax.to('#line', 5, {
	    stroke: "#1E3F14",
	    ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1873",
		offset: -wh/2,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([all_1873, year_1873, inner_1873, st8, circles, time_text, time_line1]).addTo(controller);
	
	// Leaving
	var year_1873 = TweenMax.to('#year_1873', 1, {
	    opacity: 0,
	    right: '58%',
	    ease: Linear.easeInOut
	});
	var l_all_1873 = TweenMax.to('#inner_1873, #text_1873', 1, {
		top: '-=10%',
	    opacity: 0,
	    delay: 1,
	    ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1873",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([l_all_1873, year_1873]).addTo(controller);
	
	
	
	// SCENE 1875
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1875",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1875").addTo(controller)
	.on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1905').data('more', 3.5);
			$("#c1875").css({stroke: "#c14646",r: 13,strokeWidth: 4});
			$("#t1875").css({fontSize: "20px"});
		} else {
			$("#c1875").css({stroke: "#1e3d05",r: 11,strokeWidth: 3});
			$("#t1875").css({fill: "#1e3d05",fontSize: "17px"});
		}
	});
	
	// Entering
	var inner_1875 = TweenMax.from('#inner_1875', 1, {
	    opacity: 0,
	    ease: Linear.easeInOut
	});
	var all_1875 = TweenMax.from('#elems_1875', 1, {
	    opacity: 0,
	    top: '5%',
	    delay: 1,
	    ease: Linear.easeOut
	});
	new ScrollScene({
		triggerElement: "#next1875",
		offset: -wh/2,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([all_1875, inner_1875]).addTo(controller);
	
	// Leaving
	var cowboy_1875 = TweenMax.to('#cowboy', 1, {
	    left: '-65%',
	    bottom: '-100%',
	    opacity: 0,
	    scale: 3.5,
	    ease: Power4.easeIn
	});
	var l_all_1875 = TweenMax.to('#elems_1875', 1, {
		top: '-=10%',
	    opacity: 0,
	    delay: 1,
	    ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1875",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([cowboy_1875, l_all_1875]).addTo(controller);
	
	
	
	// SCENE 1905
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1905",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1905").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1906').data('more', 4);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/1906/family.jpg)");
		}
	});
	
	// Entering
	var john = TweenMax.from('#john', 10, {
		left: '-40%',
		rotation: -10,
		bottom: '-10%',
		scale: 0.8,
	    opacity: 0,
	    ease: Back.easeOut.config(0.5)
	});
	var text_1905 = TweenMax.from('#text_1905', 5, {
	    opacity: 0,
	    right: '-=5%',
	    delay: 8,
	    ease: Linear.easeOut
	});
	var btn_1905 = new TweenMax.from('#btn_1905', 3,{
	    scale: 0.5,
	    opacity: 0,
	    delay: 12
	});
	new ScrollScene({
		triggerElement: "#next1905",
		offset: wh/2,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([john, text_1905, btn_1905]).addTo(controller);
	var year_1905 = new TweenMax.from('#year_1905', 9,{
	    right: "-5%",
	    opacity: 0
	});
	new ScrollScene({
		triggerElement: "#next1905",
		offset: -wh/2,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([year_1905]).addTo(controller);
	
	// Leaving
	var john = TweenMax.to('#john', 5, {
		left: '-40%',
		rotation: -10,
		bottom: '-10%',
		scale: 0.8,
	    opacity: 0,
	    ease: Back.easeOut.config(0.5)
	});
	var text_1905 = TweenMax.to('#text_1905', 4, {
	    opacity: 0,
	    right: '-=5%',
	    ease: Linear.easeOut
	});
	var btn_1905 = new TweenMax.to('#btn_1905', 5,{
	    scale: 0.5,
	    opacity: 0
	});
	var year_1905 = new TweenMax.to('#year_1905', 5,{
	    right: "-5%",
	    opacity: 0
	});
	new ScrollScene({
		triggerElement: "#next1905",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([john, text_1905, btn_1905, year_1905]).addTo(controller);

	
	
	// SCENE 1906
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1906",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1906").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1910').data('more', 4);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/all/grey.jpg)");
		}
	});

	// Entering
	var year_1906 = TweenMax.from('#year_1906', 5, {
		top: 0,
		opacity: 0,
	    ease: Linear.easeOut
	});
	new ScrollScene({
		triggerElement: "#next1906",
		offset: -wh/3,
		duration: wh,
		triggerHook: "onLeave"
	})
	.setTween(year_1906).addTo(controller);
	var left_1906 = TweenMax.from('#left_1906', 10, {
		left: '-50vw',
	    ease: Linear.easeOut
	});
	var right_1906 = TweenMax.from('#right_1906', 10, {
		right: '-50vw',
	    ease: Linear.easeOut
	});
	var text_1906 = TweenMax.from('#text_1906', 10, {
		left: '150%',
		delay: 3,
	    ease: Linear.easeOut,
	});
	var video_1906 = TweenMax.from('#video_1906', 10, {
		right: '150%',
		delay: 3,
	    ease: Linear.easeOut
	});
	var btn_1906 = TweenMax.from('#btn_1906', 10, {
		opacity: 0,
		scale: 0.5,
		delay: 7,
	    ease: Linear.easeOut
	});
	new ScrollScene({
		triggerElement: "#next1906",
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([left_1906, right_1906, text_1906, video_1906, btn_1906]).addTo(controller);
	
	// Leaving
	var inner_1906 = TweenMax.to('#inner_1906', 1, {
	    rotation: -50,
	    top: '-100%',
	    left: '-100%',
	    ease: Power4.easeIn
	});
	new ScrollScene({
		triggerElement: "#next1906",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween(inner_1906).addTo(controller);

	
	
	// SCENE 1910
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1910",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1910").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1914').data('more', 4);
		}
	});
	
	// Entering
	var all_1910 = TweenMax.staggerFrom('#year_1910, #h1_1910, #img_1910', 10, {
		top: '+=5%',
		opacity: 0,
	    ease: Linear.easeInOut
	}, 4);
	var bottom_1910 = TweenMax.from('#bottom_1910', 10, {
		bottom: '-=5%',
		opacity: 0,
		delay: 12,
	    ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1910",
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([all_1910, bottom_1910]).addTo(controller);
	
	// Leaving
	var lall_1910 = TweenMax.staggerTo('#year_1910, #h1_1910, #img_1910', 10, {
		top: '-=5%',
		opacity: 0,
	    ease: Linear.easeInOut
	}, 4);
	var bottom_1910 = TweenMax.to('#bottom_1910', 10, {
		bottom: '+=5%',
		opacity: 0,
		delay: 12,
	    ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1910",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([lall_1910, bottom_1910]).addTo(controller);
	
	
	
	// SCENE 1914
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1914",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1914").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1917').data('more', 4);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/all/dark.jpg)");
		}
	});

	// Entering
	var year_1914 = TweenMax.from('#year_1914', 5, {
		right: '-=10%',
		opacity: 0,
	    ease: Linear.easeInOut
	});
	var top_1914 = TweenMax.from('#top_1914', 5, {
		top: '-=55%',
		rotation: -20,
		opacity: 0,
		delay: 2,
	    ease: Linear.easeInOut
	});
	var bottom_1914 = TweenMax.from('#bottom_1914', 5, {
		bottom: '-=45%',
		scale: 2,
		opacity: 0.5,
		delay: 4,
	    ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1914",
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([top_1914, bottom_1914, year_1914]).addTo(controller);
	
	// Leaving
	var all_1914 = TweenMax.to('#inner_1914', 5, {
		opacity: 0,
	    ease: Linear.easeInOut
	});

	new ScrollScene({
		triggerElement: "#next1914",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween(all_1914).addTo(controller);
	
	
	
	// SCENE 1917
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1917",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1917").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1918').data('more', 3.5);
		}
	});

	// Entering
	var cover_sheets = TweenMax.staggerTo('#cover_sheets li', 5, {
		transformPerspective:3000,
		rotationY:90,
		opacity: 0.5
	}, 3);
	var cover_sheets2 = TweenMax.to('#cover_sheets', 1, {
		zIndex: 5,
		delay: 20
	});
	var st8 = TweenMax.staggerTo('.st8', 5, {
	    stroke: "#ffffff",
	    ease: Power1.easeInOut
	}, -0.5);
	var circles = TweenMax.staggerTo('.circle', 5, {
	    fill: "#1E3F14",
	    stroke: "#ffffff",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {
	    fill: "#ffffff",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_line1 = TweenMax.to('#line', 5, {
	    stroke: "#ffffff",
	    ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1917",
		offset: wh/8,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([cover_sheets, cover_sheets2, st8, circles, time_text, time_line1]).addTo(controller);
	
	// Leaving
	var all_1917 = TweenMax.staggerTo('#year_1917, #text_1917', 5, {
		opacity: 0,
		top: '-=15%',
	    ease: Linear.easeInOut
	}, 2);
	new ScrollScene({
		triggerElement: "#next1917",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween(all_1917).addTo(controller);
	
	
	// SCENE 1918
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1918",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1918").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1922').data('more', 3.5);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/all/grey.jpg)");
		}
	});
	
	// Entering
	var left_1918 = TweenMax.from('#left_1918', 5, {
		left: '-5%',
		opacity: 0,
		ease: Linear.easeInOut
	});
	var right_1918 = TweenMax.from('#right_1918', 5, {
		right: 0,
		opacity: 0,
		ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1918",
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([left_1918, right_1918]).addTo(controller);
	
	// Leaving
	var lleft_1918 = TweenMax.to('#left_1918', 5, {
		left: '-5%',
		opacity: 0,
	    ease: Linear.easeInOut
	});
	var lright_1918 = TweenMax.to('#right_1918', 5, {
		right: 0,
		opacity: 0,
		ease: Linear.easeInOut
	});
	var l_1918 = TweenMax.to('#l_1918', 5, {
		left: '-50vw',
		delay: 3,
	    ease: Linear.easeInOut
	});
	var r_1918 = TweenMax.to('#r_1918', 5, {
		right: '-50vw',
		delay: 3,
		ease: Linear.easeInOut
	});
	var st8 = TweenMax.staggerTo('.st8', 5, {
	    stroke: "#1E3F14",
	    ease: Power1.easeInOut
	}, -0.5);
	var circles = TweenMax.staggerTo('.circle', 5, {
	    fill: "#ffffff",
	    stroke: "#1E3F14",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {
	    fill: "#1E3F14",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_line1 = TweenMax.to('#line', 5, {
	    stroke: "#1E3F14",
	    ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1918",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([lleft_1918, lright_1918, l_1918, r_1918, st8, circles, time_text, time_line1]).addTo(controller);
	
	
	
	// SCENE 1922
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1922",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1922").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1927').data('more', 3.5);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/all/grey.jpg)");
		}
	});
	
	// Entering
	var img_1922 = TweenMax.from('#img_1922', 5, {
		right: '-40%',
		rotation: -40,
		opacity: 0,
		ease: Linear.easeInOut
	});
	var left_1922 = TweenMax.from('#left_1922', 5, {
		left: 0,
		opacity: 0,
		delay: 5,
		ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1922",
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([img_1922, left_1922]).addTo(controller);
	
	// Leaving
	var img_1922 = TweenMax.to('#img_1922', 5, {
		right: '-40%',
		rotation: 40,
		opacity: 0,
		ease: Linear.easeInOut
	});
	var left_1922 = TweenMax.to('#left_1922', 5, {
		left: 0,
		opacity: 0,
		ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1922",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([img_1922, left_1922]).addTo(controller);	
	
	
	
	// SCENE 1927
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1927",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1927").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1933').data('more', 3.5);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/1933/back.jpg)");
		}
	});
	
	// Entering
	var img_1927 = TweenMax.from('#img_1927', 5, {
		right: '-40%',
		rotation: -40,
		opacity: 0,
		ease: Linear.easeInOut
	});
	var left_1927 = TweenMax.from('#left_1927', 5, {
		left: 0,
		opacity: 0,
		delay: 5,
		ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1927",
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([img_1927, left_1927]).addTo(controller);
	
	// Leaving
	var img_1927 = TweenMax.to('#img_1927', 5, {
		right: '-40%',
		rotation: 40,
		opacity: 0,
		ease: Linear.easeInOut
	});
	var left_1927 = TweenMax.to('#left_1927', 5, {
		left: 0,
		opacity: 0,
		ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1927",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([img_1927, left_1927]).addTo(controller);	
	
	

	// SCENE 1933
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1933",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1933").addTo(controller)
	.on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1934').data('more', 3.5);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/all/dark.jpg)");
			$("#c1933").css({stroke: "#c14646",r: 13,strokeWidth: 4});
			$("#t1933").css({fill: "#c14646",fontSize: "20px"});
		} else {
			$("#c1933").css({stroke: "#ffffff",r: 11,strokeWidth: 3});
			$("#t1933").css({fill: "#ffffff",fontSize: "17px"});
		}
	});
	
	
	// Entering
	var top_1933 = TweenMax.from('#top_1933', 5, {
		top: '-=10%',
		opacity: 0,
		ease: Linear.easeInOut
	});
	var img_1933 = TweenMax.from('#img_1933', 5, {
		bottom: '-20%',
		opacity: 0,
		scale: 1.5,
		delay: 4,
		ease: Linear.easeInOut
	});
	var btn_1933 = TweenMax.from('#btn_1933', 5, {
		opacity: 0,
		scale: 0.5,
		delay: 7,
		ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1933",
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([top_1933, img_1933, btn_1933]).addTo(controller);
	
	// Leaving
	var top_1933 = TweenMax.to('#top_1933', 5, {
		top: '-=10%',
		opacity: 0,
		ease: Linear.easeInOut
	});
	var img_1933 = TweenMax.to('#img_1933', 5, {
		rotation: 360,
		opacity: 0,
		scale: 2,
		delay: 4,
		ease: Power1.easeIn
	});
	var btn_1933 = TweenMax.to('#btn_1933', 5, {
		opacity: 0,
		scale: 0.5,
		delay: 1,
		ease: Linear.easeInOut
	});
	var st8 = TweenMax.staggerTo('.st8', 5, {
	    stroke: "#ffffff",
	    ease: Power1.easeInOut
	}, -0.5);
	var circles = TweenMax.staggerTo('.circle', 5, {
	    fill: "#1E3F14",
	    stroke: "#ffffff",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {
	    fill: "#ffffff",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_line1 = TweenMax.to('#line', 5, {
	    stroke: "#ffffff",
	    ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1933",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([top_1933, img_1933, btn_1933, st8, circles, time_text, time_line1]).addTo(controller);	
	
	
	
	// SCENE 1934
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1934",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1934").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1940').data('more', 3.5);
		}
	});
	
	// Entering
	var img_1934 = TweenMax.from('#img_1934', 5, {
		opacity: 0,
		left: '-=10%',
		ease: Linear.easeInOut
	});
	var all_1934 = TweenMax.staggerFrom('#text_1934, #full_1934, #year_1934, #btn_1934', 5, {
		opacity: 0,
		left: '+=30%',
		delay: 3,
		ease: Linear.easeInOut
	}, 2);
	new ScrollScene({
		triggerElement: "#next1934",
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([img_1934, all_1934]).addTo(controller);
	
	// Leaving
	var img_1934 = TweenMax.to('#img_1934', 5, {
		opacity: 0,
		left: '-=10%',
		ease: Linear.easeInOut
	});
	var all_1934 = TweenMax.staggerTo('#text_1934, #full_1934, #year_1934, #btn_1934', 5, {
		opacity: 0,
		left: '+=30%',
		ease: Linear.easeInOut
	}, 2);
	new ScrollScene({
		triggerElement: "#next1934",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([img_1934, all_1934]).addTo(controller);
	
	
	
	// SCENE 1940
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1940",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1940").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1941').data('more', 4);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/all/grey.jpg)");
		}
	});
	
	// Entering
	var year_1940 = TweenMax.from('#year_1940', 10, {
		opacity: 0,
		right: '-=10%',
		delay: 8,
		ease: Linear.easeInOut
	});
	var top_1940 = TweenMax.from('#top_1940', 10, {
		opacity: 0,
		top: '-=10%',
		ease: Linear.easeInOut
	});
	var img_1940 = TweenMax.from('#img_1940', 10, {
		rotation: 360,
		scale: 0,
		delay: 18,
		ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1940",
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([year_1940, top_1940, img_1940]).addTo(controller);
	
	// Leaving
	var inner_1940 = TweenMax.to('#inner_1940', 5, {
		rotation: 40,
		top: '-100%',
		left: '100%',
		ease: Power4.easeIn
	});
	var st8 = TweenMax.staggerTo('.st8', 5, {
	    stroke: "#1E3F14",
	    ease: Power1.easeInOut
	}, -0.5);
	var circles = TweenMax.staggerTo('.circle', 5, {
	    fill: "#ffffff",
	    stroke: "#1E3F14",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {
	    fill: "#1E3F14",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_line1 = TweenMax.to('#line', 5, {
	    stroke: "#1E3F14",
	    ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1940",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([inner_1940, st8, circles, time_text, time_line1]).addTo(controller);	
	
	
	
	// SCENE 1941
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1941",
		duration: wh * 8,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1941").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1950').data('more', 4);
		}
	});

	// Entering
	var year_1941 = TweenMax.from('#year_1941', 10, {
		opacity: 0,
		right: '-=10%',
		ease: Linear.easeInOut
	});
	var img_1941 = TweenMax.from('#img_1941', 10, {
		rotation: -40,
		scale: 0.6,
		left: '-70%',
		bottom: '-5%',
		delay: 4,
		ease: Back.easeOut.config(1.04)
	});
	var text_1941 = TweenMax.from('#text_1941', 5, {
		opacity: 0,
		marginTop: '-=10%',
		delay: 12,
		ease: Linear.easeInOut
	});
	var full_1941 = TweenMax.from('#full_1941', 5, {
		opacity: 0,
		marginTop: '-=10%',
		delay: 15,
		ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1941",
		duration: wh*4,
		triggerHook: "onLeave"
	})
	.setTween([year_1941, full_1941, img_1941, text_1941]).addTo(controller);
	
	// Leaving
	var lyear_1941 = TweenMax.to('#year_1941', 5, {
		opacity: 0,
		right: '-=10%',
		ease: Linear.easeInOut
	});
	var limg_1941 = TweenMax.to('#img_1941', 10, {
		rotation: -40,
		scale: 0.6,
		left: '-70%',
		bottom: '-5%',
		ease: Back.easeOut.config(1.04)
	});
	var ltext_1941 = TweenMax.to('#text_1941', 5, {
		opacity: 0,
		marginTop: '-=10%',
		ease: Linear.easeInOut
	});
	var lfull_1941 = TweenMax.to('#full_1941', 5, {
		opacity: 0,
		marginTop: '-=10%',
		ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1941",
		offset: wh*5,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([lyear_1941, lfull_1941, limg_1941, ltext_1941]).addTo(controller);		
	
	
	
	// SCENE 1950
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1950",
		duration: wh * 8,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1950").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1956').data('more', 4);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/all/dark.jpg)");
		}
	});

	// Entering
	var top_1950 = TweenMax.staggerFrom('#top_1950, #bottom_1950', 10, {
		opacity: 0,
		marginTop: '-3%',
		delay: 5,
		ease: Power1.easeInOut
	}, 6);
	var year_1950 = TweenMax.from('#year_1950', 8, {
		opacity: 0,
		right: '-=10%',
		ease: Linear.easeInOut
	});
	
	new ScrollScene({
		triggerElement: "#next1950",
		duration: wh*4,
		triggerHook: "onLeave"
	})
	.setTween([top_1950, year_1950]).addTo(controller);
	
	// Leaving
	var back_1950 = TweenMax.to('#back_1950', 10, {
		paddingTop: '150%',
		top: '-100%',
		left: '-25%',
		width: '150%',
	    ease: Power4.easeIn
	});
	var st8 = TweenMax.staggerTo('.st8', 5, {
	    stroke: "#ffffff",
	    ease: Power1.easeInOut
	}, -0.5);
	var circles = TweenMax.staggerTo('.circle', 5, {
	    fill: "#1E3F14",
	    stroke: "#ffffff",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {
	    fill: "#ffffff",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_line1 = TweenMax.to('#line', 5, {
	    stroke: "#ffffff",
	    ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1950",
		offset: wh*5,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([back_1950, st8, circles, time_text, time_line1]).addTo(controller);	
	
	
	// SCENE 1956
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1956",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1956").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1959').data('more', 6);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/1959/two-men.jpg)");
		}
	});

	// Entering
	var top_1956 = TweenMax.from('#top_1956', 10, {
		opacity: 0,
		left: '+=10%',
		ease: Power1.easeInOut
	});
	var bottom_1956 = TweenMax.from('#bottom_1956', 10, {
		opacity: 0,
		left: '-=10%',
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1956",
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([top_1956, bottom_1956]).addTo(controller);
	
	// Leaving
	var ltop_1956 = TweenMax.to('#top_1956', 10, {
		opacity: 0,
		left: '-=10%',
		ease: Power1.easeInOut
	});
	var lbottom_1956 = TweenMax.to('#bottom_1956', 10, {
		opacity: 0,
		left: '+=10%',
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1956",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([ltop_1956, lbottom_1956]).addTo(controller);	
	
	
						
	// SCENE 1959 
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1959",
		duration: wh * 10,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1959").addTo(controller)
	.on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1959r').data('more', 4);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/all/dark.jpg)");
			$("#c1959").css({stroke: "#c14646", fill: "#ffffff", r: 13,strokeWidth: 4});
			$("#t1959").css({fill: "#c14646",fontSize: "20px"});
		} else {
			$("#c1959").css({stroke: "#ffffff", fill: "#1E3F14", r: 11,strokeWidth: 3});
			$("#t1959").css({fill: "#ffffff",fontSize: "17px"});
		}
	});
	
	var s1959_inner = TweenMax.from('#s1959_inner', 10, {
	    opacity: 0,
	    ease: Linear.easeInOut
	});
	var s1959_year = TweenMax.from('#s1959_year', 10, {
	    marginTop: "-17%",
	    scale: 0.4,
	    delay: 5,
	    ease: Linear.easeInOut
	});
	var s1959_info = TweenMax.from('#s1959_info', 10, {
	    top: "40%",
	    opacity: 0,
	    delay: 10,
	    ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1959",
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([s1959_inner, s1959_year, s1959_info]).addTo(controller);
	
	var s1959_gun = TweenMax.from('#s1959_gun', 10, {
	    top: "250%",
	    scale: 2,
	    ease: Linear.easeInOut
	});
	var s1959_h1 = TweenMax.from('#s1959_h1', 10, {
	    right: "58%",
	    opacity: 0,
	    delay: 5,
	    ease: Linear.easeInOut
	});
	var bracket_box = TweenMax.from('#bracket_box', 10, {
	    left: "55%",
	    opacity: 0,
	    delay: 8,
	    ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1959",
		offset: wh * 2,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([s1959_gun, s1959_h1, bracket_box]).addTo(controller);

	// .bracket-left ****
	var bracket_left = TweenMax.from('#bracket_left', 1, {
	    rotation: 360,
	    opacity: 0,
	    scale: 2,
	    ease: Linear.easeInOut
	});
	
	// bracket-right ****
	var bracket_right = TweenMax.from('#bracket_right', 1, {
	    rotation: "-360",
	    opacity: 0,
	    scale: 2,
	    ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1959",
		offset: wh * 4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([bracket_left, bracket_right]).addTo(controller);
	var bottom_1959 = TweenMax.from('#bottom_1959', 1, {
	    marginTop: '10%',
	    opacity: 0,
	    ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1959",
		offset: wh * 4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween(bottom_1959).addTo(controller);
	
	// Leaving
	var ls1959_info = TweenMax.to('#s1959_info', 10, {
	    marginTop: "10%",
	    opacity: 0,
	    ease: Linear.easeInOut
	});
	var bottom_1959 = TweenMax.to('#bottom_1959', 10, {
	    marginTop: '10%',
	    opacity: 0,
	    ease: Linear.easeInOut
	});
	var ls1959_year = TweenMax.to('#s1959_year', 10, {
	    marginTop: "8%",
	    opacity: 0,
	    ease: Linear.easeInOut
	});
	var ls1959_inner = TweenMax.to('#s1959_inner', 0.1, {
	    backgroundAttachment: "scroll",
	    ease: Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1959",
		offset: wh * 7,
		duration: wh,
		triggerHook: "onLeave"
	})
	.setTween([ls1959_info, ls1959_year, bottom_1959, ls1959_inner]).addTo(controller);
	
	
	
	
	// SCENE 1959r 
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1959record",
		duration: wh * 8,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1959r").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1960').data('more', 4);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/all/dark.jpg)");
		}
	});
	
	// .record-photo ****
	var tween4 = TweenMax.from('.record-photo', 10, {
	    top: "238%",
	    rotation: "32",
	    scale: 1.2,
	    ease:Back.easeOut.config(1.1)
	});
	new ScrollScene({
		triggerElement: "#next1959record",
		offset: 150,
		duration: wh * 3,
		triggerHook: "onLeave"
	})
	.setTween(tween4).addTo(controller);
	
	// .record-photo ****
	var tween4_1 = TweenMax.from('.s1959r-info', 10, {
	    right: "1%",
	    opacity: 0,
	    ease:Linear.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1959record",
		offset: wh * 0.9,
		duration: wh * 2,
		triggerHook: "onLeave"
	})
	.setTween(tween4_1).addTo(controller);
	
	// .berry and .tom ****
	var tween4_2 = TweenMax.staggerFrom('.s1959r-person', 10, {
	    bottom: "-60%",
	    ease:Back.easeOut
	}, 0.25);
	new ScrollScene({
		triggerElement: "#next1959record",
		offset: wh,
		duration: wh * 2,
		triggerHook: "onLeave"
	})
	.setTween(tween4_2).addTo(controller);
	
	var tween4_2 = TweenMax.from('.b-eye', 10, {
	    opacity: 0,
	    ease:Linear.easeOut
	}, 0.25);
	new ScrollScene({
		triggerElement: "#next1959record",
			offset: wh,
			duration: wh * 2,
		triggerHook: "onLeave"
	})
	.setTween(tween4_2).addTo(controller);
			
	new ScrollScene({
		triggerElement: "#next1959record", 
		offset: wh * 1.9,
		duration: wh * 2.5,
		triggerHook: "onLeave"
	})
	.addTo(controller)
	.on("enter leave", shootAnim);
		
	
	
	// SCENE 1960
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1960",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1960").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1962').data('more', 4);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/1962/back.jpg)");
		}
	});
	var left_1960 = TweenMax.staggerFrom('#text_1960, #full_1960, #year_1960', 10, {
		opacity: 0,
		right: '-=10%',
		delay: 5,
		ease: Power1.easeInOut
	}, 2);
	var img_1960 = TweenMax.from('#img_1960', 10, {
		opacity: 0,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1960",
		duration: wh*4,
		triggerHook: "onLeave"
	})
	.setTween([left_1960, img_1960]).addTo(controller);


	// SCENE 1962
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1962",
		duration: wh * 8,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1962").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1963').data('more', 4);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/1963/dogs.jpg)");
		}
	});

	// Entering
	var year_1962 = TweenMax.from('#year_1962', 10, {
		opacity: 0,
		right: '-=10%',
		ease: Power1.easeInOut
	});
	var text_1962 = TweenMax.from('#text_1962', 10, {
		rotation: 75,
		bottom: '100%',
		left: '40%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	var video_1962 = TweenMax.from('#video_1962', 10, {
		rotation: 75,
		top: '100%',
		left: 0,
		opacity: 0,
		ease: Power1.easeInOut
	});
	var full_1962 = TweenMax.from('#full_1962', 5, {
		bottom: '-=10%',
		opacity: 0,
		delay: 10,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1962",
		duration: wh*4,
		triggerHook: "onLeave"
	})
	.setTween([year_1962, text_1962, video_1962, full_1962]).addTo(controller);
	
	// Leaving
	var lyear_1962 = TweenMax.to('#year_1962', 5, {
		opacity: 0,
		right: '-=10%',
		ease: Power1.easeInOut
	});
	var ltext_1962 = TweenMax.to('#text_1962', 10, {
		rotation: -85,
		bottom: '-50%',
		left: '-20%',
		opacity: 0,
		delay: 2,
		ease: Power1.easeInOut
	});
	var lvideo_1962 = TweenMax.to('#video_1962', 10, {
		rotation: -85,
		top: '-10%',
		left: '70%',
		opacity: 0,
		delay: 2,
		ease: Power1.easeInOut
	});
	var lfull_1962 = TweenMax.to('#full_1962', 5, {
		bottom: '-=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1962",
		offset: wh*5,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([lyear_1962, ltext_1962, lvideo_1962, lfull_1962]).addTo(controller);	
	
	
	
	// SCENE 1963
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1963",
		duration: wh * 8,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1963").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1966').data('more', 4);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/1966/back.jpg)");
		}
	});

	// Entering
	var year_1963 = TweenMax.from('#year_1963', 10, {
		opacity: 0,
		right: '-=10%',
		ease: Power1.easeInOut
	});
	var text_1963 = TweenMax.from('#text_1963', 10, {
		rotation: 75,
		bottom: '100%',
		left: '40%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	var video_1963 = TweenMax.from('#video_1963', 10, {
		rotation: 75,
		top: '100%',
		left: 0,
		opacity: 0,
		ease: Power1.easeInOut
	});
	var full_1963 = TweenMax.from('#full_1963', 5, {
		bottom: '-=10%',
		opacity: 0,
		delay: 10,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1963",
		duration: wh*4,
		triggerHook: "onLeave"
	})
	.setTween([year_1963, text_1963, video_1963, full_1963]).addTo(controller);
	
	// Leaving
	var lyear_1963 = TweenMax.to('#year_1963', 5, {
		opacity: 0,
		right: '-=10%',
		ease: Power1.easeInOut
	});
	var ltext_1963 = TweenMax.to('#text_1963', 10, {
		rotation: -85,
		bottom: '-50%',
		left: '-20%',
		opacity: 0,
		delay: 2,
		ease: Power1.easeInOut
	});
	var lvideo_1963 = TweenMax.to('#video_1963', 10, {
		rotation: -85,
		top: '-10%',
		left: '70%',
		opacity: 0,
		delay: 2,
		ease: Power1.easeInOut
	});
	var lfull_1963 = TweenMax.to('#full_1963', 5, {
		bottom: '-=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1963",
		offset: wh*5,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([lyear_1963, ltext_1963, lvideo_1963, lfull_1963]).addTo(controller);	
	
	
	
	// SCENE 1966
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1966",
		duration: wh * 8,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1966").addTo(controller)
	.on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1970').data('more', 3.5);
			$("#container").css("background-image", "none");
			$("#c1966").css({stroke: "#c14646", fill: "#ffffff", r: 13,strokeWidth: 4});
			$("#t1966").css({fill: "#c14646",fontSize: "20px"});
		} else {
			$("#c1966").css({stroke: "#ffffff", fill: "#1E3F14", r: 11,strokeWidth: 3});
			$("#t1966").css({fill: "#ffffff",fontSize: "17px"});
		}
	});

	// Entering
	var inner_1966 = TweenMax.from('#inner_1966', 10, {
		opacity: 0,
		ease: Power1.easeInOut
	});
	var all_1966 = TweenMax.staggerFrom('#year_1966, #text_1966, #full_1966', 10, {
		left: '+=20%',
		opacity: 0,
		ease: Power1.easeInOut
	}, 3);
	new ScrollScene({
		triggerElement: "#next1966",
		duration: wh*4,
		triggerHook: "onLeave"
	})
	.setTween([inner_1966, all_1966]).addTo(controller);
	
	// Leaving
	var linner_1966 = TweenMax.to('#inner_1966', 10, {
		opacity: 0,
		delay: 10,
		ease: Power1.easeInOut
	});
	var lall_1966 = TweenMax.staggerTo('#year_1966, #text_1966, #full_1966', 10, {
		left: '+=20%',
		opacity: 0,
		ease: Power1.easeInOut
	}, 3);
	new ScrollScene({
		triggerElement: "#next1966",
		offset: wh*5,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([linner_1966, lall_1966]).addTo(controller);		
	
	
	// SCENE 1970
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1970",
		duration: wh * 6,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1970").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1982').data('more', 4);
			$("#container").css("background-image", "url(/wp-content/themes/gunsandammo/remington/images/all/grey.jpg)");
		}
	});
	
	// Entering
	var year_1970 = TweenMax.staggerFrom('#year_1970, #text_1970', 10, {
		opacity: 0,
		left: '-=5%',
		delay: 5,
		ease: Power1.easeInOut
	}, 5);
	var img_1970 = TweenMax.from('#img_1970', 5, {
		opacity: 0,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1970",
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([year_1970, img_1970]).addTo(controller);

	// Leaving
	var year_1970 = TweenMax.staggerTo('#year_1970, #text_1970', 10, {
		opacity: 0,
		left: '-=5%',
		ease: Power1.easeInOut
	}, 5);
	var img_1970 = TweenMax.to('#img_1970', 10, {
		opacity: 0,
		ease: Power1.easeInOut
	});
	var st8 = TweenMax.staggerTo('.st8', 5, {
	    stroke: "#1E3F14",
	    ease: Power1.easeInOut
	}, -0.5);
	var circles = TweenMax.staggerTo('.circle', 5, {
	    fill: "#ffffff",
	    stroke: "#1E3F14",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {
	    fill: "#1E3F14",
	    ease: Power1.easeInOut
	}, -0.5);
	var time_line1 = TweenMax.to('#line', 5, {
	    stroke: "#1E3F14",
	    ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1970",
		offset: wh*4,
		duration: wh*2,
		triggerHook: "onLeave"
	})
	.setTween([year_1970, img_1970, st8, circles, time_text, time_line1]).addTo(controller);
	
	
	
	// SCENE 1982
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1982",
		duration: wh * 8,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1982").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1987').data('more', 4);
		}
	});
	
	// Entering
	var img_1982 = TweenMax.from('#img_1982', 10, {
		right: '-40%',
		rotation: -40,
		opacity: 0,
		ease: Power1.easeInOut
	});
	var left_1982 = TweenMax.staggerFrom('#left_1982, #img_knife_1982, #year_1982_wrap', 10, {
		left: '-=10%',
		opacity: 0,
		delay: 5,
		ease: Power1.easeInOut
	}, 3);
	new ScrollScene({
		triggerElement: "#next1982",
		duration: wh*4,
		triggerHook: "onLeave"
	})
	.setTween([img_1982, left_1982]).addTo(controller);
	
	// Leaving
	var img_knife_1982 = TweenMax.to('#img_knife_1982', 4, {
		bottom: '-40%',
		ease: Power1.easeInOut
	});
	var year_1982_1 = TweenMax.to('#year_1982_1', 2, {
		marginLeft: -10,
		rotation: -10,
		delay: 1,
		ease: Power1.easeInOut
	});
	var year_1982_2 = TweenMax.to('#year_1982_2', 2, {
		marginLeft: 20,
		rotation: 10,
		delay: 1,
		ease: Power1.easeInOut
	});
	var img_1982 = TweenMax.to('#img_1982', 10, {
		right: '-40%',
		rotation: 40,
		opacity: 0,
		delay: 5,
		ease: Power1.easeInOut
	});
	var left_1982 = TweenMax.to('#left_1982, #year_1982_wrap', 10, {
		left: '-=10%',
		opacity: 0,
		delay: 5,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1982",
		offset: wh*5,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([img_1982, left_1982, img_knife_1982, year_1982_1, year_1982_2]).addTo(controller);	
	
	
	
	// SCENE 1987
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1987",
		duration: wh * 8,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1987").addTo(controller)
	.on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s1988').data('more', 4);
			$("#c1987").css({stroke: "#c14646",r: 13,strokeWidth: 4});
			$("#t1987").css({fill: "#c14646",fontSize: "20px"});
		} else {
			$("#c1987").css({stroke: "#1e3d05",r: 11,strokeWidth: 3});
			$("#t1987").css({fill: "#1e3d05",fontSize: "17px"});
		}
	});
	
	// Entering
	var year_1987 = TweenMax.from('#year_1987', 10, {
		right: '-=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	var guns_1987 = TweenMax.staggerFrom('#left_1987 img', 10, {
		top: '-40%',
		rotation: -40,
		opacity: 0,
		delay: 2,
		ease: Power1.easeInOut
	}, 2);
	var right_1987 = TweenMax.from('#right_1987', 10, {
		right: '-=10%',
		opacity: 0,
		delay: 5,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1987",
		duration: wh*4,
		triggerHook: "onLeave"
	})
	.setTween([year_1987, guns_1987, right_1987]).addTo(controller);
	
	// Leaving
	var lyear_1987 = TweenMax.to('#year_1987', 10, {
		right: '-=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	var lguns_1987 = TweenMax.staggerTo('#left_1987 img', 10, {
		top: '-40%',
		rotation: -40,
		opacity: 0,
		delay: 2,
		ease: Power1.easeInOut
	}, 2);
	var lright_1987 = TweenMax.to('#right_1987', 10, {
		right: '-=10%',
		opacity: 0,
		delay: 5,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1987",
		offset: wh*5,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([lyear_1987, lguns_1987, lright_1987]).addTo(controller);
	
	
	
	// SCENE 1988
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next1988",
		duration: wh * 8,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s1988").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s2010').data('more', 4);
		} 
	});
	
	// Entering
	var right_1988 = TweenMax.from('#year_1988', 10, {
		right: '-=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	var year_1988 = TweenMax.from('#right_1988', 10, {
		right: '-=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1988",
		duration: wh*4,
		triggerHook: "onLeave"
	})
	.setTween([year_1988, right_1988]).addTo(controller);
	
	// Leaving
	var lright_1988 = TweenMax.to('#year_1988', 10, {
		right: '-=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	var lyear_1988 = TweenMax.to('#right_1988', 10, {
		right: '-=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next1988",
		offset: wh*5,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([lyear_1988, lright_1988]).addTo(controller);
	
	
	// SCENE 2010
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next2010",
		duration: wh * 8,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s2010").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s2011').data('more', 4);
			$("#c2010").css({stroke: "#c14646",r: 13,strokeWidth: 4});
			$("#t2010").css({fill: "#c14646",fontSize: "20px"});
		} else {
			$("#c2010").css({stroke: "#1e3d05",r: 11,strokeWidth: 3});
			$("#t2010").css({fill: "#1e3d05",fontSize: "17px"});
		}
	});
	

	// Entering
	var all_2010 = TweenMax.staggerFrom('#text_2010, #img_2010, #bottom_2010', 10, {
		marginLeft: '+=10%',
		opacity: 0,
		ease: Power1.easeInOut
	}, 2);
	new ScrollScene({
		triggerElement: "#next2010",
		duration: wh*4,
		triggerHook: "onLeave"
	})
	.setTween(all_2010).addTo(controller);
	
	// Leaving
	var lall_2010 = TweenMax.staggerTo('#text_2010, #img_2010, #bottom_2010', 10, {
		marginLeft: '+=10%',
		opacity: 0,
		ease: Power1.easeInOut
	}, 2);
	new ScrollScene({
		triggerElement: "#next2010",
		offset: wh*5,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween(lall_2010).addTo(controller);
	
	
	
	// SCENE 2011
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next2011",
		duration: wh * 8,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s2011").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s2013').data('more', 4);
		} 
	});
	
	// Entering
	var text_2011 = TweenMax.from('#text_2011', 10, {
		left: '+=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	var img_2011 = TweenMax.from('#img_2011', 10, {
		left: '-=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next2011",
		duration: wh*4,
		triggerHook: "onLeave"
	})
	.setTween([text_2011, img_2011]).addTo(controller);
	
	// Leaving
	var ltext_2011 = TweenMax.to('#text_2011', 10, {
		left: '+=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	var limg_2011 = TweenMax.to('#img_2011', 10, {
		left: '-=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});

	new ScrollScene({
		triggerElement: "#next2011",
		offset: wh*5,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([ltext_2011, limg_2011]).addTo(controller);
	
	
	// SCENE 2013
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next2013",
		duration: wh * 8,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s2013").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s2014').data('more', 4);
		} 
	});
	
	// Entering
	var text_2013 = TweenMax.from('#text_2013', 10, {
		left: '+=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	var img_2013 = TweenMax.from('#img_2013', 10, {
		left: '-=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next2013",
		duration: wh*4,
		triggerHook: "onLeave"
	})
	.setTween([text_2013, img_2013]).addTo(controller);
	
	// Leaving
	var ltext_2013 = TweenMax.to('#text_2013', 10, {
		left: '+=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	var limg_2013 = TweenMax.to('#img_2013', 10, {
		left: '-=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next2013",
		offset: wh*5,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([ltext_2013, limg_2013]).addTo(controller);
	
	
	
	// SCENE 2014
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next2014",
		duration: wh * 8,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s2014").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s2016').data('more', 4);
		} 
	});
	
	// Entering
	var text_2014 = TweenMax.from('#text_2014', 10, {
		left: '+=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next2014",
		duration: wh*4,
		triggerHook: "onLeave"
	})
	.setTween(text_2014).addTo(controller);
	
	// Leaving
	var ltext_2014 = TweenMax.to('#text_2014', 10, {
		left: '-=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next2014",
		offset: wh*5,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween(ltext_2014).addTo(controller);
	
	
	
	// SCENE 2016
	//-----------------------------------------------//
	new ScrollScene({
		triggerElement: "#next2016",
		duration: wh * 8,
		offset: 10,
		triggerHook: "onLeave"
	})
	.setPin("#s2016").addTo(controller).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#next_scene").data('next','s_end').data('more', 1);
		} 
	});
	
	// Entering
	var text_2016 = TweenMax.from('#text_2016', 10, {
		left: '+=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next2016",
		duration: wh*4,
		triggerHook: "onLeave"
	})
	.setTween(text_2016).addTo(controller);
	
	// Entering
	var text_2016 = TweenMax.to('#text_2016', 10, {
		left: '+=10%',
		opacity: 0,
		ease: Power1.easeInOut
	});
	var all_2016 = TweenMax.to('#next_scene, #timeline', 10, {
		opacity: 0,
		ease: Power1.easeInOut
	});
	new ScrollScene({
		triggerElement: "#next2016",
		offset: wh*5,
		duration: wh*3,
		triggerHook: "onLeave"
	})
	.setTween([text_2016, all_2016]).addTo(controller);
	


}


//-----------------------------------------------------------//
//	
// 				ANIMATION TABLTET, MOBILE
//
//-----------------------------------------------------------//

function add_video(year, src) {
	$("#s"+year+" .video-wrap").append('<iframe width="640" height="360" src="'+src+'?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>');
}

function rem_video(year) {
	$("#s"+year+" .video-wrap iframe").remove();
}

if (ww < 1100 || isSafari == true) {
	
	
	// TIMELINE NAVIGATION
	//---------------------------------------------------//

	$(".video-wrap iframe").remove();
	myScroll = new IScroll('#container');
	contr_mob = new ScrollMagic();	// init controller
	
	var arr_dur_mob = [3, 3, 2, 8, 5, 4, 2, 1, 3];
	arrow_anim(contr_mob, arr_dur_mob);
	
	new ScrollScene({
		triggerElement: "#next1828",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#c1816").css({stroke: "#c14646"});
			$("#t1816").css({fill: "#c14646",fontSize: "20px"});
			add_video(1816, 'https://www.youtube.com/embed/v5MyLYN4X50');
		} else {
			///alert('ds');
			$("#c1816").css({stroke: "#ffffff"});
			$("#t1816").css({fill: "#ffffff",fontSize: "17px"});
			rem_video(1816);
		}
	});
	new ScrollScene({
		triggerElement: "#next1858",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#c1856").css({stroke: "#c14646", fill: "#ffffff"});
			$("#t1856").css({fill: "#c14646",fontSize: "20px"});
		} else {
			$("#c1856").css({stroke: "#ffffff", fill: "#1e3d05"});
			$("#t1856").css({fill: "#ffffff",fontSize: "17px"});
		}
	});
	new ScrollScene({
		triggerElement: "#next1871",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#c1867").css({stroke: "#c14646", fill: "#ffffff"});
			$("#t1867").css({fill: "#c14646",fontSize: "20px"});
		} else {
			$("#c1867").css({stroke: "#ffffff", fill: "#1e3d05"});
			$("#t1867").css({fill: "#ffffff",fontSize: "17px"});
		}
	});
	
	buildTimeline();
	tl.pause();
	
	new ScrollScene({
		triggerElement: "#next1873",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		e.type == "enter" ? tl.resume() : tl.pause();
	});
	new ScrollScene({
		triggerElement: "#next1905",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#c1875").css({stroke: "#c14646"});
			$("#t1875").css({fontSize: "20px"});
		} else {
			$("#c1875").css({stroke: "#1e3d05"});
			$("#t1875").css({fill: "#1e3d05",fontSize: "17px"});
		}
	});
	new ScrollScene({
		triggerElement: "#next1910",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		e.type == "enter" ? add_video(1906, 'https://www.youtube.com/embed/v5MyLYN4X50') : rem_video(1906);
	});
	new ScrollScene({
		triggerElement: "#next1922",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		e.type == "enter" ? add_video(1918, 'https://www.youtube.com/embed/v5MyLYN4X50') : rem_video(1918);
	});
	new ScrollScene({
		triggerElement: "#next1927",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		e.type == "enter" ? add_video(1922, 'https://www.youtube.com/embed/v5MyLYN4X50') : rem_video(1922);
	});	
	new ScrollScene({
		triggerElement: "#next1934",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#c1933").css({stroke: "#c14646"});
			$("#t1933").css({fill: "#c14646",fontSize: "20px"});
		} else {
			$("#c1933").css({stroke: "#ffffff"});
			$("#t1933").css({fill: "#ffffff",fontSize: "17px"});
		}
	});
	new ScrollScene({
		triggerElement: "#next1950",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		e.type == "enter" ? add_video(1941, 'https://www.youtube.com/embed/v5MyLYN4X50') : rem_video(1941);
	});
	new ScrollScene({
		triggerElement: "#next1956",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		e.type == "enter" ? add_video(1950, 'https://www.youtube.com/embed/v5MyLYN4X50') : rem_video(1950);
	});
	new ScrollScene({
		triggerElement: "#next1959record",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#c1959").css({stroke: "#c14646", fill: "#ffffff"});
			$("#t1959").css({fill: "#c14646",fontSize: "20px"});
			add_video(1959, 'https://www.youtube.com/embed/v5MyLYN4X50');
		} else {
			$("#c1959").css({stroke: "#ffffff", fill: "#1E3F14"});
			$("#t1959").css({fill: "#ffffff",fontSize: "17px"});
			rem_video(1959);
		}
	});
	new ScrollScene({
		triggerElement: "#next1960", 
		duration: wh,
		triggerHook: "onEnter"
	})
	.addTo(contr_mob)
	.on("enter leave", shootAnim);
	new ScrollScene({
		triggerElement: "#next1963",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		e.type == "enter" ? add_video(1962, 'https://www.youtube.com/embed/v5MyLYN4X50') : rem_video(1962);
	});
	new ScrollScene({
		triggerElement: "#next1966",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		e.type == "enter" ? add_video(1963, 'https://www.youtube.com/embed/v5MyLYN4X50') : rem_video(1963);
	});
	new ScrollScene({
		triggerElement: "#next1970",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#c1966").css({stroke: "#c14646", fill: "#ffffff"});
			$("#t1966").css({fill: "#c14646",fontSize: "20px"});
		} else {
			$("#c1966").css({stroke: "#ffffff", fill: "#1E3F14"});
			$("#t1966").css({fill: "#ffffff",fontSize: "17px"});
		}
	});
	new ScrollScene({
		triggerElement: "#next1988",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#c1987").css({stroke: "#c14646"});
			$("#t1987").css({fill: "#c14646",fontSize: "20px"});
			add_video(1987, 'https://www.youtube.com/embed/v5MyLYN4X50');
		} else {
			$("#c1987").css({stroke: "#1e3d05"});
			$("#t1987").css({fill: "#1e3d05",fontSize: "17px"});
			rem_video(1987);
		}
	});
	new ScrollScene({
		triggerElement: "#next2011",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#c2010").css({stroke: "#c14646"});
			$("#t2010").css({fill: "#c14646",fontSize: "20px"});
		} else {
			$("#c2010").css({stroke: "#1e3d05"});
			$("#t2010").css({fill: "#1e3d05",fontSize: "17px"});
		}
	});
	
	new ScrollScene({
		triggerElement: "#next_end",
		duration: wh,
		triggerHook: "onEnter"
	}).addTo(contr_mob).on("enter leave", function (e) {
		if (e.type == "enter") {
			$("#c2010").css({stroke: "#c14646"});
			$("#t2010").css({fill: "#c14646",fontSize: "20px"});
		} else {
			$("#c2010").css({stroke: "#1e3d05"});
			$("#t2010").css({fill: "#1e3d05",fontSize: "17px"});
		}
	});
	
	// Change color of whole timeline. I had to repeat vars, otherwise it wouldn't work 
	// make it lighter vars
	var st8 = TweenMax.staggerTo('.st8', 5, {stroke: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var circles1 = TweenMax.staggerTo('.circle', 5, {fill: "#1E3F14",stroke: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var time_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {fill: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var time_line1 = TweenMax.to('#line', 5, {stroke: "#ffffff",ease: Power1.easeInOut});
	// make it darker vars
	var dst8 = TweenMax.staggerTo('.st8', 5, {stroke: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dcircles = TweenMax.staggerTo('.circle', 5, {fill: "#ffffff",stroke: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dtime_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {fill: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dtime_line1 = TweenMax.to('#line', 5, {stroke: "#1E3F14",ease: Power1.easeInOut});
	
	new ScrollScene({triggerElement: "#next1816",duration: wh,triggerHook: "onLeave"})
	.setTween( [st8, circles1, time_text, time_line1] ).addTo(contr_mob);
	new ScrollScene({triggerElement: "#next1871",duration: wh,triggerHook: "onLeave"})
	.setTween([dst8, dcircles, dtime_text, dtime_line1]).addTo(contr_mob);
	
	var st8 = TweenMax.staggerTo('.st8', 5, {stroke: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var circles1 = TweenMax.staggerTo('.circle', 5, {fill: "#1E3F14",stroke: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var time_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {fill: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var time_line1 = TweenMax.to('#line', 5, {stroke: "#ffffff",ease: Power1.easeInOut});
	var dst8 = TweenMax.staggerTo('.st8', 5, {stroke: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dcircles = TweenMax.staggerTo('.circle', 5, {fill: "#ffffff",stroke: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dtime_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {fill: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dtime_line1 = TweenMax.to('#line', 5, {stroke: "#1E3F14",ease: Power1.easeInOut});
	new ScrollScene({triggerElement: "#next1905",duration: wh,triggerHook: "onLeave"})
	.setTween( [st8, circles1, time_text, time_line1] ).addTo(contr_mob);
	new ScrollScene({triggerElement: "#next1906",duration: wh,triggerHook: "onLeave"})
	.setTween([dst8, dcircles, dtime_text, dtime_line1]).addTo(contr_mob);
	
	var st8 = TweenMax.staggerTo('.st8', 5, {stroke: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var circles1 = TweenMax.staggerTo('.circle', 5, {fill: "#1E3F14",stroke: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var time_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {fill: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var time_line1 = TweenMax.to('#line', 5, {stroke: "#ffffff",ease: Power1.easeInOut});
	var dst8 = TweenMax.staggerTo('.st8', 5, {stroke: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dcircles = TweenMax.staggerTo('.circle', 5, {fill: "#ffffff",stroke: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dtime_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {fill: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dtime_line1 = TweenMax.to('#line', 5, {stroke: "#1E3F14",ease: Power1.easeInOut});
	new ScrollScene({triggerElement: "#next1914",duration: wh,triggerHook: "onLeave"})
	.setTween( [st8, circles1, time_text, time_line1] ).addTo(contr_mob);
	new ScrollScene({triggerElement: "#next1918",duration: wh,triggerHook: "onLeave"})
	.setTween([dst8, dcircles, dtime_text, dtime_line1]).addTo(contr_mob);
	
	var st8 = TweenMax.staggerTo('.st8', 5, {stroke: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var circles1 = TweenMax.staggerTo('.circle', 5, {fill: "#1E3F14",stroke: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var time_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {fill: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var time_line1 = TweenMax.to('#line', 5, {stroke: "#ffffff",ease: Power1.easeInOut});
	var dst8 = TweenMax.staggerTo('.st8', 5, {stroke: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dcircles = TweenMax.staggerTo('.circle', 5, {fill: "#ffffff",stroke: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dtime_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {fill: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dtime_line1 = TweenMax.to('#line', 5, {stroke: "#1E3F14",ease: Power1.easeInOut});
	new ScrollScene({triggerElement: "#next1933",duration: wh,triggerHook: "onLeave"})
	.setTween( [st8, circles1, time_text, time_line1] ).addTo(contr_mob);
	new ScrollScene({triggerElement: "#next1940",duration: wh,triggerHook: "onLeave"})
	.setTween( [dst8, dcircles, dtime_text, dtime_line1] ).addTo(contr_mob);
	
	var st8 = TweenMax.staggerTo('.st8', 5, {stroke: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var circles1 = TweenMax.staggerTo('.circle', 5, {fill: "#1E3F14",stroke: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var time_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {fill: "#ffffff",ease: Power1.easeInOut}, -0.5);
	var time_line1 = TweenMax.to('#line', 5, {stroke: "#ffffff",ease: Power1.easeInOut});
	var dst8 = TweenMax.staggerTo('.st8', 5, {stroke: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dcircles = TweenMax.staggerTo('.circle', 5, {fill: "#ffffff",stroke: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dtime_text = TweenMax.staggerTo('.st20, #time_arrow', 5, {fill: "#1E3F14",ease: Power1.easeInOut}, -0.5);
	var dtime_line1 = TweenMax.to('#line', 5, {stroke: "#1E3F14",ease: Power1.easeInOut});
	new ScrollScene({triggerElement: "#next1950",duration: wh,triggerHook: "onLeave"})
	.setTween( [st8, circles1, time_text, time_line1] ).addTo(contr_mob);
	new ScrollScene({triggerElement: "#next1970",duration: wh,triggerHook: "onLeave"})
	.setTween( [dst8, dcircles, dtime_text, dtime_line1] ).addTo(contr_mob);
	
	
	// FULL PAGE SCROLL
	var sections = $("#container section");
	
	$("#container").fullpage({
		scrollingSpeed: 1500,
		sectionSelector: 'section',
		normalScrollElementTouchThreshold: 3,
		onLeave: function(index, nextIndex, direction){
			var leavingSection = $(this);
			//console.log(leavingSection);
			//console.log(index);
			//console.log(nextIndex);
			//console.log(leavingSection[0].nextElementSibling);
			sections.eq(nextIndex).find(".lazy").trigger("unveil");
			sections.eq(nextIndex).trigger("unveil");
			
			if(direction == 'up'){
				sections.eq(index-2).find(".lazy").trigger("unveil");
				sections.eq(index-2).trigger("unveil");
			}
			//if(index == 2 && direction =='down'){  }
			//else if(index == 2 && direction == 'up'){  }
		},
		menu: '#line_menu',
		anchors:['ystart', 'y1816', 'y1828', 'y1845', 'y1856', 'y1858', 'y1861', 'y1865', 'y1867', 'y1871', 'y1873', 'y1875', 'y1905', 'y1906', 'y1910', 'y1914', 'y1917', 'y1918','y1922', 'y1927', 'y1933', 'y1934', 'y1940', 'y1941', 'y1950', 'y1956', 'y1959', 'yr1959', 'y1960', 'y1962', 'y1963', 'y1966', 'y1970', 'y1982', 'y1987', 'y1988', 'y2010', 'y2011', 'y2013', 'y2014', 'y2016', 'yend']
	});
	
	$(".btn-info").bind("click touchstart", function(){ 
		$.fn.fullpage.setAllowScrolling(false);
	});
	$('.i-close, .modal').bind("click touchstart", function() {
		$.fn.fullpage.setAllowScrolling(true);
	});
	
	$("#c1816").click(function(){$.fn.fullpage.moveTo('y1816');});
	$("#c1856").click(function(){$.fn.fullpage.moveTo('y1856');});
	$("#c1867").click(function(){$.fn.fullpage.moveTo('y1867');});
	$("#c1875").click(function(){$.fn.fullpage.moveTo('y1875');});
	$("#c1933").click(function(){$.fn.fullpage.moveTo('y1933');});
	$("#c1959").click(function(){$.fn.fullpage.moveTo('y1959');});
	$("#c1966").click(function(){$.fn.fullpage.moveTo('y1966');});
	$("#c1987").click(function(){$.fn.fullpage.moveTo('y1987');});
	$("#c2010").click(function(){$.fn.fullpage.moveTo('y2010');});
	$("#c2016").click(function(){$.fn.fullpage.moveTo('y2016');});

	$(".circle").click(function(){
		var id = $(this).attr("id"),
			section_id	= id.replace('c', 's');
		
		$("#"+section_id).find(".lazy").trigger("unveil");
		$("#"+section_id).trigger("unveil");
		
		$("#"+section_id).next().find(".lazy").trigger("unveil");
		$("#"+section_id).next().trigger("unveil");
	});


}// end if ww < 1100




});// end document.ready


$(window).on("resize", function () {
	wh = $(window).innerHeight();
	ww = $(window).innerWidth();
});// end window on resize




////////////////////	
})(jQuery);