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
?>
<div class="row-entity-byizap contentWrapper">
  <div class="entity-info-byizap">
    <div class="entity-img-byizap">
      <a href="<?php echo $vars['entity']->getURL(); ;?>"><img src="<?php echo func_get_img_link_byizap($vars['entity'], array('width'=>100, 'height'=>100)); ?>" alt="<?php echo $vars['entity']->title; ?>" border="0" /></a>
    </div>
    <div class="entity-title-byizap">
      <a href="<?php echo $vars['entity']->getURL(); ;?>">
        <?php echo $vars['entity']->title ;?>
      </a>      
    </div>
          <?php if(strlen($vars['entity']->description)<225) : ?>
    <div class="entity-description-short-byizap"><?php echo $vars['entity']->description; ?></div>
          <?php else: ?>
    <div class="entity-description-short-byizap" id="short_desc_<?php echo $vars['entity']->guid;?>"><?php echo substr($vars['entity']->description,0,225)."&nbsp;..." ;?></div>
          <?php endif; ?>
  </div>
  <div class="entity-col2-byizap">
    <div class="entity-expire-date-byizap"><b><?php echo elgg_echo('izap_offer_article:expires_on') ;?></b><br /><?php echo date('d F Y',$vars['entity']->expire_date) ;?></div>
    <div class="entity-rate-byizap"><?php echo elgg_view('output/rate', array('entity'=> $vars['entity']));?></div>
    <div class="entity-edit-tools-byizap">
      <?php if($vars['entity']->canEdit()):
        ?>      
      <a href="<?php echo func_get_www_path_byizap(array('type'=>"page"));?>save/<?php echo $vars['entity']->guid ;?>">Edit</a>&nbsp;/&nbsp;
        <?php
        echo elgg_view("output/confirmlink", array(
        'href' => func_get_actions_path_byizap()."delete?guid=" . $vars['entity']->guid . "",
        'text' => elgg_echo('delete'),
        'confirm' => elgg_echo('deleteconfirm'),
        ));
       endif;
      ?>
    </div>
  </div>
  <div class="clearfloat"></div>
  <p>
    <?php echo elgg_echo('tags') . ':&nbsp;' .elgg_view('output/tags',array('tags' => $vars['entity']->tags)) ;?>
  </p>
</div>