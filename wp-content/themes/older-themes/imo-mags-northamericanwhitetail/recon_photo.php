<?php

/**
 * Template Name: Recon Photo
 * Description: Displays a specific photo
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

//Then get comment data
$requestURL2 = "http://www.northamericanwhitetail.deva/slim/api/superpost/children/comment/$spid";

$file2 = file_get_contents($requestURL2);
$commentData = json_decode($file2);

if (empty($commentData[0])) {

	$commentData[0] = "hey";
	$visible = "style='display:none;'";
}

$grav_url = "http://www.gravatar.com/avatar/" . $data->gravatar_hash . ".jpg?s=25&d=identicon";
?>
<header id="masthead">
	<h1>RECON NETWORK: PHOTO</h1>
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
       
            <img src="<?php echo $data->img_url; ?>" width=585>
            <div class="userinfo">
            <img src="<?php echo $grav_url; ?>"> <?php echo $data->username; ?>
            </div>
     
		</div>
	</div><!-- .entry -->

	<h2>Comments:</h2>
	<div class="superpost-comment-form">
        <form id="fileUploadForm" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="superpost-form">
            <h3>Post a Comment!</h3>
           <textarea name="body" placeholder="What do you want to say?"></textarea>
            <input type="file" id="photo-upload" name="photo-upload"  /><br/>
            <input type="hidden" name="parent" value="<?php echo $spid;?>">
            <input type="hidden" name="post_type" value="comment">
            <input type="hidden" name="clone_target" value="superpost-comment">
            <input type="hidden" name="attach_target" value="superpost-comments">
            <input type="hidden" name="attachment_point" value="prepend">
            <input type="hidden" name="masonry" value="false">
            <input type="hidden" name="form_id" value="fileUploadForm">
            <input type="submit" value="Submit" class="submit" />
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
                    <img src="<?php echo $comment->img_url; ?>" class="superclass-img_url" width=200 style="<?php echo $displayImage; ?>">
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
