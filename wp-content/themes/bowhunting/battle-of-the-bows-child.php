<?php
/**
 * Template Name: Battle of the Bows Child Page
 * Description: A Page Template for Battle of the Bows subpages w/ navigation.
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
		    	<img class="madness-logo-mobile" src="/wp-content/plugins/bowmadness/images/BOB-logo.png" alt="Bow Madness" title="Bow Madness" />
				<?php echo get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"presentingmadness")); 
			} ?>
		   <ul id="ga-madness-nav">
				<li><a href="/battle-of-the-bows">Bow Bracket</a></li>
				<li><a href="/battle-of-the-bows/enter">Enter</a></li>
				<?php if(!mobile()){ ?>
					<li class="madness-logo"><img src="/wp-content/plugins/bowmadness/images/BOB-logo.png" alt="Bow Madness" title="Bow Madness" />
					</li>
				<?php } ?>
				<li><a href="/battle-of-the-bows/prizes-rules">Prizes & Rules</a></li>
				<li><a href="/battle-of-the-bows/how-it-works">How it Works</a></li>
			</ul>
		</div>
		
		<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="article-brief clearfix js-responsive-section">
			<?php the_content(); ?>
		</div>
	</div><!-- #content -->
	<div class="clearfix"></div>
<?php get_footer(); ?>




















