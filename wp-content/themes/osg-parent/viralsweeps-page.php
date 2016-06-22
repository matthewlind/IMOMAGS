<?php
/**
 * Template Name: Viral Sweeps Page
 * Description: A full width page template without the sidebar for Viral Sweepstakes.
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
    <div id="content" role="main">
    	<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
			<h1 class="page-title">
				<div class="icon"></div>
				<span><?php the_title(); ?></span>
		    </h1>
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
    	<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="article-brief clearfix js-responsive-section viral-300">
    		<?php imo_dart_tag(); ?>
    	</div>
 	</div><!-- #content -->
<?php get_footer(); ?>
