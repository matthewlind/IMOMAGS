<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header(); ?>

<div id="carrington-modules" <?php post_class('entry entry-full col-abc'); ?>>
  <div class="cfct-row cfct-row-ab-c">
    <div class="gallery-page">
      <div class="entry-header">
  			<h1 class="entry-title"><?php the_title() ?></h1>
    		<div class="entry-info">
    			<span class="author vcard"><span class="fn">by <?php the_author_link(); ?></span></span>
    			<span class="spacer">|</span>
    			<time class="published" datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></time>
    		</div>
    		<a class="comment-count" href="<?php comments_link(); ?>"><?php echo get_comments_number(); ?></a>
    	</div>
    	<div class="entry-content">
    	<?php imo_add_this(); ?>
				<?php the_content(); ?>
  		</div>
    </div>
    </div>
  <div class="cfct-row cfct-row-abc">
    <div class="cfct-block cfct-block-abc">
      <div class="ngg-imagebrowser-container">
      <?php $gallery_id = get_post_meta(get_the_ID(), '_gallery_id', TRUE);

    	// get the pictures
      $picturelist = nggdb::get_gallery($gallery_id);

    	// $_GET from wp_query
      $pid  = get_query_var('pid');
  
      // we need to know the current page id
      $current_page = (get_the_ID() == false) ? 0 : get_the_ID();

    	// create a array with id's for better walk inside
        foreach ($picturelist as $picture)
            $picarray[] = $picture->pid;

        $total = count($picarray);

        if ( !empty( $pid )) {
            if ( is_numeric($pid) )     
                $act_pid = intval($pid);
            else {
                // in the case it's a slug we need to search for the pid
                foreach ($picturelist as $key => $picture) {
                    if ($picture->image_slug == $pid) {
                        $act_pid = $key;
                        break;
                    }
                }           
            }
        } else {
            reset($picarray);
            $act_pid = current($picarray);
        }
    
        // get ids for back/next
        $key = array_search($act_pid, $picarray);
        if (!$key) {
            $act_pid = reset($picarray);
            $key = key($picarray);
        }
        $back_pid = ( $key >= 1 ) ? $picarray[$key-1] : end($picarray) ;
        $next_pid = ( $key < ($total-1) ) ? $picarray[$key+1] : reset($picarray) ;
    
        // get the picture data
        $picture = nggdb::find_image($act_pid);

        error_log("**********8888888**********8888888**********8888888**********8888888**********8888888**********8888888");

        // add more variables for render output
        $picture->href_link = $picture->get_href_link();
        $args ['pid'] = ($ngg->options['usePermalinks']) ? $picturelist[$back_pid]->image_slug : $back_pid;
        $picture->previous_image_link = $nggRewrite->get_permalink( $args );
        $picture->previous_pid = $back_pid;
        $args ['pid'] = ($ngg->options['usePermalinks']) ? $picturelist[$next_pid]->image_slug : $next_pid;
        $picture->next_image_link  = $nggRewrite->get_permalink( $args );
        $picture->next_pid = $next_pid;
        $picture->number = $key + 1;
        $picture->total = $total;
        $picture->linktitle = htmlspecialchars( stripslashes($picture->description) );
        $picture->alttext = html_entity_decode( stripslashes($picture->alttext) );
        $picture->description = html_entity_decode( stripslashes($picture->description) );
        $picture->anchor = 'ngg-imagebrowser-' . $picture->galleryid . '-' . $current_page;
    	  ?>

    		<?php if (!empty ($picture)) : ?>

  			<a name="image"></a>
  			<div class="ngg-imagebrowser" id="<?php echo $picture->anchor ?>">
          <div class="pic"><?php echo $picture->href_link ?></div>
  			
    			<div class="ngg-imagebrowser-nav"> 
  					<div class="back">
  						<a class="ngg-browser-prev" id="ngg-prev-<?php echo $picture->previous_pid ?>" href="<?php echo $picture->previous_image_link ?>#image">&#9668; <?php _e('Back', 'nggallery') ?></a>
  					</div>
  					<div class="next">
  						<a class="ngg-browser-next" id="ngg-next-<?php echo $picture->next_pid ?>" href="<?php echo $picture->next_image_link ?>#image"><?php _e('Next', 'nggallery') ?> &#9658;</a>
  					</div>
  					<h3 class="imo-gallery-title"><?php echo $picture->alttext ?></h3>
  					<div class="counter"><?php echo $picture->number ?> <?php _e('of', 'nggallery')?> <?php echo $picture->total ?></div>
  					<div class="ngg-imagebrowser-desc"><p><?php echo $picture->description ?></p></div>
  				</div>
				</div>
				<div class="gallery-sidebar">
				  <?php the_widget('imo\AdvertWidget'); ?>
				  <div class="more-lists fancy">
				    <h4><span>More G&amp;A Lists</span></h4>
				    <?php
				    
				    $args = array(
          		
          		'post_type'			=>	'imo_gallery',
          		'posts_per_page' => 3,
          		'orderby'			=>	'date', // may need to switch to menu_order
          		'order'				=>	'DESC'
          	);
          	
          	$galleries = new WP_Query($args); 
          	while ($galleries->have_posts()) : $galleries->the_post(); ?>
          	<article id="post-excerpt-<?php the_ID(); ?>" <?php post_class('entry') ?>>
          	  <?php	if (has_post_thumbnail()) :
            		echo '<a href="', the_permalink(),'">', the_post_thumbnail('small-featured-thumb', array('class' => 'entry-img')), '</a>'; ?>
              <?php	endif; ?>

            	<div class="entry-summary">
            		<h5 class="entry-title"><a rel="bookmark" href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
            	</div>
            </article>
          	<?php endwhile;
         // Reset Post Data
		wp_reset_postdata();


          		$args2 = array(
          		
          		'category_name'			=>	'galleries',
          		'posts_per_page' => 3,          		'orderby'			=>	'date', // may need to switch to menu_order
          		'order'				=>	'DESC'
          	);
          			
		$galleries_old = new WP_Query($args2); 
          	while ($galleries_old->have_posts()) : $galleries_old->the_post(); ?>
          	<article id="post-excerpt-<?php the_ID(); ?>" <?php post_class('entry') ?>>
          	  <?php	if (has_post_thumbnail()) :
            		echo '<a href="', the_permalink(),'">', the_post_thumbnail('small-featured-thumb', array('class' => 'entry-img')), '</a>'; ?>
              <?php	endif; ?>

            	<div class="entry-summary">
            		<h5 class="entry-title"><a rel="bookmark" href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
            	</div>
            </article>
          	<?php endwhile;
         // Reset Post Data
		wp_reset_postdata();
        ?>
        	<a class="cta" href="/ga-lists">More Lists <span></span></a>
				  </div>
				</div>

	      <?php endif; ?>
	      
	              </div>
    </div>
  </div>
	
  <div class="cfct-row cfct-row-ab-c ga-list-comments">
    <div class="cfct-block cfct-block-ab">
    	<?php imo_add_this(); ?>
    	
     	<?php comments_template(); ?>
	</div>
	
  </div>

  
  <div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-gallery')) : else : ?><?php endif; ?>
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
