<?php

class PhotosAjaxWidget extends WP_Widget{
	function PhotosAjaxWidget(){
		parent::__Construct(false, 'Photos Ajax Widget');
	}
	
	function get_photos_from_post(){
		if(isset($_GET['action']) && $_GET['action'] == 'get_photos'){
			
			$photo_posts = get_posts(array(
				'post_status' => 'publish',
				'numberposts' => -1,
				'post_type'   => 'reader_photos'
			));

			$count = 0;
			foreach ($photo_posts as $key => $photo){
				$post_thumbnail_id = get_post_thumbnail_id( $photo->ID );
				$photo_url         = get_the_post_thumbnail($photo->ID, 'large');
				$thumb_url         = get_the_post_thumbnail($photo->ID, 'thumbnail');
				$permalink         = get_permalink( $photo->ID );

				$response[] = array(
					'ID'        => $photo->ID,
					'photo_url' => $photo_url,
					'thumbnail' => $thumb_url,
					'title'     => $photo->post_title,
					'permalink' => $permalink,
					'count'     => $count,
					'post_name' => $photo->post_name
				);
				
				$count++;
			}
	
			//echo json_encode($photo_posts);
			echo json_encode($response);
			exit;
		}
	}

}

function PhotosAjaxWidget_register() {
	register_widget( 'PhotosAjaxWidget' );
}

add_action('wp_ajax_' . $_GET['action'], 'PhotosAjaxWidget_register');
//add_action('wp_ajax_' . $_GET['action'], 'get_photos_from_post');