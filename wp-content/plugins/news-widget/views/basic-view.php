<?php echo $before_widget ?>
<?php if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; ?>

<!-- Widget Content start -->
<ul>
<?php foreach($entries as $entry): ?>
	<li>
		<h4><a href="<?php echo $entry->link; ?>"><?php echo $entry->title ?></a></h4>
		<p>
			<?php echo $entry->contentSnippet ?>
			<i><?php echo $this->readable_time($entry->publishedDate) ?> on <a href="<?php echo $entry->websiteUrl; ?>"><?php echo $entry->websiteTitle; ?></a></i>
		</p>
		
	</li>
<?php endforeach; ?>
</ul>
<!-- Widget Content end -->

<?php echo $after_widget ?>