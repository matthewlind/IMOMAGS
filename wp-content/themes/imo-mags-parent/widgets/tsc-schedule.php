<?php 
/**
 * Adds Schedule widget.
 */
class Schedule_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'schedule_widget', // Base ID
			__('Schedule Widget', 'Schedule Widget'), // Name
			array( 'description' => __( 'A Schedule Widget', 'text_domain' ) ) // Args
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
		//$title = apply_filters( 'widget_title', $instance['title'] ); 
		$title = "What's On Now"; 
	
			echo $args['before_widget']; ?>
			<div class="w-sport-head">
				<h2>WHAT'S ON<br>SPORTSMAN NOW</h2>
				<img src="/wp-content/themes/imo-mags-parent/images/ico/schedule-widget-logo.png">
			</div>
			<div class="w-sport-schedule">
				<ul>
				<?php 
					$schshows = $this->phpTSCSRender();
					//print_r($schshows);
					foreach($schshows as $schshow) { ?>
						<li>
							<span><?php echo $schshow["slot"]; ?></span><br />
							<span><?php echo $schshow["SeriesTitle"]; ?></span>
						</li>
					<?php } ?>	
				</ul>
				<div class="w-sport-button">
					<a href="http://thesportsmanchannel.com/schedule" target="_blank">FULL SCHEDULE</a>
				</div>
			</div>
		<?php echo $args['after_widget'];
	}
	
	/**
	 * Added 03/2014 By Jeff Burrows
	 *
	 * 
	 * get list of the next 4 shows 
	 * 
	 */	
	private function phpTSCSRender() {
	
		$datapath = "http://apps.imoutdoors.com/tscschedule/scheduledata.php";
		$data = file_get_contents ($datapath);
	    $showjson = json_decode($data, true);
		
		global $wpdb;
		$sql = "SELECT p.*, m1.meta_value AS seriesid FROM wp_posts p "
			 . "LEFT JOIN wp_postmeta m1 ON p.ID = m1.post_id AND m1.meta_key = 'series_id' "
			 . "WHERE post_type = 'shows' AND post_status = 'publish' "
			 . "ORDER BY post_title"; 
		$showposts = $wpdb->get_results($sql);
	
		//$showposts = getTSCSwpshows();
	
		$wpshows = array();
		foreach($showposts as $post) {
			$wpshowa = array();
			$wpshowa["postname"] = $post->post_name;
			$wpshows[$post->seriesid] = $wpshowa;
		}
	
		$showlist = array();
		date_default_timezone_set('America/New_York');
		$now = date("H");
		$today = date("Y/m/d");
		$postname = "";
		$ncount = 0;
		
		foreach($showjson as $key=>&$row) {
	    	if(isset($wpshows[$row["SeriesID"]])) {
	    		$postname = $wpshows[$row["SeriesID"]]["postname"];
			}
			foreach($row["Timeslots"] as &$slot) {

				if($slot["rdate"]==$today && strtotime($slot["rtime"])>=(time()-(time() % 1800))) {
					$srca = explode(" ", $slot["src"]);
					$tshow = array();
					$tshow["now"] = $now;
					$tshow["today"] = $today;
					$tshow["slot"] = $srca[1];
					$tshow["postname"] = $postname;
					$tshow["rtime"] = $slot["rtime"];
					$tshow["rhour"] = substr($slot["rtime"],0,2);
					$tshow["SeriesTitle"] = $row["SeriesTitle"];
					
					$showlist[] = $tshow;
					$ncount++;
				}
			}
		}
		
		usort($showlist, function($a, $b) {
			return strtotime($a['rtime']) - strtotime($b['rtime']);
		});
		return array_slice($showlist, 0, 4);

	}

	
	
	
	

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Schedule_Widget

// register Foo_Widget widget
function register_schedule_widget() {
    register_widget( 'Schedule_Widget' );
}
add_action( 'widgets_init', 'register_schedule_widget' );

