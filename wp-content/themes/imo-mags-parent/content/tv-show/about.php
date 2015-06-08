<div class="tv-items-wrap">
	<h1>MEET THE HOSTS</h1>
	
<?php 
$host_item = get_field("host_item");
if( !empty($host_item) ): 
	while(has_sub_field("host_item")): 
	
	$host_photo = get_sub_field("host_photo");
	$host_name = get_sub_field("host_name");
	$host_fact = get_sub_field("host_fact");
	$host_fact_img = get_sub_field("host_fact_img");
	$host_copy = get_sub_field("host_copy");
?>
	<div class="host-item">
		<div class="host-head">
			<div class="host-photo" style="background-image: url('<?php echo $host_photo['url']; ?>');"></div>
			<div class="host-info">
				<h2><?php echo $host_name; ?></h2>
				<?php if ($host_fact): ?>
				<p><?php echo $host_fact; ?></p>
				<img src="<?php echo $host_fact_img['url']; ?>" alt="<?php echo $host_fact_img['alt']; ?>">
				<?php endif; ?>
			</div>
		</div><!-- end of .host-head  TEST-->
		<div class="host-copy">
		 	<p><?php echo $host_copy; ?></p>
		</div>
	</div><!-- end of .host-item -->
	<?php endwhile; ?>
<?php endif; ?>
</div>