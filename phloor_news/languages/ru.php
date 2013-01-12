<?php
/* * ************************************************
 * Vkonekte                              *
 * Copyrights (c) 2005-2012. Vkonekte                *
 * All rights reserved                             *
 * **************************************************
 * @author Vkonekte Team "<admin@vkonekte.com>"
 * @link http://vkonekte.com
 * Under this agreement, No one has rights to sell this script further.
 * For more information. Contact "Valeriy Yefimov<admin@vkonekte.com>"
 * For discussion about corresponding plugins, visit http://vkonekte.com/pg/forums/
 * Follow us on http://facebook.com/vkonekte.com and http://twitter.com/vkonekte.com
 */

$russian = array(
	"phloor_news:settings:layout:title" => "Макет",

	"phloor_news:settings:layout:enable_list_layout:label" => "Включить список макетов",
	"phloor_news:settings:layout:enable_list_layout:description" => "Включает поведение по умолчанию ",

	"phloor_news:settings:layout:element_limit:label" => "Максимальное количество элементов, отображаемых новостей",
	"phloor_news:settings:layout:element_limit:description" => "",

	'phloor_news' => 'Новости',
	'phloor_news:phloor_newss' => 'Новости',
	'phloor_news:revisions' => 'Изменения',
	'phloor_news:archives' => 'Архивы',
	'phloor_news:phloor_news' => 'Новости',
	'item:object:phloor_news' => 'Новости',

	'phloor_news:title:user_phloor_newss' => '%s\'s Новости',
	'phloor_news:title:all_phloor_newss' => 'Все новости сайта',
	'phloor_news:title:friends' => 'Друзья \' новости',

	'phloor_news:group' => 'Группа новостей',
	'phloor_news:enablephloor_news' => 'Включить группы новостей',
	'phloor_news:write' => 'Написать сообщение',

	// Editing
	'phloor_news:add' => 'Добавить новость',
	'phloor_news:edit' => 'Изменить сообщение',
	'phloor_news:excerpt' => 'Отрывок',
	'phloor_news:body' => 'Тело',
	'phloor_news:save_status' => 'Последний сохраненный: ',
	'phloor_news:never' => 'Никогда',

	'phloor_news:form:title' => 'Название',
	'phloor_news:title:description' => 'Описание',

	'phloor_news:form:excerpt' => 'Отрывок',
	'phloor_news:excerpt:description' => 'Описание',

	'phloor_news:form:description' => 'Тело',
	'phloor_news:description:description' => 'Описание',

	'phloor_news:form:image' => 'Изображение',
	'phloor_news:image:description' => 'Описание',

	'phloor_news:form:delete_image' => 'Удалить изображения? ',
	'phloor_news:delete_image:description' => 'Описание',

	'phloor_news:form:tags' => 'Теги',
	'phloor_news:tags:description' => 'Описание',

	'phloor_news:form:comments_on' => 'Разрешить комментарии? ',
	'phloor_news:comments_on:description' => 'Описание',

	'phloor_news:form:access_id' => 'Чтение',
	'phloor_news:access_id:description' => 'Описание',

	'phloor_news:form:status' => 'Статус',
	'phloor_news:status:description' => 'Описание',
 
	// Statuses
	'phloor_news:status' => 'Статус',
	'phloor_news:status:draft' => 'Проект',
	'phloor_news:status:published' => 'Опубликованные',
	'phloor_news:status:unsaved_draft' => 'Несохраненные проект',

	'phloor_news:revision' => 'Revision',
	'phloor_news:auto_saved_revision' => 'Автоматически  Сохранено',

	// messages
	'phloor_news:message:saved' => 'Сообщение сохранено.',
	'phloor_news:error:cannot_save' => 'Невозможно сохранить сообщение.',
	'phloor_news:error:cannot_write_to_container' => 'Недостаточно прав для сохранения новости в группе.',
	'phloor_news:error:post_not_found' => 'Это сообщение было удалено, является недействительным, или у Вас нет разрешения для просмотра.',
	'phloor_news:messages:warning:draft' => 'Существует  несохраненные сообщения !',
	'phloor_news:edit_revision_notice' => '(Старая версия)',
	'phloor_news:message:deleted_post' => 'Сообщение удалено.',
	'phloor_news:error:cannot_delete_post' => 'Не удается удалить сообщение.',
	'phloor_news:none' => 'Нет новых сообщений',
	'phloor_news:error:missing:title' => 'Пожалуйста, введите название новости!',
	'phloor_news:error:missing:description' => 'Пожалуйста, введите ваши новости!',
	'phloor_news:error:cannot_edit_post' => 'Это сообщение не  существует, или у вас нет разрешение на редактирование.',
	'phloor_news:error:revision_not_found' => 'Не могу найти этот препросмотр.',

	// river
	'river:create:object:phloor_news' => '%s опубликовано новое сообщение %s',
	'river:comment:object:phloor_news' => '%s прокомментировал новость %s',

	// notifications
	'phloor_news:newpost' => 'Новое сообщение ',

	// widget
	'phloor_news:widget:description' => 'Показать ваши  Последние новости',
	'phloor_news:morephloor_newss' => 'Больше сообщений ',
	'phloor_news:numbertodisplay' => 'Количество новостей на форуме',
	'phloor_news:nophloor_newss' => 'Нет новостей',
	
	
	
	'phloor_news:image' => 'Изображение',
	'phloor_news:delete_image' => 'Удалить изображение?',
);

add_translation('ru', $russian);
