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

    div.category {
        width: 92%;
        background-color: #ccc;
        color: #fff;
        padding: 1px 0px;
        text-align: center;
        display: inline-block;
    }

    .project_gallery {
        clear: left;
        float: left;
        list-style-type: none;
        padding-left: 0 !important;
    }
    .project_gallery a {
        display: inline-block;
        position: relative;
        float: left;
        width: 215px;
        height: 150px;
        margin-right: 23.3px;
        margin-bottom: 23.3px;
        overflow: hidden;
    }
    .project_gallery a.last {margin-right: 0; }
    .project_gallery a .proj-link-wrap {
        /*display: block;*/
        width: 100%;
        height: 100%;
        /*background-size: 215px 150px !important;*/
    }
    .project_gallery a .short-title {
        /* here */
        margin: 0 auto !important;
        text-align: center;
        color: #ffffff;
        background-color: #696969;
        background-color: rgba(0,0,0,0.7);
        padding: 10px;
        position: absolute;
        bottom: 0;
        width: 100%;
    }
    .project_gallery a:hover .short-title {
        background-color: rgba(0,0,0,0.9);
    }
    .project_gallery a .proj-title {
        display: none;
    }
    .project_gallery a:hover .proj-title {
        display: block;
    }
    .project_gallery a .proj-title a {
        font-size: 16px;
        font-family: 'Arial', sans-serif;
        color: #fff !important;
        background-color: #696969 ; /*backup*/
        background-color: rgba(0,0,0,0.7);
        display: block;
        width: 100%;
        height: 100%;  /* here */
        padding: 15px 10px 10px 10px;
        position: absolute;
        top: 0;
        z-index: 2;
    }

    .proj-img img {
        width: 100%;
        height: auto;
    }

    @media (max-width: 1280px) {

        .project_gallery a {
            width: 30%;
            height: 161.5px;
            margin-right: 3%;
        }

        div.project_category {
            width: 96%;
        }
    }

    @media (max-width: 991px) {

        .project_gallery a {
            width: 48%;
            height: auto;
            margin-right: 2%;
        }


        div.project_category {
            width: 98%;
        }
        
    }

    
    @media (max-width: 479px) {

        .project_gallery a {
            width: 100%;
            height: auto;
            margin-right: 0;
        }


        div.project_category {
            width: 100%;
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
        <div class='project_gallery clearfix <?php print ($teaser? "teaser" : ""); ?>'>
            <?php

                print "<div class='faqs'>";
                foreach($node->field_project_images['und'] as $image){
                    $url = image_style_url('project_image_mobile',$image['uri']);
                    print "
                        <a href='{$image['alt']}'>
                            <div class='proj-img'><img src='$url' alt='{$image['title']}'></div>
                            <div class='short-title'>{$image['title']}</div>
                        </a>";    
                    
                }

                print "</div>";
            ?>
        </div>
    </div>

    <?php print render($content['links']); ?>

    <?php print render($content['comments']); ?>

</div>
