<?php // TEMPLATE NAME: Beneficiaries

  get_header();

  global $EFRVS_Theme;  

?>
  
  <div class="content <?php esc_attr_e($EFRVS_Theme->get_main_content_css_classes()); ?>">
    <div class="content__top-curve">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>
    <div class="content__background">
      <div class="content__inner container">

        <header class="content-header content-header--term mb-6">
          <h1 class="h1 mb-2"><?php the_title(); ?></h1>
          <div class="content-header__intro">
            <div class="wysiwyg">
              <?php the_field('post_content'); ?>
            </div>
          </div>
        </header>

        <?php if( have_rows('beneficiaries') ) : while ( have_rows('beneficiaries') ) : the_row(); ?>

          <div class="b-rule-lt pb-6 mt-6">
          
            <div class="content-header content-header--term">

              <div class="content-header__logo">
                <a class="opacity-hover" target="_blank" href="<?php esc_attr_e(get_sub_field('website')); ?>">
                  <?php echo EFRVS_Page::get_beneficiary_logo(); ?>
                </a>
              </div>

              <h1 class="h3 mb-2">
                <a class="link-primary" target="_blank" href="<?php esc_attr_e(get_sub_field('website')); ?>">
                  <?php the_sub_field('name'); ?>
                </a>
              </h1>
              <div class="content-header__intro">
                <div class="wysiwyg">
                  <?php the_sub_field('description'); ?>
                </div>
              </div>

              <div class="content-header__event-list">
                <?php get_template_part('parts/share-this'); ?>
              </div>

            </div>

            <div class="content__term-photo">
              <?php echo EFRVS_Page::get_beneficiary_photo(); ?>
              <p class="content__term-photo-caption caption"><?php echo EFRVS_Page::get_beneficiary_photo_caption(); ?></p>
            </div>
          
          </div>

        <?php endwhile; endif; ?>

      </div>
    </div>
  </div>

<?php get_footer(); ?>