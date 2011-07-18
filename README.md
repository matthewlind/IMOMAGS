IMO Mags
========

We created [IMOMags.com](http://IMOmags.com/) to serve as a temporary site to host IMOutdoors content during an extened outtage. Each theme corresponds to an IMOutdoors Title. 

Themes
------
All the themes use [Carrington Business](http://crowdfavorite.com/wordpress/themes/carrington-business/) as a parent theme. Slight modifications have been made to the parent theme, most notably to remove the wordpress version from the header and automatic ajax loading of posts on click.

Carrington Business Modifications
---------------------------------

### Modified Files
Unfortunately, in the interst of managing 14 themes at one time, IMO has had to modify Carrington Business's core files. This sacrifice has purchased time, and the following denotes the customizations made in the hope that they're not overwritten when updates are required and that further customizations are made in the proper places.

[_functions.php_](https://github.com/imoutdoors/IMOMags/blob/master/wp-content/themes/carrington-business/functions.php) - Modified to include [_imo-addons.php_](https://github.com/imoutdoors/IMOMags/blob/master/wp-content/themes/carrington-business/functions/imo-addons.php), which is where the majority of customizations are added.

[_css.php_](https://github.com/imoutdoors/IMOMags/blob/master/wp-content/themes/carrington-business/css/css.php) - Now includes the file _custom.css_, where custom style belongs.

[_header/header-default](https://github.com/imoutdoors/IMOMags/blob/master/wp-content/themes/carrington-business/header/header-default.php) - Modified to account for the various header needs, generalized just enough to let the child themes have a go at things. Attempts to include the file [head-subscribe.php] if nothing is set in the Header Slot Sidebar is not active. 

###Custom CSS
All custom CSS modifications go into the file [css/custom.css](https://github.com/imoutdoors/IMOMags/blob/master/wp-content/themes/carrington-business/css/custom.css), which is included by the css.php stylesheet aggregator.

### Custom Widgets
Subscribe Widgets - found in [/widgets](https://github.com/imoutdoors/IMOMags/tree/master/wp-content/themes/carrington-business/widgets) these are custom carrington widgets hat might be better off in a plugin.

### Sidebars
Four sidebars have been added to Carrington to facilitate the easy creation of pages.
+ Header Slot - created to hosue the subscription header widget, appears next to the  header logo on themes.
+ Homepage Sidebar - A sidebar intended for inclusion on the homepage only, for use in Carringon Build pages
+ Landing Page Sidebar - A sidebar intended for inclusion on the landing pages only, for use in Carringon Build pages
+ Video Sidebar - A sidebar intended for inclusion on video pages only, for use in Carringon Build pages

###Custom Modules

#### Not-Loop
* * *
The not-loop functions like a normal loop module, except that it excludes any stories that are in the Featured Category. This functionality is hard-coded.

#### Featured Posts
* * *
Creates a featured post carousell, which pulls from the selected categories. 

##### Caveats
For the Not-Loop and Featured Posts modules to work properly on the same page, one must add the "Feature" category to the Featured Posts module, or else duplicate posts will appear on the same page.

Plugins
-------

### Brightcove Embed
Allows a user to embed a brightcove video into a post on a multi-site install of wordpress without needing to be na admin. 

####Usage

>
> http://brightcove?id=_nummber_
>

### Brightcove Import
Creates a simple interface ain the wordpress admin section to allow users to search for and import posts from Brightcove.

### IMO Dart
Generates proper doubleclick tags foran IMO Title. Also creates a widget with sizing and format choices.

### IMO Redirect
Instead of serving a normal 404 on pages, serve a 503 and redirect the user to the homepage. This is to help combat the missing pages resulting from the loss of content. 

#### To Do
+ imo-redirect - Create a 503 list of urls, s that normal 404s can be served out.
+ imo-dart -- Add admin sccreen so that a user can define the Domain properly. 
+ not-loop & featured-posts -- Generalize the exclusion so that the not-loop can define a category or tag rather than being hardcoded.
+ carrington widgets -- might be better served pulled out into a plugin.
+ bc-embed -- Change from url expansion to a shortcode tag if possible, which follows the format: [brightcove]_id_[/brightcove]
+ video posts -- create a custom template for video posts which uses the video sidebar rather than the blog sidebar. 
