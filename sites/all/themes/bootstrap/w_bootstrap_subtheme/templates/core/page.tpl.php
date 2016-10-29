<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted, full-width content region (Daily Shot).
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar (not in use).
 * - $page['sidebar_second']: Items for the second sidebar (not in use).
 * - $page['header']: Items for the header region (not in use?).
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */

/*
    .col-xs- = mobile <768px. horizontal by default. no set container width.
    .col-sm- = tablets (≥768px). collapsed default, horizontal above 750px. column width ~62px.
    .col-md- = med desktop (≥992px). collapsed default, horizontal above 970px. column width ~81px.
    .col-lg- = lrg desktop (≥1200px). collapsed default, horizontal above 1170px. column width ~97px.

    default gutter width is 30px (15px on each side of column) for all screen sizes
*/
?>
<?php

  // RR 03/05/2013 Academic department leading URLs.

$mypage_academics =
    array ("amerstudies",
     "anthropology",
     "astronomy",
     "biology",
     "chemistry",
     "chinese",
     "classicalstudies",
     "eall",
     "eas",
     "economics",
     "english",
     "environmentalstudies",
     "fia",
     "french",
     "geosciences",
     "german",
     "history",
     "italian",
     "japanese",
     "latinam",
     "mas",
     "math",
     "medren",
     "mes",
     "music",
     "neuroscience",
     "peace",
     "philosophy",
     "physics",
     "polisci",
     "psychology",
     "qr",
     "religion",
     "russian",
     "sociology",
     "spanish",
     "theatre",
     "womenst",
     );


	// RR 03/01/2013 Better error trapping just on 404 pages.

	  $mypage_text = "";
		$mypage_status = drupal_get_http_header("status");

		//RR 03/01/2013 - Is this an error page? If so, is this for new.wellesley.edu?
		// If so, skip this and show the default error.

		//RR 03/05/2013 Extract the parts of the url
		$mypage_request_uri = request_uri();
		$mypage_parts = explode("/",$mypage_request_uri);

		//RR 11/06/2014 Provide protection for /pac
		if (strtolower(end($mypage_parts)) == 'pac') {
  			print "<script>document.location = \"http://www.wellesley.edu/404\";</script>";
  			exit;
		}

		if ($mypage_status == '404 Not Found'){
		  if (strtolower($_SERVER['HTTP_HOST']) != 'new.wellesley.edu') {
		    
		    // RR 03/05/2013 Set the prefix to academics.
		    // If the first part of the URL is not in the provided list
		    // change it to web.wellesley.edu
		    
		    $mypage_prefix = "academics";
		    if (!in_array(strtolower($mypage_parts[1]),$mypage_academics)) {
		      $mypage_prefix = "web";
		    }
		    
		    // Prepare a text to display
		    
		    $mypage_text =  "It is likely that the page you're looking for has moved to our webserver. We are attemtping to send to you there. If it fails, please try clicking on the link - ";
		    $mypage_text .= "<a href=\"http://academics.wellesley.edu" . $mypage_request_uri . "\">" .
		      "http://$mypage_prefix" . ".wellesley.edu" . $mypage_request_uri . "</a></b>";
		    
		    //print "<font color=\"#ff0000\"><b>$mypage_text</font>";
		    
		    //$mypage_ctime = date("m/d/Y H:i",strtotime("now"));
		    //$mypage_text = $mypage_ctime . ",$mypage_prefix," . $mypage_request_uri  . "," . $_SERVER['HTTP_REFERER'] . "\n";
		    //$mypage_result = file_put_contents("/var/phpapps/data/redirect.log",$mypage_text,FILE_APPEND);
		    $mypage_new_location = "http://" . $mypage_prefix . ".wellesley.edu" . $mypage_request_uri;
		    drupal_add_http_header('Location', $mypage_new_location);
		    drupal_add_http_header('Status', '301 Moved Permanently');
		    //print "<script>document.location=" . "\"http://$mypage_prefix" . ".wellesley.edu" . $mypage_request_uri . "\";</script>\n";
		  }
 		}

?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<script type="text/javascript">

  // move to header later

  /* enable popovers */
	(function ($) {
	  $(document).ready(function() {
     		$('[data-toggle="popover"]').popover();
   	});
  }(jQuery));

	/* dailyshot popover (move to home section later)*/
	(function ($) {
	  $(document).ready(function() {
	      $('#dailypop').popover({trigger:'click', container:'#dailypop-container'});
	  });
	}(jQuery));
	/* dailyshot popover (not sure which is correct function)*/
	(function ($) {
	  $(document).ready(function() {
	      $('#dailypop').popover({trigger:'click'})
	  });
	}(jQuery));

  /* get active class to appear on topnav item for lower sublinks */
  (function ($) {
    $(document).ready(function() {
        var path = window.location.pathname;
        var pathArray = path.split( '/' );
        var parentLink = 'a[href*=\'' + pathArray[1] + '\']';
        $("ul.navbar-nav").find(parentLink).addClass('active');
    });
  }(jQuery));

  /* rewrite relative img sources to pull from prod DB */
  (function ($) {
    $(document).ready(function() {
        $('img').each(function (i) {
          var imgSrc = this.src;
          var siteURL = "https://www.wellesley.edu";

          var pieces = imgSrc.split("/");
          pieces.splice(0,3);
          imgSrc = pieces.join("/");

          if (imgSrc.indexOf(siteURL) === -1) {
              imgSrc = siteURL + "/" + imgSrc;
              $(this).attr('src', imgSrc);
          }
        });
    });
  }(jQuery));

  /* removes rogue (hidden) appearing after News MM link */
  (function ($) {
    $(document).ready(function() {
      var newslink = $('#block-monster-menus-1 a[href="/news"]');
      newslink.text('News');
    });
  }(jQuery));

  /* hide journalists contact node everywhere but news landing page*/
  (function ($) {
    $(document).ready(function() {
      var path = location.pathname.split("/");
      /* contact styled for news homepage */
      if ( path.length > 2 && path[1] == "news") {
        // $('#node-61291').hide();
      }
      /* contact styled for regular news pages */
      /*else if ( path.length = 2 && path[1] == "news") {
        $('#node-61301').hide();
      }*/
    });
  }(jQuery));

  /* Add onclick code to Alumnae Giving to Wellesley menu item */
  (function ($) {
    $(document).ready(function() {
      var alum_give = $("#navbar .menu a").filter(function(i) {
        return $(this).text() === "Giving to Wellesley"; 
      });
      $(alum_give).attr("onclick","ga('send', 'event', 'Gift', 'Click', 'Alumnae Dropdown Giving to Wellesley')");
    });
  }(jQuery));

  /* slows dropdown menu hover action --> i think this isn't working */
  // (function ($) {
  //   $('ul.nav li.dropdown').hover(function() {
  //     $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
  //   }, function() {
  //     $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
  //   });
  // }(jQuery));


</script>

<header id="navbar" role="banner" class="<?php print $navbar_classes; ?>">
  <div class="container">

    <div class="navbar-header">

      <a href="https://portal.wellesley.edu" target="_blank">
        <button type="button" class="btn mywellesley">
	        <span class="glyphicon glyphicon-user"></span>
	        <span id="myw-text"> MyWellesley</span>
        </button>
      </a>

      <a href="https://securelb.imodules.com/s/1601/GID2/index-giving.aspx?sid=1601&gid=2&pgid=432&cid=1053&appealcode=WBSTGIVE" onClick="ga('send', 'event', 'Gift', 'Click', 'Header Give Icon');">
        <button type="button" class="btn gift">
          <svg class='gift-icon' xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 13 13">
            <path fill="#ffffff" d="M1.3,4.4v2.5h5.1v-3H1.9C1.6,3.9,1.3,4.1,1.3,4.4z M2,13c0,0.3,0.2,0.5,0.5,0.5h3.9V7.7H2V13z M12.1,3.9
              H7.7v3h5V4.4C12.7,4.1,12.4,3.9,12.1,3.9z M7.7,13.6h3.8c0.3,0,0.5-0.2,0.5-0.5V7.7H7.7V13.6z M4,3h6.3c1.1,0,1.7-0.6,1.7-1.3
              c0-0.8-0.7-1.2-1.5-1.2c-0.5,0-1,0.2-1.5,0.5C8.5,1.3,7.6,1.9,7.1,2.2C6.7,1.9,5.8,1.3,5.3,1c-0.5-0.3-1-0.5-1.5-0.5
              C3,0.5,2.3,0.9,2.3,1.7C2.3,2.4,2.9,3,4,3z M9.8,1.3c0.2-0.1,0.5-0.2,0.7-0.2c0.4,0,0.6,0.2,0.6,0.6c0,0.4-0.4,0.7-0.9,0.7
              c-0.1,0-1,0-1.9,0C9,1.9,9.5,1.5,9.8,1.3z M3.8,1.1c0.2,0,0.5,0.1,0.7,0.2c0.3,0.2,0.9,0.6,1.5,1c-0.9,0-1.8,0-1.9,0
              c-0.4,0-0.9-0.3-0.9-0.7C3.1,1.3,3.4,1.1,3.8,1.1z"/>
          </svg>
          <span id="gift-text">Give</span>
        </button>
      </a>

      <?php if ($logo): ?>
        <a class="name navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>

      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
        <button type="button" class="navbar-toggle hidden-md hidden-lg" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

      <!-- search for desktops -->
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        <form class="navbar-form hidden-xs hidden-sm" role="search" id='searchbox_017837941794940064808:el1jfmsv4-c' action="/sites/all/misc/search.html" target="_search">
          <div class="form-group">
            <input value="017837941794940064808:el1jfmsv4-c" name="cx" type="hidden"/>
            <input type="hidden" name="ie" value="UTF-8" />
            <input type="text" class="search-input hidden-xs hidden-sm" placeholder="" id="q"  name="q"
              onFocus="if(this.value == '') this.value = ''" onBlur="if(this.value == '') this.value = ''">
            <button type="submit" class="btn search hidden-xs" value=" " name="sa">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </div>
        </form>

      <!-- dropdown search for tablet & mobile -->
        <li class="dropdown search">
          <script type="text/javascript" src="http://www.google.com/jsapi"></script>
          <a href="#" class="dropdown-toggle hidden-md hidden-lg" data-toggle="dropdown">
            <i class="glyphicon glyphicon-search"></i>
          </a>
          <ul class="dropdown-menu" style="position: relative !important;">
            <form class="form-inline" style="display:block; margin:0 auto;" id='searchbox_017837941794940064808:el1jfmsv4-c' action="/sites/all/misc/search.html" target="_search">
              <button type="submit" class="btn btn-default pull-right nav-search-button" value=" " name="sa">GO</button>
              <input value="017837941794940064808:el1jfmsv4-c" name="cx" type="hidden"/>
              <input type="hidden" name="ie" value="UTF-8" />
              <input type="text" class="form-control pull-left nav-search-field" id="q" name="q" placeholder=""
                  onFocus="if(this.value == 'Search') this.value = ''" onBlur="if(this.value == '') this.value = 'Search'" >
            </form>
          </ul>
        </li>

    </div> <!--/.navbar-header-->

    <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
      <div class="navbar-collapse collapse">
        <nav role="navigation">
          <?php if (!empty($primary_nav)): ?>
            <?php print render($primary_nav); ?>
          <?php endif; ?>
          <?php if (!empty($secondary_nav)): ?>
            <?php print render($secondary_nav); ?>
          <?php endif; ?>
          <?php if (!empty($page['navigation'])): ?>
            <?php print render($page['navigation']); ?>
          <?php endif; ?>
        </nav>
      </div> <!--/.navbar-collapse-->
    <?php endif; ?>
  </div>
</header>



<?php if (!empty($page['highlighted'])): ?>

  <div class="dailyshot-container fluid-container">
     	<div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
  </div>

<?php endif; ?>




<?php if ($is_front): ?>
<!--HOMEPAGE-SPECIFIC LAYOUT-->

  <script text="text/javascript">
    /* dailyshot popover */
    // (function ($) {
    //   $(document).ready(function() {
    //       $('#dailypop').popover({trigger:'click', container:'#dailypop-container'});
    //   });
    // }(jQuery));
    /* dailyshot popover (not sure which is correct function)*/
    // (function ($) {
    //   $(document).ready(function() {
    //       $('#dailypop').popover({trigger:'click'})
    //   });
    // }(jQuery));
  </script>

  <div class="main-container container">

   <div class="row home-section">
    	<div class="col-md-12">

      <?php if (!empty($page['sidebar_first'])): ?>
         	<div class="col-md-4 col-sm-4">
          	<?php print render($page['sidebar_first']); ?>
  		    </div>
      <?php endif; ?>

      <?php if (!empty($page['left_quicklinks'])): ?>
            <?php print render($page['left_quicklinks']); ?>
      <?php endif; ?>


      <section class="col-md-4 col-sm-4" >

        <a id="main-content"></a>

        <?php print render($title_prefix); ?>

        <?php if (!empty($title)): ?>
          <h1 class="page-header"><?php print $title; ?></h1>
        <?php endif; ?>

        <?php print render($title_suffix); ?>

        <?php print $messages; ?>

        <?php if (!empty($tabs)): ?>
          <?php print render($tabs); ?>
        <?php endif; ?>

        <?php if (!empty($action_links)): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
        <?php endif; ?>

        <?php print render($page['content']); ?>

      </section>

      <?php if (!empty($page['sidebar_second'])): ?>
        <aside class="col-md-4 col-sm-4" role="complementary">
          <?php print render($page['sidebar_second']); ?>
        </aside>
      <?php endif; ?>

    	</div>
      </div>
   </div>


<?php else : ?>
<!--NEWS LAYOUT-->

  <?php $path = request_path();?>
  <?php if (($path == 'news') || ($path == 'responsive/news')): ?>
  <?php// if ($path == 'news'): ?>

  <style>
    .left-column { background-color: #eee; height: 100%; overflow-y: scroll; overflow-x:hidden;}
    .left-column h2 { padding-left: 10px;}
    .left-column h2 a { font-family: 'Adobe Garamond Pro' !important; color: #4c4c4c; font-size: 14px; }
    .left-column ul.menu { padding-left: 10px; padding-bottom: 10px;}
    .left-column ul.menu .menu a { font-size: 14px; line-height: 24px;}
    .left-column ul li a { color:#4c4c4c !important; font-family: Helvetica, sans-serif; line-height: 14px !important; }
    .quicklinks { padding-bottom: 60px; padding-left: 20px;}
    #block-monster-menus-1 > ul > li > ul {
      margin-left: 0 !important;
    }
    .region-sidebar-first ul.menu a:hover,
    .region-sidebar-first ul.menu ul.menu a:hover {
      color: #428bca !important;
    }
    /*#node-62101 {border-top: 1px dotted #aaa;}*/
    .middle-column .wellesleynews li {
      list-style: none !important;
    }
  </style>



  <!-- <div class="main-container container" style="margin-bottom:30px;"> -->
  <div class="main-container container">

    <div class="row">
    <!-- inline padding prints only on md & lg displays-->
    <!-- <div class="row visible-lg visible-md">  -->
    <!-- <div class="row visible-sm visible-xs" style="padding-right:0; padding-left:0;"> -->

      <?php if (!empty($breadcrumb)):  print_r($breadcrumb); endif; ?>

      <?php if (!empty($tabs)): ?>
          <?php print render($tabs); ?>
      <?php endif; ?>

      <?php if (!empty($action_links)): ?>
          <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>

      <!-- wrapper for left col & main news item -->
      <div class="col-lg-12 col-md-12 col-sm-12 top-news-wrapper">

        <?php if (!empty($page['sidebar_first'])): ?>

            <aside class="left-column hidden-xs col-sm-3 col-md-3 col-lg-3" role="complementary">
              <?php print render($page['sidebar_first']); ?>

              <?php if (!empty($page['left_quicklinks'])): ?>
                <?php print render($page['left_quicklinks']); ?>
              <?php endif; ?>
            </aside>

        <?php endif; ?>

        <?php if (!empty($page['sidebar_second'])): ?>
          <section class="news-story-view col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <?php print render($page['sidebar_second']); ?>
          </section>
        <?php endif; ?>

      </div><!-- end left col & main news wrapper -->

      <section class="col-xs-12 col-sm-12 col-md-12 middle-column">

        <?php print render($page['content']); ?>

      </section>

      <?php /*if (!empty($page['sidebar_first'])): ?>
        <div class="row visible-xs col-xs-12">
          <?php print render($page['sidebar_first']); ?>
          <?php if (!empty($page['left_quicklinks'])): ?>
            <?php print render($page['left_quicklinks']); ?>
          <?php endif; ?>
        </div>
      <?php endif; */?>

    </div> <!-- end row -->

    <?php if (!empty($page['sidebar_first'])): ?>
        <div class="row visible-xs col-xs-12">
          <?php print render($page['sidebar_first']); ?>
        </div>
      <?php endif; ?>

    <?php if (!empty($page['footer'])): ?>
      <?php print render($page['footer']); ?>
    <?php endif; ?>

  </div> <!-- end main container -->
  <?php endif; ?>

<!--SEARCH LAYOUT-->
  <?php if ($path == 'search-wellesley'): ?>

  <?php endif; ?>

<!--REGULAR LAYOUT-->
  <?php //if ($path !== 'news'): ?>
  <?php if (($path !== 'news') && ($path !== 'responsive/news')): ?>


  <!-- <div class="main-container container" style="margin-bottom:30px;"> -->
  <div class="main-container container">

    <?php if (!empty($breadcrumb)):  print_r($breadcrumb); endif; ?>

    <div class="row">
    	<div class="col-md-12">


        <?php if (!empty($page['sidebar_first'])): ?>

          <?php // Remove hidden markup
            if (!$logged_in) {
                $my_temp = $page['sidebar_first']['monster_menus_1']['#markup'];
                $my_temp = preg_replace('/\s*\(\s*hidden\s*\)/i','',$my_temp);
                 $page['sidebar_first']['monster_menus_1']['#markup'] = $my_temp;
            }
          ?>

          <aside class="hidden-xs col-sm-3 col-md-2 left-column" role="complementary">
            <?php print render($page['sidebar_first']); ?>

            <?php if (!empty($page['left_quicklinks'])): ?>
              <?php print render($page['left_quicklinks']); ?>
            <?php endif; ?>

            <?php if (!empty($page['sidebar_second'])): ?>
              <aside class="left-column visible-sm col-sm-3" role="complementary">
              <?php print render($page['sidebar_second']); ?>
              </aside>
            <?php endif; ?>

          </aside>
        <?php endif; ?>

      <!-- if no right sidebar, middle section is 10 cols, else 8 cols -->
        <?php if (!empty($page['sidebar_second'])): ?>
          <section class="col-sm-9 col-md-8 middle-column">
        <?php else: ?>
          <!--<section class="col-sm-9 col-md-10 middle-column">-->
          <section class="col-md-12"> <!--CP's doing for SMD-->
        <?php endif; ?>

            <a id="main-content"></a>

            <?php //if (!empty($breadcrumb)):  print_r($breadcrumb); endif; ?>

            <?php //print $messages; ?>

            <?php if (!empty($tabs)): ?>
              <?php print render($tabs); ?>
            <?php endif; ?>

            <?php if (!empty($action_links)): ?>
              <ul class="action-links"><?php print render($action_links); ?></ul>
            <?php endif; ?>

            <?php print render($page['content']); ?>

          </section>

          <?php if (!empty($page['sidebar_second'])): ?>
        <aside class="col-md-2 col-lg-2 right-column hidden-xs hidden-sm" role="complementary">
          <?php print render($page['sidebar_second']); ?>
        </aside>
      <?php endif; ?>

  	  </div> <!--/.col-md-12-->
    </div> <!--/.row-->

    <?php if (!empty($page['sidebar_first'])): ?>
        <div class="row visible-xs col-xs-12">
          <?php print render($page['sidebar_first']); ?>
          <?php if (!empty($page['left_quicklinks'])): ?>
            <?php print render($page['left_quicklinks']); ?>
          <?php endif; ?>
        </div>
    <?php endif; ?>


      <?php if (!empty($page['sidebar_second'])): ?>
        <aside class="right-column visible-xs col-xs-12" role="complementary">
          <?php print render($page['sidebar_second']); ?>
        </aside>
      <?php endif; ?>

    <?php if (!empty($page['footer'])): ?>
      <?php print render($page['footer']); ?>
    <?php endif; ?>

  </div> <!--/.main-container-->

  <?php endif; ?>

  <?php endif; ?>

<!--END MAIN LAYOUT-->

<!--footer-->
  <footer class="footer container">
      <div class="footer-links row hidden-xs hidden-sm">
          <div class="col-md-12">
              <a href="/administration/working/">Work at Wellesley</a> |
              <a href="/alumnae/give" onClick="ga('send', 'event', 'Gift', 'Click', ‘Footer Giving to Wellesley’);">Giving to Wellesley</a> |
              <a href="/info/dmca">Terms of Use</a> |
              <a href="/info/privacy">Privacy</a> |
              <a href="/info/keyfacts">Key Facts</a> |
              <a href="/info/access">Web Accessibility</a> |
              <a href="mailto:webmaster@wellesley.edu">Feedback</a> |
              <a href="/info/webmaster">Webmaster</a>
          </div>
      </div>
      <div class="copyright-address row">
          <div class="col-md-12">
              Copyright &copy; Trustees of Wellesley College &nbsp;&nbsp;| &nbsp;&nbsp;Wellesley College 106 Central Street – Wellesley, MA 02481 (781) 283-1000
          </div>
      </div>
  </footer>

<!--start fixed bottom menu-->

		<div id="fixed-menu-min" style="display:none">
			<div class="col-md-12 hidden-xs col-sm-12 col-lg-12">
        <div class="row">
    			<div class='footer_logo_fixed'>
            <?php echo file_get_contents("sites/all/themes/bootstrap/image/WellesleyLogoMono.svg"); ?>
          </div>
					<img class ="pull-right" style="padding:10px;" src="http://www.wellesley.edu/sites/all/themes/bootstrap/w_bootstrap_subtheme/image/show_button.png" alt="Show" />
 			  </div>
      </div>
		</div>


    <div id="fixed-menu-max" class="container">
      <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs" style="display:block; padding-top: 10px;">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-2">
            <ul>
              <li><a href="/admission/apply">Apply</a></li>
              <li><a href="/admission/affordable">Afford</a></li>
              <li><a href="/academics/deptsmajorprog">Majors</a></li>
              <li><a href="/academics/catalog">Courses</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3">
            <ul>
              <li><a href="/lts">Library &amp; Technology</a></li>
              <li><a href="http://www.wellesley.edu/directory/">Directory</a></li>
              <li><a href="https://events.wellesley.edu/eventscal.php?filter=featuredevents">Calendars</a></li>
              <li><a href="/registrar">Registrar</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <a href="/">
              <div class="hidden-xs w_logo">
                <?php echo file_get_contents("sites/all/themes/bootstrap/image/WellesleyLogoMono.svg"); ?>
              </div>
            </a>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-2">
            <ul>
              <li><a href="/careereducation" target="_blank" class='career-education-link'>Career Education</a></li>
              <li><a href="http://web.wellesley.edu/map/">Map</a></li>
              <li><a href="/about/visit">Visit</a></li>
              <li><a href="http://campaign.wellesley.edu" onClick="ga('send', 'event', 'Gift', 'Click', 'Blue Bar Campaign');">Campaign</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-3">
            <ul>
              <img class ="pull-right hide_menu" src="http://www.wellesley.edu/sites/all/themes/bootstrap/w_bootstrap_subtheme/image/hide_button.png" alt="Hide" />
              <li><a href="/albright" target="_blank">Albright Institute</a></li>
              <li><a href="http://www.davismuseum.wellesley.edu/" target="_blank">Davis Museum</a></li>
              <li><a href="http://www.newhouse-center.org/" target="_blank">Newhouse Center</a></li>
              <li><a href="http://www.wcwonline.org/" target="_blank">Wellesley Centers for Women</a></li>
            </ul>
          </div>
 				</div>
 			</div>
    </div> <!--end fixed-menu-max-->

		<!--mobile closed-->
		<div id="mobile-min">
			 <div class="hidden-md col-xs-12 hidden-sm hidden-lg">
          <div class="row" >
            <div class='md_logo'>
              <?php echo file_get_contents("sites/all/themes/bootstrap/image/WellesleyLogoMono.svg"); ?> 
            </div>
						<img class ="pull-right" style="padding:10px;" src="http://www.wellesley.edu/sites/all/themes/bootstrap/w_bootstrap_subtheme/image/show_button.png" alt="Show" />
 	 			</div>
      </div>
		</div>


	    <!--mobile opened -->
		<!--<div id="mobile-max" class="hidden-lg hidden-md hidden-sm col-xs-12" style="display:none">-->

		<div id="mobile-max" style="display:none">

 			<div class="hidden-sm hidden-md hidden-lg col-xs-12" style="padding:10px 20px;">

 				<div class="row">
 					<img class="pull-right hide_mobile" src="http://www.wellesley.edu/sites/all/themes/bootstrap/w_bootstrap_subtheme/image/hide_button.png" alt="Hide" />

				</div>

 			  	<div class="row">

                    <div class="col-xs-6 hidden-sm hidden-md hidden-lg">

                        <ul>
                            <li><a href="/admission/apply">Apply</a></li>
                            <li><a href="/admission/affordable">Afford</a></li>
                            <li><a href="/academics/deptsmajorprog">Majors</a></li>
                            <li><a href="/academics/catalog">Courses</a></li>
                             <li><a href="/lts">Library &amp; Technology</a></li>
                            <li><a href="http://www.wellesley.edu/directory/">Directory</a></li>
                            <li><a href="https://events.wellesley.edu/eventscal.php?filter=featuredevents">Calendars</a></li>
                            <li><a href="/registrar">Registrar</a></li>
                    	 </ul>
                    </div>
                    <div class="col-xs-6 hidden-sm hidden-md hidden-lg">
                           <ul>

                             <li><a href="/careereducation" target="_blank">Career Education</a></li>
                            <li><a href="http://web.wellesley.edu/map/">Map</a></li>
                            <li><a href="/about/visit">Visit</a></li>
                            <li><a href="http://campaign.wellesley.edu" onClick="ga('send', 'event', 'Gift', 'Click', 'Blue Bar Campaign');">Campaign</a></li>
                             <li><a href="/albright" target="_blank">Albright Institute</a></li>
                            <li><a href="http://www.davismuseum.wellesley.edu/" target="_blank">Davis Museum</a></li>
                            <li><a href="http://www.newhouse-center.org/" target="_blank">Newhouse Center</a></li>
                            <li><a href="http://www.wcwonline.org/" target="_blank">Wellesley Centers for Women</a></li>
                        </ul>
                    </div>

              </div>

            </div>
            <div class="sm_logo hidden-sm hidden-md hidden-lg" alt="Wellesley College logo">
              <?php echo file_get_contents("sites/all/themes/bootstrap/image/WellesleyLogoMono.svg"); ?> 
            </div>
        </div> <!--end mobile max-->



       <!--SHOW/HIDE BOTTOM FIXED FLOATING MENU SCRIPTS-->

        <script type="text/javascript">
        // RR - 03/15/2012 Added Get_Cookie and Set_Cookie functions
		// this function gets the cookie, if it exists
		// don't use this, it's weak and does not handle some cases
		// correctly, this is just to maintain legacy information

			function Get_Cookie( name )
			{
				var start = document.cookie.indexOf( name + "=" );
			  	var len = start + name.length + 1;
			  	if ( ( !start ) &&
					( name != document.cookie.substring( 0, name.length ) ) )
				{
				  	return null;
				}
			  	if ( start == -1 ) return null;
			  	var end = document.cookie.indexOf( ";", len );
			  	if ( end == -1 ) end = document.cookie.length;
			  	return unescape( document.cookie.substring( len, end ) );
			}

			function Set_Cookie( name, value, expires, path, domain, secure )
			{
			  	// set time, it's in milliseconds
			  	var today = new Date();
			  	today.setTime( today.getTime() );

				/* if the expires variable is set, make the correct
				expires time, the current script below will set
				it for x number of days, to make it for hours,
				delete * 24, for minutes, delete * 60 * 24
				*/
			  	if ( expires )
				{
				  expires = expires * 1000 * 60 * 60 * 24;
				}
			  var expires_date = new Date( today.getTime() + (expires) );

			  document.cookie = name + "=" +escape( value ) +
				( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
				( ( path ) ? ";path=" + path : "" ) +
				( ( domain ) ? ";domain=" + domain : "" ) +
				( ( secure ) ? ";secure" : "" );
			}

		</script>

        <script type="text/javascript">

			// on load check if the cookie for wellesley_menu is off

			var cookie_value = Get_Cookie('wellesley_menu');

			if (cookie_value == 'off') {
				//closed
				var div = document.getElementById('fixed-menu-min');
				div.style.display = 'block';
				var div = document.getElementById('fixed-menu-max');
				div.style.display = 'none';

				//opened
			 } else {
			  	var div = document.getElementById('fixed-menu-max');
			  	div.style.display = 'block';
			  	var div = document.getElementById('fixed-menu-min');
			  	div.style.display = 'none';
			 }


		</script>


       <script type="text/javascript">

       		//click to maximize menu

            (function ($) {$("#fixed-menu-min").click(function () {
            	$("#fixed-menu-max").slideToggle("normal");
               	$("#fixed-menu-min").fadeToggle("fast", "linear");

           // add wellesley_menu cookie

           Set_Cookie("wellesley_menu","on","",'/','','');
            });})(jQuery);

			//click hide button to minimize menu

            (function ($) {$(".hide_menu").click(function () {
              	$("#fixed-menu-max").fadeToggle("fast","linear");
             	$("#fixed-menu-min").slideToggle("normal");

           // add wellesley_menu cookie - turn off
          	Set_Cookie("wellesley_menu","off","",'/','','');
            });})(jQuery);


  			(function ($) {$(".hide_mobile").click(function () {
              	$("#mobile-max").fadeToggle("fast","linear");
             	$("#mobile-min").slideToggle("normal");

            });})(jQuery);

          (function ($) {$("#mobile-min").click(function () {
            	$("#mobile-max").slideToggle("normal");
               	$("#mobile-min").fadeToggle("fast", "linear");


            });})(jQuery);



		<!--TOGGLE SCRIPT-->
		(function ($){$('.reveal').hide();
		 	$('.toggle').click(function(){
		  	var t = $(this);
		  	t.parent().find('.reveal').toggle("fast");
		 })})(jQuery);
	    <!--END TOGGLE SCRIPT-->



		<!--TOGGLE SCRIPT WITH IMAGE-->
		(function ($){$('.reveal2').hide();
			 $('.toggle2').click(function(){
			  	var t = $(this);
			  	t.parent().find('.reveal2').toggle("fast", function(){
					// determine which image to use if hidden div is hidden after the toggling is done
					var imgsrc = ($(this).is(':hidden')) ? '/sites/all/themes/WellesleyStandard/image/downarrow.png' : '/sites/all/themes/WellesleyStandard/image/uparrow.png';
					// update image src
					t.attr('src', imgsrc );
			  });
		 })})(jQuery);

	   <!--END TOGGLE SCRIPT-->


	   <!--TOGGLE SCRIPT WITH DOTS-->

		(function ($){$('.reveal3').hide();
		 	$('.toggle3').click(function(){
		  	var t = $(this);
		  	t.parent().find('.reveal3').toggle("fast");
		   	t.parent().find('.toggle3').hide();
		 })})(jQuery);



	   	(function ($) {$('.toggleclose').click(function () {
		  	var t = $(this);
		  	t.parents().find('.reveal3').toggle("fast");
		   	t.parents('.toggle3').show();
		});})(jQuery);

	   <!--END TOGGLE SCRIPT-->




        </script>
