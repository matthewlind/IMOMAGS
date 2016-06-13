<?php
/*
Plugin Name: IMO Primary Category
Plugin URI: http://imomags.com/
Description: You can choose a Primary Category in posts.
Version: 1.00
Author: Fox Bowdem
Author URI: http://imomags.com/
*/

/**!
*
* I, Hikari, from http://Hikari.WS , and the original author of the Wordpress plugin named
* Hikari Category Permalink, please keep this license terms and credit me if you redistribute the plugin
*
*   This program is distributed in the hope that it will be useful,
*    but WITHOUT ANY WARRANTY; without even the implied warranty of
*    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*
/*****************************************************************************
* © Copyright Hikari (http://wordpress.Hikari.ws), 2010
* If you want to redistribute this script, please leave a link to
* http://hikari.WS
*
* Parts of this code are provided or based on ideas and/or code written by others
* Translations to different languages are provided by users of this script
* IMPORTANT CONTRIBUTIONS TO THIS SCRIPT (listed in alphabetical order):
*
** Hikari Category Permalink is a fork of Dmytro Shteflyuk's sCategory Permalink plugin < http://kpumuk.info/projects/wordpress-plugins/scategory-permalink/ >
** Nikolay Kolev < http://nikolay.com/ > developed the JavaScript UI software to manage category permalink in posts edit page.
*
* Please send a message to the address specified on the page of the script, for credits
*
* Other contributors' (nick)names may be provided in the header of (or inside) the functions
* SPECIAL THANKS to all contributors and translators of this script !
*****************************************************************************/

define('IMOprimaryCat_basename',plugin_basename(__FILE__));
define('IMOprimaryCat_pluginfile',__FILE__);

require_once 'imo-primary-category-tools.php';
require_once 'imo-primary-category-core.php';

/***
**
** Display functions
**
***/

//get the cat ID 
add_action('init', 'the_primary_category_ID');
function the_primary_category_ID($cat_base = null) {
	
	$id = get_the_ID();
	$allCats = get_the_category( $id );
	
	
	$categoryID = get_post_meta($id);
	$catID = $categoryID["_category_permalink"];
	
	
	$obj = (object) $catID[0];
	return $obj->scalar; 
	
	  
	 
	
}

//get the cat slug 
add_action('init', 'the_primary_category_slug');
function the_primary_category_slug($cat_base = null) {
	
	$id = get_the_ID();
	$allCats = get_the_category( $id );
	
	
	$categoryID = get_post_meta($id);
	$catID = $categoryID["_category_permalink"];
	$categoryName = get_term_by('id', $catID[0], 'category');
	$slug = $categoryName->slug;
	
	return $slug;
	
}





//Show only the primary category
add_action('init', 'the_primary_category');
function the_primary_category($cat_base = null) {
	
	$id = get_the_ID();
	$allCats = get_the_category( $id );
	
	
	$categoryID = get_post_meta($id);
	$catID = $categoryID["_category_permalink"];
	
	$categoryName = get_term_by('id', $catID[0], 'category');
	$primary = $categoryName->name;
	$url = $categoryName->slug;
	
	$parent = $categoryName->parent;
	
	if($parent !=0){
			$catParent = get_the_category_by_ID( $parent );
			$catParent = strtolower($catParent."/"); 
			$catParent = str_replace(" &amp; ", "-", $catParent);
	}else{
		$catParent = "";
	}

	if($catID){
		$categories = '<span class="cat-label"><a class="category-name-link primary-cat" onclick="_gaq.push([&#39;_trackEvent&#39;,&#39;Primary Category&#39;,&#39;'.$categoryName->name.'&#39;]);" href="'.$cat_base.'/'.$catParent.$url.'">'.$primary.'</a>';
	}
    
    
    
	$categories .= '</span></span>';
	
	return $categories;
	
}

//Show the primary category followed by the other categories
add_action('init', 'primary_and_secondary_categories');
function primary_and_secondary_categories($cat_base = null, $separator = '') {

	$id = get_the_ID();
	$allCats = get_the_category( $id );
	
	
	$categoryID = get_post_meta($id);
	$catID = $categoryID["_category_permalink"];
	
	$categoryName = get_term_by('id', $catID[0], 'category');
	$primary = $categoryName->name;
	$url = $categoryName->slug;
	
	$parent = $categoryName->parent;
	
	if($parent !=0){
			$catParent = get_the_category_by_ID( $parent );
			$catParent = strtolower($catParent."/"); 
			$catParent = str_replace(" &amp; ", "-", $catParent);
	}else{
		$catParent = "";
	}


	$categories = '<span class="cat-feat-label">';
	
	if($catID){
		$categories_a = '<a class="category-name-link primary-cat" onclick="_gaq.push([&#39;_trackEvent&#39;,&#39;Primary Category&#39;,&#39;'.$categoryName->name.'&#39;]);" href="'.$cat_base.'/'.$catParent.$url.'">'.$primary.'</a>'.$separator.' ';
	}
    
    
    $slugArray = array(   
    	"", 	
    	"defend-thyself",
        "for-the-love of-competition",
		"history-books",
		"news-brief",
		"sons-of-guns-and-ammo",
		"the-front-lines",
		"zombie-nation", 
		"blogs",
		"featured",
		"home-featured",
		"affiliates",
		"man-on-the-street",
		"ga-perspectives",
		"galleries",
		"ga-Lists ",
		"video",
		"ga-tv",
		"shot-show-featured",
		"sponsored",
		"uncategorized",
		"network-topics",
		"culture-politics-network",
		"personal-defense-network",
		"survival-network",
		"the-gear-network",
		"the-guns-network",
		"other-fish",
		"kehdes-blog",
		"quinns-blog",
		"pyzers-blog",
		"schmidts-blog",
		"simpsons-blog",
		"south",
		"stanges-blog",
		"straws-blog",
		"canada",
		"west",
		"international",
		"midwest",
		"new-england",
		"northeast",
		"timely-features",
		"in-fisherman-blogs",
		"midwest-finesse",
		"online-exclusives",
		"sponsored"
    );
	
    foreach($allCats as $cat){
    	//var_dump($allCats);
	    $slug = $cat->slug;
	    $name = $cat->name;
	    
		$parents = $cat->parent;
		
		if($parents != 0){
			$SecondaryCatParent = get_the_category_by_ID( $parents );
			$SecondaryCatParent = str_replace(" &amp; ", "-", $SecondaryCatParent);
			$SecondaryCatParent = strtolower($SecondaryCatParent."/"); 

		}else{
			$SecondaryCatParent = "";
		}

	    if(!array_search($slug,$slugArray) && $slug != $url){
		    $categories_a .= '<a class="category-name-link" onclick="_gaq.push([&#39;_trackEvent&#39;,&#39;Category&#39;,&#39;'.$cat->name.'&#39;]);" href="'.$cat_base.'/'.$SecondaryCatParent.$slug.'">'.$name.'</a>'.$separator.' ';
	    }
    }
    $categories .= trim($categories_a, ', ');
    
	$categories .= '</span>';
	
	return $categories;
	
}




























