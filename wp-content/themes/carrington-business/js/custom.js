/**
 * custom.js
 *
 * Random effects and doodads
 */


(function($){$( function() {
    /**
     * Automatically remove default text and replace it if nothing is entered.
     */
    $("input[type=text]").each(function(i, o) {
        var input_default = $(o).val(); 
        $(o).focus(
            function() {
                if($(this).val() == input_default ) {
                    $(this).val("");
               }
            }).blur(
                function() {
                    if($(this).val() == "") {
                        $(this).val(input_default);
                    }
                });
    });
});})(jQuery);
