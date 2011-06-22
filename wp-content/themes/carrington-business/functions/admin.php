<?php
/**
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

$cfct_options[] = 'cfctbiz_blog_title';
$cfct_options[] = 'cfctbiz_news_title';
$cfct_options[] = 'cfctbiz_legal_footer';
$cfct_options[] = 'cfctbiz_login_link_enable';
$cfct_options[] = 'cfctbiz_news_enable';

unset($cfct_options['cfct_about_text']);

function cfct_biz_settings_form_top() {
	$options = array(
		'yes' => __('Yes', 'carrington-business'),
		'no' => __('No', 'carrington-business'),
	);
	$news_options = '';
	foreach ($options as $k => $v) {
		$news_options .= "\n\t<option value='$k' ".selected($k, get_option('cfctbiz_news_enable'), false).">$v</option>";
	}
	$login_options = '';
	foreach ($options as $k => $v) {
		$login_options .= "\n\t<option value='$k' ".selected($k, get_option('cfctbiz_login_link_enable'), false).">$v</option>";
	}
	$html = '
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><b>'.__('Theme Features', 'carrington-business').'</b></td>
					<td>
						<fieldset>
							<p>
								<label for="cfctbiz_news_enable">'.__('Enable News Section:', 'carrington-business').'</label>
								<select name="cfctbiz_news_enable" id="cfctbiz_news_enable">'.$news_options.'</select>
							</p>
							<p>
								<label for="cfctbiz_news_title">'.__('News Title:', 'carrington-business').'</label>
								<br />
								<input type="text" name="cfctbiz_news_title" id="cfctbiz_news_title" value="'.esc_attr(get_option('cfctbiz_news_title')).'" size="30" />
								<span class="help">'.__('(shown in header of News section)', 'carrington-business').'</span>
							</p>
							<p>
								<label for="cfctbiz_blog_title">'.__('Blog Title:', 'carrington-business').'</label>
								<br />
								<input type="text" name="cfctbiz_blog_title" id="cfctbiz_blog_title" value="'.esc_attr(get_option('cfctbiz_blog_title')).'" size="30" />
								<span class="help">'.__('(shown in header of Blog section)', 'carrington-business').'</span>
							</p>
							<p>
								<label for="cfctbiz_legal_footer">'.__('Legal text in footer area:', 'carrington-business').'</label>
								<br />
								<input type="text" name="cfctbiz_legal_footer" id="cfctbiz_legal_footer" value="'.esc_attr(get_option('cfctbiz_legal_footer')).'" size="30" /> <span class="help">'.__('(add %Y to output the current year)', 'carrington-business').'</span>
							</p>
							<p>
								<label for="cfctbiz_login_link_enable">'.__('Enable Log In/Out Link in Footer:', 'carrington-business').'</label>
								<select name="cfctbiz_login_link_enable" id="cfctbiz_login_link_enable">'.$login_options.'</select>
							</p>
						</fieldset>
					</td>
				</tr>
			</tbody>
		</table>
		<script type="text/javascript">
		jQuery(function($) {
			$("#cfct_about_text").parent().remove();
		});
		</script>
	';
	echo $html;
}
add_action('cfct_settings_form_top', 'cfct_biz_settings_form_top');

function cfctbiz_cfct_settings_form_after() {
?>
<style type="text/css">
.help {
	color: #777;
	font-size: 11px;
}
.txt-center {
	text-align: center;
}
#cf {
	width: 90%;
}

/* Developed by and Support by callouts */
#cf-callouts {
	background: url(<?php echo get_bloginfo('template_url'); ?>/wp-admin/settings-page/border-fade-sprite.gif) 0 0 repeat-x;
	float: left;
	margin: 18px 0;
}
.cf-callout {
	float: left;
	margin-top: 18px;
	max-width: 500px;
	width: 50%;
}
#cf-callout-credit {
	margin-right: 9px;
}
#cf-callout-credit .cf-box-title {
	background: #193542 url(<?php echo get_bloginfo('template_url'); ?>/wp-admin/settings-page/box-sprite.png) 0 0 repeat-x;
	border-bottom: 1px solid #0C1A21;
}
#cf-callout-support {
	margin-left: 9px;
}
#cf-callout-support .cf-box-title {
	background: #8D2929 url(<?php echo get_bloginfo('template_url'); ?>/wp-admin/settings-page/box-sprite.png) 0 -200px repeat-x;
	border-bottom: 1px solid #461414;
}

/* General cf-box styles */
.cf-box { 
	background: #EFEFEF url(<?php echo get_bloginfo('template_url'); ?>/wp-admin/settings-page/box-sprite.png) 0 -400px repeat-x;
	border: 1px solid #E3E3E3;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-khtml-border-radius: 5px;
}
.cf-box .cf-box-title {
	color: #fff;
	font-size: 14px;
	font-weight: normal;
	padding: 6px 15px;
	margin: 0 0 12px 0;
	-moz-border-radius-topleft: 5px;
	-webkit-border-top-left-radius: 5px;
	-khtml-border-top-left-radius: 5px;
	border-top-left-radius: 5px;
	-moz-border-radius-topright: 5px;
	-webkit-border-top-right-radius: 5px;
	-khtml-border-top-right-radius: 5px;
	border-top-right-radius: 5px;
	text-align: center;
	text-shadow: #333 0 1px 1px;
}
.cf-box .cf-box-title a {
	display: block;
	color: #fff;
}
.cf-box .cf-box-title a:hover {
	color: #E1E1E1;
}
.cf-box .cf-box-content {
	margin: 0 15px 15px 15px;
}
.cf-box .cf-box-content p {
	font-size: 11px;
}
</style>
	<div id="cf">
		<div id="cf-callouts">
			<div class="cf-callout">
				<div id="cf-callout-credit" class="cf-box">
					<h3 class="cf-box-title">Theme Developed By</h3>
					<div class="cf-box-content">
						<p class="txt-center"><a href="http://crowdfavorite.com/" title="Crowd Favorite : Elegant WordPress and Web Application Development"><img src="<?php echo get_bloginfo('template_url'); ?>/wp-admin/settings-page/cf-logo.png" alt="Crowd Favorite"></a></p>
						<p>An independent development firm specializing in WordPress development and integrations, sophisticated web applications, Open Source implementations and user experience consulting. If you need it to work, trust Crowd Favorite to build it.</p>
					</div><!-- .cf-box-content -->
				</div><!-- #cf-callout-credit -->						
			</div>
			<div class="cf-callout">
				<div id="cf-callout-support" class="cf-box">
					<h3 class="cf-box-title">Professional Support From</h3>
					<div class="cf-box-content">
						<p class="txt-center"><a href="http://wphelpcenter.com/" title="WordPress HelpCenter"><img src="<?php echo get_bloginfo('template_url'); ?>/wp-admin/settings-page/wphc-logo.png" alt="WordPress HelpCenter"></a></p>
						<p>Need help with WordPress right now? That's what we're here for. We can help with anything from how-to questions to server troubleshooting, theme customization to upgrades and installs. Give us a call and we'll get you taken care of - 303-395-1346.</p>
					</div><!-- .cf-box-content -->
				</div><!-- #cf-callout-support -->						
			</div>
		</div><!-- #cf-callouts -->
	</div><!-- #cf -->
<?php
}
add_action('cfct_settings_form_after', 'cfctbiz_cfct_settings_form_after');

function cfctbiz_cfct_admin_settings_title($str) {
	return __('Carrington Business Settings', 'carrington-business');
}
add_filter('cfct_admin_settings_form_title', 'cfctbiz_cfct_admin_settings_title');

function cfctbiz_cfct_admin_settings_form_title($str) {
	global $wp_version;
	return __('Carrington Business Settings', 'carrington-business').' &nbsp; <script type="text/javascript">var WPHC_AFF_ID = "14303"; var WPHC_POSITION = "c1"; var WPHC_PRODUCT = "Carrington Business Theme ('.CFCT_THEME_VERSION.')"; var WPHC_WP_VERSION = "'.$wp_version.'";</script><script type="text/javascript" src="http://cloud.wphelpcenter.com/support-form/0001/deliver-a.js"></script>';
}
add_filter('cfct_admin_settings_form_title', 'cfctbiz_cfct_admin_settings_form_title');

?>