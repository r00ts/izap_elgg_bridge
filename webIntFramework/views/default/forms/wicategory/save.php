<?php
/**
 * Edit category form
 *
 * @package category
 */


$entity = $vars['entity'];


$action_buttons = '';


$save_button = elgg_view('input/submit', array(
	'value' => elgg_echo('save'),
	'name' => 'save',
));
$action_buttons = $save_button;

$title_label = elgg_echo("wi:category:{$vars['cat_type']}:title");
$title_input = elgg_view('input/text', array(
	'name' => "title",
	'value' => $entity->title
));



$guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $entity->guid));
$type_input = elgg_view('input/hidden', array('name' => 'cat_type', 'value' => $vars['cat_type']));


echo <<<___HTML


<div>
	<label for="category_title">$title_label
	$title_input</label>
</div>


<div class="elgg-foot">

	$guid_input

        $type_input

	$action_buttons
</div>



___HTML;
