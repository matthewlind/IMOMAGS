<div class="top-panel">
	<div class="top-panel-absolute">
		<a href="<?php echo site_url(); ?>" class="icon-arrow-left">Back to In-Fisherman</a>
	</div>
</div>
<div class="m-microsite">
	<header class="m-main-header clearfix">
		<div class="m-nav-erea clearfix">
			<div class="m-map-absolute">
				<div class="m-map-relative">
					<div class="m-map-circle"></div>
					<h5>Where would you like to fish?</h5>
					<div class="m-map-wrap">
						<?php  get_template_part('content/microsite-template-parts/rigged-ready/header', 'map'); ?>
					</div>
					<i class="icon-cross"></i>
				</div>
			</div><!-- .m-map-container -->			
			<div class="m-nav clearfix">
				<div class="m-compass-wrap">
					<div class="m-compass"></div>				
					<span>
						<?php 
							if (is_category("rigged-ready")) {
								echo " ";
							} elseif (is_category("ne") || in_category("ne")) {
								echo "NORTHEAST";
							} elseif (is_category("se") || in_category("se")) {
								echo "SOUTHEAST";
							} elseif (is_category("mw") || in_category("mw")) {
								echo "MIDWEST";
							} elseif (is_category("sw") || in_category("sw")) {
								echo "SOUTHWEST";
							} elseif (is_category("nw") || in_category("nw")) {
								echo "NORTHWEST";
							} else {
								echo " ";
							}
						?>
					</span>
				</div>
				<div class="m-choose-btn">
					<i class="icon-chevron-thin-left"></i>
					<span>CHOOSE</span><span>LOCATION</span>
				</div>
			</div><!-- .m-nav -->
			<div class="m-social-buttons">
				<ul>
					<li><a href="http://www.facebook.com/sharer/sharer.php?u=http://www.in-fisherman.com/rigged-ready/&title=Rigged and Ready: Your regional guide to the nation's best fishing." class="icon-facebook" target="_blank"></a></li>
					<li><a href="http://twitter.com/intent/tweet?status=Rigged and Ready: Your regional guide to the nation's best fishing.+http://www.in-fisherman.com/rigged-ready/" class="icon-twitter" target="_blank"></a></li>
					<li><a href="mailto:?subject=Website I came across&body=Check out this website! Rigged and Ready: Your regional guide to the nation's best fishing. <?php echo site_url() . "/rigged-ready"; ?>" class="icon-mail" target="_blank"></a></li>
				</ul>
			</div><!-- .m-social-buttons -->
		</div><!-- .m-nav-erea -->
		<div class="m-circle-wrap"><div class="m-circle"></div></div>
		<a href="/rigged-ready/" title="Rigged and Ready"><div class="m-logo"></div></a>
	</header>
