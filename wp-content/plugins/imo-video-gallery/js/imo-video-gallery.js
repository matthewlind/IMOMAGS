
var player;


function getContent(page, document_load, channel_tax, channel_term, container){
  
  jQuery.get(window.home_url + '/' + 'index.php?callback=flsp_videogallery-grid_content&paged=' + page + '&channel_tax='+channel_tax+'&channel_term='+channel_term+'&container='+container, function(data) {
    

    if (container == 'gridContainer'){
    if (data['grid_html'].length > 500){
      
      max_num_pages = data['max_num_pages'];
      
      if (page == max_num_pages)
        next_toggle = "none";
      else
        next_toggle = "block";
      if (page == 1)
        prev_toggle = "none";
      else
        prev_toggle = "block";
      
      jQuery(".flsp_videogallery_grid_next").css("display", next_toggle);
      jQuery(".flsp_videogallery_grid_prev").css("display", prev_toggle);     
      jQuery("#flsp_videogallery_grid_page").val(page);
      jQuery("#flsp_videogallery_page_num").html("<i>"+page+" of "+max_num_pages+"</i>");
      jQuery("#flsp_videogallery_channel_tax").val(channel_tax);
      jQuery("#flsp_videogallery_channel_term").val(channel_term);
      jQuery("#content_grid_pages").val(channel_term);



      jQuery("#"+container).html(data['grid_html']);
      remove_loading_cursor();


      if (jQuery('#'+container).height() < 133)
        jQuery('#'+container).height(133);
      if (document_load){
        loadVideo(jQuery(".firstvideo").attr('videoid'),jQuery(".postImage:first").attr('source'));
        getVideoInfo(jQuery(".firstvideo").parent().attr("id"));
        loadUpNextBox();
      }

  jQuery('.postImage ').on("click", function(){
    
   loadVideo(jQuery(this).attr('videoid'),jQuery(this).attr('source'));
   id = jQuery(this).parent().attr("id").match(/(\d+)/);
   getVideoInfo(id[1]);
   scrollToVideo('video_player');
});
  jQuery('.postLink').on("click", function(){
   loadVideo(jQuery(this).attr('videoid'),jQuery(this).attr('source'));
   id = jQuery(this).attr("id").match(/(\d+)/);
   getVideoInfo(id[1]);
   scrollToVideo('video_player');
  return false;

});
    }
  }
    else {
      var count = data['grid_html'].match(/postImage/g);
      jQuery("#count").val(count.length);
      

    
      jQuery("#"+container).empty();
            if (container == "sidebar_channels_video_grid"){
              
        jQuery("#sidebar_channels_video_grid").css("width", (count.length * 160) + "px");
        
      }      
      jQuery("#"+container).html(data['grid_html']);
      remove_loading_cursor();
      
    }

});

}

function getVideoInfo(id){
  
   jQuery.get(window.home_url + '/' + 'index.php?callback=flsp_videogallery-ajax&post_id=' + id, function(data) {
   post_title = '<a href="'+data['permalink']+'">'+data['post_title']+'</a>';
   comments = '<a href="'+data['permalink']+'">'+data['comments']+'</a>';
   jQuery('#video_player_info_title').html(post_title);
   jQuery('#video_player_info_excerpt').html(data['post_excerpt']);
   jQuery('#video_player_info_comments').html(comments);
   });
}

function scrollToVideo(id){
   var scroll_target = jQuery("#"+id).offset().top - 12;
   jQuery('html,body').animate({scrollTop: scroll_target},'fast');

}

function loadVideo(id, source){

   var htm = '';

  if (source == "youtube"){
    
    htm = '<iframe width="620" height="349" src="http://www.youtube.com/embed/' + id + '?rel=0" frameborder="0" allowfullscreen ></iframe>';
  }
  else if (source == "vimeo"){

    htm = '<iframe src="http://player.vimeo.com/video/' + id + '" width="620" height="350" frameborder="0"></iframe>';

  }
  else if (source == "brightcove"){
    




    htm = '<object id="myExperience" class="BrightcoveExperience">'
    +  '<param name="bgcolor" value="#FFFFFF" />'
    +  '<param name="width" value="620" />'
    +  '<param name="height" value="350" />'
    +  '<param name="playerID" value="973698996001" />'
    +  '<param name="playerKey" value="AQ~~%2CAAAAAETeEfI~%2Ci-5J2ubuAMtrBswh0PvpouAMH3Ey66kE" />'
    +  '<param name="isVid" value="true" />'
    +  '<param name="isUI" value="true" />'
    +  '<param name="@videoPlayer" value="' + id + '" /></object>';
}
  jQuery("#video_player").html(htm);
  
  if (source == "brightcove"){
    player = brightcove.createExperiences();
  }


}

function loadUpNextBox(){

  var i = 0;
  var upnext_post_div;
  var div_id;
  var upnext_html;

jQuery("#upnext_video_grid").css("width", "1200px");
  
  jQuery(".vg-post").each(function(){
    if (i<=6){
      upnext_post_div = jQuery(this).clone();
      div_id = jQuery(this).attr("id");
      div_id = "upnext-" + div_id;
      jQuery(upnext_post_div).attr("id", div_id);
      jQuery(upnext_post_div).addClass("upnext");
      jQuery(upnext_post_div).removeClass("firstvideo");
      jQuery(upnext_post_div).addClass("upnext-"+i);
      jQuery(upnext_post_div).children('.postImage').children('.flsp_vg_thumbnail').removeClass("flsp_vg_thumbnail").addClass("upnext_thumbnail").css("width", "128px");
      jQuery("#upnext_video_grid").append(upnext_post_div);
    }


    i++;


  });

  jQuery(".upnext-0").toggle();
  jQuery(".upnext-1").toggle();
  jQuery("#upnext").toggle();

 var position = 0;


jQuery("#flsp_videogallery_grid_next").click(function(e){

 //var loading_image_url = '<?php echo plugin_dir_url( __FILE__ ) . 'images/ajax-loader.gif'; ?>';
 
  show_loading_cursor(e);
  var page = jQuery("#flsp_videogallery_grid_page").val();
  var tax = jQuery("#flsp_videogallery_channel_tax").val();
  var term = jQuery("#flsp_videogallery_channel_term").val();
  page++;
  getContent(page,false,tax,term, 'gridContainer');

});

jQuery("#flsp_videogallery_grid_prev").click(function(e){

  show_loading_cursor(e);
  var page = jQuery("#flsp_videogallery_grid_page").val();
  var tax = jQuery("#flsp_videogallery_channel_tax").val();
  var term = jQuery("#flsp_videogallery_channel_term").val();  
  page--;
  getContent(page,false,tax,term, 'gridContainer');
  

});

  jQuery('.postImage ').on("click", function(){
    
   loadVideo(jQuery(this).attr('videoid'),jQuery(this).attr('source'));
   id = jQuery(this).parent().attr("id").match(/(\d+)/);
   getVideoInfo(id[1]);
   scrollToVideo('video_player');
});
  jQuery('.postLink').on("click", function(){
   loadVideo(jQuery(this).attr('videoid'),jQuery(this).attr('source'));
   id = jQuery(this).attr("id").match(/(\d+)/);
   getVideoInfo(id[1]);
   scrollToVideo('video_player');
  return false;
});


jQuery('#upnext_goleft').on("click", function(){
  
  if (position > 0){
    position--;
  jQuery("#upnext_video_grid").animate({
    marginRight: "-=137px",
    marginLeft: "+=137px"
  }, 200);
  }

});  

jQuery('#upnext_goright').on("click", function(){
  
  if (position < 5){
    position++;
  jQuery("#upnext_video_grid").animate({
    marginLeft: "-=137px",
    marginRight: "+=137px"
  }, 200);  
  }

});  


jQuery('.flsp_vg_left_sidebar_channel').click(function(e){
  show_loading_cursor(e);
})

jQuery('#sidebar_channels_select').change(function(e){
  if (jQuery('#sidebar_channels_select option:selected').val() != '0' ){
    show_loading_cursor(e);
  }
})







}

var loadingImage;
var loading_image_url = window.plugin_dir_url + '/images/imovg-ajax-loader.gif';
function show_loading_cursor(obj) {
  // if a loading image is already active from a previous call, get rid of it
  if (jQuery(loadingImage))
    jQuery(loadingImage).remove();
  loadingImage = jQuery(document.createElement("img")).attr("src", loading_image_url).attr("alt", "Loading...");

  jQuery("body").append(loadingImage);

  jQuery(loadingImage).css({
    position: "absolute",
    background: "none",
    top: (obj.pageY + 15) + "px",
    left: (obj.pageX + 15) + "px"
  });
   
  jQuery(document).mousemove(function(e) {
    loadingImage.css({
      top: (e.pageY + 15) + "px",
      left: (e.pageX + 15) + "px"
    });
  });
}

function remove_loading_cursor() {
  jQuery(document).unbind("mousemove");
  
  jQuery(loadingImage).remove();
}



jQuery(document).ready(function() {


  
  getContent(1, true,  window.channel_taxonomy,  window.channel_term, 'gridContainer');


});





