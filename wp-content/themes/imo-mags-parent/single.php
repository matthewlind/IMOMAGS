<?php
get_header();
if(get_field('featured_stories')){
	$features = get_field('featured_stories'); 
}else{
	$features = get_field('article_featured_stories','options' ); 
}

$day = get_field("day", "options");
$end_time = get_field("air_time", "options");

date_default_timezone_set('US/Eastern');
$currenttime = date('Hi');
  
if(date("l") == $day && $current_time < $end_time && get_field("display_widget","options" == true)){
	the_widget("TuneIn_Widget");
}else{ ?>
	<div class="special-features">
		<ul>
			<li class="home-featured features">
				<div class="arrow-right"></div>
				<div class="feat-post">
		        	<div class="feat-text">
		        	<h3>
			        	<?php if(get_field('featured_stories_title')){
			        		echo get_field("featured_stories_title"); 
		        		}else if(get_field("featured_title","options")){ 
		        			echo get_field("featured_title","options"); 
		        		} ?>
		        	</h3>
		            </div>
		        </div>
			</li>
			<?php if( $features ){
				foreach( $features as $feature ): 
				
					if(get_field("promo_title",$feature->ID)){
				    	$title = get_field("promo_title",$feature->ID);
					}else{
				    	$title = $feature->post_title;
					} 
						
					$url = $feature->guid;
			    	$tracking = "_gaq.push(['_trackEvent','Special Features Article','$title','$url']);";
					$thumb = get_the_post_thumbnail($feature->ID,"list-thumb"); ?>
			    	<li class='home-featured'>
			            <div class='feat-post'>
			                <div class='feat-text'>
			                    <h3><a href='<?php echo $url; ?>' onclick='<?php echo $tracking; ?>'><?php echo $title ?></a></h3>
			                </div>
			            </div>
			        </li>
			    <?php endforeach; ?>
		<?php } ?>
		</ul>
</div>
<?php } ?>
    <div class="inner-main">
    	<?php //imo_sidebar(); ?>
		<div id="primary" class="general">
            <div id="content" class="general-frame" role="main">

                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content/content-single', get_post_format() ); ?>

                    <div class="post-comments-area">
                        <?php comments_template( '', true ); ?>
                    </div>

                    <div class="hr"></div>
                    <?php social_footer(); ?>
					<a href="#" class="back-top jq-go-top">back to top</a>
                <?php endwhile; // end of the loop. ?>

            </div><!-- #content -->
        </div><!-- #primary -->

    </div>
<?php get_footer(); ?>