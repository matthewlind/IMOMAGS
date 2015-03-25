<div class="m-social-wrap">
	<p class="m-hlep-grow">Help Grow Shooting in America. Share this with a new shooter!</p>
	<div class="m-social-buttons">
		<ul>
			<li><a class="icon-facebook" target="_blank" href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo urlencode(the_title());?>&amp;p[summary]=<?php echo urlencode(the_title()) ?>&amp;p[url]=<?php echo urlencode(get_permalink()); ?>&amp;p[images][0]=<?php echo urlencode($image[0])?>" ></a></li>
			<li><a href="http://twitter.com/intent/tweet?status=<?php print(urlencode(the_title())); ?>+<?php print(urlencode(get_permalink())); ?>" class="icon-twitter" target="_blank"></a></li>
			<li><a class="icon-mail" target="_blank"></a></li>
		</ul>
	</div>
</div><!-- end .m-social-wrap -->