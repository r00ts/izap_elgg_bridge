<?php

$entity = elgg_extract('entity', $vars, false);
$full = elgg_extract('full_view', $vars, false);
$viewtype = elgg_extract('viewtype', $vars, '');

if (!$entity) {
    return true;
}

$form = hj_framework_get_data_pattern('object', 'hjplace');
$fields = $form->getFields();

$owner = $entity->getOwnerEntity();

// Short View of the Entity
$title = elgg_view('output/url', array('text' => $entity->title, 'href' => $entity->getURL()));

if ($entity->location !== '') {
    $subtitle .= " $entity->location";
}

$short_description = elgg_get_excerpt($entity->description);

if ($full) {
    $params_menu = hj_framework_extract_params_from_entity($entity);

    $header_menu = elgg_view_menu('hjentityhead', array(
        'entity' => $entity,
        'viewtype' => $viewtype,
        'class' => 'elgg-menu-hz hj-menu-hz',
        'sort_by' => 'priority',
        'params' => $params_menu
            ));

    $section = elgg_echo('hj:hjportfolio:hjexperience');
    $intro = elgg_view_title("{$owner->name} - $section");

    $full_description = elgg_view('page/components/hj/fieldtable', array('entity' => $entity, 'fields' => $fields, 'viewtype' => $viewtype, 'intro' => $intro));
    //$full_description = elgg_view('page/components/hj/fullview', array('entity' => $entity, 'content' => $fields_view, 'viewtype' => $viewtype));
}

$content = <<<HTML
    $short_description
    $full_description
HTML;

$params = array(
    'entity' => $entity,
    'title' => $title,
    'metadata' => $header_menu,
    'subtitle' => $subtitle,
    'content' => $content,
    'class' => 'hj-portfolio-widget'
);

$params = $params + $vars;
$list_body = elgg_view('object/elements/summary', $params);
$loc = new hjEntityLocation($entity->guid);
$icon = "<img src=\"{$loc->getMapIcon()}\" />";

echo elgg_view_image_block($icon, $list_body);