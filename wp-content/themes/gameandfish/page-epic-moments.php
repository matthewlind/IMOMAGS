<?php 
	get_header('epic-moments');	
?>
<div class="m-article-wrap clearfix">
	<div class="m-article-image">
		<div class="m-sweep-text">
			<img class="epic-logo" src="<?php bloginfo('stylesheet_directory');?>/images/epic-moments/logo-epic-moment.png">
			<p>We’ve all had those memorable, never-to-happen-again outdoors-experiences with family and friends that are worth sharing with fellow sportsmen – and we can’t wait to hear about yours. If it’s truly epic, you could <span>WIN</span> your own epic moment, fishing with a pro brought to you by the all new Honda Pioneer 1000, Game & Fish and Major League Fishing.</p>
			<div class="m-sponsors clearfix">
				<img src="<?php bloginfo('stylesheet_directory');?>/images/epic-moments/MLF_Logo.png">
				<img src="<?php bloginfo('stylesheet_directory');?>/images/epic-moments/honda-logo.jpg">
				<img src="<?php bloginfo('stylesheet_directory');?>/images/epic-moments/pioneer1000.png">
				<a href="https://powersports.honda.com/pioneer/1000/home.aspx" class="btn-honda" target="_blank">Learn more about PIONEER 1000</a>
				<a href="http://powersports.honda.com/dealers/search.aspx?mm=1&zip=" class="btn-honda" target="_blank">Find a Dealer</a>
			</div>
		</div>
	</div><!-- .m-article-image -->
	<article class="m-article clearfix">
		<div class="m-social-wrap clearfix">
			<ul class="share-count social-buttons">
				<li>
					<div class="fb-like" data-href="http://www.gameandfishmag.com/epic-moments/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
				</li>
			    <li>
			         <a href="https://twitter.com/share" class="twitter-share-button" data-text="WIN a Trip to a Major League Fishing Bass Pro Summit Event!">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			    </li>
			</ul>
		</div><!-- .m-social-wrap -->
		<div class="m-sweep-blocks clearfix">
			<div class="m-sweep-left">
				<div class="m-sweep-enter">
					<h1>ENTER TO WIN!</h1>
					<div></div>
				</div>
				<div class="m-form-wrap">
					<?php gravity_form(49, false, false, false, '', false); ?>
				</div>
			</div>
			<div class="m-sweep-right">
				<p>Share your Epic Moment & you could WIN a trip to a Major League Fishing Bass Pro Summit event!</p>
				<div class="video-container">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/HdWgmCikSas" frameborder="0" allowfullscreen></iframe>
				</div>
				<div id="#player"><!-- Start of Brightcove Player -->
					<div style="display:none"></div>
					<!--
					By use of this code snippet, I agree to the Brightcove Publisher T and C
					found at https://accounts.brightcove.com/en/terms-and-conditions/.
					-->
					<script language="JavaScript" type="text/javascript" src="http://admin.brightcove.com/js/BrightcoveExperiences.js"></script>
					
					<object id="myExperience" class="BrightcoveExperience">
					  <param name="bgcolor" value="#FFFFFF" />
					  <param name="width" value="480" />
					  <param name="height" value="270" />
					  <param name="playerID" value="1445501637001" />
					  <param name="playerKey" value="AQ~~,AAAAALyrRUk~,m8Wuv4JIiTp4WJ_vxf089O1HdEWslAPu" />
					  <param name="isVid" value="true" />
					  <param name="isUI" value="true" />
					  <param name="dynamicStreaming" value="true" />
					  <param name="@videoPlayer" value="4527064985001" /></object>
					</object>
					
					<!--
					This script tag will cause the Brightcove Players defined above it to be created as soon
					as the line is read by the browser. If you wish to have the player instantiated only after
					the rest of the HTML is processed and the page load is complete, remove the line.
					-->
					<script type="text/javascript">brightcove.createExperiences();</script>
					</div><!-- End of Brightcove Player -->
				<div class="epic-ad-300x600"><?php imo_ad_placement("gpt-ad-1443797577185-1"); ?></div>
			</div>
		</div><!-- .m-sweep-blocks -->
		<div class="editors-block">
			<h1>Editors Epic Moments</h1>
			<div class="editors-articles clearfix">
				<div class="epic-article">
					<a href="http://www.floridasportsman.com/2015/10/01/beautiful-fish/" target="_blank">
						<div class="epic-header clearfix">
							<div class="epic-info">
								<span>Jeff Weakley</span>
								<h5>Executive Editor, Florida Sportsman</h5>
								<h1>Beautiful Fish</h1>
							</div>
						</div>
						<div class="epic-image" style="background-image: url(wp-content/themes/gameandfish/images/epic-moments/articles/Weakley.jpg);"></div>
					</a>
				</div>
				<div class="epic-article">
					<a href="http://www.in-fisherman.com/culture/the-futures-not-far/" target="_blank">
						<div class="epic-header clearfix">
							<div class="epic-info">
								<span>Doug Stange</span>
								<h5>Editor-In-Chief, In-Fisherman</h5>
								<h1>The Future’s Not Far</h1>
							</div>
						</div>
						<div class="epic-image" style="background-image: url(wp-content/themes/gameandfish/images/epic-moments/articles/Stange.jpg);"></div>
					</a>
				</div>
				<div class="epic-article">
					<a href="http://www.in-fisherman.com/culture/one-anglers-evolution/" target="_blank">
						<div class="epic-header clearfix">
							<div class="epic-info">
								<span>Jeff Simpson</span>
								<h5>Staff Photographer, In-Fisherman</h5>
								<h1>One Angler’s Evolution</h1>
							</div>
						</div>
						<div class="epic-image" style="background-image: url(wp-content/themes/gameandfish/images/epic-moments/articles/Simpson.jpg);"></div>
					</a>
				</div>
				<div class="epic-article">
					<a href="http://www.in-fisherman.com/culture/from-new-york-city-to-the-brazilian-jungle/" target="_blank">
						<div class="epic-header clearfix">
							<div class="epic-info">
								<span>Steve Quinn</span>
								<h5>Senior Editor, In-Fisherman</h5>
								<h1>From New York City to the Brazilian Jungle</h1>
							</div>
						</div>
						<div class="epic-image" style="background-image: url(wp-content/themes/gameandfish/images/epic-moments/articles/Quinn.jpg);"></div>
					</a>
				</div>
				<div class="epic-article">
					<a href="" target="_blank">
						<div class="epic-header clearfix">
							<div class="epic-info">
								<span>Ross Purnell</span>
								<h5>Editor, Fly Fisherman</h5>
								<h1>Navarino Island Adventure, 55°12'08.6"S 67°24'58.1”W</h1>
							</div>
						</div>
						<div class="epic-image" style="background-image: url(wp-content/themes/gameandfish/images/epic-moments/articles/Purnell.jpg);"></div>
					</a>
				</div>
				<div class="epic-article">
					<a href="http://www.in-fisherman.com/culture/the-catfish-coffee-club/" target="_blank">
						<div class="epic-header clearfix">
							<div class="epic-info">
								<span>Rob Neumann</span>
								<h5>Managing Editor, In-Fisherman</h5>
								<h1>The Catfish Coffee Club</h1>
							</div>
						</div>
						<div class="epic-image" style="background-image: url(wp-content/themes/gameandfish/images/epic-moments/articles/Neumann.jpg);"></div>
					</a>
				</div>
				<div class="epic-article">
					<a href="" target="_blank">
						<div class="epic-header clearfix">
							<div class="epic-info">
								<span>Gordon Whittington</span>
								<h5>Editor-in-Chief, North American Whitetail</h5>
								<h1>Return To The Outhouse Stand</h1>
							</div>
						</div>
						<div class="epic-image" style="background-image: url(wp-content/themes/gameandfish/images/epic-moments/articles/Whittington.jpg);"></div>
					</a>
				</div>
				<div class="epic-article">
					<a href="" target="_blank">
						<div class="epic-header clearfix">
							<div class="epic-info">
								<span>Curt Wells</span>
								<h5>Editor, Bowhunter</h5>
								<h1>First Light</h1>
							</div>
						</div>
						<div class="epic-image" style="background-image: url(wp-content/themes/gameandfish/images/epic-moments/articles/Wells.jpg);"></div>
					</a>
				</div>
				<div class="epic-article">
					<a href="" target="_blank">
						<div class="epic-header clearfix">
							<div class="epic-info">
								<span>Rick R. Van Etten</span>
								<h5>Editor, Gun Dog Magazine</h5>
								<h1>First Pheasant</h1>
							</div>
						</div>
						<div class="epic-image" style="background-image: url(wp-content/themes/gameandfish/images/epic-moments/articles/Van-Etten.jpg);"></div>
					</a>
				</div>
				<div class="epic-article">
					<a href="" target="_blank">
						<div class="epic-header clearfix">
							<div class="epic-info">
								<span>J. Scott Rupp</span>
								<h5>Editor-In-Chief, Handguns</h5>
								<h1>The Ridge Runner</h1>
							</div>
						</div>
						<div class="epic-image" style="background-image: url(wp-content/themes/gameandfish/images/epic-moments/articles/Rupp.jpg);"></div>
					</a>
				</div>
				<div class="epic-article">
					<a href="" target="_blank">
						<div class="epic-header clearfix">
							<div class="epic-info">
								<span>Christian Berg</span>
								<h5>Editor, Bowhunting</h5>
								<h1>The Running of the Bulls</h1>
							</div>
						</div>
						<div class="epic-image" style="background-image: url(wp-content/themes/gameandfish/images/epic-moments/articles/Berg.jpg);"></div>
					</a>
				</div>
				<div class="epic-article">
					<a href="" target="_blank">
						<div class="epic-header clearfix">
							<div class="epic-info">
								<span>John Geiger</span>
								<h5>Senior Editor, Game & Fish/Sportsman magazines</h5>
								<h1>The Biggest Little Pigfish</h1>
							</div>
						</div>
						<div class="epic-image" style="background-image: url(wp-content/themes/gameandfish/images/epic-moments/articles/Geiger.jpg);"></div>
					</a>
				</div>
				<div class="epic-article">
					<a href="" target="_blank">
						<div class="epic-header clearfix">
							<div class="epic-info">
								<span>Ken Dunwoody</span>
								<h5>Editorial Director, Game & Fish</h5>
								<h1>The Day In The Bay</h1>
							</div>
						</div>
						<div class="epic-image" style="background-image: url(wp-content/themes/gameandfish/images/epic-moments/articles/Dunwoody.jpg);"></div>
					</a>
				</div>
				<div class="ad-300x250"><?php imo_ad_placement("gpt-ad-1443797577185-0"); ?></div>
			</div><!-- .editors-articles -->
			<div class="article-bottom clearfix">
				<div class="m-social-wrap clearfix">
					<h2>Share This Page</h2>
					<ul class="share-count social-buttons">
						<li>
							<div class="fb-like" data-href="http://www.gameandfishmag.com/epic-moments/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
						</li>
					    <li>
					         <a href="https://twitter.com/share" class="twitter-share-button" data-text="WIN a Trip to a Major League Fishing Bass Pro Summit Event!">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					    </li>
					</ul>
				</div><!-- .m-social-wrap -->
				
			</div><!-- .article-bottm -->
		</div><!-- .editors-block-->
	</article>
</div><!-- .m-article-wrap -->
<?php get_footer('epic-moments'); ?>