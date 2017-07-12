<?php

namespace Mappers;

use Base\ApplicationRegistry;
use Models\Model;

abstract class Mapper
{
	protected static $pdo;

	protected $selectStatement;
	protected $insertStatement;
	protected $updateStatement;

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
		return $this->doCreateObject($array);
	}

	public function find($id)
	{
		$this->selectStatement->execute(array($id));
		$array = $this->selectStatement->fetch();
		$this->selectStatement->closeCursor();

		if (!is_array($array) || !isset($array[$id])) {
			return null;
		}

		return $this->createObject($array);
	}

	public function insert(Model $model)
	{
		$this->doInsert($model);
	}

	public function update(Model $model)
	{
		$this->doUpdate($model);
	}

	protected abstract function doCreateObject(array $array);
	protected abstract function doInsert(Model $model);
	protected abstract function doUpdate(Model $model);
}