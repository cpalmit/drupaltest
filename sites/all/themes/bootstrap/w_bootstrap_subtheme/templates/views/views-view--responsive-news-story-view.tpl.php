<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 *
 */
?>

<style>
    section#block-system-main {
      clear: both;
    }
    .top-news-wrapper {
      height: 100%;
      overflow: hidden;
      position: relative;
      margin-bottom: 20px;
      padding: 0 !important;
    }
    .left-column {
      position: absolute !important;
    }
    .journalists-contact {
      display: block !important;
    }
    .news-story-view {
      height: auto;
      float: right;
      padding-right: 0;
    }
    #block-views-6b483cfcc913b17b4bf69fd4a68ef26b {
      background-color:  #e3e3e3;
      position: relative;
      left: -15px;
      width: calc(100% + 15px);
      /* Firefox */
      width: -moz-calc(100% + 15px);
      /* WebKit */
      width: -webkit-calc(100% + 15px);
      /* Opera */
      width: -o-calc(100% + 15px);
      min-height: 683px;
    }
    #block-views-6b483cfcc913b17b4bf69fd4a68ef26b img {
      width: 100%;
      height: auto;
      /*padding-bottom: 30px;*/
    }
    #block-views-6b483cfcc913b17b4bf69fd4a68ef26b h3 {
      margin: 5px 35px;
    }
    #block-views-6b483cfcc913b17b4bf69fd4a68ef26b h3 a {
      width: 100%;
      font-family: 'Adobe Garamond Pro';
      color: #000;
      font-size: 36px;
      font-weight: 400;
      line-height: 35px;
      margin-top: 0;
      /*margin-left: 15px;*/
      margin-right: 15px;
    }
    #block-views-6b483cfcc913b17b4bf69fd4a68ef26b h3 a:hover {
      color: #428bca;
    }
    #block-views-6b483cfcc913b17b4bf69fd4a68ef26b p {
      font-size: 15px;
    }
    #block-views-6b483cfcc913b17b4bf69fd4a68ef26b dl.expandernews {
      margin-left: 35px;
      margin-right: 35px;
    }
    #block-views-6b483cfcc913b17b4bf69fd4a68ef26b dl.expandernews dt {
      position: relative;
      top: -10px;
      font-family: 'Swiss721BT', Helvetica;
      color: #000000;
      font-size: 10px; /*design says 8px*/
      font-style: italic;
      font-weight: 400;
      line-height: 22px;
      margin-bottom: 10px;
    }
    #block-views-6b483cfcc913b17b4bf69fd4a68ef26b dl.expandernews dd {
      font-family: 'Swiss721BT', Helvetica;
      color:  #656565;
      font-size: 15px;
      line-height: 22px;
    }
    #block-views-6b483cfcc913b17b4bf69fd4a68ef26b dl.expandernews dd a:hover {
      color: #428bca;
    }
    @media(min-width:0px) and (max-width:768px){
      #block-views-6b483cfcc913b17b4bf69fd4a68ef26b p {
        font-size: 15px;
        line-height: 135%;
      }
      #block-views-6b483cfcc913b17b4bf69fd4a68ef26b h3 a {
        font-size: 28px;
        line-height: 28px;
      }

    }

</style>

<script type="text/javascript">
  // initialize plugin for Expander (e.g. FAQ more buttons)
    (function ($) {
      $(document).ready(function() {
      $('dl.expandernews dd').expander({
          collapseTimer: 0,
          slicePoint: 700, /*was 850*/
          widow: 10,
          expandText: 'read more',
          userCollapseText: 'hide',
        });
      });
    }(jQuery));
</script>


<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <?php if ($header): ?>
    <div class="view-header">
      <?php print $header; ?>
    </div>
  <?php endif; ?>

  <?php if ($exposed): ?>
    <div class="view-filters">
      <?php print $exposed; ?>
    </div>
  <?php endif; ?>

  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>

  <?php if ($rows): ?>
    <div class="view-content">
      <?php print $rows; ?>
    </div>
  <?php elseif ($empty): ?>
    <div class="view-empty">
      <?php print $empty; ?>
    </div>
  <?php endif; ?>

  <?php if ($pager): ?>
    <?php print $pager; ?>
  <?php endif; ?>

  <?php if ($attachment_after): ?>
    <div class="attachment attachment-after">
      <?php print $attachment_after; ?>
    </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <?php print $more; ?>
  <?php endif; ?>

  <?php if ($footer): ?>
    <div class="view-footer">
      <?php print $footer; ?>
    </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
    <div class="feed-icon">
      <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>

</div><?php /* class view */ ?>
