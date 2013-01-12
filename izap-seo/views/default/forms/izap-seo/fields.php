<?php

/**
 * seo meta data form
 */

$entity = elgg_extract('entity', $vars);

$form .= IzapBase::input('text', array(
          'input_title' => elgg_echo('izap-seo:title'),
          'name' => 'izap_title',
          'value' => $entity->izap_title,
  ));

$form .= IzapBase::input('plaintext', array(
          'input_title' => elgg_echo('izap-seo:description'),
          'name' => 'izap_meta_description',
          'value' => $entity->izap_meta_description,
  ));

$form .= IzapBase::input('text', array(
          'input_title' => elgg_echo('izap_seo:index:meta_robot_tags'),
          'name' => 'meta_robot_tags',
          'value' => $entity->meta_robot_tags,
  ));

$form .= IzapBase::input('tags', array(
        'input_title' => elgg_echo('izap-seo:keywords'),
        'name' => 'izap_meta_keywords',
        'value' => $entity->izap_meta_keywords,
));

echo $form;