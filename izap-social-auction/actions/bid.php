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
$page_owner=func_get_page_owner_byizap();

if (!$CONFIG->post_byizap->form_validated) {
  register_error(elggb_echo("error_empty_input_fields"));
  forward($_SERVER['HTTP_REFERER']);
}

$entity = get_entity($CONFIG->post_byizap->attributes['guid']);
if (!$entity || get_subtype_from_id($entity->subtype)!=="IzapSocialAuction" || $entity->isItemOpen()===false) {
  register_error(elggb_echo('cannotload'));
  forward($_SERVER['HTTP_REFERER']);
}

if($CONFIG->post_byizap->attributes['bid'] < $entity->getMinimumBid()) {
  register_error(elgg_echo('IzapOfferArticle:wrong_bid'));
  forward($_SERVER['HTTP_REFERER']);
}

// update the metadata for the entity, get the bidder email and bid amount
$bids_array = unserialize($entity->bids);
$bids_array [$page_owner->guid] [] = array(
  'amount' => $CONFIG->post_byizap->attributes['bid'],
  'timestamp' => CURRENT_TIMESTAMP,
);
func_izap_update_metadata(array('entity' => $entity, 'metadata' => array('bids' => serialize($bids_array))));

// update bidders array for current auction
$bidders_array = $entity->bidders;
if($bidders_array && !is_array($bidders_array)) {
  $bidders_array = array($bidders_array);
}
$bidders_array [] = $page_owner->guid;
$bidders_array = array_unique($bidders_array);
func_izap_update_metadata(array('entity' => $entity, 'metadata' => array('bidders' => $bidders_array)));
//func_printarray_byizap($bidders_array);

// assign outbidder guid to auction
if($entity->winner_guid) {
  func_izap_update_metadata(array('entity' => $entity, 'metadata' => array('outbidder_guid' => $entity->winner_guid)));
}

// assign highest bidder guid to auction
func_izap_update_metadata(array('entity' => $entity, 'metadata' => array('winner_guid' => $page_owner->guid)));

//func_printarray_byizap($CONFIG->post_byizap);

// get all the mails
$mail_send_to[] = $entity->getOwnerEntity()->email;
$mail_send_to = array_unique($mail_send_to);

$params=array();
$params['to']=implode(',', $mail_send_to);
$params['from']=$CONFIG->post_byizap->attributes['offer_email'];
$params['from_username']=$page_owner->guid;
$params['subject']="Bid placed on your item \"{$entity->title}\"";

$params['msg'] = '<p>A new bid has been placed on your item. Please click <a href="'.$entity->getURL().'">here</a> to go through the options available.';

//func_printarray_byizap($params);
$success=func_send_mail_byizap($params);
// send email

// Success message
if($success) {
  system_message(elgg_echo("izap_offer_article:success_make_an_offer"));
} else {
  register_error(elggb_echo('mail_not_sent'));
}

forward($entity->getURL());