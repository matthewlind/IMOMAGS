<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
$dataPos = 0;
?>
<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
	<h1 class="page-title<?php if(is_page("guns-ammo-tv-2")){ echo ' section-title videos'; } ?>">
		<div class="icon"></div>
		<span><?php the_title(); ?></span>
    </h1>
</div>



<div data-position="<?php echo $dataPos = $dataPos + 1; ?>"  id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix js-responsive-section'); ?>>
	<div class="article-holder">
		<div class="addthis-below" <?php if(mobile()){ echo 'style="width: 320px;"'; } ?>><?php if (function_exists('imo_add_this')) {imo_add_this();} ?></div>
		<?php the_content(); ?>


		<table>

			<tr>
				<?php

	                global $wpdb;

	                $sql = "SELECT *,CONVERT(likes.meta_value, UNSIGNED INTEGER) as like_count FROM wp_14_posts as posts
	                        JOIN wp_14_postmeta AS likes ON (posts.ID = likes.post_id AND likes.meta_key = 'facebook_like_count')
	                        WHERE post_type = 'reader_photos'
	                        ORDER BY like_count DESC LIMIT 25";

	                $posts = $wpdb->get_results($sql);

	                $place = 0;

	                foreach ($posts as $post) {
	                	$place++;

	                	$thumb_id = get_post_thumbnail_id($post->ID);
                        $thumb_url = wp_get_attachment_image_src($thumb_id,"imo-mini-slider-thumb");
                        $thumbnailURL = $thumb_url[0];

                        echo "<tr>";

                        echo "<td>";
                        echo "<span class='leaderboard-place'>$place</span>";
                        echo "</td>";

                        echo "<td>";
                        echo "<img height=70 width=70 src='$thumbnailURL'>";
                        echo "</td>";

                        echo "<td>";
                        echo "<div>{$post->post_title}</div>";
                        echo "<div><span class='like-count'>{$post->like_count}</span> <img src='/wp-content/plugins/imo-facebook-like-import/like@2x.png' class='like-icon'></div>";
                        echo "</td>";

                        echo "</tr>";

	                }

                ?>
			</tr>
		</table>



		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
    </div>
</div><!-- #post-<?php the_ID(); ?> -->

<?php sub_footer(); ?>

