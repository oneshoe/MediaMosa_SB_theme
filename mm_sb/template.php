<?php
// $Id: template.php 1830 2011-10-13 16:16:01Z thijs $

/**
 * @file
 * Template file containing alternative rendering for Drupal's default methods.
 *
 * @author Thijs @ One Shoe
 */

/**
 * Implements hook_theme().
 */
function bootstrap_theme() {
  return array(
    'pager' => array(
      'variables' => array('tags' => array(), 'element' => 0, 'parameters' => array(), 'quantity' => 9),
      'file' => 'includes/pager.inc',
    ),
    'pager_placeholder' => array(
      'variables' => array('text' => NULL),
      'file' => 'includes/pager.inc',
    ),
  );
}

/**
 * Override or insert variables into the page template for HTML output.
 */
function mm_sb_process_html(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_html_alter($variables);
  }
}

/**
 * Implements hook_preprocess_page().
 */
function mm_sb_preprocess_page(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }
  //$variables['container_class'] = 'container-fluid';

  // Set the $has_tabs variable.
  //$variables['has_tabs'] = ($variables['tabs'] && (!empty($variables['tabs']['#primary']) || !empty($variables['tabs']['#secondary'])));
}

/**
 * Theme override for theme_breadcrumb().
 */
function mm_sb_breadcrumb($variables) {
  $breadcrumb = array_values($variables['breadcrumb']);
  $l = count($breadcrumb);
  $items = array();
  for ($i = 0; $i < $l; $i++) {
    $items[] = '<li>' . $breadcrumb[$i] . '</li>';
  }
  // @todo Check if drupal_get_title() needs a check_plain().
  $current_title = drupal_get_title();
  if (!$current_title && empty($variables['breadcrumb']) && drupal_is_front_page()) {
    $current_title = t('Home');
  }
  $items[] = '<li class="active">' . ($current_title)  . '</li>';

  return '<ul class="breadcrumb">' . implode($items) . '</ul>';
}