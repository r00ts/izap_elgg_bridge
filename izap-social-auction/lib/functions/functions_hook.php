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
function func_validate_entity_byizap($hook,$entity_type,$return,$params=array()) {
  
  return $return;
}

function func_hook_access_over_ride_byizap($params=array()){
  
  if($params['status']) {
    $func="register_plugin_hook";
  } else {
    $func="unregister_plugin_hook";
  }

  $func_name="func_access_over_ride_byizap";

  $func("premissions_check","all",$func_name);
  $func("container_premissions_check","all",$func_name);
  $func("premissions_check:metadata","all",$func_name);

}

function func_access_over_ride_byizap($hook,$entity_type,$return,$params=array()) {
  return true;
}