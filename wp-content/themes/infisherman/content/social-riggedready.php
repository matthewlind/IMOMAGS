<div class="social-buttons">
	<ul>
		<li><a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>&title=<?php if(is_category("rigged-and-ready")){ echo "Shoot101: A starter's guide every new shooter should read."; }else{ print(urlencode(the_title())); } ?>" class="icon-facebook" target="_blank"></a></li>
		<li><a href="http://twitter.com/intent/tweet?status=<?php if(is_category("rigged-and-ready")){ echo "Shoot101: A starter's guide every new shooter should read."; }else{ print(urlencode(the_title())); } ?>+<?php echo site_url() . $_SERVER['REQUEST_URI']; ?>" class="icon-twitter" target="_blank"></a></li>
		<li><a href="mailto:?subject=Article I came across&body=Check out this article! Title: '<?php the_title(); ?>'. Link: <?php the_permalink(); ?>" class="icon-mail" target="_blank"></a></li>
	</ul>
</div>