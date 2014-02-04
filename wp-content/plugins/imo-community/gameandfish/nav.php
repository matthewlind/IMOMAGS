<?php
global $IMO_COMMUNITY_CONFIG;
$termTaxonomy = $IMO_COMMUNITY_CONFIG['post_types'];
$huntingTerms = $termTaxonomy['hunting']['children'];
$fishingTerms = $termTaxonomy['fishing']['children'];
?>

<div class="community-header">
	<div class="header-section">
		<a href="/photos/"><img src="<?php echo plugins_url('images/yourphotos.png' , __FILE__ ); ?>" alt="<?php echo $state ?> Game & Fish Photos" title="Game & Fish Photos" /></a>
		<div class="sponsor"><?php imo_dart_tag("240x60"); ?></div>
	</div>
	<?php if(mobile()){
		echo '<div class="header-section">';
			echo "<select>";
				echo "<option value=''>Photos Menu</option>";
				foreach ($huntingTerms as $parentSlug => $term) {
					$child = strtolower( str_replace( " ", "-", $term['display_name']) );
					if( $term["show_in_menu"] == TRUE ){
						echo "<option value='/photos/" . $parentSlug . "/" . $child . " /'>" . $term['display_name'] . "</option>";
					}
				}
			echo "</select>";
		echo "</div>";
	}else{ ?>
	
	<div class="header-section">
		<h3><a href="/photos/hunting">Hunting</a></h3>
		<?php 
			echo "<ul class='community-nav'>";
			$termcount = 0;
			foreach ($huntingTerms as $parentSlug => $term) {
				$parent = strtolower( str_replace( " ", "-", $term['display_name']) );

				if( $term["show_in_menu"] == TRUE ){
					echo "<li><a href='/photos/hunting/" . $parent . "'>" . $term['display_name'] . "</a></li>";
					$termcount++;
					if ($termcount%4 == 0) {
					//If $termcount divides by 4 evenly with no remainder
					echo "</ul><ul class='community-nav'>";
					}
	
				}
				foreach($term['children'] as $childSlug => $termChild) {
					$child = strtolower( str_replace( " ", "-", $termChild['display_name']) );
					if( $termChild["show_in_menu"] == TRUE ){
						echo "<li><a href='/photos/hunting/" . $parentSlug . "/" . $child . "'>" . $termChild['display_name'] . "</a></li>";
						$termcount++;
						if ($termcount%4 == 0) {
							//If $termcount divides by 4 evenly with no remainder
							echo "</ul><ul class='community-nav'>";
						}
					}
				}
			}			
		
			echo "</ul>";
		?>
	</div>
	
	<div class="header-section">
		<h3><a href="/photos/hunting">Fishing</a></h3>
		<?php 
			echo "<ul class='community-nav'>";
			$termcount = 0;
			foreach ($fishingTerms as $parentSlug => $term) {
				$parent = strtolower( str_replace( " ", "-", $term['display_name']) );

				if( $term["show_in_menu"] == TRUE ){
					echo "<li><a href='/photos/fishing/" . $parent . "'>" . $term['display_name'] . "</a></li>";
					$termcount++;
					if ($termcount%4 == 0) {
					//If $termcount divides by 4 evenly with no remainder
					echo "</ul><ul class='community-nav'>";
					}
	
				}
				foreach($term['children'] as $childSlug => $termChild) {
					$child = strtolower( str_replace( " ", "-", $termChild['display_name']) );
					if( $termChild["show_in_menu"] == TRUE ){
						echo "<li><a href='/photos/fishing/" . $parentSlug . "/" . $child . "'>" . $termChild['display_name'] . "</a></li>";
						$termcount++;
						if ($termcount%4 == 0) {
							//If $termcount divides by 4 evenly with no remainder
							echo "</ul><ul class='community-nav'>";
						}
					}
				}
			}			
		
			echo "</ul>";
		?>

	</div>
	<?php } ?>
</div>