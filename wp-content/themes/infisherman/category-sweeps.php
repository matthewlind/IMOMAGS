<?php
	$microsite = true;
	get_header(); 
	
?>
<div class="m-article-wrap clearfix">	
	<div class="m-article-image">
		<div class="m-direction">
			<span>WIN!</span>
		</div>
		<div class="m-sweep-text">
			<h1>Get Rigged & Ready<br><span>TO FISH<br> COSTA RICA!</span></h1>
			<p>Win an all-expense paid 7 Night 6 Day Fishing trip for two in Nosara, Costa Rica home to some of the best Sport Fishing in Central America.</p>
		</div>
	</div><!-- .m-article-image -->
	<article class="m-article clearfix">
		<div class="m-social-wrap">
			<ul class="share-count social-buttons">
				<li>
					<a href="http://www.facebook.com/sharer.php?u=<?php echo (urlencode(site_url())) . '/rigged-ready/sweeps/'; ?>&t=Rigged and Ready RAM Outdoorsman Sweepstakes" class="socialite facebook-like reload-fb" data-href="<?php echo (urlencode(site_url())) . '/rigged-ready/sweeps/'; ?>" data-send="false" data-layout="button_count" data-share="true" data-action="like" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden"></span></a> 
				</li>
			    <li>
			         <a href="http://twitter.com/share" class="socialite twitter-share reload-twitter" data-text="Rigged and Ready RAM Outdoorsman Sweepstakes" data-url="<?php echo (urlencode(site_url())) . '/rigged-ready/sweeps/'; ?>" rel="nofollow" target="_blank"><span class="vhidden"></span></a> 
			    </li>
			</ul>
		</div><!-- .m-social-wrap -->
		<div class="m-sweep-blocks clearfix">
			<div class="m-sweep-left">
				<div class="m-sweep-enter">
					<h1>ENTER TO WIN!</h1>
					<div></div>
				</div>
				<script type="text/javascript">var cnt_id = "f83efcdb-18776";</script>
		        <script type="text/javascript" src="https://www.viralsweep.com/external/widget.js"></script>
			</div>
			<div class="m-sweep-right">
				<p>Fish 3 Full Action Packed Days with Fishing Nosara. Take a break to explore the Rain Forest Canopy , take a Horseback adventure into the Mountains , Snorkel the perfect beaches and reefs around  Nosara and explore the area in your street legal Safari Cart.</p>
				<div class="video-container">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/HdWgmCikSas" frameborder="0" allowfullscreen></iframe>
				</div>
				<p>Trip is available in October or November 2015. Arrive Saturday, depart the following Saturday. Trip includes Roundtrip Airfare for 2 from nearest major city in 48 states, all meals, 7 nights lodging at Nosara Paradise Rentals, airport transfers in Costa Rica, Rain Forest and Horseback adventures, 3 full days blue water fishing with Fishing Nosara, use of Safari cart during stay and gratuities.
				</p>
			</div>
		</div><!-- .m-sweep-blocks -->
		<div class="m-social-wrap">
			<ul class="share-count social-buttons">
				<li>
					<a href="http://www.facebook.com/sharer.php?u=<?php echo (urlencode(site_url())) . '/rigged-ready/sweeps/'; ?>&t=Rigged and Ready RAM Outdoorsman Sweepstakes" class="socialite facebook-like reload-fb" data-href="<?php echo (urlencode(site_url())) . '/rigged-ready/sweeps/'; ?>" data-send="false" data-layout="button_count" data-share="true" data-action="like" data-width="60" data-show-faces="false" rel="nofollow" target="_blank"><span class="vhidden"></span></a> 
				</li>
			    <li>
			         <a href="http://twitter.com/share" class="socialite twitter-share reload-twitter" data-text="Rigged and Ready RAM Outdoorsman Sweepstakes" data-url="<?php echo (urlencode(site_url())) . '/rigged-ready/sweeps/'; ?>" rel="nofollow" target="_blank"><span class="vhidden"></span></a> 
			    </li>
			</ul>
		</div><!-- .m-social-wrap -->
	</article>
</div><!-- .m-article-wrap -->
					
<?php get_template_part('content/sweeps-banner', 'rigged-ready'); ?>	
		
<div class="m-loc">
	<h2>Choose A Region</h2>
	<div class="m-loc-wrap">
		<ul class="clearfix">
			<li>
				<a href="/rigged-ready/ne/">
					<div class="m-loc-circle <?php if (is_category("ne")) { echo "m-shiny-circle"; }?>"></div>
					<span>NORTHEAST</span>
				</a>
			</li>
			<li>
				<a href="/rigged-ready/se/">
					<div class="m-loc-circle <?php if (is_category("se")) { echo "m-shiny-circle"; }?>"></div>
					<span>SOUTHEAST</span>
				</a>
			</li>
			<li>
				<a href="/rigged-ready/mw/">
					<div class="m-loc-circle <?php if (is_category("mw")) { echo "m-shiny-circle"; }?>"></div>
					<span>MIDWEST</span>
				</a>
			</li>
			<li>
				<a href="/rigged-ready/sw/">
					<div class="m-loc-circle <?php if (is_category("sw")) { echo "m-shiny-circle"; }?>"></div>
					<span>SOUTHWEST</span>
				</a>
			</li>
			<li>
				<a href="/rigged-ready/nw/">
					<div class="m-loc-circle <?php if (is_category("nw")) { echo "m-shiny-circle"; }?>"></div>
					<span>NORTHWEST</span>
				</a>
			</li>
		</ul>
	</div>
</div><!-- .m-loc -->			

				
<?php get_footer(); ?>