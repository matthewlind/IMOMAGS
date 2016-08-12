<?php
	$microsite = true;
	$microsite_rigged = true;
	get_header(); 
?>

<div class="m-home-wrap">
	<ul class="m-regn clearfix">
		<li class="m-ne">
			<a href="/deer-zone/ne/">
				<div class="m-direction">
					<div class="m-triangle"></div>
					<span>Northeast</span>
				</div>
			</a>
		</li>
		<li class="m-se">
			<a href="/deer-zone/se/">
				<div class="m-direction">
					<div class="m-triangle"></div>
					<span>Southeast</span>
				</div>
			</a>
		</li>
		<li class="m-mw">
			<a href="/deer-zone/mw/">
				<div class="m-direction">
					<div class="m-triangle"></div>
					<span>Midwest</span>
				</div>
			</a>
		</li>
		<li class="m-sw">
			<a href="/deer-zone/sw/">
				<div class="m-direction">
					<div class="m-triangle"></div>
					<span>Southwest</span>
				</div>
			</a>
		</li>
		<li class="m-nw">
			<a href="/deer-zone/nw/">
				<div class="m-direction">
					<div class="m-triangle"></div>
					<span>Northwest</span>
				</div>
			</a>
		</li>
	</ul>	
	<?php //get_template_part('../imo-mags-parent/content/microsite-template-parts/deer-zone/sweeps', 'banner'); ?>	
</div><!-- .m-home-wrap -->				
				
<?php get_footer(); ?>