<?php if( have_rows('beneficiaries') ) : while ( have_rows('beneficiaries') ) : the_row(); ?>

<div class="event-list-head">
  <h3 class="event-list-head__text h4-cap"><?php _e('Charitable Collaborator', EFRVS_THEME_TDOMAIN); ?></h3>
  <a class="event-list-head__link link-primary-to-fade p" href="https://mindsmatterla.org/"><?php _e('Learn More', EFRVS_THEME_TDOMAIN); ?></a>
</div>

<ul class="event-list mb-3">

  <li class="event-list-item animate">
    <div class="event-list-item__thumbnail">
      <a class="event-list-item__thumbnail-crop opacity-hover animate slide-in-from-right"
        href="<?php esc_attr_e(get_sub_field('website')); ?>">
                  <?php echo EFRVS_Page::get_beneficiary_logo(); ?>
      </a>
      <span class="thumbnail-flair <?php esc_attr_e(EFRVS_Theme::get_thumbnail_flair_class($counter)); ?>">
        <span class="thumbnail-flair__dot thumbnail-flair__dot--1"></span>
        <span class="thumbnail-flair__dot thumbnail-flair__dot--2"></span>
        <span class="thumbnail-flair__dot thumbnail-flair__dot--3"></span>
        <span class="thumbnail-flair__curve"></span>
      </span>
    </div>
    
    <div class="event-list-item__detail animate slide-in-from-right">

    <div class="content-header content-header--term">

      <h2 class="event-list-item__title h1">
        <a class="opacity-hover" href="<?php esc_attr_e(get_sub_field('website')); ?>">
          <?php the_sub_field('name'); ?>
        </a>
      </h2>

      <div class="event-list-item__excerpt wysiwyg mt-1 mb-1">
        <?php the_sub_field('description'); ?>
      </div>

    </div>
  
  </li>

</ul>

<?php endwhile; endif; ?>