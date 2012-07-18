<?php

/**
 * Helper for reading and writing files
 * 
 * @package News Widget for WordPress
 * @author Sitebase (http://www.sitebase.be)
 * @version 1.1
 * @license http://codecanyon.net/wiki/support/legal-terms/licensing-terms/
 * @copyright Copyright (c) 2008-2011 Sitebase (http://www.sitebase.be)
 */
class HtmlHelper {
	
	const HTML_LABEL_FORMAT 		= '<label for="%s"%s>%s</label>';
	const HTML_TEXTFIELD_FORMAT 	= '<input type="text" id="%s" name="%s" value="%s"%s />';
	const HTML_TEXTAREA_FORMAT 		= '<textarea id="%s" name="%s"%s>%s</textarea>';
	const HTML_SELECT_FORMAT 		= '<select id="%s" name="%s"%s>%s</select>';
	const HTML_OPTION_FORMAT 		= '<option value="%s"%s>%s</option>';
	const HTML_CHECKBOX_FORMAT		= '<input id="%s" name="%s" value="%s" type="checkbox"%s />';
	const HTML_RADIOBUTTON_FORMAT	= '<input id="%s" name="%s" value="%s" type="radio"%s />';
	const HTML_STYLE_FORMAT			= '<link href="%s" type="text/css" rel="stylesheet"%s />';
	const HTML_SCRIPT_FORMAT		= '<script src="%s" type="text/javascript"%s></script>';
	
	// Enabled html entities filtering for attributes
	const ENABLE_ATTR_FILTER = true;
	
	/**
	 * Convert an array to an attribute string
	 * 
	 * @param array $attr_array
	 * @return string
	 */
	protected static function _arrayToAttrStr($attr_array){
		if(!is_array($attr_array) || count($attr_array) == 0) return '';
		if(self::ENABLE_ATTR_FILTER) $attr_array = array_map('htmlentities', $attr_array);
		$attr_str = '';
		foreach($attr_array as $key => $value){
			$attr_str .= ' ' . $key . '="' . $value . '"';
		}
		return $attr_str;
	}
	
	/**
	 * Generate list element
	 * 
	 * @param array $items
	 * @param array $attributes
	 * @return string
	 */
	protected static function _createList($tag='ul', $items, $attributes=array()) {
		$result = self::openTag($tag, $attributes) . PHP_EOL;
		foreach($items as $item_value => $item_attr) {
			if(isset($item_attr) && !is_array($item_attr)) $item_value = $item_attr;
			$result .= "\t" . self::tag('li', $item_value, $item_attr) . PHP_EOL;
		}
		$result .= self::closeTag($tag);
		return $result;
	}
	
	/**
	 * Generate label element
	 * 
	 * @param string $for
	 * @param string $value
	 * @param array $attributes
	 * @return string
	 */
	public static function label($for, $value, $attributes=array()) {
		$attr_str = self::_arrayToAttrStr($attributes);
		return sprintf(self::HTML_LABEL_FORMAT, $for, $attr_str, $value);	
	}
	
	/**
	 * Generate textfield element
	 * 
	 * @param string $id
	 * @param string $name
	 * @param string $value
	 * @param array $attributes
	 * @return string
	 */
	public static function textfield($id, $name, $value, $attributes=array()){
		$attr_str = self::_arrayToAttrStr($attributes);
		return sprintf(self::HTML_TEXTFIELD_FORMAT, $id, $name, $value, $attr_str);	
	}
	
	/**
	 * Generate checkbox element
	 * 
	 * @param string $id
	 * @param string $name
	 * @param string $value
	 * @param array $attributes
	 * @return string
	 */
	public static function checkbox($id, $name, $value, $checked=false, $attributes=array()){
		if($checked) $attributes['checked'] = 'checked';
		$attr_str = self::_arrayToAttrStr($attributes);
		return sprintf(self::HTML_CHECKBOX_FORMAT, $id, $name, $value, $attr_str);
	}
	
	/**
	 * Generate radiobutton element
	 * 
	 * @param string $id
	 * @param string $name
	 * @param string $value
	 * @param array $attributes
	 * @return string
	 */
	public static function radiobutton($id, $name, $value, $checked=false, $attributes=array()){
		if($checked) $attributes['checked'] = 'checked';
		$attr_str = self::_arrayToAttrStr($attributes);
		return sprintf(self::HTML_RADIOBUTTON_FORMAT, $id, $name, $value, $attr_str);
	}
	
	/**
	 * Generate textarea element
	 * 
	 * @param string $id
	 * @param string $name
	 * @param string $value
	 * @param array $attributes
	 * @return string
	 */
	public static function textarea($id, $name, $value, $attributes=array()){
		$attr_str = self::_arrayToAttrStr($attributes);
		return sprintf(self::HTML_TEXTAREA_FORMAT, $id, $name, $attr_str, $value);	
	}
	
	/**
	 * Generate select element
	 * 
	 * @param string $id
	 * @param string $name
	 * @param array $values
	 * @param string $selected
	 * @param array $attributes
	 * @return string
	 */
	public static function select($id, $name, $values, $selected=null, $attributes=array()){
		$attr_str = self::_arrayToAttrStr($attributes);
		$options = PHP_EOL;
		foreach($values as $key => $value){
			$selected_string = ($selected == $value) || ($selected == $key) ? ' selected="selected"' : '';
			$options .= "\t" . sprintf(self::HTML_OPTION_FORMAT, $key, $selected_string, $value) . PHP_EOL;
		}		
		return sprintf(self::HTML_SELECT_FORMAT, $id, $name, $attr_str, $options);
	}
	
	/**
	 * Generate ul list element
	 * 
	 * @param array $items
	 * @param array $attributes
	 * @return string
	 */
	public static function ul($items, $attributes=array()) {
		return self::_createList('ul', $items, $attributes);
	}
	
	/**
	 * Generate ol list element
	 * 
	 * @param array $items
	 * @param array $attributes
	 * @return string
	 */
	public static function ol($items, $attributes=array()) {
		return self::_createList('ol', $items, $attributes);
	}
	
	/**
	 * Generate style element
	 * 
	 * @param string $src
	 * @param int $width
	 * @param int $height
	 * @param string $alt
	 * @param array $attributes
	 * @return string
	 */
	public static function img($src, $width=null, $height=null, $alt='', $attributes=array()){
		$attributes['src'] = $src;
		if(isset($width)) $attributes['width'] = $width;
		if(isset($height)) $attributes['height'] = $height;
		$attributes['alt'] = $alt;
		$attr_str = self::_arrayToAttrStr($attributes);	
		return self::tag('img', null, $attributes);
	}
	
	/**
	 * Generate style element
	 * 
	 * @param string $href
	 * @param string $content
	 * @param array $attributes
	 * @return string
	 */
	public static function a($href, $content, $attributes=array()){
		$attributes['href'] = $href;
		$attr_str = self::_arrayToAttrStr($attributes);	
		return self::tag('a', $content, $attributes);
	}
	
	/**
	 * Generate style element
	 * 
	 * @param string $src
	 * @param array $attributes
	 * @return string
	 */
	public static function style($src, $attributes=array()){
		$attr_str = self::_arrayToAttrStr($attributes);	
		return sprintf(self::HTML_STYLE_FORMAT, $src, $attr_str);
	}
	
	/**
	 * Generate script element
	 * 
	 * @param string $src
	 * @param array $attributes
	 * @return string
	 */
	public static function script($src, $attributes=array()){
		$attr_str = self::_arrayToAttrStr($attributes);	
		return sprintf(self::HTML_SCRIPT_FORMAT, $src, $attr_str);
	}
	
	/**
	 * Generate flash video element
	 * Adds an object for IE3 or later and embed fallback for netscape and other browsers
	 * 
	 * @param string $src
	 * @param int $width
	 * @param int $height
	 * @param array $attributes
	 * @param array $params
	 * @return string
	 */
	 public static function swf($src, $width, $height, $attributes=array(), $params=array()) {
	 	
	 	$attributes['classid'] = 'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000';
	 	$attributes['width'] = $width;
	 	$attributes['height'] = $height;
	 	$params['movie'] = $src;
	 	$result = self::openTag('object', $attributes) . PHP_EOL;
	 	foreach($params as $key => $value) {
	 		$result .= "\t" . self::tag('param', null, array('name' => $key, 'value' => $value)) . PHP_EOL;
	 	}
	 	
	 	$result .= '<!--[if !IE]>-->' . PHP_EOL;
	 	
	 	unset($attributes['classid']);
	 	unset($params['movie']);
	 	$attributes['data'] = $src;
	 	$result .= self::openTag('object', $attributes) . PHP_EOL;
	 	foreach($params as $key => $value) {
	 		$result .= "\t" . self::tag('param', null, array('name' => $key, 'value' => $value)) . PHP_EOL;
	 	}
		
	    $result .= '<!--<![endif]-->' . PHP_EOL;
        $result .= self::tag('p', 'No flash player installed!') . PHP_EOL;
	    $result .= '<!--[if !IE]>-->' . PHP_EOL;
	    $result .= self::closeTag('object') . PHP_EOL;
	    $result .= '<!--<![endif]-->' . PHP_EOL;

	 	$result .= self::closeTag('object');
	 	return $result;
	 } 
	
	/**
	 * Generate element start
	 * 
	 * @param string $tag
	 * @param attributes
	 * @param bool $close
	 * @return string
	 */
	public static function openTag($tag, $attributes=array(), $close=false){
		$attr_str = self::_arrayToAttrStr($attributes);
		$close_str = $close ? '/' : '';
		return '<' . $tag . $attr_str . $close_str . '>';
	}
	
	/**
	 * Generate element close
	 * 
	 * @param string $tag
	 * @return string
	 */
	public static function closeTag($tag){
		return '</' . $tag . '>';
	}
	
	/**
	 * General tag element
	 * 
	 * @param string $tag
	 * @param array $attributes
	 * @return string
	 */
	public static function tag($tag, $content=null, $attributes=array()) {
		if(in_array($tag, array('img', 'hr', 'embed', 'param', 'br'))) {
			return self::openTag($tag, $attributes, true);
		} else {
			return self::openTag($tag, $attributes) . $content . self::closeTag($tag);
		}
	}
}