<?php
/**
 * @file
 * Template for bootstrap carousel
 */
?>

<style>
  .carousel {
    padding-bottom: 35px;
  }
  .carousel-indicators {
    bottom: -35px;
    padding-bottom: 24px;
  }
  .carousel-indicators li {
    border: 2px solid #101778;
    background-color: #fff;
  }
  .carousel-indicators .active {
    background-color: #101778;
  }
  .carousel-caption {
    display: block;
    text-align: left;
    width: 100%;
    height: auto;
    background-color: rgba(16, 23, 120, 0.9);
    left: 0;
    bottom: 0;
    padding: 10px;
  }
  .carousel-caption a {
    color: #218bc1 !important;
  }


</style>
<?php 
// empty h2 to get the vertical align correct 
?>
<h2></h2>
<div id="carousel-bootstrap" class="carousel slide">
  <?php
    $node = entity_metadata_wrapper('node', $node);
    $control_options = $node->field_control_options->value();
    $carousel_items = $node->field_slides->value();
  ?>

  <?php if (in_array(2, $control_options)) : ?>
    <?php if (!empty($carousel_items)) : ?>
    <div class="bullets-control">
      <ol class="carousel-indicators">
      <?php foreach ($carousel_items as $id => $carousel_slide) : ?>
        <li data-target="#carousel-bootstrap" data-slide-to="<?php print $id; ?>" class="bullet <?php ($id == '0') ? print 'active' : print ''; ?>"></li>
      <?php endforeach; ?>
      </ol>
    </div>
    <?php endif; ?>
  <?php endif; ?>

  <div class="carousel-inner">
  <?php if (!empty($carousel_items)) : ?>
    <?php foreach ($carousel_items as $id => $carousel_slide) : ?>
      <div class="item<?php ($id == '0') ? print ' active' : print ''; ?>">
        <?php if(!empty($carousel_slide['carousel_image'])) : ?>
          <?php $img_url = file_create_url(file_load($carousel_slide['carousel_image'])->uri); ?>
          <?php if(!empty($carousel_slide['image_url'])) : ?><a href="<?php print $carousel_slide['image_url'];?>"><?php endif; ?>
          <img src="<?php print $img_url ?>" alt="<?php print $carousel_slide['image_alt_text'];?>"/>
          <?php if(!empty($carousel_slide['image_url'])) : ?></a><?php endif; ?>
        <?php endif; ?>

        <?php if(!empty($carousel_slide['carousel_video'])) : ?>
          <div class="video-wrapper">
            <div class="video-container">
              <div class="ytplayer" id="ytplayer-<?php print $carousel_slide['carousel_video']; ?>" data-videoid="<?php print $carousel_slide['carousel_video']; ?>">
              </div>
            </div>
          </div>
        <?php endif; ?>


        <?php if (strip_tags($carousel_slide['carousel_caption']) != ''): ?>
          <div class="carousel-caption">
            <?php print $carousel_slide['carousel_caption']; ?>
          </div>
        <?php endif; ?>

      </div>

    <?php endforeach; ?>
  <?php endif; ?>
  </div><!-- .carousel-inner -->

  <?php if (in_array(1, $control_options)) : ?>
    <!--  next and previous controls here
          href values must reference the id for this carousel -->
    <a class="carousel-control left" href="#carousel-bootstrap" data-slide="prev">&lsaquo;</a>
    <a class="carousel-control right" href="#carousel-bootstrap" data-slide="next">&rsaquo;</a>
  <?php endif; ?>

</div>


<?php print render($content['links']); ?>


