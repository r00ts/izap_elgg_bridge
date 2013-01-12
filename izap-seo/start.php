<?php

/* * ************************************************
 * PluginLotto.com                                 *
 * Copyrights (c) 2005-2011. iZAP                  *
 * All rights reserved                             *
 * *************************************************
 * @author iZAP Team "<support@izap.in>"
 * @link http://www.izap.in/
 * Under this agreement, No one has rights to sell this script further.
 * For more information. Contact "Tarun Jangra<tarun@izap.in>"
 * For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
 * Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */

/**
 * Define some globals
 */
global $CONFIG;

define('GLOBAL_IZAP_SEO_PLUGIN', 'izap-seo');


// Hook the pluugin with the system
elgg_register_event_handler('init', 'system', 'izap_seo_init');

/**
 * main init function, that will be hooked
 */
function izap_seo_init() {
  //start plugin
  izap_plugin_init(GLOBAL_IZAP_SEO_PLUGIN);

  elgg_register_widget_type('izap-seo', elgg_echo('MY seo widget'),
      elgg_echo('this is test on elgg widget'), 'profile');

  //make available entity to the head section
  $entities = get_registered_entity_types();
  foreach ($entities as $type => $subtypes) {
    if (sizeof($subtypes)) {
      foreach ($subtypes as $subtype) {
        elgg_extend_view($type . '/' . $subtype, 'izap-seo/set_page_entity');
      }
    }
  }

  elgg_register_event_handler('create', 'object', 'izap_seo_event');
  elgg_register_event_handler('update', 'object', 'izap_seo_event');

  // SEO plugin is only suppose to work for admin users.
  if (elgg_is_admin_logged_in ()) {
    elgg_extend_view('input/categories', 'forms/izap-seo/fields');
  }

  $override_error_page = elgg_get_plugin_setting('index_override_404', GLOBAL_IZAP_SEO_PLUGIN);

  if ($override_error_page == 'true') {
    elgg_register_plugin_hook_handler('forward', '404', 'izap_not_found', 1);
  }
  
  elgg_extend_view('page/elements/head', 'izap-seo/metatags');

  // set pages for the admin
  elgg_register_admin_menu_item('izap:seo', 'robot', 'robot'); // @todo: merge to izap menu
}

/*
 * function to save metatitle ,metadescription, metakeywords
 */

function izap_seo_event($event, $object_type, $object) {
  $meta_title = get_input('izap_title');
  $meta_description = get_input('izap_meta_description');
  $meta_keywords = get_input('izap_meta_keywords');
  $meta_robot_tags = get_input('meta_robot_tags');

  $object->izap_title = $meta_title;
  $object->izap_meta_description = $meta_description;
  $object->izap_meta_keywords = $meta_keywords;
  $object->meta_robot_tags = $meta_robot_tags;
  return True;
}

// function to set current entity
function izap_set_current_entity($entity) {
  global $CONFIG;
  $CONFIG->current_entity = $entity;
}

// function to get current entity
function izap_get_current_entity() {
  global $CONFIG;
  return $CONFIG->current_entity;
}

// function to unset current entity
function izap_unset_current_entity() {
  global $CONFIG;
  unset($CONFIG->current_entity);
}

// overriting 404 error page
function izap_not_found($hook, $type, $returnvalue, $params) {
  $url = parse_url($params['current_url']);
  $exploaded_url = explode('/', $url['path']);
  $impload_url = elgg_get_friendly_title((trim(implode(' ', $exploaded_url))));
  $search_url = $url['scheme'] . '://' . $url['host'] . "/search?q=$impload_url";
  forward($search_url);
}
