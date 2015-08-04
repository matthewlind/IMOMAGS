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
	$photosURL = "/photos?";
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
                <h4><a href="/author/<?php the_author_link(); ?>"><?php the_author(); ?></a></h4>
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
	            </div>
	        </div>        
        <?php if(in_category("master-angler")){ ?><span class="badge"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/pic/badge-ma.png" alt="Master Angler" /></span><?php } ?>
    </div>
</div>