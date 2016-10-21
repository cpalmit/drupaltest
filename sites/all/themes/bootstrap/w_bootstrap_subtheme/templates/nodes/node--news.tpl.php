<?php

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
	/* hides page (article) title & month in breadcrumb */
	.breadcrumb li.active.last,
	.breadcrumb li:nth-last-child(2) {
	  display: none;
	}
	.breadcrumb li:nth-last-child(3) {
	  color: #999;
	}

	/* mobile or all */
		.node-news {
			padding-top: 23px;
		}
		.node-news h2 {
			font-family: 'Adobe Garamond Pro', serif;
			color:  #000000;
			font-size: 21px;
			line-height: 23px;
			font-weight: 400;
			margin-top: 0;
		}
		.node-news .field-name-field-newsdate {
			font-family: Swiss721BT, Helvetica, sans-serif;
			color:  #656565;
			font-size: 15px;
			line-height: 22px;
			position: relative;
			margin-bottom: 20px;
		}
		.newsimg img {
			width: 100%;
			height: auto;
			margin-bottom: 20px;
		}
		.node-news p a:hover {
			color: #2098F6;
		}
		.sharethis-buttons {
			position: absolute;
			bottom: 35px;
			right: 10px;
		}
		.sharethis-buttons .stButton {
			margin-left: 5px;
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

	/* tablet */
	@media (min-width: 768px) {
		.newsimg {
		  width: 50%;
		  margin-bottom: 0px;
		  margin-right: 20px;
		  margin-top: 5px;
		  float: left;
		}
	}


	.news-large-image img {
		width: 100%;
		height: auto;
		margin-bottom: 23px !important;
	}

	.news-small-image img {
		display: none !important;
	}

	.listnewsdetails h3,.node-teaser.node-news h2 {
		margin-top: 0 !important;
	}

	.listnewsdetails h3 a,.node-teaser.node-news h2 {
		font-family: 'Adobe Garamond Pro', serif;
		color: #434343;
		font-weight: 700;
		font-size: 18px;
		margin-bottom: 10px;
	}
	.listnewsdetails h3 a:hover {
		/*color: #428bca;*/
		color: #218bc1;
	}
	.date-display-single {
		font-family: Helvetica, sans-serif;
		color: #000000;
		font-style: italic;
		font-size: 8px;
		line-height: 14px;
		padding-bottom: 20px;
		display: block;
	}

	.listnewsdetails {
		margin-left: 0 !important;
	}

	.listnewsdetails p,.node-teaser.node-news p {
		font-size:10pt;
	}

	.listnewsdetails h3 a:hover {
		/*color: #428bca;*/
		color: #218bc1;
	}

	@media (min-width: 768px) {

		.news-small-image img {
			display: block !important;
			width: auto !important;
			height: auto;
			max-width: 185px;
			margin-bottom: 32px !important;
			float:left;
			margin:0 20px 32px 0;
		}
		.listnewsdetails .news-large-image img {
			display: none;
		}
		.listnewsdetails h3,.node-teaser.node-news h2 {
			margin-top: 0 !important;
		}

		.listnewsdetails h3 a,.node-teaser.node-news h2 {
			margin-top: 3px !important;
			font-size: 21px;
			line-height: 24px;
			font-family: 'Adobe Garamond Pro', serif;
			color: #434343;
		}

		.listnewsdetails h3 a:hover {
			margin-top: 3px !important;
			font-size: 21px;
			line-height: 24px;
			font-family: 'Adobe Garamond Pro', serif;
		}

		.date-display-single {
			font-size: 12px;
			line-height: 18px;
			padding-bottom: 8px;
			font-family: Helvetica, sans-serif;
			color: #000000;
			font-style: italic;
			display: block;
		}

		.listnewsdetails p,.node-teaser.node-news p {
			margin-top: 0;
			font-family: Helvetica, sans-serif;
			line-height: 18px;
			overflow: hidden;
		}
	}
	@media (min-width: 992px) {
		.listnewsdetails h3 a,.node-teaser.node-news h2 {
			font-size: 24px;
			line-height: 28px;
		}

		.listnewsdetails h3 a:hover {
			font-size: 24px;
			line-height: 28px;
		}
	}

	.node-news.node-teaser .links.inline {
		list-style-type: none;
	}

	.credit {
	    height: 20px;
	    padding-right: 10px;
	    padding-left: 10px;
	    color: #f8f5f5;
	    font-size: 10px;
	    font-weight: 300;
	    text-align: left;
	    text-shadow: 1px 1px 0 #000;
	    margin-top: -40px;
	    font-family: 'Swiss721BT',Helvetica,sans-serif;
	}

	.credit div {
	    display: inline;
	}
</style>

<?php
if ($teaser) {
  // node is being displayed as a teaser
  // Anything here will show up when the teaser of the post is viewed in your taxonomies or front page

	  //hide($content['field_newsheadline']);
	  hide($content['field_newsdatenew']);
	  hide($content['field_newsfullstory']);

	  hide($content['field_newsimage']);
	  hide($content['field_master_image']);
	  hide($content['field_newsshortdesc']);
	  hide($content['links']);
	  /*daily shot*/
	  hide($content['field_dailylink']);
	  //hide($content['field_largeimage']);
	  hide($content['field_largeimagedesc']);
	  hide($content['field_daily_published_date']);
	  hide($content['field_daily_icon']);

	  if (!$logged_in) {
	    hide($content['links']);
	  }
	  else {
	    hide($content['links']['#links']['node-readmore']);
	  }
	  
	  print "<div class=\"listnewsdetails clearfix\">";
	  // small image, floats on the left
	  print "<div class='news-small-image'>";
	  if ($field_newsimage[0] != NULL) {
		// if a small image has been uploaded, use that
		print render($content['field_newsimage']);
	  } else {
	  	// if a small image hasn't been uploaded, use the master
		$img_url = $field_master_image[0]['uri'];
		print "<img src='" . image_style_url("news_1_small", $img_url) . "' />";
	  }
	  print "</div>";

	  // large image, full width for small displays
	  print "<div class='news-large-image'>";
	  if ($field_largeimage[0] != NULL) {
		// if a large image has been uploaded, use that
		print "<!-- large image -->";
		print render($content['field_largeimage']);
	  } else {
	  	// if a small image hasn't been uploaded, use the master
		print "<!-- master image crop -->";
		$img_url = $field_master_image[0]['uri'];
		print "<img src='" . image_style_url("news_3_large", $img_url) . "' />";
	  }
	  print "</div>";


	  // RR 03/29/2012 As per cpong
	  // If the field_newslink is not empty use it as the link.

	  $target = "";

	  if (!$field_newslink[0]) {
	    $link_to_add = $field_newslink['und'][0]['url'];
	    $parts = explode("/",$link_to_add);
	    if (preg_match('/wellesley.edu/i',$parts[2]) == 0) {
	      $target = " target=_wnews ";
	    }
	  }
	  if (trim($link_to_add) == "") {
	    $link_to_add = $node_url;
	    $target = "";
	  }

	print "<h3><a $target href=\"";
	print $link_to_add;
	print "\">";
	print $title;
	print "</a></h3>";
	print render($content);
	print $field_newsshortdesc[0]['value'];
	//echo print_r($content['field_largeimage']);



	print "<br></div>";
} else {
//full story
	/*
		["field_newsheadline"]
		["field_newsimage"]
		["field_newsmetadata"]
		["field_newslink"]
		["field_newsfullstory"]
	*/
?>


<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>



  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
   	  hide($title);
      hide($content['comments']);
      hide($content['links']);
	  hide($content['field_newsheadline']);
	  hide($content['field_master_image']);
	  hide($content['field_mobile_image']);
	  hide($content['field_tablet_image']);
	  hide($content['field_largeimage']);
	  hide($content['field_newsimage']);
	  hide($content['field_imagecaption']);
	  hide($content['field_newsfullstory']);
	  hide($content['field_newslink']);
	  hide($content['field_newstag']);
	  hide($content['field_newsshortdesc']);
	  hide($content['field_displayorder']);
	  hide($content['field_news_category']);
	  hide($content['field_news_blurb']);
	  hide($content['locations']);
	  hide($content['field_source_logo']);
	  hide($content['field_image_credit']);
	  /*daily shot*/
	  hide($content['field_dailylink']);
	  hide($content['field_largeimage']);
	  hide($content['field_largeimagedesc']);
	  hide($content['field_daily_published_date']);
	  hide($content['field_daily_icon']);
	  hide($content['field_daily_promote']);

	   //RR Avoid creating errors by first checking for existence
	   if ($field_newsheadline[0] != NULL) {
	     print "<h2>".$field_newsheadline[0]['value']. "</h2>\n";
	   }

	   print render($content);


	    /* ideally print tablet image,
	    if it doesn't exist look for large image,
	    if that doesn't exist print news image */
	
		// a few specific nodes which find the wrong image given the empty large image, so ignore them
		$excluded_nids = array("14867","24033","29842","31092","30909","30899","26379");
		// if all we can find is the small image, and it is lt 300 px, don't show any image
	    $use_small = intval($field_newsimage[0]["width"]) >= 300;
	    print '<div class="newsimg">';
		if ($field_tablet_image[0] != NULL) {
			print render($content['field_tablet_image']);
		} else if ($field_master_image[0] != NULL) {
		  	// if a tablet image hasn't been uploaded, use the master
			print "<!-- master image crop -->";
			$img_url = $field_master_image[0]['uri'];
			print "<img src='" . image_style_url("news_2_tablet", $img_url) . "' />";
		} else if ($field_largeimage[0] != NULL) {
	 		print render($content['field_largeimage']);
		} else if (intval(substr($field_newsdate[0]["value"],0,4)) <= 2014 && !in_array($node->nid,$excluded_nids)) {
			// for old news nodes (2014 and earlier), try to find a correspoding dailyshot node which contains a large image
			// first, try finding a dailyshot which links to the news node
			$query = new EntityFieldQuery();

			$query->entityCondition('entity_type', 'node')
			  ->propertyCondition('type', 'dailyshot')
			  ->fieldCondition('field_dailylink', 'URL', "/".$node->nid."(/.*)?$", 'REGEXP')
			  ->range(0,1);

			$result = $query->execute();
			
			if (isset($result['node'])) {
				$news_items_nids = array_keys($result['node']);
				$news_items = entity_load('node', $news_items_nids);
				$ds_node = array_values($news_items);
				$uri = $ds_node[0]->field_largeimage["und"][0]['uri'];
				$url = file_create_url($uri);
				echo "<img src='$url'>";
			} else {
				// if can't find matching dailyshot with link, look for the news date in the dailyshot title
				$date = format_date(strtotime($field_newsdate[0]["value"]), 'custom', 'F j, Y');
				$query = new EntityFieldQuery();

				$query->entityCondition('entity_type', 'node')
				  ->propertyCondition('type', 'dailyshot')
				  ->propertyCondition('title',$date, '=')
				  ->range(0,1);

				$result = $query->execute();
				if (isset($result['node'])) {
					//echo "pulling dailyshot image - via date/title<br>";
					$news_items_nids = array_keys($result['node']);
					$news_items = entity_load('node', $news_items_nids);
					$ds_node = array_values($news_items);
					$uri = $ds_node[0]->field_largeimage["und"][0]['uri'];
					$url = file_create_url($uri);
					echo "<img src='$url'>";
				} else {
					// if still can't find matching dailyshot, search for basic page with date in title
					// and try to extract an image from body
					$query = new EntityFieldQuery();

					$query->entityCondition('entity_type', 'node')
					  ->propertyCondition('type', 'page')
					  ->propertyCondition('title',$date, '=')
					  ->range(0,1);

					$result = $query->execute();
					if (isset($result['node'])) {
						$news_items_nids = array_keys($result['node']);
						$news_items = entity_load('node', $news_items_nids);
						$ds_node = array_values($news_items);
						$body_html = $ds_node[0]->body["und"][0]['value'];
						preg_match_all('~<img.*?src=["\']+(.*?)["\']+~', $body_html, $urls);
						$urls = $urls[1];
						if (count($urls) > 0) {
							$url = $urls[0];
							echo "<img src='$url'>";
						} else {
							// didn't find url
						  	if ($use_small)
								print render($content['field_newsimage']);
							else 
								print "<style>.newsimg {display: none;}</style>";
						}
					} else {
						// didn't find basic page
					  	if ($use_small)
							print render($content['field_newsimage']);
						else 
							print "<style>.newsimg {display: none;}</style>";
					}
				}
			}
		} else {
		  	if ($use_small)
				print render($content['field_newsimage']);
			else 
				print "<style>.newsimg {display: none;}</style>";
		}
		if ($field_image_credit[0] != NULL) {
			print '<div class="credit">Credit: ';
			print render($content['field_image_credit']);
			print '</div>';
		}
		print '</div>';


	  print render($content['field_imagecaption']);

	  print $field_newsfullstory[0]['value']. "<br>\n";


    ?>
  </div>

<?php


/**
* fieldlabels used by news:
* field_newsheadline
* field_newsdate
* field_newsimage
* field_imagecaption
* field_newsfullstory
* field_newslink
*
*/
?>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</div>
<?php
}
?>
