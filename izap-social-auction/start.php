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

if(is_plugin_enabled('izap-social-auction')) {
  @include_once(dirname(__FILE__)."/lib/classes/IzapSocialAuction.php");
  @include_once(dirname(__FILE__)."/lib/functions/functions_url.php");
}

function func_init_izap_offer_article() { 
  // Load system configuration
  global $CONFIG;
  
  izap_plugin_init(array('plugin'=>array('name'=>'izap-social-auction')));
}


// Make sure the blog initialisation function is called on initialisation
register_elgg_event_handler('init','system','func_init_izap_offer_article');
//func_printarray_byizap($CONFIG);
