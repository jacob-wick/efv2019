<?php $packages = EFRVS_Archive::get_packages(); ?>

<?php if ($packages) : ?>

  <h3 class="h4-cap package-list-header" id="packages"><?php _e('Packages', EFRVS_THEME_TDOMAIN); ?></h3>

  <ul class="package-list">
    <?php foreach($packages as $package) : ?>
      <?php $EFRVS_Package = new EFRVS_Package($package); ?>
      <?php include(locate_template('parts/li-package.php')); ?>
    <?php endforeach; ?>
  </ul>

<?php endif; ?>