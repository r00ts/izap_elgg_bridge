<?php
/**
 * Elgg Market plugin
 * @license: GPL v 2.
 * @author slyhne
 * @copyright Zurf.dk
 * @link http://zurf.dk/elgg
 */

$linkstr = '';
if (isset($vars['entity']) && $vars['entity'] instanceof ElggEntity) {
		
	$marketcategories = $vars['entity']->universal_marketcategories;
	if (!empty($marketcategories)) {
		if (!is_array($marketcategories)) $marketcategories = array($marketcategories);
		foreach($marketcategories as $category) {
			$link = $vars['url'] . 'search?tagtype=universal_marketcategories&tag=' . urlencode($category);
			if (!empty($linkstr)) $linkstr .= ', ';
				$linkstr .= '<a href="'.$link.'">' . elgg_echo($category) . '</a>';
		}
	}
	
}
echo $linkstr;

?>
