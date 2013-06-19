<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <!-- CSS: implied media=all -->
	<link href='http://fonts.googleapis.com/css?family=Lobster&subset=cyrillic' rel='stylesheet' type='text/css'>
  <!-- CSS concatenated and minified via ant build script-->
  
  <!-- end CSS-->

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

  <!-- All JavaScript at the bottom, except for Modernizr / Respond.
       Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body class="<?php echo $this->bodyClasses()?>">

  <div id="body-container">

      <div id="streetsList" style="display: none;">
          <div class="op-bg"></div>
          <div class="scrollLeft"><<</div>

          <ul>
          </ul>

          <div class="scrollRight">>></div>
      </div>

      <div id="form-block" class="search-route">
<!--          <div class="modal-header">-->
<!--              <h5>Поиск маршрута</h5>-->
<!--          </div>-->
              <div class="modal-content">
                  <?php echo $content; ?>
                  <a href="#" class="toggleStreets"></a>
              </div>
<!--          <div class="modal-footer">-->
<!--              </div>-->
      </div>




<!---->
<!--    <header class="main">-->
<!--      <div class="wrapper">-->
<!---->
<!--	      <div class="one-fifth" style="width: 90px;">-->
<!--          <h1 id="logo">-->
<!--            <a href="index.php">Маршруты</a>-->
<!--          </h1>-->
<!--				</div>-->
<!--	      <div class="four-fifth last">-->
<!--<!--		  -->   <?php //echo $co<!--ntent; ?>
<!--	      </div>-->
<!---->
<!--	      <a href="#" class="toggleStreets"></a>-->
<!---->
<!--      </div>-->
<!--      <!-- END .wrapper -->
<!---->
<!--	    <div id="streetsList" style="display: none;">-->
<!---->
<!--		    <div class="scrollLeft"><<</div>-->
<!---->
<!--		    <ul>-->
<!--			    <!---->
<!--			    <li class="odd first"><a href="#">Станция 1</a>-->
<!--				    <span class="decor l"></span>-->
<!--				    <span class="decor r"></span>-->
<!--			    </li>-->
<!--			    <li class="even"><a href="#">вул. Тракторобудивникив / салт. шоссу </a>-->
<!--				    <span class="decor l"></span>-->
<!--				    <span class="decor r"></span>-->
<!--			    </li>-->
<!--			    <li class="odd"><a href="#">Станция 1</a>-->
<!--				    <span class="decor l"></span>-->
<!--				    <span class="decor r"></span>-->
<!--			    </li>-->
<!--			    <li class="even last"><a href="#">Станция 1</a>-->
<!--				    <span class="decor l"></span>-->
<!--				    <span class="decor r"></span>-->
<!--			    </li>-->
<!---->
<!--		    </ul>-->
<!---->
<!--		    <div class="scrollRight">>></div>-->
<!--	    </div>-->
<!---->
<!---->
<!--    </header>-->

    <div id="main">

	    <!-- Map: -->
	    <div id="map_container"></div>

      <!-- END .wrapper -->
    </div>
    <!-- END #main -->

      <section id="footerbar">

          <div id="map_legend"><ul></ul></div>

      </section>

  </div>
  <!-- END #body-container -->


  <!-- JavaScript at the bottom for fast page loading -->

<?php
/*
  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>
*/
  ?>

  <!-- scripts concatenated and minified via ant build script-->
<!--  <script defer src="-->
  <?php
  //echo Yii::app()->request->baseUrl;
  ?><!--/js/script.js"></script>-->
  <!-- end scripts-->

<?php
/*
  <!-- Change UA-XXXXX-X to be your site's ID -->
  <script>
    window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
      load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
    });
  </script>
*/
  ?>

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
</body>
</html>
