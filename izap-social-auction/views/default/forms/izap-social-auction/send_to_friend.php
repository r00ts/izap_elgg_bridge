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
<div class="contentWrapper">

  <form action="<?php echo func_get_actions_path_byizap() ;?>sendtofriend" method="post">
    <?php
    echo elgg_view('input/securitytoken');
    echo elgg_view('input/hidden', array('internalname' => 'attributes[guid]', 'value' => $vars['entity']->guid));
    ?>

    <p>
      <label for="name" ><?php echo elggb_echo('your_name');?></label>
      <?php echo elgg_view('input/text', array('internalname' => 'attributes[_name]', 'value' => (isloggedin()) ? get_loggedin_user()->name : $vars['postArray']['name'], 'internalid'=>"name")) ;?>
    </p>

    <p>
      <label for="email" ><?php echo elggb_echo('your_email');?></label>
      <?php echo elgg_view('input/text', array('internalname' => 'attributes[_email]', 'value' => (isloggedin()) ? get_loggedin_user()->email : $vars['postArray']['email'], 'internalid'=>"email")) ;?>
    </p>

    <p>
      <label for="send_name" ><?php echo elggb_echo('your_friend_name');?></label>
      <?php echo elgg_view('input/text', array('internalname' => 'attributes[_send_name]', 'value' => $vars['postArray']['send_name'], 'internalid'=>"send_name")) ;?>
    </p>

    <p>
      <label for="send_email" ><?php echo elggb_echo('your_friend_email');?></label>
      <?php echo elgg_view('input/text', array('internalname' => 'attributes[_send_email]', 'value' => $vars['postArray']['send_email'], 'internalid'=>"send_email")) ;?>
    </p>

    <p>
      <label for="msg"><?php echo elggb_echo('message') ;?></label
      <?php echo elgg_view('input/longtext', array('internalname' => 'attributes[_msg]', 'value' => $vars['postArray']['msg'], 'internalid'=>"msg"));?>
    </p>

    <p>
      <?php echo elgg_view('input/submit', array('internalname' => 'submit', 'value' => elgg_echo('submit'))); ?>
    </p>
  </form>

</div>