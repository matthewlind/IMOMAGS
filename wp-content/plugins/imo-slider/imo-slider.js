;(function($) {$(function() {



    $(document).ready(function () {
      $('#scroll').buffet({
        scroll_by : 2,
        speed     : 400,
        easing    : 'easeOutExpo',
        next      : $('#next'),
        prev      : $('#prev'),
        before : function () {
          console.log("before_" + this);
        },
        after : function () {
          console.log("after_" + this);
        }
      });
    });  


});
})(jQuery);





