<?php
/**
 * Elgg groups plugin language pack
 *
 * @package ElggGroups
 */

$russian = array(

	/**
	 * Menu items and titles
	 */
	'groups' => "Группы",
	'groups:owned' => "Ваши собственные группы",
	'groups:yours' => "Группы, в которых состоите",
	'groups:user' => "Группы пользователя %s",
	'groups:all' => "Все группы на сайте",
	'groups:add' => "Создать группу",
	'groups:edit' => "Редактировать группу",
	'groups:delete' => 'Удалить группу',
	'groups:membershiprequests' => 'Управление запросами приглашения',
	'groups:invitations' => 'Приглашения группы',

	'groups:icon' => 'Иконка группы',
	'groups:name' => 'Название группы',
	'groups:username' => 'Краткое название группы',
	'groups:description' => 'Описание',
	'groups:briefdescription' => 'Краткое описание',
	'groups:interests' => 'Интересы',
	'groups:website' => 'Сайт',
	'groups:members' => 'Участники группы',
	'groups:members:title' => 'Учестник %s',
	'groups:members:more' => "Показать всех участников группы",
	'groups:membership' => "Ограничения в членстве",
	'groups:access' => "Доступ к группе",
	'groups:owner' => "Владелец",
	'groups:widget:num_display' => 'Число отображаемых групп',
	'groups:widget:membership' => 'Членство',
	'groups:widgets:description' => 'Число отображаемых групп',
	'groups:noaccess' => 'Нет доступа к группе',
	'groups:permissions:error' => 'Вы не можете редактировать эту группу',
	'groups:ingroup' => 'в группе',
	'groups:cantedit' => 'Вы не можете редактировать эту группу',
	'groups:saved' => 'Сохранено',
	'groups:featured' => 'Избранные группы',
	'groups:makeunfeatured' => 'Убрать из избранного',
	'groups:makefeatured' => 'Добавить в избранные',
	'groups:featuredon' => 'Сделано.',
	'groups:unfeatured' => 'Убрано.',
	'groups:featured_error' => 'Ошибка.',
	'groups:joinrequest' => 'Попросить членство',
	'groups:join' => 'Вступить в группу',
	'groups:leave' => 'LПокинуть группу',
	'groups:invite' => 'Пригласить в группу',
	'groups:invite:title' => 'Пригласить в группу',
	'groups:inviteto' => "Пригласить в '%s'",
	'groups:nofriends' => "Все друзья приглашены.",
	'groups:nofriendsatall' => 'Некого приглашать!',
	'groups:viagroups' => "в группе",
	'groups:group' => "Группа",
	'groups:search:tags' => "Интересы",
	'groups:search:title' => "Искать группу по интересам: '%s'",
	'groups:search:none' => "Ничего не найдено!",

	'groups:activity' => "Активность группы",
	'groups:enableactivity' => 'Включить активность группы',
	'groups:activity:none' => "Пока нет активности",

	'groups:notfound' => "Группа не найдена",
	'groups:notfound:details' => "Запрашиваемая группа или не существует, или у Вас нет доступа к ней",

	'groups:requests:none' => 'Пока нет никаких запросов членства.',

	'groups:invitations:none' => 'There are no oustanding invitations at this time.',

	'item:object:groupforumtopic' => "Темы форума",

	'groupforumtopic:new' => "Новое сообщение для обсуждения",

	'groups:count' => "групп создано",
	'groups:open' => "открытая группа",
	'groups:closed' => "закрытая группа",
	'groups:member' => "участников",
	'groups:searchtag' => "Поиск групп по интересам",

	'groups:more' => 'Еще группы',
	'groups:none' => 'Нет групп',


	/*
	 * Access
	 */
	'groups:access:private' => 'Закрыто - только по приглашениям',
	'groups:access:public' => 'Открыто - заходи, проходи народ!',
	'groups:access:group' => 'Group members only',
	'groups:closedgroup' => 'Это закрытая группа.',
	'groups:closedgroup:request' => 'В этой групп вход только по приглашениям. Чтобы получить доступ, нажмите "Попросить членство" в ссылках меню.',
	'groups:visibility' => 'Кто может просматривать группу?',

	/*
	Group tools
	*/
	'groups:enableforum' => 'Включить форум группы',
	'groups:yes' => 'да',
	'groups:no' => 'нет',
	'groups:lastupdated' => 'Последнее обновление %s от пользователя %s',
	'groups:lastcomment' => 'Последний комментарий %s от пользователя %s',

	/*
	Group discussion
	*/
	'discussion' => 'Обсуждения',
	'discussion:add' => 'Добавить сообщение для обсуждения',
	'discussion:latest' => 'Последние обсуждения',
	'discussion:group' => 'Дискуссии группы',

	'discussion:topic:created' => 'Создано.',
	'discussion:topic:updated' => 'Обновлено.',
	'discussion:topic:deleted' => 'Удалено.',

	'discussion:topic:notfound' => 'Не найдено',
	'discussion:error:notsaved' => 'Не удалось сохранить',
	'discussion:error:missing' => 'Название и сообщение обязательно для заполнения',
	'discussion:error:permissions' => 'Недостаточно прав',
	'discussion:error:notdeleted' => 'Не удалось удалить',

	'discussion:reply:deleted' => 'Удалено.',
	'discussion:reply:error:notdeleted' => 'Не удалось удалить',

	'reply:this' => 'Ответить',

	'group:replies' => 'Сообщений',
	'groups:forum:created' => 'Создал %s с %d комментариями',
	'groups:forum:created:single' => 'Создал %s с %d ответами',
	'groups:forum' => 'Форум группы',
	'groups:addtopic' => 'Создать тему',
	'groups:forumlatest' => 'Последнее на форуме',
	'groups:latestdiscussion' => 'Последние дискуссии',
	'groups:newest' => 'Новые',
	'groups:popular' => 'Популярные',
	'groupspost:success' => 'Ваш комментарий успешно размещен.',
	'groups:alldiscussion' => 'Последние дискуссии',
	'groups:edittopic' => 'Редактировать тему',
	'groups:topicmessage' => 'Сообщение',
	'groups:topicstatus' => 'Статус темы',
	'groups:reply' => 'Комментировать',
	'groups:topic' => 'Тема',
	'groups:posts' => 'Ответы',
	'groups:lastperson' => 'Последний',
	'groups:when' => 'Когда',
	'grouptopic:notcreated' => 'Темы не созданы.',
	'groups:topicopen' => 'Открыта для обсуждения',
	'groups:topicclosed' => 'Закрыта для обсуждения',
	'groups:topicresolved' => 'Обсуждена',
	'grouptopic:created' => 'Ваша тема создана.',
	'groupstopic:deleted' => 'Ваша тема удалена.',
	'groups:topicsticky' => 'Требует нового обсуждения',
	'groups:topicisclosed' => 'Обсуждение закрыто.',
	'groups:topiccloseddesc' => 'Тема закрыта.',
	'grouptopic:error' => 'Простите, тема не может быть создана. Попробуйте снова.',
	'groups:forumpost:edited' => "Сообщение успешно отредактировано.",
	'groups:forumpost:error' => "Простите, произошла ошибка при редактировании.",


	'groups:privategroup' => 'Это личная группа, для просмотра требуется членство.',
	'groups:notitle' => 'Группы должны иметь название.',
	'groups:cantjoin' => 'Простите, невозможно вступить в группу.',
	'groups:cantleave' => 'Простите, невозможно покинуть группу.',
	'groups:removeuser' => 'Выгнать из группы',
	'groups:cantremove' => 'Извините, не могу выгнать из группы',
	'groups:removed' => '%s выгнан(а) из группы',
	'groups:addedtogroup' => 'Пользователь добавлен в группу.',
	'groups:joinrequestnotmade' => 'Простите, запрос не может быть осуществлен.',
	'groups:joinrequestmade' => 'Запрос осуществлен.',
	'groups:joined' => 'Вы вступили в группу!',
	'groups:left' => 'Вы покинули группу',
	'groups:notowner' => 'Простите, но вы не вледелец этой группы.',
	'groups:notmember' => 'Извините, но вы не участний этой группы.',
	'groups:alreadymember' => 'Вы уже состоите в этой группе!',
	'groups:userinvited' => 'Пользователь приглашен.',
	'groups:usernotinvited' => 'Простите, пользователь не может быть приглашен.',
	'groups:useralreadyinvited' => 'Пользователь уже был приглашен',
	'groups:invite:subject' => "%s you have been invited to join %s!",
	'groups:updated' => "Последнее сообщение",
	'groups:started' => "Начато пользователем",
	'groups:joinrequest:remove:check' => 'Удалить запрос приглашения?',
	'groups:invite:remove:check' => 'Удалить приглашение?',
	'groups:invite:body' => "Привет %s,

Вас пригласили вступить в группу '%s', кликните для подтверждения:

%s",

	'groups:welcome:subject' => "Добро пожаловать в группу %s!",
	'groups:welcome:body' => "Привет %s!
Вы член группы '%s'! Кликните для начала деятельности.

%s",

	'groups:request:subject' => "%s попросил вступить в группу %s",
	'groups:request:body' => "Привет %s,

%s попросил вступить в группу '%s', кликните для просмотра профиля:

%s

или нажмите для подтверждения запроса:

%s",

	/*
		Forum river items
	*/

	'river:create:group:default' => '%s создал(а) группу %s',
	'river:join:group:default' => '%s вступил(а) %s',
	'river:create:object:groupforumtopic' => '%s добавил(а) новое сообщение на форум %s',
	'river:reply:object:groupforumtopic' => '%s ответил(а) на сообщение %s',
	
	'groups:nowidgets' => 'У группы не определены элементы.',


	'groups:widgets:members:title' => 'Члены группы',
	'groups:widgets:members:description' => 'Список членов группы',
	'groups:widgets:members:label:displaynum' => 'Список членов группы',
	'groups:widgets:members:label:pleaseedit' => 'Пожалуйста, настройте этот виджет.',

	'groups:widgets:entities:title' => "Объекты в группе",
	'groups:widgets:entities:description' => "Список объектов группы",
	'groups:widgets:entities:label:displaynum' => 'Список объектов группы.',
	'groups:widgets:entities:label:pleaseedit' => 'Пожалуйста, настройте этот виджет.',

	'groups:forumtopic:edited' => 'Тема форума отредактирована.',

	'groups:allowhiddengroups' => 'Хотите вступить в подпольную группу?',

	/**
	 * Action messages
	 */
	'group:deleted' => 'Группа и все содержимое удалено',
	'group:notdeleted' => 'Удаление невозможно',

	'group:notfound' => 'Невозможно найти тему форума',
	'grouppost:deleted' => 'Сообщения группы удалены',
	'grouppost:notdeleted' => 'Удаление невозможно',
	'groupstopic:deleted' => 'Тема удалена',
	'groupstopic:notdeleted' => 'Удаление невозможно',
	'grouptopic:blank' => 'Тем нет',
	'grouptopic:notfound' => 'Невозможно найти тему форума',
	'grouppost:nopost' => 'Пусто',
	'groups:deletewarning' => "Вы уверены, что хотите удалить эту группу? Возврата не будет!",

	'groups:invitekilled' => 'Приглашение удалено.',
	'groups:joinrequestkilled' => 'Запрос приглашения отклонен.',

	// ecml
	'groups:ecml:discussion' => 'Обсуждения группы',
	'groups:ecml:groupprofile' => 'Профили группы',

);

add_translation("ru", $russian);