<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }



$productName = get_post_meta($post->ID,"product_name",true);
$productDescription = get_post_meta($post->ID,"product_description",true);
$thumbnailID = get_post_meta($post->ID,"product",true);

$thumbnailImage = wp_get_attachment_image($thumbnailID,"thumbnail");




get_header(); ?>
<div class="page-flow">
	<div id="content" class="col-abc">
	  <div <?php post_class('entry entry-full clearfix') ?>>
	  	<div class="entry-header">
				<h1 class="entry-title"><?php the_title() ?></h1>
	  		<div class="entry-info">
	  			<span class="author vcard"><span class="fn">by <?php the_author_link(); ?></span></span>
	  			<span class="spacer">|</span>
	  			<time class="published" datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></time>
	  		</div>
	  		<a class="comment-count" href="<?php comments_link(); ?>"><?php echo get_comments_number(); ?></a>
	      <?php imo_add_this(); ?>
	  	</div>
	  	<div class="entry-content"><p>
	  		<?php echo $post->post_content; ?></p>
	  		
	  		<div class="caption-banner">
	        <div class="caption-banner-text">This Week's Photo</div>
	        
	      </div>
	
	      <div class="caption-contest">
	  		  
	  		  <?php $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), "full"); ?>
			    <img src="<?php echo $img_src[0]; ?>" class="wp-post-image" alt="<?php the_title(); ?>" />
	  		  
	  		  <?php
	  		  $commentID = get_post_meta($post->ID, '_caption_id', true);
	  		  if ($commentID) : 
	    		  $comment = get_comment($commentID); ?>
	  		    <h2>The Winning Caption:</h2>
	    		  <?php echo get_avatar($comment->comment_author_email, 60); ?>
	    		  <div class="winning-caption">
	    		    <div class="author"><?php echo $comment->comment_author; ?></div>
	    		    <div class="caption"><?php echo $comment->comment_content; ?></div>
	    		  </div>
	  		  <?php endif; ?>
	  		
	  		</div>
	
	      <div class="prize-box">
	        <div class="prize-thumb">
	          <?php echo $thumbnailImage; ?>
	        </div>
	        <h2>The Prize:</h2>
	        <h4><?php echo $productName; ?></h4>
	        <p><?php echo $productDescription; ?></p>
	
	        
	      </div>
	
	  	</div>
	    <!-- <div class="entry-footer">
	      <?php the_tags(__('Tagged ', 'carrington-business'), ', ', '');
	      wp_link_pages(); ?>
	    </div> -->
	  </div>
	  <?php comments_template(); ?>
	</div>
	<div id="sidebar">
	  <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-video')) : else : ?><?php endif; ?>
	  <div id="responderfollow"></div>
		<div class="sidebar advert">
			<script type="text/javascript">
	              document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.'+dartadsgen_site+'/;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
	            </script>
	            <script type="text/javascript">
	              ++pr_tile;
	            </script>
	            <noscript>
	              <a href="http://ad.doubleclick.net/adj/imo.outdoorsbest/;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?">
	                <img src="http://ad.doubleclick.net/ad/imo.outdoorsbest/home;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?" border="0" />
	              </a>
	            </noscript>

			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
