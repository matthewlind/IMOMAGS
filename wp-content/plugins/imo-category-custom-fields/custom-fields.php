<?php
/*
Plugin Name: IMO Category Custom Fields
Plugin URI: http://www.imomgas.com
Description: Adds a checkbox to turn a category page into a Network category page, among other things.
Author: Aaron Baker
Version: 0.1
*/


add_action('category_add_form_fields', 'imo_category_add_field');
add_action('category_edit_form_fields', 'imo_category_add_field');


add_action("pre_get_posts","imo_category_page_scripts");


function imo_category_page_scripts() {

	if ( is_category() ) {


		wp_enqueue_script("category-network-feed",plugins_url('category-network-feed.js', __FILE__),array('jquery'));



	}
}

add_action('template_redirect', 'imo_category_template_redirect');
function imo_category_template_redirect() {
    if (is_category()) {

    	$categoryID = get_query_var('cat');


    	if (get_option('use_network_feed_'.$categoryID, false) || get_option('full_width_image_'.$categoryID, false)) {

			if ( $overridden_template = locate_template( 'category-network-feed.php' ) ) {
			// locate_template() returns path to file
			// if either the child theme or the parent theme have overridden the template
			load_template( $overridden_template );
			} else {
			// If neither the child nor parent theme have overridden the template,
			// we load the template from the 'templates' sub-directory of the directory this file is in
			load_template( dirname( __FILE__ ) . '/category-network-feed.php' );
			}
			exit;
    	}


    }
}





function imo_category_add_field($term) {

	$term_id = $term->term_id;

	$networkFeedChecked = "";
	$fullWidthChecked = "";

	if (get_option('use_network_feed_'.$term_id))
		$networkFeedChecked = "checked";

	if (get_option('full_width_image_'.$term_id))
		$fullWidthChecked = "checked";
		
	if (get_option('post_set_id_'.$term_id))
		$post_set_id = get_option('post_set_id_'.$term_id);

	if (get_option('playerID_'.$term_id))
		$playerID = get_option('playerID_'.$term_id);

	if (get_option('playerKey_'.$term_id))
		$playerKey = get_option('playerKey_'.$term_id);

	if (get_option('network_video_title_'.$term_id))
		$network_video_title = get_option('network_video_title_'.$term_id);


	echo "<tr class='form-field'>
			<th scope='row' valign='top'><label for='use_network_feed'>Use Network Feed </label></th>
			<td><input type='checkbox' style='width:20px' name='use_network_feed' id='use_network_feed' value='1' $networkFeedChecked />
				<span class='description'>Check this to pull content form this taxonomy from across the entire network</span>
			</td>
		</tr>";

	echo "<tr class='form-field'>
			<th scope='row' valign='top'><label for='full_width_image'>Full Width Image</label></th>
			<td><input type='checkbox' style='width:20px' name='full_width_image' id='ufull_width_image' value='1' $fullWidthChecked />
				<span class='description'>If the image below is intended to be shown without a title and description, check this.
				<h3>Image Upload Guidelines:</h3>
				<ul>
					<li>Full Width images should should have a width of 620px. Images shown with text should have a height of 100-120px. If the image is wider than 160px, the text will overlap the image. This may be what you want.</li>
				</ul>
				</span>
			</td>
		</tr>";
		
	//featured post set
	echo "<tr class='form-field'>
			<th scope='row' valign='top'><label for='post_set_id'>Featured Post Set ID</label></th>
			<td><input type='text' style='width:30px' name='post_set_id' id='post_set_id' value='$post_set_id' />
			<span class='description'>Enter the Featured post set ID if you want to feature content at the top of the page.</span>
			</td>
		</tr>";
	
	//brightcove player	
	echo "<tr class='form-field'>
			<th scope='row' valign='top'><label for='network_video_title'>Player Title</label></th>
			<td><input type='text' name='network_video_title' id='network_video_title' value='$network_video_title' />
			</td>
		</tr>";

	echo "<tr class='form-field'>
			<th scope='row' valign='top'><label for='playerID'>Brightcove Player ID</label></th>
			<td><input type='text' name='playerID' id='playerID' value='$playerID' />
			</td>
		</tr>";
		
	echo "<tr class='form-field'>
			<th scope='row' valign='top'><label for='playerKey'>Brightcove Player Key</label></th>
			<td><input type='text' name='playerKey' id='playerKey' value='$playerKey' />
			</td>
		</tr>";

}



// save our taxonomy image while edit or save term
add_action('edit_term','save_imo_category_field');
add_action('create_term','save_imo_category_field');
function save_imo_category_field($term_id) {

    if(isset($_POST['use_network_feed']))
        update_option('use_network_feed_'.$term_id, $_POST['use_network_feed']);
    else
    	delete_option('use_network_feed_'.$term_id);

    if(isset($_POST['full_width_image']))
        update_option('full_width_image_'.$term_id, $_POST['full_width_image']);
    else
    	delete_option('full_width_image_'.$term_id);
    
    if(!empty($_POST['post_set_id']))
        update_option('post_set_id_'.$term_id, $_POST['post_set_id']);
    else
    	delete_option('post_set_id_'.$term_id);
    	
    if(!empty($_POST['network_video_title']))
        update_option('network_video_title_'.$term_id, $_POST['network_video_title']);
    else
    	delete_option('network_video_title_'.$term_id);
    
    if(!empty($_POST['playerID']))
        update_option('playerID_'.$term_id, $_POST['playerID']);
    else
    	delete_option('playerID_'.$term_id);
    	
    if(!empty($_POST['playerKey']))
        update_option('playerKey_'.$term_id, $_POST['playerKey']);
    else
    	delete_option('playerKey_'.$term_id);
}
