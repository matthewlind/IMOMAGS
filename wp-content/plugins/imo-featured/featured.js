jQuery( document ).ready(function( $ ) {

    // $( "#featured-search" ).autocomplete({
    //   source: "/wpdb/autocomplete.php",
    //   minLength: 2,
    //   select: function( event, ui ) {
    //     console.log(ui.item);
    //   }
    // }).data('ui-autocomplete')._renderItem = function(ul, item) {
    //     return jQuery('<li>').data('ui-autocomplete-item', item ).append('<a>--'+ item.label+'<br>aaaa'+item.desc+'</a>').appendTo(ul);
    // };



$( "#featured-search" ).autocomplete({
    minLength: 0,
    source: "/wpdb/autocomplete.php",
    // focus: function( event, ui ) {
    //     $( "#featured-search" ).val( ui.item.value );
    //     return false;
    // },
    select: function( event, ui ) {
        $( "#featured-search" ).val( ui.item.value );
        return false;
    }
})
.data( "autocomplete" )._renderItem = function( ul, item ) {
    return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a><img width=50 height=50 src='" + item.thumb + "'>" + item.title + "</a>" )
        .appendTo( ul );
};


});