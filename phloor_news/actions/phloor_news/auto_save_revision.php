<?php
/**
 * Action called by AJAX periodic auto saving when editing.
 *
 * @package phloor_news
 */

$guid = get_input('guid');
$user = elgg_get_logged_in_user_entity();
$title = get_input('title');
$description = get_input('description');
$excerpt = get_input('excerpt');

// because get_input() doesn't use the default if the input is ''
if (empty($excerpt)) {
	$excerpt = $description;
}

// store errors to pass along
$error = FALSE;

if ($title && $description) {

	if ($guid) {
		$entity = get_entity($guid);
		if (elgg_instanceof($entity, 'object', 'phloor_news') && $entity->canEdit()) {
			$phloor_news = $entity;
		} else {
			$error = elgg_echo('phloor_news:error:post_not_found');
		}
	} else {
		$phloor_news = new PhloorNews();
		$phloor_news->subtype = 'phloor_news';

		// force draft and private for autosaves.
		$phloor_news->status = 'unsaved_draft';
		$phloor_news->access_id = ACCESS_PRIVATE;
		$phloor_news->title = $title;
		$phloor_news->description = $description;
		$phloor_news->excerpt = elgg_get_excerpt($excerpt);

		// mark this as a brand new post so we can work out the
		// river / revision logic in the real save action.
		$phloor_news->new_post = TRUE;

		if (!$phloor_news->save()) {
			$error = elgg_echo('phloor_news:error:cannot_save');
		}
	}

	// creat draft annotation
	if (!$error) {
		// annotations don't have a "time_updated" so
		// we have to delete everything or the times are wrong.

		// don't save if nothing changed
		if ($auto_save_annotations = $phloor_news->getAnnotations('phloor_news_auto_save', 1)) {
			$auto_save = $auto_save_annotations[0];
		} else {
			$auto_save == FALSE;
		}

		if (!$auto_save) {
			$annotation_id = $phloor_news->annotate('phloor_news_auto_save', $description);
		} elseif ($auto_save instanceof ElggAnnotation && $auto_save->value != $description) {
			$phloor_news->clearAnnotations('phloor_news_auto_save');
			$annotation_id = $phloor_news->annotate('phloor_news_auto_save', $description);
		} elseif ($auto_save instanceof ElggAnnotation && $auto_save->value == $description) {
			// this isn't an error because we have an up to date annotation.
			$annotation_id = $auto_save->id;
		}

		if (!$annotation_id) {
			$error = elgg_echo('phloor_news:error:cannot_auto_save');
		}
	}
} else {
	$error = elgg_echo('phloor_news:error:missing:description');
}

if ($error) {
	$json = array('success' => FALSE, 'message' => $error);
	echo json_encode($json);
} else {
	$msg = elgg_echo('phloor_news:message:saved');
	$json = array('success' => TRUE, 'message' => $msg, 'guid' => $phloor_news->getGUID());
	echo json_encode($json);
}
exit;
