<?php
/**
 * Template Name: GA Madness Page
 * Description: A Page Template for G&A Madness (bracket).
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
 
$dataPos = 0;
get_header(); ?>
    <div id="content" role="main">
		<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
			<h1 class="page-title" style="display:none;height:0;">
				<div class="icon"></div>
				<span><?php the_title(); ?></span>
		    </h1>
		    <?php if(mobile()){ ?><img class="madness-logo-mobile" src="/wp-content/themes/gunsandammo/images/ga-madness/ga-madness-galco.png" alt="G&A Madness" title="G&A Madness" /><?php } ?>
		    <ul id="ga-madness-nav">
				<li><a href="/ga-madness">Gun Bracket</a></li>
				<li><a href="/ga-madness/enter">Enter</a></li>
				<?php if(!mobile()){ ?><li class="madness-logo"><img src="/wp-content/themes/gunsandammo/images/ga-madness/ga-madness-galco.png" alt="G&A Madness" title="G&A Madness" /></li><?php } ?>
				<li><a href="/ga-madness/prizes">Prizes & Rules</a></li>
				<li><a href="/ga-madness/how-it-works">How it Works</a></li>
			</ul>
		</div>
		<div data-position="<?php echo $dataPos = $dataPos + 1; ?>"  id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix js-responsive-section'); ?>>
			<div class="article-holder ga-madness">
				<?php if(!mobile()){ ?>
					<ul class="schedule">
						<li>First Round<div>March, 18-21</div></li>
						<li>Second Round<div>March, 18-21</div></li>
						<li>Sweet 16<div>March, 18-21</div></li>
						<li>Elite 8<div>March, 18-21</div></li>
						<li>Final Four<div>March, 18-21</div></li>
						<li>Final Round<div>March, 18-21</div></li>
					</ul>
				<?php } ?>
				<div class="addthis-below"><?php if (function_exists('imo_add_this')) {imo_add_this();} ?></div>
				<?php if(mobile()){ ?>
				<div id="tabs">
					<ul class="rounds">
						<li><a href="#tabs-1">1st</a></li>
						<li><a href="#tabs-2">2nd</a></li>
						<li><a href="#tabs-3">Sweet 16</a></li>
						<li><a href="#tabs-4">Elite 8</a></li>
						<li><a href="#tabs-5">Final 4</a></li>
						<li class="final-round"><a href="#tabs-6">Final</a></li>
					</ul>
					<div class="clearfix"></div>
					<div class="gun-types">
						<select>
							<option value="">SELECT A GUN TYPE</option>
							<option value="">AR-15s</option>
							<option value="">Handguns</option>
							<option value="">Shotguns</option>
							<option value="">Rifles</option>
						</select>
					</div>
					<div id="tabs-1">
						<div class="matchup">									
							<div class="action-arrow"></div>
							<a href="#" class="contender">
								<span class="rank"><span>1</span> Gun type</span>
								<span class="rank"><span>8</span> Gun type</span>
							</a>
						</div>
						<div class="matchup">									
							<div class="action-arrow"></div>
							<a href="#" class="contender">
								<span class="rank"><span>1</span> Gun type</span>
								<span class="rank"><span>8</span> Gun type</span>
							</a>
						</div>
					</div>
					<div id="tabs-2">
						<p>Come back on March 00 to see who advances!</p>
					</div>
					<div id="tabs-3">
						
						
					</div>
					<div id="tabs-4">
						
						
					</div>
					<div id="tabs-5">
						
					</div>
					<div id="tabs-6">
						
					</div>
				</div><!-- #tabs -->
				<?php }else{ ?>
				
				
				
				<div class="ga-madness-wrapper">
					<div class="region-titles">
						<div class="region-left">
							<h2>Handguns</h2><?php echo get_imo_dart_tag("240x60",1,false,array("sect"=>"ga_madness")); ?>
						</div>
						<div class="region-right">
							<h2>Shotguns</h2><?php echo get_imo_dart_tag("240x60",1,false,array("sect"=>"ga_madness")); ?>
						</div>
					</div>
					<div class="regions region1">
						<div class="column column1">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Springfield XD-S 4.0</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Colt M45A1 CQBP Marine Pistol</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>2</span><div>Smith & Wesson M&P Bodyguard .380</div></div>
									<div class="rank rank-bottom"><span>7</span><div>Nighthawk Costa Compact 9mm</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
						</div>
						
						<div class="column column2">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
						</div>
					
						<div class="column column3">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
						</div>
						
						<div class="column column4">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
													
						</div>
					</div>
					
					<div class="regions region2">
						<div class="column column1">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
						</div>
						
						<div class="column column2">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
						</div>
						
						<div class="column column3">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
						</div>
						
						<div class="column column4">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
													
						</div>
					</div>
					
					<div class="regions region-final">
						<div class="final-wrapper">
							<h2>Final Round</h2>
							<?php echo get_imo_dart_tag("240x60",1,false,array("sect"=>"ga_madness")); ?>
							<div class="column column5">
								<div class="matchup">									
									<div class="action-arrow"></div>
									<a href="#" class="contender">
										<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
									</a>
								</div>
							</div>
							
							<div class="column column6">
								<div class="matchup">									
									<div class="action-arrow"></div>
									<a href="#" class="contender">
										<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
									</a>
								</div>
							</div>
							
							<div class="column column7">
								<div class="matchup">									
									<div class="action-arrow"></div>
									<a href="#" class="contender">
										<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
									</a>
								</div>
							</div>
						</div>
					</div>
					
					<div class="region-titles">
						<div class="region-left">
							<h2>Rifles</h2><?php echo get_imo_dart_tag("240x60",1,false,array("sect"=>"ga_madness")); ?>
						</div>
						<div class="region-right">
							<h2>AR-15s</h2><?php echo get_imo_dart_tag("240x60",1,false,array("sect"=>"ga_madness")); ?>
						</div>
					</div>

					<div class="regions region3">
						<div class="column column1">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
						</div>
						
						<div class="column column2">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
						</div>
						
						<div class="column column3">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
						</div>
						
						<div class="column column4">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
													
						</div>
					</div>
					
					<div class="regions region4">
						<div class="column column1">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
						</div>
						
						<div class="column column2">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
						</div>
						
						<div class="column column3">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
						</div>
						
						<div class="column column4">
							<div class="matchup">									
								<div class="action-arrow"></div>
								<a href="#" class="contender">
									<div class="rank rank-top"><span>1</span><div>Gun type</div></div>
									<div class="rank rank-bottom"><span>8</span><div>Gun type</div></div>
								</a>
							</div>
													
						</div>
					</div>
				</div>
				
				
				<?php } ?>
		    </div><!-- .article-holder -->
		</div>
	</div><!-- #content -->
	<div class="clearfix"></div>
	<?php imo_sidebar(); ?>
	<div id="primary" class="general">
        <div class="general-frame">
        	<div id="content" role="main">
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>"  id="post-<?php the_ID(); ?>" <?php post_class('article-brief clearfix js-responsive-section'); ?>>
					<?php the_content(); ?>
				</div>
				<?php sub_footer(); ?> 
        	</div>
			
        </div>
	</div>
				
<?php get_footer(); ?>






















