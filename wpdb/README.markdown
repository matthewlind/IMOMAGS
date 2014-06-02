# wpdb - What is this?

This directory contains scripts that are used to generate JSON feeds that populate various pages and widgets across the IMO network. It's called WPDB because all of the scripts access the imomags WordPress Database. These scripts are designed to avoid bootstrapping an entire WordPress install just to return a little bit of data. All of the scripts in this directory use the database configuration in the **mysql.php** file. Many of the scripts in this directory are obsolete and no longer used. Here are a few that I know that we still need:

## Used Scripts

* *network-feed-cached.php* - This file could have it's own sepearate README. It is responsible for generating JSON feeds that appear all over the IMO network. The actual SQL queries for this script are in the *csf-queries.php* file. However, those queries run so slowly that a caching system needed to be developed. *network-feed-cached.php* handles the caching.

