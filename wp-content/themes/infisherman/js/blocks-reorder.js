jQuery(document).ready(function () {

    //init vars
    var WIDTH_MOBILE_CONST  = 595,
        parent_container    = jQuery('.js-responsive-layout'),
        sections_qty_common = jQuery('.js-responsive-section').length;

    //added default mode data to js-wrapper element
    parent_container.data('browser_mode', 'default');

    //window resize and load event
    jQuery(window)
        .on('resize', change_mode)
        .on('load', change_mode);

    //function for choose mode
    function change_mode(){

        var current_width = jQuery(window).width();

        if (current_width < WIDTH_MOBILE_CONST) {
            mobile_mode();
        }
        else if(current_width > WIDTH_MOBILE_CONST){
            desktop_mode();
        }

        return false;
    }

    //function for reorder DOM elements
    function mobile_mode() {

        if (parent_container.data('browser_mode') != 'iphone') {

            //added temp holders
            if(!parent_container.data('holder_settings')){
                jQuery('.js-responsive-section').each(function(e){
                    var el_number = jQuery(this).attr('data-position');
                    jQuery(this).before(jQuery("<div class='position-holder js-position-holder-" + el_number + "'></div>"));
                });
            }

            //changed DOM tree (move DOM elements)
            for (var i = 1; i < sections_qty_common; i++) {
                jQuery('.js-responsive-section[data-position = ' + i + ']').after(jQuery('.js-responsive-section[data-position = ' + (i + 1) + ']'));
            }

            //added mode data and necessary classes to js-wrapper element
            parent_container
                .data('browser_mode', 'iphone')
                .data('holder_settings', true)
                .removeClass('default-mode')
                .addClass('iphone-mode');
        }

        return false;
    }

    function desktop_mode(){

        if (parent_container.data('browser_mode') != 'default') {

            //return all elements for each position
            for (var i = 1; i <= sections_qty_common; i++) {
                jQuery('.js-position-holder-' + i).after(jQuery('.js-responsive-section[data-position = ' + i +']'))
            }

            //added default mode data and necessary classes to js-wrapper element
            parent_container
                .data('browser_mode', 'default')
                .removeClass('iphone-mode')
                .addClass('default-mode');

        }

        return false;
    }

});