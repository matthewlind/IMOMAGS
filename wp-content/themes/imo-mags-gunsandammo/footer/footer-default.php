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

</section><!-- .container -->

  <footer id="footer">
    
      <section id="imo-network">
        <div class="container">
          <h4><span class="white">Guns &amp; Ammo</span> Shooting Network <span class="tail"></span></h4>
          <div id="mag-handguns" class="mag first">
            <a class="site-link" href="http://www.handgunsmag.com/" title="Visit www.HandGunsMag.com">
              <img class="cover" src="<?php print get_stylesheet_directory_uri(); ?>/img/mags_handguns.jpg" alt />
              <h5>Handguns</h5>
            </a>
            <?php switch_to_blog(9);
            $blog = new WP_Query($args);
            if ($blog->have_posts()) :?>
            <ul class="recent-posts">
              <?php while ($blog->have_posts()) : $blog->the_post(); ?>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile ?>
            </ul>
            <?php endif; restore_current_blog(); ?>
          </div>
          <div id="mag-rifleshooter" class="mag">
            <a class="site-link" href="http://www.rifleshootermag.com/" title="Visit www.RifleShooterMag.com">
              <img class="cover" src="<?php print get_stylesheet_directory_uri(); ?>/img/mags_rifleshooter.jpg" alt />
              <h5>RifleShooter</h5>
            </a>
            <?php switch_to_blog(10);
            $blog = new WP_Query($args);
            if ($blog->have_posts()) :?>
            <ul class="recent-posts">
              <?php while ($blog->have_posts()) : $blog->the_post(); ?>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile ?>
            </ul>
            <?php endif; restore_current_blog(); ?>
          </div>
          <div id="mag-shooting-times" class="mag">
            <a class="site-link" href="http://www.shootingtimes.com/" title="Visit www.ShootingTimes.com">
              <img class="cover" src="<?php print get_stylesheet_directory_uri(); ?>/img/mags_shooting_times.jpg" alt />
              <h5> Shooting<br />Times</h5>
            </a>
            <?php switch_to_blog(11);
            $blog = new WP_Query($args);
            if ($blog->have_posts()) :?>
            <ul class="recent-posts">
              <?php while ($blog->have_posts()) : $blog->the_post(); ?>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php endwhile ?>
            </ul>
            <?php endif; restore_current_blog(); ?>
          </div>
          <div id="mag-shotgun-news" class="mag last">
            <a class="site-link" href="http://www.shotgunnews.com/" title="Visit www.ShotgunNews.com">
              <img class="cover" src="<?php print get_stylesheet_directory_uri(); ?>/img/mags_shotgun_news.jpg" alt />
              <h5>Shotgun<br />News</h5>
            </a>
            <?php switch_to_blog(12);
            $blog = new WP_Query($args);
            if ($blog->have_posts()) :?>
            <ul class="recent-posts">
              <?php while ($blog->have_posts()) : $blog->the_post(); ?>
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
 				animation:1000});	
			
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
							<li><a href="http://www.sportsmenvote.com/"><img src="/wp-content/themes/imo-mags-gunsandammo/img/imo_logos/new/sp-logo-sm.png" alt="" /></a></li>
							
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
              <li><a href="http://www.facebook.com/GunsAndAmmoMag" title="Find us on Facebook">Facebook</a></li>
              <li><a href="http://twitter.com/gunsandammomag" title="Follow us on Twitter">Twitter</a></li>
              <!--<li><a href="/newsletter/">Newsletter</a></li>-->
              <li><a href="/apps/">Apps</a></li>
              <li><a href="https://secure.palmcoastd.com/pcd/eSv?iMagId=0145V&i4Ky=IBZN">Get the Magazine</a></li>
            </ul>
          </div>
        
          <hr />
          <div class="extras">
            <a href="http://www.thesportsmanchannel.com/">Watch the Sportsman TV Network</a> | <a href="https://store.intermediaoutdoors.com/brands.php?brand=GUNSANDAMMO">Visit the Store</a>
          </div>
          <div class="bottom">
          

            <?php $colophon = str_replace('%Y', date('Y'), cfct_get_option('cfctbiz_legal_footer'));
            $sep = ($colophon ? ' &bull; ' : '');
            ?>
			
            <div class="utility"> 
              <a href="http://www.imoutdoorsmedia.com/IM3/" title="">About</a> &middot;
              <!--<a href="#">Conservation Partners</a> &middot;-->
              <a href="http://www.imoutdoorsmedia.com" title="">Advertise</a> &middot;
             <a href="http://www.imoutdoorsmedia.com/IM3/privacy.php" title="">Privacy Policy</a> &middot;
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

</body>
</html>
