<?php

/**
 *head-includes.php makes special things special.
 */
 
if( is_preview() ){
	echo '<script type="text/javascript">var _gaq = _gaq || [];</script>';
}

$dartDomain = get_option("dart_domain", $default = false);

$id = get_the_ID();
$campaign = wp_get_post_terms($id,"campaign");
foreach($campaign as $c){
	$camp = $c->name;
}

if(is_home()){
	$term = "home";
	$pageName = "home";
}
else if (is_category()) {
	$cat = get_query_var('cat');
	$yourcat = get_category ($cat);
	$term = $yourcat->slug;
	$pageName = $yourcat->slug;

}
else if (is_single()) {
    global $the_ID;

    $post = get_queried_object();

    $categories = get_the_category($the_ID);

    $count = 0;
    foreach ($categories as $cat) {
    	$count++;
        $term .= $cat->name;
        if ($count != count($categories))
        	$term .= ",";
    }

	$pageName = get_the_title();

    if ($post->post_type == "imo_caption_contest") {
        if ($term != "")
        	$term .= ",";
        $term .= "caption_contest";
        $pageName = "caption_contest";

    }

    if ($post->post_type == "imo_video") {
        if ($term != "")
        	$term .= ",";
        $term .= "video";
        $pageName = "video";

    }

    /*if ($post->post_type == "reviews"){
    	$terms = wp_get_post_terms( $post->ID, "guntype");

    	$count = 0;
    	foreach ($terms as $term) {
        	$count++;
	        $term .= $term->name;
	        if ($count != count($terms))
	        	$term .= ",";
        }

        if ($term != "")
        	$term .= ",";
        $term .= "post_type_review";

    }*/

    if (get_option("dart_domain") == "imo.floridasportsman") {

      $term_array = wp_get_post_terms($post->ID, "activity" );
      $term = $term_array[0]->slug;

      if ($term_array[0]->parent == 308 || $term_array[0]->term_id == 308)
        $term = "fishing";
      if ($term_array[0]->parent == 292 || $term_array[0]->term_id == 292)
        $term = "hunting";
      if ($term_array[0]->parent == 635 || $term_array[0]->term_id == 635)
        $term = "boating";
      if ($term_array[0]->parent == 637 || $term_array[0]->term_id == 637)
        $term = "conservation";
      if ($term_array[0]->parent == 636 || $term_array[0]->term_id == 636)
        $term = "cooking";
      if ($term_array[0]->parent == 634 || $term_array[0]->term_id == 634)
        $term = "diving";
      if ($term_array[0]->parent == 705 || $term_array[0]->term_id == 705)
        $term = "paddling";
    }

    $params = array(
       "sect" => $term,
    );

}
else if (is_page()) {
	
    global $post;
    
    $pageName = $post->post_title;
    $term = $post->post_name;
}
else if ( is_tax() || is_tag() || is_category() ) {
    if (is_category()) {
        $tax_title = single_cat_title('', False);
    }
    else {
        $tax_title = single_tag_title("", False);
    }
    $params = array(
        "sect" => $tax_title,
    ); 
}
else {
    $params = array(
        "sect" => "misc",
    );
}
?>
<script type='text/javascript'>
(function() {
var useSSL = 'https:' == document.location.protocol;
var src = (useSSL ? 'https:' : 'http:') +
'//www.googletagservices.com/tag/js/gpt.js';
document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
})();
</script>
<script type='text/javascript'>
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/Adhesive_Medium_Rectangle_300x250', [300, 250], 'div-adhesive_medium_rectangle_300x250').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/ATF_Leaderboard_728x90', [[728, 90]], 'div-atf_leaderboard_728x90').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/Pushdown_1080x90', [1080, 90], 'div-pushdown_1080x90').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/ATF_Medium_Rectangle_300x250', [[300, 250], [300, 600]], 'div-atf_medium_rectangle_300x250').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/BTF_Leaderboard_728x90', [728, 90], 'div-btf_leaderboard_728x90').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/BTF_Medium_Rectangle_300x250', [300, 250], 'div-btf_medium_rectangle_300x250').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/e_commerce_widget', [564, 252], 'div-e_commerce_widget').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/Interstitial_1x1', [1, 1], 'div-interstitial_1x1').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/Mobile_Adhesion_320x50', [320, 50], 'div-mobile_adhesion_320x50').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/Mobile_Flex_1x1', [1, 1], 'div-mobile_flex_1x1').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/Mobile_Leaderboard_320x50', [320, 50], 'div-mobile_leaderboard_320x50').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/Photo_Gallery_Medium_Rectangle', [[300, 250], [320, 50]], 'div-photo_gallery_medium_rectangle').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/Screen_Shift_1x1', [1, 1], 'div-screen_shift_1x1').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/Site_Skin_1x1', [1, 1], 'div-site_skin_1x1').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/Sponsor_Logo_240x60', [240, 60], 'div-sponsor_logo_240x60').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/Deer_Forecast_Sponsor_Logo_240x60', [240, 60], 'div-Deer_Forecast_Sponsor_Logo_240x60').addService(googletag.pubads());
<?php if(is_page( 'battle-of-the-bows' )){ ?>

//Battle of the Bows
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/battle_of_the_bows/bob_presenting_sponsor', [240, 60], 'div-bob_presenting_sponsor').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/battle_of_the_bows/bob_region_1_medium_rectangle', [300, 250], 'div-bob_region_1_medium_rectangle').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/battle_of_the_bows/bob_region_2_medium_rectangle', [300, 250], 'div-bob_region_2_medium_rectangle').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/battle_of_the_bows/bob_region_3_medium_rectangle', [300, 250], 'div-bob_region_3_medium_rectangle').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/battle_of_the_bows/bob_region_4_medium_rectangle', [300, 250], 'div-bob_region_4_medium_rectangle').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/battle_of_the_bows/bob_region_sponsor_1', [240, 60], 'div-bob_region_sponsor_1').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/battle_of_the_bows/bob_region_sponsor_2', [240, 60], 'div-bob_region_sponsor_2').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/battle_of_the_bows/bob_region_sponsor_3', [240, 60], 'div-bob_region_sponsor_3').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/battle_of_the_bows/bob_region_sponsor_4', [240, 60], 'div-bob_region_sponsor_4').addService(googletag.pubads());

<?php } ?>

<?php if( is_category( 'trading-post' ) || in_category( 'trading-post' ) ){ ?>
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/ATF_Button_1', [125, 125], 'div-atf_button_1').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/ATF_Button_2', [125, 125], 'div-atf_button_2').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/BTF_Button_1', [125, 125], 'div-btf_button_1').addService(googletag.pubads());
googletag.defineSlot('/4930/<?php echo $dartDomain; ?>/BTF_Button_2', [125, 125],'div-btf_button_2').addService(googletag.pubads());
<?php } ?>
googletag.pubads().setTargeting("sect","<?php echo $term; ?>");
googletag.pubads().setTargeting("page","<?php echo $pageName; ?>");
googletag.pubads().setTargeting("camp","<?php echo $camp; ?>");
googletag.pubads().setTargeting("Audience segment","<?php echo $term; ?>");

googletag.pubads().enableSingleRequest();
googletag.pubads().enableSyncRendering();

googletag.pubads().enableVideoAds();
//googletag.pubads().collapseEmptyDivs();
googletag.enableServices();
</script>

<?php 
//sidebar
function imo_sidebar($type){
	//Speed up mobile load time by not loading sidebar in the background
	if(!mobile()){
		$dartDomain = get_option("dart_domain", $default = false); ?>
		<div class="sidebar-area">
			<div class="sidebar">
				<div class="widget_advert-widget">
					<?php imo_ad_placement("atf_medium_rectangle_300x250"); ?>		
				</div>
			</div>
		    <?php get_sidebar($type);

	    	echo '<div id="responderfollow"></div>';
			echo '<div class="sidebar advert">';
				echo '<div class="widget_advert-widget">';
					echo '<iframe id="sticky-iframe-ad" width="310" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad-sticky.php?ad_code='.$dartDomain.'"></iframe>';
				echo '</div>';
				get_sidebar("sticky");
			echo '</div>';
		echo '</div>';
	}
}
function imo_community_sidebar(){
	$dartDomain = get_option("dart_domain", $default = false);
	echo '<div class="sidebar-area">';
		echo '<div class="afs_ads">&nbsp</div>';
		echo '<label class="upload-button">';
        echo '<a href="/post-photo/"><span class="singl-post-photo"><span>Share Your Photo Now!</span></span></a>';
        //echo '<input id="image-upload" class="common-image-upload" type="file" name="photo-upload">';
		echo '</label>';
		echo '<div class="sidebar">';
			echo '<div class="widget_advert-widget">';
			echo '<iframe id="community-iframe-ad" width="300" height="250" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?ad_code='.$dartDomain.'"></iframe>';
			echo '</div>';
		echo '</div>';
		get_sidebar("community");
	echo '</div>';
}

//ad placement
function imo_ad_placement($size){ ?>
	<div id='div-<?php echo $size; ?>'>
		<script type='text/javascript'>
			googletag.cmd.push(function() { googletag.display('div-<?php echo $size; ?>'); });
		</script>
	</div>

<?php }
