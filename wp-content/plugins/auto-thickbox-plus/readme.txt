=== Auto ThickBox Plus ===
Contributors: attosoft
Donate link: http://attosoft.info/blog/en/donate/
Tags: lightbox, thickbox, shadowbox, gallery, semiologic, image, images, thumbnail, thumbnails, popup, pop-up, overlay, photo, photos, picture, pictures, javascript, simple
Requires at least: 2.8
Tested up to: 3.3.1
Stable tag: trunk

Overlays linked image, inline, iFrame and AJAX content on the page in simple & fast effects. (improved version of Auto Thickbox plugin)

== Description ==

Auto ThickBox Plus plugin is the improved version of [Auto Thickbox](http://wordpress.org/extend/plugins/auto-thickbox/) plugin, with some extra features.

Clicking on image/text links to images etc, this plugin overlays linked content on the page in simple & fast effects. It's recommended if you want to pop up thumbnails easily in its original size.

= Basic Features =

* Automatically applies [ThickBox script](http://jquery.com/demo/thickbox/) to thumbnails including WordPress Galleries
  * All you do is upload images to WordPress Gallery or write image links to images (`<a href="image"><img /></a>`)
* Pop-up effects are simple & fast compared to Lightbox, ColorBox, FancyBox, Shadowbox, Slimbox and so on
  * ThickBox will be the answer if you prefer no animation effects & no fancy design
* Automatically resizes images that are larger than the browser window
* Uses WordPress built-in ThickBox library (no need to install the script and refer to it separately)

= Extra Features =

* Overlays images in either "Gallery Images" or "**Single Image**" style
* Automatically applies ThickBox to **text links** to images (`<a href="image">text</a>`)
* **Auto Resize** feature can be disabled if you prefer
* ThickBox window can be **moved/resized by dragging** mouse
* Can be customized the behavior & design through **more than 40 options**
  * e.g. Click action can be selected from 'Close', 'None', 'Next' and 'Prev/Next'
* Supports BMP and [WebP](http://code.google.com/speed/webp/) image formats
* Supports **Inline content** on the page (#TB_inline)
* Supports **AJAX content** (displays internal files on the page without iframe)
* Supports **Twenty Eleven** theme (default theme in WordPress 3.2/3.3)
* Uses WordPress translations
  * Now ThickBox window is localized to **more than 70 languages** (Arabic, Chinese, Dutch, French, German, Hindi, Italy, Japanese, Korean, Polish, Portuguese, Russian, Spanish and more)
* And fixed some major/minor bugs in original plugin and thickbox.js/css (See [Changelog](changelog/))

\* Note: Auto ThickBox Plus plugin is besed on Auto Thickbox v.2.0.3 (Jul 20th, 2011).

= How to Install =

See [Installation](installation/).

= How to Use =

See [Usage in Other Notes](other_notes/).

= Special Thanks =

* Dutch (nl_NL) translations - [Michel Bats](http://www.batssoft.nl/)

= Links =

* [attosoft.info](http://attosoft.info/en/) \[[Japanese](http://attosoft.info/)\]
* [Auto ThickBox Plus Plugin Official Site](http://attosoft.info/blog/en/auto-thickbox-plus/) \[[Japanese](http://attosoft.info/blog/auto-thickbox-plus/)\]
* [Auto Thickbox Plugin](http://www.semiologic.com/software/auto-thickbox/) (Original)
* [ThickBox 3.1](http://jquery.com/demo/thickbox/) (JavaScript Library)

== Installation ==

= Auto Install =

1. Access Dashboard screen in WordPress
1. Select [Plugins] - [Add New]
1. Input "thickbox" into text field, and click [Search Plugins]
1. Click 'Install Now' at 'Auto ThickBox Plus'
1. Click 'Activate Plugin'
1. Upload images to WordPress Gallery or write links to images, inline, iFrame or AJAX contents

= Manual Install =

1. Download [auto-thickbox-plus.zip](http://downloads.wordpress.org/plugin/auto-thickbox-plus.zip)
1. Access Dashboard screen in WordPress
1. Select [Plugins] - [Add New] - 'Upload' tab
1. Upload the plugin zip file, and click [Install Now]
1. Click 'Activate Plugin'
1. Upload images to WordPress Gallery or write links to images, inline, iFrame or AJAX contents

= Manual Install via FTP =

1. Download [auto-thickbox-plus.zip](http://downloads.wordpress.org/plugin/auto-thickbox-plus.zip), and unzip it
1. Upload the plugin folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Upload images to WordPress Gallery or write links to images, inline, iFrame or AJAX contents

\* Note: If Auto Thickbox (not Plus) plugin is installed, you need to deactivate or uninstall it before activating Auto ThickBox Plus plugin. You cannot activate this plugin and the original plugin at the same time.

= Customization =
This is available options at Auto ThickBox Plus Options in 'Settings' menu. You can customize the behavior & design of the plugin through these options. See also [Screenshots](../screenshots/).

* General
  * Default Display Style (Single Image or Gallery Images)
  * ThickBox on Text Links (Auto or Manual)
  * Auto Resize
  * ThickBox Resources (original thickbox.js/css)
* Action
  * Mouse Click
  * Mouse Wheel (Scroll)
  * Drag & Drop
  * Keyboard Shortcuts
* View
  * Font Family & Weight
  * Text Color
  * Background Color
  * Border
  * Border Raidus
  * Opacity
  * Box Shadow
  * Text Shadow
* Image
  * Prev/Next, Close, Loading image and so on
* Effect (beta)
  * Open, Close, Transition effects and Speed

== Frequently Asked Questions ==

= How to access Auto ThickBox Plus Options? =

1. Access Dashboard screen in WordPress
1. Click [Settings] - [Auto ThickBox Plus] in sidebar

= I want to overlay images in "Gallery Images" style by default =

1. Access Auto ThickBox Plus Options page
1. Select [Gallery Images] button in [Default Display Style]
1. Click [Save Changes] button

= I want to disable ThickBox on text links by default =

1. Access Auto ThickBox Plus Options page
1. Select [Manual] button in [ThickBox on Text Links]
1. Click [Save Changes] button

= I want to use original ThickBox resources =

1. Access Auto ThickBox Plus Options page
1. Uncheck [Use WordPress built-in thickbox.js/css (some extra features will be disabled)] checkbox in [ThickBox Resources]
1. Click [Save Changes] button

= How to pop up WebP image in Google Chrome or Opera? =

If you use optimized resources, you do not need to do anything.
If you use original ThickBox resources, execute the following steps.

1. Open `/wp-includes/js/thickbox/thickbox.js` file
1. Jump to line 72, and modify as follows

        - var urlString = /\.jpg$|\.jpeg$|\.png$|\.gif$|\.bmp$/;
        + var urlString = /\.jpg$|\.jpeg$|\.png$|\.gif$|\.bmp$|\.webp$/;

1. Jump to line 75, and modify as follows

        - if(urlType ==  ... == '.bmp'){//code to show images
        + if(urlType ==  ... == '.bmp' || urlType == '.webp'){//code to show images

1. Save the file

== Screenshots ==

1. Pop-up image in "Single Image" style
1. Pop-up image in "Gallery Images" style (with Prev/Next links)
1. Auto ThickBox Plus Options page
1. Customization example (pink background, transparent window, rounded corners, no borders, bold font, etc.)

== Changelog ==

= 1.0 =
* Beta: Supports animation effects
  * Open/Close/Transition - Zoom/Slide/Fade/None
  * Speed - Fast/Normal/Slow or arbitrary value
* Improve Options page UI
  * Uses meta boxes to drag to change order, and click to toggle open/close
* Loading image option accepts the URL without scheme and host (i.e. started with '/')
* Fix: iFramed content is not shown smoothly in Google Chrome and Safari [thickbox.js bug]
* Fix: Jump to current page with double click on image [thickbox.js bug]
* Fix: Scroll bar appears and gray overlay shifts when closing in IE6 [thickbox.js bug]
* Fix: Shortcut keys with shift key do not work (regression in version 0.9)
* Update Dutch translations (props Michel Bats) and Japanese translations

= 0.9 =
* Supports "Drag & Drop" action. Now ThickBox window can be moved/resized by drag.
  * Add [Drag & Drop] - [Window (Image/Content)] - [Move/Resize] options
* Add "Auto Resize" option. Auto Resize feature can be disabled if you prefer.
* Fix: Some bound event handlers does not removed (causes memory leaks) [thickbox.js bug]
* Fix: Hide dotted lines around the left/right side of image when click links (for IE6/7)
* Minify thickbox.js with  [Closure Compiler](https://developers.google.com/closure/compiler/) (reduced about 15% file size)
* Optimize global option variables (bring together multiple variables as an object literal)
* Update Japanese translations

= 0.8 =
* Supports more mouse/keyboard actions, and add related options
  * Mouse Click: Next, Next / Prev (click on the left/right side of image)
     * Close, None, Loop (click on the first/last image)
  * Keyboard Shortcuts: Home / End
* Add 'Image' options to specify arbitrary images for Prev/Next, Close, Loading, etc.
* Set links to  CSS Reference (MDN) from View option label
* Shrink padding-bottom of ThickBox window when displayed in "Gallery Images" without caption
* Fix: Loading image is not displayed in the exact center of browser window [thickbox.css bug]
* Uses uncompressed thickbox.js/css when WP_DEBUG is true
* Update Japanese translations

= 0.7 =
* Supports more mouse/keyboard actions, and add 'Action' options to 'Options' page
  * Mouse Click: Close, None
  * Mouse Wheel (Scroll): Prev / Next, None
  * Keyboard Shortcuts: Esc, Enter, < / >, Left / Right, [Shift +] Tab, [Shift +] Space, BackSpace
* Uses WordPress translations as much as possible
  * Now ThickBox window is localized to more than **70 languages**
  * e.g. Arabic, Chinese, Dutch, French, German, Hindi, Italy, Japanese, Korean, Polish, Portuguese, Russian, Spanish, etc.
* Suppresses redundant `<script>` & `<style>` tag output
* Update Japanese translations (and also template file)

= 0.6 =
* Add 'View' options to 'Options' page
  * Font Family & Weight, Text Color, Background Color, Border, Border Radius, Opacity, Box Shadow and Text Shadow
* Place 'Reset' button to 'Options' page
* Switch padding-bottom of ThickBox window depending on Single/Gallery style
* Fix: Auto Thickbox corrupts links with custom data-* attributes [original bug]
* Fix: Image is not displayed in the exact center of ThickBox window [thickbox.js bug]
* Add Dutch (nl_NL) translations, props Michel Bats
* Add 'Support', 'Donate' links to 'Plugins' page
* Update readme.txt with major changes
  * Usage, Installation, Screenshots, Customization and so on

= 0.5 =
* Supports AJAX content (displays internal files on the page without iframe) [original & thickbox.js bug]
* Supports Twenty Eleven theme [thickbox.css bug]
* Improved URL string generated by "Full iFrame support" in Auto Thickbox plugin (original)

= 0.4 =
* Supports inline content on the page (#TB_inline) [original bug]
* Supports URL has '?' parameter such as default permalinks and post/page preview [thickbox.js bug]
  * e.g. `http://blog.example.com/?p=123&preview=true`

= 0.3 =
* Add optimized (compressed & tweaked) resources (thickbox.js, thickbox.css)
  * The file size is reduced by about 25%
  * Supports BMP and WebP image formats (now no need to tweak original thickbox.js)
  * Rounds corners and shrinks padding-bottom of pop-up window
* Delete additional CSS file (auto-thickbox.css)
* Replace additional CSS load option with optimized resources load option

= 0.2 =
* Add additional CSS file (auto-thickbox.css), and CSS load option (see [FAQ](../faq/))
* Supports BMP and [WebP](http://code.google.com/speed/webp/) image formats
  * Note: To pop up WebP image requires to tweak thickbox.js (see [FAQ](../faq/))
* Add plugin links on the 'Plugins' page (Show Details, Settings, Contact Me)
* Include screenshot images in release zip (see [Screenshots](../screenshots/))

= 0.1 =
* Initial release (based on Auto Thickbox v.2.0.3)
* By default, overlays images in not "Gallery Images" but "**Single Image**" style
* By default, automatically also applies ThickBox to **text links** to images (text enclosed with link tag)
* Add Auto ThickBox Plus Options in 'Settings' menu
  * Default Display Style (Single Image or Gallery Images)
  * ThickBox on Text Links (Auto or Manual)
* Add French, Japanese and Romanian translations
* Add missing MO files of Czech, German and Portuguese

== Usage ==

= WordPress Gallery =

Upload images to WordPress Gallery through the 'Post/Page' screen, then write [Gallery Shortcode](http://codex.wordpress.org/Gallery_Shortcode) with `link="file"` option.

    [gallery link="file"]

= Single Image =

Write image links to images. Image caption is specified by `img@alt` (`<img alt="foo" />`).

    <a href="image.png">
        <img src="image_s.png" alt="foo" />
    </a>

Or write text links to images. Image caption is specified by `a@title` (`<a title="foo">`).

    <a href="image.png" title="foo">Text</a>

= Gallery Images =

To display images in "Gallery Images" style, add arbitrary value to `a@rel` (`<a rel="foo">`).

    <a href="image1.png" rel="foo">
        <img src="image1_s.png" alt="image1" />
    </a>
    <a href="image2.png" rel="foo">
        <img src="image2_s.png" alt="image2" />
    </a>

= No ThickBox =

To disable ThickBox on specific images, add "nothickbox" to `a@class` (`<a class="nothickbox">`).

    <a href="image.png" class="nothickbox">
        Anchor (image or text)
    </a>

= Inline Content =

1. Write inline content with `@id` (e.g. `<div id="foo">...</div>`)
  * Inline content can be set to hide (e.g. `<div style="visibility: hidden">`)
1. Write links and add "thickbox" to `a@class` (`<a class="thickbox">`)
  * Window title is specified by `a@title` (`<a title="bar">`)
1. Set `#TB_inline` to `a@href` (`<a href="#TB_inline">`)
1. Add `inlineId` parameter to `a@href` (`<a href="#TB_inline?inlineId=foo">`)

<!-- code -->

    <div id="foo" style="visibility: hidden">
        <div>Here is inline content.</div>
    </div>
    <a href="#TB_inline?inlineId=foo" class="thickbox" title="bar">Anchor</a>

\* You can set `width`, `height` and `modal` parameters if needed. For details, see [Inline Content Examples](http://jquery.com/demo/thickbox/#container-4).

= iFramed Content =

Writing links to external URLs and add "thickbox" to `a@class` (`<a class="thickbox">`), URLs are opened inside `<iframe>`. Window title is specified by `a@title` (`<a title="foo">`).

    <a href="http://example.com/" class="thickbox" title="foo">Web page</a>

Here is sample codes to open static/dynamic page, text file and Adobe Flash.

    <a href="http://example.com/file.html" class="thickbox">Static page</a>
    <a href="http://example.com/file.php?bar=baz" class="thickbox">Dynamic page</a>
    <a href="http://example.com/file.txt" class="thickbox">Text file</a>
    <a href="http://example.com/file.swf" class="thickbox">Adobe Flash</a>

Here is sample codes to open Google Maps, YouTube, Vimeo and DailyMotion. You need to use embedded URL.

    <a href="http://maps.google.com/maps?ll=51.477222,0&output=embed" class="thickbox">Google Maps</a>
    <a href="http://youtube.com/embed/K-Rs6YEZAt8" class="thickbox">YouTube</a>
    <a href="http://player.vimeo.com/video/12297655" class="thickbox">Vimeo</a>
    <a href="http://dailymotion.com/embed/video/xninjh" class="thickbox">DailyMotion</a>

\* You can set `width`, `height` and `modal` parameters if needed. For details, see [iFramed Content Examples](http://jquery.com/demo/thickbox/#container-5).

= AJAX Content =

Writing links to internal files and add "thickbox" to `a@class` (`<a class="thickbox">`), files on the same domain are opened without `<iframe>`. Like inline and iFramed content, window title is specified by `a@title` (`<a title="foo">`).

    <a href="file.html" class="thickbox">Static page</a>
    <a href="file.php?bar=baz" class="thickbox">Dynamic page</a>

\* You can set `width`, `height` and `modal` parameters if needed. For details, see [AJAX Content Examples](http://jquery.com/demo/thickbox/#container-6).

To force internal files to open inside `<iframe>`, Add `TB_iframe=true` parameter to `a@href` (`<a href="file?TB_iframe=true">`). Parameters after `TB_iframe` are removed (i.e. Parameters before `TB_iframe` are kept as query).

    <a href="foo.php?bar=baz&TB_iframe=true&modal=true" class="thickbox">Anchor</a>

\* In the code above, "&TB_iframe=true&modal=true" is removed and "bar=baz" is kept as query.
