<?php
/**************************************************
* PluginLotto.com                                 *
* Copyrights (c) 2005-2010. iZAP                  *
* All rights reserved                             *
***************************************************
* @author iZAP Team "<support@izap.in>"
* @link http://www.izap.in/
* @version
* Under this agreement, No one has rights to sell this script further.
* For more information. Contact "Tarun Jangra<tarun@izap.in>"
* For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
* Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
*/
?>
<p class="info">
  Assign points on -
</p>
<p>
  <?php echo elgg_echo('izap_usergallery:points_signup');
  echo elgg_view('input/text', array('internalname' => 'params[points_signup]', 'value' => $vars['entity']->points_signup, ));
  ?>
</p>
<p>
  <?php echo elgg_echo('izap_usergallery:points_login');
  echo elgg_view('input/text', array('internalname' => 'params[points_login]', 'value' => $vars['entity']->points_login, ));
  ?>
</p>
<p>
  <?php echo elgg_echo('izap_usergallery:points_create_album');
  echo elgg_view('input/text', array('internalname' => 'params[points_create_album]', 'value' => $vars['entity']->points_create_album, ));
  ?>
</p>
<p>
  <?php echo elgg_echo('izap_usergallery:points_create_albumpic');
  echo elgg_view('input/text', array('internalname' => 'params[points_create_albumpic]', 'value' => $vars['entity']->points_create_albumpic, ));
  ?>
</p>
<p>
  <?php echo elgg_echo('izap_usergallery:points_delete_album');
  echo elgg_view('input/text', array('internalname' => 'params[points_delete_album]', 'value' => $vars['entity']->points_delete_album, ));
  ?>
</p>
<p>
  <?php echo elgg_echo('izap_usergallery:points_delete_albumpic');
  echo elgg_view('input/text', array('internalname' => 'params[points_delete_albumpic]', 'value' => $vars['entity']->points_delete_albumpic, ));
  ?>
</p>