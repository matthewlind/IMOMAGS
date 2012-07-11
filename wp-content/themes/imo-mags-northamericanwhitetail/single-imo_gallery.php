<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();
?>
<div class="entry-header">

	<h1 class="entry-title"><?php the_title() ?></h1>
	<div class="entry-info">
            <?php if (! in_category("What's Biting Now")): ?>
			<span class="author vcard"><span class="fn">by <?php the_author(); ?></span></span>
			<span class="spacer">&bull;</span>
            <?php endif; ?>
			<abbr class="published" title="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></abbr>
			<?php if (function_exists('imo_add_this')) {imo_add_this();} ?>
			
			<?php
			//if ($this_post_is_not_single) {
				echo ' <span class="spacer">&bull;</span> ';
				comments_popup_link(__('No comments', 'carrington-business'), __('1 comment', 'carrington-business'), __('% comments', 'carrington-business'));
			//}
			?>
		</div>
	</div>


<div class="col-ab">
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
			

	      <?php endif; ?>
	      
	              </div>
 
<?php
get_sidebar();
get_footer();
?>  	


  
