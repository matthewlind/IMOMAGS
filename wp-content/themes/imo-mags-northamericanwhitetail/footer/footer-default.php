<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

// For cross-blog queries
global $switched;
$args = array(
  'post_type'			  =>	'post',
	'posts_per_page'	=>	3,
	'orderby'			    =>	'date',
	'order'				    =>	'DESC'
); ?>
		</div><!-- #main -->
	</section><!-- .container -->

  <footer id="footer">
    
      <section id="imo-network">
        <div class="container">
          <!-- <h4><span class="white">Guns &amp; Ammo</span> Shooting Network <span class="tail"></span></h4> -->
          <div id="mag-bowhunter" class="mag first">
            <a class="site-link" href="http://www.bowhunter.com/" title="Visit www.bowhunter.com">
              <img class="cover" src="<?php print get_stylesheet_directory_uri(); ?>/img/mags_bowhunter.jpg" alt />
              <h5>Bowhunter</h5>
            </a>
            <?php switch_to_blog(3);
            $blog = new WP_Query($args);
            if ($blog->have_posts()) :?>
            <ul class="recent-posts">
              <?php while ($blog->have_posts()) : $blog->the_post(); ?>
              <li class="date"><?php the_date('F jS'); ?></li>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile ?>
            </ul>
            <?php endif; restore_current_blog(); ?>
          </div>
          <div id="mag-gf" class="mag">
            <a class="site-link" href="http://www.gameandfishmag.com/" title="Visit www.gameandfishmag.com">
              <img class="cover" src="<?php print get_stylesheet_directory_uri(); ?>/img/mags_gf.jpg" alt />
              <h5>Game & Fish Illinois</h5>
            </a>
            <?php switch_to_blog(14);
            $blog = new WP_Query($args);
            if ($blog->have_posts()) :?>
            <ul class="recent-posts">
              <?php while ($blog->have_posts()) : $blog->the_post(); ?>
              <li class="date"><?php the_date('F jS'); ?></li>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile ?>
            </ul>
            <?php endif; restore_current_blog(); ?>
          </div>
          <div id="mag-petersen" class="mag">
            <a class="site-link" href="http://www.petersenshunting.com/" title="Visit www.petersenshunting.com">
              <img class="cover" src="<?php print get_stylesheet_directory_uri(); ?>/img/mags_petersen.jpg" alt />
              <h5>Petersen's Hunting</h5>
            </a>
            <?php switch_to_blog(7);
            $blog = new WP_Query($args);
            if ($blog->have_posts()) :?>
            <ul class="recent-posts">
              <?php while ($blog->have_posts()) : $blog->the_post(); ?>
              <li class="date"><?php the_date('F jS'); ?></li>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile ?>
            </ul>
            <?php endif; restore_current_blog(); ?>
          </div>
                 
          <div style="clear:both"></div>
        
                
		
     <script type="text/javascript" src="/wp-content/themes/imo-mags-gunsandammo/js/jquery.jcarousel.js"></script>
     <script type="text/javascript">
 		$(document).ready(function(){

 			jQuery('#slides-footer').jcarousel({
 				easing: 'easeOutBack',
 				animation:1000,scroll: 5});	
			
 		});
	 </script>
      <div class="intermedia-network">
            	<div class="network-title">THE INTERMEDIA OUTDOORS NETWORK</div>
                <div class="otd-networkblock">
                	 <div class="slides-container-f">
                        <ul id="slides-footer" class="jcarousel-skin-tango">
                        	<li><a href="http://www.thesportsmanchannel.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/sportsman_channel.png" alt="" /></a></li>
							<li><a href="http://www.petersenshunting.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/hunting.png" alt="" /></a></li>
							<li><a href="http://www.floridasportsman.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/florida_sportsman.png" alt="" /></a></li>
							<li><a href="http://www.flyfisherman.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/fly_fisherman.png" alt="" /></a></li>
							<li><a href="http://www.gunsandammo.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/gunsandammo.png" alt="" /></a></li>
							
							<li><a href="http://www.in-fisherman.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/in_fisherman.png" alt="" /></a></li>
							<li><a href="http://www.gameandfishmag.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/game_and_fish.png" alt="" /></a></li>
							<li><a href="http://www.gundogmag.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/gun_dog.png" alt="" /></a></li>
							<li><a href="http://www.handgunsmag.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/handguns.png" alt="" /></a></li>
							<li><a href="http://www.bowhunter.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/bowhunter.png" alt="" /></a></li>
							<li><a href="http://www.bowhuntingmag.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/bowhunting.png" alt="" /></a></li>
							
							<li><a href="http://www.rifleshootermag.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/rifleshooter.png" alt="" /></a></li>
							<li><a href="http://www.shootingtimes.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/shooting.png" alt="" /></a></li>
							<li><a href="http://www.shotgunnews.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/shotgun_news.png" alt="" /></a></li>
							
							<li><a href="http://www.northamericanwhitetail.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/whitetail.png" alt="" /></a></li>
							<li><a href="http://www.wildfowlmag.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/wildfowl.png" alt="" /></a></li>
							 <li><a href="http://www.bassfan.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/bassfan.png" alt="" /></a></li>
							 							<li><a href="http://store.intermediaoutdoors.com/"><img src="http://www.gunsandammo.com/wp-content/themes/carrington-business/imo-footer/images/imo-store.png" alt="" /></a></li>
                        </ul>
                      </div>    
                </div>
            </div>

        </div>
      </section>
      <section class="stay-connected">
        <div class="container">
          
          <div class="top">
            <h4>Stay Connected</h4>
            <ul class="connections">
              <li class="facebook"><a href="http://www.facebook.com/NAWhitetail" title="Find us on Facebook">Facebook</a></li>
              <li class="twitter"><a href="http://twitter.com/NAWhitetail" title="Follow us on Twitter">Twitter</a></li>
              <li class="news"><a href="/newsletter/">Newsletter</a></li>
              <li class="apps"><a href="/apps/">Apps</a></li>
              <li class="mags"><a href="https://secure.palmcoastd.com/pcd/eServ?iServ=MDE0OEQ0NDcyNCZpVHlwZT1FTlRFUg==">Get the Magazine</a></li>
            </ul>
          </div>
        
          <hr />
          <div class="extras">
           		Copyright &copy; <?php echo date('Y'); ?>, Intermedia Outdoors. All Rights Reserved.</div>
          	<div class="bottom">
         
            <div class="utility"> 
              <a href="http://www.imoutdoorsmedia.com/IM3/" title="">About</a>
              <a href="#">Conservation Partners</a>
              <a href="http://www.imoutdoorsmedia.com" title="">Advertise</a>
             <!-- <a href="/privacy" title="">Privacy Policy</a> &middot;-->
              <!--<a href="/terms" title="">Terms &amp; Conditions</a>-->
            </div>
          </div>

        </div>
      </section>
      
      

    
  </footer>

  <?php if (CFCT_DEBUG) : ?>
  <div style="border: 1px solid #ccc; background: #ffc; padding: 20px;">The <code>CFCT_DEBUG</code> setting is currently enabled, which shows the filepath of each included template file. To hide the file paths, edit this setting in the <?php echo CFCT_PATH; ?>functions.php file.</div>
  <?php endif; ?>

  <?php wp_footer(); ?>

  <div class="new-superpost-modal-container" style="display:none;height:200px:width:200px;background-color:white;">
    <h1>POST THIS</h1>

    <div class="media-section">
      <form id="fileUploadForm-image" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-image-form">
        <div id="fileupload" >
          <div class="fileupload-buttonbar ">
              <label class="upload-button">
                  <span >Add Photo</span>
                  <input id="image-upload" type="file" name="photo-upload" id="photo-upload" />

              </label>
          </div>
        </div>
        <input type="hidden" name="post_type" value="photo">
        <input type="hidden" name="form_id" value="fileUploadForm">
      </form>
    </div>

    <form id="fileUploadForm" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="masonry-form superpost-form">

        <input type="text" name="title" id="title" placeholder="Title"/>
        <textarea name="body" id="body" placeholder="Tell Us Your Story."></textarea>
        <input id="file" type="file" name="photo-upload" id="photo-upload" style="display:none"/>
        <input type="hidden" name="post_type" value="report">
        <input type="hidden" name="clone_target" value="superpost-box">
        <input type="hidden" name="attach_target" value="post-container">
        <input type="hidden" name="attachment_point" value="prepend">
        <input type="hidden" name="masonry" value="true">
        <input type="hidden" name="form_id" value="fileUploadForm">
        <input type="submit" value="Submit" class="submit" />
    </form>
  </div>



</body>
</html>
