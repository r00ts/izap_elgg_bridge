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

// Load Elgg engine
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");

global $CONFIG;
//func_printarray_byizap($CONFIG->actions);
//func_printarray_byizap($CONFIG->views);

gatekeeper();
$page_owner=func_get_page_owner_byizap();

$search_active=false;

$defaults = array(
        'offset' => get_input('offset',"0"),
        'limit' => get_input('limit','10'),
        'full_view' => false,
        'view_type_toggle' => false,
        'pagination' => true,
);


$options=array_merge(
  $defaults,
  array('type' => 'object', 'subtype' => 'IzapSocialAuction', 'container_guid' => NULL, 'metadata_name_value_pairs'=>
    array(
      array('name'=>'expire_date','value'=>CURRENT_TIMESTAMP,'operand'=>'>=','case_sensitive'=>true),
      array('name'=>"bidders", 'value'=>$page_owner->guid),
      array('name'=>"status", 'value'=>1),
    )
  )
);
if($count=elgg_get_entities_from_metadata(array_merge($options,array('count'=>true))) ) {
  $entities=elgg_get_entities_from_metadata($options);
}

$area1=elgg_view_title(elgg_echo('izap_offer_article:list_entites'));
if(get_input('view')=="rss") {
  $area1 .= elgg_view_entity_list($entities, $count, $defaults['offset'],
          $defaults['limit'], $defaults['full_view'], $defaults['view_type_toggle'], $defaults['pagination']);
} else {
  $area1.=elgg_view(func_get_template_path_byizap(array('type'=>'pages'))."list",array('entities'=>$entities,'count' => $count,'options'=>$defaults) );
}
// end process entities

$body = elgg_view_layout("two_column_left_sidebar", '', $area1 . $area2, $area3);

// Display page
page_draw(elgg_echo('izap_offer_article:manage'),$body);
