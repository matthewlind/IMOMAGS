<?php
/**
 * Template Name: Bracket
*/
get_header(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
				
				
			<?php	

			 if (function_exists('vote_poll') && !in_pollarchive()): 
					
					global $wpdb;
					$question1 = $wpdb->get_results("SELECT polla_answers FROM $wpdb->pollsa WHERE polla_qid = 1");
					foreach($question1 as $poll){
						echo('<li>'.$poll->polla_answers.'</li>');
				
					}
					
				?>
				  <li>
				    <h2>Polls</h2>
				    <ul>
				      <li><?php get_poll(1);?></li>
				    </ul>
				  </li>

				   <li>
				    <h2>Polls</h2>
				    <ul>
				      <li><?php get_poll(2);?></li>
				    </ul>
				  </li>

				<?php endif; ?>
            </div><!-- #content -->
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>