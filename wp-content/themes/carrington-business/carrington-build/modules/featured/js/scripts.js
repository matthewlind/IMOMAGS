/**
 * Scripts.js
 */

;(function($) {$(function() {
      /**
       * Configure the scroll dots
       */
      function init_scrolldots(carousel) {
      $(".scroller-controller", carousel.container.parent().parent()).append("<ul class='scroll-dots'></ul>");
      //calculate number of pages
      var pages = Math.ceil(carousel.options.size / carousel.options.scroll);
      for (var i=1, j=pages; i <= j; i++) {
      //set up links         
        addDot(carousel, i);
      }
      if($.browser.msie && $.browser.version <= 7) {
        var intendedWidth = Number( $(".scroller-controller .scroll-dots a:eq(0)", carousel.container.parent().parent()).width() * pages);
        var leftOffset = ( Number( $(".scroller-controller", carousel.container.parent().parent()).width()) - intendedWidth)/2;
        $(".scroller-controller .scroll-dots", carousel.container.parent().parent()).width(intendedWidth);
        $(".scroller-controller .scroll-dots", carousel.container.parent().parent()).css("left", leftOffset+"px");
      }
      //add events to the scroller buttons. 
      function activatePage (direction) {
        return function() {
          if(String($(this).attr("disabled")) == "false"){ 
            var activeListItem = $(".active", $(carousel.container.parent().parent()));
            var activeIndex = Number($('a', activeListItem).text());
            activeListItem.removeClass("active"); 
            if (direction=='prev') {
              if (activeIndex == 1) {
                activeIndex = 2;
              }
              $(".page"+(activeIndex-1), activeListItem.parent()).addClass("active");
            }
            else { // next!
              if(activeIndex==pages) {
                activeIndex=pages-1;
              }                      
              $(".page"+(activeIndex+1), activeListItem.parent()).addClass("active");
            }
          }
        };
      }

      $(carousel.buttonNext).bind("click", activatePage('next'));
      $(carousel.buttonPrev).bind("click", activatePage('prev'));
      }

      function addDot(carousel, page) {
        var dot = $("<li class='dot page"+page+"'><a href='#page" + page + "'>" + page + "</a></li>");
        if (page == 1) {
          dot.addClass('active');
        }
        $(".scroller-controller > ul", carousel.container.parent().parent()).append(dot);
        $(dot).bind("click", function() {
            var lastItem = page * carousel.options.scroll;
            if (lastItem > carousel.options.size) {
            lastItem = carousel.options.size;
            }

            $(this).parent().children().removeClass("active");
            $(this).addClass("active");
            carousel.scroll(Number(1+lastItem-carousel.options.scroll));
            return false;
            }); 
      }
      /**
       * Updates the dots for the scroller.
       */
      function jc_events(carousel) {
        var index = 1;
        $(carousel.buttonNext).bind("click",
            function() {
            if (index >= 3) {
            return false;
            }
            else {
            index++;
            }
            if (index == 1) { setItem = "-20px";}
            if (index == 2) { setItem = "-40px";}
            if (index == 3) { setItem = "-60px";}
            $(".scroller-controller", carousel.container.parent().parent()).css("backgroundPositionY", setItem);
            });
        $(carousel.buttonPrev).bind("click",

            function() { 
            if (index <= 1) {
            return false;
            }
            else {
            index--;
            }
            if (index == 1) { setItem = "-20px";}
            if (index == 2) { setItem = "-40px";}
            if (index == 3) { setItem = "-60px";}
            $(".scroller-controller", carousel.container.parent().parent()).css("backgroundPositionY", setItem);
            });
      }  
      var whatsnew_config = {  scroll: 4,
        setupCallback:init_scrolldots
      }, feature_config = {  scroll:1,
setupCallback:init_scrolldots
      };
      $.extend(whatsnew_config, custom_whatsnew_config);
      $.extend(feature_config, custom_feature_config);
      // console.log(feature_config);
      $("#krang-carousel").jcarousel(whatsnew_config);
      $("#feature-carousel").jcarousel(feature_config);
      //conservation links.
      $("#conservation-link").hover(
          function () {
          $('#conservation-lists').fadeIn();
          },
          function () {
          return;
          }
          );
      $("#conservation-lists").hover(
          function () {
          return;
          },
          function () {
          $('#conservation-lists').fadeOut();
          }
          );
});
})(jQuery);
