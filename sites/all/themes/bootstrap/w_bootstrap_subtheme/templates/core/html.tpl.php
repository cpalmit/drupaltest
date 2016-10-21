<?php
/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or
 *   'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see bootstrap_preprocess_html()
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN"
  "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces;?>>
<head profile="<?php print $grddl_profile; ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php print $head; ?>
  <?php
    // to add custom meta tags, add content to $variables['custom_meta_tags'] in theme preprocess_html 
  ?>
  <!--CP commenting out for SMD devel-->
  <!--<?//php print $custom_meta_tags; ?>
  
  <meta name="description" content="<?php// print check_plain($wellesley_metadescription); ?>" />
  <meta name="keywords" content="<?php// print check_plain($wellesley_metakeywords); ?>" />
-->
  <title><?php print $head_title; ?></title>


  <?php print $styles; ?>
  <!-- HTML5 element support for IE6-8 -->
  <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->


  <?php print $scripts; ?>




  <script type="text/javascript">
  // initialize plugin for Expander (e.g. FAQ more buttons)
    (function ($) {
      $(document).ready(function() {
        $('dl.expanderh4 dd').expander({
          collapseTimer: 0,
          slicePoint: 200,
          widow: 10,
          expandText: 'more',
          userCollapseText: 'close',
        });
        $('dl.expanderh3 dd').expander({
          collapseTimer: 0,
          slicePoint: 200,
          widow: 10,
          expandText: 'more',
          userCollapseText: 'close',
        });
        $('dl.sidebarfaq dd').expander({
          collapseTimer: 0,
          slicePoint: 0,
          widow: 0,
          expandPrefix: ' ',
          expandText: 'Answer',
          userCollapseText: 'Close',
        });
        $('div.sidebarfaq p').expander({
          collapseTimer: 0,
          slicePoint: 90,
          widow: 10,
          expandPrefix: '... ',
          expandText: 'More',
          userCollapseText: 'Close',
        });
        $('div.sidebarfaq').expander({
          collapseTimer: 0,
          slicePoint: 90,
          widow: 10,
          expandPrefix: '... ',
          expandText: 'More',
          userCollapseText: 'Close',
        });
      });
    }(jQuery));

      (function ($) {
      	$(document).ready(function() {
			$( "iframe[src^='https://www.youtube.com']" ).wrap( "<div class='videoWrapper'></div>" );
			$( "iframe[src^='https://player.vimeo.com']" ).wrap( "<div class='videoWrapper'></div>" );
			$( "iframe[src^='//www.youtube.com']" ).wrap( "<div class='videoWrapper'></div>" );
			$( "iframe[src^='http://www.youtube.com']" ).wrap( "<div class='videoWrapper'></div>" );
  		});
 	 }(jQuery));

  </script>
  <script type="text/javascript" src="/sites/all/libraries/jquery.expander/jquery.expander.js"></script>

  <!-- Google 'Open Sans' font -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>

  <!-- 1. flowplayer skin -->
  <link rel="stylesheet" href="//releases.flowplayer.org/6.0.4/skin/functional.css">
    
  <!-- 2. flowplayer -->
  <script src="//releases.flowplayer.org/6.0.4/flowplayer.min.js"></script>

<?php if (!$logged_in): ?>
  <!-- Radium One Code
  <script type="text/javascript">
      (function () {
          var s = document.createElement('script');
          s.type = 'text/javascript';
          s.async = true;
          s.src = ('https:' == document.location.protocol ? 'https://s' : 'http://i')
            + '.po.st/static/v4/post-widget.js#publisherKey=ivuhdv9ves4f0bpvugt7';
          var x = document.getElementsByTagName('script')[0];
          x.parentNode.insertBefore(s, x);
       })();
  </script>-->
  <!-- End Radium One Code... CP commenting this out for SMD development -->
<?php endif; ?>

  <script type="text/javascript">
  /*<![CDATA[*/
  (function() {
  var sz = document.createElement('script'); sz.type = 'text/javascript'; sz.async = true;
  sz.src = '//siteimproveanalytics.com/js/siteanalyze_66356735.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(sz, s);
  })();
  /*]]>*/
  </script>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>
  <div id="skip-link">
    <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
  </div>



  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>
