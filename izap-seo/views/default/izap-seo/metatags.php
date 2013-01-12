<!-- Data by iZAP-SEO -->
<?php
if (elgg_get_site_url() . 'activity' == current_page_url() || current_page_url() == elgg_get_site_url()) :
  $index_metadesctiption = elgg_get_plugin_setting('index_metadesctiption', GLOBAL_IZAP_SEO_PLUGIN);
  $index_metatags = elgg_get_plugin_setting('index_metatags', GLOBAL_IZAP_SEO_PLUGIN);
  $index_meta_robottags = elgg_get_plugin_setting('index_meta_robottags', GLOBAL_IZAP_SEO_PLUGIN);
  $webmaster_varifaction_code = elgg_get_plugin_setting('webmaster_varifaction_code', GLOBAL_IZAP_SEO_PLUGIN);
?>
<?php if (!empty($index_metadesctiption)) : ?>
    <meta name="description" content="<?php echo $index_metadesctiption ?>" />
<?php endif; ?>
<?php if (!empty($index_metatags)) : ?>
      <meta name="keywords" content="<?php echo $index_metatags ?>" />
<?php endif; ?>
<?php if (!empty($index_meta_robottags)) : ?>
        <meta name="robots" content="<?php echo $index_meta_robottags ?>" />
<?php endif; ?>
<?php if (!empty($webmaster_varifaction_code)) : ?>
        <meta name="google-site-verification" content="<?php echo $webmaster_varifaction_code ?>" />
<?php endif; ?>
<?php
        else:

          $current_entity_keywords = izap_get_current_entity()->izap_meta_keywords;
          $current_entity_description = izap_get_current_entity()->izap_meta_description;
          $current_entity_robot_tags = izap_get_current_entity()->meta_robot_tags;
?>

          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if (!empty($current_entity_keywords)) : ?>
            <meta name="keywords" content="<?php echo $current_entity_keywords; ?>" />
<?php endif; ?>
<?php if (!empty($current_entity_description)) : ?>
              <meta name="description" content="<?php echo $current_entity_description; ?>" />
<?php endif; ?>
<?php if (!empty($current_entity_robot_tags)) : ?>
                <meta name="robots" content="<?php echo $current_entity_robot_tags; ?>" />
<?php endif; ?>
<?php endif; ?>
                
<!-- Data by iZAP-SEO -->
