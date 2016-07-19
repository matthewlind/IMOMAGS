<?php

$dataPos = 0;

get_header();

$dartDomain 		= get_option("dart_domain", $default = false);
$disqus_shortname 	= "gunsammo";
$disqus_array 		= array(
	"imo.northamericanwhitetail" => "northamericanwhitetail",
	"imo.bowhunting"	=> "bowhuntingmag",
	"imo.gundog"		=> "gundogmag",
	"imo.wildfowl"		=> "wildfowlmag",
	"imo.bowhunter"		=> "bowhuntermag",
	"imo.hunting" 		=> "petersenshunting",
	"imo.handguns"		=> "handguns",
	"imo.rifleshooter"	=> "rifleshooter",
	"imo.shootingtimes"	=> "shootingtimesmag",
	"imo.shotgunnews"	=> "shotgunnews",
	"imo.gunsandammo" 	=> "gunsammo",
	"imo.in-fisherman"	=> "infisherman",
	"imo.flyfisherman"	=> "flyfisherman"
);
foreach($disqus_array as $key=>$value) { if($dartDomain == $key) { $disqus_shortname = $value; } }



get_template_part( 'nav', get_post_format() );

imo_sidebar(); ?>
    <div id="primary" class="general">
        <div id="content" role="main" class="general-frame">

            <?php if ( have_posts() ) : ?>

                <?php get_template_part( 'content/content-single', "community" ); ?>
				 <div id="comments" class="post-comments-area">
					<div id="load-comments" class="show-comments" data-shortname="<?php echo $disqus_shortname;?>">
						<span class="show-comm-1">Load Comments ( </span><span id="spandisqus" class="disqus-comment-count" data-disqus-url="<?php the_permalink(); ?>"></span><span class="show-comm-2">)</span>
					</div>
					<div id="disqus_thread"></div>
                </div>					
            <?php endif; ?>
        </div><!-- #content -->
    </div><!-- #primary -->




<?php get_footer(); ?>
               

