<?php

/*function w_bootstrap_subtheme_js_alter(&$js) {

    $js['misc/jquery.js']['data'] = 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js';

    // Adding this ensures that the UI functionality gets added at all times!  Even when logged out of the site, since we have functionality on the site that requires this when logged out!
    if (!isset($js['misc/ui/jquery.ui.core.min.js']))
    {
        drupal_add_js('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js');
    }
    else
        $js['misc/ui/jquery.ui.core.min.js']['data'] = 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js';
}
*/
function w_bootstrap_subtheme_page_alter($page) {
  drupal_add_js(libraries_get_path('jquery.migrate') . '/jquery-migrate-1.2.1.min.js');

}

//CP commenting out for purposes of SMD devel
/*function w_bootstrap_subtheme_preprocess_html(&$variables) {
  $m = menu_get_item();
  // not sure if this is the best way to get the node
  // there is also menu_get_object() but couldn't get it to work
  $node = $m['page_arguments'][0];
  
  // for Daily Shot news items, we add "Daily Shot" to the title tag
  // check if the node is a news item
  if ($node->type == "news" || $node->type == "news_2") {
      // check if daily shot tag is present for old news type
      if ($node->type == "news") {
        $tags = $node->field_newstag;
        // 1808 is the tid for daily shot, better way to check this than
        // hardcoding the tid?
        foreach ($tags["und"] as $tag) {
          if ($tag['tid'] == 1808) {
            // DS title should look like "Node title | Daily Shot | Wellesley College"
            // quick fix, better would be to format this with the title field and global site name
            $old = explode("|",$variables['head_title']);
            $new = $old[0] . "| Daily Shot |" . $old[1]; 
            $variables['head_title'] = $new;
            break;
          }
        }
      } else {
        // for new news type, will always be daily shot
        $old = explode("|",$variables['head_title']);
        $new = $old[0] . "| Daily Shot |" . $old[1]; 
        $variables['head_title'] = $new;
      }

      // add custom meta tag (to overwrite open graph module tags) to news nodes
      $short_desc = $node->field_newsshortdesc["und"][0]["value"];
      $short_desc = str_replace("<div>", "", $short_desc);
      $short_desc = str_replace("</div>", "\n\n", $short_desc);
      $short_desc = str_replace("<em>", "", $short_desc);
      $short_desc = str_replace("</em>", "", $short_desc);
      $short_desc = drupal_html_to_text($short_desc);
      $short_desc = explode("\n",$short_desc);
      $short_desc = implode("",$short_desc);  
      $short_desc = htmlspecialchars($short_desc,$flags = ENT_QUOTES); 
      $variables['custom_meta_tags'] = "<meta property='og:description' content='$short_desc' />\n";
  
      // add custom metatag for og:image
      if ($node->field_tablet_image != NULL) {
        $image = $node->field_tablet_image["und"][0]["uri"];
      } else if ($node->field_master_image != NULL) {
        $img_url = $node->field_master_image["und"][0]['uri'];
        $image = image_style_url("news_0_image", $img_url);
      }

      $image = file_create_url($image);
      $variables['custom_meta_tags'] .= "<meta property='og:image' content='$image' />\n";
        

      if ($node->field_newsmetadata != NULL && $node->field_newsmetadata != "") {
        $meta_keywords = htmlspecialchars($node->field_newsmetadata["und"][0]["value"]);
        $variables['wellesley_metakeywords'] = "$meta_keywords";
      } 

      $meta_description = htmlspecialchars($node->title);
      $variables['wellesley_metadescription'] = "$meta_description"; 
    } 
    // add custom meta tag (to overwrite open graph module tags) to event nodes
    if ($node->type == "event") {
      $short_desc = $node->field_eventdetails["und"][0]["value"];
      $short_desc = str_replace("<div>", "", $short_desc);
      $short_desc = str_replace("</div>", "\n\n", $short_desc);
      $short_desc = str_replace("<em>", "", $short_desc);
      $short_desc = str_replace("</em>", "", $short_desc);
      $short_desc = drupal_html_to_text($short_desc);
      if ($short_desc === "") 
        $short_desc = drupal_html_to_text($node->field_eventname["und"][0]["value"]);
      $short_desc = explode("\n\n",$short_desc);
      $short_desc = implode("",explode("\n",$short_desc[0]));
      $short_desc = htmlspecialchars($short_desc,$flags = ENT_QUOTES); 
      $variables['custom_meta_tags'] = "<meta property='og:description' content='$short_desc' />\n"; 
        
        
    }

}
*/
// function w_bootstrap_subtheme_preprocess_html(&$variables) {
//   // Add a stylesheet that prints only on the homepage.
//   if ($variables['is_front']) {
//     drupal_add_css(path_to_theme() . '/css/homepage.css', array('weight' => CSS_THEME));
//   }
// }