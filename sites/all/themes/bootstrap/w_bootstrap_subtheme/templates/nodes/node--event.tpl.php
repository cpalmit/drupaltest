<?php


/**Edited Version**/

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

.breadcrumb {
	display: none !important;
}


h3.event-detailed{
	font-family: Helvetica,Arial,sans-serif;
    font-size: 24px !important;
    font-weight: bold;
    line-height: 28px !important;
	
	}
	
.event-detailed-date {
	font-size: 12px;
	font-family: Helvetica, Arial, sans-serif;
	}
	
.date-display-single {
   font-family: Helvetica, Arial, sans-serif;
   font-size: 12px;
}	

.field-name-field-eventlinks {
    float: right;
   /* margin-right: -150px;*/
   /* width: 15%;*/
}

	/* hides page (article) title in breadcrumb */
	/*.breadcrumb li.active.last {
	  		display: none;
	}*/
	
	.node-event h2 {
			font-family: 'Adobe Garamond Pro', serif;
			color:  #000000;
			font-size: 24px;
			font-weight: 400;
			line-height: 28px;
			margin-top: 0;
		}
		
	.node-event img:nth-child(1)  {
			width: 100%;
			height: auto;
			margin-bottom: 20px;
			max-width: 750px;
	}		
	
		.sharethis-buttons {
			position: absolute;
			bottom: 35px;
			right: 10px;
		}	
		@media (max-width:1200px) {
			.sharethis-buttons {
				bottom: 25px;
			}
		}
		.sharethis-buttons .stButton .stLarge {
			border-radius: 50%;
			opacity: 1.0;
			-webkit-filter: grayscale(100%);
			width: 20px;
			height: 20px;
			background-size: 20px;
		}
		.sharethis-buttons .stButton .stLarge:hover {
			opacity: 1.0 !important;
			-webkit-filter: grayscale(0);
			background-position: 0 !important;
		}
		.fb-social-like-Facebook {
			width: 100%;
			border-top: 1px dashed #ddd;
			border-bottom: 1px dashed #ddd;
			padding: 7px 0;
		}
</style>

<?php
if ($teaser) {
  // node is being displayed as a teaser
  // Anything here will show up when the teaser of the post is viewed in your taxonomies or front page

      hide($content['field_eventname']);

	 
	  
  	print "<span style=\"float: left; margin: 5px 10px 10px 0px;\">";
  	print render($content['field_eventimage']);
  	print "</span>";
  	print "<div class=\"listeventdetails\">";
  
	 

	print "<h3>";
	print $field_eventname[0]['value'];
	print "</h3>";
	print render($content);
	/*print $field_eventdetails[0]['value'];*/
	
	
	
	print "<br></div>";
} else {
//full story
?>


<style>
	.right-column {
		display: none !important;
	}

.fa {
    float: left;
    padding-right: 6px;
    padding-top: 4px;
	/*float:left;
    width:10px;*/
}

.event_date { 
	font-size:12px;
	color: #333;
	line-height: 18px;
	/* width: 97%;
	float:right;*/
}

		
</style>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      hide($content['comments']);
      hide($content['links']);
	  hide($content['field_eventname']);
	  hide($content['field_eventtitle']);
	  hide($content['field_eventdetails']);
	  hide($content['field_eventimage']);
	  
	  hide($content['field_eventdate']);
	  hide($content['field_eventlocation']);
      hide($content['field_eventshortdesc2']);
	  hide($content['field_eventlinks']);
	  hide($content['field_eventadhocdates']);
	  
	  
	  
	  if ($field_eventlinks[0] != NULL) {
		print "<div class=\"field-name-field-eventlinks col-lg-2 hidden-sm hidden-md hidden-xs test1\">";
	  	print "<h3>Related Links</h3>";
	  	print $field_eventlinks[0]['value']. "<br>\n";
	  	print "</div>";	
	   }

	print "<div class=\"col-lg-10 col-md-12 col-sm-12 col-xs-12\">";
	  	
	  print render($content['field_eventimage']);
	  print "<br>\n";
	  
	  print "<h2 class=\"event-detailed\">".$field_eventname[0]['value']. "</h3>\n"; 
	  print "<h2 class=\"event-detailed\">".$field_eventtitle[0]['value']. "</h3>\n";
	  print render($content);
	  print "<br>";

	print "<div class=\"event-block\">";
		print "<i class=\"fa fa-clock-o\"></i>";
		print "<span class=\"event_date\">";
	  		//print either ad hoc date range or individual date
	   			if ($field_eventadhocdates[0] != NULL) {
	  				print $field_eventadhocdates[0]['value']. "<br>\n";
	   			}else{
	  	    		$displaydate = array('type' => 'long', 'label' => 'hidden');	
      				print render (field_view_field('node', $node, 'field_eventdate', $displaydate));
      		}
	   print "</span>";	
	print "</div>";
	
	print "<div class=\"event-block\">";
		print "<i class=\"fa fa-location-arrow\"></i>";
		print "<span class=\"event_date\">";
				print $field_eventlocation[0]['value']. "<br>\n";
			print "</span>";
	print "</div>";
	  
 	  print $field_eventshortdesc2[0]['value']. "<br>\n";
	 	  
	  print $field_eventdetails[0]['value']. "<br>\n";
		
	 if ($field_eventlinks[0] != NULL) {
		print "<div class=\"related_links hidden-lg col-md-12 col-sm-12 col-xs-12\">";
	  	print "<h3>Related Links</h3>";
	  	print $field_eventlinks[0]['value']. "<br>\n";
	  	print "</div>";	
	}
	print render($content['links']);
	print "</div>";
     
    ?>	

<style>
.related_links h3 {
 padding-bottom: 10px;
}


.related_links p, .related_links p a{
	margin: 5px 0px !important;
}

</style>
  </div>
 

  <?php print render($content['comments']); ?>

</div>
<?php
} 
?>