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
        
          <hr />
        
          <div class="extras">
            <a href="http://www.thesportsmanchannel/">Watch the Sportsman TV Network</a> | <a href="#">Visit the Store</a>
            <form>
              <label>Other IMO Magazines</label>
              <select>
                <option>Game &amp; Fish</option>
                <option>Handguns</option>
                <option>In-Fisherman</option>
              </select>
            </form>
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
              <li><a href="/newsletter/">Newsletter</a></li>
              <li><a href="/apps/">Apps</a></li>
              <li><a href="https://secure.palmcoastd.com/pcd/eSv?iMagId=0145V&i4Ky=IBZN">Get the Magazine</a></li>
            </ul>
          </div>
        
          <hr />
          
          <div class="bottom">
            <?php $colophon = str_replace('%Y', date('Y'), cfct_get_option('cfctbiz_legal_footer'));
            $sep = ($colophon ? ' &bull; ' : '');
            $loginout = cfct_get_loginout('', $sep);
            if ($colophon || $loginout)
              echo '<p class="copyright">'.$colophon.$loginout.'</p>'; ?>

            <div class="utility"> 
              <a href="http://www.imoutdoorsmedia.com/IM3/" title="">About</a> &middot;
              <a href="#">Conservation Partners</a> &middot;
              <a href="http://www.imoutdoorsmedia.com" title="">Advertise</a> &middot;
              <a href="/privacy" title="">Privacy Policy</a> &middot;
              <a href="/terms" title="">Terms &amp; Conditions</a>
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
