<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php
// template to automatically exclude the current DS 
// from Campus News and Wellesley in the News, on the /news page

// get the current daily shot by duplicating the filter/sort options on the node
$query = new EntityFieldQuery();
$query->entityCondition('entity_type', 'node')
  ->propertyCondition('status', 1) // published
  ->propertyCondition('type', array('dailyshot','news','news_2'))
  ->fieldCondition('field_daily_published_date', 'value', gmdate('Y-m-d H:i:s'), '<') // fieldCondition query looks at date field in GMT
  // ->fieldCondition('field_daily_promote', 'value', True)
  ->fieldOrderBy('field_daily_published_date', 'value','DESC')
  ->range(0,10);

// we can't filter by daily promote is true OR null, to deal with old news items having it as true for DS, but new not having hte field
// select the most recent 10 nodes, there are only a handful of news nodes with promote to home as false, so filter those out
// at least one with it true or null will remain

$result = $query->execute();
$ds_nids = array_keys($result['node']);
$news_items = entity_load('node', $ds_nids);

foreach ($news_items as $k => $n) {
    if ($n->field_daily_promote["und"][0]["value"] == "1" || $n->type == "news_2") {
        $ds_nid = $n->nid;
        break;
    }
}

?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php 
$i = 0;
foreach ($rows as $id => $row) {
	// exclude the current daily shot
	if ($view->result[$id]->nid != $ds_nid && $i < 6) {
		$i++;
  		print "<div" . ($classes_array[$id] ? ' class="' . $classes_array[$id] .'"': "") . ">";
    	print $row;
  		print "</div>";
  	}
}
?>