<?php get_header(); ?>
  
  <div class="content content--for-bottom-curve">
    <div class="content__top-curve">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>
    <div class="content__background edge-pad">
      <div class="content__inner container">

        <div class="text-center">
          <h1 class="h1 mb-2"><?php _e('404 Error', EFRVS_THEME_TDOMAIN); ?></h1>
          <div class="wysiwyg">
            <?php _e('That page could not be found.', EFRVS_THEME_TDOMAIN); ?>
          </div>
        </div>

      </div>
    </div>
  </div>

<?php get_footer(); ?>