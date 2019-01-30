<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300" rel="stylesheet" data-norem>

    <?php
    
      global $EFRVS_Theme;
      $EFRVS_Theme = new EFRVS_Theme;
      wp_head();
      gravity_form_enqueue_scripts(1, true);

    ?>

    <script>(function($) { $('html').removeClass('no-js').addClass('js') })(jQuery);</script>

    <!--[if lt IE 9]>
      <script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5shiv.min.js"></script>
      <script src="<?php echo get_template_directory_uri(); ?>/assets/js/respond.min.js"></script>
    <![endif]-->

  </head>
  <body <?php body_class(); ?>>

  <header class="header" role="banner">

    <div class="container container--xl">
      <a class="header__logo opacity-hover" href="<?php echo home_url(); ?>">
        <img class="header__logo-img" src="<?php echo get_template_directory_uri(); ?>/assets/dist/img/effervescence-logo-white.png" width="420" height="215" alt="Effervescence">
      </a>

      <button class="header__nav-btn header-menu-btn hamburger hamburger--squeeze js-hamburger" js-hamburger type="button" aria-label="Menu" aria-controls="mainNav" id="mainMenuButton">
        <span class="header__nav-btn-label"><?php _e('Menu', EFRVS_THEME_TDOMAIN); ?></span>
        <span class="hamburger-box">
          <span class="hamburger-inner"></span>
        </span>
      </button>
    </div>

  </header>
  
  <?php get_template_part('parts/layover'); ?>

  <div class="master">

    <?php get_template_part('parts/banner'); ?>