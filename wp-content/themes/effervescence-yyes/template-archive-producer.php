<?php // TEMPLATE NAME: Producer Archive

  global $EFRVS_Theme;
  
  $champagne_term_id = 31;
  $sparkling_term_id = 30;

  $champagnes = EFRVS_Archive::get_producers($champagne_term_id);
  $sparklings = EFRVS_Archive::get_producers($sparkling_term_id);

?>

<?php get_header(); ?>
  
  <div class="content <?php esc_attr_e($EFRVS_Theme->get_main_content_css_classes()); ?>">
    <div class="content__top-curve">
      <?php include(locate_template('assets/dist/img/top-curve-1.svg')); ?>
    </div>
    <div class="content__background edge-pad">
      <div class="content__inner container">

        <header class="content-header content-header--archive">
          <div class="content-header__intro">
            <h1 class="h1 mb-2"><?php the_title(); ?></h1>
            <div class="wysiwyg">
              <?php the_content(); ?>
            </div>
          </div>
        </header>

        <?php if ($champagnes) : ?>
          <h2 class="h3 mb-3" id="champagne"><?php echo EFRVS_Archive::get_term_name($champagne_term_id); ?></h2>
          <ul class="participant-list">
            <?php foreach($champagnes as $champagne) : ?>
              <li class="participant-list-item "><a class="participant-list-item__a opacity-hover" href="<?php echo get_term_link($champagne->term_id); ?>"><?php echo $champagne->name; ?></a></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?php if ($sparklings) : ?>
          <h2 class="h3 mb-3" id="sparkling_wine"><?php echo EFRVS_Archive::get_term_name($sparkling_term_id); ?></h2>
          <ul class="participant-list">
            <?php foreach($sparklings as $sparkling) : ?>
              <li class="participant-list-item "><a class="participant-list-item__a opacity-hover" href="<?php echo get_term_link($sparkling->term_id); ?>"><?php echo $sparkling->name; ?></a></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

      </div>
    </div>
  </div>

<?php get_footer(); ?>