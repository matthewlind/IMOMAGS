<?php

/**
 * Template Name: Mobile Contest Page 
 * Description: A page for moblie NAW contests	
 *
 * @package carrington-business
 *
 * This file is part of the Carrington Business Theme for WordPress
 * http://crowdfavorite.com/wordpress/themes/carrington-business/
 *
 * Copyright (c) 2008-2011 Crowd Favorite, Ltd. All rights reserved.
 * http://crowdfavorite.com
 *
 * **********************************************************************
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * **********************************************************************
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }


the_post();
?>
<html>
	<head>
		<title><?php the_title(); ?></title>
		<link rel='stylesheet' id='mobile-css'  href='/wp-content/themes/carrington-business/css/mobile-page.css' type='text/css' media='all' />
		<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
  <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5816642-20']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);
  _gaq.push(['_setAccount', 'UA-2409437-15']);
  _gaq.push(['_setDomainName', '.northamericanwhitetail.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

			
	</head>
	<body>
			
		<div id="container">
			

			<div id="content_container">

				<div class="col-abc">
					<div <?php post_class('entry entry-full clearfix'); ?>>
						<div class="entry-content">
							<?php
							the_content(__('Continued&hellip;', 'carrington-business'));
							wp_link_pages();
							?>
						</div>
					</div><!-- .entry -->
				
				</div><!-- .col-abc -->
			</div>
		</div>
	</body>
</html>
