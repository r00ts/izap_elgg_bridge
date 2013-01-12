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

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");

// process ipn notification.
@include_once(func_get_path_byizap(array('for'=>"dir/class")) . 'clsGateway.php');
$gateway = new gateway('paypal', '', $entity->get_test_mode());
$returnArray = $gateway->gopaypal();

if($returnArray['status']) {  
  $guid = $returnArray['ipn_data']['custom'];
  $entity = get_entity($guid);

  $update = array(
    'invoice_id' => $returnArray['invoiceid'],
  );
  func_izap_update_metadata(array('entity'=>$entity, 'metadata'=>$update));
  $entity->approveAuction();

  $msg = "Your payment for auction named <a href='{$entity->getURL()}'>{$entity->title}</a> was successful.";
  notify_user(
    $entity->owner_guid,
    $CONFIG->site->guid,
    elgg_echo('izap_offer_article:paymenysuccess'),
    $msg
  );
}else {
  $guid = $returnArray['ipn_data']['custom'];
  $entity = get_entity($guid);

  $update = array(
    'payment_method'=> "paypal",
    'paypal_return_arr'=> serialize($returnArray),
    'time_payment_done'=>CURRENT_TIMESTAMP,
  );
  func_izap_update_metadata(array('entity'=>$entity, 'metadata'=>$update));

  $msg = "Your payment for auction named <a href='{$entity->getURL()}'>{$entity->title}</a> was failed, please compelte the payment to continue listing your item.";
  notify_user(
    $order->owner_guid,
    $CONFIG->site->guid,
    elgg_echo('izap_offer_article:paymenysuccess'),
    $msg
  );
}