<?php if (is_front_page()) : ?>

  <?php
    
    $home_banner_text = get_field('home_banner_text');
    $home_banner_btn  = $home_banner_text['button_options'];

  ?>

  <div class="banner <?php esc_attr_e(EFRVS_Theme::get_banner_classes()); ?>">

    <div class="banner__inner banner__inner--stretch media-background-texture"></div>

    <div class="home-banner edge-pad">
      <div class="container container--lg">
        <div class="home-banner__logo animate fade-in">
          <img class="responsive-image" src="<?php echo get_template_directory_uri(); ?>/assets/dist/img/effervescence-logo-black@2x.png" height="" width="" alt="Effervescense" >
        </div>

        <div class="home-banner__text animate slide-in-from-right">
          <span class="home-banner__pre-title h4-sans"><?php echo $home_banner_text['before_title']; ?></span>
          <h1 class="home-banner__title h2"><?php echo $home_banner_text['title']; ?></h1>
          <?php if ($home_banner_btn['text']) : ?>
            <?php echo EFRVS_Theme::get_button($home_banner_btn); ?>
          <?php endif; ?>
        </div>
      
      </div>
    </div>

    <?php get_template_part('parts/home-bubbles'); ?>

  </div>

<?php else : ?>

  <div class="banner <?php esc_attr_e(EFRVS_Theme::get_banner_classes()); ?>">
    <div class="banner__inner" style="<?php echo EFRVS_Theme::get_banner_background_image(); ?>">
      <div class="banner__gradient"></div>
    </div>
  </div>

<?php endif; ?>