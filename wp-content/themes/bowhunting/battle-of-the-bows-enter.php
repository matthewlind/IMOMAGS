<?php
/**
 * Template Name: Battle of the Bows Enter Page
 * Description: A full width page template without the sidebar and viral sweeps for Battle of the Bows entries.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
 
$dataPos = 0;
get_header(); ?>
    <div id="content" role="main">
    	<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
			<h1 class="page-title" style="display:none;height:0;">
				<div class="icon"></div>
				<span><?php the_title(); ?></span>
		    </h1>
		    <?php if(mobile()){ ?>
		    	<img class="madness-logo-mobile" src="/wp-content/themes/gunsandammo/images/ga-madness/ga-madness-logo-galco.png" alt="G&A Madness" title="G&A Madness" />
				<?php echo get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"presentingmadness")); 
			} ?>
		    <ul id="ga-madness-nav">
				<li><a href="/bracket">Bow Bracket</a></li>
				<li><a href="/bracket/enter">Enter</a></li>
				<?php if(!mobile()){ ?>
					<li class="madness-logo"><img src="/wp-content/themes/gunsandammo/images/ga-madness/ga-madness-logo-galco.png" alt="G&A Madness" title="G&A Madness" />
					<?php echo get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"presentingmadness")); ?>
				</li><?php } ?>
				<li><a href="/bracket/prizes">Prizes & Rules</a></li>
				<li><a href="/bracket/how-it-works">How it Works</a></li>
			</ul>
		</div>
    	<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="article-brief clearfix js-responsive-section">
			<div class="viralsweeps">
				<script type="text/javascript">
				var cnt_id = "<?php the_field("viral_sweeps_id"); ?>";
				</script>
				<?php if( mobile() ){ ?>
					<script type="text/javascript" src="https://www.viralsweep.com/external/widget.js"></script>
				<?php }else{ ?>
					<script type="text/javascript" src="https://www.viralsweep.com/external/contest.js"></script>
				<?php } ?>
			</div>
    	</div>
 	</div><!-- #content -->
<?php get_footer(); ?>
