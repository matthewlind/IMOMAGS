<?php
/**
 * Template Name: Battle of the Bows Page
 * Description: A Page Template for Battle of the Bows (bracket).
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
				<li><a href="/bracket">Bow Bracket</a></li>
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
		
	</div><!-- #content -->
	<?php imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
					<div class="post-comments-area">
			            <?php comments_template( '', true ); ?>
			        </div>
				</div>
            </div>
        </div>
	</div>
<?php get_footer(); ?>




















