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

if($vars['full']) {
  echo elgg_view(func_get_template_path_byizap(array('type'=>"pages")) . 'detail', $vars);
}else {
  if(elgg_view_exists('output/entity_row')) {

    if($vars['entity']->status===1) {
      $extra = '<div class="entity-expire-date-byizap"><b>'
              .elgg_echo('izap_offer_article:timeleft').
              '</b><br />'.$vars['entity']->getRemainingTime().'</div>';
    }

    if($vars['entity']->canEdit()) {

      if($vars['entity']->status===0) {
        $extra .= elgg_view("output/confirmlink", array(
                'href' => func_get_actions_path_byizap()."payfee?guid=" . $vars['entity']->guid . "",
                'text' => elgg_echo('izap_offer_article:payauctionfee'),
                'confirm' => elgg_echo('izap_offer_article:payauctionfee_confirm'),
        )) . ' / ';
      }

      if($vars['entity']->isItemOpen()) {
        $extra .= elgg_view("output/confirmlink", array(
                'href' => func_get_actions_path_byizap()."close?guid=" . $vars['entity']->guid . "",
                'text' => elgg_echo('izap_offer_article:endauction'),
                'confirm' => elgg_echo('izap_offer_article:endauction_confirm'),
        )) . ' / ';
      }

      $extra .= '<a href="'.func_get_www_path_byizap(array('type'=>"page")).'save/'.$vars['entity']->guid.'">Edit</a> / ';

      $extra .= elgg_view("output/confirmlink", array(
              'href' => func_get_actions_path_byizap()."delete?guid=" . $vars['entity']->guid . "",
              'text' => elgg_echo('delete'),
              'confirm' => elgg_echo('deleteconfirm'),
      ));
    }

    echo elgg_view('output/entity_row', array('entity' => $vars['entity'], 'extra' => $extra));
  }else {
    echo elgg_view(func_get_template_path_byizap(array('type'=>"pages",'plugin'=>"izap-social-auction")) . 'entity', $vars);
  }
}
