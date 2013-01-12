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

// Get the current page's owner
$page_owner=func_get_page_owner_byizap();

$qryArr=get_input('qry');

if($guid=$qryArr[0]) {
  $post=new stdClass;
  $post->attributes['guid']=$guid;
  $entity=new IzapSocialAuction($guid, array('post'=>$post));
  //func_printarray_byizap($entity);

  if(get_subtype_from_id($entity->subtype)!=="IzapSocialAuction") {
    register_error(elggb_echo('cannotload'));
    forward($_SERVER['HTTP_REFERER']);
  }
}

if(isset($_SESSION['postArray'])&&is_array($_SESSION['postArray'])) {
  $postArray=$_SESSION['postArray'];
  unset($_SESSION['postArray']);
} elseif($entity->guid) {
  $postArray=$entity->get_attributes();
}

//set the title
$area1 = elgg_view_title(elgg_echo('izap_offer_article:new_entity'));

// Get the form
$area1.=elgg_view(func_get_template_path_byizap(array('type'=>'forms'))."add_edit_entity", array('c_guid'=>$page_owner->guid,'postArray'=>$postArray,'entity'=>$entity,'fee_array'=>IzapSocialAuction::$fee_array));

// Display page
page_draw(elgg_echo('izap_offer_article:new_entity'),elgg_view_layout("two_column_left_sidebar", '',$area1));
