<?php
global $IMO_COMMUNITY_CONFIG;
$terms = $IMO_COMMUNITY_CONFIG['post_types'];
var_dump($terms);
?>

<div class="community-header">
	<div class="header-section">
		<a href="/photos/"><img src="<?php echo plugins_url('images/yourphotos.png' , __FILE__ ); ?>" alt="<?php echo $state ?> Game & Fish Photos" title="Game & Fish Photos" /></a>
		<div class="sponsor"><?php imo_dart_tag("240x60"); ?></div>
	</div>
	<div class="header-section">
		<h3><a href="/photos/hunting">Hunting</a></h3>
		<?php 
			echo "<ul class='community-nav'>";
			$termcount = 0;
			foreach ($terms as $term) {
				echo "<li>$term<li>";
				if ($termcount%6 == 0) {
					//If $termcount divides by 6 evenly with no remainder
					echo "</ul><ul class='community-nav'>";
				}
			}
			echo "</ul>";
		?>
	</div>
	
	<div class="header-section">
		<h3><a href="/photos/hunting">Fishing</a></h3>
		<?php 
			echo "<ul class='community-nav'>";
			//$termcount = 0;
			foreach ($terms as $term) {
				echo "<li>$term<li>";
				if ($termcount%6 == 0) {
					//If $termcount divides by 6 evenly with no remainder
					echo "</ul><ul class='community-nav'>";
				}
			}
			echo "</ul>";
		?>
	</div>
</div>