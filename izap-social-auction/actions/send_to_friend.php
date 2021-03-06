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

if (!$CONFIG->post_byizap->form_validated) {
  register_error(elggb_echo("error_empty_input_fields"));
  forward($_SERVER['HTTP_REFERER']);
}

$entity = get_entity($CONFIG->post_byizap->attributes['guid']);
if (!$entity) {
  register_error(elggb_echo('cannotload'));
  forward($_SERVER['HTTP_REFERER']);
}

//func_printarray_byizap($entity);exit;

$params=array();
$params['to']=$CONFIG->post_byizap->attributes['send_email'];
$params['from']=$CONFIG->post_byizap->attributes['email'];
$params['from_username']=$CONFIG->post_byizap->attributes['name'];
$params['subject']="Offer: {$entity->title}";
$params['msg']="
  Hello, {$CONFIG->post_byizap->attributes['send_name']} \n
  I like this post, {$entity->getURL()} & please go through that once.\n
  <p>{$CONFIG->post_byizap->attributes['msg']}</p>\n

  From:\n
    {$CONFIG->post_byizap->attributes['name']},
    {$CONFIG->post_byizap->attributes['email']}.
  ";
//func_printarray_byizap($params);
$success=func_send_mail_byizap($params);
// send email

// Success message
if($success) {
  system_message(elgg_echo("izap_offer_article:success_send_to_friend"));
} else {
  register_error(elggb_echo('mail_not_sent'));
}

forward($_SERVER['HTTP_REFERER']);