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
				<?php echo "<div style='text-align:center;'>".get_imo_dart_tag("240x60",1,false,array("sect" => "","camp"=>"presentingmadness"))."</div>"; 
			} ?>
		    <ul id="ga-madness-nav">
				<li><a href="/bracket">Gun Bracket</a></li>
				<li><a href="/bracket/enter">Enter</a></li>
				<?php if(!mobile()){ ?>
					<li class="madness-logo"><img src="/wp-content/themes/gunsandammo/images/ga-madness/GA-gun-madness-galco-small.png" alt="G&A Madness" title="G&A Madness" /></li>
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
		
	</div><!-- #content -->

	
	
<?php get_footer(); ?>




















