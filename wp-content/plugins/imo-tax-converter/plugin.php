<?php
/*
 * Plugin Name: IMO Taxonomy Converter
 * Plugin URI: http://github.com/imoutdoors
 * Description: Helps convert old tags and categories in to the new IMO taxonomy.
 * Version: 0.1
 * Author: Aaron Baker
 * Author URI: http://imomags.com
 */


/**
 * Admin menu add_action callback.
 */
function imo_tax_converter_menu() {
    
    add_options_page('IMO Term Converter', 'IMO Term Convert', "administrator", "imo-tax-converter", "imo_tax_converter_options");
    
}

function imo_tax_converter_options() {
    /**
     * ONLY ADMINS SHOULD BE ABLE TO SEE THIS.
     */
    if (!current_user_can('administrator'))  
    {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }




    if ( empty($_POST['taxonomy_match_data'])  ) {
        $resp=""; // first time visiting...
    }
    else {//IF WE HAVE DATA, DO SOMETHING WITH IT
        
        $resp = "";
        $lines = explode("\n",$_POST['taxonomy_match_data']);
        
        foreach ($lines as $line) {
            
            
            $terms = explode(",",$line);
            
            $old_term = trim($terms[0]);
            $new_term = trim($terms[1]);
            
            $resp .= "<p>" . imo_tax_converter_associate_terms($old_term,$new_term) . "</p>";    
            
        }
        
        
        
        
        
        
    }

    include("imo-tax-converter-options-page.tpl.php");
}



function imo_tax_converter_associate_terms($old_term,$new_term) {
    
    if (!term_exists($old_term)) {
        
        return "***** ERROR: <span style='color:red'>$old_term</span> does not exist! *****";
    }
    
     if (!term_exists($new_term)) {
        
        return "***** ERROR: <span style='color:red'>$new_term</span> does not exist! *****";
    }   
    
    
    $old_term_id =  term_exists($old_term);
    $new_term_id =  term_exists($new_term);
    
    //First, Search by category
    $args = array(
      "category_name" => $old_term,
      "posts_per_page" => -1,
      "nopaging" => TRUE,
    );
    
    
    $query = new WP_Query( $args );
    // The Loop
    $output = "";
    while ( $query->have_posts() ) : $query->the_post();
            
            $output .= "$old_term: " . get_the_title() . "<br>";
            
            $postid = get_the_ID();
            
            //get the new taxonomy name
            $taxNameParts = explode("-",$new_term);
            $newTaxonomy = strtolower($taxNameParts[0]);            
            
            $output .= "--PID: $postid new_term_id: $new_term_id new taxonomy: $newTaxonomy <br>";
            wp_set_post_terms($postid,array($new_term_id),$newTaxonomy,TRUE);
            
            
    endwhile;
    
    if (!$query->have_posts()) {
            
        //Then, Search by tag
        $args = array(
            "tag" => $old_term,
            "posts_per_page" => -1,
            "nopaging" => TRUE,
        );
        
        
        $query = new WP_Query( $args );
        // The Loop
        $output = "";
        while ( $query->have_posts() ) : $query->the_post();
                
                $output .= "$old_term: " . get_the_title() . "<br>";
                
                $postid = get_the_ID();
                
                //get the new taxonomy name
                $taxNameParts = explode("-",$new_term);
                $newTaxonomy = strtolower($taxNameParts[0]);
                
                $output .= "--PID: $postid new_term_id: $new_term_id new taxonomy: $newTaxonomy <br>";
                wp_set_post_terms($postid,array($new_term_id),$newTaxonomy  ,TRUE);
                
                
        endwhile;
        
        
    }
    
    
    // Reset Post Data
    wp_reset_postdata();
    
    
    //return $output;
    return "$old_term -> $new_term : <span style='color:green'>SUCCESS</span>";
}


add_action("admin_menu", "imo_tax_converter_menu");
