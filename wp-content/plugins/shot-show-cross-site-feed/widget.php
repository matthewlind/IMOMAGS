<?php

namespace imo;
$should_print_my_script = true;

/**
 * SScsfWidget
 *
 * Creates the cross site feed for a page. 
 */
class SScsfWidget extends \WP_Widget {

    function __construct()
    {
        parent::__construct("sscsf-widget", "Shot Show Cross Site Feed Widget");
    }

    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget() {
    $dartdomain = get_option("dart_domain", $default = false); ?>      
	    <aside id="shot-show-widget">
		    <div class="widget-wrapper">
				<div class="widget-header shot-show">
					<h4>SHOT SHOW <?php echo date("Y"); ?></h4>
					<!--<div class="sub-header">New Products & Daily Updates</div>-->
					<div class="widget-border"></div>
				</div>
				<ul class="shot-show-widget" term="<?php echo "shot-show-" . date("Y"); ?>"><!-- This term= attribute is searched for by displayCrossSiteFeed() in cross-site-feed.js -->
			    
				</ul>
				<div class="sponsor-bg">
					<div class="sponsor"><?php echo get_imo_dart_tag("240x60",1,false,array("camp"=>"shot_show")); ?></div>				</div>
	
				<div class="see-all"><a href="<?php echo "http://www.gunsandammo.com/shot-show-" . date("Y"); ?>" <?php if($dartdomain != "imo.gunsandammo"){echo 'target="_blank"'; } ?>>See All <?php echo date("Y"); ?> SHOT Show Coverage</a></div>
		    </div>
	    </aside>
		<div style="clear:both;"></div>

	    <!-- clone -->
		<li id="ss-widget-template" style="display:none;">
			<div class="site"><a href="http://gunsandammo.com">www.gunsandammo.com</a></div>				
			<a class="title" rel="bookmark" href="http://www.northamericanwhitetail.deva/2012/03/13/deer-of-the-day-buckeye-brute-alexa-perry/">Deer of the Day Buckeye Brute, Alexa Perry</a>
		</li>
<?php
    }
 }       
add_action("widgets_init", function() {
    return register_widget("imo\SScsfWidget");
});

