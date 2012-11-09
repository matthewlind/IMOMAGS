<?php 



   /*
   Plugin Name: IMO Video Gallery
   Description: IMO Video Gallery
   Version: 0.1
   */




function addHeaderCode() {
    echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/imo-video-gallery/css/style.css" />' . "\n";    
 }


add_action('wp_head', 'addHeaderCode');

class FLSP_VideoGallery_Ajax
{
   public function __construct()
   {
      if ( is_admin() ) {
         add_action( 'wp_ajax_nopriv_imo-video-gallery', array( &$this, 'ajax_call' ) );
         add_action( 'wp_ajax_imo-video-gallery', array( &$this, 'ajax_call' ) );
      }
      add_action( 'init', array( &$this, 'init' ) );
   }

   public function init()
   {
      wp_enqueue_script( 'imo-video-gallery', plugin_dir_url( __FILE__ ) . 'js/ajax.js', array( 'jquery' ) );

      wp_localize_script( 'imo-video-gallery', 'IMOVideoGallery', array(
          'ajaxurl' => admin_url( 'admin-ajax.php' ),
          'nonce' => wp_create_nonce( 'imo-video-gallery-nonce' )



      ) );
   }

   public function ajax_call()
   {

      $post_id = $_GET['post_id'];
      $post = get_post($post_id);
      $post_title = $post->post_title;
      if (strlen($post->post_excerpt) > 200 )
          $post_excerpt = preg_replace('/\s+?(\S+)?$/', '', substr($post->post_excerpt, 0, 200)) . "...";
      else 
        $post_excerpt = $post->post_excerpt;
      $permalink = get_permalink( $post_id );
      $comments = "Read more, view/post comments >>";
      //$comments = comments_popup_link( 'Be the first to post a comment >>', '1 comment >>', '% comments >>', 'video_player_info_comments', 'Comments are off for this post');
/*      if ($number_of_comments == 0)
        $comments = "Be the first to post a comment >>";
      else{
        $comments = "View ";
        if ($number_of_comments > 1)
          $comments .= "all";
        $comments .= $number_of_comments." comment";
        if ($number_of_comments > 1)
          $comments .= "s";
        $comments .= ", Post a comment, More >>"; */
      

      /*if ( ! isset( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'flsp_video_gallery_nonce' ) )
         die ( 'Invalid Nonce' ); */
      header( "Content-Type: application/json" );
      echo json_encode( array(
         'success' => true,
         'time' => time(),
         'post_title' => $post_title,
         'post_excerpt' => $post_excerpt,
         'permalink' => $permalink,
         'comments' => $comments
      ) );
      exit;
   }

function grid_content($paged = 1, $channel_tax = '', $channel_term = '', $container = 'gridContainer'){

  // needed for brightcove media api
  require_once(WP_CONTENT_DIR . '/plugins/bc_import/bc_mapi/bc-mapi.php');
  require_once(WP_CONTENT_DIR . '/plugins/bc_import/bc-config.php');
  require_once(WP_CONTENT_DIR . '/plugins/bc_import/plugin.php');
  global $post;
  global $wp_query;
  global $query_string;

  $primary_video_taxonomy_key = get_option('flsp_video_gallery_primary_taxonomy');
  $primary_video_taxonomy_value = get_option('flsp_video_gallery_primary_term');  
  $grid_html = '';


 // get all posts where column = 'video' and channel = channel_term

  $args = array( 'post_type' => 'post',  
               'posts_per_page' => 30,
               'paged' => $paged,
               'orderby' => 'date',
               'order' => 'DESC',
               'tax_query' => array('relation' => 'AND',
      array(
         'taxonomy' => $primary_video_taxonomy_key,
         'field' => 'slug',
         'terms' => array($primary_video_taxonomy_value)
         
      )

   )
);
if (strlen($channel_tax) > 0 && strlen($channel_term) > 0)
// if channel specified, append to tax_query

array_push($args['tax_query'], array('taxonomy' => $channel_tax,
                                       'field' => 'slug',
                                       'terms' => array($channel_tax.'-'.$channel_term)
                                       )); 


      //$query = new WP_Query( array( 'post_type' => 'post', $primary_video_taxonomy_key => $primary_video_taxonomy_value, $channel_tax => $channel_term));
   $query = new WP_Query( $args );



$special_class = $container != "gridContainer" ? " ".$container."_post " : "";
$firstvideo = " firstvideo";
$c = 1; //init counter
$bpr = 5; //boxes per row

$video_found = true;

while ( $query->have_posts() ) : $query->the_post();


$source = "";
 
// brightcove
if (1 == preg_match('~\[brightcove id="(\d+)"\]~',$post->post_content, $video_id)) {

  $video_id = $video_id[1];
  $source = "brightcove";
}
// youtube
elseif (1 === preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $post->post_content, $video_id)) {
     $video_id = $video_id[0];   
     $video_id = str_replace("#!", "", $video_id);
     $source = "youtube";
}
// vimeo
elseif (1 === preg_match('#vimeo\.com\/(\d+).*#', $post->post_content, $match)){
    $vimeoID = $match[1];
    $video_id = $vimeoID;
    $vimeo_api_response = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vimeoID.php"));
    $source = "vimeo";
}

if ($source == "youtube"){

$video_exists = get_data("http://gdata.youtube.com/feeds/api/videos/".$video_id);
if ($video_exists != "Video not found"){
  $grid_html .= '<div class="vg-post'.$special_class.'" id="'. get_the_ID() .'">';
  $grid_html .= '<div class="postImage'. $firstvideo .'" source="'.  $source .'" videoid="'. $video_id .'">';
  $firstvideo = "";

  if ($container != "gridContainer"){

      $grid_html .= "<a href=\"".get_permalink( get_the_ID() )."\">";
  }

  $grid_html .=  '<img class="flsp_vg_thumbnail" src="http://img.youtube.com/vi/'.trim($video_id).'/1.jpg"><br>';
  if ($container != "gridContainer"){

      $grid_html .= "</a>";
  }    
  $grid_html .= get_title_link($source, $video_id, $container);

}
else 
    $video_found = false;
}
if ($source == "brightcove"){
    
    $api_string = "http://api.brightcove.com/services/library?command=find_video_by_id&video_id=".$video_id."&video_fields=thumbnailURL&media_delivery=http&token=". BC_READ_WITH_URL_ACCESS_TOKEN;
    
    $thumbnail_json = get_data($api_string);
    if ($thumbnail_json){
    $obj = json_decode($thumbnail_json);
    $grid_html .= '<div class="vg-post'.$special_class.'" id="'. get_the_ID() .'">';
    $grid_html .= '<div class="postImage '. $firstvideo .'" source="'.  $source .'" videoid="'. $video_id .'">';
    $firstvideo = "";

if ($container != "gridContainer"){

    $grid_html .= "<a href=\"".get_permalink( get_the_ID() )."\">";
}
    $grid_html .=  '<img class="flsp_vg_thumbnail" src="'.$obj->thumbnailURL.'"><br>';
if ($container != "gridContainer"){

    $grid_html .= "</a>";
}    
    $grid_html .= get_title_link($source, $video_id, $container);
  }
  else
    $video_found .= false;
}
if ($source == "vimeo"){
    $grid_html .= '<div class="vg-post'.$special_class.'" id="'. get_the_ID() .'">';
    $grid_html .= '<div class="postImage '. $firstvideo .'" source="'.  $source .'" videoid="'. $video_id .'">';
    $firstvideo = "";

if ($container != "gridContainer"){
    $grid_html .= "<a href=\"".get_permalink( get_the_ID() )."\">";
}
    $grid_html .=  "<img  class=\"flsp_vg_thumbnail\" src=\"".$vimeo_api_response[0]['thumbnail_small']."\">";

if ($container != "gridContainer"){
    $grid_html .= "</a>";
}
    $grid_html .= get_title_link($source, $video_id, $container);
  

}

if ($container == 'gridContainer'){

   if($c == $bpr) {

$grid_html .= '<div class="clr"></div>';

$c = 0;
}

if ($video_found)
  $c++;
}
endwhile;
$grid_html .= '<div class="clr"></div>';

      header( "Content-Type: application/json" );
      echo json_encode( array(
         'success' => true,
         'time' => time(),
         'grid_html' => $grid_html,
         'max_num_pages' => $query->max_num_pages
      ) );

}

  function flsp_video_gallery_check_request(){
        if ( $_GET['callback'] == 'flsp_videogallery-ajax') {
           $this->ajax_call();
           exit();
        }
        if ( $_GET['callback'] == 'flsp_videogallery-grid_content') {
           $paged = $_GET['paged'];
           $channel_tax = $_GET['channel_tax'];
           $channel_term = $_GET['channel_term'];
           $container = $_GET['container'];
           $this->grid_content($paged, $channel_tax, $channel_term, $container);
           exit();
        }      
  }
}



/**
 * Displays a list of posts ordered by popularity
 *
 * Shows a simple list of post titles ordered by their view count
 *
 * @param integer $post_count The number of posts to show
 *
 */
function flsp_video_gallery($content) {

  global $post;
  global $wp_query;
  global $query_string;
  // values provided by admin panel
  $primary_video_taxonomy_key = get_option('flsp_video_gallery_primary_taxonomy');
  $primary_video_taxonomy_value = get_option('flsp_video_gallery_primary_term');
  $video_page_slug = "videos";
  // main video page
  ?>
<style type="text/css">


</style>


<script type="text/javascript">
var player;



function getContent(page, document_load, channel_tax, channel_term, container){

  jQuery.post('<?php echo home_url(); ?>' + '/' + 'index.php?callback=flsp_videogallery-grid_content&paged=' + page + '&channel_tax='+channel_tax+'&channel_term='+channel_term+'&container='+container, function(data) {
    

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
      
    }

});

}

function getVideoInfo(id){
   jQuery.post('<?php echo home_url() . '/' . 'index.php?callback=flsp_videogallery-ajax&post_id='; ?>' + id, function(data) {
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
    +  '<param name="playerID" value="1303927212001" />'
    +  '<param name="playerKey" value="AQ~~,AAAA-01d-uE~,FiwRPPEEyN5Ul9VdpuUBJrfHQ9_peuY-" />'
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


jQuery("#flsp_videogallery_grid_next").click(function(){


   var page = jQuery("#flsp_videogallery_grid_page").val();
  var tax = jQuery("#flsp_videogallery_channel_tax").val();
  var term = jQuery("#flsp_videogallery_channel_term").val();
  page++;
  getContent(page,false,tax,term, 'gridContainer');

});

jQuery("#flsp_videogallery_grid_prev").click(function(){

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










}

jQuery(document).ready(function() {


  
  getContent(1, true, '<?php echo $wp_query->query_vars["channel_taxonomy"]; ?>', '<?php echo $wp_query->query_vars["channel_term"]; ?>', 'gridContainer');


});





</script>
<?php

  echo '<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>';
  echo '<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/APIModules_all.js"></script>';
  echo '<script type="text/javascript" src="http://files.brightcove.com/bc-mapi.js"></script>';





  if ($post->post_name == $video_page_slug){
?>

<?php





 ?>

<div id="flsp_vg">
<div id="sidebar">
<div id="upnext">
  <h3 class="upnext_header">UP NEXT</h3>
  <div class="upnext_arrow" id="upnext_goleft">
    <?php  echo '<img src="'.plugin_dir_url( __FILE__ ) . 'images/arrowbar-prev.png">'; ?>
  </div>
  <div id="upnext_wrapper">
<div id="upnext_video_grid">

</div>
</div>
<div class="upnext_arrow" id="upnext_goright">
  <?php  echo '<img src="'.plugin_dir_url( __FILE__ ) . 'images/arrowbar-next.png">'; ?>
</div>
</div>
<div id="flsp_vg_sidebar_ad">
<aside id="advert-widget-3" class="widget clearfix widget_advert-widget"><!-- 300x250 Ad: -->
<iframe src="http://ad.doubleclick.net/adi/N6759.868838.IMOUTDOORS.COM/B6673459.13;sz=300x250;click=http://adclick.g.doubleclick.net/aclk?sa=L&amp;ai=BmKtFHqlQUKbCDeTZ0AHd1IHwD73B77kEAAAAEAEgADgAWJ3ezP9oYMnesIfco9wQggEXY2EtcHViLTY1MTE2NTEzMjY1OTY0NjSyARl3d3cuZmxvcmlkYXNwb3J0c21hbi5kZXZjugEJZ2ZwX2ltYWdlyAEJ2gEpaHR0cDovL3d3dy5mbG9yaWRhc3BvcnRzbWFuLmRldmMvcmVnaW9ucy-YAshlwAIC4AIA6gIhNDkzMC9pbW8uZmxvcmlkYXNwb3J0c21hbi9yZWdpb25z-AKC0h6QA-ADmAPgA6gDAeAEAaAGFg&amp;num=0&amp;sig=AOD64_2n_xsoNqRsFCJeH9DH9fAIajnvKg&amp;client=ca-pub-6511651326596464&amp;adurl=;ord=1902420129?" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" bordercolor="#000000">
</iframe>
    <noscript>
        &lt;a  href="http://ad.doubleclick.net/adj/imo.floridasportsman/videos;sect=videos;page=videos;subs=;sz=300x250;dcopt=;tile=2;ord=6545512368?"&gt;
            &lt;img src="http://ad.doubleclick.net/ad/imo.floridasportsman/videos;sect=videos;page=videos;subs=;sz=300x250;dcopt=;tile=2;ord=6545512368?" border="0" /&gt;
        &lt;/a&gt;
    </noscript>
<!-- END 300x250 Ad: --></aside>
</div>
</div>
<div id="video_gallery_top">
  <div id="video_player_container">
    <div id="video_player"></div>
    <div id="video_player_info">
      <div id="video_player_info_title"></div>
      <div id="video_player_info_excerpt"></div>
      <div id="video_player_info_comments"></div>
    </div>
  </div>
</div>





<div id="video_plugin_main">
<div id="gridContainer">
</div>
<div id="flsp_paging">
    <div class="flsp_videogallery_grid_prev">
      <a id="flsp_videogallery_grid_prev">&#9668; Back</a>
    </div>

    <div class="flsp_videogallery_grid_next">
      <a id="flsp_videogallery_grid_next">Next &#9658;</a>
    </div>
</div>
<input type="hidden" id="flsp_videogallery_grid_page" value="1">
<input type="hidden" id="flsp_videogallery_channel_tax" value="">
<input type="hidden" id="flsp_videogallery_channel_term" value="">

</div>







<div id="flsp_vg_left_sidebar">
<div id="nav_menu">
<h4 class="nav_header">FS Channels</h4>

   <?php 
echo '<a href="javascript:getContent(1,false,\'\',\'\', \'gridContainer\');">All Videos</a>';   
$channels = explode ( ',' , get_option('flsp_video_gallery_channels') );
$channel_name = "";
$channel_label = "";
foreach($channels as $channel){
   
   $i = false;

   $is_label = strpos($channel, '"');

   if ($is_label){
    $channel_label = $channel;
   }
   else{

   $channel_array = explode("-", $channel);
   foreach ($channel_array as $ca_segment) {
        

        if ($i){
           if (strlen($channel_name) > 0)
              $channel_name .= " ";
           $channel_name .= ucfirst($ca_segment);
        }
      

      if (taxonomy_exists($ca_segment)){
         $channel_tax = $ca_segment;
         $i = true;
      }
   }

   $channel_term = strtolower($channel_name);
   $channel_term = str_replace(" ", "-", $channel_term);

   if (strlen($channel_label) > 0){
    $channel_name = str_replace('\"', '', $channel_label);
    $channel_label = "";
  }
   echo '<br><a href="javascript:getContent(1,false,\''.$channel_tax.'\',\''.$channel_term.'\', \'gridContainer\');">'.$channel_name.'</a>';
   $channel_name = "";
 }
}
      $microsites[0]['link'] = get_option('flsp_video_gallery_microsite_1');
      $microsites[1]['link'] = get_option('flsp_video_gallery_microsite_2');
      $microsites[2]['link'] = get_option('flsp_video_gallery_microsite_3');

      $microsites[0]['img'] = get_option('flsp_video_gallery_microsite_1_image');
      $microsites[1]['img'] = get_option('flsp_video_gallery_microsite_2_image');
      $microsites[2]['img'] = get_option('flsp_video_gallery_microsite_3_image');


   ?>
<h4 class="nav_header">Television</h4>

<?php 

foreach($microsites as $microsite)

  if (strlen($microsite['img']) > 0)
    echo '<a href="'.$microsite['link'].'"><img src="'.$microsite['img'].'"></a><br/>';

?>

</div>

<div id="flsp_vg_tower_ad">

            <script type="text/javascript">
document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.floridasportsman/videos;sect=videos;page=videos;subs=;sz=160x600;dcopt=;tile=3;ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
    </script>
    <noscript>
        &lt;a  href="http://ad.doubleclick.net/adj/imo.floridasportsman/videos;sect=videos;page=videos;subs=;sz=160x600;dcopt=;tile=3;ord=6545512368?"&gt;
            &lt;img src="http://ad.doubleclick.net/ad/imo.floridasportsman/videos;sect=videos;page=videos;;subs=;sz=160x600;dcopt=;tile=3;ord=6545512368?" border="0" /&gt;
        &lt;/a&gt;
    </noscript>

</div>
</div>









</div>


</div>
<?php

   }
   // single video post
  elseif (is_single()){

      $is_video_post = false;
      $terms = get_the_terms( $post->id, $primary_video_taxonomy_key );


      if (!empty($terms)){

         $terms_slugs = array();

         foreach( $terms as $term ) {
            $terms_slugs[] = $term->slug; 

         }
         if ($terms_slugs[0] == $primary_video_taxonomy_value){
           $is_video_post = true;
         }
      }

//if ($is_video_post){

  $content .= yarpp_related(array(
    // Pool options: these determine the "pool" of entities which are considered
    'post_type' => array('post'),
    'show_pass_post' => false, // show password-protected posts
    'past_only' => false, // show only posts which were published before the reference post
    'exclude' => array(), // a list of term_taxonomy_ids. entities with any of these terms will be excluded from consideration.
    'recent' => false, // to limit to entries published recently, set to something like '15 day', '20 week', or '12 month'.
    
    // Relatedness options: these determine how "relatedness" is computed
    // Weights are used to construct the "match score" between candidates and the reference post
    'weight' => array(
      'body' => 1,
      'title' => 2, // larger weights mean this criteria will be weighted more heavily
      'tax' => array(
        'column' => 3
         // put any taxonomies you want to consider here with their weights
      )
    ),
    // Specify taxonomies and a number here to require that a certain number be shared:
    'require_tax' => array(
      'column' => 1 // for example, this requires all results to have at least one 'post_tag' in common.
    ),
    // The threshold which must be met by the "match score"
    'threshold' => 1,

    // Display options:
    'template' => 'yarpp-template-thumbnail-copy.php', // either the name of a file in your active theme or the boolean false to use the builtin template
    'limit' => 10, // maximum number of results
    'order' => 'score DESC'
  ),
  $reference_ID, // second argument: (optional) the post ID. If not included, it will use the current post.
  false); // third argument: (optional) true to echo the HTML block; false to return it

  //$content .= flsp_video_sidebar_channels();

  // }
 }
   return $content;
}


add_action("the_content", "flsp_video_gallery");

function flsp_video_sidebar_channels(){

$sidebar_content = '<aside id="sidebar_channels" class="sidebar_channel_box">
<input type="hidden" id="count">
<div class="sidebar_channels_header">
  <h3 class="sidebar_channels_header_text">VIDEO</h3> 
  <select id="sidebar_channels_select">
    <option value="0">Select Channel</option>';

$channels = explode ( ',' , get_option('flsp_video_gallery_channels') );
/* 
foreach($channels as $channel){

   $channel_name = "";
   $i = false;
   $channel_array = explode("-", $channel);
   foreach ($channel_array as $ca_segment) {
      if ($i){
         if (strlen($channel_name) > 0)
            $channel_name .= " ";
         $channel_name .= ucfirst($ca_segment);
      }

      if (taxonomy_exists($ca_segment)){
         $channel_tax = $ca_segment;
         $i = true;
      }
   }
   $channel_term = strtolower($channel_name);
   $channel_term = str_replace(" ", "-", $channel_term);
   $sidebar_content .= '<option value="'.$channel_tax.','.$channel_term.'">'.$channel_name.'</option>';

}

 */


$channel_name = "";
$channel_label = "";
foreach($channels as $channel){
   
   $i = false;

   $is_label = strpos($channel, '"');

   if ($is_label){
    $channel_label = $channel;
   }
   else{

   $channel_array = explode("-", $channel);
   foreach ($channel_array as $ca_segment) {
        

        if ($i){
           if (strlen($channel_name) > 0)
              $channel_name .= " ";
           $channel_name .= ucfirst($ca_segment);
        }
      

      if (taxonomy_exists($ca_segment)){
         $channel_tax = $ca_segment;
         $i = true;
      }
   }

   $channel_term = strtolower($channel_name);
   $channel_term = str_replace(" ", "-", $channel_term);

   if (strlen($channel_label) > 0){
    $channel_name = str_replace('\"', '', $channel_label);
    $channel_label = "";
  }
   $sidebar_content .= '<option value="'.$channel_tax.','.$channel_term.'">'.$channel_name.'</option>';
   $channel_name = "";
 }
}

  $sidebar_content .= '</select>
  </div>
  <div class="sidebar_channels_arrow" id="sidebar_channels_goleft">
   <img src="'.plugin_dir_url( __FILE__ ) . 'images/arrowbar-prev.png">
  </div>
  <div id="sidebar_channels_wrapper">
    <div id="sidebar_channels_video_grid">

    </div>
  </div>
<div class="sidebar_channels_arrow" id="sidebar_channels_goright">
  <img src="'.plugin_dir_url( __FILE__ ) . 'images/arrowbar-next.png">
</div>

<div id="sidebar_channels_microsite_container">';


      $microsites[0]['link'] = get_option('flsp_video_gallery_microsite_1');
      $microsites[1]['link'] = get_option('flsp_video_gallery_microsite_2');

      $microsites[0]['img'] = get_option('flsp_video_gallery_microsite_1_image');
      $microsites[1]['img'] = get_option('flsp_video_gallery_microsite_2_image');



$i = 0;
foreach($microsites as $microsite){
  $i++;
  $sidebar_content .=  '<div id="sidebar_microsite_'.$i.'"><a href="'.$microsite['link'].'"><img src="'.$microsite['img'].'"></a></div>';
}


$sidebar_content .= '</div>
</aside>
<div style="clear:both"></div>
<script type="text/javascript">






jQuery(document).ready(function() {
//jQuery.ajaxSetup({async:false});
var count = 0;

getContent(1, true, \'\',\'\', \'sidebar_channels_video_grid\');
  
  count = jQuery("#count").val();
  


  
  
jQuery("#sidebar_channels").children(".sidebar_channels_header").children("#sidebar_channels_select").change( function() {


  
var selected_channel = jQuery("#sidebar_channels_select").val();

if (selected_channel != 0){
  selected_channel = selected_channel.split(",");
  getContent(1, false, selected_channel[0],selected_channel[1], \'sidebar_channels_video_grid\');
  var distance = (position - 1) * 137;
  jQuery("#sidebar_channels_video_grid").animate({
    marginRight: "-=" +distance+ "px",
    marginLeft: "+=" +distance+ "px"
  }, 1);
  count = jQuery("#count").val();
  position = 1;

  
  
  
}



});

var position = 1;

jQuery("#sidebar_channels_goright").click(function() {
    count = jQuery("#count").val();
  if (position < count -1){
    position++;
  jQuery("#sidebar_channels_video_grid").animate({
    marginLeft: "-=137px",
    marginRight: "+=137px"
  }, 200);
}
});

jQuery("#sidebar_channels_goleft").click(function() {
    count = jQuery("#count").val();
    if (position > 1){
      position--;
  jQuery("#sidebar_channels_video_grid").animate({
    marginRight: "-=137px",
    marginLeft: "+=137px"
  }, 200);
}
});
  
  

});





</script>


';

return $sidebar_content;

}


//add_action("wp_meta", "flsp_video_sidebar_channels");




$ajaxExample = new FLSP_VideoGallery_Ajax();


add_action('parse_request',  array($ajaxExample, 'flsp_video_gallery_check_request'), 1 );


function brightcove_tag($content) {
  

  $match = preg_match('~\[brightcove id="(\d+)"\]~',$content, $video_id);
  $video_id = $video_id[1];


    $htm = '<object id="myExperience" class="BrightcoveExperience">
    <param name="bgcolor" value="#FFFFFF" />
    <param name="width" value="620" />
    <param name="height" value="350" />
    <param name="playerID" value="1303927212001" />
    <param name="playerKey" value="AQ~~,AAAA-01d-uE~,FiwRPPEEyN5Ul9VdpuUBJrfHQ9_peuY-" />
    <param name="isVid" value="true" />
    <param name="isUI" value="true" />
    <param name="@videoPlayer" value="' . $video_id . '" /></object>
    <script type="text/javascript">brightcove.createExperiences();</script>';


$content = preg_replace("~\[brightcove id=\"(\d+)\"\]~", $htm, $content);
return $content;

}


add_filter( 'the_content', 'brightcove_tag' );
//add_shortcode( 'brightcove', 'brightcove_tag' );

function get_data($url)
{
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

function get_title_link($source, $in_video_id, $container){

  $title_link = '<div class="postTitle">';
  

  $title_link .= '<a href="';

  if ($container == "sidebar_channels_video_grid")
    $title_link .= get_permalink( get_the_ID() );
  else
    $title_link .= "#";

  $title_link .= '" class="postLink" source="'.  $source .'" videoid="'. $in_video_id .'" id="'. get_the_ID() .'">';
  $title = the_title('','',false);
  if (strlen($title > 35))
    $title = substr($title, 0, 35) + "...";

  $title_link .= $title;
  $title_link .= '</a></div></div></div>';
  return $title_link;
}


// ADMIN 

function flsp_video_gallery_admin() {

   
      if($_POST['flsp_video_gallery_admin_hidden'] == '1') {
         
         $flsp_video_gallery_primary_taxonomy = $_POST['flsp_video_gallery_primary_taxonomy'];
         update_option('flsp_video_gallery_primary_taxonomy', $flsp_video_gallery_primary_taxonomy );

         $flsp_video_gallery_primary_term = $_POST['flsp_video_gallery_primary_term'];
         update_option('flsp_video_gallery_primary_term', $flsp_video_gallery_primary_term );         

         $flsp_video_gallery_channels = $_POST['flsp_video_gallery_channels'];
         update_option('flsp_video_gallery_channels', $flsp_video_gallery_channels );

         $flsp_video_gallery_microsite_1 = $_POST['flsp_video_gallery_microsite_1'];
         update_option('flsp_video_gallery_microsite_1', $flsp_video_gallery_microsite_1 );

         $flsp_video_gallery_microsite_2 = $_POST['flsp_video_gallery_microsite_2'];
         update_option('flsp_video_gallery_microsite_2', $flsp_video_gallery_microsite_2 );

         $flsp_video_gallery_microsite_3 = $_POST['flsp_video_gallery_microsite_3'];
         update_option('flsp_video_gallery_microsite_3', $flsp_video_gallery_microsite_3 );

         $flsp_video_gallery_microsite_1_image = $_POST['flsp_video_gallery_microsite_1_image'];
         update_option('flsp_video_gallery_microsite_1_image', $flsp_video_gallery_microsite_1_image );

         $flsp_video_gallery_microsite_2_image = $_POST['flsp_video_gallery_microsite_2_image'];
         update_option('flsp_video_gallery_microsite_2_image', $flsp_video_gallery_microsite_2_image );

         $flsp_video_gallery_microsite_3_image = $_POST['flsp_video_gallery_microsite_3_image'];
         update_option('flsp_video_gallery_microsite_3_image', $flsp_video_gallery_microsite_3_image );         
      ?>
         <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
      <?php
      } else {
         
      $flsp_video_gallery_primary_taxonomy = get_option('flsp_video_gallery_primary_taxonomy');
      $flsp_video_gallery_primary_term = get_option('flsp_video_gallery_primary_term');
      $flsp_video_gallery_channels = get_option('flsp_video_gallery_channels');
      $flsp_video_gallery_microsite_1 = get_option('flsp_video_gallery_microsite_1');
      $flsp_video_gallery_microsite_2 = get_option('flsp_video_gallery_microsite_2');
      $flsp_video_gallery_microsite_3 = get_option('flsp_video_gallery_microsite_3');

      $flsp_video_gallery_microsite_1_image = get_option('flsp_video_gallery_microsite_1_image');
      $flsp_video_gallery_microsite_2_image = get_option('flsp_video_gallery_microsite_2_image');
      $flsp_video_gallery_microsite_3_image = get_option('flsp_video_gallery_microsite_3_image');


      }


   ?>

<div class="wrap">
         <?php    echo "<h2>" . __( 'Video Gallery Display Options', 'flsp_video_trdom' ) . "</h2>"; ?>
        <form name="flsp_video_gallery_admin_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">

         <input name="flsp_video_gallery_admin_hidden" type="hidden" value="1">

         <h3>Primary Video Gallery Taxonomy</h3>
         The primary taxonomy used by video posts on your site<br>
         Taxonomy: <input type="text" id="flsp_video_gallery_primary_taxonomy" name="flsp_video_gallery_primary_taxonomy" value="<?php echo $flsp_video_gallery_primary_taxonomy; ?>">(ex.: column, categories) <br>
         Term slug: <input type="text" id="flsp_video_gallery_primary_term" name="flsp_video_gallery_primary_term" value="<?php echo $flsp_video_gallery_primary_term; ?>">(ex.: video, column-video)<br>

         <h3>Taxononmy Channels</h3>
         To display a taxonomy-driven channels menu for your video gallery, enter a comma-separated list of the taxonomies you would like to be included.<br>
         To specify a custom title for a channel, include it in double quotes immediately before the channel itself, as a comma-seperated item (e.g. "Boating Videos",activity-boating).<br>
         <textarea id="flsp_video_gallery_channels" cols="75" rows="10" name="flsp_video_gallery_channels"><?php echo str_replace('\\', '', $flsp_video_gallery_channels); ?></textarea><br>
         
         <h3>TV Show Microsite Links</h3>
         You can provide up to three links for TV show microsites<br>
         Microsite 1: <input type="text"  id="flsp_video_gallery_microsite_1" name="flsp_video_gallery_microsite_1" value="<?php echo $flsp_video_gallery_microsite_1; ?>"> 
         Link Image:<input type="text" id="flsp_video_gallery_microsite_1_image" name="flsp_video_gallery_microsite_1_image" value="<?php echo $flsp_video_gallery_microsite_1_image; ?>">
         <input type="button" value="Choose File" id="microsite_image_upload_1" class="button-secondary microsite_image_upload_button">
         <br>         
         Microsite 2: <input type="text"  id="flsp_video_gallery_microsite_2" name="flsp_video_gallery_microsite_2" value="<?php echo $flsp_video_gallery_microsite_2; ?>">
         Link Image:<input type="text" id="flsp_video_gallery_microsite_2_image" name="flsp_video_gallery_microsite_2_image" value="<?php echo $flsp_video_gallery_microsite_2_image; ?>">
         <input type="button" value="Choose File" id="microsite_image_upload_2" class="button-secondary microsite_image_upload_button">
         <br>
         Microsite 3: <input type="text"  id="flsp_video_gallery_microsite_3" name="flsp_video_gallery_microsite_3" value="<?php echo $flsp_video_gallery_microsite_3; ?>">
         Link Image:<input type="text" id="flsp_video_gallery_microsite_3_image" name="flsp_video_gallery_microsite_3_image" value="<?php echo $flsp_video_gallery_microsite_3_image; ?>">
         <input type="button" value="Choose File" id="microsite_image_upload_3" class="button-secondary microsite_image_upload_button">
            <p class="submit">
            <input type="submit" name="Submit" value="<?php _e('Update', 'flsp_video_trdom' ) ?>" />
            </p>               
        </form>
</div>

   <?php
   
      }

      function flsp_video_gallery_admin_actions() {
      
         add_options_page("Video Gallery", "Video Gallery", 1, "VideoGallery", "flsp_video_gallery_admin");  

      }

      add_action('admin_menu', 'flsp_video_gallery_admin_actions');

function my_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_register_script('flsp-video-gallery-upload', plugin_dir_url( __FILE__ ) .'js/upload.js', array('jquery','media-upload','thickbox'));
wp_enqueue_script('flsp-video-gallery-upload');
}

function my_admin_styles() {
wp_enqueue_style('thickbox');
}

if (isset($_GET['page']) && $_GET['page'] == 'VideoGallery') {
add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');
}




class IMO_VideoPlugin_Sidebar_Widget extends WP_Widget {

  function IMO_VideoPlugin_Sidebar_Widget() {
    // Instantiate the parent object
    parent::__construct( false, 'IMO Video Plugin Sidebar Widget' );
  }

  function widget( $args, $instance ) {

    $widget_content = flsp_video_sidebar_channels();

    echo $widget_content;
    
  }


}

function imo_video_sidebar_register_widget() {
  register_widget( 'IMO_VideoPlugin_Sidebar_Widget' );
}

add_action( 'widgets_init', 'imo_video_sidebar_register_widget' );



?>
