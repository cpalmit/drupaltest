<?php
/**
 * @file views-bootstrap-thumbnail-plugin-style.tpl.php
 * Default simple view template to display Bootstrap Thumbnails.
 *
 * - $rows contains a nested array of rows. Each row contains an array of
 *   columns.
 * - $column_type contains a number (default Bootstrap grid system column type).
 *
 * @ingroup views_templates
 */
?>




<div id="featured-imgs" class="container" style="margin-top:20px;">
    
<!--<div id="views-bootstrap-thumbnail-<?php print $id ?>" class="<?php print $classes ?>">-->
  <?php if ($options['alignment'] == 'horizontal'): ?>



    <?php foreach ($items as $row): ?>
      <div class="row">
         	<?php $i = 0; ?>         
           	
        <?php foreach ($row['content'] as $column): ?>
           	<?php 
           	
           	if ($i > 2) {         
	           	print "<div class=\"col-md-5ths hidden-xs hidden-sm\">";  
          	}else{
           		print "<div class=\"col-md-5ths col-sm-4 hidden-xs\">";
           	}
           	
           	$i++;           	
           	?>
           	
           	<?php print $column['content'] ?>
              </div>
        <?php endforeach ?>
      </div>
    <?php endforeach ?>

  <?php else: ?>

    <div class="row">
      <?php foreach ($items as $column): ?>
        <div class="col col-lg-<?php print $column_type ?>">
          <?php foreach ($column['content'] as $row): ?>
            <div class="thumbnail">
              <?php print $row['content'] ?>
            </div>
          <?php endforeach ?>
        </div>
      <?php endforeach ?>
    </div>

  <?php endif ?>
</div>