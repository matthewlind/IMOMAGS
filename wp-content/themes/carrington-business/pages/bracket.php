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
	
get_header();

the_post();
$pollNum = 1;
?>
<header>
	<ul id="ga-madness-nav">
		<li><a href="/bracket">Gun Bracket</a></li>
		<li><a href="/bracket/enter">Enter Now</a></li>
		<li style="width:270px;"></li>
		<li><a href="/bracket/prizes">Prizes & Rules</a></li>
		<li><a class="how-works">How it Works</a></li>
	</ul>
	<div class="ga-madness-nav-logo"></div>
	<!--<div class="bracket-header"></div>-->
	<h1 style="margin-left:-99999px;height:0;"><?php the_title(); ?></h1>
</header><!-- #masthead -->
<div class="col-abc">
	<div <?php post_class('entry entry-full clearfix'); ?>>
		<div class="entry-content">
			<?php			
			the_content(__('Continued&hellip;', 'carrington-business'));
			wp_link_pages();
			?>
			<div id="content-wrapper">
				  <div id="table">
				
				<!-- Table Dates -->
				    <table class="gridtable">
				      <tr>
				        <th class="round_1 current"> 1st ROUND </th>
				        <th class="round_2 "> 2nd ROUND </th>
				        <th class="round_3"> SWEET 16 </th>
				        <th class="round_4"> ELITE EIGHT </th>
				        <th class="round5"> FINAL FOUR </th>
				        <th class="round_6"> CHAMPION </th>
				        <th class="round_5"> FINAL FOUR </th>
				        <th class="round_4"> ELITE EIGHT </th>
				        <th class="round_3"> SWEET 16 </th>
				        <th class="round_2"> 2nd ROUND </th>
				        <th class="round_1 current"> 1st ROUND </th>
				      </tr>
				      <tr>
				        <td class="current"> March 21-24 </td>
				        <td> March 25-27 </td>
				        <td> March 28-31 </td>
				        <td> April 1-3 </td>
				        <td> April 4-7 </td>
				        <td> April 8-9 </td>
				        <td> April 4-7 </td>
				        <td> April 1-3 </td>
				        <td> March 28-31 </td>
				        <td> March 25-27 </td>
				        <td class="current"> March 21-24 </td>
				      </tr>
				    </table>
				  </div>
				
				<!-- Bracket -->
				  <div id="bracket">
				    <div id="round1" class="round">
				      <h3>
				        Round One (2012 NCAA Men's Basketball Tournament) 
				      </h3>
				
				<!-- start region1 -->
				      <div class="region region1">
				        <h4 class="region1 first_region">
				         Handguns
				        </h4>
				        <div class="bracket-sponsor galco">Presented by:<br /><a href="http://www.usgalco.com/default.asp" target="_blank"><img src="/wp-content/themes/imo-mags-gunsandammo/img/galco-bracket-logo.png" alt="Galco" /></a></div>
				        <div id="match18" class="open-poll match m1" poll="smith-wesson-mp-shield-vs-beretta-nano" pollNum="<?php echo $pollNum; ?>">
				          <p class="slot slot1"><!--<strike>--><span class="seed">1</span>S&W M&P Shield<!--</strike>--></p>
				          <p class="slot slot2"><!--<strong>--><span class="seed">16</span>Beretta Nano<!--</strong>--></p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match18 -->
				        <div id="match19" class="open-poll match m2" poll="kimber-solo-9mm-vs-kahr-p380" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1"><span class="seed">8</span>Kimber Solo 9mm </p>
				          <p class="slot slot2"><span class="seed">9</span>Kahr P380</p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match19 -->
				        <div id="match20" class="open-poll match m3" poll="sw-performance-center-1911-vs-taurus-raging-judge-magnum" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1"><span class="seed">5</span>S&W Perform...</p>
				          <p class="slot slot2"><span class="seed">12</span>Taurus Raging...</p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match20 -->
				        <div id="match21" class="open-poll match m4" poll="springfield-xds-vs-colt-mustang-pocketlite" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1"><span class="seed">4</span>Springfield XDs</p>
				          <p class="slot slot2"><span class="seed">13</span>Colt Mustang...</p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match21 -->
				        <div id="match22" class="open-poll match m5" poll="ruger-sr22-vs-remington-r1-carry" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1"><span class="seed">6</span>Ruger SR22</p>
				          <p class="slot slot2"><span class="seed">11</span>Remington R1...</p>
				          <a class="vote">Vote</a>
				        </div>
				        <div id="match23" class="open-poll match m6" poll="cz-p-09-duty-vs-taurus-millenium-g2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1"><span class="seed">3</span>CZ P-09 Duty</p>
				          <p class="slot slot2"><span class="seed">14</span>Taurus Millen... </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match23 -->
				        <div id="match24" class="open-poll match m7" poll="walther-ppq-vs-sig-p938" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1"><span class="seed">7</span>Walther PPQ</p>
				          <p class="slot slot2"><span class="seed">10</span>Sig P938</p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match24 -->
				        <div id="match25" class="match m8 open-poll" poll="glock-17-gen4-vs-ruger-single-nine" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1"><span class="seed">2</span>Glock 17 Gen4</p>
				          <p class="slot slot2"><span class="seed">15</span>Ruger Single-9</p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match25 -->
				      </div>
				<!-- /.region1 -->
				<!-- start region2 -->
				      <div class="region region2">
				        <h4 class="region2 first_region">
				          Rifles
				        </h4>
				        <div id="match26" class="match m1 open-poll" poll="ruger-gunsite-scout-rifle-vs-savage-hog-hunter-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">1</span>Ruger Gunsite...
				          </p>
				          <p class="slot slot2">
				            <span class="seed">16</span>Savage Hog...
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match26 -->
				        <div id="match27" class="match m2 open-poll" poll="tc-dimension-vs-savage-model-25-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">8</span> T/C Dimension 
				          </p>
				          <p class="slot slot2">
				            <span class="seed">9</span>  Savage Model...
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- #/match27 -->
				        <div id="match28" class="match m3 open-poll" poll="browning-x-bolt-composite-stalker-vs-mossberg-mvp-7-62-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">5</span> Browning X-Bo...
				          </p>
				          <p class="slot slot2">
				            <span class="seed">12</span> Mossberg MVP...
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- #/match28 -->
				        <div id="match29" class="match m4 open-poll" poll="kimber-84m-mountain-ascent-vs-475-turnbull-lever-gun-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">4</span> Kimber 84M...
				          </p>
				          <p class="slot slot2">
				            <span class="seed">13</span> .475 Turnbull...
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- #/match29 -->
				        <div id="match30" class="match m5 open-poll" poll="cz-455-varmint-evolution-vs-magnum-research-mlr22" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">6</span> CZ 455 Varm...
				          </p>
				          <p class="slot slot2">
				            <span class="seed">11</span> Magnum Re... 
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match30 -->
				        <div id="match31" class="match m6 open-poll" poll="nosler-model-48-trophy-grade-vs-remington-model-783-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">3</span> Nosler Model...
				          </p>
				          <p class="slot slot2">
				            <span class="seed">14</span> Remington M... 
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!--/#match31-->
				        <div id="match32" class="match m7 open-poll" poll="ruger-1022-takedown-vs-apa-zombie-sniper-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">7</span> Ruger 10/22...
				          </p>
				          <p class="slot slot2">
				            <span class="seed">10</span> APA Zombie...   
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!--/#match32-->
				        <div id="match33" class="match m8 open-poll" poll="sako-trg-m10-vs-weatherby-vanguard-series-2-synthetic" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">2</span> Sako TRG M10 </p>
				          <p class="slot slot2">
				            <span class="seed">15</span> Weatherby Va...
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match33 -->
				      </div>
				<!-- /.region2 -->
				<!-- start region3 -->
				      <div class="region region3">
				        <h4 class="region3 first_region">
				          Shotguns
				        </h4>
				        <div class="bracket-sponsor wardog">Presented by:<br /><a href="http://www.wardogsafe.com/" target="_blank"><img src="/wp-content/themes/imo-mags-gunsandammo/img/wardog-logo.jpg" alt="Wardog" /></a></div>
				       <div id="match26" class="match m1 open-poll" poll="kel-tec-ksg-vs-wilson-combat-scattergun-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">1</span>Kel-Tec KSG
				          </p>
				          <p class="slot slot2">
				            <span class="seed">16</span>Wilson Comb... 
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match26 -->
				        <div id="match27" class="match m2 open-poll" poll="fnh-slp-mark-i-vs-remington-versa-max-sportsman-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">8</span> FNH SLP Mark I
				          </p>
				          <p class="slot slot2">
				            <span class="seed">9</span> Remington Ver...
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- #/match27 -->
				        <div id="match28" class="match m3 open-poll" poll="browning-a5-vs-mossberg-flex-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">5</span> Browning A5 
				          </p>
				          <p class="slot slot2">
				            <span class="seed">12</span> Mossberg Flex 
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- #/match28 -->
				        <div id="match29" class="match m4 open-poll" poll="benelli-legacy-28-vs-beretta-tx4-storm" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">4</span> Benelli Legacy...
				          </p>
				          <p class="slot slot2">
				            <span class="seed">13</span> Beretta TX4...   
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- #/match29 -->
				        <div id="match30" class="match m5 open-poll" poll="franchi-affinity-vs-ruger-red-label-20-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">6</span> Franchi Affinity 
				          </p>
				          <p class="slot slot2">
				            <span class="seed">11</span> Ruger Red...  
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match30 -->
				        <div id="match31" class="match m6 open-poll" poll="saiga-12-vs-weatherby-pa-08-tr-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">3</span> Saiga 12  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">14</span> Weatherby... 
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!--/#match31-->
				        <div id="match32" class="match m7 open-poll" poll="beretta-dt-11-vs-mossberg-maverick-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">7</span> Beretta DT-11
				          </p>
				          <p class="slot slot2">
				            <span class="seed">10</span> Mossberg Mav...    
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!--/#match32-->
				        <div id="match33" class="match m8 open-poll" poll="remington-m887-nitromag-vs-cz-coach-gun" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">2</span> Remington M8...
				          </p>
				          <p class="slot slot2">
				            <span class="seed">15</span> CZ Coach Gun 
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match9 -->
				      </div>
				<!-- /.region3 -->
				<!-- start region4 -->
				      <div class="region region4">
				        <h4 class="region4 first_region">
				          AR-15s 
				        </h4>
				        <div class="bracket-sponsor slidefire">Presented by:<br /><a href="http://www.slidefire.com/" target="_blank"><img src="/wp-content/themes/imo-mags-gunsandammo/img/slidefire-logo.jpg" alt="Slide Fire" /></a></div>
				        
				         <div id="match17" class="match m8 open-poll" poll="wilson-combat-recon-tactical-vs-dpms-300-aac-blackout-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">2</span> Wilson Combat...
				          </p>
				          <p class="slot slot2">
				            <span class="seed">15</span> DPMS 300-A...   
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				        
				        <div id="match10" class="match m1 open-poll" poll="spikes-tactical-compressor-sbr-300-blk-vs-mossberg-mmr-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">1</span> Spike's Tact...
				          </p>
				          <p class="slot slot2">
				            <span class="seed">16</span> Mossberg MMR  
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match10 -->
				        <div id="match11" class="match m2 open-poll" poll="colt-le901-16s-vs-nosler-varmageddon-ar-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">8</span> Colt LE901...
				          </p>
				          <p class="slot slot2">
				            <span class="seed">9</span> Nosler Varma... 
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match11 -->
				        <div id="match12" class="match m3 open-poll" poll="lwrci-repr-vs-bravo-company-m4a1-eag-tactical" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">5</span> LWRCI REPR 
				          </p>
				          <p class="slot slot2">
				            <span class="seed">12</span> Bravo Comp...  
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match12 -->
				        <div id="match13" class="match m4 open-poll" poll="larue-tactical-costa-edition-hybrid-vs-stag-arms-3g-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">4</span> LaRue Tactical... 
				          </p>
				          <p class="slot slot2">
				            <span class="seed">13</span> Stag Arms 3G  
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match13 -->
				        <div id="match14" class="match m5 open-poll" poll="daniel-defense-ddm4-300-sbr-vs-rock-river-arms-lar-47-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">6</span> Daniel Defense...  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">11</span> Rock River...  
				          </p>
				          <a class="vote">Vote</a>
				        </div>
				
				<!-- /#match14 -->
				        <div id="match15" class="match m6 open-poll" poll="smith-wesson-mp15-300-whisper-vs-remington-r-25-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">3</span> S&W M&P15...  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">14</span> Remington R-25 
				          </p>
				          <a class="vote">Vote</a>
				        </div>
			   <!-- /#match15 -->
				        <div id="match16" class="match m7 open-poll" poll="alexander-arms-gsr-vs-sig-sauer-m400-2" pollNum="<?php echo $pollNum = $pollNum + 1; ?>">
				          <p class="slot slot1">
				            <span class="seed">7</span> Alexander Arms...  
				          </p>
				          <p class="slot slot2">
				            <span class="seed">10</span> SIG Sauer M4...  
				          </p>
				          <a class="vote">Vote</a>
				        </div>


				      </div>
				<!-- /.region4 -->
				    </div>
				<!-- /#round1 -->
				    <div id="round2" class="round">
				      <h3>
				        Round Two (2010 NCAA Men's Basketball Tournament) 
				      </h3>
				      <div class="region region1">
				        <h4 class="region1">
				          MIDWEST 
				        </h4>
				        <div id="match41" class="match m1">
				          <p rel="match18" class="slot slot1">
				          
				          </p>
				          <p rel="match19" class="slot slot2">
				           
				          </p>
				        </div>
				
				<!-- /#match41 -->
				        <div id="match42" class="match m2">
				          <p rel="match20" class="slot slot1">
				          </p>
				          <p rel="match21" class="slot slot2">
				          </p>
				        </div>
				<!-- /#match42 -->
				        <div id="match43" class="match m3">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!-- /#match43 -->
				        <div id="match44" class="match m4">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!-- /#match44 -->
				      </div>
				<!-- /.region1 -->
				      <div class="region region2">
				        <h4 class="region2">
				          WEST 
				        </h4>
				        <div id="match45" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				        <div id="match46" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!-- /#match46 -->
				        <div id="match47" class="match m3">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				        <div id="match48" class="match m4">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!-- /#match48 -->
				      </div>
				      <div class="region region3">
				        <h4 class="region3">
				          East 
				        </h4>
				        <div id="match3" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!--/match3-->
				        <div id="match34" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!-- #/match34 -->
				        <div id="match35" class="match m3">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!-- #/match35 -->
				        <div id="match36" class="match m4">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!-- #/match36 -->
				      </div>
				<!--/.region3-->
				      <div class="region region4">
				        <h4 class="region4">
				          South 
				        </h4>
				        <div id="match37" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!--/#match37-->
				        <div id="match38" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!--/#match38-->
				        <div id="match39" class="match m3">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!--/#match39-->
				        <div id="match40" class="match m4">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!--/#match40-->
				      </div>
				<!--/.region4-->
				    </div>
				    <div id="round3" class="round">
				      <h3>
				        Round Three (2010 NCAA Men's Basketball Tournament) 
				      </h3>
				      <div class="region region1">
				        <h4 class="region1">
				          Midwest 
				        </h4>
				        <div id="match53" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				        <div id="match54" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				      </div>
				
				<!-- /.region1 -->
				      <div class="region region2">
				        <h4 class="region2">
				          West 
				        </h4>
				        <div id="match55" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				        <div id="match56" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!--/#match56-->
				      </div>
				      <div class="region region3">
				        <h4 class="region3">
				          East 
				        </h4>
				        <div id="match49" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!--/#match49-->
				        <div id="match50" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!--/#match50-->
				      </div>
				<!-- /.region3 -->
				      <div class="region region4">
				        <h4 class="region4">
				          South 
				        </h4>
				        <div id="match51" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!--/#match51-->
				        <div id="match52" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				<!--/#match52-->
				      </div>
				<!-- /.region4 -->
				    </div>
				    <div id="round4" class="round">
				      <h3>
				        Round Four (2010 NCAA Men's Basketball Tournament) 
				      </h3>
				      <div class="region region1">
				        <h4 class="region1">
				          Midwest 
				        </h4>
				        <div id="match60" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!-- /#match60 -->
				      </div>
				<!-- /.region1 -->
				      <div class="region region2">
				        <h4 class="region2">
				          West 
				        </h4>
				        <div id="match61" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!-- /#match61 -->
				      </div>
				<!-- /.region2 -->
				      <div class="region region3">
				        <h4 class="region3">
				          East 
				        </h4>
				        <div id="match58" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!-- /#match58 -->
				      </div>
				<!--/.region3-->
				      <div class="region region4">
				        <h4 class="region4">
				          South 
				        </h4>
				        <div id="match59" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				
				<!--/#match59-->
				      </div>
				<!--/#match59-->
				    </div>
				    <div id="round5" class="round">
				      <h3>
				        Round Five (2010 NCAA Men's Basketball Tournament) 
				      </h3>
				      <div class="region">
				        <div id="match63" class="match m1">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				        <div id="match62" class="match m2">
				          <p class="slot slot1">
				          </p>
				          <p class="slot slot2">
				          </p>
				        </div>
				      </div>
				    </div>
				    <div id="round6" class="round">
				      <h3>
				        Round Six (2010 NCAA Men's Basketball Tournament) 
				      </h3>
				      <div class="bracket-sponsor ffl123">Final Four Presented by:<a href="http://ffl123.com" target="_blank"><img src="/wp-content/themes/imo-mags-gunsandammo/img/ffl123-logo.jpg" alt="FFL123" /></a></div>
				      <div class="region">
				        <div id="match64" class="match m1">
				          <p class="slot slot1" id="slot127">
				            <strong><!--<span class="seed">0</span>--> Winner <!--<em class="score">65</em></strong>-->
				<!-- winner -->
				          </p>
				          <p class="slot slot2" id="slot128">
				            <!--<strike><span class="seed">4</span>--> Loser <!--<em class="score">60</em></strike>-->
				<!-- loser -->
				          </p>
				        </div>
				      </div>
				    </div>
				  </div>
				</div>
		</div>
	</div><!-- .entry -->
</div><!-- .col-abc -->

<div class="page-template-page-right-php">
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<script type="text/javascript">
	              document.write(unescape('%3Cscript src="http://ad.doubleclick.net/adj/imo.'+dartadsgen_site+'/;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile='+pr_tile+';ord='+dartadsgen_rand+'?"%3E%3C/script%3E'));
	            </script>
	            <script type="text/javascript">
	              ++pr_tile;
	            </script>
	            <noscript>
	              <a href="http://ad.doubleclick.net/adj/imo.outdoorsbest/;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?">
	                <img src="http://ad.doubleclick.net/ad/imo.outdoorsbest/home;sect=;page=index;pos=btf;subs=;sz=300x250;dcopt=;tile=1;ord=7391727509?" border="0" />
	              </a>
	            </noscript>

			<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('scroll-sidebar')) : else : endif; ?>
		</div>
	</div>

	<div class="col-abc ga-madness-comments">
		<?php comments_template(); ?>
	</div><!-- .col-abc -->
</div><!-- .page-template-page-right-php-->

<div id="bracket-modal" class="new-superpost-modal-container new-superpost-box" style="display:none;width:740px;height:557px;background-color:white;">
	<div class="ga-madness-logo"></div>
	<div class="poll-area"></div>
	<div class="extra-poll-content" style="display:none;">
		<div class="vote-thumb" style="display:none;"></div>
		<div class="vs">vs.</div>
	</div>
	<div class="poll-pagination" style="display:none;">
			<a class="prev-poll">Previous Matchup</a>
			<a class="next-poll">Next Matchup</a>
		</div>
	<div id="Gen" class="marginLeft">
		<div class="block" id="rotate_01"></div>
		<div class="block" id="rotate_02"></div>
		<div class="block" id="rotate_03"></div>
		<div class="block" id="rotate_04"></div>
		<div class="block" id="rotate_05"></div>
		<div class="block" id="rotate_06"></div>
		<div class="block" id="rotate_07"></div>
		<div class="block" id="rotate_08"></div>
		<div class="clearfix"></div>
		<p>Loading...</p>
	</div>
	
</div>

<?php get_footer(); ?>