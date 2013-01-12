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
ini_set('display_errors',true);

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
//admin_gatekeeper();
gatekeeper();

$entity=get_entity(get_input('guid'));

if (!$entity->canEdit()&&$entity->subtype!=="IzapSocialAuction") {
  register_error(elggb_echo('error_edit_permission'));
  forward($_SERVER['HTTP_REFERER']);
}

if($entity->status!==0) {
  register_error(elggb_echo('cannotload'));
  forward($_SERVER['HTTP_REFERER']);
}

if(isadminloggedin()) {
  // by-pass payment process if admin is logged in.
  $entity->approveAuction();
} else {
  // process payment.
  @include_once(func_get_path_byizap(array('for'=>"dir/class")) . 'clsGateway.php');
  $fee_array = $entity->get_auction_fee_array();
  $items = array();
  foreach($fee_array as $array) {
    $i++;
    $items [$i] = array('name' => $array['name'] ? $array['name'] : $array['type'], 'amount' => $array['amount'], 'guid' => $i);
  }
  $options = array(
    'loginId'=>IzapSocialAuction::get_paypal_acc_id(),
    'items'=>$items,
    'grandTotal'=>$entity->auction_fee,
    //'return'=>func_get_path_byizap(array('for'=>"www/page")) . 'pay_auction_fee_confirm',
    'return'=>$entity->getURL(),
    'notifyUrl'=>func_get_path_byizap(array('for'=>"www/page")) . 'pay_auction_fee_paypal_notify',
    'custom'=>$entity->guid,
  );
  $gateway = new gateway('paypal', null, $entity->get_test_mode());
  $gateway->paypal($options);
}

if(true) {
  system_message(elgg_echo("izap_offer_article:success_payauctionfee"));
} else {
  register_error(elggb_echo('error_edit_permission'));
}

forward(func_get_www_path_byizap(array('type'=>"page",'plugin'=>"izap-social-auction")).'listPending');