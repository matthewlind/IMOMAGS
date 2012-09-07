<?php echo $before_widget ?>
<?php if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; ?>

<!-- Widget Content start -->
<ul>
<?php foreach($entries as $entry): ?>
	<li>
		<h4><?php echo $entry->title ?></h4>
		<p>
			<?php echo $entry->contentSnippet ?>
			<a href="<?php echo $entry->link; ?>" target="_blank">Read more</a>
		</p>
	</li>
<?php endforeach; ?>
</ul>
<!-- Widget Content end -->

<?php echo $after_widget ?>