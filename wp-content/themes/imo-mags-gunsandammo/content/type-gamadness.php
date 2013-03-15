<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }
$id = get_the_ID();

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
			<h4>Related Articles</h2>
			<ul>
				<li><a href="<?php echo get_post_meta($id, 'ecpt_poll-related-url', true); ?>" target="_blank"><?php echo get_post_meta($id, 'ecpt_poll-related-title', true); ?></a></li>
				<li><a href="<?php echo get_post_meta($id, 'ecpt_poll-related-url-2', true); ?>" target="_blank"><?php echo get_post_meta($id, 'ecpt_poll-related-title-2', true); ?></a></li>
			</ul>
		</div>
		<div class="maddness-contest-enter"><h3>6 Rounds, 6 Chances to Win!</h3></div>
	</div>

</div>