<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }
$id = get_the_ID();
$campaigns = wp_get_post_terms($id,"campaign");
foreach ($campaigns as $campaign){ $camp = $campaign->name; }

$url = get_post_meta($id, 'ecpt_poll-related-url', true);
$title = get_post_meta($id, 'ecpt_poll-related-title', true);
$url2 = get_post_meta($id, 'ecpt_poll-related-url-2', true);
$title2 = get_post_meta($id, 'ecpt_poll-related-title-2', true);

?>
<div <?php post_class('entry entry-full clearfix') ?>>
	<div class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-info">
            <?php if (! in_category("What's Biting Now")): ?>
			<span class="author vcard"><span class="fn">by <?php the_author_link(); ?></span></span>
			<span class="spacer">|</span>
            <?php endif; ?>
			<time class="published" datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('F j, Y'); ?></time>
			<?php if(function_exists('wp_print')) { ?>
			<span class="spacer">|</span>
			<?php print_link(); } ?>
		</div>
	</div>
	<?php //if (function_exists('imo_add_this')) {imo_add_this();} ?>
	<div class="entry-content">
		<?php the_content(__('Continued&hellip;', 'carrington-business')); ?>
		<div class="divider"></div>
		<div class="poll-related">
			<h4>The Matchups</h2>
			<?php var_dump() ?>
			<ul>
				<?php if($title != ""){ ?><li><a href="<?php echo $url; ?>" target="_blank"><?php echo $title; ?></a></li><?php } ?>
				<?php if($title2 != ""){ ?><li><a href="<?php echo $url2; ?>" target="_blank"><?php echo $title2; ?></a></li><?php } ?>
				<?php if($title == "" && $title2 == ""){ echo "<p>There are no matchups.</p>"; } ?>
			</ul>
		</div>
		<div class="madness-contest-enter"><a href="/bracket/enter" target="_blank">
		<?php
			if($camp == "handgunsmadness"){
				echo '<img src="/wp-content/themes/imo-mags-gunsandammo/img/ga-madness-popup-galco-358x90.jpg" alt="Enter G&A Madness" />';
			}else if($camp == "shotgunsmadness"){
				echo '<img src="/wp-content/themes/imo-mags-gunsandammo/img/ga-madness-popup-wardog-358x90.jpg" alt="Enter G&A Madness" />';
			}else if($camp == "riflesmadness"){
				echo '<img src="/wp-content/themes/imo-mags-gunsandammo/img/ga-madness-zeiss-358x90.jpg" alt="Enter G&A Madness" />';
			}else if($camp == "arsmadness"){
				echo '<img src="/wp-content/themes/imo-mags-gunsandammo/img/ga-madness-358x90.jpg" alt="Enter G&A Madness" />';
			}		
		?>
		</a></div>
		<div class="vote-ad">
			<iframe id="poll-ad-iframe" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/iframe-bracket-ad.php?ad_code=imo.gunsandammo&size=728x90&camp=<?php echo $camp; ?>" width=736 height=106></iframe>
		</div>	
	</div>
</div>