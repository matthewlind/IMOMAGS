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


//First get post data
$spid =  get_query_var("spid");
$requestURL = "http://www.northamericanwhitetail.deva/slim/api/superpost/post/$spid";

$file = file_get_contents($requestURL);
$data = json_decode($file);
$data = $data[0];


//Then get attachment data
$requestURL3 = "http://www.northamericanwhitetail.deva/slim/api/superpost/children/not_comment/$spid";

$file3 = file_get_contents($requestURL3);
$attachmentData = json_decode($file3);


//Then get comment data
$requestURL2 = "http://www.northamericanwhitetail.deva/slim/api/superpost/children/comment/$spid";

$file2 = file_get_contents($requestURL2);
$commentData = json_decode($file2);

if (empty($commentData[0])) {

    $commentData[0] = "hey";
    $visible = "style='display:none;'";
}



$grav_url = "http://www.gravatar.com/avatar/" . $data->gravatar_hash . ".jpg?s=25&d=identicon";

$headerTitle = $data->post_type . ": " . $data->title;

?>
<header id="masthead">
	<h1><?php echo $headerTitle; ?></h1>
	<?php edit_post_link(__('Edit', 'carrington-business')); ?>
    <?php //echo $requestURL; ?>
</header><!-- #masthead -->
<div class="bonus-background">
	<div class="bonus">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-landing')) : else : ?><?php endif; ?>
	</div>
</div>
<div class="col-abc">
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
                        $media = "<li><div class='attachment-container'>";
                        $media .= '<iframe width="640" height="480" src="http://www.youtube.com/embed/' . $videoID . '" frameborder="0" allowfullscreen></iframe>';
                        $media .= "</div><div class='attachment-caption'>$attachment->body</div></li>";

                    } else {

                        $photoURL = str_replace("thumb", "medium", $attachment->img_url);
                        $media = "<li><div class='attachment-container'><img src='$photoURL' width=585></div><div class='attachment-caption'>$attachment->body</div></li>";
                        
                    }


                    echo $media;

                }


            ?>

            




            <div class="userinfo">
            <img src="<?php echo $grav_url; ?>"> <?php echo $data->username; ?>
            </div>
     
		</div>
	</div><!-- .entry -->


    <div class="new-superpost-modal-container" style="height:500px:width:600px;background-color:white;">
    <h1>Post a Comment!</h1>

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
            <input type="hidden" name="form_type" value="video_comment  ">
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
        <input type="hidden" name="clone_target" value="superpost-comment">
        <input type="hidden" name="attach_target" value="superpost-comments">
        <input type="hidden" name="attachment_point" value="prepend">
        

        <input type="hidden" name="form_id" value="fileUploadForm">
        <input type="hidden" name="attachment_id" class="attachment_id" value="">




        <input type="submit" value="Submit" class="submit" />
        <p class="login-note">
        </p>
    </form>
  </div>

	<div class="superpost-comments">
		
        <pre><?php //print_r($commentData);?></pre>
        <?php foreach ($commentData as $comment) {    
            $displayImage = "";
            if (empty($comment->img_url))
                $diplayImage = "display:none;";
            ?>
        	<div class="superpost-comment" <?php echo $visible; ?> >
        		<div class="superclass-body">
        			<?php echo $comment->body; ?>
        		</div>
                <div class="superpost-image">
                    <!-- <img src="<?php echo $comment->img_url; ?>" class="superclass-img_url" width=200 style="<?php echo $displayImage; ?>"> -->
                </div>
        		<div class="avatar-holder">
                    <img src="http://www.gravatar.com/avatar/<?php echo $comment->gravatar_hash; ?>.jpg?s=25&d=identicon" class="superclass-gravatar_hash">
                    <a href="userlink"><?php echo $comment->username; ?></a>
                </div>

        	</div>


        <?php } ?>



    </div>

</div><!-- .col-abc -->
<?php get_footer(); ?>
