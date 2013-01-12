<?php
/**
 * View for category objects
 *
 * @package category
 */
$title = "<div class='field_config_title'>";
$title .= "<b>" . $vars['entity']->title . "</b>";
$title .= "<a href='" . $vars["url"] . "wicategory/forms/save/wiauctioncategory/" . $vars['entity']->guid  . "' class='categories-popup'><span class='elgg-icon elgg-icon-settings-alt' title='" . elgg_echo("edit") . "'></span></a>";

//$title .= "<span class='elgg-icon elgg-icon-delete' title='" . elgg_echo("delete") . "' onclick='removeField(" . $vars['entity']->guid . ");'></span>";

$title .= elgg_view('output/url', array(
                                    'text' => ' ', 
                                    'href' => 'action/wicategory/delete?guid=' . $vars['entity']->guid, 
                                    'confirm' => elgg_echo('deleteconfirm'),   
                                    'rel' => elgg_echo('deleteconfirm'),
                                    'is_action' => true,
                                    'class' => "elgg-icon elgg-icon-delete elgg-requires-confirmation"
                                    ));

$title .= "</div>";

		

echo "<div id='category_" . $vars['entity']->guid . "' class='custom_field' >"  . $title . "</div>";

