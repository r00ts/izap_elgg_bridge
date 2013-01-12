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
global $CONFIG;
gatekeeper();

$entity=get_entity(get_input('guid'));

if(!$entity || !$entity->canEdit() || get_subtype_from_id($entity->subtype)!=="IzapSocialAuction") {
  register_error(elggb_echo('error_edit_permission'));
  forward($_SERVER['HTTP_REFERER']);
}

if($entity->delete()) {
  system_message(elggb_echo("deleted"));
} else {
  register_error(elggb_echo('error_edit_permission'));
}

forward(func_get_www_path_byizap(array('type'=>"page",'plugin'=>"izap-social-auction")).'index');