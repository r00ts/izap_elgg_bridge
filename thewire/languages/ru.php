<?php

	$russian = array(
	
		/**
		 * Menu items and titles
		 */
		 
		 
	
			'thewire' => "Микроблог",
			'thewire:everyone' => "Все записи микроблога",
			'thewire:user' => "Микроблог пользователя %s",
			'thewire:friends' => "Микроблоги друзей",
			'thewire:reply' => "Ответить",
			'thewire:replying' => "%s (@%s) писал(а) в своем микроблоге",
			'thewire:thread' => "Блог пользователя",
			'thewire:charleft' => "символов осталось",
			'thewire:tags' => "Сообщения микроблога с тегом'%s'",
			'thewire:noposts' => "В микроблоге нет постов =\\",
			'item:object:thewire' => "Микроблог",
			'thewire:update' => 'Обновлено',
			
			'thewire:previous' => "Просмотр",
			'thewire:hide' => "Скрыть",
			'thewire:previous:help' => "Посмотреть первый пост",
			'thewire:hide:help' => "Скрыть первый пост",
			
			/**
			 * The wire river
			 */
			'river:create:object:thewire' => "%s  сделал(а) запись в %s",
			'thewire:wire' => 'Микроблог',
			
			/**
			 * Wire widget
			 */
			'thewire:widget:desc' => 'Показать ваши последние записи',
			'thewire:num' => 'Кол-во записей',
			'thewire:moreposts' => 'Показать больше',
			
			/**
			 * Status messages
			 */
			'thewire:posted' => "Добавлено.",
			'thewire:deleted' => "Пост был успешно удален.",
			'thewire:blank' => "Ну ты же ничего не ввел дружище.",
			'thewire:notfound' => "К сожалению, мы не смогли найти Микроблог.",
			'thewire:notdeleted' => "К сожалению,Микроблог был удален =\\.",

			/**
			 * Notifications
			 */
			'thewire:notify:subject' => "Новый пост",
			'thewire:notify:reply' => '%s ответил(а) %s на запись:',
			'thewire:notify:post' => '%s написал(а) в микроблоге:',
	
	);
					
	add_translation("ru",$russian);

?>