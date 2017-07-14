<?php

namespace Models;

class ObjectWatcher
{
	protected $all = [];

	protected static $instance = null;

	protected function __construct()
	{
		// Закрываем конструктор для синглтона
	}

	public static function instance()
	{
		if (!self::$instance) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public static function add(Model $model)
	{
		self::instance()->all[self::instance()->globalKey($model)] = $model;
	}

	public static function get($className, $id)
	{
		$key = $className . '_' . $id;

		if (isset(self::instance()->all[$key])) {
			return self::instance()->all[$key];
		}


		return null;
	}

	public function globalKey(Model $model)
	{
		return get_class($model) . '_' . $model->getId();
	}
}