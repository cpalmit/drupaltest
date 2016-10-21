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

$intruder = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
    <style>
        .stroke {
            fill:none;
            stroke:#fff;
            stroke-width:8px;
            stroke-linecap:round; 
        }
        .fill {
            fill:#fff;
        }
    </style>
    <path class="fill" d="M133.2,173.2H67.9c-2.2,0-4-1.8-4-4v-19.6c0-2.2,1.8-4,4-4h65.4c2.2,0,4,1.8,4,4v19.6C137.2,171.4,135.4,173.2,133.2,173.2z"></path>
    <g class="stroke">
        <path d="M114,86.9H87.1c-6,0-10.8,4.9-10.8,10.8v36.7h48.6V97.7C124.8,91.7,120,86.9,114,86.9z"></path>
        <line x1="130.7" y1="72.3" x2="152" y2="51.1"></line>
        <line x1="145.8" y1="98.9" x2="173" y2="98.9"></line>
        <line x1="70.3" y1="72.3" x2="49" y2="51.1"></line>
        <line x1="55.3" y1="98.9" x2="28" y2="98.9"></line>
        <line x1="100.8" y1="61.6" x2="100.8" y2="32"></line>
    </g>
</svg>';
$weather = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
     <style>
        .stroke {
            fill:none;
            stroke:#ffffff;
            stroke-width:7px;
            stroke-linecap:round; 
        }
    </style>
    <g class="stroke">
        <path d="M62.2,88.9c-34.5,0-30.4-47.1,2.4-42.5c6.8-38.7,57.8-38.2,66.6-2.8c45.5-18.9,54.3,45.3,18.4,45.3c-15.5,0-37.4,0-55.6,0"></path>
        <polyline points="81.7,81.5 61.4,120.3 91,120.3 54.4,184.1 "></polyline>
        <line x1="141.3" y1="103.7" x2="141.3" y2="184.3"></line>
        <line x1="106.4" y1="164.1" x2="176.2" y2="123.9"></line>
        <line x1="176.2" y1="164.1" x2="106.4" y2="123.9"></line>
        <polyline points="152.7,110.7 141.3,117.3 129.9,110.7"></polyline>
        <polyline points="129.9,177.3 141.3,170.7 152.7,177.3"></polyline>
        <polyline points="106.8,150.8 118.2,157.4 118.2,170.6"></polyline>
        <polyline points="175.9,137.2 164.4,130.7 164.4,117.5"></polyline>
        <polyline points="164.4,170.6 164.4,157.4 175.9,150.8"></polyline>
        <polyline points="118.2,117.5 118.2,130.7 106.8,137.2"></polyline>
        <path d="M38.8,117.3c1,8.9,2.7,27.9,3.1,31.8c0.9,11.5-6.1,18.9-16.2,16.1s-12.4-12.7-5.7-22.2C22.1,139.9,33.3,124.5,38.8,117.3z"></path>
    </g>
</svg>';
$notice = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 80">
    <style>
        .stroke {
            fill:none;
            stroke:#fff;
            stroke-width:6px;
            stroke-linecap:round; 
            stroke-linejoin:round; 
        }
        .fill {
            fill:#fff;
        }
    </style>
    <polygon class="stroke" points="5.2,76.4 45,7.6 84.8,76.4 "></polygon>
    <g class="fill">
        <path d="M48.2,31.3v11.7l-1.5,17.2h-3.3l-1.6-17.2V31.3H48.2z"></path>
        <rect x="42" y="63.4" width="6" height="6"></rect>
    </g>
</svg>';
?>


<style>

.main-container .col-sm-4, 
.main-container .col-md-4,
.main-container .col-md-12 {
    position: static;
}

.homepage-alert {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 9999;
}

.homepage-alert.intruder {
    background-color: #be0000;
}

.homepage-alert.weather {
    background-color: #a0aeca;
}

.homepage-alert.notice {
    background-color: #002776;
}

.homepage-alert {
    display: block;
    background-color: #dfdfdf;
    background-image: -webkit-linear-gradient(90deg, rgba(0, 0, 0, .26), rgba(0, 0, 0, .1) 5%);
    background-image: linear-gradient(0deg, rgba(0, 0, 0, .26), rgba(0, 0, 0, .1) 5%);
}

.homepage-alert p {
    color: #fff !important;
}

.alert_icon {
    width: 60px;
    height: 60px;
    margin-right: 29px;
    float: left;
    -webkit-box-flex: 0;
    -webkit-flex: 0 0 auto;
    -ms-flex: 0 0 auto;
    flex: 0 0 auto;
}

.alert_wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 0px;
    padding: 9px 20px;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
}

.homepage-alert a {
    color: #fff;
    text-decoration: underline;
}

@media (max-width: 479px) {
    .alert_wrapper {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
    }
    .alert_icon {
        display: block;
        width: 100px;
        height: 100px;
        margin-right: auto;
        margin-bottom: 23px;
        margin-left: auto;
        -webkit-align-self: flex-start;
        -ms-flex-item-align: start;
        align-self: flex-start;
        -webkit-box-flex: 0;
        -webkit-flex: 0 auto;
        -ms-flex: 0 auto;
        flex: 0 auto;
    }
}


</style>

<script type="text/javascript">
    (function ($) {
        $(document).ready(function() {
            var alert = $(".homepage-alert").detach().css({"position":"static"});
            $("#navbar").prepend(alert);
        });
    }(jQuery));

</script>

<?php if (!$teaser): ?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> homepage-alert <?php print $field_alert_type[0]["value"]; ?> clearfix"<?php print $attributes; ?>>
    <div class="w-container alert_wrapper fluid-container">
        <div class="w-embed alert_icon">
            <?php
                print ${$field_alert_type[0]["value"]};
            ?>
        </div>
        <div>
            <?php print render($content['body']); ?>
        </div>
        <?php print render($content['links']); ?>
    </div>
</div>
<?php endif; ?>
