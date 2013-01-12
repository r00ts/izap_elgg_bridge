<?php
/**
 * Elgg log rotator language pack.
 *
 * @package ElggLogRotate
 */

$russian = array(
	'logrotate:period' => 'Как часто архивировать лог?',

	'logrotate:weekly' => 'Раз в неделю',
	'logrotate:monthly' => 'Раз в месяц',
	'logrotate:yearly' => 'Раз в год',

	'logrotate:logrotated' => "Лог прокручен\n",
	'logrotate:lognotrotated' => "Ошибка прокрутки\n",
	
	'logrotate:date' => 'Удалить архив логов за',

	'logrotate:week' => 'неделю',
	'logrotate:month' => 'месяц',
	'logrotate:year' => 'год',
		
	'logrotate:logdeleted' => "Журнал удален\n",
	'logrotate:lognotdeleted' => "Ошибка при удалении\n",
);

add_translation("ru", $russian);
