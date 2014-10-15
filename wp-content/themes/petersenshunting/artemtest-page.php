<?php
/**
 * Template Name: Artem Test page
 * Description: A Page Template for Border To Border Show.
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

get_header(); ?>
<?php get_template_part("widgets/tune-in-widget"); ?>
<?php imo_sidebar(); ?>
	
	<div id="primary" class="general">	
	<div class="widget widget_channel-video-widget video-widget-bowhunter clearfix">
	<!-- vw = video-widget -->
		<div class="vw-head">
			<img class="vw-logo" src="/wp-content/themes/petersenshunting/images/logos/bowhunter-tv-logo.png">
			<p><span>FRIDAYS</span> 8:00pm/ET</p>
			<img class="vw-logo-sportsman" src="/wp-content/themes/petersenshunting/images/logos/SPMN-white.png">
		</div>
		<div class="vw-video-area" style="background: url('/wp-content/themes/petersenshunting/images/video-widget/form_2.jpg') no-repeat;">
			<i class="icon-youtube"></i>
		</div>
		<div class="btn-wrap">
			<a class="vw-btn" href="">MORE VIDEO AND SHOWTIMES</a>
		</div>
		<div class="vw-line"></div>
		<div class="vw-get-sportsman clearfix">
			<img src="/wp-content/themes/petersenshunting/images/logos/spmn-widget-logo.png">
			<a href="">GET SPORTSMAN CHANNEL NOW</a>
			<i class="icon-arrow-right2"></i>
		</div>
	</div>
	
	
	
	
	
	
	
	
	<p class="stupid-p">
	Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.
	</p>
	
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content/content', 'page' ); ?>
				<?php endwhile; // end of the loop. ?>
            </div><!-- #content -->
        </div>
    </div><!-- #primary -->


<?php get_footer(); ?>