<?php
/**
 * @file views-view-fields.tpl.php
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>
<h1><?php print $fields['title']->content; ?></h1>
<ul class="item-navigation">
  <li><span><?php print l(t('View'), 'view', array('attributes' => array('class' => 'view'))); ?></span></li>
  <li><span><?php print l(t('Edit'), 'collection/edit/' . $fields['coll_id']->raw, array('attributes' => array('class' => 'edit'))); ?></span></li>
</ul>
<div class="collection-videos">
  collection videos overview
</div>

<div class="collection-detail-information">
  <div class="information-row">
    <p class="collection-view-count"><span class="count">20</span> <?php print t('videos'); ?></p>

    <p class="collection-uploaded-info">
      <?php print t('Posted by');?>: <strong>[hardcoded]</strong> <?php print t('on'); ?> <strong>[hardcoded]</strong>
    </p>
  </div>

</div>

<!--
<?php foreach ($fields as $id => $field): ?>
    <?php if (!empty($field->separator)): ?>
      <?php print $field->separator; ?>
    <?php endif; ?>

    <?php print $field->wrapper_prefix; ?>
      <?php print $field->label_html; ?>
      <?php print $field->content; ?>
    <?php print $field->wrapper_suffix; ?>
  <?php endforeach; ?>
  --> 