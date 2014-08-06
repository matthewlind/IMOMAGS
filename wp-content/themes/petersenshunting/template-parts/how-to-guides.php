<div class="diy-states clearf">
	<h2>How-to Guides</h2>
	<ul>
		<li><a href="<?php get_site_url(); ?>/border-to-border/how-to-guide/diy-new-mexico/">New Mexico</a><i class="fa fa-angle-double-right"></i></li>
		<li><a href="<?php get_site_url(); ?>/border-to-border/how-to-guide/diy-colorado/">Colorado</a><i class="fa fa-angle-double-right"></i></li>
		<li><a href="<?php get_site_url(); ?>/border-to-border/how-to-guide/diy-wyoming/">Wyoming</a><i class="fa fa-angle-double-right"></i></li>
		<li><a href="<?php get_site_url(); ?>/border-to-border/how-to-guide/diy-idaho/">Idaho</a><i class="fa fa-angle-double-right"></i></li>
		<li><a href="<?php get_site_url(); ?>/border-to-border/how-to-guide/diy-washington/">Washington</a><i class="fa fa-angle-double-right"></i></li>
		<li><a href="<?php get_site_url(); ?>/border-to-border/how-to-guide/diy-british-columbia/">British Columbia</a><i class="fa fa-angle-double-right"></i></li>
		<li><a href="<?php get_site_url(); ?>/border-to-border/how-to-guide/diy-alaska/">Alaska</a><i class="fa fa-angle-double-right"></i></li>
	</ul>
</div>
<h1 class="a-text"><?php echo get_the_title(); ?></h1>
<section class="diy-section">
 	<div class="a-text">
 		<h2>Plan Your Trip</h2>
		<?php while(has_sub_field("plan_your_trip_paragraph")): 
		$paragraph = get_sub_field("paragraph");
		?>
		<p><?php echo $paragraph; ?></p>
		<?php endwhile; ?>	
 	</div>
</section>
<section class="diy-section">
	<div class="a-text">
		<h2>Where We Hunted/Public Land</h2>
		<?php while(has_sub_field("where_we_hunted")): 
		$paragraph = get_sub_field("paragraph");
		?>
		<p><?php echo $paragraph; ?></p>
		<?php endwhile; ?>	
	</div>
</section>
<section class="diy-section">
	<div class="a-text">
		<h2>License Fees and Draw Info</h2>
		<ul class="b2b-license-fees">
			<?php while(has_sub_field("license_fees")): 
			$label = get_sub_field("label");
			$price = get_sub_field("price");
			?>
			<li><?php echo $label; ?>: <span class="b2b-orange"><?php echo $price; ?></span></li>
			<?php endwhile; ?>	
		</ul>
	</div>
</section>
<section class="diy-section">
	<div class="a-text">
		<h2>Useful Links</h2>
		<ul class="diy-links">
			<?php while(has_sub_field("diy_links")): 
			$title = get_sub_field("title");
			$link = get_sub_field("link");
			?>
			<li>
				<h4><?php echo $title; ?>:</h4>
				<a href="<?php echo $link; ?>"><?php echo $link; ?></a>
			</li>
			<?php endwhile; ?>
		</ul>
	</div>
</section>

