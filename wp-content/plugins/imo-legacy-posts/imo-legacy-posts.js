
jQuery(document).ready(function () {

  //make first image active by default
  jQuery("div.imo_legacy_post div.thumbs div.thumb:first img").addClass('active');
  
  jQuery("div.imo_legacy_post div.thumbs div.thumb").click(function(){
      //make all images not active first
      jQuery("div.imo_legacy_post div.thumbs div.thumb img").removeClass('active');
      
      //make this image active
      jQuery(this).find("img").addClass('active');

      
      var thumb_url = jQuery(this).find("img").attr('src');
      var full_size_image = thumb_url.replace('article_slideshow_thumb', 'article_slideshow');
      
      //var selected_caption = jQuery(this).find("img").attr('id').replace('image', 'caption');
      
      // //show current caption
      // jQuery("div.slideshow-caption").hide().filter('.'+selected_caption).show();
      
      // //only show caption background box if there is actually a value in the caption
      // if (!jQuery('.'+selected_caption).html())
      //   jQuery("div.slideshow-caption-background").hide();
      // else
      //   jQuery("div.slideshow-caption-background").show();    
      
      //change out full image
      jQuery("div.imo_legacy_post div.image img").attr('src', full_size_image);
  });
});