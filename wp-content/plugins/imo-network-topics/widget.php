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

	  <aside id="network-topics">

			<div class="network-topics-widget">
				<h3 class="widget-title"><span>The G&amp;A Network</span></h3>

				<div class="network-feed">

					<h2>The Guns</h2>
					<div class="flexslider the-guns-network-flexslider">
						<ul id="the-guns-network" class="network-topics slides" term="the-guns-network">
						</ul>
					</div>
					<h2>The Gear</h2>
					<div class="flexslider the-gear-network-flexslider">
						<ul id="the-gear-network" class="network-topics slides" term="the-gear-network">
						</ul>
					</div>

					<h2>Personal Defense</h2>
					<div class="flexslider personal-defense-network-flexslider">
						<ul id="personal-defense-network" class="network-topics slides" term="personal-defense-network">
					    </ul>
					</div>

					<h2>Culture & Politics</h2>
					<div class="flexslider culture-politics-network-flexslider">
						<ul id="culture-politics-network" class="network-topics slides" term="culture-politics-network">
						</ul>
					</div>
					<!--<h2>Survival</h2>
					<div class="flexslider survival-network-flexslider">
						<ul id="survival-network" class="network-topics last slides" term="survival-network">
						</ul>
					</div>-->

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

