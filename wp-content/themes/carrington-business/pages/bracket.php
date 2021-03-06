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
				<?php if (function_exists('imo_add_this')) {imo_add_this();} ?>
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
				        <div id="match18" class="match m1">
				          <p class="slot slot1"><strong><span class="seed">1</span>S&W M&P Shield</strong></p>
				          <p class="slot slot2"><strike><span class="seed">16</span>Beretta Nano</strike></p>
				        </div>
				
				<!-- /#match18 -->
				        <div id="match19" class="match m2">
				          <p class="slot slot1"><strong><span class="seed">8</span>Kimber Solo 9mm</strong></p>
				          <p class="slot slot2"><strike><span class="seed">9</span>Kahr P380</strike></p>
				          
				        </div>
				
				<!-- /#match19 -->
				        <div id="match20" class="match m3">
				          <p class="slot slot1"><strong><span class="seed">5</span>S&W Perform...</strong></p>
				          <p class="slot slot2"><strike><span class="seed">12</span>Taurus Raging...</strike></p>
				          
				        </div>
				
				<!-- /#match20 -->
				        <div id="match21" class="match m4">
				          <p class="slot slot1"><strong><span class="seed">4</span>Springfield XD-S</strong></p>
				          <p class="slot slot2"><strike><span class="seed">13</span>Colt Mustang...</strike></p>
				          
				        </div>
				
				<!-- /#match21 -->
				        <div id="match22" class="match m5">
				          <p class="slot slot1"><strike><span class="seed">6</span>Ruger SR22</strike></p>
				          <p class="slot slot2"><strong><span class="seed">11</span>Remington R1...</strong></p>
				          
				        </div>
				        <div id="match23" class="match m6">
				          <p class="slot slot1"><strong><span class="seed">3</span>CZ P-09 Duty</strong></p>
				          <p class="slot slot2"><strike><span class="seed">14</span>Taurus Millen...</strike></p>
				          
				        </div>
				
				<!-- /#match23 -->
				        <div id="match24" class="match m7">
				          <p class="slot slot1"><strike><span class="seed">7</span>Walther PPQ</strike></p>
				          <p class="slot slot2"><strong><span class="seed">10</span>SIG P938</strong></p>
				          
				        </div>
				
				<!-- /#match24 -->
				        <div id="match25" class="match m8">
				          <p class="slot slot1"><strong><span class="seed">2</span>Glock 17 Gen4</strong></p>
				          <p class="slot slot2"><strike><span class="seed">15</span>Ruger Single-9</strike></p>
				          
				        </div>
				
				<!-- /#match25 -->
				      </div>
				<!-- /.region1 -->
				<!-- start region2 -->
				      <div class="region region2">
				        <h4 class="region2 first_region">
				          Rifles
				        </h4>
				        <div class="bracket-sponsor zeiss">Presented by:<br /><a href="http://sportsoptics.zeiss.com/hunting/en_us/riflescopes/conquest/conquest-hd5.html" target="_blank"><img src="/wp-content/themes/imo-mags-gunsandammo/img/zeiss-logo.jpg" alt="Zeiss" /></a></div>
				        <div id="match26" class="match m1">
				          <p class="slot slot1">
				            <strong><span class="seed">1</span>Ruger Gunsite...</strong>
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">16</span>Savage Hog...</strike>
				          </p>
				          
				        </div>
				
				<!-- /#match26 -->
				        <div id="match27" class="match m2">
				          <p class="slot slot1">
				            <strong><span class="seed">8</span> T/C Dimension</strong> 
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">9</span>  Savage Model...</strike>
				          </p>
				          
				        </div>
				
				<!-- #/match27 -->
				        <div id="match28" class="match m3">
				          <p class="slot slot1">
				            <strong><span class="seed">5</span> Browning X-Bo...</strong>
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">12</span> Mossberg MVP...</strike>
				          </p>
				          
				        </div>
				
				<!-- #/match28 -->
				        <div id="match29" class="match m4">
				          <p class="slot slot1">
				            <strong><span class="seed">4</span> Kimber 84M...</strong>
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">13</span> .475 Turnbull...</strike>
				          </p>
				          
				        </div>
				
				<!-- #/match29 -->
				        <div id="match30" class="match m5">
				          <p class="slot slot1">
				            <strong><span class="seed">6</span> CZ 455 Varm...</strong>
				          </p>
				          <p class="slot slot2">
				           <strike><span class="seed">11</span> Magnum Re...</strike>
				          </p>
				          
				        </div>
				
				<!-- /#match30 -->
				        <div id="match31" class="match m6">
				          <p class="slot slot1">
				            <strong><span class="seed">3</span> Nosler Model...</strong>
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">14</span> Remington M...</strike>
				          </p>
				          
				        </div>
				
				<!--/#match31-->
				        <div id="match32" class="match m7">
				          <p class="slot slot1">
				            <strong><span class="seed">7</span> Ruger 10/22...</strong>
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">10</span> APA Zombie...</strike>  
				          </p>
				          
				        </div>
				
				<!--/#match32-->
				        <div id="match33" class="match m8">
				          <p class="slot slot1">
				            <strong><span class="seed">2</span> Sako TRG M10</strong></p>
				          <p class="slot slot2">
				            <strike><span class="seed">15</span> Weatherby Va...</strike>
				          </p>
				          
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
				       <div id="match26" class="match m1">
				          <p class="slot slot1">
				            <strong><span class="seed">1</span>Kel-Tec KSG</strong>
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">16</span>Wilson Comb...</strike> 
				          </p>
				          
				        </div>
				
				<!-- /#match26 -->
				        <div id="match27" class="match m2">
				          <p class="slot slot1">
				            <strike><span class="seed">8</span> FNH SLP Mark</strike>
				          </p>
				          <p class="slot slot2">
				            <strong><span class="seed">9</span> Remington Ver...</strong>
				          </p>
				          
				        </div>
				
				<!-- #/match27 -->
				        <div id="match28" class="match m3">
				          <p class="slot slot1">
				            <strong><span class="seed">5</span> Browning A5</strong>
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">12</span> Mossberg Flex</strike>
				          </p>
				          
				        </div>
				
				<!-- #/match28 -->
				        <div id="match29" class="match m4">
				          <p class="slot slot1">
				            <strong><span class="seed">4</span> Benelli Legacy...</strong>
				          </p>
				          <p class="slot slot2">
				           <strike><span class="seed">13</span> Beretta TX4...</strike>   
				          </p>
				          
				        </div>
				
				<!-- #/match29 -->
				        <div id="match30" class="match m5">
				          <p class="slot slot1">
				            <strike><span class="seed">6</span> Franchi Affinity</strike>
				          </p>
				          <p class="slot slot2">
				            <strong><span class="seed">11</span> Ruger Red...</strong> 
				          </p>
				          
				        </div>
				
				<!-- /#match30 -->
				        <div id="match31" class="match m6">
				          <p class="slot slot1">
				            <strong><span class="seed">3</span> Saiga-12</strong> 
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">14</span> Weatherby...</strike>
				          </p>
				          
				        </div>
				
				<!--/#match31-->
				        <div id="match32" class="match m7">
				          <p class="slot slot1">
				            <strong><span class="seed">7</span> Beretta DT-11</strong>
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">10</span> Mossberg Mav...</strike>    
				          </p>
				          
				        </div>
				
				<!--/#match32-->
				        <div id="match33" class="match m8">
				          <p class="slot slot1">
				            <strong><span class="seed">2</span> Remington M8...</strong>
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">15</span> CZ Coach Gun</strike>
				          </p>
				          
				        </div>
				
				<!-- /#match9 -->
				      </div>
				<!-- /.region3 -->
				<!-- start region4 -->
				      <div class="region region4">
				        <h4 class="region4 first_region">
				          AR-15 
				        </h4>
				        <div class="bracket-sponsor slidefire">Presented by:<br /><a href="http://www.slidefire.com/" target="_blank"><img src="/wp-content/themes/imo-mags-gunsandammo/img/slidefire-logo.jpg" alt="Slide Fire" /></a></div>
				        
				        				        
				        <div id="match10" class="match m1">
				          <p class="slot slot1">
				            <strong><span class="seed">1</span> Spike's Tact...</strong>
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">16</span> Mossberg MMR</strike>  
				          </p>
				          
				        </div>
				        
				         
				
				<!-- /#match10 -->
				        <div id="match11" class="match m2">
				          <p class="slot slot1">
				            <strong><span class="seed">8</span> Colt LE901...</strong>
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">9</span> Nosler Varma...</strike>
				          </p>
				          
				        </div>
				
				<!-- /#match11 -->
				        <div id="match12" class="match m3">
				          <p class="slot slot1">
				            <strong><span class="seed">5</span> LWRCI REPR</strong>
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">12</span> Bravo Comp...</strike>
				          </p>
				          
				        </div>
				
				<!-- /#match12 -->
				        <div id="match13" class="match m4">
				          <p class="slot slot1">
				            <strong><span class="seed">4</span> LaRue Tactical...</strong>
				          </p>
				          <p class="slot slot2">
				           <strike><span class="seed">13</span> Stag Arms 3G</strike>  
				          </p>
				          
				        </div>
				
				<!-- /#match13 -->
				        <div id="match14" class="match m5">
				          <p class="slot slot1">
				            <strong><span class="seed">6</span> Daniel Defense...</strong>  
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">11</span> Rock River...</strike> 
				          </p>
				          
				        </div>
				
				<!-- /#match14 -->
				        <div id="match15" class="match m6">
				          <p class="slot slot1">
				            <strong><span class="seed">3</span> S&W M&P15...</strong>  
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">14</span> Remington R-25</strike>
				          </p>
				          
				        </div>
			   <!-- /#match15 -->
				        <div id="match16" class="match m7">
				          <p class="slot slot1">
				            <strike><span class="seed">7</span> Alexander Arms...</strike>  
				          </p>
				          <p class="slot slot2">
				            <strong><span class="seed">10</span> SIG Sauer M4...</strong>  
				          </p>
				          
				        </div>
				        
				        <div id="match17" class="match m8">
				          <p class="slot slot1">
				            <strong><span class="seed">2</span> Wilson Combat...</strong>
				          </p>
				          <p class="slot slot2">
				            <strike><span class="seed">15</span> DPMS 300-A...</strike> 
				          </p>
				          
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
				          	<strong><span class="seed">1</span>S&W M&P Shield</strong>
				          </p>
				          <p rel="match19" class="slot slot2">
				           <strike><span class="seed">8</span>Kimber Solo 9mm</strike>
				          </p>
				          
				        </div>
				
				<!-- /#match41 -->
				        <div id="match42" class="match m2">
				          <p rel="match20" class="slot slot1">
				          <strong><span class="seed">5</span>S&W Perform...</strong></p>
				          <p rel="match21" class="slot slot2">
				           <strike><span class="seed">4</span>Springfield XD-S</strike></p>
				          
				          
				        </div>
				<!-- /#match42 -->
				        <div id="match43" class="match m3">
				          <p class="slot slot1">
				           <strong><span class="seed">11</span>Remington R1...</strong></p>
				          <p class="slot slot2">
				         <strike><span class="seed">3</span>CZ P-09 Duty</strike></p>
				          
				        </div>
				<!-- /#match43 -->
				        <div id="match44" class="match m4">
				          <p class="slot slot1">
				          <strike><span class="seed">10</span>SIG P938</strike></p>
				          <p class="slot slot2">
				          <strong><span class="seed">2</span>Glock 17 Gen4</strong></p>
				          
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
				          <strong><span class="seed">1</span>Ruger Gunsite...</strong></p>
				          <p class="slot slot2">
				          <strike><span class="seed">8</span> T/C Dimension</strike></p>
				          
				        </div>
				        <div id="match46" class="match m2">
				          <p class="slot slot1">
				           <strike><span class="seed">5</span> Browning X-Bo...</strike></p>
				          <p class="slot slot2">
				          <strong><span class="seed">4</span> Kimber 84M...</strong></p>
				          
				        </div>
				
				<!-- /#match46 -->
				        <div id="match47" class="match m3">
				          <p class="slot slot1">
				         <strike><span class="seed">6</span> CZ 455 Varm...</strike></p>
				          <p class="slot slot2">
				          <strong><span class="seed">3</span> Nosler Model...</strong></p>
				          
				        </div>
				        <div id="match48" class="match m4">
				          <p class="slot slot1">
				          <strike><span class="seed">7</span> Ruger 10/22...</strike></p>
				          <p class="slot slot2">
				          <strong><span class="seed">2</span> Sako TRG M10</strong></p>
				          
				        </div>
				<!-- /#match48 -->
				      </div>
				      <div class="region region3">
				        <h4 class="region3">
				          East 
				        </h4>
				        <div id="match3" class="match m1">
				          <p class="slot slot1">
				          <strong><span class="seed">1</span>Kel-Tec KSG</strong></p>
				          <p class="slot slot2">
				          <strike><span class="seed">9</span> Remington Ver...</strike></p>
				          
				        </div>
				
				<!--/match3-->
				        <div id="match34" class="match m2">
				          <p class="slot slot1">
				          <strike><span class="seed">5</span> Browning A5</strike></p>
				          <p class="slot slot2">
				          <strong><span class="seed">4</span> Benelli Legacy...</strong></p>
				          
				        </div>
				<!-- #/match34 -->
				        <div id="match35" class="match m3">
				          <p class="slot slot1">
				          <strike><span class="seed">11</span> Ruger Red...</strike></p>
				          <p class="slot slot2">
				          <strong><span class="seed">3</span> Saiga-12</strong></p>
				          
				        </div>
				<!-- #/match35 -->
				        <div id="match36" class="match m4">
				          <p class="slot slot1">
				          <strong><span class="seed">7</span> Beretta DT-11</strong></p>
				          <p class="slot slot2">
				          <strike><span class="seed">2</span> Remington M8...</strike></p>
				          
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
				          <strike><span class="seed">1</span> Spike's Tact...</strike></p>
				          <p class="slot slot2">
				          <strong><span class="seed">8</span> Colt LE901...</strong></p>
				          
				        </div>
				
				<!--/#match37-->
				        <div id="match38" class="match m2">
				          <p class="slot slot1">
				          <strike><span class="seed">5</span> LWRCI REPR</strike></p>
				          <p class="slot slot2">
				          <strong><span class="seed">4</span> LaRue Tactical...</strong></p>
				          
				        </div>
				<!--/#match38-->
				        <div id="match39" class="match m3">
				          <p class="slot slot1">
				          <strong><span class="seed">6</span> Daniel Defense...</strong></p>
				          <p class="slot slot2">
				          <strike><span class="seed">3</span> S&W M&P15...</strike></p>
				          
				        </div>
				<!--/#match39-->
				        <div id="match40" class="match m4">
				          <p class="slot slot1">
				          <strike><span class="seed">10</span> SIG Sauer M4...</strike></p>
				          <p class="slot slot2">
				          <strong><span class="seed">2</span> Wilson Combat...</strong></p>
				          
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
				          <p class="slot slot1"><strike><span class="seed">1</span>S&W M&P Shield</strike>
				          </p>
				          <p class="slot slot2"><strong><span class="seed">5</span>S&W Perform...</strong>
				          </p>
				          
				        </div>
				        <div id="match54" class="match m2">
				          <p class="slot slot1"><strike><span class="seed">11</span>Remington R1...</strike>
				          </p>
				          <p class="slot slot2"><strong><span class="seed">2</span>Glock 17 Gen4</strong>
				          </p>
				          
				        </div>
				      </div>
				
				<!-- /.region1 -->
				      <div class="region region2">
				        <h4 class="region2">
				          West 
				        </h4>
				        <div id="match55" class="match m1">
				          <p class="slot slot1"><strong><span class="seed">1</span>Ruger Gunsite...</strong>
				          </p>
				          <p class="slot slot2"><strike><span class="seed">4</span> Kimber 84M...</strike>
				          </p>
				          
				        </div>
				        <div id="match56" class="match m2">
				          <p class="slot slot1"><strike><span class="seed">3</span> Nosler Model...</strike>
				          </p>
				          <p class="slot slot2"><strong><span class="seed">2</span> Sako TRG M10</strong>
				          </p>
				          
				        </div>
				
				<!--/#match56-->
				      </div>
				      <div class="region region3">
				        <h4 class="region3">
				          East 
				        </h4>
				        <div id="match49" class="match m1">
				          <p class="slot slot1"><strong><span class="seed">1</span>Kel-Tec KSG</strong>
				          </p>
				          <p class="slot slot2"><strike><span class="seed">4</span> Benelli Legacy...</strike>
				          </p>
				          
				        </div>
				
				<!--/#match49-->
				        <div id="match50" class="match m2">
				          <p class="slot slot1"><strong><span class="seed">3</span> Saiga-12</strong>
				          </p>
				          <p class="slot slot2"><strike><span class="seed">7</span> Beretta DT-11</strike>
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
				          <p class="slot slot1"><strike><span class="seed">8</span> Colt LE901...</strike>
				          </p>
				          <p class="slot slot2"><strong><span class="seed">4</span> LaRue Tactical...</strong>
				          </p>
				          
				        </div>
				
				<!--/#match51-->
				        <div id="match52" class="match m2">
				          <p class="slot slot1"><strong><span class="seed">6</span> Daniel Defense...</strong>
				          </p>
				          <p class="slot slot2"><strike><span class="seed">2</span> Wilson Combat...</strike>
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
				          <p class="slot slot1"><strong><span class="seed">5</span>S&W Perform...</strong>
				          </p>
				          <p class="slot slot2"><strike><span class="seed">2</span>Glock 17 Gen4</strike>
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
				          <p class="slot slot1"><strong><span class="seed">1</span>Ruger Gunsite...</strong>
				          </p>
				          <p class="slot slot2"><strike><span class="seed">2</span> Sako TRG M10</strike>
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
				          <p class="slot slot1"><strike><span class="seed">1</span>Kel-Tec KSG</strike>
				          </p>
				          <p class="slot slot2"><strong><span class="seed">3</span> Saiga-12</strong>
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
				          <p class="slot slot1"><strong><span class="seed">4</span> LaRue Tactical...</strong>
				          </p>
				          <p class="slot slot2"><strike><span class="seed">6</span> Daniel Defense...</strike>
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
				          <p class="slot slot1"><strong><span class="seed">5</span>S&W Perform...</strong>
				          </p>
				          <p class="slot slot2"><strike><span class="seed">1</span>Ruger Gunsite...</strike>
				          </p>    
				        </div>
				        <div id="match62" class="match m2">
				          <p class="slot slot1"><strike><span class="seed">3</span> Saiga-12</strike>
				          </p>
				          <p class="slot slot2"><strong><span class="seed">4</span> LaRue Tactical...</strong>
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
				        <div id="match64" class="match m1 open-poll" poll="sw-performance-center-1911-vs-larue-tactical-costa-edition-hybrid">
				          <p class="slot slot1" id="slot127"><strike><span class="seed">5</span>S&W Perform...</strike>
				            <strong><!--<span class="seed">0</span> Winner <em class="score">65</em></strong>-->
				<!-- winner -->
				          </p>
				          <p class="slot slot2" id="slot128"><strong><span class="seed">4</span> LaRue Tactical...</strong>
				            <!--<strike><span class="seed">4</span> Loser <em class="score">60</em></strike>-->
				<!-- loser -->
				          </p>
				          <a class="vote">VIEW</a>
				        </div>
				      </div>
				    </div>
				  </div>
				  <?php if (function_exists('imo_add_this')) {imo_add_this();} ?>
				</div>			
	</div><!-- .entry -->
	
</div><!-- .col-abc -->

<div class="page-template-page-right-php bracket-footer">
	<div id="sidebar">
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-default')) : else : ?><?php endif; ?>
		<div id="responderfollow"></div>
		<div class="sidebar advert">
			<?php imo_dart_tag("300x250",false,array("pos"=>"btf")); ?>

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
	<!--<div class="voted" style="display:none;"><h4>You've already voted for this matchup.</h4></div>
	<div class="poll-pagination" style="display:none;">
		<a class="prev-poll">Previous Matchup<span></span></a>
		<a class="next-poll">Next Matchup<span></span></a>
	</div>-->
	<div id="Gen" class="marginLeft">
		<div class="block-rotate" id="rotate_01"></div>
		<div class="block-rotate" id="rotate_02"></div>
		<div class="block-rotate" id="rotate_03"></div>
		<div class="block-rotate" id="rotate_04"></div>
		<div class="block-rotate" id="rotate_05"></div>
		<div class="block-rotate" id="rotate_06"></div>
		<div class="block-rotate" id="rotate_07"></div>
		<div class="block-rotate" id="rotate_08"></div>
		<div class="clearfix"></div>
		<p>Loading...</p>
	</div>
	
</div>

<?php get_footer(); ?>