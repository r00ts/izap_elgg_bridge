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

$idea = $vars['entity'];
$bids_array = unserialize($idea->bids);
if(is_array($bids_array) && sizeof($bids_array)) {
  ?>
<div class="contentWrapper">
  <div>
    <div style="float: left; width: 20%; font-weight: bold;">
      Bidder
    </div>

    <div style="float: left; width: 20%; font-weight: bold;">
      Amount
    </div>

    <div style="float: left; width: 20%; font-weight: bold;">
      Datetime
    </div>
    
    <div class="clearfloat"></div>
  </div>
    <?php
    $i = 1;
    foreach($bids_array as $owner_guid => $bids):
      foreach($bids as $bid):
      $owner = get_entity($owner_guid);
      $class = ($i%2) ? "odd" : 'even';
      if(!$owner || !$owner->guid || !$bid['amount']) {
        continue;
      }
      ?>
  <div class="<?php echo $class?>">
    <div style="float: left; width: 20%; font-weight: bold;">
      <a href="mailto:<?php echo $email; ?>">
            <?php echo $owner->name?>
      </a>
    </div>

    <div style="float: left; width: 20%; font-weight: bold;">
          <?php echo CURRENCY_SYMBOL . $bid['amount']?>
    </div>

    <div style="float: left; width: 20%; font-weight: bold;">
          <?php echo date("d F Y", $bid['timestamp']);?>
    </div>

    <div class="clearfloat"></div>
  </div>
      <?php
      $i++;
      endforeach;
    endforeach;
    ?>
</div>
  <?php
}