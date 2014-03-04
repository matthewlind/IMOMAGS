<?php
/*
Plugin Name: IMO State Rankings
Description: State rankings.
Version: 0.2
Author: Salah for InterMedia Outdoors
*/

require_once dirname( __FILE__ ) . '/settings-api-class.php';

add_shortcode('rankings', 'state_rankings');
function state_rankings($atts) {
	//wp_enqueue_style('state-rankings',plugins_url('state-rankings.css', __FILE__));
	extract(
		shortcode_atts(
			array(
				'week' => 1,
				'show' => 20,
				'initials' => 'true'
			),
			$atts
		)
	);
	return state_rankings_display($week, $show, $initials);
}

function state_rankings_display($week, $show, $initials, $widget) {
	if($initials == 'true' || $initials == 'yes' || $initials == 'on' || $initials == 1 || $initials == '1') {$initials = 'true';} else {$initials = 'false';}
	$rankingData = get_option('week_'.$week.'_data');
	$dynamic_array_loop = '';
	$states = array('Alabama' => 'AL', 'Alaska' => 'AK', 'Arizona' => 'AZ', 'Arkansas' => 'AR', 'California' => 'CA', 'Colorado' => 'CO', 'Connecticut' => 'CT', 'Delaware' => 'DE', 'District of Columbia' => 'DC', 'Florida' => 'FL', 'Georgia' => 'GA', 'Hawaii' => 'HI', 'Idaho' => 'ID', 'Illinois' => 'IL', 'Indiana' => 'IN', 'Iowa' => 'IA', 'Kansas' => 'KS', 'Kentucky' => 'KY', 'Louisiana' => 'LA', 'Maine' => 'ME', 'Maryland' => 'MD', 'Massachusetts' => 'MA', 'Michigan' => 'MI', 'Minnesota' => 'MN', 'Mississippi' => 'MS', 'Missouri' => 'MO', 'Montana' => 'MT', 'Nebraska' => 'NE', 'Nevada' => 'NV', 'New Hampshire' => 'NH', 'New Jersey' => 'NJ', 'New Mexico' => 'NM', 'New York' => 'NY', 'North Carolina' => 'NC', 'North Dakota' => 'ND', 'Ohio' => 'OH', 'Oklahoma' => 'OK', 'Oregon' => 'OR', 'Pennsylvania' => 'PA', 'Rhode Island' => 'RI', 'South Carolina' => 'SC', 'South Dakota' => 'SD', 'Tennessee' => 'TN', 'Texas' => 'TX', 'Utah' => 'UT', 'Vermont' => 'VT', 'Virginia' => 'VA', 'Washington' => 'WA', 'West Virginia' => 'WV', 'Wisconsin' => 'WI', 'Wyoming' => 'WY');
	$count = 1;
	$stateCount = count($states);
	$comma = ',';
	foreach($states as $state => $stateInitials) {
		if($count == $stateCount) $comma = '';
		$stateName = $state;
		$state = str_replace(' ', '_', strtolower($state));
		$dynamic_array_loop .= '
			array(
				"id" => "'.$state.'",
				"name" => "'.$stateName.'",
				"initials" => "'.$stateInitials.'",
				"rank" => "'.$rankingData[$state.'_rank'].'",
				"trend" => "'.$rankingData[$state.'_trend'].'",
				"notes" => "'.$rankingData[$state.'_notes'].'"
			)'
		.$comma;
		$count++;
	}
	$dynamic_array_loop = 'array('.$dynamic_array_loop.')';
	$dynamic_array = '$state_rankings_data = '.$dynamic_array_loop.';';
	eval($dynamic_array);
	//Default display by rank
	return rankListing($state_rankings_data, $week, $show, $initials, $widget);
}

function rankSorting($a, $b) {
	return $a['rank'] - $b['rank'];
}

function rankListing($state_rankings_data, $week, $show, $initials, $widget){
	$show = intval($show);
	$ranksUrl = get_bloginfo('url').'/state-rankings';
	$rankTable = '
	<style type="text/css">
	.right {float: right;}
	.rt-logo {
		width: 224px;
		height: 127px;
		margin: 0 auto;
		background: url("'.plugins_url( 'images/NAW-Power-Rankings-20131.jpg' , __FILE__ ).'") no-repeat;
	}
	.pr-widget-sponsor img{
		width: 110px;
		height: auto;
		margin-left: 85px;
	}
	table.rt-table, .rt-table td, .rt-table tr {
		border: none;
		border-spacing: 0px;
		background: #fff;
		margin: 10px 0 10px 1px;
		width: 99%;
	}
	.rt-table tr {
		padding: 0px;
	}
	.rt-table td {
		padding: 25px;
		background: #EDEDED;
		vertical-align:top;
		width: 45px;
		height: 25px;
	}
	table.rt-table tr.rt-header {
		outline: 1px solid #D2D2D2;
		color: #333;
		font-size: 1.1em;
	}
	.rt-name, .rt-points, .rt-trend, .rt-rank {
		font-weight: bold;
		font-size: 1.35em;
		font-family: "Rokkitt", "stagregular", "StagMedium", serif;
		text-shadow: 1px 1px #fff;
		/*text-align: center;*/
	
	}
	.rt-rank, .rt-points {
		text-align: center;
	}
	td.rt-trend {
		text-align: right;
	}
	td.rt-notes {
		width: 100%;
		font-size: 0.9em;
	}
	.rt-name a {
		color: #22628C;
		text-decoration:underline;
	}
	.rt-table .rt-header td {
		font-size: 0.9em;
		padding: 15px 25px 15px 25px;
		background: #fff;
	}
	tr.rt-divider, tr.rt-divider td {
		background: #fff;

		height: 10px;
		padding: 0;
	}
	.rt-arrow-up {
		float: left;
		position: relative;
		margin: 12px 16px -42px 0;
		width: 15px;
		height: 8px;
		background: url("'.plugins_url( 'images/up.png' , __FILE__ ).'") no-repeat;
		display: inline-block;
	}
	.rt-arrow-down {
		float: left;
		position: relative;
		margin: 12px 16px -42px 0;
		width: 15px;
		height: 8px;
		background: url("'.plugins_url( 'images/down.png' , __FILE__ ).'") no-repeat;
		display: inline-block;
	}
	.center {
		display: block;
		text-align:center;
		margin:0 auto;
	}
	
	.widget_state_rankings_widget {
		border: 1px solid #D2D2D2;
		padding: 0 6px 24px !important;
	}
	.widget_state_rankings_widget table.rt-table {
		border: 1px solid #D2D2D2;
		width: 295px;
		margin: 10px auto 10px auto;
	}
	
	.widget_state_rankings_widget .rt-table td {
		padding: 10px;
		width: auto;
		height: auto;
	}
		
	.widget_state_rankings_widget table.rt-table tr.rt-header {
		outline: none;
	}
	.widget_state_rankings_widget .rt-name,
	.widget_state_rankings_widget .rt-points,
	.widget_state_rankings_widget .rt-trend,
	.widget_state_rankings_widget .rt-rank {
		font-weight: bold;
		font-size: 1em !important;
	}
	.widget_state_rankings_widget .rt-trend {
		padding-right: 22px !important;
	}
	.widget_state_rankings_widget .rt-rank {
		padding-right: 12px !important;
	}
	.widget_state_rankings_widget .rt-points {
		padding-right: 17px !important;
	}
	.widget_state_rankings_widget .rt-name {
		padding-left: 12px !important;
	}
	.widget_state_rankings_widget tr.rt-divider,
	.widget_state_rankings_widget tr.rt-divider td {
		padding: 0;
		height: 2px;
	}
	tr.rt-divider-last,
	tr.rt-divider-last td {
		height: 0px !important;
	}
	.widget_state_rankings_widget .rt-arrow-up {
		margin: 8px 0px -42px 4px;
	}
	.widget_state_rankings_widget .rt-arrow-down {
		margin: 8px 0px -42px 4px;
	}
	.widget_state_rankings_widget .rt-table .rt-header td {
		font-family: Helvetica, Arial, sans-serif;
		font-size: 0.8em;
	}
	.rt-widget-top {
		font-weight: bold;
		font-family: Helvetica, Arial, sans-serif;
		font-size: 0.8em;
		text-transform: uppercase;
		padding: 0 2px 0 1px;
	}
	.rt-widget-bottom {
		font-weight: bold;
		font-size: 1em;
		line-height: 1em;
		margin: 5px 0 10px 0;
	}
	a.rt-bottom-link {
		margin: 10px 2px 0;
		font-family: Helvetica, Arial, sans-serif;
		font-size: 0.6em;
	}
	</style>';
	if(!empty($widget)) $rankTable .= '
	<div class="rt-logo"></div>
	<div class="pr-widget-sponsor">
        <script type="text/javascript">
        document.write(unescape(\'%3Cscript src="http://ad.doubleclick.net/adj/imo.northamericanwhitetail/;sect=week1;manf=;pos=;page=naw_power_rankings_week_1;subs=;sz=240x60;dcopt=;tile=;ord=\'+dartadsgen_rand+\'?"%3E%3C/script%3E\'));
        </script>
        <noscript>
        <a href="http://ad.doubleclick.net/adj/imo.northamericanwhitetail/;sect=week1;manf=;pos=;page=naw_power_rankings_week_1;subs=;sz=240x60;dcopt=;tile=;ord=6545512368?">
        <img src="http://ad.doubleclick.net/ad/imo.northamericanwhitetail/;sect=week1;manf=;pos=;page=naw_power_rankings_week_1;subs=;sz=240x60;dcopt=;tile=;ord=6545512368?" border="0" />
        </a>
        </noscript>
	</div>
	<div class="rt-widget-top">
		Week '.$week.'<a href="'.$ranksUrl.'/week-'.$week.'"class="right">See All 20 Rankings</a>
	</div>
	';
	$rankTable .= '
	<table class="rank-table rt-table">
		<tr class="rt-header"><td>Rank</td><td>State</td><td>Trend</td>';
	if(empty($widget)) $rankTable .= '<td>Notes</td>';
	$rankTable .= '</tr>
		<tr class="rt-divider"><td></td><td></td><td></td>
	';
	if(empty($widget)) $rankTable .= '<td></td>';
	$rankTable .= '</tr>';
	usort($state_rankings_data, 'rankSorting');
	$count = 1;
	foreach($state_rankings_data as $state_data) {
		$rank = intval($state_data['rank']);
		$name = $state_data['name'];
		$stateUrl = get_bloginfo('url').'/community/report/'.str_replace(' ', '-', strtolower($name));
		if($initials == 'true') {$label = $state_data['initials'];} else {$label = $name;}
		if($state_data['notes']) {$notes = $state_data['notes'];} else {$notes = '&nbsp';}
		$trendUp = 'trendUp';
		$trendDown = 'trendDown';
		if($state_data['trend']) {
		$trend = $state_data['trend'];
		$trend = str_replace('+', $trendUp, $trend);
		$trend = str_replace('-', $trendDown, $trend);
		$trend = str_replace('trendDown', '<span class="rt-arrow-down"></span>', $trend);
		$trend = str_replace('trendUp', '<span class="rt-arrow-up"></span>', $trend);
		} else {
		$trend = '<span class="center">--</span>';
		}

		
		if($count <= $show && $rank > 0) {
		$rankTable .= '
			<tr><td class="rt-rank">'.$rank.'</td><td class="rt-name"><a href="'.$stateUrl.'">'.$label.'</a></td><td class="rt-trend">'.$trend.'</td>';
		if(empty($widget)) $rankTable .= '<td class="rt-notes">'.$notes.'</td></tr>';
		if($show == $count) $rtDividerLast = ' rt-divider-last';
		$rankTable .= '
			<tr class="rt-divider'.$rtDividerLast.'"><td></td><td></td><td></td>
		';
		if(empty($widget)) $rankTable .= '<td></td>';
		$rankTable .= '</tr>';
		$count++;
		}
	}
	$rankTable .= '
	</table>
	';
	$widgetBottom = '
	<div class="rt-widget-bottom"><a href="'.get_bloginfo('url').'/community/report">Share your activity</a> to push YOUR state to the top of the list!<a href="'.$ranksUrl.'" class="rt-bottom-link right">What the heck is this?</a></div>
	';
	if(!empty($widget)) $rankTable .= $widgetBottom;
	return $rankTable;	
}

/**
 * Options Page Settings Class
 */
class imo_state_rankings_initiate {
    private $settings_api;

    function __construct() {
        $this->settings_api = imo_state_rankings::getInstance();

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
		add_menu_page('State Rankings Dashboard', 'State Rankings', 'editor', 'imo_state_rankings', array($this, 'plugin_page'), '', '5.4');
    }

    function get_settings_sections() {
        $dynamic_array_loop = '';
		$week = 1;
		while($week <= 12) {
			$dynamic_array_loop .= '
					array(
                        "id" => "week_'.$week.'_data",
                        "title" => __("Week '.$week.'", "imo" )
					),
					';
          	$week++;
		}
		$dynamic_array ='
		$sections = array(
			'.$dynamic_array_loop.'
		);
		';
		eval($dynamic_array);
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
		$states = array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming');
		$dynamic_array_loop = '';
		foreach($states as $state) {
			$state = str_replace(' ', '_', strtolower($state));
			$dynamic_array_loop .= '
					array(
						"name" => "'.$state.'_rank",
						"label" => __( "Rank", "imo" ),
						"type" => "ranking_record",
						"desc" => "",
						"state" => "'.$state.'"
					),
					array(
						"name" => "'.$state.'_trend",
						"label" => __( "Trend", "imo" ),
						"type" => "ranking_record",
						"desc" => "",
						"state" => "'.$state.'"
					),
					array(
						"name" => "'.$state.'_notes",
						"label" => __( "Notes", "imo" ),
						"type" => "ranking_record_textarea",
						"desc" => "",
						"state" => "'.$state.'"
					),
					';
		}
		$dynamic_array_loop2 = '';
		$week = 1;
		while($week <= 12) {
			$dynamic_array_loop2 .= '
				"week_'.$week.'_data" => array('.$dynamic_array_loop.'), 
			';
          	$week++;
		}
		$dynamic_array = '$settings_fields = array('.$dynamic_array_loop2.');';
		eval($dynamic_array);
        return $settings_fields;
    }

    function plugin_page() {
        echo '
		<style>
		.postbox {visibility:hidden;}
		.state-name {display: inline-block; width: 95px;float: left;line-height: 32px;}
		.state-rows-column-header {padding: 0 0 0 100px; font-weight: bold; text-shadow: 1px 1px #000; background-color: #aaa; color: #fff;-webkit-border-top-left-radius: 4px;-webkit-border-top-right-radius: 4px;-moz-border-radius-topleft: 4px;-moz-border-radius-topright: 4px;border-top-left-radius: 4px;border-top-right-radius: 4px;}
		.floatingHeader {-webkit-border-top-left-radius: 0px;-webkit-border-top-right-radius: 0px;-moz-border-radius-topleft: 0px;-moz-border-radius-topright: 0px;border-top-left-radius: 0px;border-top-right-radius: 0px;}
		.state-row {padding: 5px;}
		.state-row input[type=text] {height: 32px; padding: 3px; width: 40px; margin: 0 0 0 10px; float: left;text-align:center;}
		.state-row textarea {height: 32px; padding: 3px; width: 40%; margin: 0 0 0 10px; float: left;}
		.state-rows-column-header span {display: inline-block; width: 40px; margin-left: 11px; padding: 10px 0 10px 0;}
		.alt-color {background-color: #e8eefc;}
		.updated {display: none;}
		h2 .nav-tab {font-size: 16px;}
		.submit2 {float: right; margin: 5px 5px 0;}
		a.nav-tab-active {font-weight: bold;}
		.floatingHeader { position: fixed; top: 0; visibility: hidden;}
		
		.postbox form h3 {display: none;}
		.sub-cat-spacer {float:left;width:17px;height:1px;}
		.clear {clear:both;}
		.wrap h2 {padding-bottom: 0px;}
		.updated {float: left; position: relative; z-index: 1000; margin: 12px 0 0 12px !important;}
		#wpbody-content .metabox-holder,
		#wpbody-content .metabox-holder .postbox {
			padding-top:0;
			-moz-box-shadow: none;
			-webkit-box-shadow: none;
			box-shadow: none;
		}
		#wpbody-content .metabox-holder .postbox {
			margin-top: -3px;
		  	border: 1px solid #aaa;
		  	padding: 10px;
		}
		.loading-box {
			color: #ccc;
			margin-top: -1px;
			border: 1px solid #ccc;
			padding: 10px;
			-webkit-border-bottom-right-radius: 4px;
			-webkit-border-bottom-left-radius: 4px;
			-moz-border-radius-bottomright: 4px;
			-moz-border-radius-bottomleft: 4px;
			border-bottom-right-radius: 4px;
			border-bottom-left-radius: 4px;
		}
		a.nav-tab-active {
			background: #aaa;
			border: 1px solid #aaa;
			color: #fff;
			text-shadow: #000 0 1px 0;
		}
		.title-input {
			padding: 0 5px 0 5px;
			width: 100% !important;
			margin-bottom: 20px;
		}
		h4, .title-input {
			font-size: 18px;
			line-height: 28px;
			height: 28px;
			display: inline;
			font-weight: normal;
		}
		</style>
		<div class="wrap">
		<h1>State Rankings Dashboard</h1>
		';
        settings_errors();

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

		echo '<h2>Settings</h2>';
		echo '<p>Shortcode: [rankings week=1 show=20 initials=on]</p>';
		echo '<p>Week: week=1 *required<br />Show: show=20 (default is 20)<br />Initials: initials=on (show state abbreviation or name. default is on, show name is off)</p>';
		echo '<p>Adding a + or a - before a number in trend will show the up and down arrows.</p>';
		echo '<p>Only the rows which have a rank assigned to them will show in the table.</p>';
		
        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}

$settings = new imo_state_rankings_initiate();



/**
 * Widget Class
 */
class state_rankings_widget extends WP_Widget {
    /** constructor -- name this the same as the class above */
    function state_rankings_widget() {
        parent::WP_Widget(false, $name = 'IMO State Rankings');	
    }
 
    /** @see WP_Widget::widget -- do not rename this */
    function widget($args, $instance) {	
        extract( $args );
        $week 		= $instance['week'];
		$show 		= $instance['show'];
        $initials 	= $instance['initials'];
        
		echo $before_widget;
		echo state_rankings_display($week, $show, $initials, 'yes');
		echo $after_widget;
    }
 
    /** @see WP_Widget::update -- do not rename this */
    function update($new_instance, $old_instance) {		
		$instance = $old_instance;
		$instance['week'] = strip_tags($new_instance['week']);
		$instance['show'] = strip_tags($new_instance['show']);
		$instance['initials'] = strip_tags($new_instance['initials']);
        return $instance;
    }
 
    /** @see WP_Widget::form -- do not rename this */
    function form($instance) {	
 
        $week 		= esc_attr($instance['week']);
		$show 		= esc_attr($instance['show']);
        $initials	= esc_attr($instance['initials']);
        ?>
		<p>
			Which week? <input style="width: 30px;" id="<?php echo $this->get_field_id('week'); ?>" name="<?php echo $this->get_field_name('week'); ?>" type="text" value="<?php echo $week; ?>" /><br/>
			How many? <input style="width: 30px;margin-left: 9px;"  id="<?php echo $this->get_field_id('show'); ?>" name="<?php echo $this->get_field_name('show'); ?>" type="text" value="<?php echo $show; ?>" />
		</p>
		<p>
        Use initials? 
        <?php if($initials == 'yes') {?>
        <input type="radio" name="<?php echo $this->get_field_name('initials'); ?>" value="yes" checked="checked">Yes &nbsp;<input type="radio" name="<?php echo $this->get_field_name('initials'); ?>" value="no" />No
        <?php } else { ?>
        <input type="radio" name="<?php echo $this->get_field_name('initials'); ?>" value="yes">Yes &nbsp;<input type="radio" name="<?php echo $this->get_field_name('initials'); ?>" value="no" checked="checked" />No
        <?php } ?>
        </p>
        <?php 
    }
 
 
} // end class state_rankings_widget
add_action('widgets_init', create_function('', 'return register_widget("state_rankings_widget");'));
?>
