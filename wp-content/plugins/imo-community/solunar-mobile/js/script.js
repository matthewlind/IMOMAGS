$(function() {
    $(".jq-open-posts").click(function () {
        $(".expand-posts").slideToggle("slow");
        $(".jq-close-posts").toggleClass("opened");
    });
    $(".jq-close-posts").click(function () {
        $(".expand-posts").slideUp("slow");
        $(this).removeClass("opened");
    });
    $(".jq-view-month").click(function () {
        $(".calendar-holder").slideToggle("slow");
    });
    $(".close-popup").on('click', function () {
        $(".popup, .fadeout").hide();
    });
    $("a.jq-open-legend").click(function () {
       $(".popup, .fadeout").show();
    });
   /* $(".a-event").click(function () {
       $(".day-expandable").slideDown();
    });*/
   $(".jq-expand-day").click(function() {
        var activeTab = $(this).find("a.jq-expand-link").attr("href"); 
        $(activeTab).slideToggle("slow");
        return false;
    });
    
});
$(".jq-custom-form select").zfselect({
    rows: 10
});
$('.jq-custom-form input[type="checkbox"]').ezMark();

// iphone scale fix
MBP.scaleFix();