<?php
if($_POST['manufacturer']){
	$id = $_POST['manufacturer'];
	$taxonomyName = 'manufacturer';
	$termchildren = get_term_children( $id, $taxonomyName );
 		foreach ($termchildren as $child) {
			$term = get_term_by( 'id', $child, $taxonomyName );
			echo "<option value=".$term->term_id.">" . $term->name . "</option>";
        }
        
}
?>

