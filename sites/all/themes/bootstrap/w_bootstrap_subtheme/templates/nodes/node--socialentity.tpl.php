<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
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
 * - $type: Node type; for example, story, page, blog, etc.
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
 * - $view_mode: View mode; for example, "full", "teaser".
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
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */

//Code for getting individual info out of each fb post using PHP API
require_once __DIR__ . '/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1777749775782212',
  'app_secret' => 'db2ea15ee6cd6881d6f5495b11cb4503',
  'default_graph_version' => 'v2.5',
]);

$data  = file_get_contents("https://graph.facebook.com/wellesleycollege/posts?fields=link,message,full_picture,created_time&access_token=1777749775782212|1z2HljSP2MaH6LbRFxLN3j48L-A&limit=1");
//this method can take either username or page id

// I can figure out how to feed, the about field could go into the description. 

$result = json_decode($data, true);

//probably need to add checks to see if each item exists.. also haven't included videos
/*foreach ($result['data'] as $item) {
  echo "<div style='width:300px;'><a href='".$item['link']."'>".$item['message'] ." ". $item['created_time'] . "<br></a></div><br>";
 
}*/

$link = $result['data'][0]['link'];
$message = $result['data'][0]['message'];
//$image = $result['data'][0]['full_picture'];
$timestamp = $result['data'][0]['created_time'];
//echo "<a href='".$link."'>".$message ." ". $timestamp . "<br></a>";
echo $timestamp;
//$jsonprint = json_encode($data, JSON_PRETTY_PRINT);
//echo $jsonprint;


//now for Twitter
require_once __DIR__ . '/Twitter/TwitterAPIExchange.php';
$settings = array(
    'oauth_access_token' => "250224996-eJcEcB7PYUSU6UtxwS6UNXocm5CcYhQRXv1fDWHL",
    'oauth_access_token_secret' => "0I2MWEgfcj65FozPUnYKqIs2Jr2BiV6maTQq9bKIeleK4",
    'consumer_key' => "jMn31iQ08zqnNoaKP0zMxOEHG",
    'consumer_secret' => "LvLzfBBrJPLAV1Jx0I5iFVU0c0rmb5YE6p9BSOpW2TWq0KzYpU"
);
$username = 'wellesley';
$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$requestMethod = "GET";
$getfield = '?screen_name='.$username.'&count=1';
 
$twitter = new TwitterAPIExchange($settings);

$twitterresult = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);

if($twitterresult["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$twitterresult[errors][0]["message"]."</em></p>";exit();}
$twitterdate = $twitterresult[0]['created_at'];
echo "<br>".$twitterdate;

?>


 


<style>

.fontawe {
  width: 60px;
  height: 60px;
  display:block;
  float:left;
  margin-right:5px;
}
 
.fontawe i {
  background: #cbcbcb;
  color: #fff;
  width: 60px;
  height: 60px;
  border-radius: 10px;
  font-size: 35px;
  text-align: center;
  padding-top: 20%;
  transition: all 0.2s ease-in-out;
}

/*.fontawe .fa-facebook {
    background:#3b5998;
} 
.fontawe .fa-linkedin {
    background:#007bb6;
}
.fontawe .fa-twitter {
    background:#00aced;
}*/

.smd li{
  float: left;
  list-style: none !important;
}

.grayscale {
  -webkit-filter: grayscale(100%); filter: grayscale(100%);
}

</style>


<?php 
//can I use a regex to get the fb id from the url? 

  
  print "<p class='introText'>" . $title . "</p><p>" . render($content['body'])."</p>";
   
  // We hide the comments and links now so that we can render them later.
  hide($content['comments']);
  hide($content['links']);

  //default image
  $profilephoto = "<img src='http://placehold.it/200x200' />";
  if (isset($content)){

  foreach($content as $field):
    if (isset($field['#field_name'])) {
    $fieldname = $field['#field_name'];
    $iteminfield = $field['#items']['0']['url'];
    //print $fieldname . ": " . $iteminfield . "<br>";

    if ($fieldname == 'field_websitelink') {
      print "<a class='fontawe' href=" .$iteminfield."><i class='fa fa-link'></i></a>";
    } else if ($fieldname == 'field_facebooklink'){
      print "<a class='fontawe' href=" .$iteminfield."><i class='fa fa-facebook'></i></a>";
      print "<div style='float:right;'><iframe src='https://www.facebook.com/plugins/page.php?href=".$iteminfield."&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=false&appId' width='340' height='500' style='border:none;overflow:hidden' scrolling='no' frameborder='0' allowTransparency='true'></iframe></div>"; 

    /*} else if ($fieldname == 'field_twitterlink'){
      print "<a class='fontawe' href=" .$iteminfield."><i class='fa fa-twitter'></i></a>";
      print "<div style='float:right;'><a class='twitter-timeline' data-lang='en' data-width='300' data-theme='light' data-tweet-limit='1' data-link-color='#002776' href='".$iteminfield."'></a> </div><script async src='//platform.twitter.com/widgets.js' charset='utf-8'></script>";
      $profilephoto = "<img src = 'https://twitter.com/wellesleymag/profile_image?size=original' />";*/
    } else if ($fieldname == 'field_twitter_username'){
      $twitterusername = $content['field_twitter_username']['#items']['0']['value'];
      print "<a class='fontawe' href='http://www.twitter.com/".$twitterusername."'><i class='fa fa-twitter'></i></a>";
      print "<div style='float:right;'><a class='twitter-timeline' data-lang='en' data-width='300' data-theme='light' data-tweet-limit='1' data-link-color='#002776' href='http://www.twitter.com/".$twitterusername."'></a> </div><script async src='//platform.twitter.com/widgets.js' charset='utf-8'></script>";
      $profilephoto = "<img src = 'https://twitter.com/".$twitterusername."/profile_image?size=original' style='height:200px;' />";

    } else if ($fieldname == 'field_snapchat_image'){
      $imgurl = $content['field_snapchat_image']['#items']['0']['uri'];
      $username = $content['field_snapchat_username']['#items']['0']['value'];
      print "<a href='http://snapchat.com/add/".$username."'><img style='vertical-align:top;' class='grayscale' src='".image_style_url('snapchat', $imgurl)."'></a>";
    }else if ($fieldname == 'field_facebook_id'){
      $fbid = $content['field_facebook_id']['#items']['0']['value'];
      $profilephoto = "<img src='http://graph.facebook.com/".$fbid."/picture?type=large' style='height:200px;' />";
    } else if ($fieldname =='field_instagramusername'){
      print "<a class='fontawe' href=http://www.instagram.com/" .$content['field_instagramusername']['#items']['0']['value']."><i class='fa fa-instagram'></i></a>";
    } else if ($fieldname =='field_youtubelink'){
      print "<a class='fontawe' href=" .$content['field_youtubelink']['#items']['0']['value']."><i class='fa fa-youtube'></i></a>";
    }
  }
  endforeach;
} 

print "<div>".$profilephoto."</div>";



// Twitter then Instagram then Facebook?

  //print render($content['field_websitelink']['#items']['0']['url']);
  //print render($content['field_twitterlink']['#items']['0']['url']);
  //echo '<pre>'; print_r($content); echo '</pre>';
  //print render($content['field_snapchat_image']);
  //print render($content);
?>



  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>
