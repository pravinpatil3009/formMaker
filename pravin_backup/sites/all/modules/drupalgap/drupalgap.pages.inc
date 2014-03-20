<?php

/**
 * @file
 * Provides page callback functions for DrupalGap.
 */

/**
 * Returns the HTML for the DrupalGap module status page.
 */
function drupalgap_status() {
  // Add drupalgap javascript settings to Drupal settings.
  drupal_add_js(array('drupalgap' => array('services_endpoint_default' => base_path() . '?q=drupalgap/')), 'setting');

  // Add drupalgap javascript.
  drupal_add_js(drupal_get_path('module', 'drupalgap') . '/drupalgap.js');

  // Set div id for system connect status message box.
  $div_id = 'drupalgap-system-connect-status-message';

  $output = "";

  $system_connect_fieldset = array(
    '#title' => t('System Connect Status'),
    '#value' => '<div id="' . $div_id . '">&nbsp;</div>',
  );

  $output .= theme_fieldset($system_connect_fieldset);

  // Build documentation text and URL.
  $doc_msg = t('The online <a href="@doc_url">DrupalGap Documentation</a> contains more information on help topics.', array('@doc_url' => "http://www.drupalgap.org"));

  $information_fieldset = array(
    '#title' => t('More Information'),
    '#value' => "<p>$doc_msg</p>",
  );

  $output .= theme_fieldset($information_fieldset);

  return $output;
}
