

<div class="dif-post">
        <div class="feat-img">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('community-square-retina'); ?></a>
        </div>
    <div class="dif-post-text">
        <h3><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
        <div class="profile-panel">
            <div class="profile-photo">
                <a class="author-link" href="/author/<?php echo get_the_author_meta( "user_nicename" ); ?>/">
                <img src="/avatar?uid=<?php echo get_the_author_meta( "ID" ); ?>" alt="<?php echo get_the_author_meta( "user_nicename" ); ?>" title="<?php echo get_the_author_meta( "user_nicename" ); ?>" />
                </a>
            </div>
            <div class="profile-data">
                <h4>By <a class="author-link" href="/author/<?php echo get_the_author_meta( "user_nicename" ); ?>/"><?php the_author(); ?></a></h4>
                <ul class="prof-tags">
                    <?php

                        $categories = get_the_category();

                        if($categories){
                            foreach($categories as $category) {
                                echo "<li>" . $category->name . "</li>";
                            }
                        };
                    ?>
                </ul>
                <ul class="replies">
                    <li><a href="<?php the_permalink(); ?>/#reply_field"><?php echo get_comments_number(); ?> Reply</a></li>
                </ul>
                <ul class="prof-like">
                    <li>
                        <div addthis:url="<?php the_title(); ?>" addthis:title="<?php the_title(); ?>" class="addthis_toolbox addthis_default_style " id="posts-container">
                            <a class="addthis_button_facebook_like"fb:like:layout="button_count"></a>
                        </div>

                   </li>
                </ul>
            </div>
        </div>
    </div>
</div>



