<?php
/**
 * Template Name: Add Photo Page
 * Description: A page for uploading photos to communities.
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


get_header();
//get_template_part( 'nav', get_post_format() );

//imo_sidebar(); ?>
<main class="main-single">
	<article id="article" class="article">
		<header class="article-header">
			<h1><?php the_title(); ?></h1>
		</header>
		<div class="article-body">
			<div id="sticky-ad" class="sticky-ad">
			    <div class="sticky-ad-inner"><iframe class="iframe-ad" onload="resizeIframe(this)" width="300" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no" src="/iframe-ad.php?term=<?php echo $term; ?>&camp=<?php echo $camp; ?>&ad_code=<?php echo $dartdomain; ?>&ad_unit=sticky&page=article"></iframe></div>
		    </div>
			<?php get_template_part( 'content/content-add-photo-page' ); ?>
		</div>
	</article>
</main>
<?php get_footer(); ?>