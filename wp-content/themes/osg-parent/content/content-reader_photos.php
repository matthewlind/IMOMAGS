<?php $postID = get_the_ID(); ?>

<li id="photos-gallery">
	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('community-square-retina'); ?></a>
</li>

<div class="dif-post" style="display:none;">
        <div class="feat-img">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('community-square-retina'); ?></a>
        </div>
    <div class="dif-post-text">
        <h3><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
        <div class="profile-panel">
            <div class="profile-data">
                <h4>By <a class="author-link" href="/author/<?php echo get_the_author_meta( "user_nicename" ); ?>/"><?php the_author(); ?></a></h4>
                <ul class="prof-tags">
                    <?php
                        $categories = get_the_category();

                        if($categories){
                            foreach($categories as $category) {
                                echo "<li>" . $category->name . "</li>";
                            }
                        }
                    ?>
                </ul>
                <ul class="replies">
                    <li><a href="<?php the_permalink(); ?>/#reply_field"><?php echo get_comments_number(); ?> Reply</a></li>
                </ul>
                <ul class="prof-like">
                    <li>
                        <?php 
                        $url = get_the_permalink();
						if(function_exists('wpsocialite_markup')){ wpsocialite_markup( array("url"=>$url,"button_override"=>"facebook") ); } 
						?>
                   </li>
                </ul>
            </div>
        </div>
    </div>
</div>



