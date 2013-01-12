<?php 
/*****************************************************************************
 * Phloor news                                                            *
 *                                                                           *
 * Copyright (C) 2011 Alois Leitner                                          *
 *                                                                           *
 * This program is free software: you can redistribute it and/or modify      *
 * it under the terms of the GNU General Public License as published by      *
 * the Free Software Foundation, either version 2 of the License, or         *
 * (at your option) any later version.                                       *
 *                                                                           *
 * This program is distributed in the hope that it will be useful,           *
 * but WITHOUT ANY WARRANTY; without even the implied warranty of            *
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             *
 * GNU General Public License for more details.                              *
 *                                                                           *
 * You should have received a copy of the GNU General Public License         *
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.     *
 *                                                                           *
 * "When code and comments disagree both are probably wrong." (Norm Schryer) *
 *****************************************************************************/ 
?>
<?php
/**
 * Edit form for News objects
 */

$guid = $vars['guid'];
$news = get_entity($guid);
$vars['entity'] = $news;

$draft_warning = $vars['draft_warning'];
if ($draft_warning) {
	$draft_warning = '<span class="message warning">' . $draft_warning . '</span>';
}

$action_buttons = '';
$delete_link = '';
$preview_button = '';

if ($guid && phloor_news_instanceof($news)) {
	// add a delete button if editing
	$delete_url = "action/phloor_news/delete?guid={$guid}";
	$delete_link = elgg_view('output/confirmlink', array(
		'href' => $delete_url,
		'text' => elgg_echo('delete'),
		'class' => 'elgg-button elgg-button-delete elgg-state-disabled float-alt'
	));
}

// published phloor_newss do not get the preview button
if (!$guid || ($news && $news->status != 'published')) {
	$preview_button = elgg_view('input/submit', array(
		'value' => elgg_echo('preview'),
		'name' => 'preview',
		'class' => 'mls',
	));
}

$save_button = elgg_view('input/submit', array(
	'value' => elgg_echo('save'),
	'name' => 'save',
));
$action_buttons = $save_button . $preview_button . $delete_link;


$form_content = '';
$variables = elgg_get_config('phloor_news');
foreach ($variables as $name => $input_view) {
	if(!elgg_view_exists($input_view)) {
		// this should really never happen as the input_views are stored in the
		// config datastructure and its defined when the news is activated (start.php - run_once..)
		//
		register_error(elgg_echo('phloor_news:couldnotfindinputview', array($input_view)));
		continue;
	}
	
	$input_params = array(
		'name' => $name,
		'value' => $vars[$name],
	);
	
	// dont show the delete image input entity has no image
	if(strcmp('delete_image', $name) == 0) {	
		if(!phloor_news_instanceof($news) || !$news->hasImage()) {
			continue;// skip "delete image" input
		}
	}
	if(strcmp('comments_on', $name) == 0) {
		$input_params['options_values'] = array(
			'On' => elgg_echo('on'), 	
			'Off' => elgg_echo('off'),
		);
	}
	
	// get label
	$label = elgg_echo("phloor_news:form:$name");
	$input = elgg_view($input_view, $input_params);
	$description = elgg_echo("phloor_news:$name:description");
	
	// append to form content
	$form_content .= <<<HTML
	<div>
		<label for="$name">$label</label>
		$input
		$description
	</div>
HTML;
}

$categories_input = elgg_view('input/categories', $vars);

// hidden inputs
$container_guid_input = elgg_view('input/hidden', array('name' => 'container_guid', 'value' => elgg_get_page_owner_guid()));
$guid_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));

// create content
$content = <<<___HTML
$draft_warning

$form_content
	
$categories_input

<div class="elgg-foot">
	<div class="elgg-subtext mbm">
	$save_status <span class="phloor_news-save-status-time">$saved</span>
	</div>

	$guid_input
	$container_guid_input

	$action_buttons
</div>
___HTML;

// output content
echo $content;
	