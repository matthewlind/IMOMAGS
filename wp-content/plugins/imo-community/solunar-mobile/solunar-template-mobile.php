<!doctype html>
<!--[if IEMobile 7 ]><html class="no-js iem7" lang="en"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>Best Times</title>
    <meta name="description" content="">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=320.1, initial-scale=1, user-scalable=no">



    <meta http-equiv="cleartype" content="on">

    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="wp-content/plugins/imo-community/solunar-mobile/images/h/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="wp-content/plugins/imo-community/solunar-mobile/images/m/apple-touch-icon.png">
    <link rel="apple-touch-icon-precomposed" href="wp-content/plugins/imo-community/solunar-mobile/images/l/apple-touch-icon-precomposed.png">



    <link rel="apple-touch-startup-image" href="wp-content/plugins/imo-community/solunar-mobile/images/startup_iphone5.jpg" media="screen and (device-height: 568px)">
    <link rel="apple-touch-startup-image" href="wp-content/plugins/imo-community/solunar-mobile/images/startup_iphone4.jpg" media="screen and (device-height: 480px) and (min-device-pixel-ratio: 2)">
    <link rel="apple-touch-startup-image" href="wp-content/plugins/imo-community/solunar-mobile/images/startup_iphone4.jpg" media="screen and (device-height: 480px)">



    <link rel="shortcut icon" href="wp-content/plugins/imo-community/solunar-mobile/images/l/apple-touch-icon.png">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />


    <link rel="stylesheet" href="wp-content/plugins/imo-community/solunar-mobile/css/styles.css">

<!-- Begin comScore Tag -->
<script>
document.write(unescape("%3Cscript src='" + (document.location.protocol == "https:" ? "https://sb" : "http://b")
+ ".scorecardresearch.com/beacon.js' %3E%3C/script%3E"));
</script>
<script>
COMSCORE.beacon({
c1:2,
c2:"8031814",
c3:"",
c4:"",
c5:"",
c6:"",
c15:""
});
</script>
<noscript>
<img src="http://b.scorecardresearch.com/p?c1=2&c2=8031814&c3=&c4=&c5=&c6=&c15=&cj=1" />
</noscript>
<!-- End comScore Tag -->
<script type='text/javascript' src='/wp-content/plugins/imo-community/solunar/js/googletag.js?ver=1.0'></script>
</head>

<body>
    <!-- *********************************************************** -->
    <!-- ***************** ***** TEMPLATES   ******* *************** -->
    <!-- *********************************************************** -->
<script type='text/template' id="form-template">
<div class="wood-bg form-bg">
    <div class="wrapper">
        <div class="solunar-cal">
            <h1 class="fisher-logo">In-Fisherman Solunar Calendar</h1>
            <div class="presented-by">
                <span>brought to you by</span><a href="http://www.lazertrokar.com"><img height="30" alt="cabelas" src="wp-content/plugins/imo-community/solunar-mobile/images/trokar.png"></a>
            </div>
            <div class="cal-form jq-custom-form">
                <div class="single-calendar">
                    <div class="f-row">
                        <label for="sel1">I’ll be going</label>
                        <select class="sel fish-select" id="sel1">
                            <option value="bass">Bass</option>
                            <option value="walleye">Walleye</option>
                            <option value="catfish">Catfish</option>
                            <option value="panfish">Panfish</option>
                            <option value="pike-muskie">Pike & Muskie</option>
                            <option value="trout-salmon">Trout & Salmon</option>
                            <option value="other-fish">Other Fish</option>
                            <option value="ice-fishing">Ice</option>
                        </select>
                    </div>
                    <div class="f-row">
                        <label for="zip">fishing in or near</label>
                        <div class="location-hold">
                            <input class="zip-text" type="text" placeholder="your location" />
                            <!-- <a href="#" class="gps-icon">gps</a> -->
                        </div>
                    </div>
                    <p class="form-text">enter <b>ZIP Code</b> or <b>City, ST</b><!-- or tap the <b>GPS Icon</b> --></p>
                </div>
                <div class="check-row" style="display:none;">
                    <input type="checkbox" checked="checked" id="getFishingRem" />
                    <label for="getFishingRem">Get Fishing Reminders for this location</label>
                </div>
                <input class="btn-submit fish-submit" type="submit" value="Submit" />
            </div>
        </div>
        <div class="btm-section">
            <p>Visit <a href="http://www.in-fisherman.com">In-Fisherman.com</a>, the World’s <br />Foremost Authority on Freshwater Fishing</p>
        </div>
    </div>

    <div class="popup install-popup" style="display:none;">
        <img class="popup-icon" src="/wp-content/plugins/imo-community/solunar-mobile/images/h/apple-touch-icon.png" width="70" height="65" alt="" />
        <p class="p-descript">Install this web app on your phone. Tap on the arrow and then <b>'Add to Home Screen'.</b></p>
        <a href="#" class="close-popup">x</a>
    </div>

</div>
</script>

    <!-- *********************************************************** -->
    <script type="text/template" id="mini-day-template">


        <div class="fishday jq-expand-day fishday-level<%= data.peakcode %> <%= data.today %>">
            <a href="#cal-item-<%= data.day %>" class="a-event jq-expand-link date-scroll-link">
                <em class="c-date"><%= data.day %></em>
                <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/cal<%= data.mooncode %>.png" width="16" height="16" alt="" /></span>

            </a>
        </div>


    </script>

    <!-- *********************************************************** -->

<script type="text/template" id="full-day-template">
                <li class="cal-item clearfix jq-expand-day cal-item-<%= data.day %>" id="cal-item-<%= data.day %>">
                    <a href="#day<%= data.day %>" class="cal-frame jq-expand-link">
                        <div class="day-item">
                            <span><%= data.weekday %></span>
                            <em><%= data.day %></em>
                        </div>
                        <div class="day-descript">
                            <ul class="day-data">
                                <li class="best-p" ><%= data.times[0].start %> - <%= data.times[0].end %></li>
                                <li class="best-p"><%= data.times[1].start %> - <%= data.times[1].end %></li>
                                <li class="major-p"><%= data.times[2].start %> - <%= data.times[2].end %></li>
                            </ul>
                        </div>
                    </a>
                    <div id="day<%= data.day %>" class="day-expandable">
                        <div class="expandable-frame">
                            <ul class="phase-data sunrise-data">
                                <li><%= data.sunrise %><span>A</span></li>
                                <li><%= data.sunset %><span>P</span></li>
                            </ul>
                            <ul class="phase-data moonrise-data">
                                <li><%= data.moonrise %></li>
                                <li><%= data.moonset %></li>
                            </ul>
  <!--                           <ul class="phase-data weather-data">
                                <li><b>Partly Sunny</b></li>
                                <li>46° / 34°</li>
                            </ul>

                            <ul class="phase-data moon-data">
                                <li>66%</li>
                                <li>Waningv</li>
                            </ul> -->
                        </div>
                    </div>
                    <img class="moon-ico" src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon<%= data.mooncode %>.png" width="36" height="35" alt="" />
                    <span class="indicator fishday-level<%= data.peakcode %>"></span>
                </li>
</script>



<script type="text/template" id="post-exerpt-template">
    <li class="post clearfix">
        <a href="<%= data.post_url %>" class="post-thumb"><img src="<%= data.img_url %>" width="84" height="56" alt="" /></a>
        <div class="post-text">
            <h2><a href="<%= data.post_url %>"><%= data.post_title %></a></h2>
            <em class="published"><%= data.post_nicedate %></em>
        </div>
    </li>
</script>

    <!-- *********************************************************** -->



<div class="wrapper main-wrapper" style="display:none;">
    <div class="mdl-section">
        <div class="header clearfix">
            <div class="clearfix">
                <strong class="head-location"><a href="#">Your Location</a></strong>
                <div class="open-menu">
                    <a class="jq-open-legend" href="javascript:">Menu</a>
                </div>
                <a class="open-btn jq-close-posts" href="javascript:"></a>
            </div>
        </div>
        <div class="main">
            <div class="expand-posts">
                <ul class="post-list" id="related-fishing-posts">
                    <li class="post clearfix">
                        <a href="#" class="post-thumb"><img src="wp-content/plugins/imo-community/solunar-mobile/images/photo/night-fishing.jpg" width="84" height="56" alt="" /></a>
                        <div class="post-text">
                            <h2><a href="#">Night Fishing King Salmon</a></h2>
                            <em class="published">December 20, 2011</em>
                        </div>
                    </li>
                    <li class="post clearfix">
                        <a href="#" class="post-thumb"><img src="wp-content/plugins/imo-community/solunar-mobile/images/photo/stealth.jpg" width="84" height="56" alt="" /></a>
                        <div class="post-text">
                            <h2><a href="#">Stealth and Steel</a></h2>
                            <em class="published">December 9, 2011</em>
                        </div>
                    </li>
                    <li class="post clearfix">
                        <a href="#" class="post-thumb"><img src="wp-content/plugins/imo-community/solunar-mobile/images/photo/target-tyee.jpg" width="84" height="56" alt="" /></a>
                        <div class="post-text">
                            <h2><a href="#">Target Tyee</a></h2>
                            <em class="published">December 9, 2011</em>
                        </div>
                    </li>
                </ul>

                <!-- <a href="#" class="btn-base btn-load">Load More...</a> -->
                <p class="btm-list-txt">Visit <a href="http://www.in-fisherman.com">In-Fisherman.com</a> for more <br />great fishing tips, tricks and articles</p>
            </div>


            <div class="main-content-area">


                <div class="month-heading">
                    <a href="#" class="arrow prev">prev</a>
                    <a href="#" class="arrow next">next</a>
                    <h2><a href="#" class="jq-view-month"><span class="month-name">September</span> <img height=20 width=20 src="wp-content/plugins/imo-community/solunar-mobile/images/ico/arrow_down.png"></a></h2>
                </div>
                <div class="padding-div"></div>
                <div class="calendar-holder">
                    <table class="calendar-data">
                    <tbody>
                        <tr>
                            <td class="other-month"><div></div></td>
                            <td class="other-month"><div></div></td>
                            <td class="other-month"><div></div></td>
                            <td class="other-month"><div></div></td>
                            <td class="other-month"><div></div></td>
                            <td class="other-month"><div></div></td>
                            <td>
                                <div class="fishday-red jq-expand-day">
                                    <a href="#day1" class="a-event jq-expand-link">
                                        <em class="c-date">1</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fishday-red jq-expand-day">
                                    <a href="#day2" class="a-event jq-expand-link">
                                        <em class="c-date">2</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td class="active">
                                <div class="fishday-orange jq-expand-day">
                                    <a href="#day3" class="a-event a-today jq-expand-link">
                                        <em class="c-date">3</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="fishday-orangelight jq-expand-day">
                                    <a href="#day4" class="a-event jq-expand-link">
                                        <em class="c-date">4</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="fishday-yellow jq-expand-day">
                                    <a href="#day5" class="a-event jq-expand-link">
                                        <em class="c-date">5</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class=" jq-expand-day">
                                    <a href="#day6" class="a-event jq-expand-link">
                                        <em class="c-date">6</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class=" jq-expand-day">
                                    <a href="#day7" class="a-event jq-expand-link">
                                        <em class="c-date">7</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="fishday-orangelight jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">8</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class=" jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">9</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class=" jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">10</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class=" jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">11</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="fishday-yellow jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">12</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="fishday-orangelight jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">13</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="fishday-orange jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">14</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="fishday-red jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">15</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fishday-red jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">16</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="fishday-orange jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">17</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="fishday-orangelight jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">18</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="fishday-yellow jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">19</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class=" jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">20</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class=" jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">21</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class=" jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">22</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fishday-orangelight jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">23</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class=" jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">24</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class=" jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">25</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class=" jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">26</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class=" jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">27</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="fishday-yellow jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">28</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="fishday-orangelight jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">29</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="fishday-orange jq-expand-day">
                                    <a href="#" class="a-event jq-expand-link">
                                        <em class="c-date">30</em>
                                        <span class="ico-solunar"><img src="wp-content/plugins/imo-community/solunar-mobile/images/ico/moon-small.png" width="16" height="16" alt="" /></span>

                                    </a>
                                </div>
                            </td>
                            <td class="other-month"><div></div></td>
                            <td class="other-month"><div></div></td>
                            <td class="other-month"><div></div></td>
                            <td class="other-month"><div></div></td>
                            <td class="other-month"><div></div></td>
                            <td class="other-month"><div></div></td>
                        </tr>
                    </tbody>

                    </table>
                </div>
                <ul class="cal-list">

                </ul>



            </div>




        </div>
        <div class="fadeout"></div>
        <div class="popup">
            <h2 class="popup-title">Legend</h2>
            <ul class="day-data">
                <li class="best-p">=  Best  Time to Fish</li>
                <li class="major-p">=  Good Time to Fish</li>
<!--                 <li class="minor-p">=  Good Time to Fish</li> -->
            </ul>
            <div class="chart">
                    <img src="wp-content/plugins/imo-community/solunar/images/fishing-chart.png" width="206" height="16" alt="">
                    <div class="clearfix">
                        <span style="padding-right:76px">Good Day...</span>
                        <strong>Great Day!</strong>
                    </div>
                </div>
            <a href="#" class="close-popup">x</a>
        </div>
    </div>
    <div class="footer clearfix jq-open-posts">
        <strong class="f-title">Trout &amp; Salmon Tips</strong>
        <a href="#" class="view-month ">view</a>
    </div>
</div>

<script src="wp-content/plugins/imo-community/solunar-mobile/js/libs/jquery-2.0.1.min.js"></script>
<script src="wp-content/plugins/imo-community/solunar-mobile/js/plugins/zfselect/js/jquery.mousewheel.js"></script>
<script src="wp-content/plugins/imo-community/solunar-mobile/js/plugins/zfselect/js/jquery.zfselect.min.js"></script>
<script src="wp-content/plugins/imo-community/solunar-mobile/js/plugins/ezMark/js/jquery.ezmark.min.js"></script>
<link rel="stylesheet" href="wp-content/plugins/imo-community/solunar-mobile/js/plugins/zfselect/css/zfselect.css">
<link rel="stylesheet" href="wp-content/plugins/imo-community/solunar-mobile/js/plugins/ezMark/css/ezmark.css">
<script type='text/javascript' src='/wp-content/plugins/imo-community/solunar/js/lodash.min.js?ver=1.0'></script>
<script src="wp-content/plugins/imo-community/solunar-mobile/js/libs/jquery.cookie.js"></script>
<script src="wp-content/plugins/imo-community/solunar-mobile/js/helper.js"></script>
<script src="wp-content/plugins/imo-community/solunar-mobile/js/script.js"></script>
<script src="wp-content/plugins/imo-community/solunar-mobile/js/app.js"></script>

</body>
</html>
