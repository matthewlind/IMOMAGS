<?php echo $before_widget ?>
<?php if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; ?>

<!-- Widget Content start -->
<ul>
<?php foreach($entries as $entry): ?>
	<li>
		<img src="<?php echo $entry->image ?>" alt="<?php echo $entry->title ?>" width="40" height="40" style="margin: 0 10px 10px 0; float: left" />
		<div><strong><a href="<?php echo $entry->link; ?>"><?php echo $entry->title ?></a></strong></div>
		<div><i><?php echo $this->readable_time($entry->publishedDate) ?></i></div>
	</li>
<?php endforeach; ?>
</ul>
<!-- Widget Content end -->

<?php echo $after_widget ?>