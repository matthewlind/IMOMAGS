<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
/**
 * @package favebusiness
 *
 * This file is part of the FaveBusiness Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/favebusiness/
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
<!DOCTYPE html>
<!-- bid: <?php global $blog_id; print $blog_id ?>; env: <?php if(defined("WEB_ENV")) { print WEB_ENV; } else { print "production"; } ?> -->
<!--[if IE 6]><![endif]-->
<html <?php language_attributes() ?>>
<head>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />

	<title><?php wp_title(''); ?></title>

	<meta http-equiv="X-UA-Compatible" content="chrome=1" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<?php wp_get_archives(array('type' => 'monthly', 'format' => 'link')); ?>
	
	<link href="/wp-content/themes/imo-mags-gameandfish/960.css" media="screen" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Glegoo|Lato:300,400|Gudea|Share' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!--[if lte IE 7]>
		<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/css/lte-ie7.css?ver=<?php echo CFCT_URL_VERSION; ?>" />
	<![endif]-->
	
	<?php
	// Include javascript for threaded comments if needed
	if ( is_singular() && get_option('thread_comments') ) { wp_enqueue_script( 'comment-reply' ); }

	wp_head();
	include_once get_stylesheet_directory() . "/head-includes.php"; 
	?>
<?php if (defined('GOOGLE_FONT')): ?>
	<link href='<?php print GOOGLE_FONT; ?>' rel='stylesheet' type='text/css'>
<?php endif; ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/scripts.js"/></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.buffet.js"/></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.buffet.min.js"/></script>


</head>
	<body>
		<!--  <div id="dialog">TESTING</div> -->

		<!-- container -->
		<div class="container container_16">
			<div class="header-cr">
				<h1 class="site-title-cr"><a href="<?php echo home_url('/'); ?>" title="<?php _e('Home', 'carrington-business') ?>"><?php bloginfo('name'); ?></a></h1>
			</div>
			<div class="str-container-cr">
			
			<?php
            wp_nav_menu(array( 
				'theme_location' => 'featured',
				'container' => 'nav',
				'container_class' => 'nav-featured nav',
				'depth' => 2,
				'fallback_cb' => null
			));
            wp_nav_menu(array( 
				'theme_location' => 'main',
				'container' => 'nav',
				'container_class' => 'nav-main nav',
				'depth' => 2,
			));
            wp_nav_menu(array( 
				'theme_location' => 'subnav-right',
				'container' => 'nav',
				'container_class' => 'nav-subnav nav-subnav-right nav',
				'depth' => 2,
				'fallback_cb' => null
			));
            wp_nav_menu(array( 
				'theme_location' => 'subnav',
				'container' => 'nav',
				'container_class' => 'nav-subnav nav',
				'depth' => 2,
				'fallback_cb' => null
			));
			?>
			</div>
	</div>
	<div class="clear">&nbsp;</div>
	<!-- homepage top -->
	<div id="page-top">
		<!-- container -->
		<div class="container container_16">

			<!-- left content -->
			<div class='grid_4'>
				<div class="box-230">
					<p class="purple purp-callout"></p>
				</div>
				<div class="box-230">
					<p class="white callout gallery view-entries"><a href="#gallery"></a></p>
				</div>

				<div class="box-230">
					<p class="white cr-callout"></p>
				</div>
			</div>

			<!-- right content -->
			<div class='grid_12'>
				<div class="box-710 upload">
					<a href="#sign-up-area"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/Crown-Royal-homepage-image.jpeg" alt="Catch Your Crown" /></a>
				</div>
				<div class="box-350 slideshow_btm">
					<a href="#prizes" class="prizes-area">
           			<span><abbr>View The Prizes</abbr></span>
            		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/prizes.jpg" alt="Prizes" />
       				</a>

				</div>
				<div class="box-350 slideshow_btm box-right">
					<a href="#footer" class="rules-area">
           			<span><abbr>View The Rules</abbr></span>
            		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/rules.jpg" alt="Rules" />
       				</a>

				</div>			
			</div>

		</div><!--/ end container -->
	</div><!--/ end homepage top -->
	
	
	<!-- Gallery -->
	<div id="gallery">
		<!-- container -->
		<div class="gallery-entries">
			<h1>Contest Entries</h1>
						
			<!-- left content -->
			<div id="tabs">
				<ul id="filters" class="tabs-bottom">
					<li>Filter By:</li>
					<li><a href="#tabs-1">Most Recent</a></li>
					<li><a href="#tabs-2">Random</a></li>
				</ul>
				
				<!-- Tab Most Recent -->
				<div id="tabs-1">
					<div class="scroll_mask">				
 						<ul class="scroll">
						<?php
						//Most Recent
						$the_query = new WP_Query( array( 'post_type' => 'crown_your_catch','posts_per_page' =>-1, 'orderby' => 'date', 'order' => 'DESC' ) );
						while ( $the_query->have_posts() ) : $the_query->the_post(); 
							if(has_post_thumbnail()){  
								foreach($the_query as $query) ?>
								<li><a href="<?php echo $query->guid; ?>"><span></span><?php the_post_thumbnail('thumbnail'); ?></a></li>
            					<?php
       						}
						endwhile;	
						// Reset Post Data
						wp_reset_postdata();
						?>
			  			</ul>
					</div>
					<a class="prev">Previous</a>
					<a class="next">Next</a>
				</div><!-- end tab-1 -->
				
				<!-- Tab Random -->
				<div id="tabs-2">
					<div class="scroll_mask">				
 						<ul class="scroll">
			
						<?php
						//Random Order
						$the_query = new WP_Query( array( 'post_type' => 'crown_your_catch', 'orderby' => 'rand' ) );
							while ( $the_query->have_posts() ) : $the_query->the_post(); 
								if(has_post_thumbnail()){  
									foreach($the_query as $query) ?>
									<li><a href="<?php echo $query->guid; ?>"><span></span><?php the_post_thumbnail('thumbnail'); ?></a></li>
            						<?php 
       								
       							}
							endwhile;	
							// Reset Post Data
							wp_reset_postdata();
							?>
			  			</ul>
					</div>
					<a class="prev">Previous</a>
					<a class="next">Next</a>
				</div><!-- end tab-2 -->
						
			</div><!-- end tabs -->
		</div><!-- end container -->
	</div><!-- end container gallery -->


	<!-- sign up area -->		
	<div id="sign-up-area">
		<!-- container -->
		<div class="sign-up-form">
			<h1>Crown Your Catch Entry Form</h1>
			<p class="required"><span>*</span> = Required.</p>
			<?php 
			// Call the forms
			gravity_form(9, false, false, false, '', false);
			?>	
			<em>This contest is only open to residents of Alabama, Connecticut, Maine, Massachusetts, Mississippi, New Hampshire, New York, North Carolina, Pennsylvania, Rhode Island, Virginia, West Virginia, and Vermont.</em>	
		</div><!-- /end container -->
	</div><!-- /end sign up area -->	
			
	
	<!-- Prizes -->	
	<div id="prizes">
		<!-- container -->
		<div class="container container_16">
		<h1>Prizes</h1>
			
			<!-- left content -->
			<div class='grid_8'>
				<div class="box-470 grand">
					<h2>Grand Prize</h2>
           			<a href="javascript:void(0)">
           			<span>
           				<ol>
							<li>2012 Triton Explorer Series boat</li>
							<li>115 HP Mercury outboard</li>
							<li>Complete with trailer and Motor Guide trolling motor</li>
						</ol>
					</span>
            		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/grand_prize.jpg" alt="Grand Prize" />
       				</a>
				</div>
				<div class="box-470 grand">
					<h2>First Prize</h2>
					<a href="javascript:void(0)">
					<span>
						<ol>
							<li>Fishing excursion for winner and guest to the Florida Keys</li>
							<li>Two night stay and one full day guided fishing trip<br />with all tackle and license provided</li>
							<li>Roundtrip airfare and accommodations for two included</li>
						</ol>
					</span>
            		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/second_prize.jpg" alt="Second Grand Prize" />
       				</a>
				</div>
			</div>

			<!-- middle content -->
			<div class='grid_6'>
				<div class="box-350 box-350-states">
					<h2>State Prizes</h2>
					<a href="javascript:void(0)">
						<span>There will be 13 winners, one from each eligible state. The State Prize package will consist of:<br /><br />
							<ol>
								<li>"This Story Calls for a Crown" fishing jersey</li>
								<li>Crown Royal fishing cap</li>
								<li>Plano fishing tackle box</li>
								<li>Penn Rod and Reel Combo</li>
								<li>Shipping included</li>
							</ol>
						</span>
            		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/states.jpg" alt="State Prizes" class="states-bg" />
            		</a>

				</div>
			</div>

			<!-- right content -->
			<div class='grid_2'>
				<div class="box-110">
					<p class="prizes white callout"></p>
				</div>
				<div class="box-110">
					<p class="white callout upload submit"><a href="#sign-up-area"></a></p>
				</div>
				<div class="box-110">
					<p class="white callout gallery entry"><a href="#gallery"></a></p>
				</div>
				<div class="box-110">
					<p class="white callout rules-area rules"><a href="#footer"></a></p>
				</div>
			</div>

		</div><!--/end container -->		
	</div><!--/end Prizes -->			
	
	
	<!-- Footer -->		
	<div id="footer">
		<!-- container -->
		<div class="container container_16">
			<div class='grid_16'>
			<h1>THIS STORY CALLS FOR A CROWN CONTEST</h1>
			<h2>Official Rules</h2>		
			<p>NO PURCHASE NECESSARY.  A PURCHASE WILL NOT INCREASE YOUR CHANCE OF WINNING.  THIS CONTEST IS ONLY OPEN TO RESIDENTS OF ALABAMA, CONNECTICUT, MAINE, MASSACHUSETTS, MISSISSIPPI, NEW HAMPSHIRE, NEW YORK, NORTH CAROLINA, PENNSYLVANIA, RHODE ISLAND, VIRGINIA, WEST VIRGINIA, AND VERMONT.  MUST BE 21 YEARS OF AGE OR OLDER TO ENTER. VOID WHEREVER PROHIBITED OR RESTRICTED BY LAW.</p>
			<ol>
			
			<li>To Enter:  This contest begins on at 12:01 a.m. CST on April 15, 2012, and ends on at 11:59:59 p.m. CST on June, 30, 2012.  To enter, log on to www.gameandfishmag.com/crownroyal and follow the on-screen instructions.   Once on the registration page, upload your greatest catch photograph and submit your story called "Greatest Catch" in 75 words or less.   Each word consists of 5 characters including spaces.  Photographs must be original, unaltered, 1 MB in size, on which no image editing software has been used.  One entry allowed per person.  Multiple entries will result in disqualification.  Sponsor is not responsible for technical difficulties in uploading Contest entry, telephone or cell phone service disruptions or other equipment or service issues that might affect the ability of the Sponsor to notify the winner.  Sponsor assumes no responsibility for lost, late, damaged, misdirected, illegible, incomplete, incorrect or postage-due mail, entries or other contest materials, all of which are void.  Facsimiles or mechanical reproductions will not be accepted.   All entries become the property of the Sponsor and will not be acknowledged or returned.</li>	

					<li>Prizes: 
One (1) Grand Prize will be awarded.  Winner will receive a 2012 Triton 17 Explorer Series boat with 115 HP Mercury outboard and complete with trailer and Motor Guide trolling motor, water ready. Boat will be delivered to the nearest Triton boat dealer to prizewinner for pick up.  Approximate Retail Value: $20,495.00.
<br /><br />One (1) First Prize will be awarded.  Winner will receive a guided fishing trip for two to a location to be determined by the Sponsor in Key West, Florida.  Trip includes round trip coach airfare for two; ground transportation to and from airport; two (2) nights' hotel accommodation for winner and guest with accommodations based on double occupancy; one (1) day guided fishing trip including guide fees, equipment, fishing license; five (5) meals (gratuities not included).  Trip will take place before December 1, 2012.  If winner cannot travel prior to December 1, 2012, prize will be forfeited and an alternate winner selected at Sponsor's sole discretion.  Approximate Retail Value: $6,000.00.<br /><br />
One (1) winner from each of the thirteen (13) participating states will receive a Crown Royal gift bag which includes, but not limited to: Crown Royal branded fishing jersey, cap, Plano fishing tackle box, Penn rod and reel combo. Approximate Retail Value: $250.00.   Alcohol beverages are not part of any prize.<br /><br />

Total Approximate Retail Prize Value: $29,745.00.

</li>
<li>Winner Determination:  Winners will be determined on or about August 1, 2012.   All winners will be selected by an independent judging organization whose decisions will be final in all matters relating to this contest.   The criteria for judging will be originality, 50%, and creativity, 50%.  The winners will be notified by telephone or mail on or about August 1, 2012,  and will be required to sign an affidavit of eligibility and liability/publicity release within ten (10) days of notification or prize will be forfeited and may be awarded to another winner at Sponsor's sole discretion.  If winner cannot be located or does not respond to attempt to be contacted within ten (10) days, prize will automatically be forfeited and an alternate winner may be selected at Sponsor's sole discretion.  Except where prohibited by law, acceptance of prize constitutes winner's consent for Sponsor to use an entrant's name, city and state of residence, voice, signature, statements, Contest entry, biographical information, photograph and/or likeness for advertising and/or publicity purposes without any additional compensation or consideration.  Entrants expressly agree to waive any and all rights to publicity that they have or may have arising out of or relating to the Contest.</li>
<li>Contest Entries:  All materials, documents, information and data submitted to the Sponsor in connection with this Contest, including the Contest entry and submission (collectively "Contest entry") are the property of Sponsor, will not be returned and cannot be acknowledged.  By entering the Contest, entrants represent and warrant that their Contest entry is their sole, original work and that it does not infringe upon the rights of any other party, including but not limited to any intellectual property, trade secret or other proprietary rights of any other party. By submitting a Contest entry, entrant further represents and warrants that any person(s) referenced has given his or her express written consent to the reference and use as contemplated by these Official Rules and that entrant has obtained written permission for such use from any such person.  Submission of an entry grants Sponsor the right to use, publish, adapt, edit and/or modify Contest entry in any way, in whole or in part, and to use such Contest entry, and any ideas or concepts contained therein, in commerce and in any and all media now known or hereafter discovered, worldwide, including but not limited to Sponsor's website, without limitation or compensation to the entrant and without right of notice, review or approval of any such use of the Contest entry. Submission of a Contest entry further constitutes the entrant's consent to irrevocably assign and transfer to the Sponsor any and all rights, title and interest in and to the Contest entry, including but not limited to all intellectual property rights and proprietary rights worldwide.  Any content, material or information included in Contest entry shall not be confidential, proprietary or trade secret.  By submitting a Contest entry, entrant consents to Sponsor's use, reproduction and disclosure of the Contest entry, and ideas, concepts or other materials contained therein, for any purpose, including any commercial purpose.  Any Contest entry that contains third party artistic works, copyrights, trademarks, trade names, logos or similar brand identifying marks, trade secrets or other proprietary rights will not constitute a valid Contest entry.<br /><br />

Contest entry must be original, not have been entered in any other essay contest competition or violate the rights of other parties, including any intellectual property, trade secret or other proprietary right of any other parties.  Contest entry may not be offensive, defamatory, discriminatory, obscene, libelous, reflect poorly on the Crown Royal brand or be inappropriate for use in advertising or for promotional publicity purposes as determined by the Sponsor and/or the Judge(s) in their sole discretion. Contest entry must be unpublished and must be the work solely of the entrant.
<br /><br />
The photograph submitted must be taken solely by the entrant.  By submitting an entry, entrant represents and warrants that: (i) his/her photograph/video is the sole and original creation of the entrant and has not been copied in whole or in part from any other work; (ii) the entry does not violate or infringe any copyright, trademark, trade name, trade secret or other proprietary right of any person or entity; and (iii) the person(s) depicted in the photograph has given his or her express written consent to its submission into the contest and use as contemplated by these Official Rules and by submitting any photograph that contains the name, image, voice, signature, statements or likeness of any person, you hereby represent and warrant that you have obtained such written permission. Any photograph that contains third party artistic works, copyrights, trademarks, trade names, logos, similar brand identifying marks, trade secrets or other proprietary rights will not constitute a valid Contest entry.  Submission of a Contest entry grants Sponsor the right to use, publish, adapt, edit and/or modify entry in any way, in whole or in part, and to use such entry in commerce and in any and all media now known or hereafter discovered, worldwide, including but not limited to Sponsor's website, without limitation or compensation to the entrant and without right of notice, review or approval of any such use of the entry.
<br /><br />
Photographs containing full or partial nudity, defined as the display of the genitals, pubic area, vulva, anus, or anal cleft with less than a fully opaque covering or the showing of the breast with less than a fully opaque covering of any part of the nipple, or any lewd or sexually suggestive gesture will be disqualified.  No photograph shall (a) depict persons consuming alcoholic beverages (b) depict persons conducting themselves in an inappropriate manner (c) contain material that would imply that the consumption of alcoholic beverages is acceptable before or while operating machinery, driving a vehicle or undertaking any other activity that requires a high degree of alertness or physical coordination, (d) contain any material that would degrade or demean the human form, image or status of women, men or the members of any group based on race, religion, ethnic background, sexual orientation or any other minority status, or (e) include an image of any person that appears to be under 21 years of age.  Obscene, provocative, lewd or otherwise objectionable content or those which reflect poorly on the Crown Royal brand will not be considered and the determination of the appropriateness of any photograph or video submitted is at the sole discretion of the Sponsor and/or Judges.
</li>
<li>Eligibility:  This contest is open only to legal residents of Alabama, Connecticut, Maine, Massachusetts, Mississippi, New Hampshire, New York, North Carolina, Pennsylvania, Rhode Island, Virginia, West Virginia, Vermont who are 21 years of age or older at the time of entry.  Void where prohibited or restricted by law.    Employees of the following entities and members of their families or households are not eligible for participation under any circumstances: Diageo Americas, Inc. and its respective affiliates, printers, advertising and promotion agencies, alcohol beverage suppliers, importers, wholesalers, distributors or retailers.   All federal, state and local laws apply.</li>
<li>General Conditions:  Entry in the Contest constitutes an entrant's full and unconditional agreement to abide by and accept the terms and conditions of these Official Rules.  No substitution of prize or cash equivalent except at Sponsor's sole discretion.  Cash equivalent may be less than the approximate retail value of the prize. Prize is non-transferable except at the sole discretion of the Sponsor.  All federal, state and local taxes on the prize are winner's sole responsibility.  By accepting the prize, winner waives the right to assert as a cost of winning said prize, any and all costs of redemption or travel to redeem said prize and any and all liability that might arise from redeeming or seeking said prize.  Sponsor reserves the right to conduct a background check of any criminal records of the prizewinner.  To the extent necessary and permitted by law, prizewinner shall authorize this background check.  Sponsor reserves the right, at its sole discretion, to disqualify prizewinner from any prize element, based on the background check.     Winner also accepts sole responsibility for any miscellaneous costs relating to acceptance of prize.
<br /><br />
Entrants hereby agree to indemnify and hold Sponsor harmless from and against any third party claims, actions or proceedings of any kind and from any and all damages, liabilities, costs and expenses, including attorney fees and court costs, arising out of any breach or alleged breach of any of the warranties and representations set forth above.
<br /><br />
The value of the prize won by a participant under the contest may be taxable as income to its winner.  Winner is solely responsible for any and all taxes and/or fees associated with the prize.  Winner will be issued an IRS Form W-9 with the Affidavit of Eligibility and Release and a subsequent IRS Form 1099.  Upon receipt of a prize, the winner shall be required to comply with any and all applicable federal, state and local law, rules and regulations.
<br /><br />
In consideration of the undersigned's receipt of any prize,  prizewinner for himself or herself and his or her guests, heirs, personal representatives and assigns shall voluntarily and knowingly completely and forever shall release, waive and discharge Sponsor and all related parties from and against any and every kind of claim, demand, injury, costs, attorney fees, right, liability or cause of action or other liabilities of whatever kind or nature, known or unknown, absolute or contingent, and whether or not fixed, which the prize winner ever had, now has or might in the future have arising in any way or related to this Contest, including, but not limited to, prize winner's participation in the Contest; prize winner's Contest entry; use of prize winner's name, likeness, biographical information, signature, image or likeness; prize winner's receipt, use or inability to use any prize or part thereof, including but not limited to injury or loss sustained in any travel related to the prize; financial claims; physical and/or emotional injury; and/or any other legal claim that may arise, whether under contract, tort, warranty or any other theory or claim.
<br /><br />
Sponsor shall have the right, in its sole discretion, to abbreviate, modify, suspend, cancel or terminate the promotion at any time without notice or further obligation.
</li>
<li>Electronic Entries:  In the event of a dispute, on-line entries will be deemed made by the authorized account holder of the e-mail address submitted at time of entry. The authorized account holder is the natural person who is assigned to the e-mail address by an Internet access provider, on-line service, or other organization that is responsible for assigning e-mail addresses. Sponsor and its agencies are not responsible for lost, late, damaged, illegible, misdirected, or incomplete entries, or for on-line entries not received due to lost, failed delayed or interrupted connections or miscommunications, or to other electronic malfunctions, delays, or errors of any kind in the transmission or receipt of entries. Sponsor is not responsible for incorrect or inaccurate entry information, whether caused by web-site visitors or by any human or technological error that may occur in the processing of entries in this Contest. Sponsor reserves the right, in its sole discretion, to cancel or suspend all or a portion of the Contest, should viruses, bugs or other causes beyond control of the Sponsor corrupt the administration, security or proper operation of the Contest. CAUTION: ANY ATTEMPT BY A PERSON TO DELIBERATELY DAMAGE ANY WEBSITE OR UNDERMINE THE LEGITIMATE OPERATION OF THIS CONTEST IS A VIOLATION OF CRIMINAL AND CIVIL LAWS AND SHOULD SUCH AN ATTEMPT BE MADE, SPONSOR RESERVES THE RIGHT TO SEEK DAMAGES FROM ANY SUCH PERSON TO THE FULLEST EXTENT PERMITTED BY LAW.</li>
<li>Winner's List:  For a list of winners, please send a self-addressed stamped envelope to: Game and Fish, 512 7th Avenue, 11th Floor, New York, NY  10018.  All requests for the winner's list must be postmarked by August 1, 2012 and received by August 7, 2012.
<br /><br />
Sponsor:  Diageo Americas, Inc., Norwalk, CT
<br /><br />
CROWN ROYAL Blended Canadian Whisky, 40% Alc/Vol. &copy; <?php the_date('Y'); ?> The Crown Royal Company, Norwalk, CT.
<br /><br />
Please Drink Responsibly</li>
				</ol>	
			</div>

		</div><!-- /end container -->
	</div><!-- /end Footer -->	
	<div class="clear">&nbsp;</div>

<p id="back-top" style="display: block;"><a href="#top"><span></span>Back to Top</a></p>
<!-- AddThis Fixed-Positioned Toolbox -->
<div class="addthis_toolbox atfixed">   
    <div class="custom_images">
        <a class="addthis_button_facebook"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/fb32.png" alt="Share to Facebook" /></a>
        <a class="addthis_button_twitter"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/tw32.png"  alt="Share to Twitter" /></a>
        <a class="addthis_button_more"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/at32.png" alt="More..." /></a>
    </div>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4de660d91dde9eba"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/ageblock.js"/></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/ageblock.min.js"/></script>
<?php wp_footer(); ?>
</body>
</html>