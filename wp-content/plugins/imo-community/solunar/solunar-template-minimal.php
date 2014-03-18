<?php

/**
 * Template Name: Gear
 * Description: The NAW+ Community - Gear Category
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
// if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }


?>


<!DOCTYPE html>
<!-- bid: <?php global $blog_id; print $blog_id ?>; env: <?php if(defined("WEB_ENV")) { print WEB_ENV; } else { print "production"; } ?> -->
<!--[if IE 6]><![endif]-->
<html <?php language_attributes() ?>>
<head>
    <meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />

    <meta name="viewport" content="width=1005">

    <title><?php wp_title(''); ?></title>

    <meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
    <?php wp_get_archives(array('type' => 'monthly', 'format' => 'link')); ?>
    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if lte IE 7]>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_url'); ?>/css/lte-ie7.css?ver=<?php echo CFCT_URL_VERSION; ?>" />
    <![endif]-->

    <?php
    // Include javascript for threaded comments if needed
    if ( is_singular() && get_option('thread_comments') ) { wp_enqueue_script( 'comment-reply' ); }

    wp_head();
    //include_once get_stylesheet_directory() . "/head-includes.php";

    if (defined('GOOGLE_FONT')): ?>
    <link href='<?php print GOOGLE_FONT; ?>' rel='stylesheet' type='text/css'>
<?php endif; ?>
<link href='http://fonts.googleapis.com/css?family=Glegoo|Lato:300,400|Gudea|Share' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.jfollow.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/scripts.js"/></script>
  <script type="text/javascript" src="/wp-content/themes/imo-mags-gunsandammo/js/flash_heed.js"></script>

<?php if (defined('JETPACK_SITE')): ?>

<?php endif; ?>
</head>
<body class="ipad-solunar">

<div class="page-community">







	<!-- *********************************************************** -->
	<!-- ***************** ***** TEMPLATES   ******* *************** -->
	<!-- *********************************************************** -->
	<script type="text/template" id="td-template">


        <div class="fishday fishday-level<%= data.peakcode %> <%= data.today %>">
            <div class="a-event">
                <em class="c-date"><%= data.day %></em>
                <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar/images/ico2/moon_<%= data.mooncode %>.png" width="24" height="24" alt="" /></span>
                <ul class="day-data">
                    <li class="best-p"><%= data.times[0].start %> - <%= data.times[0].end %></li>
                    <li class="best-p"><%= data.times[1].start %> - <%= data.times[1].end %></li>
                    <li class="minor-p"><%= data.times[2].start %> - <%= data.times[2].end %></li>
                </ul>

            </div>
            <div class="cal-popup">
                <div class="cal-popup-inner">
                    <h3><%= data.weekday %> <span><%= data.monthname %> <%= data.day %></span></h3>
                    <div class="cal-row clearfix">
                        <ul class="sun-data">
                            <li><%= data.sunrise %></li>
                            <li><%= data.sunset %></li>
                        </ul>
                        <ul class="moon-data">
                            <li><%= data.moonrise %></li>
                            <li><%= data.moonset %></li>
                        </ul>
                    </div>
                    <div class="cal-row clearfix">
                        <ul class="times-list">
                            <li class="best-time-label">Best Times:</li>
                            <li>Good Time:</li>
                        </ul>
                        <ul class="day-data">
		                    <li class="best-p"><%= data.times[0].start %> - <%= data.times[0].end %></li>
		                    <li class="best-p"><%= data.times[1].start %> - <%= data.times[1].end %></li>
		                    <li class="minor-p"><%= data.times[2].start %> - <%= data.times[2].end %></li>
                        </ul>
                    </div>
                    <div class="cal-row presented-by">
<!-- Site - In-Fisherman/solunar_calendar -->

    <a href="http://ad.doubleclick.net/N4930/jump/imo.in-fisherman/solunar_calendar;sz=125x125;ord=[timestamp]?">
    <img src="http://ad.doubleclick.net/N4930/ad/imo.in-fisherman/solunar_calendar;sz=125x125;ord=[timestamp]?" width="125" height="125" />
    </a>

                    </div>
                </div>
                <a class="close-popup" href="javascript:"></a>
            </div>
        </div>



	</script>

    <script type="text/template" id="slider-template">
        <li>
            <a class="slide-thumb" href="<%= data.post_url %>"><img src="<%= data.img_url %>" width="216" height="124" /></a>
            <h3><a href="<%= data.post_url %>"><%= data.post_title %></a></h3>
            <em><%= data.post_nicedate %></em>
        </li>
    </script>




	<!-- *********************************************************** -->
	<!-- *********************************************************** -->

    <div class="frame">
        <div class="wide-banner">
            <a href="#"><img src="wp-content/plugins/imo-community/solunar/images/banner/banner-back.jpg" width="1005" alt="" /></a>
        </div>
        <div class="location-box jq-custom-form">
            <form action="#">
                <fieldset>
                    <span class="form-text">I’ll be going</span>
                    <select id="sel1" class="sel">
                        <option selected="selected" value="bass">Bass</option>
                        <option value="walleye">Walleye</option>
                        <option value="catfish">Catfish</option>
                        <option value="panfish">Panfish</option>
                        <option value="pike-muskie">Pike & Muskie</option>
                        <option value="trout-salmon">Trout & Salmon</option>
                        <option value="other-fish">Other Fish</option>
                        <option value="ice-fishing">Ice</option>
                    </select>
                    <span class="form-text">fishing near</span>
                    <input type="text" id="solunar-location" placeholder="City or ZIP Code" />
                    <input class="submit-small solunar-submit" type="submit" value="GO!" />
                </fieldset>
            </form>
            <h1 class="location-header"></h1>
        </div>
        <div class="main-calendar">
            <div class="cal-title jq-custom-form">
                <select id="month" class="sel">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>



            <div class="calendar-holder" style="">
                <table class="calendar-data">
                <thead>
                    <tr>
                        <th class="th-pros-1"><span>Sun</span></th>
                        <th class="th-pros-2"><span>Mon</span></th>
                        <th class="th-pros-3"><span>Tue</span></th>
                        <th class="th-pros-4"><span>Wed</span></th>
                        <th class="th-pros-4"><span>Thu</span></th>
                        <th class="th-pros-4"><span>Fri</span></th>
                        <th class="th-pros-4"><span>Sat</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="far-right"></td>
                        <td class="far-right"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="far-right"></td>
                        <td class="far-right"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="far-right"></td>
                        <td class="far-right"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="far-right"></td>
                        <td class="far-right"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="far-right"></td>
                        <td class="far-right"></td>
                    </tr>
                    <tr class="last-row">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="far-right"></td>
                        <td class="far-right"></td>
                    </tr>


                </tbody>

                </table>
            </div>
        </div>
        <div class="sub-widgets">
            <div class="w-col">
                <h3>Legend</h3>
                <ul class="day-data">
                    <li class="best-p"> - Best Times to Fish</li>
                    <li class="minor-p"> - Good Time to Fish</li>

                </ul>
                <div class="chart">
                    <img src="wp-content/plugins/imo-community/solunar/images/fishing-chart.png" width="294" height="16" alt="" />
                    <div class="clearfix">
                        <span>Could be better...</span>
                        <strong>Great day to fish!</strong>
                    </div>
                </div>
            </div>
            <div class="w-col">
<!--            <h3>Weekly Fishing Reminders</h3>
                <p>Get the best fishing times for Seattle, WA. <br />every week.</p>
                <div class="custom-form">
                    <form action="#">
                        <fieldset>
                            <div class="f-row">
                                <input type="text" placeholder="name" />
                            </div>
                            <div class="f-row">
                                <input type="text" placeholder="email address" />
                                <input class="submit-small" type="submit" value="GO!" />

                            </div>
                        </fieldset>
                    </form>
                </div> -->
            </div>
            <div class="w-col w-col3">
                <!-- Site - In-Fisherman/solunar_calendar -->
                <div id='div-gpt-ad-1365712045023-0'>
                <script type='text/javascript'>
                // googletag.cmd.push(function() {


                //     googletag.display('div-gpt-ad-1365712045023-0');

                // });
                </script>
                </div>
            </div>
        </div>
        <div class="gallery-block">
            <h2><span class="fishing-tips-title">Trout &amp; Salmon Fishing Tips</span></h2>
            <div class="list_carousel">
                <ul id="related-fishing-posts">

                </ul>
                <div class="clearfix"></div>
                <a id="prev2" class="gal-prev" href="#">&lt;</a>
                <a id="next2" class="gal-next" href="#">&gt;</a>
            </div>

        </div>
    </div>


</div>

<!--[if lt IE 10]>
    <script type="text/javascript" src="wp-content/plugins/imo-community/solunar/js/plugins/jquery.placeholder.min.js"></script>
    <script type="text/javascript" >
        $(function(){
            $('input[placeholder], textarea[placeholder]').placeholder();
        })
    </script>
<![endif]-->

<?php get_footer(); ?>
