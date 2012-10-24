<?php

/**
 * Template Name: Superpost Single
 * Description: Displays a specific superpost
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * **********************************************************************
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();


$hostname = $_SERVER['SERVER_NAME'];

//First get post data
$spid =  get_query_var("spid");
$requestURL = "http://$hostname/slim/api/superpost/post/$spid";

$file = file_get_contents($requestURL);
$data = json_decode($file);
$data = $data[0];

//Then get attachment data
$requestURL3 = "http://$hostname/slim/api/superpost/children/not_comment/$spid";

$file3 = file_get_contents($requestURL3);
$attachmentData = json_decode($file3);


//Then get comment data
$requestURL2 = "http://$hostname/slim/api/superpost/comment_attachments/$spid";

$file2 = file_get_contents($requestURL2);
$commentData = json_decode($file2);

if (empty($commentData)) {


    $visible = "style='display:none;'";
}



$grav_url = "http://www.gravatar.com/avatar/" . $data->gravatar_hash . ".jpg?s=50&d=identicon";

$headerTitle = $data->post_type . ": " . $data->title;

$displayStyle = "display:none;";
$loginStyle = "";

if ( is_user_logged_in() ) {

	$displayStyle = "";
	$loginStyle = "display:none;";
	
	wp_get_current_user();
	
	$current_user = wp_get_current_user();
    if ( !($current_user instanceof WP_User) )
         return;
    }
    
    
// get the score of the post's author    
$requestURL4 = "http://$hostname/slim/api/superpost/user/score/".$data->user_id;
$file4 = file_get_contents($requestURL4);
$post_user_score = json_decode($file4);
$post_user_score = $post_user_score[0];


if (empty($data->display_name)) {
	$data->display_name = $data->username;
}

// Topic nice names
if($data->post_type == "tip"){
	$topicName = 'Tips & Tactics';
}else if($data->post_type == "trophy"){
	$topicName = 'Trophy Bucks';
}else if($data->post_type == "general"){
	$topicName = 'General Discussion';
}else if($data->post_type == "report"){
	$topicName = 'Rut Reports';
}else{
	$topicName = $data->post_type;
}
$state_slug = $data->state;

// convert some slugs
$stateSlugToAbbv = array("AL"=>"Alabama",
"AK"=>"Alaska",
"AZ"=>"Arizona",
"AR"=>"Arkansas",
"CA"=>"California",
"CO"=>"Colorado",
"CT"=>"Connecticut",
"DE"=>"Delaware",
"DC"=>"District Of Columbia",
"FL"=>"Florida",
"GA"=>"Georgia",
"HI"=>"Hawaii",
"ID"=>"Idaho",
"IL"=>"Illinois",
"IN"=>"Indiana",
"IA"=>"Iowa",
"KS"=>"Kansas",
"KY"=>"Kentucky",
"LA"=>"Louisiana",
"ME"=>"Maine",
"MD"=>"Maryland",
"MA"=>"Massachusetts",
"MI"=>"Michigan",
"MN"=>"Minnesota",
"MS"=>"Mississippi",
"MO"=>"Missouri",
"MT"=>"Montana",
"NE"=>"Nebraska",
"NV"=>"Nevada",
"NH"=>"New Hampshire",
"NJ"=>"New Jersey",
"NM"=>"New Mexico",
"NY"=>"New York",
"NC"=>"North Carolina",
"ND"=>"North Dakota",
"OH"=>"Ohio",
"OK"=>"Oklahoma",
"OR"=>"Oregon",
"PA"=>"Pennsylvania",
"RI"=>"Rhode Island",
"SC"=>"South Carolina",
"SD"=>"South Dakota",
"TN"=>"Tennessee",
"TX"=>"Texas",
"UT"=>"Utah",
"VT"=>"Vermont",
"VA"=>"Virginia",
"WA"=>"Washington",
"WV"=>"West Virginia",
"WI"=>"Wisconsin",
"WY"=>"Wyoming",
"AB"=>"Alberta",
"BC"=>"British Columbia",
"MB"=>"Manitoba",
"NB"=>"New Brunswick",
"NL"=>"Newfoundland and Labrador",
"NT"=>"Northwest Territories",
"NS"=>"Nova Scotia",
"NU"=>"Nunavut",
"ON"=>"Ontario",
"PE"=>"Prince Edward Island",
"QC"=>"Quebec",
"SK"=>"Saskatchewan",
"YT"=>"Yukon");   

$state = $stateSlugToAbbv[$state_slug];

if ($state == 'New York'){
	$state_slug = 'new-york';
}else if ($state == 'Rhode Island'){
	$state_slug = 'rhode-island';
}else if ($state == 'South Carolina'){
	$state_slug = 'south-carolina';
}else if ($state == 'South Dakota'){
	$state_slug = 'south-dakota';
}else if ($state == 'New Hampshire'){
	$state_slug = 'new-hampshire';
}else if ($state == 'New Jersey'){
	$state_slug = 'new-jersey';
}else if ($state == 'New Mexico'){
	$state_slug = 'new-mexico';
}else if ($state == 'North Carolina'){
	$state_slug = 'north-carolina';
}else if ($state == 'North Dakota'){
	$state_slug = 'north-dakota';
}else if ($state == 'New Brunswick'){
	$state_slug = 'new-brunswick';
}else if ($state == 'Newfoundland and Labrador'){
	$state_slug = 'newfoundland-and-labrador';
}else if ($state == 'Northwest Territories'){
	$state_slug = 'northwest-territories';
}else if ($state == 'Nova Scotia'){
	$state_slug = 'nova-scotia';
}else if ($state == 'Prince Edward Island'){
	$state_slug = 'prince-edward-island';	
}else{
	$state_slug = $state;
}


if($post_user_score->score == 1){
	$nicePoint = $post_user_score->score.' Point';
}else{
	$nicePoint = $post_user_score->score.' Points';
}

if($data->view_count == 1){
	$niceView = $data->view_count.' View';
}else{
	$niceView = $data->view_count.' Views';
}


?>
<!-- Don't delete this. It's part of imo-add-this -->
<div id="imo-add-this-spid" style="display:none;"><?php echo $spid; ?></div>
<div class="bonus-background">
	<div class="bonus">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('superpost-sidebar')) : else : ?><?php endif; ?>
	</div>
	<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : ?><?php endif; ?>
		</div>
</div>
<div class="col-abc single-header">
	<header class="header-title">
	    <h1 style="text-transform: capitalize;"><?php if($data->state != '' && $data->post_type == 'report'){ echo $state; }else{ echo 'Community:'; } ?> <?php echo $topicName; ?></h1>
	    <div class="community-crumbs">
	       	<a href="/community/">Community Home</a> &raquo; <a href="/community/<?php echo $data->post_type; ?>"><?php echo $topicName; ?></a><?php if($data->state != '' && $data->post_type == 'report'){ echo ' &raquo; <a href="/community/'.$data->post_type.'/'.strtolower($state_slug).'">'.$state.'</a>'; } ?>
		</div>

	</header>
</div>

<div class="col-abc super-content">
	
	<a href="/profile/<?php echo $data->username; ?>"><img src="/avatar?uid=<?php echo $data->user_id; ?>" class="recon-gravatar"></a>
		<div class="user-meta">
			<a class="username" href="/profile/<?php echo $data->username; ?>"><?php echo $data->display_name; ?></a>
			<p class="points"><?php echo $nicePoint; ?></p>
		</div>
		
<!--
	<a href="/profile/<?php echo $data->username ?>"><img src="/avatar?uid=<?php echo $data->user_id; ?>" class="recon-gravatar"></a>

		<a class="username" href="/profile/<?php echo $data->username ?>"><?php echo $data->display_name; ?></a>
		<div class="super-meta">Posted <abbr style="display:inline" class='recon-date timeago' title='<?php echo $data->created; ?>'><?php echo $data->created; ?></abbr> &#8226; <a href="/<?php echo $data->post_type; ?>" class="post-type"><?php echo $data->post_type; ?></a> &#8226; <?php echo $data->view_count; ?> views</div>
-->

		<div class="clearfix"></div>
		<div class="entry-header"><h1 class="entry-title"><?php echo $data->title; ?></h1>
		<div class="title-meta">
		<?php
		// Get the timestamp
		$timestamp = $data->created;
		
		// Convert the timestamp
		$date = date("F j, Y", strtotime($timestamp));
		$time = date("g:i A", strtotime($timestamp));
		?>

		<abbr style="display:inline" class="recon-date"><?php echo $date; ?> at <?php echo $time; ?> &#8226; <?php echo $niceView; ?></div>
		</div>
		<?php if (function_exists('imo_add_this')) {imo_add_this();} ?>
		
			<div <?php post_class('entry entry-full clearfix'); ?>>
				<div class="entry-content">
		
		            <div class="description">
		                <?php echo $data->body;?>
		            </div>
		       
			        <?php
			
			            foreach ($attachmentData as $attachment) {
			          
			            $media = "";
			            if($attachment->body){
			            	$caption = "<div class='attachment-caption'>$attachment->body</div>";
			            }
			            if ($attachment->post_type == "youtube") {
			
			                $videoID = $attachment->meta;
			                $media = "<div class='attachment-container'>";
			                $media .= '<iframe width="640" height="480" src="http://www.youtube.com/embed/' . $videoID . '" frameborder="0" allowfullscreen></iframe>';
			                $media .= "</div>$caption";
			
			            } else {
			
			                $photoURL = str_replace("thumb", "medium", $attachment->img_url);
			                $media = "<div class='attachment-container'><img src='$photoURL' width=615></div>$caption";
			                
			            }
			
			
			            echo $media;
			            
			            
			       }
			       echo '<div class="reply-btn"><a href="#comments">REPLY</a></div>';
			       //echo '<div class="like-btn"><a href="#"></a></div>';
			       //echo '<div class="count"><a href="#comments">2</a></div>';

			       echo '<a class="single-flag-button" spid="' . $spid . '"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/flag-button-gray.png" class="flag-image"></a>';
			       
			       
			?>
			
			<?php if (current_user_can('delete_others_posts')) { ?>    
			    <select class="editor-functions" spid="<?php echo $spid; ?>">
			    	<option>EDITOR OPTIONS</option>
			    	<option value="unapprove">Unapprove</option>
			    	<option value="teflon">Teflon</option>
			    </select>
			    
		    <?php } //ENDIF current_user_can('delete_others_posts')?>
	     
			</div>
		</div><!-- .entry -->
</div><!-- .col-abc -->



<div class="superpost-comment-container">
	<?php foreach ($commentData as $comment) {   
	
	// get the score of the users in the replies    
$requestURL5 = "http://$hostname/slim/api/superpost/user/score/".$comment->comment_user_id;
$file5 = file_get_contents($requestURL5);
$comment_user_score = json_decode($file5);
$comment_user_score = $comment_user_score[0];
?>
	<div class="col-abc super-comments zebra superpost-comment-single">
		<div class="avatar-holder">
	         <a href="/profile/<?php echo $comment->comment_username; ?>"><img src="/avatar?uid=<?php echo $comment->comment_user_id; ?>" class="superclass-gravatar_hash recon-gravatar"></a>
	         <p class="comment-points"><?php echo $comment_user_score->score. " points"; ?></p>
	    </div>
	
		<div class="superpost-comments">
				<div class="superpost-comment" <?php echo $visible; ?> >
	        		<div class="superclass-body">
	        			<a href="/profile/<?php echo $comment->comment_username; ?>" class="username"><?php echo $comment->comment_display_name; ?></a>
	        			
	        			
	        
	        			<p><?php echo $comment->comment_body; ?></p>
	        		</div>
	        			<?php
			            foreach ($comment->attachments as $attachment) {
				          
				            $media = "";
				
				            if ($attachment->attachment_post_type == "youtube") {
				
				                $videoID = $attachment->attachment_meta;
				                $media = "<div class='attachment-container'>";
				                $media .= '<iframe width="515" height="290" src="http://www.youtube.com/embed/' . $videoID . '" frameborder="0" allowfullscreen></iframe>';
				                $media .= "</div><div class='attachment-caption'>$attachment->attachment_body</div>";
				
				            } else {
				
				                $photoURL = str_replace("thumb", "medium", $attachment->attachment_img_url);
				                $media = "<div class='attachment-container'><img src='$photoURL' width=515></div><div class='attachment-caption'>$attachment->attachment_body</div>";
				                
				            }
				            echo $media;
			            }
			            
			            ?>
	           </div>
	           
	    </div>
	    <?php if (current_user_can('delete_others_posts')) { ?>    
		    <select class="editor-functions" spid="<?php echo $comment->comment_id; ?>">
		    	<option>EDITOR OPTIONS</option>
		    	<option value="unapprove">Unapprove</option>
		    	<option value="teflon">Teflon</option>
		    </select>
		    
	    <?php } //ENDIF urrent_user_can('delete_others_posts')?>
	    
	    <a class="single-flag-button" spid="<?php echo $comment->comment_id; ?>"><img src="/wp-content/themes/imo-mags-northamericanwhitetail/img/flag-button-gray.png" class="flag-image"></a>
	</div><!-- end superpost-comment-single -->
	<?php } ?>

<!-- INVISIBLE COMMENT FOR CLONING -->

	<div class="col-abc super-comments zebra superpost-comment-template" style="display:none">
		<div class="avatar-holder">
		     <img src="/avatar?uid=1" class="superclass-gravatar_hash recon-gravatar">
		</div>
		
		<div class="superpost-comments">
				<div class="superpost-comment">
				<span class="superclass-display_name">NOBODY</span>

		    		<div class="superclass-body">
		    					    
		    			<p>NICE.</p>
		    		</div>
		
		         </div>
		</div>
	</div><!-- end superpost-comment-single --><!-- end superpost-comment-single -->
	


</div>


<div class="col-abc super-comments">
	<div class="avatar-holder" style="<?php echo $displayStyle; ?>">
		<a href="/profile/<?php echo $current_user->user_nicename; ?>"><img src="/avatar?uid=<?php echo $current_user->ID; ?>" class="superclass-gravatar_hash recon-gravatar"></a>
        <a href="/profile/<?php echo $current_user->user_nicename; ?>"><?php echo $current_user->display_name; ?></a>  
    </div>

    <div id="comments" class="" style="height:500px:width:600px;background-color:white;">
    <?php if($data->post_type == "question"){
	    echo '<h1>Answer this question</h1> ';
    }else{
	    echo '<h1>Post a Reply</h1> ';
    } ?>
  

    <div class="media-section">
	        
	        	<form id="fileUploadForm-image" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-image-form">
			    	<div id="fileupload" >
			        	<div class="fileupload-buttonbar ">
			            	<label class="upload-button">
				                <span><span class="white-plus-sign">+</span><span class="button-text">ATTACH PHOTO</span></span>
				                <input id="image-upload" type="file" name="photo-upload" id="photo-upload" />
			                </label>
			           </div>
			       </div>
			       <input type="hidden" name="post_type" value="photo">
			       <input type="hidden" name="form_id" value="fileUploadForm">
		       </form><!-- end form -->
		      
			   <div class="video-button">
			        <span><span class="white-plus-sign"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/youtube.png" alt="YouTube" /></span>ADD YOUTUBE VIDEO</span>
			   </div>
			   <div class="video-url-form-holder-container" style="display:none;">
			   		<div class="video-url-form-holder" style="">
			        	<form id="video-url-form" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-image-form">		            
				            <div class="video-body-holder">
				            	<input type="text" name="body" id="video-body" placeholder="Paste YouTube URL or code here"/>
				            </div>
				            <input type="hidden" name="post_type" value="youtube">
				            <input type="hidden" name="form_id" value="fileUploadForm">
				       </form>
				   </div>
			       <div class="video-close-button">
			       </div>
			  </div><!-- /.video-url-form-holder-container-->
			  
			  <h4 style="display:none" class="photo-attachement-header">Photos</h4>
			  <div class="attached-photos">
			  </div>
		</div><!-- /.media-section-->


    <form id="fileUploadForm" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-comment-form">

        <textarea name="body" placeholder="What's up?"></textarea>
        
        <input type="hidden" name="parent" value="<?php echo $spid;?>">
        <input type="hidden" name="post_type" value="comment">

        <input id="file" type="file" name="photo-upload" id="photo-upload" style="display:none"/>
<!--    
        <input type="hidden" name="clone_target" value="superpost-box">
        <input type="hidden" name="attach_target" value="post-container">
        <input type="hidden" name="attachment_point" value="prepend">
        <input type="hidden" name="masonry" value="true"> 


-->

        <input type="hidden" name="post_type" value="comment">
        <input type="hidden" name="clone_target" value="superpost-comment-template">
        <input type="hidden" name="attach_target" value="superpost-comment-container">
        <input type="hidden" name="attachment_point" value="append">
        

        <input type="hidden" name="form_id" value="fileUploadForm">
        <input type="hidden" name="attachment_id" class="attachment_id" value="">




        <input type="submit" value="Submit" class="submit" style="<?php echo $displayStyle; ?>"/>
		<div class="fast-login-then-post-button" style="<?php echo $loginStyle; ?>">Submit & Login <img class="submit-icon" src="/wp-content/themes/imo-mags-northamericanwhitetail/img/fb.png" height=20 width=20></div>

        <p class="login-note">
        </p>
    </form>
  </div>    
</div><!-- end superpost comment form -->





<div class="pagi col-abc">
	<?php 
    //echo '<a class="prev-post" href="/plus/'.$data->post_type.'/'.$prev_post.'">Previous '.$data->post_type.'</a>'; 
    //echo '<a class="next-post" href="/plus/'.$data->post_type.'/'.$next_post.'">Next '.$data->post_type.'</a>';  
    ?>
</div><!-- .pagi -->
<div class="col-abc single-question-area">
	<div class="question-module">
		<div class="questions-slider">
		    <div class="slides-container-f">
		    	<h2>Recent Questions</h2>
		         	<ul id="slides-questions" class="jcarousel-skin-tango questions-feed">
		            	<?php 
		                     		for ($i = 1; $i <= 4; $i++) {
			                     		echo '<li>';
											echo '<div class="quote-area">';
											echo '<div class="top"></div>';
											echo '<div class="mdl">';
												echo '<a href="#"><img class="q-img" alt="" src=""></a>';
												echo '<h4 class="quote"><a href="#"></a></h4>';
												echo '<div class="user-info">';
											echo '<a href="/profile/username"><img class="user" alt="Post Image" src=""></a>';
											echo '<span>by </span><a class="username"></a>';
											echo '<a href="#" class="count">0</a>';
										echo '</div>';						
											echo '</div>';
											echo '<div class="btm"></div>';
										echo '</div>';
										echo '<div class="answers-area">';
											echo '<a href="#" class="answers-link">Answer</a> '; 
											echo '<a href="/community/question" class="plus-button questions-right"><span class="plus">+</span><span>Ask Your Question</span></a>';             
										echo '</div>';
									echo '</li>';
									} ?>
		            </ul>
		        </div>    
		    </div>
	</div>
	<div class="question-module-ad">
		 <?php if (function_exists("imo_dart_tag")) {
            imo_dart_tag("300x250");
          } else { ?>
  	        <!-- 300x250 Ad: -->
            <script type="text/javascript">
              document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.'+dartadsgen_site+'/;sect=;page=index;subs=;sz=300x250;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
            </script>
            <script type="text/javascript">
              ++pr_tile;
            </script>
            <noscript>
              <a href="http://ad.doubleclick.net/adj/imo.outdoorsbest/;sect=;page=index;subs=;sz=300x250
              ;dcopt=;tile=1;ord=7391727509?">
                <img src="http://ad.doubleclick.net/ad/imo.outdoorsbest/home;sect=;page=index;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?" border="0" />
              </a>
            </noscript>
            <!-- END 300x250 Ad: -->
          <?php } ?>

	</div>
</div><!-- .col-abc -->
<?php get_footer(); ?>
<pre><?php //print_r($commentData);?></pre>