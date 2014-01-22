<?php

namespace imo;
/**
 * Network Topics Widget
 *
 * Creates the cross site feed for Network Topics.
 */
class NetworkTopicsWidget extends \WP_Widget {

    function __construct()
    {
        parent::__construct("ntw-widget", "Network Topics Widget");
    }

    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget() {
    ?>

	  <aside id="network-topics" class="widget">

			<div class="network-topics-widget">
				<h3 class="widget-title"><span>G&amp;A Network</span></h3>
				<div class="sponsor"><?php echo get_imo_dart_tag("240x60",1,false,array("camp"=>"network_topics")); ?></div>
				<div class="network-feed">
				
					<h2><a href="http://www.gunsandammo.com/shooting/network-topics/the-guns-network/"<?php if( $_SERVER['SERVER_NAME'] != "www.gunsandammo.com" ){ echo ' target="_blank"'; } ?>>Guns</a></h2>
					<div class="flexslider the-guns-network-flexslider">
						<ul id="the-guns-network" class="network-topics slides" term="the-guns-network">
						</ul>
					</div>
					
					<h2><a href="http://www.shootingtimes.com/ammo/"<?php if( $_SERVER['SERVER_NAME'] != "www.shootingtimes.com" ){ echo ' target="_blank"'; } ?>>Ammo</a></h2>
					<div class="flexslider ammo-flexslider">
						<ul id="ammo" class="network-topics slides" term="ammo">
						</ul>
					</div>
					
					<h2><a href="http://www.gunsandammo.com/shooting/network-topics/personal-defense-network/"<?php if( $_SERVER['SERVER_NAME'] != "www.gunsandammo.com" ){ echo ' target="_blank"'; } ?>>Personal Defense</a></h2>
					<div class="flexslider personal-defense-network-flexslider">
						<ul id="personal-defense-network" class="network-topics slides" term="personal-defense-network">
					    </ul>
					</div>

					<h2><a href="http://www.gunsandammo.com/shooting/network-topics/culture-politics-network/"<?php if( $_SERVER['SERVER_NAME'] != "www.gunsandammo.com" ){ echo ' target="_blank"'; } ?>>Culture & Politics</a></h2>
					<div class="flexslider culture-politics-network-flexslider">
						<ul id="culture-politics-network" class="network-topics slides" term="culture-politics-network">
						</ul>
					</div>
					
					<h2><a href="http://www.gunsandammo.com/shooting/network-topics/the-gear-network/"<?php if( $_SERVER['SERVER_NAME'] != "www.gunsandammo.com" ){ echo ' target="_blank"'; } ?>>Gear</a></h2>
					<div class="flexslider the-gear-network-flexslider">
						<ul id="the-gear-network" class="network-topics last slides" term="the-gear-network">
						</ul>
					</div>
				</div><!-- network-feed -->
			</div><!-- network-topics-widget -->
			<div class="btm-bg"></div>
		</aside>

		<div style="clear:both;"></div>

<?php


    }

 }

add_action("widgets_init", function() {
    return register_widget("imo\NetworkTopicsWidget");
});

