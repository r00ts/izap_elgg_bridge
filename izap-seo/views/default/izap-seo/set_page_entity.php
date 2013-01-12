<?php

$full = elgg_extract('full', $vars);
$entity = elgg_extract('entity', $vars);

if ($full) {
  izap_set_current_entity($entity);
}