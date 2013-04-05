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
    ?>      
    	
	    <aside id="shot-show-widget">

			<div class="widget-header shot-show">
				<h4>SHOT Show 2013</h4>
				<!--<div class="sub-header">New Products & Daily Updates</div>-->
				<div class="widget-border"></div>
				<!--<div class="presented-by">Presented By</div>-->
				<?php //if( is_category("military-arms") ){ echo " <h4>Military Arms</h4>"; }?>
				<!--<div class="desc">Your destination for the newest guns and gear coming out of the industry's biggest event of the year!</div>-->
				</div>
			<ul class="shot-show-widget" term=""><!-- This term= attribute is searched for by displayCrossSiteFeed() in cross-site-feed.js -->
		    
		</ul>
			<div class="see-all"><a href="<?php if( $_SERVER['SERVER_NAME'] == "www.petersenshunting.com" || $_SERVER['SERVER_NAME'] == "www.northamericanwhitetail.com" || $_SERVER['SERVER_NAME'] == "www.bowhuntingmag.com" || $_SERVER['SERVER_NAME'] == "www.gundogmag.com" || $_SERVER['SERVER_NAME'] == "www.wildfowlmag.com" || $_SERVER['SERVER_NAME'] == "www.bowhunter.com" || $_SERVER['SERVER_NAME'] == "www.gameandfishmag.com" ){ echo "http://www.petersenshunting.com/shot-show-2013"; }else{ echo "http://gunsandammo.com/shooting/shot-show-2013/";} ?>">See All 2013 SHOT Show Coverage</a><span></span></div>
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

