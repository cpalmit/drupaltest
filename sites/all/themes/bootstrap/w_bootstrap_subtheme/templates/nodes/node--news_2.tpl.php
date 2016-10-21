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

<script>
(function ($) {
  $(document).ready(function() {
  	if ($(".player").children(".vimeo").length > 0)
      $('.player').css("padding-bottom","56%");
  });
}(jQuery));
</script>
<style>
	/* hides page (article) title & month in breadcrumb */
	.breadcrumb li.active.last,
	.breadcrumb li:nth-last-child(2) {
	  display: none;
	}
	.breadcrumb li:nth-last-child(3) {
	  color: #999;
	}

	.newsdate {
		position: relative;
		margin-bottom: 20px;
		font-family: Helvetica, sans-serif;
		color: #000000;
		font-style: italic;
		font-size: 8px;
		line-height: 14px;
		padding-bottom: 20px;
		display: block;
	}

	.field-name-field-newsdate {
		font-family: Swiss721BT, Helvetica, sans-serif;
		color:  #656565;
		font-size: 15px;
		line-height: 22px;
		position: relative;
		margin-bottom: 20px;
	}

	/* mobile or all */
	.node-news-2 {
		padding-top: 23px;
	}
	h2.news-title {
		font-family: 'Adobe Garamond Pro', serif;
		color:  #000000;
		font-size: 21px;
		line-height: 23px;
		font-weight: 400;
		margin-top: 0;
	}

	.newsimg img {
		width: 100%;
		height: auto;
	}

	.newsimg {
		margin-bottom: 20px;
	}

	.player {
		position: relative;
	}

	.player iframe,  
	.player embed {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
	}

	.player .videoWrapper {
	  padding-top: 0 !important;
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

		.date-display-single, .newsdate {
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
	    margin-top: -20px;
	    font-family: 'Swiss721BT',Helvetica,sans-serif;
	}

	.credit div {
	    display: inline;
	}

	img.full-width {
		max-width: 100%;
		width: 100%;
	}

	.caption p {
	    margin-top: 10px;
    	font-family: 'Swiss721BT',Helvetica,sans-serif;
	    color: #7a7a7a;
	    font-size: 14px;
	    line-height: 17px;
	    font-weight: 300;
	}

	.figure {
		margin-bottom: 25px;
	}

	.node-date {
		margin-bottom: 20px;
	}

</style>

<?php

if ($teaser) {
  // node is being displayed as a teaser
  // Anything here will show up when the teaser of the post is viewed in your taxonomies or front page
	// if (!$logged_in) {
	// 	hide($content['links']);
	// }
	// else {
	// 	hide($content['links']['#links']['node-readmore']);
	// }
	
	print "";
	$img_url = $field_master_image[0]['uri'];
	$alt = htmlentities($field_master_image[0]['alt'] ? $field_master_image[0]['alt'] : $title,ENT_QUOTES);
	$img_title = htmlentities($field_master_image[0]['title'] ? $field_master_image[0]['title'] : $title,ENT_QUOTES);
	print "
	<div class='listnewsdetails clearfix'>
		<div class='news-small-image'>
			<img src='" . image_style_url("news_0_thumbnail", $img_url) . "'  alt='$alt' title='$img_title' />
		</div>
		<div class='news-large-image'>
			<img src='" . image_style_url("news_0_medium", $img_url) . "'  alt='$alt' title='$img_title' />
		</div>
		<h3><a href='$node_url'>$title</a></h3>
		<div><span class='date-display-single'>" . format_date(strtotime($field_daily_published_date[0]['value']),'custom','F j, Y') . "</span></div>
		
		{$field_newsshortdesc[0]['value']}
		<br></div>";

} else {
	$type = $field_news_story_type[0]['value'];

?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> <?php print $type; ?> clearfix"<?php print $attributes; ?>>
	<div class="content"<?php print $content_attributes; ?>>

<?php
print "<h2 class='news-title'>$title</h2>\n";
print "<div class='node-date'>" . render($content['field_daily_published_date']) . "</div>";
	switch ($type) {
		case "story":	
			print "<div class='figure'>";	
			if ($field_news_video[0] != NULL) {
				// if the story has a video, that should show up, full width
				print render($content['field_news_video']);
			} else {
				// no video, should display the master image 
				$img_url = $field_master_image[0]['uri'];
				$alt = htmlentities($field_master_image[0]['alt'] ? $field_master_image[0]['alt'] : $title,ENT_QUOTES);
				$img_title = htmlentities($field_master_image[0]['title'] ? $field_master_image[0]['title'] : $title,ENT_QUOTES);
				print "<img class='full-width' src='" . image_style_url("news_0_image", $img_url) . "' alt='$alt' title='$img_title' />";
				if ($field_image_credit[0] != NULL) {
					print '<div class="credit">Credit: ';
					print render($content['field_image_credit']);
					print '</div>';
				}
			}
			print '</div>';
			print $field_newsfullstory[0]['value'];

			break;
		case "essay":
			print $field_newsfullstory[0]['value'];	
			foreach ($field_news_image_gallery as $image) {
				$img_url = $image['uri'];
				$alt = htmlentities($image['alt'] ? $image['alt'] : $title,ENT_QUOTES);
				$img_title = htmlentities($image['title'],ENT_QUOTES);
				print "
					<div class='figure'>
						<img class='full-width' src='" . image_style_url("news_0_image", $img_url) . "' alt='$alt' title='$img_title' />
						<div class='caption'>" . $image['image_field_caption']['value'] . "</div>
					</div>";
			}
			break;

	}

?>
		<br>
	</div>



	<?php print render($content['links']); ?>

	<?php print render($content['comments']); ?>

</div>
<?php
}
?>
