<?php
/**
 * Blog Russian language file.
 *
 */

$russian = array(
	'blog' => 'Блог',
	'blog:blogs' => 'Блоги',
	'blog:revisions' => 'Простомтры',
	'blog:archives' => 'Архив',
	'blog:blog' => 'Блог',
	'item:object:blog' => 'Блог',

	'blog:title:user_blogs' => '%s\'s блог',
	'blog:title:all_blogs' => 'Все блоги',
	'blog:title:friends' => 'Блоги друзей',

	'blog:group' => 'Блог группы',
	'blog:enableblog' => 'Включить блог группы',
	'blog:write' => 'Написать сообщение',

	// Editing
	'blog:add' => 'Написать сообщение',
	'blog:edit' => 'Изменить',
	'blog:excerpt' => 'Краткое описание',
	'blog:body' => 'Сообщение',
	'blog:save_status' => 'Сохранено: ',
	'blog:never' => 'никогда',

	// Statuses
	'blog:status' => 'Статус',
	'blog:status:draft' => 'Черновик',
	'blog:status:published' => 'Опубликовано',
	'blog:status:unsaved_draft' => 'Несохраненный черновик',

	'blog:revision' => 'Просмотр',
	'blog:auto_saved_revision' => 'Просмотр сохраненного',

	// messages
	'blog:message:saved' => 'Сохранено.',
	'blog:error:cannot_save' => 'Не могу сохранить сообщение.',
	'blog:error:cannot_write_to_container' => 'Нехватает прав для сохранения блога.',
	'blog:error:post_not_found' => 'Сообщение удалено или у Вас недостаточно прав.',
	'blog:messages:warning:draft' => 'Это не сохраненный черновик сообщения!',
	'blog:edit_revision_notice' => '(Старая версия)',
	'blog:message:deleted_post' => 'Сообщение удалено.',
	'blog:error:cannot_delete_post' => 'Не могу удалить сообщение.',
	'blog:none' => 'Нет сообщений',
	'blog:error:missing:title' => 'Пожалуйста, введите название!',
	'blog:error:missing:description' => 'Пожалуйста, заполните сообщение!',
	'blog:error:cannot_edit_post' => 'Извините, сообщение не существует или Вы не имеете прав для его редактирования.',
	'blog:error:revision_not_found' => 'Cannot find this revision.',

	// river
	'river:create:object:blog' => '%s опубликовал(а) пост %s',
	'river:comment:object:blog' => '%s комментировал(а) пост %s',

	// notifications
	'blog:newpost' => 'Новый пост',

	// widget
	'blog:widget:description' => 'Показать последние посты',
	'blog:moreblogs' => 'Показать больше постов',
	'blog:numbertodisplay' => 'Число отображаемых постов',
	'blog:noblogs' => 'Нет постов'
);

add_translation('ru', $russian);
