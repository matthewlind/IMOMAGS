<?php

/**
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * **********************************************************************
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }
?>
<div class="cfct-row cfct-row-abc" style="clear:both"> 
</div>

        </div><!-- .str-content -->
    </div><!-- #main-content -->
</section><!-- .str-container -->
<hr class="accessibility" />
<footer id="footer">
    <div class="str-container">
        <div id="footer-content">
            
        </div><!-- #footer-content -->
        <div id="footer-sub">
            <nav class="nav nav-footer">
                <h3 class="site-title"><a href="<?php echo home_url('/') ?>" title="<?php _e('Home', 'carrington-business') ?>"><?php bloginfo('name') ?></a></h3>
<?php
wp_nav_menu(array( 
    'theme_location' => 'footer',
    'container' => false,
    'depth' => 1,
));
?>
            </nav><!--/nav-footer-->
<?php
if (cfct_get_option('cfct_credit') == 'yes') { ?>
    <p id="site-generator"><?php
    printf(__('Powered by <a href="%s">WordPress</a>. <a href="%s" title="Carrington Business theme for WordPress">Carrington Business</a> by <a id="cf-logo" title="Custom Web Applications and WordPress Development" href="%s">Crowd Favorite</a>', 'carrington-business'), 'http://wordpress.org/', 'http://crowdfavorite.com/wordpress/themes/carrington-business/', 'http://crowdfavorite.com/');
?></p>
<?php 
}

$colophon = str_replace('%Y', date('Y'), cfct_get_option('cfctbiz_legal_footer'));
$sep = ($colophon ? ' &bull; ' : '');
$loginout = cfct_get_loginout('', $sep);
if ($colophon || $loginout) {
    echo '<p>'.$colophon.$loginout.'</p>';
}
?>
        </div><!-- #footer-sub -->
    </div><!-- .str-container -->
</footer><!-- #footer -->

<?php
if (CFCT_DEBUG) {
?>
<div style="border: 1px solid #ccc; background: #ffc; padding: 20px;">The <code>CFCT_DEBUG</code> setting is currently enabled, which shows the filepath of each included template file. To hide the file paths, edit this setting in the <?php echo CFCT_PATH; ?>functions.php file.</div>
<?php
}

wp_footer();
?>

<div id="footer-section"> 
    <div id='footer-universal-outer'> 
        <div id='footer-universal' class='footer-row'> 
                <div class='footer-col-wrapper'> 
                    <div class='section'> 

                        <ul id='hunt' class='footer-menu'> 

                            <li class="first"><a class="bowhunting" href="http://www.bowhuntingmag.com">Petersen's Bowhunting</a></li> 
                            <li><a class="northamericanwhitetail" href="http://www.northamericanwhitetail.com">North American Whitetail</a></li> 
                            <li><a class="gundog" href="http://www.gundogmag.com">Gun Dog</a></li> 
                            <li><a class="wildfowl" href="http://www.wildfowlmag.com">Wildfowl</a></li> 
                            <li><a class="bowhunter" href="http://www.bowhunter.com">Bowhunter</a></li> 
                            <li class="last"><a class="petersenshunting" href="http://www.petersenshunting.com">Petersen's Hunting</a></li> 




                        </ul> 
                    </div> 
                </div> 
                <div class='footer-col-wrapper'> 
                    <div class='section'> 

                        <ul id='shoot' class='footer-menu'> 
                            <li  class="first"><a class='handguns' href="http://www.handgunsmag.com">Handguns</a></li> 
                            <li><a class='rifleshooter' href="http://www.rifleshootermag.com">Rifleshooter</a></li> 
                            <li><a class='shootingtimes' href="http://www.shootingtimes.com">Shooting Times</a></li> 
                            <li><a class='shotgunnews' href="http://www.shotgunnews.com">Shotgun News</a></li> 


                            <li class="last"><a class='gunsandammo' href="http://www.gunsandammo.com">Guns &amp; Ammo</a></li> 
   
                        </ul> 
                    </div> 
                </div> 
                <div class='footer-col-wrapper'> 
                    <div class='section'> 

                        <ul id='fish' class='footer-menu'> 
                            <li class="first"><a class="infisherman" href="http://www.in-fisherman.com">In-Fisherman</a></li> 
                            <li><a class="flyfish" href="http://www.flyfisherman.com">Fly Fisherman</a></li> 
                            <li><a class="floridasportsman" href="http://www.floridasportsman.com">Florida Sportsman</a></li> 

                            <li class="last"><a class="bassfan" href="http://www.bassfan.com">BassFan</a></li> 
                        </ul> 
                    </div> 
                </div> 

                <div class='footer-col-wrapper r-col statebystate'> 
                    <div class='section'> 
                        <ul id='more' class='footer-menu'> 
                        	<li class="first"><a class="sv" href="http://www.sportsmenvote.com">SportsmenVote</a></li> 
                            <li><a class="gameandfish" href="http://www.gameandfishmag.com">Game &amp; Fish</a></li> 
                            <li class=""><a class="sportsmanchannel" href="http://www.thesportsmanchannel.com">The Sportsman Channel</a></li> 
                            <li class="last"><a class="imostore" href="http://store.intermediaoutdoors.com">The IMO Store</a></li> 
                        </ul> 



                    </div> 
                </div> 

                <div style='clear: both;'></div> 
            </div> 
    </div> 
    <div id="block-menu-menu-footer-links" class="block block-menu region-even odd region-count-2 count-19"> 
  <div class="content"> 
    <ul class="menu"> 
      <li class="leaf first"><a href="http://www.imoutdoorsmedia.com/IM3/" title="">About</a></li>
      <li class="leaf"><a href="http://www.imoutdoorsmedia.com" title="">Advertise</a></li> 
      <li class="leaf"><a href="/contact" title="Send us an e-mail">Contact</a></li>
      <!--<li class="leaf"><a href="http://www.intermediaoutdoors.com/jobs/" title="">Jobs</a></li> --> 
      <!--<li class="leaf"><a href="/privacy" title="">Privacy</a></li> --> 
      <!--<li class="leaf last"><a href="/terms" title="">Terms of Use</a></li> --> 
    </ul> 
  </div> 
  </div> <!-- /.block -->   

<div id="block-gunsandammo_blocks-conservation_links" class="block block-gunsandammo_blocks region-odd even region-count-3 count-20"> 
  <div class="content">     
    <div id='conservation-links'> <a id='conservation-link' href="">Conservation Partners</a> 
        <div id='conservation-lists'> 
            <h3>Conservation Partners</h3> 
            <ul> 
                <li class="first"><a class="" target="_blank" href="http://www.boone-crockett.org/">Boone &amp; Crockett</a></li> 
                <li><a class="" target="_blank" href="http://www.nationalforests.org/">National Forest Foundation</a></li> 
                <li><a class="" target="_blank" href="http://www.sportsmenslink.org/">Congressional Sportsman Foundation</a></li> 
                <li><a class="" target="_blank" href="http://www.tu.org/">Trouts Unlimited</a></li> 
                <li><a class="" target="_blank" href="http://www.rmef.org/">Rocky Mountain Elk Foundation</a></li> 
                <li><a class="" target="_blank" href="http://www.trcp.org/">TRCP</a></li> 
                <li><a class="" target="_blank" href="http://www.joincca.org/">Costal Conservation Association</a></li> 
                <li><a class="" target="_blank" href="http://www.asafishing.org/">American Sportfishing Association</a></li> 
                <li><a class="" target="_blank" href="http://www.nwtf.org/">NWTF</a></li> 
                <li><a class="" target="_blank" href="http://www.deltawaterfowl.org/">Delta Waterfowl</a></li> 
                <li><a class="" target="_blank" href="http://www.riverscoalition.org/">The Rivers Coalition</a></li> 
                <li class='last'><a class="" target="_blank" href="http://www.floridaoceanographic.org/">Florida Oceanographic Society</a></li> 
            </ul> 
            <ul> 
                <li><a class="" target="_blank" href="http://www.snookfoundation.org/">The Snook Foundation</a></li> 
                <li><a class="" target="_blank" href="http://www.joinrfa.org/">Recreational Fishing Alliance</a></li> 
                <li><a class="" target="_blank" href="http://www.thefra.org/">Fishing Rights Alliance</a></li> 
                <li><a class="" target="_blank" href="http://www.fwfonline.org/Index.htm">Florida Wildlife Federatio</a></li> 
                <li><a class="" target="_blank" href="http://www.igfa.org/">International Game Fish Association</a></li> 
                <li><a class="" target="_blank" href="http://www.billfish.org/new/index.asp">International Billfish Foundation</a></li> 
                <li><a class="" target="_blank" href="http://www.qdma.com/">Quality Deer Management</a></li> 
                <li><a class="" target="_blank" href="http://www.ducksunlimited.org/">Ducks Unlimited</a></li> 
                <li><a class="" target="_blank" href="http://www.quailforever.org/">Quail Forever</a></li> 
                <li><a class="" target="_blank" href="http://fl.audubon.org/index.html">Florida Audubon Society</a></li> 
                <li><a class="" target="_blank" href="http://www.riverkeepers.org/">The Riverkeepers</a></li> 
                <li class='last'><a class="" target="_blank" href="http://www.nssf.org/">NSSF</a></li> 
            </ul> 
        </div> 
    </div> 
    <div style='clear: both;'></div> 
</div> 
</div> 
    <div id='footer-imo' class='footer-row'> 
            <div id='clearfix' class='section clearfix'> 

                <div id='footer-copyright'><img src='/imologo.png'/>&copy; <?php echo date('Y'); ?> InterMedia Outdoors</div> 

                <div id='footer-partners'><img src='/footer-partners.jpg'></div> 
            </div> 
    </div> 
</div> 

</body>
</html>
