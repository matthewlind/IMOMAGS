<?php
/*
 * Plugin Name: IMO JSON
 * Plugin URI: http://github.com/imoutdoors
 * Description: Creates a JSON feed to power various AJAX requests
 * Version: 0.1
 * Author: Aaron Baker
 */
add_action("init", "imo_json");

function imo_json() {

    //caliber.json
    if (preg_match("/^\/caliber\.json(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) {
        header('Content-type: application/json');
    
        if($_GET['manufacturer']){
         

            $parentSlug = $_GET['manufacturer'];

            $terms = array();
  
            $parentTerm = get_term_by("slug",$parentSlug,"manufacturer");

            $id = $parentTerm->term_id;
            $taxonomyName = 'manufacturer';
            $termchildren = get_term_children( $id, "manufacturer" );
                foreach ($termchildren as $child) {
                    $term = get_term_by( 'id', $child, $taxonomyName );
                    $terms[] = $term;
                }

            $json = json_encode($terms);
            print $json;
                
        }


        die();

    }   

    //reviews.json
    if (preg_match("/^\/reviews\.json(\?(.+)?)?$/", $_SERVER['REQUEST_URI'])) {
        header('Content-type: application/json');

        $args['post_type'] = 'reviews';

        if($_GET['manufacturer']) {
            $args['manufacturer'] = $_GET['manufacturer'];
        }

        if($_GET['guntype']) {
            $args['guntype'] = $_GET['guntype'];
        }        

        $query = new WP_Query( $args );

        $dataArray = array();

        while ( $query->have_posts() ) : $query->the_post();



            $review = array();
            
            $review['title'] = get_the_title();
            $review['id'] = get_the_ID();
            $review['date'] = get_the_time('F jS, Y');
            $review['permalink'] = get_permalink();
            $review['comment_count'] = get_comments_number();
            $review['thumbnail'] = get_the_post_thumbnail(null,null, array('class' => 'entry-img'));


            $review['excerpt'] = get_the_excerpt();
            

            $dataArray[] = $review;
        endwhile;

        // $dataArray = array();

        // foreach ($poll_answers as $data) {
        //     $dataArray[] = array($data->polla_answers,(int)$data->polla_votes);
        // }

         $json = json_encode($dataArray);



         print $json;
        die();
    } 





 

}





