<!--Edited News w_bootstrap_subtheme Version-->
<!--Twitter Feed Text-->

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> hidden-xs hidden-sm clearfix"<?php print $attributes; ?>>

  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="submitted">
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content"<?php print $content_attributes; ?>>

    <?php


      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
	  hide($content['field_twitter']);
	   hide($content['field_twitter_id']);

      print render($content);



    ?>



<a class="twitter-timeline" data-chrome="noborders" width="156" href="https://twitter.com/<?php echo $field_twitter[0]['value'];?>  " data-widget-id="<?php echo $field_twitter_id[0]['value'];?>">Tweets by @<?php echo $field_twitter[0]['value'];?>  </a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>




  </div>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</div>
