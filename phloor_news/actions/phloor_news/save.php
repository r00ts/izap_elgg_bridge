<?php
/**
 * Save phloor_news entity
 *
 * @package phloor_news
 */
// check if upload failed
if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] != 0) {
	register_error(elgg_echo('phloor_news:error:cannotloadimage'));
	forward(REFERER);
}

// start a new sticky form session in case of failure
elgg_make_sticky_form('phloor_news');

// save or preview
$save = (bool)get_input('save');

// store errors to pass along
$error = FALSE;
$error_forward_url = REFERER;
$user = elgg_get_logged_in_user_entity();

$news = NULL;
$new_post = false;

$delete_files = array();

// edit or create a new entity
$guid = get_input('guid');
if ($guid) {
    $news = get_entity($guid);
    
	if (!phloor_news_instanceof($news) || !$news->canEdit()) {
		register_error(elgg_echo('phloor_plugin:error:plugin_not_found'));
		forward(get_input('forward', REFERER));
		exit;
	}
	
	// determine files to delete (old images and thumbnails)
	if (isset ($_FILES['image']['name']) && 
		!empty($_FILES['image']['name']) && 
		$_FILES['image']['error'] == 0 ) {
		$delete_files = array_merge(array('image' => $news->getImage()), $news->getThumbnails());
	}	
	
	// save some data for revisions once we save the new edit
	$revision_text = $news->description;
	$new_post = $news->new_post;
} else {
	$news = new PhloorNews();
    $new_post = true;
}

// set the previous status for the hooks to update the time_created and river entries
$old_status = $news->status;

// if preview, force status to be draft
$params = phloor_news_get_input_vars();
if ($save == false) {
	$params['status'] = 'draft';
}

// get form inputs from POST var
// save settings and display success message
if (phloor_news_save_vars($news, $params)) {
	// remove sticky form entries
	elgg_clear_sticky_form('phloor_news');

    // delete former image if new image was uploaded
	if (isset ($_FILES['image']['name']) && 
		!empty($_FILES['image']['name']) && 
		$_FILES['image']['error'] == 0 ) {
		foreach($delete_files as $file) {		
			if(!empty($file) && file_exists($file) && is_file($file)) {
				// delete file
				if(@unlink($file)) {
				}
			}
		}
			
		// recreate thumbnails
		$news->recreateThumbnails();
	}
	
	// remove autosave draft if exists
	$news->deleteAnnotations('phloor_news_auto_save');
	// no longer a brand new post.
	$news->deleteMetadata('new_post');

	// if this was an edit, create a revision annotation
	if (!$new_post && $revision_text) {
		$news->annotate('phloor_news_revision', $revision_text);
	}

	system_message(elgg_echo('phloor_news:message:saved'));

	$status = $news->status;

	// add to river if changing status or published, regardless of new post
	// because we remove it for drafts.
	if (($new_post || $old_status == 'draft') && $status == 'published') {
		add_to_river('river/object/phloor_news/create', 'create', elgg_get_logged_in_user_guid(), $news->getGUID());

		if ($guid) {
			$news->time_created = time();
			$news->save();
		}
	} elseif ($old_status == 'published' && $status == 'draft') {
		elgg_delete_river(array(
			'object_guid' => $news->guid,
			'action_type' => 'create',
		));
	}

	if ($news->status == 'published' || $save == false) {
		forward($news->getURL());
	} else {
		forward("phloor_news/edit/$news->guid");
	}
} else {
	register_error(elgg_echo('phloor_news:error:cannot_save'));
	forward($error_forward_url);
}
