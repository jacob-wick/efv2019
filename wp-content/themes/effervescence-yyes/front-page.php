<?php

  get_header();

  $home_more_events_text   = get_field('home_more_events_text');
  $home_more_events_button = get_field('home_more_events_button');
  $home_more_events_button = $home_more_events_button['button_options'];

?>

  <div class="content content--for-bottom-curve">
    <div class="content__top-curve">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>
    <div class="content__background edge-pad">
      <div class="content__inner container">

        <div class="event-list-head">
          <h3 class="event-list-head__text h4-cap"><?php _e('Featured Event', EFRVS_THEME_TDOMAIN); ?></h3>
          <a class="event-list-head__link link-primary-to-fade p" href="/events/"><?php _e('See All Events', EFRVS_THEME_TDOMAIN); ?></a>
        </div>

        <?php $posts = get_field('home_featured_events'); ?>
        <?php $counter = 0; ?>
        <?php if ($posts) : ?>
          <ul class="event-list mb-3">
            <?php foreach($posts as $post) : setup_postdata($post); $counter++; ?>
              <?php include(locate_template('parts/li-event.php')); ?>
            <?php endforeach; wp_reset_postdata(); ?>
          </ul>
        <?php endif; ?>

        <?php if ($home_more_events_text) : ?>
          <div class="cta cta--aside animate slide-in-from-bottom">
            <div class="cta__text">
              <h3 class="h3"><?php the_field('home_more_events_text'); ?></h3>
            </div>
            <div class="cta__btn">
              <?php echo EFRVS_Theme::get_button($home_more_events_button); ?>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>

<?php get_template_part('parts/cta'); ?>
<?php get_footer(); ?>