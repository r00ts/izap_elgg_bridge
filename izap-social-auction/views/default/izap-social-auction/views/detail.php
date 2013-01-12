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
if($vars['entity']->guid) :
  echo elgg_view_title($vars['entity']->title);
  ?>
<div class="contentWrapper entity-detail-byizap">
  <div class="view-entity-detail-byizap">
    <div class="entity-desc-byizap">
      <img src="<?php echo func_get_img_link_byizap($vars['entity'], array('width'=>225, 'height'=>225)); ?>" alt="<?php echo $vars['entity']->title; ?>" />

      <div id="groups_info_column_left"><!-- start of groups_info_column_left -->

        <!-- post status messages -->
        <?php if($vars['entity']->winner_guid==$vars['page_owner'] && $vars['entity']->isItemOpen()) :
          ?>
        <div class="flash-success">You have highest bid on this post.</div>
        <?php endif;
        ?>

        <?php if($vars['entity']->winner_guid==$vars['page_owner'] && $vars['entity']->isItemOpen()==false) :
          ?>
        <div class="flash-success">You have won this item.</div>
        <?php endif;
        ?>
        
        <?php if($vars['entity']->winner_guid!==$vars['page_owner'] && $vars['entity']->outbidder_guid==$vars['page_owner']) :
          ?>
        <div class="flash-notice">Your highest bid was outbid, place a new bid to become highest bidder again.</div>
        <?php endif;
        ?>
        <!-- end post status messages -->

        <p class="odd"><b><?php echo elgg_echo('izap_offer_article:description') ;?> </b><p><?php echo $vars['entity']->description; ?></p></p>
        <p class="even"><b><?php echo elgg_echo('izap_offer_article:tags') ;?> </b><?php echo elgg_view('output/tags',array('tags' => $vars['entity']->tags));?></p>
        <p class="odd"><b><?php echo elgg_echo('izap_offer_article:curr_bid') ;?> </b><?php echo $vars['entity']->displayHighestBid() ;?></p>
        <p class="even"><b><?php echo elgg_echo('izap_offer_article:start_bid'); ?> </b><?php echo $vars['entity']->displayStartBid() ;?></p>
        <p class="odd"><b><?php echo elgg_echo('izap_offer_article:location') ;?> </b><?php echo $vars['entity']->getItemLocation() ;?></p>
        <p class="even"><b><?php echo elgg_echo('izap_offer_article:status') ;?> </b><?php echo $vars['entity']->getItemStatus() ;?></p>
        <p class="odd"><b><?php echo elgg_echo('izap_offer_article:timeleft') ;?> </b><?php echo $vars['entity']->getRemainingTime() ;?></p>
      </div><!-- end of groups_info_column_left -->
      
    </div>
    <div class="clearfloat"></div>

    <p>
        <?php echo elgg_echo('tags') . ':&nbsp;' .elgg_view('output/tags',array('tags' => $vars['entity']->tags)) ;?>
    </p>
    <!-- edit / delete links -->
      <?php if($vars['entity']->canEdit()):
        ?>
    <span>
      <a href="<?php echo func_get_www_path_byizap(array('type'=>"page"));?>save/<?php echo $vars['entity']->guid ;?>">Edit</a>&nbsp;/&nbsp;
          <?php
          echo elgg_view("output/confirmlink", array(
          'href' => func_get_actions_path_byizap()."delete?guid=" . $vars['entity']->guid . "",
          'text' => elgg_echo('delete'),
          'confirm' => elgg_echo('deleteconfirm'),
          ));
          ?>
    </span>
      <?php endif;
      ?>
    <!-- edit delete links -->


    <div class="contentWrapper entity-desc-footer-box-byizap">
      <div style="width:20%;float:left;">
          <?php echo '<b>'. elgg_echo('izap_offer_article:do_rate') . '</b>' . '<br />' . elgg_view('input/rate', array('entity'=> $vars['entity']));?>
      </div>

      <div style="width:25%;float:left;">
        <b><?php echo elgg_echo('izap_offer_article:expires_on') ;?></b><br />
          <?php echo date('d F Y',$vars['entity']->expire_date) ;?>
      </div>

      <?php if($vars['entity']->isItemOpen()) :
        ?>
      <form action="<?php echo func_get_actions_path_byizap();?>bid" method="post" enctype="multipart/form-data">
        <?php
        echo elgg_view('input/securitytoken');
        echo elgg_view('input/hidden', array('internalname' => 'attributes[_guid]', 'value' => $vars['entity']->guid));
        ?>
        <div style="width: 25%; float: left;">
          <b><label for="bid_amount">Your bid:</label> </b> <br />
          <?php echo elgg_view('input/text', array('class'=>"input-short", 'internalname'=>"attributes[_bid]", 'internalid'=>"bid_amount", 'value'=>$vars['entity']->getMinimumBid())) ;?>
          &nbsp;
          <?php echo elgg_view('input/submit', array('value'=>"Submit")); ;?>
        </div>
      </form>
      <?php endif;
      ?>

      <div class="clearfloat"></div>
    </div>

  </div>

  <div class="clearfloat"></div>
  <script type="text/javascript">
    $(document).ready(function(){      
      var anchor=$(location).attr('hash');
      var anchor2=$(location).attr('hash').substring(1);      
      if(anchor.search('comment_')==1) {
        $.tabsByIzap('elgg_horizontal_tabbed_nav', 'tabs-1');
      }
    });
  </script>
  <!-- tabs -->
    <?php
    $tabs_array[] = array(
            'title'=>elggb_echo('comments'),
            'content'=>elgg_view_comments($vars['entity']),
    );

    $tabs_array[] = array(
            'title'=>elggb_echo('send_to_friend'),
            'content'=>elgg_view(func_get_template_path_byizap(array('type'=>"forms")).'send_to_friend',array('entity'=>$vars['entity'],'user'=>$vars['user'])),
    );

    $tabs_array[] = array(
            'title'=>elggb_echo('terms'),
            'content'=>'
          <div class="contentWrapper"><div class="izap-offer-article-terms">
            '.$vars['entity']->terms.'
            </div>
          </div>',
    );

    if($vars['entity']->canEdit()) {
      $tabs_array[] = array(
              'title' => elgg_echo('ideas:bids'),
              'content' => func_izap_bridge_view('pages/bids', array('entity' => $vars['entity'])),
      );
    }
    ?>
    <?php echo izap_elgg_bridge_view('tabs',array(
    'tabsArray'=>$tabs_array,
    'selected'=>($vars['selected_tab']?$vars['selected_tab']:"0"),
    ));
    ;?>
  <!-- end tabs -->  

  <?php endif;
  ?>
</div>