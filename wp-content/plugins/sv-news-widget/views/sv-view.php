<?php echo $before_widget ?>
<?php if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; ?>

<!-- Widget Content start -->
<style type="text/css">
.widget_sv-news-widget{
	background: none #143e74 !important;
	margin: 0 auto;
}
.widget_sv-news-widget .header{
	background: url("/wp-content/plugins/news-widget/assets/sv-news-widget/sv-news-header.jpg") no-repeat scroll center center transparent;
    height: 129px;
    width: 300px;
}
.widget_sv-news-widget ul{
	list-style: none;
	border-bottom: 5px solid #c02c2a;
	border-top: 5px solid #c02c2a;
	background-color: #fff;
	margin: 0 auto;
	width: 292px;
	padding: 0;
}
.widget_sv-news-widget li{
	border-top: dashed 1px #c8c8c8;
	border-bottom: dashed 1px #c8c8c8;
	padding: 8px;
	line-height: 1.2;
	margin: 0;
}
.widget_sv-news-widget li a{
	color: #3a3a3a;
	font-family: "Helvetica Nueue", Helvetica, Arial, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.widget_sv-news-widget li a:hover{
	color: #143e74;
}
.widget_sv-news-widget .footer{
	width: 292px;
	height: 61px;
	background: url("/wp-content/plugins/news-widget/assets/sv-news-widget/sv-horn.png") no-repeat 8px center;
}
.widget_sv-news-widget .footer a{
	color: #fff;
	font-family: "Trajan Pro",serif;
	margin: 0 0 0 48px;
	position: relative;
	top: 20px;
}
</style>

<div class="header"></div>
<ul>
<?php foreach($entries as $entry): ?>
	<li><a href="<?php echo $entry->link; ?>" target="_blank"><?php echo $entry->title ?></a></li>
<?php endforeach; ?>
</ul>
<div class="footer">
	<a href="http://sportsmenvote.com/newsletter-signup">Sign Up For Weekly Alerts!</a>
</div>
<!-- Widget Content end -->

<?php echo $after_widget ?>