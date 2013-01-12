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

//func_process_post();
//global $post_byizap;
//func_printarray_byizap($post_byizap);exit;

if (!$CONFIG->post_byizap->form_validated) {
  register_error(elgg_echo("izap_elgg_bridge:error_empty_input_fields"));
  forward($_SERVER['HTTP_REFERER']);
}

$entity = new IzapSocialAuction($CONFIG->post_byizap->attributes['guid'],array('post'=>&$CONFIG->post_byizap));

if (!$entity || ($entity->is_new_record()===false && !$entity->canEdit()) || ($entity->is_new_record()===false && get_subtype_from_id($entity->subtype)!=="IzapSocialAuction") ) {
  register_error(elggb_echo('error_edit_permission'));
  forward($_SERVER['HTTP_REFERER']);
}

if (!$entity->save()) {  
  register_error(elgg_echo($entity->error_code));
  forward($_SERVER['HTTP_REFERER']);
}

// Success message
system_message(elgg_echo('izap_offer_article:saved'));
// add to river
//if($new_file) {
//  add_to_river('river/object/izap_usergallery/new_album', 'create', get_loggedin_userid(), $entity->guid);
//} else {
//  add_to_river('river/object/izap_usergallery/edit_album', 'update', get_loggedin_userid(), $entity->guid);
//}
// Remove the blog post cache

forward($entity->getURL());