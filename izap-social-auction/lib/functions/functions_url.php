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
function func_geturl_izap_offer_article($entity) {
  global $CONFIG;
  $title = $entity->title_slugified ? $entity->title_slugified : friendly_title($entity->title);
  return $CONFIG->url . "pg/auctions/view/" . $entity->getGUID() . "/" . $title;
}