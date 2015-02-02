<div class="dif-post post">
    <div class="feat-img">
        <a href="<?php the_permalink(); ?>" ><?php the_post_thumbnail('list-thumb'); ?></a>
    </div>
    <div class="dif-post-text">
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="profile-panel">
            <div class="profile-data">
                <ul class="prof-like">
                	<li>
                		<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                   </li>
                </ul>
            </div>
        </div>
        <?php if(in_category("master-angler")){ ?><span class="badge"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/pic/badge-ma.png" alt="Master Angler" /></span><?php } ?>
    </div>
</div>