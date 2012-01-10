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
 * Implements hook_js_alter().
 * Used to change the tableHeaderOffset Drupal setting.
 */
// function bootstrap_js_alter($javascript) {
//   if (isset($javascript['settings']['data'])) {
//     foreach (array_keys($javascript['settings']['data']) as $key) {
//       if (isset($javascript['settings']['data'][$key]['tableHeaderOffset'])) {
//         $javascript['settings']['data'][$key]['tableHeaderOffset'] = '40+' . $javascript['settings']['data'][$key]['tableHeaderOffset'];
//         break;
//       }
//     }
//   }
// }

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

// function mm_sb_fieldset($variables) {
//   $element = $variables['element'];
//   element_set_attributes($element, array('id'));
//   _form_set_class($element, array('form-wrapper'));

//   $output = '<fieldset' . drupal_attributes($element['#attributes']) . '>';
//   if (!empty($element['#title'])) {
//     // Always wrap fieldset legends in a SPAN for CSS positioning.
//     $output .= '<div class="legend"><span class="fieldset-legend">' . $element['#title'] . '</span></div>';
//   }
//   $output .= '<div class="fieldset-wrapper">';
//   if (!empty($element['#description'])) {
//     $output .= '<div class="fieldset-description">' . $element['#description'] . '</div>';
//   }
//   $output .= $element['#children'];
//   if (isset($element['#value'])) {
//     $output .= $element['#value'];
//   }
//   $output .= '</div>';
//   $output .= "</fieldset>\n";
//   return $output;
// }

/**
 * Theme override for theme_form().
 */
// function bootstrap_form($variables) {
//   $variables['element']['#attributes']['class'] = 'form-stacked';
//   return theme_form($variables);
// }

/**
 * Theme override for theme_submit().
 */
// function bootstrap_button($variables) {
//   $class = array('btn');
//   if ($variables['element']['#type'] == 'submit') {
//     if (in_array($variables['element']['#value'], array(t('Save'), t('Store'), t('Submit'), t('Next'), t('Next step')))) {
//       $class[] = 'primary';
//     }
//   }
//   _bootstrap_element_set_class($variables['element'], $class);
//   return theme_button($variables);
// }

/**
 * Theme override for theme_confirm_form().
 */
// function bootstrap_confirm_form($variables) {
//   _bootstrap_element_set_class($variables['form']['actions']['submit'], 'btn primary');
//   _bootstrap_element_set_class($variables['form']['actions']['cancel'], 'btn');
//   return drupal_render_children($variables['form']);
// }

/**
 * Helper function for adding a class name to an element.
 * Similar to _form_set_class().
 * @param array $element Form element.
 * @param mixed $class String or array.
 */
// function _bootstrap_element_set_class(&$element, $class) {
//   $class = (array) (is_string($class) ? explode(' ', $class) : $class);
//   if (!isset($element['#attributes']['class'])) {
//     $element['#attributes']['class'] = array();
//   }

//   $element['#attributes']['class'] = array_unique(array_merge($element['#attributes']['class'], $class));
// }

/**
 * Theme override for theme_status_messages().
 */
// function bootstrap_status_messages($variables) {
//   $display = $variables['display'];
//   $output = '';

//   $status_heading = array(
//     'status' => t('Status message'),
//     'error' => t('Error message'),
//     'warning' => t('Warning message'),
//   );

//   // Translate Drupal message types to Bootstrap message types.
//   $translate = array(
//     'status' => 'success',
//   );
//   $has_close = FALSE;

//   foreach (drupal_get_messages($display) as $type => $messages) {
//     $output .= "<div class=\"alert-message block-message " . (isset($translate[$type]) ? $translate[$type] : $type) . " fade in\" data-alert>\n";
//     if ($type != 'error') {
//       $output .= '<a class="close" href="#">×</a>';
//       $has_close = TRUE;
//     }
//     if (!empty($status_heading[$type])) {
//       $output .= '<h2 class="element-invisible">' . $status_heading[$type] . "</h2>\n";
//     }
//     if (count($messages) > 1) {
//       $output .= " <ul>\n";
//       foreach ($messages as $message) {
//         $output .= '  <li>' . $message . "</li>\n";
//       }
//       $output .= " </ul>\n";
//     }
//     else {
//       $output .= $messages[0];
//     }
//     $output .= "</div>\n";
//   }

//   if ($has_close) {
//     // Add javascript for closing messages.
//     drupal_add_js(drupal_get_path('theme', 'bootstrap') . '/js/bootstrap-alerts.js', array('group' => JS_THEME));
//   }

//   return $output;
// }

/**
 * Helper function for returning a link to either a minified or normal version
 * of a CSS or Javascript file.
 */
// function _bootstrap_file_name() {

// }