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

// for the /news page daily shot view
// if there is a video and the video will not be showed on home, show the play button
	

// and then we can print the rest of the view fields
foreach ($fields as $id => $field) {
    if ($id == "field_news_video_on_home") {
        // for the play button, add a div with a relative position wrapping the image and the svg
        print "<div style='position:relative;padding-bottom:30px;'>";
        if ($row->field_field_news_video != NULL && $row->field_field_news_video_on_home[0]["raw"]["value"] == "0"): ?>       
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400" width="100px" height="100px" style="position: absolute; top: 50%; left: 50%; -ms-transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%);pointer-events:none;">
        <style>
            .cirWhiteFill01, .cirWhiteFill02, .triFill {fill:#ffffff;}
            @keyframes cir_stroke {
                0% { opacity: 0; stroke-dashoffset: 0;}
                15% { opacity: 0; stroke-dashoffset: 100;}
                31% { opacity: 0.6; }
                32% { opacity: 0.5; stroke-dashoffset: 0;}
                50% { opacity: 0; }
            }

            .triStroke,
            .cirStroke {
                fill:none;
                stroke:#ffffff;
                stroke-width:6px;
                opacity: 0;
            }

            .triStroke {
                stroke-dasharray: 500;
                animation: tri_stroke 4s ease infinite;
            }
            .cirStroke {
                stroke-dasharray: 900;
                animation: cir_stroke 4s ease infinite;
            }



            .triFill {
                animation: btn_fill 4s ease-out infinite;
            }
            .cirBlueFill {
                fill:#002776;
            }

            @keyframes cir_white_fill_a {
                0% { opacity: 0;}
                29% { opacity: 0; transform-origin: 200px 200px; transform: scale(1);}
                35% { opacity: 0.6;}
                60% { opacity: 0; transform-origin: 200px 200px; transform: scale(2);}
                100% { opacity: 0; transform-origin: 200px 200px; transform: scale(1);}
            }
            @keyframes cir_white_fill_b {
                0% { opacity: 0;}
                32% { opacity: 0; transform-origin: 200px 200px; transform: scale(1);}
                45% { opacity: 0.6;}
                70% { opacity: 0; transform-origin: 200px 200px; transform: scale(2);}
                100% { opacity: 0; transform-origin: 200px 200px; transform: scale(1);}
            }
            .cirWhiteFill01 {
                animation: cir_white_fill_a 4s ease infinite;
            }
            .cirWhiteFill02 {
                animation: cir_white_fill_b 4s ease infinite;
            }

        </style>
        <circle class="cirWhiteFill02" cx="200" cy="200" r="100"></circle>
        <circle class="cirWhiteFill01" cx="200" cy="200" r="100"></circle>
        <circle class="cirBlueFill" cx="200" cy="200" r="100"></circle>
        <circle class="cirStroke" cx="200" cy="200" r="100"></circle>
        <polygon class="triFill" points="176,200 176,156.7 213.2,178.3 250.5,200 213.2,221.7 176,243.3"></polygon>
        <polygon class="triStroke" points="176,200 176,156.7 213.2,178.3 250.5,200 213.2,221.7 176,243.3"></polygon>
    </svg>
<?php
        endif;
    }   
	if (!empty($field->separator))
		print $field->separator; 
	print $field->wrapper_prefix; 
	print $field->label_html; 
	print $field->content; 
	print $field->wrapper_suffix;
    if ($id == "field_news_video_on_home") {
        // end the div wrapping the svg and the image
        print "</div>";
    }
}

?>