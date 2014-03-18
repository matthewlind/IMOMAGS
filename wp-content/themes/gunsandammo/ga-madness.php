<?php
/**
 * Template Name: GA Madness Page
 * Description: A Page Template for G&A Madness (bracket).
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
 
$dataPos = 0;
get_header(); ?>
    <div id="content" role="main" data-mobile="">
		<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
			<h1 class="page-title" style="display:none;height:0;">
				<div class="icon"></div>
				<span><?php the_title(); ?></span>
		    </h1>
		    <?php if(mobile()){ ?>
		    	<img class="madness-logo-mobile" src="/wp-content/themes/gunsandammo/images/ga-madness/GA-gun-madness-galco-small.png" alt="G&A Madness" title="G&A Madness" />
				<?php echo get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"presentingmadness")); 
			} ?>
		    <ul id="ga-madness-nav">
				<li><a href="/bracket">Gun Bracket</a></li>
				<li><a href="/bracket/enter">Enter</a></li>
				<?php if(!mobile()){ ?>
					<li class="madness-logo"><img src="/wp-content/themes/gunsandammo/images/ga-madness/GA-gun-madness-galco-small.png" alt="G&A Madness" title="G&A Madness" />
					</li>
				<?php } ?>
				<li><a href="/bracket/prizes">Prizes & Rules</a></li>
				<li><a href="/bracket/how-it-works">How it Works</a></li>
			</ul>
		</div>
		<div data-position="<?php echo $dataPos = $dataPos + 1; ?>"  id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix js-responsive-section'); ?>>
			<div class="article-holder ga-madness">

				<?php
					$ismobile = mobile();
					//$ismobile = true;
					the_content();
				?>
				
		    </div><!-- .article-holder -->
		</div>
		    <!-- log/reg popup start -->
			<div class="basic-popup basic-form reg-popup">
			    <div class="popup-inner clearfix gun">
			    	<h3>The Matchup</h3>
			    	<div class="addthis-below">
			    	<!-- Let's dynamically insert the gun matchups into the add this title -->
			    		<div addthis:url="http://<?php echo $_SERVER['SERVER_NAME']; ?>/bracket/" addthis:title="Gun vs. Gun" class="addthis_toolbox addthis_default_style ">
								<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
								<a class="addthis_button_tweet"></a>
								<a class="addthis_counter addthis_pill_style"></a>
							</div>
	
						<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=gunsandammo"></script>
			    	</div>
			    	<div class="vote-section gun">
				    	<h2>Nighthawk Costa Compact 9mm</h2>
				    	<img src="http://www.gunsandammo.com/files/2012/03/Springfield-XDS-001.jpg" alt="" title="" />
				    	<div class="popup-vote">VOTE</div>
			    	</div>
			    	<div class="vote-section versus">
			    		<div><h2>vs.</h2></div>		
			    	</div>	    	
					<div class="vote-section gun">
				    	<h2>Springfield XD-S 4.0</h2>
				    	<img src="http://www.gunsandammo.com/files/2012/04/SmithWessonMP9Shield_002.jpg" alt="" title="" />
				    	<div class="popup-vote">VOTE</div>
			    	</div>
			    	<a class="next-matchup">Go to the next matchup <span>&raquo;</span></a>
			    	
			    	<div class="modal-footer">
			    		<div class="modal-footer-content">
				    		<div class="bracket-sposor">
					    		<?php echo get_imo_dart_tag("300x50",1,false,array("sect" => "","camp"=>"")); ?>
				    		</div>
					    	<div class="related-content">
					    		<h4>Related Stories</h4>
					    		<ul>
					    			<li>Title of story</li>
					    			<li>Title of story</li>
							    </ul>
					    	</div>
					    	<?php echo get_imo_dart_tag("300x100",1,false,array("sect" => "","camp"=>"")); ?>
			    		</div>
			    	</div>
			    </div>
			    <a class="btn-close-popup jq-close-popup" href="#">close</a>
			    <ul class="flex-direction-nav">
				    <li><a class="flex-prev" href="#">Previous</a></li>
				    <li><a class="flex-next" href="#">Next</a></li>
				</ul>
			</div>
			<!-- log/reg popup end -->	

		
	</div><!-- #content -->

	
	
<?php get_footer(); ?>




















