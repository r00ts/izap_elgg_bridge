<?php
/**
 * Elgg Market plugin
 * @license: GPL v 2.
 * @author slyhne
 * @copyright Zurf.dk
 * @link http://zurf.dk/elgg
 */

	$marketcategories = string_to_tag_array(get_plugin_setting('market_categories', 'market'));
	
	if ($marketcategories) {
		if (!is_array($marketcategories)){
			$marketcategories = array($marketcategories);
		}		

		echo "<div class=\"blog_marketcategories\">";
		echo "<h3>" . elgg_echo('market:categories') . "</h3>";
		foreach($marketcategories as $category) {
			$active_category = elgg_get_entities_from_metadata(array(
			'type' => 'object',
			'subtype' => $vars['subtype'],
			'metadata_name' => 'marketcategory',
			'metadata_value' => $category,
			'owner_guid' => $owner_guid,
			'limit' =>'1'
			));
		
			if ($active_category > 0){
				$catlink .= '<li><a href="'.$vars['url'].'mod/market/category.php?cat='.urlencode($category).'">'. elgg_echo($category) .'</a></li>';
			}
		}
		if (!empty($catlink)) echo "<ul>{$catlink}</ul>";
		echo "</div>";
	}

?>
