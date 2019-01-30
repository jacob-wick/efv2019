<?php // TEMPLATE NAME: Packages Index

  $packages = EFRVS_Archive::get_packages();

?>

<?php get_header(); ?>
  
  <div class="content <?php esc_attr_e($EFRVS_Theme->get_main_content_css_classes()); ?>">
    <div class="content__top-curve">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>
    <div class="content__background">
      <div class="content__inner container">

        <header class="content-header">
          <h1 class="h1 mb-2"><?php the_title(); ?></h1>
          <div class="content-header__intro">
            <div class="wysiwyg mb-2">
            <?php the_content(); ?>
            </div>
          </div>
          <div class="content-header__date">
            <h3 class="prehead screen-reader-text"><?php _e('Share this on', EFRVS_THEME_TDOMAIN); ?></h3>
            <ul class="icon-box-list">
              <li class="icon-box-item"><a class="icon-box-item__a" href="#"><span class="screen-reader-text">Twitter</span></a></li>
              <li class="icon-box-item"><a class="icon-box-item__a" href="#"><span class="screen-reader-text">Facebook</span></a></li>
              <li class="icon-box-item"><a class="icon-box-item__a" href="#"><span class="screen-reader-text">Email</span></a></li>
            </ul>
          </div>
        </header>

        <?php if ( $packages ) : ?>
          <ul class="event-list">
            <?php $counter = 0; ?>
            <?php foreach ($packages as $package) : $counter++; ?>
              <li class="event-list-item <?php if ($counter % 2 == 0) { esc_attr_e('event-list-item--offset'); }; ?> mb-5 animate">
                <div class="event-list-item__thumbnail">
                  <a class="event-list-item__thumbnail-crop opacity-hover animate slide-in-from-right" href="<?php esc_attr_e(get_term_link($package)); ?>"><?php echo EFRVS_Archive::get_term_thumbnail($package); ?></a>
                  <span class="thumbnail-flair">
                    <span class="thumbnail-flair__dot thumbnail-flair__dot--1"></span>
                    <span class="thumbnail-flair__dot thumbnail-flair__dot--2"></span>
                    <span class="thumbnail-flair__dot thumbnail-flair__dot--3"></span>
                    <span class="thumbnail-flair__curve"></span>
                  </span>
                </div>
                <div class="event-list-item__detail animate slide-in-from-right">
                  <h2 class="event-list-item__title h2 mb-1"><a class="opacity-hover" href="<?php esc_attr_e(get_term_link($package)); ?>"><?php echo $package->name; ?></a></h2>
                  <div class="event-list-item__excerpt wysiwyg mb-2">
                    <?php the_field('term_description', $package); ?>
                  </div>
                  <a href="<?php esc_attr_e(get_term_link($package)); ?>" class="btn btn--liquid">
                    <span class="btn__label"><?php _e('Details', EFRVS_THEME_TDOMAIN); ?></span>
                    <span class="btn__effect"></span>
                  </a>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

      </div>
    </div>
  </div>

<?php get_footer(); ?>