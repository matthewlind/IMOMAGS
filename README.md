IMO Mags
========

We created [IMOMags.com](http://IMOmags.com/) to serve as a temporary site to host IMOutdoors content during an extened outtage. Each theme corresponds to an IMOutdoors Title. 

Themes
------
All the themes use [Carrington Business](http://crowdfavorite.com/wordpress/themes/carrington-business/) as a parent theme. Slight modifications have been made to the parent theme, most notably to remove the wordpress version from the header and automatic ajax loading of posts on click.

Carrington Business Modifications
---------------------------------

### Modified Files
_functions.php_ - Modified to include _imo-addons.php_, which is where the majority of customizations are added.
_css.php_ - Now includes the file _custom.css_, where custom style belongs.

###Custom CSS
All custom CSS modifications go into the file css/custom.css, which is included by the css.php stylesheet aggregator.

### Custom Widgets
Subscribe Widgets - found in /widgets/ these are custom carrington widgets hat might be better off in a plugin.

###Custom Modules

#### Not-Loop
The not-loop functions like a normal loop module, except that it excludes any stories that are in the Featured Category. This functionality is hard-coded.

#### Featured Posts
Creates a featured post carousell, which pulls from the selected categories. 

##### Caveats
For the Not-Loop and Featured Posts modules to work properly on the same page, one must add the "Feature" category to the Featured Posts module, or else duplicate posts will appear on the same page.

Plugins
-------

### Brightcove Embed
Allows a user to embed a brightcove video into a post on a multi-site install of wordpress without needing to be na admin. 
_Usage_
> http://brightcove?id=<nummber>

_To Do_
Change from url expansion to a shortcode tag if possible, which follows the format: [brightcove]<id>[/brightcove]

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
