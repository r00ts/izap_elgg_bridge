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
class IzapSocialAuction extends IzapObject {

  const UPLOAD_FILE_PREFIX="izap-social-auction/";

  public static $fee_array = array(
    'AUCTION_POST_FEE' => 1,
    'AUCTION_IMAGE_FEE' => 1,
  );
  private static $_paypal_acc_id = "rahul_1201800799_biz@izap.in";

  public function  __construct($guid=null, $params=array()) {
    parent::__construct($guid, $params);
  }

  public function get_test_mode() {
    return true;
  }

  public static function get_paypal_acc_id() {
    return self::$_paypal_acc_id;
  }

  public function get_attributes_array() {
    return array(
      'title'=>array('type'=>"string",'required'=>true,'default'=>null),
      'description'=>array('type'=>"text",'required'=>true,'default'=>null),
      'tags'=>array('type'=>"tags",'required'=>false,'default'=>null),
      'expire_date'=>array('type'=>"date",'required'=>true,'default'=>null),
      'access_id'=>array('type'=>"numerical",'required'=>true,'default'=>get_default_access()),
      'terms'=>array('type'=>"string",'required'=>true,'default'=>null),
      'upl_img'=>array('type'=>"file",'required'=>false,'default'=>null),
      'base_price_n_increment' => array('type' => 'string', 'required' => TRUE, 'default' => 0),
    );
  }

  public function getIcon($size = 'medium') {
    return func_get_img_link_byizap($this, array('width'=>100, 'height'=>100));
  }

  public function getHigestBid() {
    $higest_bid = null;
    $bids_array = unserialize($this->bids);
    if(is_array($bids_array) && sizeof($bids_array)) {
      foreach($bids_array as $ownerId=>$bids) {
        foreach($bids as $bid) {
          if($bid['amount'] > $higest_bid) {
            $higest_bid = $bid['amount'];
          }
        }
      }
    }
    return $higest_bid ? $higest_bid : $this->getBasePrice();
  }

  public function displayHighestBid() {
    $higest_bid = $this->getHigestBid();
    return ($higest_bid > $this->getBasePrice()) ? (CURRENCY_SYMBOL . $higest_bid) : "N/A";
  }

  public function getBasePrice() {
    $array = explode('/', $this->base_price_n_increment);

    return $array[0];
  }

  public function getPriceIncrement() {
    $array = explode('/', $this->base_price_n_increment);

    return ($array[1]) ? $array[1] : 1;
  }

  public function getMinimumBid() {
    return $this->getHigestBid() + $this->getPriceIncrement();
  }

  public function getItemStatus() {
    return ($this->expire_date-CURRENT_TIMESTAMP)>0 ? "Open" : "Closed";
  }

  public function getRemainingTime()
  {
    $end_date = $this->expire_date;
    $start_date = CURRENT_TIMESTAMP;
    
    (string)	$display_output = null;
    (string) $minute = 60;
    (string) $hour = 60 * $minute;
    (string) $day = 24 * $hour;

    $time_left = $end_date - $start_date;

    $days_left = floor($time_left/$day);

    $hours = $time_left - ($days_left * $day);
    $hours_left = floor($hours/$hour);

    $minutes = $hours - ($hours_left * $hour);
    $minutes_left = floor($minutes/$minute);

    if ($time_left > 0)
    {
      $display_output = (($days_left>0) ? $days_left . ' ' . (($days_left==1) ? "day" : "days") . ', ' : '') .
        (($hours_left>0 || $days_left>0) ? $hours_left . " hours" : '') . ' ' . $minutes_left . " minutes";
    }
    else if (!$end_date)
    {
      $display_output = "N/A";
    }
    else
    {
      $display_output = "Closed";
    }

    return $display_output;
  }

  public function getItemLocation() {
    return "N/A";
  }

  public function getStartBid() {
    return $this->getBasePrice();
  }

  public function displayStartBid() {
    return CURRENCY_SYMBOL . $this->getStartBid();
  }

  public function isItemOpen() {
    return (($this->expire_date-CURRENT_TIMESTAMP)>0 && $this->status!==0) ? true : false;
  }

  public function getHighestBidderId() {
    return $this->winner_guid;
  }

  public function endAuction() {
    $this->expire_date = 0;
    $this->save();
    return true;
  }

  public function save() {
    if(parent::save()) {
      $this->_setupFee();
      return true;
    }
    return false;
  }

  private function _setupFee() {
    if($this->is_new_record() || true) {
      // calculate auction fee
      $total_fee = 0;

      // add image upload fee
      if( @file_exists($this->getFilenameOnFilestore()) ) {
        $amount = self::$fee_array['AUCTION_IMAGE_FEE'];
      }
      $auction_fee_array[] = array('type'=>"AUCTION_IMAGE_FEE", 'amount'=>$amount);
      $total_fee += $amount;
      
      // add auction post duration fee
      $auction_duration = ceil( ($this->expire_date-CURRENT_TIMESTAMP)/(60*60*24) );
      $amount = (self::$fee_array['AUCTION_POST_FEE']*$auction_duration);
      $auction_fee_array[] = array('type'=>"AUCTION_POST_FEE", 'amount'=>$amount);
      $total_fee += $amount;

      $this->auction_fee = $amount;
      $this->auction_fee_array = serialize($auction_fee_array);
      $this->status=0;
//
//      echo $auction_duration . '<br />';
//      func_printarray_byizap($auction_fee_array);
//      echo $this->auction_fee;
    }
  }

  public function approveAuction() {
    $update = array(
      'expire_date'=> $this->expire_date+(CURRENT_TIMESTAMP-$this->time_created),
      'status'=> 1,
    );
    func_izap_update_metadata(array('entity'=>$this, 'metadata'=>$update));
    return true;
  }

  public function get_auction_fee_array() {
    return unserialize($this->auction_fee_array);
  }
}
