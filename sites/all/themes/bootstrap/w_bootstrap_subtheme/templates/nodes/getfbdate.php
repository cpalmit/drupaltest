getfbdate.php

<?php
//FB PHP API
require_once __DIR__ . '/Facebook/autoload.php';

//Connect
$fb = new Facebook\Facebook([
  'app_id' => '1777749775782212',
  'app_secret' => 'db2ea15ee6cd6881d6f5495b11cb4503',
  'default_graph_version' => 'v2.5',
]);

//Get date of most recently created post. (For other fields, could add link,message,full_picture, etc)
//this method can take either username or page id, which needs to be parsed from url
//

$pageid = "wellesleycollege";
$data  = file_get_contents("https://graph.facebook.com/".$pageid."/posts?fields=created_time&access_token=1777749775782212|1z2HljSP2MaH6LbRFxLN3j48L-A&limit=1");
$result = json_decode($data, true);

$timestamp = $result['data'][0]['created_time'];
//echo $timestamp;


?>