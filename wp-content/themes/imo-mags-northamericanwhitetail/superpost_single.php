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

 //  <--- This?

if (empty($data->display_name)) {
	$data->display_name = $data->username;
}


?>
<!-- Don't delete this. It's part of imo-add-this -->
<div id="imo-add-this-spid" style="display:none;"><?php echo $spid; ?></div>

<header class="header-title">
	<div class="imo-fb-login-button" style="<?php echo $loginStyle; ?>">
	    	LOGIN
	    </div>
    	<ul id="user-bar" style="<?php echo $displayStyle; ?>">	          
			<li class="user-name">Hello, <a href="/profile/<?php echo $current_user->user_nicename; ?>"><span id="current-user-name"><?php echo $current_user->display_name; ?></span></a></li>
			<li><a href="/profile/<?php echo $current_user->user_nicename; ?>"><img src="/avatar?uid=<?php echo $current_user->ID; ?>" alt="User Avatar" class="recon-gravatar" /></a></li>                      
       </ul>

	<h1><a href="/community/">Community</a> <span>| <a href="/<?php echo $data->post_type; ?>"><?php echo $data->post_type; ?></a></span></h1>
</header>
<div class="bonus-background">
	<div class="bonus">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('superpost-sidebar')) : else : ?><?php endif; ?>
	</div>
	<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : ?><?php endif; ?>
		</div>
</div>
<div class="col-abc super-content">

	<a href="/profile/<?php echo $data->username; ?>"><img src="/avatar?uid=<?php echo $data->user_id; ?>" class="recon-gravatar"></a>
		<div class="user-meta">
			<a class="username" href="/profile/<?php echo $data->username; ?>"><?php echo $data->display_name; ?></a>
			<p class="points"><?php echo $post_user_score->score. " points"; ?></p>
		</div>
		<div class="super-meta">Posted on <abbr style="display:inline" class='recon-date'><?php the_time('F j, Y'); ?> &#8226; <?php the_time('g:i a'); ?></abbr> &#8226; <a href="/<?php echo $data->post_type; ?>" class="post-type"><?php echo $data->post_type; ?></a> &#8226; <?php echo $data->view_count; ?> views</div>

<!--
	<a href="/profile/<?php echo $data->username ?>"><img src="/avatar?uid=<?php echo $data->user_id; ?>" class="recon-gravatar"></a>

		<a class="username" href="/profile/<?php echo $data->username ?>"><?php echo $data->display_name; ?></a>
		<div class="super-meta">Posted <abbr style="display:inline" class='recon-date timeago' title='<?php echo $data->created; ?>'><?php echo $data->created; ?></abbr> &#8226; <a href="/<?php echo $data->post_type; ?>" class="post-type"><?php echo $data->post_type; ?></a> &#8226; <?php echo $data->view_count; ?> views</div>
-->

		<div class="clearfix"></div>
		<div class="entry-header"><h1 class="entry-title"><?php echo $data->title; ?></h1></div>
		<?php 
		if($data->post_type == "question"){
			$questionTopics = array("general"=>"General",
						            "tips"=>"Tips & Tactics",
						            "land"=>"Land Management",
						            "trophy"=>"Trophy Bucks",
						            "gear"=>"Gear",
						            "cooking"=>"Cooking");
		
	    	echo '<h3>in ' . $questionTopics[$data->secondary_post_type] . '</h3> ';
	    }
	    
	    if (function_exists('imo_add_this')) {imo_add_this();} ?>
		
			<div <?php post_class('entry entry-full clearfix'); ?>>
				<div class="entry-content">
		
		            <div class="description">
		                <?php echo $data->body;?>
		            </div>
		       
			        <?php
			
			            foreach ($attachmentData as $attachment) {
			          
			            $media = "";
			
			            if ($attachment->post_type == "youtube") {
			
			                $videoID = $attachment->meta;
			                $media = "<div class='attachment-container'>";
			                $media .= '<iframe width="640" height="480" src="http://www.youtube.com/embed/' . $videoID . '" frameborder="0" allowfullscreen></iframe>';
			                $media .= "</div><div class='attachment-caption'>$attachment->body</div>";
			
			            } else {
			
			                $photoURL = str_replace("thumb", "medium", $attachment->img_url);
			                $media = "<div class='attachment-container'><img src='$photoURL' width=615></div><div class='attachment-caption'>$attachment->body</div>";
			                
			            }
			
			
			            echo $media;
			            
			            
			       }
			       echo '<div class="reply-btn"><a href="#comments">REPLY</a></div>';
			       echo '<div class="like-btn"><a href="#"></a></div>';
			       echo '<div class="count"><a href="#comments">2</a></div>';

			       echo '<a class="single-flag-button" spid="' . $spid . '"><img src="http://www.northamericanwhitetail.deva/wp-content/themes/imo-mags-northamericanwhitetail/img/flag-button-gray.png" class="flag-image"></a>';
			       
			?>
	     
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
	    
	    <a class="single-flag-button" spid="<?php echo $comment->comment_id; ?>"><img src="http://www.northamericanwhitetail.deva/wp-content/themes/imo-mags-northamericanwhitetail/img/flag-button-gray.png" class="flag-image"></a>
	</div><!-- end superpost-comment-single -->
	<?php } ?>

<!-- INVISIBLE COMMENT FOR CLONING -->

	<div class="col-abc super-comments zebra superpost-comment-template" style="display:none">
		<div class="avatar-holder">
		     <a href="/profile/admin"><img src="/avatar?uid=1" class="superclass-gravatar_hash recon-gravatar"></a>
		</div>
		
		<div class="superpost-comments">
				<div class="superpost-comment"  >
		    		<div class="superclass-body">
		    			<a href="/profile/admin" class="username">NOBODY</a>
		    
		    			<p>NICE.</p>
		    		</div>
		
		         </div>
		</div>
	</div><!-- end superpost-comment-single --><!-- end superpost-comment-single -->
	


</div>


<div class="col-abc super-comments">
	<div class="avatar-holder">
		<img src="/avatar?uid=<?php echo $current_user->ID; ?>" class="superclass-gravatar_hash recon-gravatar">
        <a href="/profile/<?php echo $comment->comment_username; ?>"><?php echo $comment->comment_display_name; ?></a>
    </div>

    <div id="comments" class="new-superpost-modal-container" style="height:500px:width:600px;background-color:white;">
    <?php if($data->post_type == "question"){
	    echo '<h1>Answer this question</h1> ';
    }else{
	    echo '<h1>Post a Reply</h1> ';
    } ?>
  

    <div class="media-section">

      <h4 style="display:none" class="photo-attachement-header">Photos</h4>
      <div class="attached-photos">
      </div>

      <form id="fileUploadForm-image" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-image-form">
        <div id="fileupload" >
          <div class="fileupload-buttonbar ">
              <label class="upload-button">
                  <span><span class="white-plus-sign">+</span><span class="button-text">PHOTO</span></span>
                  <input id="image-upload" type="file" name="photo-upload" id="photo-upload" />

              </label>
          </div>
        </div>
        <input type="hidden" name="post_type" value="photo">
        <input type="hidden" name="source_form" value="comment">
        <input type="hidden" name="form_id" value="fileUploadForm">


      </form>

      <div class="video-button">
        <span><span class="white-plus-sign">+</span>VIDEO</span>
      </div>
      <div class="video-url-form-holder-container" style="display:none;">

        <div class="video-url-form-holder" style="">
          <form id="video-url-form" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-image-form">
            
            <div class="video-body-holder">
            <input type="text" name="body" id="video-body" placeholder="Paste YouTube URL or code here"/>
            </div>
            <input type="hidden" name="post_type" value="youtube">
            <input type="hidden" name="form_type" value="video_comment">
            <input type="hidden" name="source_form" value="comment">
            <input type="hidden" name="form_id" value="fileUploadForm">


          </form>

        </div>
        <div class="video-close-button">
        </div>
      </div>

    </div>

    <form id="fileUploadForm" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-comment-form">

        <textarea name="body" id="body" placeholder="What's up?"></textarea>
        
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




        <input type="submit" value="Submit" class="submit" />
        <p class="login-note">
        </p>
    </form>
  </div>    
</div><!-- end superpost comment form -->





<div class="pagi col-abc">
	<?php 
    echo '<a class="prev-post" href="/plus/'.$data->post_type.'/'.$prev_post.'">Previous '.$data->post_type.'</a>'; 
    echo '<a class="next-post" href="/plus/'.$data->post_type.'/'.$next_post.'">Next '.$data->post_type.'</a>';  
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
							echo '<div class="user-info">';
								echo '<a href="/profile/username"><img class="superclass-gravatar_hash recon-gravatar" alt="user avatar" src="http://www.northamericanwhitetail.fox/wp-content/themes/imo-mags-northamericanwhitetail/img/user-temp.jpg"></a>';
								echo '<a class="username">Batman</a><span> asks...</span>';
							echo '</div>';
							echo '<div class="quote-area">';
								echo '<div class="top"></div>';
								echo '<div class="mdl">';
									echo '<h4 class="quote">&#8220;Can anyone suggest a good camo bat-suit for hunting in the forest? I am having trouble hunting in the day time.&#8221;</h4>';
								echo '</div>';
								echo '<div class="btm"></div>';
							echo '</div>';
							echo '<div class="answers-area">';
								echo '<div class="answers-count">';
									echo '<div class="answers">Answers</div><div class="count"><a href="#">18</a></div>';
								echo '</div>';
								echo '<a href="#" class="answers-link">Answer This Question</a>'; 
								echo '<div class="see-all-area"><a href="/question" class="see-all home-see-all">See All Questions</a></div>';
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