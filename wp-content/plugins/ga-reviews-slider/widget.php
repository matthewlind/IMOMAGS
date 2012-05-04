<?php


namespace imo;



/**
 * IMOSportsmanWidget
 *
 * Creates the store wdiget for a page. 
 */
class GAReviewSliderWidget extends \WP_Widget {

    function __construct()
    {
        parent::__construct("ga-slider-widget", "GA Reivews Slider Widget");
    }

    /**
     * renders administrative form for the widget
     */
    function form($instance) {
	/* Set up some default widget settings. */

    $defaults = array (
      'post_type' => 'review',
      'limit' => '20',
    );


	$instance = wp_parse_args( (array) $instance, $defaults ); 
    //_log(var_export($instance,1));
    ?>


	<!-- Widget Header: Text Input -->

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

?>
<div class="ga-reviews-slider">
<div class="section-title posts">
    <h4 class="reviews-form-header">
        <div class="icon"></div>
            <span>Latest Reviews</span> 
    </h4>
    <form action="<?php $_SELF['REQUEST_URI']; ?>" method="post" id="form" class="reviews-form">

        <select class="guntype slider-reviews-select">
            <option selected="selected" name="guntype" value="">Type</option>
            <?php
            $parents = array('parent' => 0);
            $terms = get_terms("guntype", $parents);
            $count = count($terms);

            if ( $count > 0 ){
                foreach ( $terms as $term ) {
                    $termName = str_replace(" Reviews","",$term->name);
                    echo "<option value=".$term->slug.">" . $termName . "</option>";
                }
            }
            ?>
        </select>
        <!-- disabled="disabled" -->
        <select name="manufacturer" class="manufacturer slider-reviews-select" value="">
            <option selected="selected" name="Manufacturer" value="">Manufacturer</option> 
            <?php
            $terms = get_terms("manufacturer",array("parent" => 0));
            $count = count($terms);
            if ( $count > 0 ){
                foreach ( $terms as $term ) {
                    echo "<option value=".$term->slug.">" . $term->name . "</option>";
                }
            }
            ?>
        </select>
        <select class="caliber slider-reviews-select">
            <option selected="selected" name="caliber" value="">Caliber</option>
            <option name="null" value="">Choose a Manufacturer</option>
        </select>
    </form>
</div>

<div class="reviews-cover" style="display:none;"></div>

  <?php
        global $add_slider_script;
        $add_slider_script = TRUE;
        

        

        extract( $args );
	       



        
    	$taxonomy = $instance['taxonomy'];
 
    	$baseURL = get_bloginfo('url');
    	
    	$pluginPath = $baseURL . '/wp-content/plugins/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
    	
    	print $before_widget; 
        
        $contentType = 'posts';

        $args = $this->get_query_args_from_term_slug_array($taxonomy,$contentType);



        // if ($instance['post_type'] != "any") {
        //     $args['post_type'] = $instance['post_type'];
        // } else {
        //     $args['post_type'] = array("reviews","imo_gallery","imo_video");
        // }

        $args['post_type'] = "reviews";
            
        // The Query
        $the_query = new \WP_Query( $args );


        if (!empty($instance['header'])) {
            
            echo "<div class='imo-slider-header'>";
            echo $instance['header'];
            echo "</div>";
        }
        

        echo "<div id='scroll_mask-reviews' class='scroll_mask'>\n";
        echo "<ul id='scroll-reviews' class='scroll'>\n";

        // The Loop
        while ( $the_query->have_posts() ) : $the_query->the_post();
                        $url = get_permalink();
                        $title = the_title(null,null,FALSE);
                        


                        $_img_id = get_post_thumbnail_id();

                        $imgArray = wp_get_attachment_image_src($_img_id, "imo-slider-thumb", false);


                        $imgSrc = $imgArray[0];

                        echo "<li><a href='$url'><img src='$imgSrc'></a><a href='$url'>$title</a></li>\n";

        endwhile;

        echo "</ul>\n";
        echo "</div>\n";
        echo "<a id='prev-reviews' class='prev'>PREV</a>\n";
        echo "<a id='next-reviews' class='next'>NEXT</a>\n";
                    
        
        // Reset Post Data
        wp_reset_postdata();
            
echo "</div>";//ga-reviews-slider
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



        //$taxonomies = get_taxonomies();           

        $taxonomies = array('category');

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
    return register_widget("imo\GAReviewSliderWidget");
});

