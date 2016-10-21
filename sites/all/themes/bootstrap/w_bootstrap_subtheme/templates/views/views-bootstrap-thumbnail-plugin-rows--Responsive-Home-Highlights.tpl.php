<?php
/**
 * @file views-bootstrap-thumbnail-plugin-rows.tpl.php
 * Default simple view template to display Bootstrap Thumbnails.
 *
 * @ingroup views_templates
 */
?>

<?php print $image ?>

<?php if (!empty($title) || !empty($description)): ?>
    <?php foreach ($content as $field): ?>
      <?php if (!empty($field)): ?>
        <?php print $field ?>
      <?php endif ?>
    <?php endforeach ?>
<?php endif ?>

    