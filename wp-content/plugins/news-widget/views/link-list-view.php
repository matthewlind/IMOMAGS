<?php echo $before_widget ?>
<?php if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; ?>

<!-- Widget Content start -->
<ul>
<?php foreach($entries as $entry): ?>
	<li><a href="<?php echo $entry->link; ?>" target="_blank"><?php echo $entry->title ?></a></li>
<?php endforeach; ?>
</ul>
<!-- Widget Content end -->

<?php echo $after_widget ?>