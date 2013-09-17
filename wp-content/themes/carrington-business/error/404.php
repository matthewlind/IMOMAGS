<?php

/**
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
get_sidebar(); ?>

<header>
	<h1 class="page-title-b"><?php _e('<i class="label">Error 404:</i> Page Not Found', 'carrington-business'); ?></h1>
</header><!-- #masthead -->



<div class="content">

  <h1 style="margin-bottom:20px">Unfortunately, We can't find the page you are looking for. Here are the latest stories from <?php echo get_bloginfo("name"); ?></h1>




<?php
$custom_query = new WP_Query('order=DESC&limit=20');
while ($custom_query->have_posts()) : $custom_query->the_post();

?>


  <div id="post-excerpt-<?php the_ID(); ?>" <?php post_class('entry entry-excerpt clearfix') ?>>

    <div class="entry-summary" style="width:100%;">
      <?php if (in_category("ata-show-2013") ){ echo '<div class="ata-show-sticker"></div>';} ?>

      <div class="404-thumbnail">

        <?php
        if (has_post_thumbnail()) {
          echo '<a href="', the_permalink(),'">', the_post_thumbnail('post-thumbnail', array('class' => 'entry-img')), '</a>';
        }?>


      </div>
      <div class="404-content-exerpt" style="overflow: hidden;">

        <div class="entry-info">

          <h2 class="entry-title"><a rel="bookmark" href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
          <!--<span class="author vcard"><span class="fn">by <?php the_author(); ?></span></span>
          <span class="spacer">&bull;</span>-->
          <abbr class="published" title="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></abbr>
          <span class="spacer">&bull;</span>

          <?php comments_popup_link(__('No comments', 'carrington-business'), __('1 comment', 'carrington-business'), __('% comments', 'carrington-business')); ?>
        </div>

        <?php

        the_excerpt();
        ?>

        <div class="entry-footer">
          <?php
          the_category(', ');
          the_tags(__(' <span class="spacer">&bull;</span> Tagged ', 'carrington-business'), ', ', '');
          ?>
        </div>
        <?php edit_post_link(__('Edit', 'carrington-business')); ?>
      </div>
    </div>




  </div>


<?php endwhile; ?>

</div>

<?php get_footer(); ?>
