<?php // TEMPLATE NAME: Discover

  get_header();
  
  global $EFRVS_Theme;

?>
  
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

        <?php if( have_rows('discover_locations') ) : ?>
          <?php while ( have_rows('discover_locations') ) : the_row(); ?>
            <h2 class="h3 mb-2"><?php the_sub_field('section'); ?></h3>

            <?php if( have_rows('locations') ) : ?>
              <ul class="discover-list mb-5">
                <?php while ( have_rows('locations') ) : the_row(); ?>
                  <?php $address = get_sub_field('address'); ?>
                  <li class="discover-list-item mb-2">
                    <h3 class="discover-list-item__subhead h4-sans mb-1">
                      <a class="arrow-link-primary" href="<?php the_sub_field('website'); ?>" target="_blank">
                        <span class="arrow-link-primary__inner">
                          <?php the_sub_field('name'); ?>
                        </span>
                      </a>
                    </h3>
                    <div class="discover-list-item__content">
                    <div class="discover-list-item__photo">
                        <?php echo EFRVS_Discover::get_photo(); ?>
                    </div>
                    <div class="discover-list-item__description wysiwyg">
                        <?php the_sub_field('description'); ?>
                      </div>
                      <div class="discover-list-item__meta">
                        <p class="p-sans">
                          <a href="<?php echo EFRVS_Discover::get_map_url(); ?>" target="_blank">
                            <?php echo $address['street']; ?>, <?php echo $address['city']; ?>
                          </a><br>
                          <span class="strong"><?php the_sub_field('phone'); ?></strong>
                        </p>
                      </div>
                    </div>
                  </li>
                <?php endwhile; ?>
              </ul>
            <?php endif; ?>

          <?php endwhile; ?>
        <?php endif; ?>

      </div>
    </div>
  </div>

<?php get_footer(); ?>
