<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */

// theme override for news list views, ie News 2015
// so the tablet image can be loaded only when it is needed for the screen size
// (note: there is javascript code to do this in the News 2015 view header)

// add lazy load js
drupal_add_js(drupal_get_path('theme', 'w_bootstrap_subtheme') ."/js/jquery.lazyloadxt.min.js");
if (isset($row->field_field_tablet_image_1[0]['rendered']['#item']['uri'])) {
	$mobile_image_uri = $row->field_field_tablet_image_1[0]['rendered']['#item']['uri'];
	$mobile_image_alt = htmlentities($row->field_field_tablet_image_1[0]['rendered']['#item']['alt'],ENT_QUOTES);
	$mobile_image_title = htmlentities($row->field_field_tablet_image_1[0]['rendered']['#item']['title'],ENT_QUOTES);
	$mobile_image = file_create_url($mobile_image_uri);
	// needed for testing site, comment out for prod
	$mobile_image = "https://www.wellesley.edu/sites/default/files/" . trim($mobile_image_uri,"public://");
} else {
	$mobile_image_uri = $row->field_field_master_image[0]['rendered']['#item']['uri'];
	$mobile_image_alt = htmlentities($row->field_field_master_image[0]['rendered']['#item']['alt'],ENT_QUOTES);
	$mobile_image_title = htmlentities($row->field_field_master_image[0]['rendered']['#item']['title'],ENT_QUOTES);
	$mobile_image = image_style_url("news_0_medium", $mobile_image_uri);

}
// image for desktop view
if (isset($row->field_field_newsimage[0]['rendered']['#item']['uri'])) {
	$small_image_uri = $row->field_field_newsimage[0]['rendered']['#item']['uri'];
	$small_image_alt = htmlentities($row->field_field_newsimage[0]['rendered']['#item']['alt'],ENT_QUOTES);
	$small_image_title = htmlentities($row->field_field_newsimage[0]['rendered']['#item']['title'],ENT_QUOTES);
	$small_image = file_create_url($small_image_uri);
	$small_image = "https://www.wellesley.edu/sites/default/files/" . trim($small_image_uri,"public://");
} else {
	$small_image_uri = $row->field_field_master_image[0]['rendered']['#item']['uri'];
	$small_image_alt = htmlentities($row->field_field_master_image[0]['rendered']['#item']['alt'],ENT_QUOTES);
	$small_image_title = htmlentities($row->field_field_master_image[0]['rendered']['#item']['title'],ENT_QUOTES);
	$small_image = image_style_url("news_0_thumbnail", $small_image_uri);

}
// old news nodes have large image instead of tablet image
$large_image_uri = $row->field_field_largeimage[0]['rendered']['#item']['uri'];
$large_image_alt = htmlentities($row->field_field_largeimage[0]['rendered']['#item']['alt'],ENT_QUOTES);
$large_image_title = htmlentities($row->field_field_largeimage[0]['rendered']['#item']['title'],ENT_QUOTES);
$large_image = file_create_url($large_image_uri);
$large_image = "https://www.wellesley.edu/sites/default/files/" . trim($large_image_uri,"public://");


// if that image is missing, default to newsimage (small image)
if ($mobile_image_uri == "") {
	if ($large_image_uri) {
		$mobile_image = $large_image;
		$mobile_image_alt = $large_image_alt;
		$mobile_image_title = $large_image_title;
	} else {
		$mobile_image = $small_image;
		$mobile_image_alt = $small_image_alt;
		$mobile_image_title = $small_image_title;
	}
}

//echo var_dump($row->field_field_tablet_image_1);

// add a div which will hold the mobile image, and store the url to the image as a data field in the tag
//echo "<div class='mobile-img visible-xs' data-src='$mobile_image' data-loaded='false'><div class='temp'></div></div>";
echo "<img class='lazy visible-xs mobile-img' data-src='$mobile_image' alt='$mobile_image_alt' title='$mobile_image_title' /><noscript><img src='$mobile_image' alt='$mobile_image_alt' title='$mobile_image_title' /></noscript>";
echo "<img class='lazy hidden-xs desktop-img' data-src='$small_image' alt='$small_image_alt' title='$small_image_title' /><noscript><img src='$small_image'  alt='$small_image_alt' title='$small_image_title' /></noscript>";
// and then we can print the rest of the view fields
foreach ($fields as $id => $field) {
	if (!empty($field->separator))
		print $field->separator; 
	print $field->wrapper_prefix; 
	print $field->label_html; 
	print $field->content; 
	print $field->wrapper_suffix;
}

?>