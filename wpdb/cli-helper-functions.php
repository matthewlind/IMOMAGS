<?php
//************************************************
//*** HELPER FUNCTIONS ***
//************************************************
function getPostTerms($post_id, $site_id = 6) {

    try {

        $db = dbConnect();

        $sql = "SELECT DISTINCT name,slug,t.term_id,taxonomy From wp_{$site_id}_terms as t
            JOIN wp_{$site_id}_term_taxonomy as tt on (t.`term_id` = tt.`term_id`)
            JOIN `wp_{$site_id}_term_relationships`as tr on (tr.`term_taxonomy_id` = tt.`term_taxonomy_id`)
            WHERE tr.`object_id` = ?
            AND taxonomy = 'category'";



        $stmt = $db->prepare($sql);
        $stmt->execute(array($post_id));

        $terms = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = "";

        foreach ($terms as $key => $term) {
	    	$parent = getParentTerm($term);
	    	$terms[$key]->parent = $parent;
        }

        return($terms);

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}


function delete_all_between($beginning, $end, $string) {
  $beginningPos = strpos($string, $beginning);
  $endPos = strpos($string, $end);
  if (!$beginningPos || !$endPos) {
    return $string;
  }

  $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

  return str_replace($textToDelete, '', $string);
}


function getWhitetailPostTerms($post_id, $site_id = 6) {

    try {

        $db = dbConnect();

        $sql = "SELECT DISTINCT name,slug,t.term_id,taxonomy From wp_{$site_id}_terms as t
            JOIN wp_{$site_id}_term_taxonomy as tt on (t.`term_id` = tt.`term_id`)
            JOIN `wp_{$site_id}_term_relationships`as tr on (tr.`term_taxonomy_id` = tt.`term_taxonomy_id`)
            WHERE tr.`object_id` = ?
            AND slug != 'naw-plus'
            AND taxonomy = 'category'";



        $stmt = $db->prepare($sql);
        $stmt->execute(array($post_id));

        $terms = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = "";

        foreach ($terms as $key => $term) {
        	$parent = getParentTerm($term);
        	$terms[$key]->parent = $parent;
        }

        return($terms);

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}

function getParentTerm($term) {

	try {


        $db = dbConnect();

        $sql = "SELECT t.slug FROM wp_6_terms as t
				JOIN wp_6_term_taxonomy as tt ON t.term_id = tt.term_id
				JOIN wp_6_term_taxonomy as tp ON tp.parent = tt.term_id
				JOIN wp_6_terms ts ON ts.term_id = tp.term_id
				WHERE tt.taxonomy = 'category'
				AND ts.slug = ?";



        $stmt = $db->prepare($sql);
        $stmt->execute(array($term->slug));

        $terms = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = "";

        foreach ($terms as $term) {

        	$slug = $term->slug;
        	$results[] = $slug;



        }

        $slug = null;
        if (!empty($terms))
        	$slug = $terms[0]->slug;

        return($slug);

    } catch(PDOException $e) {
        echo $e->getMessage();
    }

}



function getAllChildTerms($term_slug, &$results = array()) {

	try {

        $db = dbConnect();

        $sql = "SELECT ts.slug FROM wp_6_terms as t
				JOIN wp_6_term_taxonomy as tt ON t.term_id = tt.term_id
				JOIN wp_6_term_taxonomy as tp ON tp.parent = tt.term_id
				JOIN wp_6_terms ts ON ts.term_id = tp.term_id
				WHERE tt.taxonomy = 'category'
				AND t.slug = ?";



        $stmt = $db->prepare($sql);
        $stmt->execute(array($term_slug));

        $terms = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = "";

        foreach ($terms as $term) {

        	$slug = $term->slug;
        	$results[] = $slug;

        	getAllChildTerms($slug,$results);

        }

        return($results);

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}






/* Better Logging Function */
if(!function_exists('_log')){
  function _log( $message ) {
	  if( is_array( $message ) || is_object( $message ) ){

	  	$errorString = print_r( $message, true );

	    error_log( "$errorString",0);
	  } else {
	    error_log( $message );
	  }
  	}
}