<?php
	/**
	 * Elgg diagnostics language pack.
	 *
	 * @package ElggDiagnostics
	 */

	$russian = array(

			'admin:utilities:diagnostics' => 'Диагностика системы',
			'diagnostics' => 'Диагностика системы',
			'diagnostics:report' => 'Диагностические отчеты',
			'diagnostics:unittester' => 'Диагностические проверки',

			'diagnostics:description' => 'Этот отчет о диагностике полезен для диагностирования проблем Elgg и должен быть приложен к любому сообщаемому багу.',
			'diagnostics:unittester:description' => 'Это диагностические проверки, которые регистрируются плагинами и выполняются для обнаружения багов в Elgg.',

			'diagnostics:unittester:description' => 'Unit tests check Elgg Core for broken or buggy APIs.',
			'diagnostics:unittester:debug' => 'Вы должны включить режим отладки, чтобы запустить диагностическую проверку.',
			'diagnostics:unittester:warning' => 'WARNING: These tests can leave behind debugging objects in your database.<br />DO NOT USE ON A PRODUCTION SITE!',

			'diagnostics:test:executetest' => 'Запустить проверку',
			'diagnostics:test:executeall' => 'Запустить все',
			'diagnostics:unittester:notests' => 'Простите, для проверки нет установленных модулей.',
			'diagnostics:unittester:testnotfound' => 'Простите, отчет не может быть создан, т.к. эта проверка не была найдена.',

			'diagnostics:unittester:testresult:nottestclass' => 'FAIL - результат не является классом проверки',
			'diagnostics:unittester:testresult:fail' => 'FAIL',
			'diagnostics:unittester:testresult:success' => 'ГОТОВО',

			'diagnostics:unittest:example' => 'Образец проверки, доступно только в debug-режиме.',

			'diagnostics:unittester:report' => 'Отчет о проверке для %s',

			'diagnostics:download' => 'Скачать .txt',


			'diagnostics:header' => '========================================================================
Elgg Diagnostic Report
Generated %s by %s
========================================================================

',
			'diagnostics:report:basic' => '
Elgg релиз %s, версия %s
------------------------------------------------------------------------',
			'diagnostics:report:php' => '
PHP-сведения:
%s
------------------------------------------------------------------------',
			'diagnostics:report:plugins' => '
Установленные плагины и детали:

%s
------------------------------------------------------------------------',
			'diagnostics:report:md5' => '
Установленные файлы и их сумма:

%s
------------------------------------------------------------------------',
			'diagnostics:report:globals' => '
Глобальные переменные:

%s
------------------------------------------------------------------------',

	);

	add_translation("ru",$russian);
?>