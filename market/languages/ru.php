<?php
/**
 * Elgg Market plugin
 * @license: GPL v 2.
 * @author slyhne
 * @copyright Zurf.dk
 * @link http://zurf.dk/elgg
 */
	$russian = array(
	
	/**
	 * Menu items and titles
	 */
	
	'market' => "Супермаркет пост",
	'market:posts' => "Супермаркет cообщения",
	'market:title' => "Супермаркет",
	'market:user' => "%s's Сообщения на Супермаркетe",
	'market:user:link' => "%s's Супермаркет",
	'market:user:friends' => "%s's Сообщения друзей на Супермаркете ",
	'market:your' => "Ваши Товары",
	'market:your:title' => "Ваши Товары на Супермаркете",
	'market:posttitle' => "%s's Номер на Супермаркете: %s",
	'market:friends' => "Товары друзей",
	'market:yourfriends' => "Товары друзей на Супермаркете",
	'market:everyone:title' => "Все на Супермаркете",
	'market:everyone' => "Все  Товары",
	'market:read' => "Посмотреть сообщение",
	'market:addpost' => "Создать новое сообщение о товаре",
	'market:addpost:title' => "Создание нового рекламного поста о товаре на Супермаркете",
	'market:editpost' => "Изменить сообщение",
	'market:imagelimitation' => "Должен быть JPG, GIF или PNG.",
	'market:text' => "Дайте краткое описание товара",
	'market:uploadimages' => "Хотели бы Вы,загрузить изображение для вашего товара?",
	'market:image' => "Изображение товара",
	'market:imagelater' => "",
	'market:strapline' => "Создано",
	'item:object:market' => 'Сообщенние Супермаркета',


	/**
	* market widget
	**/
	'market:widget' => "Мой Супермаркет",
	'market:widget:description' => "Ваши товары на Супермаркете",
	'market:widget:viewall' => "Просмотреть все мои товары на Супермаркете",
	'market:num_display' => "Количество товаров для отображения",
	'market:icon_size' => "Размер иконки",
	'market:small' => "Малый",
	'market:tiny' => "Крошечный",
		
	/**
	* market river
	**/
	        
	//generic terms to use
        'market:river:created' => "%s писал",
        'market:river:updated' => "%s обновлено",
        'market:river:posted' => "%s сообщение",
        //these get inserted into the river links to take the user to the entity
        'market:river:create' => "Новый рекламный пост о товаре под названием",
        'market:river:update' => "Сообщение о товаре под названием",
        'market:river:annotate' => "Ответ на  сообщение о товаре под названием",
	
	/**
	* Status messages
	*/
	'market:posted' => "Ваше  сообщение было успешно отправлено.",
	'market:deleted' => "Ваш  пост был успешно удален.",
	'market:uploaded' => "Ваше изображение было успешно добавлено.",

	/**
	* Error messages
	*/
	
	'market:save:failure' => "Ваше сообщение не может быть сохранено. Пожалуйста, попробуйте еще раз.",
	'market:blank' => "Извините, вы должны заполнить оба поля , прежде чем вы можете опубликовать сообщение.",
	'market:tobig' => "Извините, ваш файл больше, чем 1 Мб, пожалуйста, загрузите файл меньшего размера.",
	'market:notjpg' => "Пожалуйста, убедитесь, что картинка в формате. JPG,. PNG или. GIF .",
	'market:notuploaded' => "Извините, ваш файл не найден, для загрузки.",
	'market:notfound' => "К сожалению, мы не смогли найти указанный пост Супермаркета.",
	'market:notdeleted' => "К сожалению, мы не могли удалить это сообщение Супермаркета.",
	'market:tomany' => "Ошибка: Слишком много сообщений ",
	'market:tomany:text' => "Вы достигли максимального количества сообщений . Пожалуйста, удалите часть!",
	'market:accept:terms:error' => "Вы должны принять условия использования!",

	/**
	* Settings
	*/
	'market:max:posts' => "Максимальное количество сообщений   пользователя:",
	'market:unlimited' => "Безлимитно",
	'market:allowhtml' => "Разрешить HTML в  сообщении:",
	'market:numchars' => "Максимальное количество символов в сообщении (действительно только без HTML):",
	'market:pmbutton' => "Включить кнопку частное сообщение:",
	'market:adminonly' => "Только администратор может создать сообщение:",
	'market:comments' => "Разрешить комментарии:",

	/**
	* Tweeks new version
	*/
	'market:pmbuttontext' => "Отправить личное сообщение",
	'market:price' => "Цена",
	'market:price:help' => "(Например, 200EUR)",
	'market:text:help' => "(Без HTML и макс. 250 символов)",
	'market:title:help' => "(1-3 слова)",
	'market:tags' => "Метки",
	'market:tags:help' => "(Отдельны запятыми)",
	'market:access:help' => "(Кто может видеть это сообщение)",
	'market:replies' => "Ответы",
	'market:created:gallery' => "Создан %s <br> %s",
	'market:created:listing' => "Создан %s  %s",
	'market:showbig' => "Показать более широкую картинку",
	'market:type' => "Тип",
	'market:charleft' => "Символов",
	'market:accept:terms' => "Я прочел и принял %s правила пользования.",
	'market:terms' => "Термины",
	'market:terms:title' => "Условия использования",
	'market:terms' =>	"<li>Супермаркет для покупки или продажи между его членами.</li>
			<li>Не больше, чем  %s сообщений разрешено пользователю в определенное время.</li>
			<li>Только одно сообщение .</li>
			<li>Сообщение может содержать только один элемент.</li>
			<li>Только подержанные товары.</li>
			<li>Сообщение должно быть удалено, когда оно больше не актуально.</li>
			<li>Коммерческая реклама ограничивается  рекламным договором с нами.</li>
			<li>Мы оставляем за собой право удалять любые сообщения ,которые нарушают наши условия использования.</li>
			<li>Условия могут быть изменены с течением времени..</li>
			",

		// market categories
		'market:categories' => 'Супермаркет категории',
		'market:categories:choose' => 'Выберите тип',
		'market:categories:settings' => 'Супермаркет Категории:',	
		'market:categories:explanation' => 'Установить некоторые предопределенные категории для размещения на Супермаркете .Категории Супермаркета например : одежда, рынка: обувь или ...: покупать, : продать и т.д. ..", отдельно каждая категория с запятыми - не забудьте положить их в языковой файл',	
		'market:categories:save:success' => 'Категории сайта Супермаркет были успешно сохранены.',
		'market:categories:settings:categories' => 'Супермаркет Категории',
		'market:all:categories' => "Все категории",
		'market:category' => "Категория : %s",

		/**
		 * Categories
		 */
		 'market:buy' => "Покупка",
		 'market:sell' => "Продажа",
		 'market:swap' => "Своп",
		 'market:free' => "Свободный",

		/**
		 * Custom select
		 */
		'market:custom:select' => "Состояние",
		'market:custom:text' => "Состояние",
		'market:custom:activate' => "Известные поставщики Выберите:",
		'market:custom:settings' => "Другой вариант Выберите:",
		'market:custom:choices' => "Установить несколько готовых вариантов пользовательских настроек выпадающее меню .<br>Можете выбрать \"новые, рыночные: использованные ... и т.д.\", разделите их запятыми  - не забудьте положить их в языковой файл",

		/**
		 * Custom choises
		 */
		 'market:na' => "Нет информации",
		 'market:new' => "Новый",
		 'market:unused' => "Неиспользуемые",
		 'market:used' => "Используемые",
		 'market:good' => "Хорошо",
		 'market:fair' => "Ярмарка",
		 'market:poor' => "Дешево",
	);
					
	add_translation("ru",$russian);

?>
