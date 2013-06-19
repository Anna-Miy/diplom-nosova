<?php

if($body_classes && empty($body_classes))
  $body_classes = '';

if(isset($_GET['fullwidth']) && $_GET['fullwidth'])
  $body_classes.= ' fullwidth';

?>

<!DOCTYPE html>

<html lang="en-US">
  <head>
    <title>Polyon - HTML Template</title>
    
    <!-- Meta-Tags -->
    <meta charset="utf-8" />
    <meta name="description" content="Put your description in here" />
    
    <!-- Main CSS -->
    <link href="stylesheets/style.css" media="screen, projection" rel="stylesheet" />
    
    <!-- CSS Browser Selector -->
    <script src="javascripts/css_browser_selector.js"></script>
    
    <!-- jQuery & Custom Functions -->
    <script src="javascripts/jquery.js"></script>
    <script src="javascripts/script.js"></script>
    
    <!-- Superfish -->
    <script src="javascripts/jquery.superfish.js"></script>
    
    <!-- Contact Form -->
    <script src="javascripts/jquery.validate.pack.js"></script>
    <script src="javascripts/jquery.form.js"></script>
    
    <!-- prettyPhoto -->
    <link href="plugins/prettyphoto/css/prettyPhoto.css" media="screen, projection" rel="stylesheet" type="text/css" />
    <script src="plugins/prettyphoto/js/jquery.prettyPhoto.js"></script>
    
    <!-- Piecemaker Slider -->
    <script src="plugins/piecemaker/scripts/swfobject/swfobject.js"></script>
    
    <!-- Nivo Slider -->
    <link href="plugins/nivo-slider/nivo-slider.css" media="screen, projection" rel="stylesheet" type="text/css" />
    <script src="plugins/nivo-slider/jquery.nivo.slider.pack.js"></script>
    
    <!-- Slides Slider -->
    <script src="plugins/slides/slides.min.jquery.js"></script>
    
    <!--[if lte IE 8]>
      <script src="javascripts/ie.html5.js"></script>
    <![endif]-->
  </head>
  
  <body class="button-nav <?php echo $body_classes ?>">
    <div id="body-container">
      <header class="main">
        <div class="wrapper">
          <h1 id="logo">
            <a href="index.php">Polyon</a>
          </h1>
          
          <nav class="main">
            <ul>
              <li><a href="index.php">Home</a>
                <ul>
                  <li><a href="index.php?slider=piecemaker">Piecemaker Slider</a></li>
                  <li><a href="index.php?slider=nivo">Nivo Slider</a></li>
                  <li><a href="index.php?slider=slides">Anything Slider</a></li>
                  <li><a href="index.php?slider=image_left">Image Left</a></li>
                  <li><a href="index.php?slider=image_right">Image Right</a></li>
                  <li><a href="index.php?slider=video_left">Video Left</a></li>
                  <li><a href="index.php?slider=video_right">Video Right</a></li>
                </ul>
              </li>
              <li><a href="styles.php">Styles</a>
                <ul>
                  <li><a href="styles.php">Template Styles</a></li>
                  <li><a href="styles2.php">More Template Styles</a></li>
                  <li><a href="page.php">Page Template</a></li>
                  <li><a href="#">More Examples</a>
                    <ul>
                      <li><a href="pricing.php">Pricing Tables</a></li>
                      <li><a href="gallery.php">Picture Gallery</a></li>
                      <li><a href="post.php">Post with Comments</a></li>
                      <li><a href="columns.php">Columns</a></li>
                      <li><a href="archive.php">Archive</a></li>
                      <li><a href="forms.php">Forms</a></li>
                    </ul>
                  </li>
                  <li><a href="services.php">Services</a></li>
                  <li><a href="testimonials.php">Testimonials</a></li>
                  <li><a href="team.php">Team</a></li>
                  <li><a href="fullwidth.php">Full Width Page</a></li>
                  <li><a href="blog_fullwidth.php">Blog (Full Width)</a></li>
                  <li><a href="columns.php?fullwidth=true">Columns (Full Width)</a></li>
                </ul>
              </li>
              <li><a href="blog.php">Blog</a></li>
              <li><a href="portfolio_3c.php">Portfolio</a>
                <ul>
                  <li><a href="portfolio_1c.php">1 Column</a></li>
                  <li><a href="portfolio_2c.php">2 Columns</a></li>
                  <li><a href="portfolio_3c.php">3 Columns</a>
                    <ul>
                      <li><a href="portfolio_1c.php">1 Column</a></li>
                      <li><a href="portfolio_2c.php">2 Columns</a></li>
                      <li><a href="portfolio_3c.php">3 Columns</a></li>
                      <li><a href="portfolio_4c.php">4 Columns</a></li>
                    </ul>
                  </li>
                  <li><a href="portfolio_4c.php">4 Columns</a></li>
                </ul>
              </li>
              <li><a href="contact.php">Contact</a></li>
            </ul>
          </nav>
        </div>
        <!-- END .wrapper -->
      </header>
      
      <?php if(!$frontpage): ?>
      <section id="topbar">
        <div class="deco-top-border"></div>
        <div class="deco-shine"></div>
        <div class="deco-top">
          <div class="deco-bottom">
            <div id="punchline" class="wrapper with-overflow">
              Put a cool and catchy slogan in here to make your newly purchased Template more interesting!
            </div>
          </div>
        </div>
        <div class="deco-bottom-border"></div>
      </section>
      <?php else: 
        if(isset($_GET['slider']) && $_GET['slider'])
          include '_frontpage_'.$_GET['slider'].'.php';
        else
          include '_frontpage_nivo.php';
      endif; ?>
    
      <?php if($frontpage): ?>
        <section id="welcomebar">
          <div class="wrapper with-overflow">
            <h2>
              A Premium Template Made For You
            </h2>
            <p>
              Put a cool and catchy slogan in here to make your newly purchased Template more interesting!
            </p>
          </div>
        </section>
      <?php endif; ?>
      
      <div id="main">
      
        <div class="wrapper with-overflow">