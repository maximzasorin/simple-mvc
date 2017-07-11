<?php

namespace Mappers;

use Base\ApplicationRegistry;

abstract class Mapper
{
	protected static $pdo;

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

	}

	// abstract protected function select();
}