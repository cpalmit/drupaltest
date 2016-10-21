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
a.blog_more {
    position: relative;
    top: -1px;
    background-image: linear-gradient(rgb(175, 175, 175), rgb(175, 175, 175));
    color: rgb(255, 255, 255);
    font-size: 9px;
    line-height: 12px;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 3px 14px 2px;
    border-radius: 2px;
}
a.blog_more:hover {
    background-image: linear-gradient(rgb(0, 39, 118), rgb(0, 39, 118));
    color: rgb(255, 255, 255);
}
.blog_section {
    position: relative;
    margin-top: 23px;
    margin-bottom: 7px;
    background-color: rgb(247, 247, 247);
    padding: 61px 40px 40px;
}
h2.blog_header {
    margin-top: 7px;
    margin-bottom: 15px;
    font-size: 28px;
    line-height: 31px;
    font-weight: 400;
}
.blog_image.portrait img {
    max-width: 35%;
    margin-top: 4px;
    margin-right: 29px;
    float: left;
}
.blog_image img {
    margin-top: -2px;
    margin-bottom: 24px;
    max-width: 100%;
    vertical-align: middle;
    display: inline-block;
    height: auto;
}
.blog_section.teaser .field-name-body,
.blog_section.teaser .field-name-body * {
    display: inline !important;
}
.blog_date_wrapper {
    position: absolute;
    top: 0px;
    right: 40px;
    display: inline-block;
    float: right;
    background-image: linear-gradient(rgb(230, 230, 230), rgb(230, 230, 230));
    font-family: 'Swiss721bt condensed', sans-serif;
    font-size: 7px;
    line-height: 19px;
    font-weight: 400;
    text-align: center;
    text-transform: none;
    overflow: visible;
    padding: 17px 11px 4px;
}
.blog_date {
    font-family: Swiss721bt, sans-serif;
    font-size: 28px;
    font-style: normal;
    font-weight: 100;
}
.blog_month {
    display: block;
    font-size: 10px;
}

.node-readmore,
.blog_usernames_blog {
    display: none !important;
}
@media (max-width: 767px) {
    a.blog_more {
        position: absolute;
        left: 0px;
        top: auto;
        right: 0px;
        bottom: 0px;
        display: block;
        margin-left: 0px;
        padding-top: 9px;
        padding-bottom: 9px;
        background-image: linear-gradient(0deg, rgb(219, 219, 219), rgb(247, 247, 247));
        color: rgb(151, 151, 151);
        text-align: center;
        border-radius: 0px;
    }
    .blog_date {
        display: inline;
        padding-right: 7px;
        font-size: 14px;
        font-weight: 100;
    }
    .blog_month {
        display: inline;
        font-family: Swiss721bt, sans-serif;
        font-size: 14px;
        font-weight: 100;
    }
}
@media (max-width: 479px) {
    .blog_image.portrait img {
        max-width: 100%;
    }
}
</style>
<?php
// hide($content['body']);
// hide($content['field_blogimage']);
// hide($content['field_blogdate']);



?>


<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>



    <div class="content"<?php print $content_attributes; ?>>
        <div class='blog_section clearfix <?php print ($teaser? "teaser" : ""); ?>'>
            <?php

                $day = format_date(strtotime($field_blogdate[0]["value"]), 'custom', 'd');
                $month_year = format_date(strtotime($field_blogdate[0]["value"]), 'custom', 'M, Y');
                print "
                <div class='blog_date_wrapper'>
                    <div class='blog_date'>$day</div>
                    <div class='blog_month'>$month_year</div>
                </div>";

                print "<h2 class='blog_header'>$title</h2>";
                if ($field_blogimage[0] != NULL) {
                    $img_class = $field_blogimage[0]["width"] > $field_blogimage[0]["height"] ? "landscape" : "portrait";
                    print "<div class='blog_image $img_class'>";
                    print render($content['field_blogimage']);
                    print "</div>";
                }
                print render($content['body']);
                if ($teaser) {
                    // node is being displayed as a teaser
                    // Anything here will show up when the teaser of the post is viewed in your taxonomies or front page
                    print " <a class='blog_more' href='$node_url'>more</a>";
                    

                }
            ?>
        </div>
    </div>

    <?php print render($content['links']); ?>

    <?php print render($content['comments']); ?>

</div>
