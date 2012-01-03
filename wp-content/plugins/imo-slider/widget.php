<?php


namespace imo;



/**
 * IMOSportsmanWidget
 *
 * Creates the store wdiget for a page. 
 */
class IMOSliderWidget extends \WP_Widget {

    function __construct()
    {
        parent::__construct("slider-widget", "IMO Slider Widget");
    }

    /**
     * renders administrative form for the widget
     */
    function form($instance) {
	/* Set up some default widget settings. */

    $defaults = array (
      'post_type' => 'any',
      'limit' => '20',
    );


	$instance = wp_parse_args( (array) $instance, $defaults ); 
    //_log(var_export($instance,1));
    ?>


	<!-- Widget Header: Text Input -->
	<p style="height:380px;">

        <label for="<?php echo $this->get_field_id( 'header' ); ?>">Title:</label>
        <input id="<?php echo $this->get_field_id( 'header' ); ?>" name="<?php echo $this->get_field_name( 'header' ); ?>" value="<?php echo $instance['header']; ?>" style="width:100%;" />

		<label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>" style="display:block;padding-top:10px;" >Select Terms:</label>
        <?php $this->the_taxonomy_select($instance); ?>
        <label for="<?php echo $this->get_field_id( 'post_type' ); ?>" style="display:block;padding-top:10px;" >Post Type:</label>
        <?php $this->the_post_type_select($instance); ?>
        <label for="<?php echo $this->get_field_id( 'limit' ); ?>" style="display:block;padding-top:10px;" >Post Count Limit:</label>
        <?php $this->the_limit_input($instance); ?>

	</p>

    <?php
    }

    /**
     * Updates the contents of the widget.
     * @See WP_Widget:update
     */
    function update($new_instance, $old_instance) {
	
		$instance = $old_instance;

        $cheesecake = array("gold" => array("pols","asfesa",234,'23'));
        $pastry = array("lasso","cheese");


        $instance['post_type'] = $new_instance['post_type'];
        
		$instance['taxonomy'] = $new_instance['taxonomy'];
        $instance['limit'] = $new_instance['limit'];
        $instance['header'] = $new_instance['header'];

		return $instance;
    }

    /**
     * Outputs the widget contet.
     * @see WP_Widget::widget
     */
    function widget($args, $instance) {
        global $add_slider_script;
        $add_slider_script = TRUE;
        
        extract( $args );
	
        
        
    	$taxonomy = $instance['taxonomy'];
 
    	$baseURL = get_bloginfo('url');
    	
    	$pluginPath = $baseURL . '/wp-content/plugins/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
    	
    	print $before_widget; 
        
        $contentType = 'posts';

        $args = $this->get_query_args_from_term_slug_array($taxonomy,$contentType);
            
        // The Query
        $the_query = new \WP_Query( $args );


        if (!empty($instance['header'])) {
            
            echo "<div class='imo-slider-header'>";
            echo $instance['header'];
            echo "</div>";
        }
        

        echo "<div id='scroll_mask'>\n";
        echo "<ul id='scroll'>\n";

        // The Loop
        while ( $the_query->have_posts() ) : $the_query->the_post();
                        $url = get_permalink();
                        $title = the_title(null,null,FALSE);
                        
                        error_log("****************77777777777777666665556665656656656774778*******");


                        $_img_id = get_post_thumbnail_id();

                        $imgArray = wp_get_attachment_image_src($_img_id, "imo-slider-thumb", false);


                        $imgSrc = $imgArray[0];

                        echo "<li><a href='$url'><img src='$imgSrc'></a><a href='$url'>$title</a></li>\n";

        endwhile;

        echo "</ul>\n";
        echo "</div>\n";
        echo "<a id='prev'>PREV</a>\n";
        echo "<a id='next'>NEXT</a>\n";
                    
        
        // Reset Post Data
        wp_reset_postdata();
            
            
    	print $after_widget;
    }

    function get_query_args_from_term_slug_array($termSlugs,$contentType){
        


         $taxonomyList = get_taxonomies(); 

         $taxQuery = array('relation' => 'AND');


        foreach ($termSlugs as $termSlug) {
            
            foreach ($taxonomyList as $taxonomy => $value) {


                
                if (term_exists($termSlug,$taxonomy)) {


                    $term = get_term_by('slug',$termSlug,$taxonomy);
                        
                    
                    $taxQuery[] = array(
                            'taxonomy' => $term->taxonomy,
                            'field'=>'slug',
                            'terms'=>$term->slug,
                        );

                }

            }


        }


    
   



        $args = array(
            'tax_query' => $taxQuery,
            
            'posts_per_page' => 20,

        );

        return $args;
    }


    function the_limit_input($instance) {
        $id = $this->get_field_id( 'limit' ); 
        $name = $this->get_field_name( 'limit' );
        $value = $instance['limit'];

        echo "<input type='text' name='$name' id='$id' value='$value' style='width:30px;'>";
     
    }

    function the_post_type_select($instance) {


        $postTypes = get_post_types();

        $defaults = $instance['post_type'];
        $id = $this->get_field_id( 'post_type' ); 
        $name = $this->get_field_name( 'post_type' );


        

        print "<select id='$id' name='$name' >";

        print "<option $active value='any'>All Post Types</option>";

        foreach ($postTypes as $postType) {
            $active = "";


            
            if ($postType == $defaults) {
                     $active = "selected";
  
                 }

            print "<option $active value='$postType'>$postType</option>";

        }
        
        print "</select>";

    }

    function the_taxonomy_select($instance) {



        $taxonomies = get_taxonomies();           

        //$taxonomies = array('activity','gear','location','species');

        $defaults = $instance['taxonomy'];
            

        $id = $this->get_field_id( 'taxonomy' ); 
        $name = $this->get_field_name( 'taxonomy' ) . "[]";
        print "<select id='$id' name='$name' placeholder='Choose Terms' style='width:220px;height:230px;' class='' multiple>";

        foreach ($taxonomies as $taxonomy) {

            print "<optgroup label='$taxonomy'>";


           $terms = get_terms( $taxonomy, array( 'hide_empty' => 0 ) );
        

            
            foreach ($terms as $term) {
                //print_r($term);
                //echo $term->name . " " . $term->slug . "<br>";
                $title = $term->name;
                $value = $term->slug;
                $active = "";

                 if (in_array($value,$defaults)) {
                     $active = "selected";
                 }
                    

                print "<option $active value='$value'>$title</option>";
                
            } 
            
            print "</optgroup>";      
                
        }

        print "</select>";
         
    }



}





add_action("widgets_init", function() {
    return register_widget("imo\IMOSliderWidget");
});

