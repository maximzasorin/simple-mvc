<?php

namespace Mappers;

use Base\ApplicationRegistry;
use Models\ObjectWatcher;
use Models\Model;

abstract class Mapper
{
	protected static $pdo;

	protected $findStatement;
	protected $insertStatement;
	protected $updateStatement;
	protected $findAllStatemend;

	public function __construct()
	{
		if (!isset(self::$pdo)) {
			$config = ApplicationRegistry::instance()->get('database');
			
			$dsn = $config->driver . ':host=' . $config->host . ';dbname=' . $config->database;
			$username = $config->username;
			$password = $config->password;

			self::$pdo = new \PDO($dsn, $username, $password);
			self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
	}

	public function createObject(array $array)
	{
		$model = $this->getFromWatcher($array['id']);

		if ($model) {
			return $model;
		}

		$model = $this->doCreateObject($array);
		$model->markClean();

		$this->addToWatcher($model);

		return $model;
	}

	public function find($id)
	{
		$model = $this->getFromWatcher($id);

		if ($model) {
			return $model;
		}

		$this->findStatement->execute(array($id));
		$array = $this->findStatement->fetch();
		$this->findStatement->closeCursor();

		if (!is_array($array) || !isset($array['id'])) {
			return null;
		}

		return $this->createObject($array);
	}

	public function findAll()
	{
		$this->findAllStatement->execute();

		return $this->getCollection($this->findAllStatement->fetchAll(\PDO::FETCH_ASSOC));
	}

	public function insert(Model $model)
	{
		$this->doInsert($model);
		$this->addToWatcher($model);
	}

	public function update(Model $model)
	{
		$this->doUpdate($model);
	}

	public function delete(Model $model)
	{
		$this->doDelete($model);
		$this->deleteFromObjectWatcher($model);
	}

	protected function getFromWatcher($id)
	{
		return ObjectWatcher::get($this->targetClass(), $id);
	}

	protected function addToWatcher(Model $model)
	{
		ObjectWatcher::add($model);
	}

	protected function deleteFromObjectWatcher(Model $model)
	{
		ObjectWatcher::delete($model);
	}

	protected abstract function targetClass();

	protected abstract function doCreateObject(array $array);
	protected abstract function doInsert(Model $model);
	protected abstract function doUpdate(Model $model);
	protected abstract function doDelete(Model $model);
}