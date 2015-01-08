<?php echo $before_widget ?>
<?php if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; ?>

<!-- Widget Content start -->
<a href="http://thesportsmanchannel.com/press" target="_blank"><div class="tsc-news-header"></div></a>
<ul class="tsc-news-widget">
<?php foreach($entries as $entry): ?>
	<li>
		<a class="image-adjust" href="<?php echo $entry->link; ?>" target="_blank" onclick="_gaq.push(['_trackEvent','TSC News Widget','<?php echo $entry->link; ?>']);"><img src="<?php echo $entry->image ?>" alt="<?php echo $entry->title ?>" /></a>
		<div><strong><a href="<?php echo $entry->link; ?>" target="_blank" onclick="_gaq.push(['_trackEvent','TSC News Widget','<?php echo $entry->link; ?>']);"><?php echo $entry->title ?></a></strong></div>
	</li>
<?php endforeach; ?>
<li class="tsc-more-link">
	<a href="http://thesportsmanchannel.com/get" target="_blank" onclick="_gaq.push(['_trackEvent','TSC News Widget','Get Sportsman']);">Get Sportsman</a>
	<a href="http://thesportsmanchannel.com/press" target="_blank" onclick="_gaq.push(['_trackEvent','TSC News Widget','More Headlines']);">More Headlines</a>
	
</li>
</ul>
<div class="ad-sponsor"></div>
<!-- Widget Content end -->

<?php echo $after_widget ?>