<?php
/*  Copyright 2013 IMO FOX */
/*
Plugin Name: Cabela's Essentials Scroller
Plugin URI: http://imomags.com
Description: Cabela's related products scroller for article pages.
Author: IMO FOX
Author URI:
Version: 0.1
Stable tag: 0.1
License: IMO
*/

/********************************
*******LOAD SCRIPTS & STYLE******
*********************************/

add_action('init', 'cabelas_scroll_scripts');
function cabelas_scroll_scripts() {
	//wp_deregister_script( 'jquery' );
	//wp_enqueue_script( 'jquery' );
    wp_enqueue_script('cabela-buffet',plugins_url('js/jquery.buffet.js', __FILE__));
    wp_enqueue_style('cabela-scroll-css',plugins_url('css/expandable.css', __FILE__));	
}


/**********************************************
*******PLACE THE EXPANDABLE IN THE HEADER******
***********************************************/

/***
*
* Load collapsed image into super-ad div
*


add_action('init', 'cabelas_category');
function cabelas_category() {
	global $cabelas_category;
	$cabelas_category = "";
}
***/


//add options for updating values
add_option( 'cabela_product_title_1', 'first product', '', 'yes' );

/*********************************
*******CREATE THE ADMIN AREA******
**********************************/

$object = new cabelas_scroll();

//add a hook into the admin header to check if the user has agreed to the terms and conditions.
add_action('admin_head',  array($object, 'adminHeader'));

//add footer code
//add_action( 'admin_footer',  array($object, 'adminFooter'));

// Hook for adding admin menus
add_action('admin_menu',  array($object, 'addMenu'));

class cabelas_scroll{
	
    /**
     * This will create a menu item under the option menu
     * @see http://codex.wordpress.org/Function_Reference/add_options_page
     */
    public function addMenu(){
        add_options_page("Cabela's Essentials Options", "Cabela's Essentials", "manage_options", "Cabelas-essentials-admin", array($this, "optionPage"));
    }

    /**
     * This is where you add all the html and php for your option page
     * @see http://codex.wordpress.org/Function_Reference/add_options_page
     */
    public function optionPage(){ 
	  
		
		if(isset( $_POST['cabelas-essentials-submit']) ){
	    	
	    	//update the title
	    	$title_name = 'expandable_title';
			$new_title = $_POST['title'];

			
			if ( get_option( $title_name ) != $new_title ) {
			    update_option( $title_name, $new_title );
			} else {
			    $deprecated = ' ';
			    $autoload = 'no';
			    add_option( $title_name, $new_title, $deprecated, $autoload );
			}


	    	//update the collapsed image
		    $collapsed_name = 'expandable_collapsed_image';
			$new_collapsed = $_POST['collapsed-img'];
			
			if ( get_option( $collapsed_name ) != $new_collapsed ) {
			    update_option( $collapsed_name, $new_collapsed );
			} else {
			    $deprecated = ' ';
			    $autoload = 'no';
			    add_option( $collapsed_name, $new_collapsed, $deprecated, $autoload );
			}
			
			
			//update the expanded image script
			$expanded_name = 'expandable_expanded_image';
			$new_expanded = htmlspecialchars($_POST['adscript']);
			
			
			if ( get_option( $expanded_name ) != $new_expanded ) {
			    update_option( $expanded_name, $new_expanded );
			} else {
			    $deprecated = ' ';
			    $autoload = 'no';
			    add_option( $expanded_name, $new_expanded, $deprecated, $autoload );
			}
			
			
			//Convert the dates from the selections to a string
			$sm = $_POST['start-month'];
			$sd = $_POST['start-day'];
			$sy = $_POST['start-year']; 
			
			$start_date = "startDate";
			$new_start_date = $sy.$sm.$sd;
			
			
			if ( get_option( $start_date ) != $new_start_date ) {
			    update_option( $start_date, $new_start_date );
			} else {
			    $deprecated = ' ';
			    $autoload = 'no';
			    add_option( $start_date, $new_start_date, $deprecated, $autoload );
			}
			
			$em = $_POST['exp-month'];
			$ed = $_POST['exp-day'];
			$ey = $_POST['exp-year']; 
			
			$exp_date = "expDate";
			$new_exp_date = $ey.$em.$ed;
			
			
			if ( get_option( $exp_date ) != $new_exp_date ) {
			    update_option( $exp_date, $new_exp_date );
			} else {
			    $deprecated = ' ';
			    $autoload = 'no';
			    add_option( $exp_date, $new_exp_date, $deprecated, $autoload );
			}
			
	   } 	
	   
	   
	   ?>

    	<div class="wrap">
	    	<h2>Cabela's Essentials Scroller</h2>
	    	
	    	<form name="expandable-settings" action="/wp-admin/options-general.php?page=cabelas-essentials-admin" method="post">
	    		
		    	<table class="form-table">
		    		<tr valign="top">
			        	<td><strong>Category Options</strong></td>
			        </tr>
			
					<tr valign="top">
						<th scope="row">Scroller Title</th>
							<td><input type="text" name="title" id="title" value="<?php echo get_option('cabela_scroll_title'); ?>" /></input></td>
					</tr>
					
					<tr valign="top">
			        	<td><strong>Category Options</strong></td>
			        </tr>
			        
					<tr valign="top">
						<th scope="row">Category</th>
						<td>
							<fieldset class="inline-edit-col-left">
							    <div class="inline-edit-col">
							        <input type="hidden" name="cabelas-categories" id="cabelas-categories" value="" />
							        <?php // Get all Categories sets
							            $categories = get_categories();
							        ?>
							        <select name='cabelas-category' id='cabelas-category'>
							            <option class='cabelas-category-option' value='0'>None</option>
							            <?php 
							            foreach ($categories as $category) {
							                echo "<option class='cabelas-category' value='{$category->cat_ID}'>{$category->name}</option>\n";
							            }
							                ?>
							        </select>
							    </div>
						    </fieldset>
						</td>
					</tr>
 
					<tr valign="top">
					</tr>
					
					<?php for ($i=1; $i < 7; $i++){
							
						$productTitle = get_option('cabela_product_title_'.$i);
						$productURL = get_option('cabela_product_URL_'.$i);					
						$imageURL = get_option('cabela_image_URL_'.$i);
												
						echo '<tr valign="top">';
				        	echo '<td><strong>Product '.$i.' </strong></td>';
				        echo '</tr>';
				        
				        echo '<tr valign="top">';
							echo '<th scope="row">Product Title</th>';
					        echo '<td><input type="text" name="product-title-'.$i.'" id="" value="'.$productTitle.'"/></input></td>';
				        echo '</tr>';
				        
				        echo '<tr valign="top">';
							echo '<th scope="row">Product Url</th>';
					        echo '<td><input type="text" name="product-url-'.$i.'" value="'.$productURL.'"/></input></td>';
				        echo '</tr>';
	
				        echo '<tr valign="top">';
							echo '<th scope="row">Product Image Url</th>';
					        echo '<td><input type="text" name="image-url-'.$i.'" value="'.$imageURL.'"/></input></td>';
				        echo '</tr>';
					        
			        } ?>
			        
			       			        
			</table>
			
			    <p class="submit"><input type="submit" name="cabelas-essentials-submit" class="button-primary"></input></p>
		</form>
	        
	    </div>
	    <?php
	    
	    
	    
    }

}
























