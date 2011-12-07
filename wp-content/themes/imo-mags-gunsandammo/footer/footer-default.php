<?php
if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); } ?>

</section><!-- .str-container -->

  <footer id="footer">
    
      <section id="imo-network">
        <div class="str-container">
          <h4><span>Guns &amp; Ammo</span> Shooting Network</h4>
          <div id="handguns-mag" class="mag first">
            <h5>Handguns</h5>
            <ul class="recent-posts">
              <li><a href="#">Post Title</a></li>
              <li><a href="#">Post Title</a></li>
              <li><a href="#">Post Title</a></li>
            </ul>
          </div>
          <div id="handguns-mag" class="mag">
            <h5>RifleShooter</h5>
            <ul class="recent-posts">
              <li><a href="#">Post Title</a></li>
              <li><a href="#">Post Title</a></li>
              <li><a href="#">Post Title</a></li>
            </ul>
          </div>
          <div id="handguns-mag" class="mag">
            <h5>Shooting Times</h5>
            <ul class="recent-posts">
              <li><a href="#">Post Title</a></li>
              <li><a href="#">Post Title</a></li>
              <li><a href="#">Post Title</a></li>
            </ul>
          </div>
          <div id="handguns-mag" class="mag last">
            <h5>Shotgun News</h5>
            <ul class="recent-posts">
              <li><a href="#">Post Title</a></li>
              <li><a href="#">Post Title</a></li>
              <li><a href="#">Post Title</a></li>
            </ul>
          </div>
        
          <hr />
        
          <div class="extras">
            <a href="#">Watch the Sportsman TV Network</a> | <a href="#">Visit the Store</a>
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
      
      <section id="stay-connected">
        <div class="str-container">
          
          <div class="top">
            <h4>Stay Connected</h4>
            <ul class="connections">
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Newsletter</a></li>
              <li><a href="#">Apps</a></li>
              <li><a href="#">Get the Magazine</a></li>
            </ul>
          </div>
        
          <hr />
          
          <div class="bottom">
            <?php $colophon = str_replace('%Y', date('Y'), cfct_get_option('cfctbiz_legal_footer'));
            $sep = ($colophon ? ' &bull; ' : '');
            $loginout = cfct_get_loginout('', $sep);
            if ($colophon || $loginout)
              echo '<p class="copyright">'.$colophon.$loginout.'</p>'; ?>

            <ul class="utility"> 
              <li class="leaf first"><a href="http://www.imoutdoorsmedia.com/IM3/" title="">About</a></li>
              <li class=""><a href="#">Conservation Partners</a></li>
              <li class="leaf"><a href="http://www.imoutdoorsmedia.com" title="">Advertise</a></li> 
              <li class="leaf"><a href="/privacy" title="">Privacy Policy</a></li> 
              <li class="leaf last"><a href="/terms" title="">Terms &amp; Conditions</a></li> 
            </ul>
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
