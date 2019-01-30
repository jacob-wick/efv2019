<?php // TEMPLATE NAME: Sponsors

  get_header();
  
  global $EFRVS_Theme;

?>
  
  <div class="content <?php esc_attr_e($EFRVS_Theme->get_main_content_css_classes()); ?>">
    <div class="content__top-curve">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>
    <div class="content__background">
      <div class="content__inner container">

        <header class="content-header content-header--archive">
          <div class="content-header__intro">
            <h1 class="h1 mb-2"><?php the_title(); ?></h1>
            <div class="wysiwyg">
              <?php the_content(); ?>
            </div>
          </div>
        </header>

        <?php if( have_rows('sponsor_logos') ) : ?>
          <?php while ( have_rows('sponsor_logos') ) : the_row(); ?>
            <?php $size = get_sub_field('size'); ?>

            <div class="mb-8 t-rule-lt pt-2">
              <h2 class="h2 mb-2"><?php the_sub_field('tier'); ?></h3>

              <?php if( have_rows('sponsors') ) : ?>
                <ul class="sponsor-grid sponsor-grid--<?php esc_attr_e($size); ?>">
                  <?php while ( have_rows('sponsors') ) : the_row(); ?>
                    <li class="sponsor-grid-item">
                      <a class="sponsor-grid-item__logo opacity-hover" target="_blank" href="<?php esc_attr_e(get_sub_field('website')); ?>">
                        <?php echo EFRVS_Theme::get_sponsor_grid_logo(); ?>
                      </a>
                      <h3 class="sponsor-grid-item__head h5 text-center">
                        <a class="sponsor-grid-item__head-a link-primary" target="_blank" href="<?php esc_attr_e(get_sub_field('website')); ?>">
                          <?php the_sub_field('name'); ?>
                        </a>
                      </h3>
                    </li>
                  <?php endwhile; ?>
                </ul>
              <?php endif; ?>

            </div>
          <?php endwhile; ?>
        <?php endif; ?>

      </div>
    </div>
  </div>

<?php get_footer(); ?>
