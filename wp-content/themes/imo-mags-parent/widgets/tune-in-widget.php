
<?php 
/**
 *  widget.
 */
class TuneIn_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'tunein_widget', // Base ID
			__('TuneIn Widget', 'TuneIn Widget'), // Name
			array( 'description' => __( 'A TuneIn Widget', 'text_domain' ) ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	$posts = get_field("show_post", "options");
	if( $posts ): ?>
	    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
	        <?php setup_postdata($post); ?>

	        <div class="tune-in-container clearfix">
				<div class="t-video-link">
					<a href="<?php echo $post->guid; ?>" target="_blank">
						<div class="t-video-thumb">
							<?php echo get_the_post_thumbnail($post->ID,"list-thumb"); ?>
							<i class="icon-play"></i>
						</div>
					</a>
					<div class="t-arrow"></div>
				</div>
				<div class="t-show-description">
					<h4>All New <strong><?php the_field("title", "options"); ?></strong> <span class="invis-on-mobile">on <strong><a href="http://thesportsmanchannel.com" target="_blank">Sportsman Channel</a></strong><span></h4>
					<span class="t-schedule"><?php the_field("show_promo", "options"); ?></span>
					<span class="t-episode-descr"><?php if( get_field("show_description", "options") ){ the_field("show_description", "options"); } ?></span>
				</div>
				<div class="t-right-side">
					<div class="t-triangle"></div>
					<span>NEVER MISS<br>ANOTHER EPISODE</span>
				</div>
				<a class="t-remind-me" href="<?php the_field("remind_me", "options"); ?>" target="_blank">REMIND ME<span>TO WATCH</span></a>
			</div>
	
	    <?php endforeach; ?>
	    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
	<?php endif; 
	}
} // class Schedule_Widget

// register Foo_Widget widget
function register_tunein_widget() {
    register_widget( 'TuneIn_Widget' );
}
add_action( 'widgets_init', 'register_tunein_widget' );



