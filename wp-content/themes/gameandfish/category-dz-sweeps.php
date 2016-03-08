<?php
	$microsite = true;
	$microsite_rigged = true;
	get_header(); 
	
?>
<div class="m-article-wrap clearfix">	
	<div class="m-article-image">
		<div class="sweeps-text">
			<h1>GET RIGGED AND READY TO</h1>
			<div class="sweeps-text-img"></div>
		</div>
		<div class="photo-collage">
			<div>
				<img class="collage-1" src="<?php bloginfo('stylesheet_directory');?>/images/deer-zone/sweepstakes/Collage-1.jpg">
				<img class="collage-2" src="<?php bloginfo('stylesheet_directory');?>/images/deer-zone/sweepstakes/Collage-2.jpg">
			</div>
		</div>
		<div class="sweeps-dark-bar">
			<p>Enter for your chance to <span>WIN</span> a 4 day, 5 night hunt with Hidden Hills Outfitters on over 90,000 acres of prime Nebraska whitetail habitat!</p>
		</div>
	</div><!-- .m-article-image -->
	<article class="m-article clearfix m-article-sweeps">
		<div class="m-social-wrap clearfix">
			<ul class="share-count social-buttons">
				<li>
					<a href="http://www.facebook.com/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&t=Rigged and Ready RAM Outdoorsman Sweepstakes" class="socialite facebook-like reload-fb" data-href="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-share="true" data-action="like" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden"></span></a> 
				</li>
			    <li>
			         <a href="http://twitter.com/share" class="socialite twitter-share reload-twitter" data-text="Rigged and Ready RAM Outdoorsman Sweepstakes" data-url="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" rel="nofollow" target="_blank"><span class="vhidden"></span></a> 
			    </li>
			</ul>
		</div><!-- .m-social-wrap -->
		<div class="m-sweep-blocks clearfix">
			<div class="m-sweep-left">
				<div class="m-sweep-enter">
					<h1>ENTER TO WIN!</h1>
					<div></div>
				</div>
				<script type="text/javascript"> var cnt_id = "d960c143-22193";</script>
				<script type="text/javascript" src="https://www.viralsweep.com/external/widget.js"></script>
			</div>
			<div class="m-sweep-right">
				<p class="m-sweeps-firs-p"><a href="http://www.hiddenhillsoutfitters.com/?utm_source=pagelink&utm_medium=website&utm_campaign=riggedandready&utm_term=gameandfish&utm_content=deerzone" target="_blank">Outfitter: Hidden Hills Outfitters</a></p>
				<ul>
					<li>Excellent log cabin lodging with great meals</li>
					<li>High success on whitetails</li>
					<li>Excellent guides</li>
					<li>Over the counter hunting tags</li>
					<li>All lodging, meals and trophy prep of game taken</li>
					<li>Does not included Nebraska hunting licenses, transportation to the lodge, and tips/gratuities</li>
				</ul>
				<div class="video-container">
					<iframe src="http://player.theplatform.com/p/6eFMJC/8K9sMYdh_Hbp/embed/select/zAUAPTEgaNG6?autoPlay=false" width="322" height="250" frameborder="0" allowfullscreen/>Your browser does not support iframes./</iframe/>
				</div>
			</div>
		</div><!-- .m-sweep-blocks -->
		<div class="m-social-wrap">
			<ul class="share-count social-buttons">
				<li>
					<a href="http://www.facebook.com/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&t=Rigged and Ready RAM Outdoorsman Sweepstakes" class="socialite facebook-like reload-fb" data-href="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" data-send="false" data-layout="button_count" data-share="true" data-action="like" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden"></span></a> 
				</li>
			    <li>
			         <a href="http://twitter.com/share" class="socialite twitter-share reload-twitter" data-text="Rigged and Ready RAM Outdoorsman Sweepstakes" data-url="<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" rel="nofollow" target="_blank"><span class="vhidden"></span></a> 
			    </li>
			</ul>
		</div><!-- .m-social-wrap -->
	</article>
</div><!-- .m-article-wrap -->
					
<?php get_template_part('../imo-mags-parent/content/microsite-template-parts/deer-zone/sweeps', 'banner'); ?>						
<?php get_template_part('../imo-mags-parent/content/microsite-template-parts/deer-zone/choose', 'location-bottom'); ?>		

<?php get_footer(); ?> 