<?php if (isset($fields['still_url']) && !empty($fields['still_url']->content)): ?>
  <?php if ($fields['granted']->raw == 'TRUE'): ?>
    <?php print $fields['still_url']->content; ?>
  <?php else: ?>
    <?php print l(theme('image', array('path' => drupal_get_path('theme', 'mediamosa_sb_theme') . '/images/notgranted.png', 'alt' => t("You don't have the right permissions to access this video"))), 'asset/detail/' . $fields['asset_id']->raw, array('html' => TRUE)); ?>
  <?php endif; ?>
<?php endif; ?>

<div class="asset-information">
  <?php if ($fields['granted']->raw == 'TRUE'): ?>
    <?php print $fields['mediafile_duration']->wrapper_prefix; ?>
    <?php print $fields['mediafile_duration']->content; ?>
    <?php print $fields['mediafile_duration']->wrapper_suffix; ?>
  <?php endif; ?>

  <?php print $fields['viewed']->wrapper_prefix; ?>
  <?php print $fields['viewed']->content; ?>
  <?php print $fields['viewed']->wrapper_suffix; ?>

  <?php print $fields['title']->wrapper_prefix; ?>
  <?php print $fields['title']->content; ?>
  <?php print $fields['title']->wrapper_suffix; ?>

  <?php print $fields['videotimestamp']->wrapper_prefix; ?>
  <?php print $fields['videotimestamp']->content; ?>
  <?php print $fields['videotimestamp']->wrapper_suffix; ?>
</div>