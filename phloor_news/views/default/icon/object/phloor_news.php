<?php 
/*****************************************************************************
 * Phloor News                                                               *
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
$news = elgg_extract('entity', $vars);
if (!phloor_news_instanceof($news)) {
	return true;
}

$size = elgg_extract('size', $vars, 'small');
if (!in_array($size, array('topbar', 'thumb', 'tiny', 'small', 'medium', 'large'))) {
	$size = 'small';
}

$class = "elgg-avatar elgg-avatar-$size";
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}

$use_link = elgg_extract('use_link', $vars, true);

$name = htmlspecialchars($news->title, ENT_QUOTES, 'UTF-8', false);
$icontime = "default";

$img_class = '';
if (isset($vars['img_class'])) {
	$img_class = $vars['img_class'];
}

$spacer_url = elgg_get_site_url() . '_graphics/spacer.gif';

$icon_url = elgg_format_url($news->getIconURL($size));
$icon = elgg_view('output/img', array(
	'src' => $spacer_url,
	'alt' => $name,
	'title' => $name,
	'class' => $img_class,
	'style' => "background: url($icon_url) no-repeat;",
));

?>
<div class="<?php echo $class; ?>">
<?php
if ($use_link) {
	$class = elgg_extract('link_class', $vars, '');
	$url = elgg_extract('href', $vars, $news->getURL());
	echo elgg_view('output/url', array(
		'href' => $url,
		'text' => $icon,
		'is_trusted' => true,
		'class' => $class,
	));
} else {
	echo "<a>$icon</a>";
}
?>
</div>
