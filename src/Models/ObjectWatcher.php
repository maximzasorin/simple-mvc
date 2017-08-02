<?php

namespace Models;

class ObjectWatcher
{
	protected $all = [];
	protected $dirty = [];
	protected $new = [];
	protected $delete = [];

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

	public function delete($model)
	{
		unset(self::instance()->all[self::instance()->globalKey($model)]);
		$model->markClean();
	}

	static public function addNew(Model $model)
	{
		$instance = self::instance();
		$instance->new[] = $model;
	}

	static public function addDirty(Model $model)
	{
		$instance = self::instance();

		if (!in_array($model, $instance->new, true)) {
			$instance->dirty[$instance->globalKey($model)] = $model;
		}
	}

	static public function addDelete(Model $model)
	{
		$instance = self::instance();
		$instance->delete[$instance->globalKey($model)] = $model;
	}

	static public function addClean(Model $model)
	{
		$instance = self::instance();

		unset($instance->delete[$instance->globalKey($model)]);
		unset($instance->dirty[$instance->globalKey($model)]);

		$instance->new = array_filter($instance->new, function ($a) use ($model) {
			return $a !== $model;
		});
	}

	public function globalKey(Model $model)
	{
		return get_class($model) . '_' . $model->getId();
	}

	public function performOperations()
	{
		foreach ($this->dirty as $model) {
			$model->finder()->update($model);
		}

		foreach ($this->new as $model) {
			$model->finder()->insert($model);
		}

		foreach ($this->delete as $model) {
			$model->finder()->delete($model);
		}

		$this->new = [];
		$this->dirty = [];
		$this->delete = [];
	}
}