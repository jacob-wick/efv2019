<?php // TEMPLATE NAME: FAQ

  get_header();
  
  global $EFRVS_Theme;

?>
  
  <div class="content <?php esc_attr_e($EFRVS_Theme->get_main_content_css_classes()); ?>">
    <div class="content__top-curve">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>
    <div class="content__background edge-pad">
      <div class="content__inner container">
        <div class="content__pinch2">

          <header class="content-header pb-3">
            <h1 class="h1 mb-2"><?php the_title(); ?></h1>
            <div class="wysiwyg">
              <?php the_content(); ?>
            </div>
          </header>
          
          <?php if( have_rows('question_list') ) : $counter = 1; ?>

            <?php while ( have_rows('question_list') ) : the_row(); ?>
              
              <h2 class="h3 mb-2"><?php the_sub_field('subhead'); ?></h2>

              <?php if( have_rows('list') ) : ?>
                <ul class="accordion-list mb-5">
                  <?php while ( have_rows('list') ) : the_row(); ?>
                    <?php $target_ref = 'accordion_item_'.get_the_ID().'_'.$counter; ?>
                    <li class="accordion-list-item mb-2">
                      <button class="accordion-list-item__subhead toggler js-toggler h4-sans mb-1" data-accordion-target="<?php esc_attr_e($target_ref); ?>">
                        <?php the_sub_field('question'); ?>
                      </button>
                      <div class="accordion-list-item__content toggler-target wysiwyg" id="<?php esc_attr_e($target_ref); ?>">
                        <?php the_sub_field('answer'); ?>
                      </div>
                    </li>
                  <?php $counter++; endwhile; ?>
                </ul>
              <?php endif; ?>

            <?php endwhile; ?>
          
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>
