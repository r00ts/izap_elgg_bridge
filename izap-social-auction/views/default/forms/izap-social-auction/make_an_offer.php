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
<div id="make-an-offer" class="contentWrapper">
  <form action="<?php echo func_get_actions_path_byizap();?>bid" method="post">
    <?php
    echo elgg_view('input/securitytoken');
    echo elgg_view('input/hidden', array('internalname' => 'attributes[guid]', 'value' => $vars['entity']->guid));
    ?>
    <p class="longtext_editarea">
      <label><?php echo elgg_echo('izap_offer_article:make_an_offer') ;?><br>
        <?php echo elgg_view('input/longtext', array('internalname' => 'attributes[reviews]', 'value' => $vars['postArray']['reviews'], 'internalid'=>"offer_reviews"));?>
      </label>      
    </p>

    <p>
      <label for="offer_name"><?php echo elggb_echo('your_name') ;?></label> <br />
      <?php echo elgg_view('input/text', array('internalname' => 'attributes[_offer_name]', 'value' => (isloggedin()) ? get_loggedin_user()->name : $vars['postArray']['offer_name'], 'internalid'=>"offer_name", 'class'=>"")) ;?>
    </p>

    <p>
      <label for="offer_email"><?php echo elggb_echo('your_email') ;?></label> <br />
      <?php echo elgg_view('input/text', array('internalname' => 'attributes[_offer_email]', 'value' => (isloggedin()) ? get_loggedin_user()->email : $vars['postArray']['offer_email'], 'internalid'=>"offer_email", 'class'=>"")) ;?>
    </p>

    <p>
      <label for="offer_contact"><?php echo elggb_echo('your_contact') ;?></label> <br />
      <?php echo elgg_view('input/text', array('internalname' => 'attributes[offer_contact]', 'value' => $vars['postArray']['offer_contact'], 'internalid'=>"offer_contact", 'class'=>"")) ;?>
    </p>

    <p>
      <label for="your_offer"><?php echo elgg_echo('izap_offer_article:your_offer') ;?></label>

      <?php
      if($vars['entity']->display_higest_bid == 'yes') {
        echo '(Higest current bid: ' . $vars['entity']->getHigestBid() . ', your minimum bid is: '.$vars['entity']->getMinimumBid().')';
      }
      ?>
      <br />
      <?php echo elgg_view('input/text', array('internalname' => 'attributes[_your_offer]', 'value' => $vars['entity']->getMinimumBid(), 'internalid'=>"your_offer", 'class'=>"general-textarea")) ;?>&nbsp;USD
    </p>

    <p>
      <?php echo elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('izap_offer_article:btn_make_offer'))); ?>
    </p>

  </form>
</div>