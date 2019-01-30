<?php get_header(); ?>
  
  <div class="content content--for-bottom-curve">
    <div class="content__top-curve">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>
    <div class="content__background edge-pad">
      <div class="content__inner container">

        <?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

          <div class="content-header">
            <h1 class="content-header__title h1 mb-2"><?php the_title(); ?></h1>
            <div class="content-header__intro wysiwyg">
              <?php the_field('post_content'); ?>
            </div>
          </div>

        <?php endwhile; endif; ?>

      </div>
    </div>
  </div>

<?php get_footer(); ?>