<?php

namespace Mappers;

use Base\ApplicationRegistry;
use Models\Model;

abstract class Mapper
{
	protected static $pdo;

	protected $persistenceFactory;

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

	public function find($id)
	{
		$model = $this->persistenceFactory->getModelFactory()->getFromWatcher($id);

		if ($model) {
			return $model;
		}

		$this->findStatement->execute(array($id));
		$array = $this->findStatement->fetch();
		$this->findStatement->closeCursor();

		if (!is_array($array) || !isset($array['id'])) {
			return null;
		}

		return $this->persistenceFactory->getModelFactory()->createObject($array);
	}

	public function findAll()
	{
		$this->findAllStatement->execute();

		return $this->getCollection($this->findAllStatement->fetchAll(\PDO::FETCH_ASSOC));
	}

	public function insert(Model $model)
	{
		$this->doInsert($model);
		$this->persistenceFactory->getModelFactory()->addToWatcher($model);
	}

	public function update(Model $model)
	{
		$this->doUpdate($model);
	}

	public function delete(Model $model)
	{
		$this->doDelete($model);
		$this->persistenceFactory->getModelFactory()->deleteFromWatcher($model);
	}

	protected abstract function doInsert(Model $model);
	protected abstract function doUpdate(Model $model);
	protected abstract function doDelete(Model $model);
}