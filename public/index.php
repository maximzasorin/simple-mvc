<?php

// Автозагрузка
spl_autoload_register(function($className) {
	$fileName = str_replace('\'', DIRECTORY_SEPARATOR, $className);
	$fileName = realpath('../src/' . $fileName . '.php');

	if (file_exists($fileName)) {
		require_once($fileName);
	}
});

// Настройки
$applicationHelper = Helpers\ApplicationHelper::instance();
$applicationHelper->init();

// Фронт-контроллер
$controller = new Controllers\Controller;
$controller->init();