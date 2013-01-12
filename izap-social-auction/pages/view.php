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
//gatekeeper();

$qryArr=get_input('qry');
$page_owner=func_get_page_owner_byizap();

if($guid=$qryArr[0]) {
  //$entity=new IzapOfferArticle($guid);
  $entity=get_entity($guid);
  //func_printarray_byizap($entity);  
  if(get_subtype_from_id($entity->subtype)=="IzapSocialAuction") {
    func_increment_views_byizap($entity);
  } else {
    $entity=NULL;
  }
}

if(!$entity || $entity->status===0) {
  register_error(elggb_echo('cannotload'));
  forward($_SERVER['HTTP_REFERER']);
}

$area1=elgg_view(func_get_template_path_byizap(array('type'=>'pages'))."detail",array('entity'=>$entity,'selected_tab'=>null,'user'=>get_loggedin_user()) );

//$body = elgg_view_layout("layout_scholarships_byizap", $area1 , $area2, $area3);
$body = elgg_view_layout("two_column_left_sidebar", '', $area1 . $area2, $area3);

// Display page
page_draw(elgg_echo('izap_offer_article:detail'),$body);
