<?php
/**
 * phloor_news sidebar menu showing revisions
 *
 * @package phloor_news
 */

//If editing a post, show the previous revisions and drafts.
$phloor_news = elgg_extract('entity', $vars, FALSE);

if (elgg_instanceof($phloor_news, 'object', 'phloor_news') && $phloor_news->canEdit()) {
	$owner = $phloor_news->getOwnerEntity();
	$revisions = array();

	$auto_save_annotations = $phloor_news->getAnnotations('phloor_news_auto_save', 1);
	if ($auto_save_annotations) {
		$revisions[] = $auto_save_annotations[0];
	}

	// count(FALSE) == 1!  AHHH!!!
	$saved_revisions = $phloor_news->getAnnotations('phloor_news_revision', 10, 0, 'time_created DESC');
	if ($saved_revisions) {
		$revision_count = count($saved_revisions);
	} else {
		$revision_count = 0;
	}

	$revisions = array_merge($revisions, $saved_revisions);

	if ($revisions) {
		$title = elgg_echo('phloor_news:revisions');

		$n = count($revisions);
		$body = '<ul class="phloor_news-revisions">';

		$load_base_url = "phloor_news/edit/{$phloor_news->getGUID()}";

		// show the "published revision"
		if ($phloor_news->status == 'published') {
			$load = elgg_view('output/url', array(
				'href' => $load_base_url,
				'text' => elgg_echo('phloor_news:status:published'),
				'is_trusted' => true,
			));

			$time = "<span class='elgg-subtext'>"
				. elgg_view_friendly_time($phloor_news->time_created) . "</span>";

			$body .= "<li>$load : $time</li>";
		}

		foreach ($revisions as $revision) {
			$time = "<span class='elgg-subtext'>"
				. elgg_view_friendly_time($revision->time_created) . "</span>";

			if ($revision->name == 'phloor_news_auto_save') {
				$revision_lang = elgg_echo('phloor_news:auto_saved_revision');
			} else {
				$revision_lang = elgg_echo('phloor_news:revision') . " $n";
			}
			$load = elgg_view('output/url', array(
				'href' => "$load_base_url/$revision->id",
				'text' => $revision_lang,
				'is_trusted' => true,
			));

			$text = "$load: $time";
			$class = 'class="auto-saved"';

			$n--;

			$body .= "<li $class>$text</li>";
		}

		$body .= '</ul>';

		echo elgg_view_module('aside', $title, $body);
	}
}