<?php
/**
 * Template Name: Core Experts Template
 * Description: A Page Template that showcases authors
 *
 * The showcase template in Twenty Eleven consists of a featured posts section using sticky posts,
 * another recent posts area (with the latest post shown in full and the rest as a list)
 * and a left sidebar holding aside posts.
 *
 * We are creating two queries to fetch the proper posts and a custom widget for the sidebar.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
 
$dataPos = 0;
get_header();
imo_sidebar();?>
	<div id="primary" class="general">
        <div class="general-frame">
            <div id="content" role="main">
            	<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="page-header clearfix js-responsive-section">
                    <h1 class="page-title"><?php printf('<span>' . the_title() . '</span>' ); ?></h1>
            	</div>
            	<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="article-brief clearfix js-responsive-section">
					<p><?php the_content(); ?></p>
            	</div>

				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="clearfix">
	                <div class="single-post-slider left">
	                    <div class="jq-slider">
	                        <ul class="slides-inner slides">
	                            <li>
	                                <div class="feat-post">
	                                    <div class="feat-img"><a href="/author/steve-hoffman/" ><img src="http://www.in-fisherman.com/files/2011/07/Steve-Hoffman.jpg" alt="Steve Hoffman" title="Steve Hoffman" /></a></div>
	                                    <div class="feat-text"><h3><a href="/author/shoffman/" >Steve Hoffman</a><a href="http://www.in-fisherman.com/feed/" class="rss author-rss">RSS</a></h3>
	                                    <p><strong>Publisher</strong> Steve Hoffman has fished from the Arctic Circle tundra to the South American jungles and from New England’s hottest runs of stripers and bluefish to the trophy trout fisheries of the Mountain West.</p></div>
	                                </div>
	                            </li>
	                        </ul>
	                    </div>
					</div>

	                
	                
	                <div class="single-post-slider ">
	                    <div class="jq-slider">
	                        <ul class="slides-inner slides">
	                            <li>
	                                <div class="feat-post">
	                                    <div class="feat-img"><a href="/author/rneumann/" ><img src="http://www.in-fisherman.com/files/2011/07/Rob-Neumann.jpg" alt="Rob Neumann" title="Rob Neumann" /></a></div>
	                                    <div class="feat-text"><h3><a href="/author/rneumann/" >Rob Neumann</a><a href="http://www.in-fisherman.com/author/rneumann/feed/" class="rss author-rss">RSS</a></h3><p><strong>Managing Editor</strong> Managing Editor Dr. Rob Neumann plays roles in editing, writing, and television. He’s a multispecies angler, fishery biologist, and educator, helping to bridge the gap between science and fishing.</p></div>
	                                </div>
	                            </li>
	                        </ul>
	                    </div>
					</div>
	                
	            </div>
	            
	            <div class="clearfix">
	                <div class="single-post-slider left">
	                    <div class="jq-slider">
	                        <ul class="slides-inner slides">
	                            <li>
	                                <div class="feat-post">
	                                    <div class="feat-img"><a href="/author/jsimpson/" ><img src="http://www.in-fisherman.com/files/2011/07/Jeff-Simpson.jpg" alt="Jeff Simpson" title="Jeff Simpson" /></a></div>
	                                    <div class="feat-text"><h3><a href="/author/jsimpson/" >Jeff Simpson</a><a href="http://www.in-fisherman.com/author/jsimpson/feed/" class="rss author-rss">RSS</a></h3><p>A hardcore angler, <strong>Digital Editorial Director</strong> Jeff Simpson has worked over 15 years at In-Fisherman. Besides managing the fishing group websites, he continues his role as the field and studio photographer.</p></div>
	                                </div>
	                            </li>
	                        </ul>
	                    </div>
					</div>

	                
	                
	                <div class="single-post-slider ">
	                    <div class="jq-slider">
	                        <ul class="slides-inner slides">
	                            <li>
	                                <div class="feat-post">
	                                    <div class="feat-img"><a href="/author/dstange/" ><img src="http://www.in-fisherman.com/files/2011/07/Doug-Stange.jpg" alt="Doug Stange" title="Doug Stange" /></a></div>
	                                    <div class="feat-text"><h3><a href="/author/dstange/" >Doug Stange</a><a href="http://www.in-fisherman.com/author/dstange/feed/" class="rss author-rss">RSS</a></h3><p><strong>Editor In Chief</strong> Doug Stange has been in the fishing industry for over 36 years. He has been a driving force behind selective harvest, the science of fishing, and the coverage of multiple species on TV and in the magazines.</p></div>
	                                </div>
	                            </li>
	                        </ul>
	                    </div>
					</div>
	                
	            </div>
	            
	            <div class="clearfix">
	                <div class="single-post-slider left">
	                    <div class="jq-slider">
	                        <ul class="slides-inner slides">
	                            <li>
	                                <div class="feat-post">
	                                    <div class="feat-img"><a href="/author/squinn/" ><img src="http://www.in-fisherman.com/files/2011/07/Steve-Quinn.jpg" alt="Steve Quinn" title="Steve Quinn" /></a></div>
	                                    <div class="feat-text"><h3><a href="/author/squinn/" >Steve Quinn</a><a href="http://www.in-fisherman.com/author/squinn/feed/" class="rss author-rss">RSS</a></h3><p><strong>Senior Editor</strong> Steve Quinn writes features and columns for In-Fisherman and the company’s seven annual guides. He also works closely with freelance writers and contributes to In-Fisherman’s media products.</p></div>
	                                </div>
	                            </li>
	                        </ul>
	                    </div>
					</div>

	                
	                
	                <div class="single-post-slider ">
	                    <div class="jq-slider">
	                        <ul class="slides-inner slides">
	                            <li>
	                                <div class="feat-post">
	                                    <div class="feat-img"><a href="/author/nedkehde/" ><img src="http://www.in-fisherman.com/files/2011/07/Ned-Kehde.jpg" alt="Ned Kehde" title="Ned Kehde" /></a></div>
	                                    <div class="feat-text"><h3><a href="/author/nedkehde/" >Ned Kehde</a><a href="http://www.in-fisherman.com/author/nedkehde/feed/" class="rss author-rss">RSS</a></h3><p><strong>Field Editor</strong> Ned Kehde’s has been writing for In-Fisherman since the 1980s. His recent finesse bass tactics and findings have been influential throughout the Midwest and beyond.</div>
	                                </div>
	                            </li>
	                        </ul>
	                    </div>
					</div>
	                
	            </div>
	            
	            <div class="clearfix">
	                <div class="single-post-slider left">
	                    <div class="jq-slider">
	                        <ul class="slides-inner slides">
	                            <li>
	                                <div class="feat-post">
	                                    <div class="feat-img"><a href="/author/mstraw/" ><img src="http://www.in-fisherman.com/files/2011/07/Matt-Straw.jpg" alt="Matt Straw" title="Matt Straw" /></a></div>
	                                    <div class="feat-text"><h3><a href="/author/mstraw/" >Matt Straw</a><a href="http://www.in-fisherman.com/author/mstraw/feed/" class="rss author-rss">RSS</a></h3><p>Matt Straw writes about fishing concepts and techniques for catching smallmouth bass, steelhead and salmon, panfish, and more. He continues to write features for In-Fisherman & annual guides.</p></div>
	                                </div>
	                            </li>
	                        </ul>
	                    </div>
					</div>

	                
	                
	                <div class="single-post-slider ">
	                    <div class="jq-slider">
	                        <ul class="slides-inner slides">
	                            <li>
	                                <div class="feat-post">
	                                    <div class="feat-img"><a href="/author/cschmidt/" ><img src="http://www.in-fisherman.com/files/2011/07/CorySHeroShot.jpg" alt="Cory Schmidt" title="Cory Schmidt" /></a></div>
	                                    <div class="feat-text"><h3><a href="/author/cschmidt/" >Cory Schmidt</a><a href="http://www.in-fisherman.com/author/cschmidt/feed/" class="rss author-rss">RSS</a></h3><p>Cory Schmidt has authored dozens of articles for In-Fisherman and the company’s annual guides. An avid multi-species angler, he especially enjoys probing rivers for muskies, catfish, carp, and more.</p></div>
	                                </div>
	                            </li>
	                        </ul>
	                    </div>
					</div>
	                
	            </div>
				
				<div data-position="<?php echo $dataPos = $dataPos + 1; ?>" class="pager-holder js-responsive-section">
					<a href="#" class="go-top jq-go-top">go top</a>
				</div>

				<div class="foot-social clearfix">
                    <strong class="social-title">Like us on Facebook to <span>stay updated !</span></strong>
                    <div class="fb-like" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
                    <?php social_networks(); ?>
                </div>
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                
                <a href="#" class="get-newsletter">Get the In-Fisherman <br />Newsletter</a>
                <a href="#" class="subscribe-banner">
                    <img src="<?php bloginfo('template_directory'); ?>/images/pic/subscribe-banner.jpg" alt="" />
                </a>
                <a href="#" class="back-top jq-go-top">back to top</a>

		 	</div><!-- #content -->
        </div>
    </div><!-- #primary -->
<?php get_footer(); ?>
