<?php
/**
 * Bookmarks Russian language file
 */

$russian = array(

	/**
	 * Menu items and titles
	 */
	'bookmarks' => "Закладки",
	'bookmarks:add' => "Добавить в закладки",
	'bookmarks:edit' => "Редактировать закладку",
	'bookmarks:owner' => "Закладки пользователя %s",
	'bookmarks:friends' => "Закладки друзей",
	'bookmarks:everyone' => "Все закладки",
	'bookmarks:this' => "Добавить в закладки",
	'bookmarks:this:group' => "Добавить в закладки в %s",
	'bookmarks:bookmarklet' => "Добавить закладки",
	'bookmarks:bookmarklet:group' => "Добавить закладки группы",
	'bookmarks:inbox' => "Ваши закладки",
	'bookmarks:morebookmarks' => "Еще закладки",
	'bookmarks:more' => "Еще",
	'bookmarks:with' => "Поделиться",
	'bookmarks:new' => "Новая закладка",
	'bookmarks:via' => "через закладки",
	'bookmarks:address' => "Адрес сайта",
	'bookmarks:none' => 'Нет закладок',

	'bookmarks:delete:confirm' => "Вы действительно хотите удалить закладку?",

	'bookmarks:numbertodisplay' => 'Число отображаемых закладок',

	'bookmarks:shared' => "Закладки",
	'bookmarks:visit' => "Зайти на сайт",
	'bookmarks:recent' => "Recent bookmarks",

	'river:create:object:bookmarks' => 'Пользователь %s добавил закладку',
	'river:comment:object:bookmarks' => 'Пользователь %s оставил комментарий к закладке %s',
	'bookmarks:river:annotate' => 'Пользователь %s сделал',
	'bookmarks:river:item' => 'закладку',

	'item:object:bookmarks' => 'Закладки',

	'bookmarks:group' => 'Закладки группы',
	'bookmarks:enablebookmarks' => 'Включить закладки группы',
	'bookmarks:nogroup' => 'В этой группе нет закладов',
	'bookmarks:more' => 'Еще закладки',

	'bookmarks:no_title' => 'Без названия',

	/**
	 * Widget and bookmarklet
	 */
	'bookmarks:widget:description' => "Этот элемент показывает Ваши закладки.",

	'bookmarks:bookmarklet:description' =>
			"Закладки позволяют добавлять адреса понравившихся сайтов, советовать друзьям или просто отмечать для себя. Чтобы использовать элемент, перетащите кнопку в адресную строку Вашего браузера:",

	'bookmarks:bookmarklet:descriptionie' =>
			"Если Вы используете Internet Explorer, Вам нужно нажать правой кнопкой мыши на значок закладок, выбрать 'Добавить в избранное', а затем на адресную строку.",

	'bookmarks:bookmarklet:description:conclusion' =>
			"Вы можете сохранить любую страницу в любое время.",

	/**
	 * Status messages
	 */

	'bookmarks:save:success' => "Закладка добавлена.",
	'bookmarks:delete:success' => "Закладка удалена.",

	/**
	 * Error messages
	 */

	'bookmarks:save:failed' => "Простите, Ваша закладка не может быть сохранена. Проверьте название, адрес и попробуйте снова.",
	'bookmarks:delete:failed' => "Простите, Ваша закладка не может быть удалена. Попробуйте снова.",
);

add_translation('ru', $russian);