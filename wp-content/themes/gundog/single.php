<?php
	get_header('redesign');
	global $post;
	
	$post_id	= $post->ID;
	$author_id	= $post->post_author;
	
	$author 	= get_the_author();
	
	$byline 	= get_post_meta($post_id, 'ecpt_byline', true);
	$acf_byline = get_field("byline", $post_id);
	
	// POST CATEGORIES
	$post_categories = wp_get_post_categories( $post_id );
	$cat_list = '';
	foreach($post_categories as $c){
	    $cat = get_category( $c );
	    $cat_url = get_category_link( $c );			    
	    $cat_list .= "<a href='".  $cat_url . "'>" . $cat->name . "</a>";
	}
	
	
	
	
?>

<main class="main-single">
	<article class="article">
		<header class="article-header">
			<div class="post-cats">
				<?php echo $cat_list; ?>
			</div>
			<h1><?php the_title(); ?></h1>
			<div class="byline">
				<span>
<?php 				if (!$acf_byline) { 
						if ($author != 'admin') echo 'by&nbsp;' . $author . '&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;';
					} else {
						echo $acf_byline . '&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;';
					} 
					the_time('F jS, Y'); 
?>				</span>
			</div>
			<div class="social-single">
				<ul>
					<li><a href=""><i class="icon-facebook"></i></a></li>
					<li><a href=""><i class="icon-twitter"></i></a></li>
					<li><a href=""><i class="icon-envelope"></i></a></li>
				</ul>
			</div>
		</header>
		<div class="article-body">
<?php		$content 	= apply_filters('the_content', $post->post_content);
			$add_p		= get_field('add_p', $post_id); if (!$add_p) $add_p = 0;
			$contents = explode("</p>", $content);
			$p_counter = 0;
			foreach($contents as $content){
			    echo $content.'</p>';
			   
			    if($p_counter == 5){ ?>
			   
					<div class="alignright-content m-buy-wrap"> 
			    		blblbbblaalbalbal blabalbDLGSGJGDSGSG SGSGSJG
			    	</div>

<?php 			}	

			    $p_counter++;
			    $current_p = $p_counter - ($add_p);
			}
			
?>		</div>
	</article>
</main>




<?php get_footer('redesign'); ?>