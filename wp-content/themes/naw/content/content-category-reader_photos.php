<?php 
$id = get_the_id(); 

$comment_number = get_comments_number();
if($comment_number == 1){
	$reply = "reply";
}else{
	$reply = "replies";
}

$categories = get_the_category($id);
$separator = ' ';
$output = '';
if($dartDomain == "imo.hunting"){
	$photosURL = "/rack-room?";
}else{
	$photosURL = "/community?";
}
?>
<div class="dif-post post">
    <div class="feat-img">
        <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('list-thumb'); ?></a>
    </div>
    <div class="dif-post-text">
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="profile-panel">
            <div class="profile-data">
                <h4><a href="/author/<?php echo get_the_author_meta("user_nicename"); ?>"><?php the_author(); ?></a></h4>
                <ul class="prof-tags">
                	<?php foreach($categories as $category) { ?>
                    	<li><a href="<?php echo $photosURL.$category->slug; ?>"><?php echo $category->cat_name; ?></a></li>    
                    <?php } ?>                
                </ul>
	            <div class="clearfix"></div>
                <ul class="replies">
                    <li><?php the_time('F jS, Y'); ?><div class="bullet"></div></li>
                    <li><a class="comment-count" href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(). " ".$reply; ?></a></li>
                </ul>
                <ul class="prof-like">
                	<li>
                		<div class="fb-like fb_iframe_widget" data-href="<?php echo get_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                   </li>
                </ul>
            </div>
	    </div>        
    </div>
</div>