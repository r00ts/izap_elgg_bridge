<?php
/**
 * Delete phloor_news entity
 *
 * @package phloor_news
 */

$phloor_news_guid = get_input('guid');
$phloor_news = get_entity($phloor_news_guid);

if (elgg_instanceof($phloor_news, 'object', 'phloor_news') && $phloor_news->canEdit()) {
	$container = get_entity($phloor_news->container_guid);
	if ($phloor_news->delete()) {
		system_message(elgg_echo('phloor_news:message:deleted_post'));
		if (elgg_instanceof($container, 'group')) {
			forward("phloor_news/group/$container->guid/all");
		} else {
			forward("phloor_news/owner/$container->username");
		}
	} else {
		register_error(elgg_echo('phloor_news:error:cannot_delete_post'));
	}
} else {
	register_error(elgg_echo('phloor_news:error:post_not_found'));
}

forward(REFERER);