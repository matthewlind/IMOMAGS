<div class="top-panel">
	<a href="http://www.in-/" class="icon-arrow-left">Back to Guns & Ammo</a>
</div>
<div class="m-microsite">
	
	<header class="m-main-header clearfix">
		<div class="m-nav-erea clearfix">
			<div class="m-nav clearfix">
				<div class="m-compass-wrap">
					<div class="m-compass"></div>
					<span>SOUTHEAST</span>
				</div>
				<div class="m-choose-btn">
					<span>CHOOSE</span><i class="icon-chevron-thin-right"></i><span>LOCATION</span>
				</div>
			</div><!-- .r-nav -->
			<div class="m-social-buttons">
				<ul>
					<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&title=<?php if(is_category("shoot101")){ echo "Shoot101: A starter's guide every new shooter should read."; }else{ print(urlencode(the_title())); } ?>" class="icon-facebook" target="_blank"></a></li>
					<li><a href="http://twitter.com/intent/tweet?status=<?php if(is_category("shoot101")){ echo "Shoot101: A starter's guide every new shooter should read."; }else{ print(urlencode(the_title())); } ?>+<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" class="icon-twitter" target="_blank"></a></li>
					<li><a href="mailto:?subject=Article I came across&body=Check out this article! Title: '<?php the_title(); ?>'. Link: <?php the_permalink(); ?>" class="icon-mail" target="_blank"></a></li>
				</ul>
			</div><!-- .social-buttons -->
		</div><!-- .r-nav-erea -->
		<div class="m-circle-wrap"><div class="m-circle"></div></div>
		<a href="/riggedready/" title="Rigged and Ready"><div class="m-logo"></div></a>
	</header>
