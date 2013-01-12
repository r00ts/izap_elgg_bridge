<?php
/**
* Elgg send a message action page
* 
* @package ElggMessages
*/

	$russian = array(

	/**
	* Menu items and titles
	*/

	'messages' => "Сообщения",
	'messages:back' => "обратно к сообщениям",
	'messages:user' => "Входящие %s",
	'messages:posttitle' => "%s's сообщение %s",
	'messages:inbox' => "Входящие",
	'messages:send' => "Отправить",
	'messages:sent' => "Отравленые",
	'messages:message' => "Сообщение",
	'messages:title' => "Тема",
	'messages:to' => "Для",
	'messages:from' => "От",
	'messages:fly' => "Отправить",
	'messages:replying' => "Ответить на сообщение",
	'messages:inbox' => "Входящие",
	'messages:sendmessage' => "Отправить",
	'messages:compose' => "Написать",
	'messages:add' => "Написать",
	'messages:sentmessages' => "Отравленые сообщения",
	'messages:recent' => "Последние сообщения",
	'messages:original' => "Оригинал",
	'messages:yours' => "Ваше сообщение",
	'messages:answer' => "Ответить",
	'messages:toggle' => 'Отметить все',
	'messages:markread' => 'Отметить как прочитаные',
	'messages:recipient' => 'Выберите получателя ',
	'messages:to_user' => 'Для: %s',

	'messages:new' => 'Новое сообщение',

	'notification:method:site' => 'Сообщения',

	'messages:error' => 'Проблема сохранения. Попробуйте еще раз.',

	'item:object:messages' => 'Сообщения',

	/**
	* Status messages
	*/

	'messages:posted' => "Ваше сообщение успешно отправлено.",
	'messages:success:delete:single' => 'Сообщение удалено',
	'messages:success:delete' => 'Сообщения удалены',
	'messages:success:read' => 'Сообщение было отмечено как прочитаное',
	'messages:error:messages_not_selected' => 'Сообщение не выбрано',
	'messages:error:delete:single' => 'Не удается удалить сообщение',

	/**
	* Email messages
	*/

	'messages:email:subject' => 'У вас новое сообщение!:D',
	'messages:email:body' => "Вам написал(а) %s. Следущие:


	%s


	Для просмотра сообщения тыкни тут:

	%s

	Что бы написать %s сообщение, тыкни тут:

	%s

	З.Ы.
	Каждый раз когда вы отвечаете на сообщения бота, вы убиваете панду.",

	/**
	* Error messages
	*/

	'messages:blank' => "Вы оставили пустое сообщение",																												
	'messages:notfound' => "К сожалению, нам не удалось найти указанное сообщение.",
	'messages:notdeleted' => "Sorry; we could not delete this message.",
	'messages:nopermission' => "You do not have permission to alter that message.",
	'messages:nomessages' => "There are no messages.",
	'messages:user:nonexist' => "Мы не смогли найти получателя в базе данных пользователей.",
	'messages:user:blank' => "Вы не выбрали получателя",

	'messages:deleted_sender' => 'Пользователя не существует.',

);
	
	add_translation("ru",$russian);

?>