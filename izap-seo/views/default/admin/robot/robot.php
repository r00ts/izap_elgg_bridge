<?php

/* * ************************************************
 * PluginLotto.com                                 *
 * Copyrights (c) 2005-2010. iZAP                  *
 * All rights reserved                             *
 * **************************************************
 * @author iZAP Team "<support@izap.in>"
 * @link http://www.izap.in/
 * Under this agreement, No one has rights to sell this script further.
 * For more information. Contact "Tarun Jangra<tarun@izap.in>"
 * For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
 * Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */

/**
 * setting for facebook like and comments
 */
echo '<br/>';
$file_path = elgg_get_root_path() . 'robots.txt';

if (!is_writable($file_path)) {
  echo '<h2>file robots.txt do not have the write permissions or not found at '.  elgg_get_site_url().'robots.txt</h2>';
}

if (is_writable($file_path)) {
  $body = '<div class ="form_layout">';

  $body .= IzapBase::input('plaintext', array(
        'input_title' => elgg_echo('izap-forum:add_topic:description'),
        'name' => 'description',
        'value' => file_get_contents($file_path)
      ));

  $body .= IzapBase::input('submit');

  echo elgg_view('input/form', array(
    'body' => $body,
    'action' => IzapBase::getFormAction('robot_file', GLOBAL_IZAP_SEO_PLUGIN),
    'enctype' => 'multipart/form-data'
  ));
}
?>
