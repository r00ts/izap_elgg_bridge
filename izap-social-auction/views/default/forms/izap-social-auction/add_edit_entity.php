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
//elgg_extend_view('metatags',func_get_template_path_byizap(array('type'=>"views_home")).'js');?>

<form action="<?php echo func_get_actions_path_byizap();?>save" method="post" enctype="multipart/form-data">
  <?php
  echo elgg_view('input/securitytoken');
  echo $vars['c_guid'] ? elgg_view('input/hidden', array('internalname' => 'attributes[_c_guid]', 'value' => $vars['c_guid'])) : "";
  echo elgg_view('input/hidden', array('internalname' => 'attributes[guid]', 'value' => $vars['entity']->guid));

  ?>
  <div class="clearfloat"></div>
  <div class="contentWrapper">
    <p>
      <label for="offer_article_title"><?php echo elgg_echo('title');?>*</label><br />
      <?php echo elgg_view('input/text', array('internalname' => 'attributes[_title]', 'value' => $vars['postArray']['title'], 'internalid'=>"offer_article_title")) ;?>
    </p>

    <p>
      <label for="offer_article_tags"><?php echo elgg_echo('tags') ;?></label><br />
      <?php echo elgg_view('input/tags', array('internalname' => 'attributes[tags]', 'value' => $vars['postArray']['tags'], 'internalid'=>"offer_article_tags")) ;?>
    </p>

    <p>
      <label for="offer_article_uplimg"><?php echo elgg_echo('izap_offer_article:upload_image') ;?></label> <br />
      <?php echo elgg_view('input/file',array('internalname'=>"upl_img",'internalid'=>"offer_article_uplimg"));
      ?>
      <br />
      <span class="info"><?php echo CURRENCY_SYMBOL . $vars['fee_array'] ['AUCTION_IMAGE_FEE'] . ' will be charged for upload.' ;?></span>
    </p>

    <p>
      <label for="base_price_n_increment"><?php echo elgg_echo('izap_offer_article:base_price_n_increment') ;?>*</label> <br />
      <?php echo elgg_view('input/text',array('internalname'=>"attributes[_base_price_n_increment]",'internalid'=>"base_price_n_increment", 'value' => $vars['postArray']['base_price_n_increment'])); ?>
    </p>

    <p class='longtext_editarea'>
      <label for="offer_article_description"><?php echo elgg_echo('description');?>*</label><br />
      <?php echo elgg_view('input/longtext', array('internalname' => 'attributes[_description]', 'value' => $vars['postArray']['description'], 'internalid'=>"offer_article_description"));?>
    </p>

    <p class='longtext_editarea'>
      <label for="offer_article_terms"><?php echo elgg_echo('izap_offer_article:terms');?>*</label><br />
      <?php echo elgg_view('input/longtext', array('internalname' => 'attributes[_terms]', 'value' => $vars['postArray']['terms'], 'internalid'=>"offer_article_terms"));?>
    </p>

    <?php if( (!isadminloggedin() && $vars['entity']->guid) || $vars['entity']->expire_date<CURRENT_TIMESTAMP) :
      $css = 'style="display: none;"';
      endif; ?>
    <p <?php echo $css ;?> >
      <label for="offer_article_expiretime"><?php echo elgg_echo('izap_offer_article:expire_time');?>*</label><br />
      <?php echo elgg_view('input/date',array('internalname'=>"attributes[_expire_date]",'value'=>$vars['postArray']['expire_date'],'internalid'=>"offer_article_expiretime",'class'=>"general-textarea",
              'params'=>array('start_year'=>date('Y',CURRENT_TIMESTAMP),'end_year'=>"")
              )) . '<br />'; ?>
      <?php //echo elgg_view('input/text',array('internalname'=>"attributes[_expire_date]",'value'=>$vars['postArray']['expire_date'],'internalid'=>"datepicker",'class'=>"general-textarea"));?>
      <span class="info"><?php echo CURRENCY_SYMBOL . $vars['fee_array'] ['AUCTION_POST_FEE'] . ' will be charged for per day list duration.' ;?></span>
    </p>

    <p>
      <label for="offer_article_access"><?php echo elgg_echo('access');?>*</label><br />
      <?php echo elgg_view('input/access', array('internalname' => 'attributes[_access_id]', 'value' => (($vars['postArray']['access_id']) ? $vars['postArray']['access_id'] : ACCESS_DEFAULT), 'internalid'=>"offer_article_access"));?>
    </p>
    <p>
      <?php echo elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('save'))) . '&nbsp;' .
              elgg_view('input/button', array('type'=>"button", 'js'=>"onclick=\"$(location).attr('href','".$_SERVER['HTTP_REFERER']."');\" ", 'value'=>elggb_echo('cancel')));
      ?>

    </p>
  </div><div class="clearfloat"></div>
</form>