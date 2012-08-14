<?php

/**
 * Template Name: Recon Reports
 * Description: Display a bunch of recon reports
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

get_header();

$requestURL = "http://www.northamericanwhitetail.deva/slim/api/superpost/type/report";

$file = file_get_contents($requestURL);
$data = json_decode($file);


?>
<header id="masthead">
    <h1>RECON NETWORK: Reports</h1>
    <?php edit_post_link(__('Edit', 'carrington-business')); ?>
</header><!-- #masthead -->
<div class="bonus-background">
    <div class="bonus">
        <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-landing')) : else : ?><?php endif; ?>
    </div>
</div>
<div class="col-abc">
    <div <?php post_class('entry entry-full clearfix'); ?>>
        <div class="entry-content">


<script type="text/javascript">
         
    </script>

        <div class="main">
            <div class="container">
                <header>
                    <div class="page-header">
                        <h1 class="welcome-header">Welcome to Animal Post!</h1>
                    </div>




                </header>
            </div>
            <div class="container-fluid">
                <div class="row-fluid">
                    <form id="post-report-form" method="POST" action="/slim/api/superpost/add" enctype="multipart/form-data" class="superpost-form">
                                <h3>Post a Report!</h3>
                                <input type="text" name="title">
                                <textarea name="body" id="body" placeholder="What do you want to say?"></textarea>
                                <select name="state">
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                </select>
                                <input type="file" id="photo-upload" name="photo-upload"  /><br/>    
                                <input type="hidden" name="post_type" value="report">
                                <input type="hidden" name="clone_target" value="superpost-box">
                                <input type="hidden" name="attach_target" value="post-container">
                                <input type="hidden" name="attachment_point" value="prepend">
                                <input type="hidden" name="masonry" value="false">
                                <input type="hidden" name="form_id" value="post-report-form">
                                <input type="submit" value="Submit" class="submit" />
                            </form>
                        
                    <div class="post-container">
                       
                             

                      <?php foreach ($data as $superpost): ?>
                            <div class='superpost-box'>
                                <h3 class="superclass-title"><?php echo $superpost->title; ?></h3>
                                <div class='superclass-body'><?php echo $superpost->body; ?></div>
                                <div class="avatar-holder">
                                    <img src="http://www.gravatar.com/avatar/<?php echo $superpost->gravatar_hash; ?>.jpg?s=25&d=identicon" class="superclass-gravatar_hash">
                                    <a href="userlink"><?php echo $superpost->username; ?></a>
                                </div>
                            </div>
                      <?php endforeach; ?>
                        <pre><?php  ?></pre>

                                

                    </div>
                </div>
            </div>
        </div>




        </div>
    </div><!-- .entry -->
    




</div><!-- .col-abc -->
<?php get_footer(); ?>