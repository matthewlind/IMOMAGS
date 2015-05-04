<div class="top-panel">
	<a href="<?php echo site_url(); ?>" class="icon-arrow-left">Back to In-Fisherman</a>
</div>
<div class="m-microsite">
	
	<header class="m-main-header clearfix">
		<div class="m-nav-erea clearfix">
			<div class="m-map-absolute">
				<div class="m-map-relative">
					<div class="m-map-shift">
						<div class="m-map-circle"></div>
						<h5>Where would you like to fish?</h5>
						<div class="m-map-wrap">
							<?php  get_template_part('../infisherman/content/map', 'rigged-ready'); ?>
						</div>
						<i class="icon-cross"></i>
					</div>
				</div>
			</div><!-- .m-map-container -->			
			<div class="m-nav clearfix">
				<div class="m-compass-wrap">
					<div class="m-compass" style="
						<?php 
							if (is_category("rigged-ready")) {
								echo " ";
							} else if (in_category("ne")) {
								echo "transform: rotate(-90deg);";
							} else if (in_category("se")) {
								echo "SOUTHEAST";
							} else if (in_category("mw")) {
								echo "transform: rotate(-180deg);";
							} else if (in_category("sw")) {
								echo "transform: rotate(-180deg);";
							} else if (in_category("nw")) {
								echo "transform: rotate(90deg);";
							} else {
								echo " ";
							}
						?>
							
						"></div>
					
					<span>
						<?php 
							if (is_category("rigged-ready")) {
								echo " ";
							} else if (in_category("ne")) {
								echo "NORTHEAST";
							} else if (in_category("se")) {
								echo "SOUTHEAST";
							} else if (in_category("mw")) {
								echo "MIDWEST";
							} else if (in_category("sw")) {
								echo "SOUTWEST";
							} else if (in_category("nw")) {
								echo "NORTHWEST";
							}  else {
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
					<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&title=<?php if(is_category("shoot101")){ echo "Shoot101: A starter's guide every new shooter should read."; }else{ print(urlencode(the_title())); } ?>" class="icon-facebook" target="_blank"></a></li>
					<li><a href="http://twitter.com/intent/tweet?status=<?php if(is_category("shoot101")){ echo "Shoot101: A starter's guide every new shooter should read."; }else{ print(urlencode(the_title())); } ?>+<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" class="icon-twitter" target="_blank"></a></li>
					<li><a href="mailto:?subject=Article I came across&body=Check out this article! Title: '<?php the_title(); ?>'. Link: <?php the_permalink(); ?>" class="icon-mail" target="_blank"></a></li>
				</ul>
			</div><!-- .m-social-buttons -->
		</div><!-- .m-nav-erea -->
		<div class="m-circle-wrap"><div class="m-circle"></div></div>
		<a href="/rigged-ready/" title="Rigged and Ready"><div class="m-logo"></div></a>
	</header>
