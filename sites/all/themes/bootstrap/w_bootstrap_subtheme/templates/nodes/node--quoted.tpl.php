<?php

/**Unedited WellesleyStandard Version**/
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
?>

<style>
.listquotedetails {
    margin-left: 165px;
    margin-top: 0;
    position: relative;
}
</style>
<?php


if ($teaser) {
  // node is being displayed as a teaser
  // Anything here will show up when the teaser of the post is viewed in your taxonomies or front page

	
	      // We hide the comments and links now so that we can render them later.
     /* hide($content['comments']);
      hide($content['links']);
	  hide($content['field_quotation']);
	  hide($content['field_noted_headline']);
	  
	  hide($content['field_quoted_tags']);
	  hide($content['field_quoted_url']);*/
	  hide($content['field_quoted_image']);/*
	  hide($content['field_quoted_date']);
*/
	 
	 /*  print $field_quoted_date[0]['value']. "<br>\n";
	  print "<h3>".$field_quotation[0]['value']. "</h3>\n";
	  print "<h3>".$field_noted_headline[0]['value']. "</h3>\n";
	  
	  
	  */
	  print "<span style=\"float: left; margin: 0px 10px 10px 0px;\">";
	    print render($content['field_quoted_image']);
	  print "</span>";
	  print "<div class=\"listquotedetails\">";  
	    print render($content);
	  print "<br></div>";


} else {
//full story
?>


<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

 

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
     /* hide($content['comments']);
      hide($content['links']);
	  hide($content['field_quotation']);
	  hide($content['field_noted_headline']);
	  
	  hide($content['field_quoted_tags']);
	  hide($content['field_quoted_url']);*/
	  hide($content['field_quoted_image']);/*
	  hide($content['field_quoted_date']);
*/
	 
	 /*  print $field_quoted_date[0]['value']. "<br>\n";
	  print "<h3>".$field_quotation[0]['value']. "</h3>\n";
	  print "<h3>".$field_noted_headline[0]['value']. "</h3>\n";
	  
	  
	  */
	  print "<span style=\"float: left; margin: 0px 10px 10px 0px;\">";
	    print render($content['field_quoted_image']);
	  print "</span>";
	  print "<div class=\"listquotedetails\">";  
	    print render($content);
	  print "<br></div>";


/*[field_noted_headline] == Content: Noted Headline
[field_quotation] == Content: Quotation
[field_quoted_date] == Content: Quoted Date
[field_quoted_image] == Content: Quoted Image
[field_quoted_tags] == Content: Quoted Tags
[field_quoted_url] == Content: Quoted URL
[field_quoted_url-url] == Raw url
[field_quoted_url-title] == Raw title
[field_quoted_url-attributes] == Raw attributes

	print $field_quoted_url['und'][0]['url'];
*/
     
    ?>
  </div>
  
<?php


/**
field_quotation	
field_noted_headline
field_quoted_url
field_quoted_tags
field_quoted_image
field_quoted_date
*/



?>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</div>
<?php
} 
?>