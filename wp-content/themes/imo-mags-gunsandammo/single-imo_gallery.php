<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

get_header();
?>

	<?php

	$gallery_id = get_post_meta(get_the_ID(), '_gallery_id', TRUE);

	if (have_posts()) :
   		while (have_posts()) :
   		the_post();


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
			
			<h1><?php the_title();?></h1>
			<a name="image"></a>
					<div class="gallery-description" style="width:640px;">
						<?php the_content(); ?>
					</div>
			<div class="bonus-background">
				<div class="bonus">

					<div class="ngg-imagebrowser-nav"> 
						<div class="back">
							<a class="ngg-browser-prev" id="ngg-prev-<?php echo $picture->previous_pid ?>" href="<?php echo $picture->previous_image_link ?>#image">&#9668; <?php _e('Back', 'nggallery') ?></a>
						</div>
						<div class="next">
							<a class="ngg-browser-next" id="ngg-next-<?php echo $picture->next_pid ?>" href="<?php echo $picture->next_image_link ?>#image"><?php _e('Next', 'nggallery') ?> &#9658;</a>
						</div>
						<h3 class="imo-gallery-title" style="clear:both;padding-top:20px;"><?php echo $picture->alttext ?></h3>
						<div class="counter"><?php _e('Picture', 'nggallery') ?> <?php echo $picture->number ?> <?php _e('of', 'nggallery')?> <?php echo $picture->total ?></div>
						<div class="ngg-imagebrowser-desc"><p><?php echo $picture->description ?></p></div>
						
					</div>
				</div>
			</div>

			<div class="col-ab">

			<div class="ngg-imagebrowser imo-gallery" id="<?php echo $picture->anchor ?>" style="margin-top:0px;padding-top:0px;">
				
				<div class="pic"><?php echo $picture->href_link ?></div>

			</div>

		<?php endif; ?>

   		<?php
   		endwhile;
	endif;
	
	comments_template(); ?>
</div>

<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-gallery')) : else : ?><?php endif; ?>
<?php
get_footer();
?>
