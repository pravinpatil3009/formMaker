<?php
// $Id: template.php,v 1.1 2009/09/30 01:27:41 blagoj Exp $

/**
 * Add custom PHPTemplate variables into the node template.
 */
function monochrome_preprocess_node(&$vars) {
  // Grab the node object.
  $node = $vars['node'];
  // Make individual variables for the parts of the date.
  $vars['post_day'] = '/' . format_date($node->created, 'custom', 'j');
  $vars['post_month'] = format_date($node->created, 'custom', 'm');
  $vars['post_year'] = format_date($node->created, 'custom', 'Y');
}

/**
 * Add custom PHPTemplate variable into the page template
 */
function monochrome_preprocess_page(&$vars) {
  
  if ($vars['template_files'][0] == 'page-user' || $vars['template_files'][0] == 'page-admin' || $vars['template_files'][0] == 'page-comment' || $vars['template_files'][0] == 'page-search' ||  $vars['template_files'][2] =='page-node-edit' || $vars['template_files'][1] == 'page-node-add' )
  $vars['wrap_content'] = 1;
  
  $vars['footer_msg'] = ' &copy; ' . $vars['site_name'] . ' ' . date('Y');
 
}

/**
 * Override the search box to add our pretty graphic instead of the button.
 */
function monochrome_search_theme_form($form) {
  $form['search_theme_form']['#title'] = '';
  $form['search_theme_form']['#id'] = 'search_input';  
  $form['submit']['#type'] = 'image_button';
  $form['submit']['#id'] = 'search_button';
  $form['submit']['#src'] = drupal_get_path('theme', 'monochrome') . '/img/search_button_n.gif';
  return '<div id="search_area" class="clearfix">' . drupal_render($form) . '</div>';
}

function monochrome_preprocess_comment(&$vars) {
  $vars['classes'] = array('comment');
  if ($vars['zebra'] == 'odd') {
	$vars['classes'][] = 'alt';
  }

  $vars['classes'] = implode(' ', $vars['classes']);
}