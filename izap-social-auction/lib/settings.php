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

global $CONFIG;

return array(
    'plugin'=>array(
      'name'=>"izap-social-auction",
      'version'=>"1.0",
      'title'=>"Offer article implementation",
      'url_title' => 'auctions',
      'objects'=>array(
        'IzapSocialAuction'=>array('getUrl'=>"func_geturl_izap_offer_article",'class'=>"IzapSocialAuction", 'type'=>"object")
        ),
      
      'actions'=>array(
        'auction/save' => array('file'=>"save.php", 'public'=>false, 'admin_only'=>false),
        'auction/delete' => array('file'=>"delete.php", 'public'=>false, 'admin_only'=>false),
        //'auction/makeanoffer' => array('file'=>"make_an_offer.php", 'public'=>true, 'admin_only'=>false),
        'auction/sendtofriend' => array('file'=>"send_to_friend.php", 'public'=>true, 'admin_only'=>false),
        'auction/bid' => array('file'=>"bid.php", 'public'=>false, 'admin_only'=>false),
        'auction/close' => array('file'=>"close_it.php", 'public'=>false, 'admin_only'=>false),
        'auction/payfee' => array('file'=>"pay_auction_fee.php", 'public'=>false, 'admin_only'=>false),
        'auction/payfeepaypal' => array('file'=>"pay_auction_fee_notify_paypal.php", 'public'=>true, 'admin_only'=>false),
        ),

      'action_to_plugin_name' => array(
        'auction' => 'izap-social-auction',
      ),
      
      'menu'=>array(
        'pg/auctions'=>array('title'=>"izap_offer_article:articles",'public'=>true,'admin_only'=>false),
      ),
      
      'submenu'=>array(
        'auctions'=>array(
          'pg/auctions'=>array('title'=>"izap_offer_article:manage",'public'=>true,'admin_only'=>false),
          'pg/auctions/save'=>array('title'=>"izap_offer_article:add",'public'=>false,'admin_only'=>false, 'groupby'=>"auction_owner"),
          'pg/auctions/bidsOn'=>array('title'=>"izap_offer_article:currentbids",'public'=>false,'admin_only'=>false),
          'pg/auctions/listOpen'=>array('title'=>"izap_offer_article:openauctions",'public'=>false,'admin_only'=>false, 'groupby'=>"auction_owner"),
          'pg/auctions/listClosed'=>array('title'=>"izap_offer_article:closedauctions",'public'=>false,'admin_only'=>false, 'groupby'=>"auction_owner"),
          'pg/auctions/listPending'=>array('title'=>"izap_offer_article:pendingAuctions",'public'=>false,'admin_only'=>false, 'groupby'=>"auction_owner"),
          'pg/auctions/listWon'=>array('title'=>"izap_offer_article:wonauctions",'public'=>false,'admin_only'=>false),
        ),
        
        'admin'=>array(
          'pg/auctions/save'=>array('title'=>"izap_offer_article:add",'public'=>false,'admin_only'=>true),
        ),
      ),
      
    ),
  'path'=>array(

    'www'=>array(
      'page' => $CONFIG->wwwroot . 'pg/auctions/',
      'images' => $CONFIG->wwwroot . 'mod/izap-social-auction/_graphics/',
      'action' => $CONFIG->wwwroot . 'action/auction/',
    ),

    'dir'=>array(      
      'plugin'=>dirname(dirname(__FILE__))."/",
      'actions'=>$CONFIG->pluginspath."izap-social-auction/actions/",
      'class'=>dirname(__FILE__)."/classes/",
      'functions'=>dirname(__FILE__)."/functions/",
      'views'=>array('home'=>"izap-social-auction/",'forms'=>"forms/izap-social-auction/",'pages'=>"izap-social-auction/views/",'river'=>"river/izap-social-auction/"),
      'pages'=>dirname(dirname(__FILE__))."/pages/",
    ),
    
  ),

  'includes'=>array(
    'classes'=>array('class_offer_article_byizap'),
    'functions'=>array('functions_addon','functions_hook','functions_url'),
  ),
);