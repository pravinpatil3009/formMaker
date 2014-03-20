<?php

/**
 * @file
 * This file implements the DrupalGap service resource call back functions.
 */

/**
 * Determines whether the current user can access a drupalgap resource.
 *
 * @param string $op
 *   String indicating which operation to check access for.
 * @param array $args
 *   Array arguments passed through from the original request.
 *
 * @return boolean
 *   Boolean indicating whether or not the user has access to the resource.
 *
 * @see node_access()
 */
function _drupalgap_resource_access($op = 'view', $args = array()) {
  return user_access($op);
}

/**
 * Returns a collection of content types from the {node_type} table.
 *
 * It also bundles other available information about each content type
 * with the return results.
 *
 * @param array $options
 *   An array of options.
 *
 * @return object
 *   MySQL object results from the {node_type} table
 */
function _drupalgap_resource_content_types_list($options = array()) {
  // Grab content types.
  $sql = " SELECT * FROM {node_type} ORDER BY name ASC ";
  $result = db_query($sql);
  if ($result) {
    $content_types = array();
    while ($data = db_fetch_object($result)) {
      $content_types[] = $data;
    }
    foreach ($content_types as $i => $content_type) {
      // Grab comment settings for content type.
      $names = array(
        'comment_anonymous_' . $content_type->type,
        'comment_' . $content_type->type,
        'comment_default_mode_' . $content_type->type,
        'comment_default_per_page_' . $content_type->type,
        'comment_form_location_' . $content_type->type,
        'comment_preview_' . $content_type->type,
        'comment_subject_field_' . $content_type->type,
      );
      $sql = " SELECT * FROM {variable} ";
      $sql .= " WHERE name IN (" . db_placeholders($names, 'text') . ")";

      // Retrieve the comment settings variables.
      $variable_results = db_query($sql, $names);

      if ($variable_results) {
        // Extract comment settings variables and attach to content type result.
        while ($variable = db_fetch_object($variable_results)) {
          // Strip the '_type' from the end.
          $end = drupal_strlen($variable->name);
          $end -= (drupal_strlen($content_type->type) + 1);
          $variable_name = drupal_substr($variable->name, 0, $end);
          $content_types[$i]->$variable_name = unserialize($variable->value);
        }
      }
    }
    return $content_types;
  }
}

/**
 * Returns a collection of permissions from content types for the current user.
 *
 * @return array
 *   Array of content types with permissions for each.
 */
function _drupalgap_resource_content_types_user_permissions() {
  $content_types = _drupalgap_resource_content_types_list();
  $content_type_permissions = array();
  foreach ($content_types as $content_type) {
    $content_type_permissions[$content_type->type] = array(
      'create' => user_access("create $content_type->type content"),
      'delete any' => user_access("delete any $content_type->type content"),
      'delete own' => user_access("delete own $content_type->type content"),
      'edit any' => user_access("edit any $content_type->type content"),
      'edit own' => user_access("edit own $content_type->type content"),
    );
  }
  return $content_type_permissions;
}

/**
 * Checks to see if the user has access to a permission.
 *
 * @return boolean
 *   Bool indicating whether or not the user has access to the permission.
 *
 * @see user_access()
 */
function _drupalgap_resource_user_access($data) {
  if (!isset($data['permission'])) {
    return services_error(t('Missing argument permission.'), 406);
  }
  return user_access($data['permission']);
}

/**
 * Performs a user login service resource call and bundles up the drupalgap 
 * system connect resource results as well.
 *
 * @param $username
 *   String The Drupal user name.
 * @param $password
 *   String The Drupal user password.
 *
 * @return array
 *   Array with the user login result and drupalgap system connect result.
 */
function _drupalgap_resource_user_login($username, $password) {
  $results = array();
  
  // Make a call to the user login resource.
  module_load_include('inc', 'services', 'resources/user_resource');
  $results['_user_resource_login'] = _user_resource_login($username, $password);
  
  // If the user login was successful, make a call to the drupalgap system
  // connect resource.
  if ($results['_user_resource_login']) {
    $results['drupalgap_system_connect'] = _drupalgap_resource_system_connect();
  }
  
  return $results;
}

/**
 * Performs a user logout service resource call and bundles up the drupalgap 
 * system connect resource results as well.
 *
 * @return array
 *   Array with the user logout result and drupalgap system connect result.
 */
function _drupalgap_resource_user_logout() {
  $results = array();
  
  // Make a call to the user login resource.
  module_load_include('inc', 'services', 'resources/user_resource');
  $results['_user_resource_logout'] = _user_resource_logout();
  
  // If the user logout was successful, make a call to the drupalgap system
  // connect resource.
  if ($results['_user_resource_logout']) {
    $results['drupalgap_system_connect'] = _drupalgap_resource_system_connect();
  }
  
  return $results;
}

/**
 * Performs a user registration service resource call and bundles up the 
 * drupalgap system connect resource results as well.
 *
 * @param $name
 *   String The Drupal user name.
 * @param $mail
 *   String The Drupal user e-mail address.
 * @param $pass
 *   String The Drupal user password.
 *
 * @return array
 *   Array with the user registration result and drupalgap system connect result.
 */
function _drupalgap_resource_user_register ($name, $mail, $pass) {
  $results = array();
  
  // Make a call to the user login resource.
  module_load_include('inc', 'services', 'resources/user_resource');
  $data = array(
    'name' => $name,
    'mail' => $mail,
    'pass' => $pass,
  );
  $results['_user_resource_create'] = _user_resource_create($data);
  
  // If the user registeration was successful, make a call to the drupalgap system
  // connect resource.
  if ($results['_user_resource_create']) {
    $results['drupalgap_system_connect'] = _drupalgap_resource_system_connect();
  }
  
  return $results;
}

/**
 * Returns a user's roles and permissions.
 *
 * @return array
 *   Array of user roles and their corresponding permissions.
 */
function _drupalgap_resource_user_roles_and_permissions($data) {
  // TODO: This should probably just pull from global $user->uid.
  $uid = $data['uid'];
  if (!isset($uid) || !is_numeric($uid)) {
    services_error(t('Missing argument uid.'), 406);
  }
  // Prepare empty resuls array.
  $results = array();
  // Load user account.
  $account = user_load($data['uid']);
  // Depending if user is authenticated or not, retrieve permissions based on
  // the user's role(s).
  if ($uid == 0) {
    // Grab permissions for 'anonymous user' role.
    $sql = " SELECT rid, perm FROM {permission} ";
    $sql .= " WHERE rid = 1 ";
    $sql .= " GROUP BY rid ";
    $perms = db_query($sql);
    while ($data = db_fetch_object($perms)) {
      drupalgap_convert_d6_perms_to_d7(&$results, $data, $account);
    }
  }
  else {
    // Grab role(s) for authenticated user.
    $roles = array();
    $sql = " SELECT ur.rid FROM {users_roles} ur WHERE ur.uid = %d ";
    $result = db_query($sql, $uid);
    while ($role = db_fetch_object($result)) {
      $roles[] = $role;
    }
    // We must manually append the 'authenticated user' role id (2) to the roles
    // array. The user roles table does not hold this data.
    $roles[] = 2;
    // Retrieve permissions for the user's role(s).
    $sql = " SELECT rid, perm FROM {permission} ";
    $sql .= " WHERE rid IN (" . db_placeholders($roles, 'int') . ") ";
    $sql .= " GROUP BY rid ";
    $perms = db_query($sql, $roles);
    if ($perms) {
      while ($data = db_fetch_object($perms)) {
        drupalgap_convert_d6_perms_to_d7(&$results, $data, $account);
      }
    }  
  }
  return $results;
}

/**
 * Returns a collection of variables from the current Drupal site.
 *
 * @return array
 *   Array of variables from the variable table.
 */
function _drupalgap_resource_system_site_settings() {
  // Grab column names from the variable table.
  $names = array(
    'admin_theme',
    'clean_url',
    'date_default_timezone',
    'site_name',
    'theme_default',
    'user_register',
  );
  $sql = " SELECT * FROM {variable} ";
  $sql .= " WHERE name IN (" . db_placeholders($names, 'text') . ")";

  $settings = new stdClass();
  $result = db_query($sql, $names);
  if ($result) {
    $settings->variable = new stdClass();
    while ($variable = db_fetch_object($result)) {
      $name = $variable->name;
      $value = unserialize($variable->value);
      $settings->variable->$name = $value;
    }
  }

  // Add Drupal core verion into settings.
  $settings->variable->drupal_core = "6";

  return $settings;
}

/**
 * Performs service calls to various resources and bundles them all up so the 
 * mobile device gets results, settings and permissions in one request.
 *
 * @param $created
 *   Integer The time at which the last system connect call took place. This is
 *   used to determine what, if any, content/comments/etc have been updated
 *   since the last call took place from the mobile app.
 *
 * @return array
 *   Array of service resources, settings and permissions.
 */
function _drupalgap_resource_system_connect($created = null) {
  global $user;
  $results = array();
  
  // Make a call to the system connect resource.
  module_load_include('inc', 'services', 'resources/system_resource');
  $results['system_connect'] = _system_resource_connect();
  
  // Make a call to the DrupalGap site settings resource.
  $results['site_settings'] = _drupalgap_resource_system_site_settings();
  
  // Make a call to the DrupalGap user roles and permissions resource.
  $results['user_roles_and_permissions'] = _drupalgap_resource_user_roles_and_permissions(array('uid' => $user->uid));
  
  
  $results['content_types_list'] = _drupalgap_resource_content_types_list();
  
  $results['content_types_user_permissions'] = _drupalgap_resource_content_types_user_permissions();
  
  // Add the time at which this call occurred to the result.
  $results['created'] = "" . time();
  
  // Add the last time at which this call occurred, if ever, to the result.
  if ($created != null) {
    //$results['last_created'] = date("Y-m-d h:i:s", $created);
    $results['last_created'] = $created;
  }
  
  return $results;
}

/**
 * Converts a D6 {permission} result row to match that of D7's permission
 * structure, this is so the mobile app only needs to understand one data set.
 * It appends the result to the incoming results array.
 *
 * @param $results
 *   Array to append the result to.
 * @param $data
 *   Object result from the mysql row fetch.
 * @param $account
 *   Object for the user account.
 */
function drupalgap_convert_d6_perms_to_d7 (&$results, $data, $account) {
  // Structure the roles and permissions result to match that of D7,
  // so the mobile app only needs to understand one set of data.
  $permissions = explode(", ", $data->perm);
  foreach ($permissions as $permission) {
    $result = new stdClass();
    $result->uid = $account->uid;
    $result->rid = $data->rid;
    $result->name = $account->roles[$data->rid];
    $result->permission = $permission;
    $results[] = $result;
  }
}
