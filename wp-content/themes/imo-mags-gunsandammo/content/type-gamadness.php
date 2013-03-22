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
		<div class="madness-contest-enter">
			
		<?php
			if($camp == "handgunsmadness"){ ?>
				
				<!-- Site - Guns and Ammo/Brackets -->
				<script type="text/javascript">
				  var ord = window.ord || Math.floor(Math.random() * 1e16);
				  document.write('<iframe src="http://ad.doubleclick.net/N4930/adi/imo.gunsandammo/Brackets;sect=bracket;manf=;page=ga_madness;camp=handgunsmadness;sz=358x90;ord=' + ord + '?" width="358" height="90" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>');
				</script>
				<noscript>
				<a href="http://ad.doubleclick.net/N4930/jump/imo.gunsandammo/Brackets;sect=bracket;manf=;page=ga_madness;camp=handgunsmadness;sz=358x90;ord=[timestamp]?">
				<img src="http://ad.doubleclick.net/N4930/ad/imo.gunsandammo/Brackets;sect=bracket;manf=;page=ga_madness;camp=handgunsmadness;sz=358x90;ord=[timestamp]?" width="358" height="90" />
				</a>
				</noscript>
				
			<?php }else if($camp == "shotgunsmadness"){ ?>

			<!-- Site - Guns and Ammo/Brackets -->
			<script type="text/javascript">
			  var ord = window.ord || Math.floor(Math.random() * 1e16);
			  document.write('<iframe src="http://ad.doubleclick.net/N4930/adi/imo.gunsandammo/Brackets;sect=bracket;manf=;page=ga_madness;camp=shotgunsmadness;sz=358x90;ord=' + ord + '?" width="358" height="90" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>');
			</script>
			<noscript>
			<a href="http://ad.doubleclick.net/N4930/jump/imo.gunsandammo/Brackets;sect=bracket;manf=;page=ga_madness;camp=shotgunsmadness;sz=358x90;ord=[timestamp]?">
			<img src="http://ad.doubleclick.net/N4930/ad/imo.gunsandammo/Brackets;sect=bracket;manf=;page=ga_madness;camp=shotgunsmadness;sz=358x90;ord=[timestamp]?" width="358" height="90" />
			</a>
			</noscript>
			
			<?php }else if($camp == "riflesmadness"){ ?>
				
				<!-- Site - Guns and Ammo/Brackets -->
				<script type="text/javascript">
				  var ord = window.ord || Math.floor(Math.random() * 1e16);
				  document.write('<iframe src="http://ad.doubleclick.net/N4930/adi/imo.gunsandammo/Brackets;sect=bracket;manf=;page=ga_madness;camp=riflesmadness;sz=358x90;ord=' + ord + '?" width="358" height="90" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>');
				</script>
				<noscript>
				<a href="http://ad.doubleclick.net/N4930/jump/imo.gunsandammo/Brackets;sect=bracket;manf=;page=ga_madness;camp=riflesmadness;sz=358x90;ord=[timestamp]?">
				<img src="http://ad.doubleclick.net/N4930/ad/imo.gunsandammo/Brackets;sect=bracket;manf=;page=ga_madness;camp=riflesmadness;sz=358x90;ord=[timestamp]?" width="358" height="90" />
				</a>
				</noscript>

			<?php }else if($camp == "arsmadness"){ ?>
			
				<!-- Site - Guns and Ammo/Brackets -->
				<script type="text/javascript">
				  var ord = window.ord || Math.floor(Math.random() * 1e16);
				  document.write('<iframe src="http://ad.doubleclick.net/N4930/adi/imo.gunsandammo/Brackets;sect=bracket;manf=;page=ga_madness;camp=arsmadness;sz=358x90;ord=' + ord + '?" width="358" height="90" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>');
				</script>
				<noscript>
				<a href="http://ad.doubleclick.net/N4930/jump/imo.gunsandammo/Brackets;sect=bracket;manf=;page=ga_madness;camp=arsmadness;sz=358x90;ord=[timestamp]?">
				<img src="http://ad.doubleclick.net/N4930/ad/imo.gunsandammo/Brackets;sect=bracket;manf=;page=ga_madness;camp=arsmadness;sz=358x90;ord=[timestamp]?" width="358" height="90" />
				</a>
				</noscript>

			<?php }	?>
		</div>
		<div class="vote-ad">
			<iframe id="poll-ad-iframe" src="http://<?php echo $_SERVER['SERVER_NAME']; ?>/iframe-bracket-ad.php?ad_code=imo.gunsandammo&size=728x90&camp=<?php echo $camp; ?>" width=736 height=106></iframe>
		</div>	
	</div>
</div>