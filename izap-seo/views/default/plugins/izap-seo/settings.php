<?php
/* * ************************************************
 * PluginLotto.com                                 *
 * Copyrights (c) 2005-2010. iZAP                  *
 * All rights reserved                             *
 * **************************************************
 * @author iZAP Team "<support@izap.in>"
 * @link http://www.izap.in/
 * Under this agreement, No one has rights to sell this script further.
 * For more information. Contact "Tarun Jangra<tarun@izap.in>"
 * For discussion about corresponding plugins, visit http://www.pluginlotto.com/pg/forums/
 * Follow us on http://facebook.com/PluginLotto and http://twitter.com/PluginLotto
 */
?>

<fieldset class="izap_admin_fieldset">
  <legend><?php echo elgg_echo('izap_seo:index:izap_seo:settings') ?></legend>
  <p>
    <label><?php echo elgg_echo('izap_seo:index:meta_title'); ?></label><br />
    <?php
    echo elgg_view('input/text', array(
      'name' => 'params[index_metatitle]',
      'value' => $vars['entity']->index_metatitle
    ));
    ?>
  </p>

  <p>
    <label><?php echo elgg_echo('izap_seo:index:meta_description'); ?></label><br />
    <?php
    echo elgg_view('input/plaintext', array(
      'name' => 'params[index_metadesctiption]',
      'value' => $vars['entity']->index_metadesctiption
    ));
    ?>
  </p>

  <p>
    <label><?php echo elgg_echo('izap_seo:index:meta_tags'); ?></label><br />
    <?php
    echo elgg_view('input/tags', array(
      'name' => 'params[index_metatags]',
      'value' => $vars['entity']->index_metatags
    ));
    ?>
  </p>

  <p>
    <label><?php echo elgg_echo('izap_seo:index:index_meta_robottags'); ?></label><br />
    <?php
    echo elgg_view('input/text', array(
      'name' => 'params[index_meta_robottags]',
      'value' => $vars['entity']->index_meta_robottags
    ));
    ?>
  </p>

  <?php
    echo IzapBase::input('radio', array(
      'input_title' => elgg_echo('izap_seo:index:index_override_404'),
      'options' => array(
        elgg_echo('izap-bridge:yes') => 'true',
        elgg_echo('izap-bridge:no') => 'false',
      ),
      'value' => IzapBase::pluginSetting(array(
        'plugin' => GLOBAL_IZAP_SEO_PLUGIN,
        'name' => 'index_override_404',
        'value' => 'false'
      )),
      'name' => 'params[index_override_404]',
    ));
  ?>

  <p>
    <label><?php echo elgg_echo('izap_seo:index:webmaster_varifaction_code'); ?></label><br />
    <?php
    echo elgg_view('input/text', array(
      'name' => 'params[webmaster_varifaction_code]',
      'value' => $vars['entity']->webmaster_varifaction_code
    ));
    ?>
  </p>

</fieldset>