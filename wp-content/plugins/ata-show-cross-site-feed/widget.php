<?php

namespace imo;
$should_print_ata_script = true;
/**
 * ATAcsfWidget
 *
 * Creates the cross site feed for a page. 
 */
class ATAcsfWidget extends \WP_Widget {

    function __construct()
    {
        parent::__construct("atacsf-widget", "ATA Show Cross Site Feed Widget");
    }

    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget() {
    ?>      
	    <aside id="ata-show-widget">
			<div class="widget-header shot-show">
				<h4>ATA SHOW <?php echo date("Y"); ?></h4>
				<!--<div class="sub-header">New Products & Daily Updates</div>-->
				<div class="widget-border"></div>
			</div>
			<ul class="ata-show-widget" term="<?php echo "ata-show-" . date("Y"); ?>"><!-- This term= attribute is searched for by displayCrossSiteFeed() in cross-site-feed.js -->
		    
			</ul>
			<div class="sponsor-bg"><div class="sponsor"><?php imo_dart_tag("240x60"); ?></div></div>
			<div class="see-all"><a href="<?php echo "http://www.bowhuntingmag.com/ata-show-" . date("Y"); ?>">See All <?php echo date("Y"); ?> ATA Show Coverage</a></div>
		</aside>
		<div style="clear:both;"></div>

	    <!-- clone -->
		<li id="ata-widget-template" style="display:none;">
			<div class="site"><a href="http://gunsandammo.com">www.gunsandammo.com</a></div>				
			<a class="title" rel="bookmark" href="http://www.northamericanwhitetail.deva/2012/03/13/deer-of-the-day-buckeye-brute-alexa-perry/">Deer of the Day Buckeye Brute, Alexa Perry</a>
		</li>
<?php
    }
 }       
add_action("widgets_init", function() {
    return register_widget("imo\ATAcsfWidget");
});

