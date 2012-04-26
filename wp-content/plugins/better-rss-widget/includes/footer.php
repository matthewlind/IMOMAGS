<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}
/**
 * footer.php - View for the footer on all plugin pages.
 *
 * @package Better RSS Widget
 * @subpackage includes
 * @author GrandSlambert
 * @copyright 2009-2011
 * @access public
 * @since 0.1
 */
?>

<div id="better_rss_widget_footer" class="better-rss-widget-footer">
     <div class="postbox" style="width:49%; float:left">
          <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Credits', 'better-rss-widget'); ?></h3>
          <div style="padding:8px;">
               <p>
                    <?php
                    printf(__('Thank you for trying the %1$s plugin - I hope you find it useful. For the latest updates on this plugin, vist the %2$s. If you have problems with this plugin, please use our %3$s or check out the %4$s.', 'better-rss-widget'),
                            $this->pluginName,
                            '<a href="http://plugins.grandslambert.com/plugins/better-rss-widget.html" target="_blank">' . __('official site', 'better-rss-widget') . '</a>',
                            '<a href="http://support.grandslambert.com/forum/better-rss-widget" target="_blank">' . __('Support Forum', 'better-rss-widget') . '</a>',
                            '<a href="http://docs.grandslambert.com/wiki/Better_RSS_Widget" target="_blank">' . __('Documentation Page', 'better-rss-widget') . '</a>'
                    );
                    ?>
               </p>
               <p>
                    <?php
                    printf(__('This plugin is &copy; %1$s by %2$s and is released under the %3$s', 'better-rss-widget'),
                            '2009-' . date("Y"),
                            '<a href="http://grandslambert.com" target="_blank">GrandSlambert, Inc.</a>',
                            '<a href="http://www.gnu.org/licenses/gpl.html" target="_blank">' . __('GNU General Public License', 'better-rss-widget') . '</a>'
                    );
                    ?>
               </p>
          </div>
     </div>
     <div class="postbox" style="width:49%; float:right">
          <h3 class="handl" style="margin:0; padding:3px;cursor:default;"><?php _e('Donate', 'better-rss-widget'); ?></h3>
          <div style="padding:8px">
               <p>
                    <?php printf(__('If you find this plugin useful, please consider supporting this and our other great %1$s.', 'better-rss-widget'), '<a href="http://plugins.grandslambert.com/" target="_blank">' . __('plugins', 'better-rss-widget') . '</a>'); ?>
                    <a href="http://plugins.grandslambert.com/better-rss-widget-donate" target="_blank"><?php _e('Donate a few bucks!', 'better-rss-widget'); ?></a>
               </p>
               <p style="text-align: center;"><a target="_blank" href="http://plugins.grandslambert.com/better-rss-widget-donate"><img width="122" height="47" alt="paypal_btn_donateCC_LG" src="http://grandslambert.com/paypal.gif" title="paypal_btn_donateCC_LG" class="aligncenter size-full wp-image-174"/></a></p>
          </div>
     </div>
</div>