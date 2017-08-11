<?php

namespace Mappers;

use Base\ApplicationRegistry;
use Models\Model;

class DomainObjectAssembler
{
    protected static $pdo;
    protected $persistenceFactory;
    protected $statements = [];

    public function __construct(PersistenceFactory $persistenceFactory)
    {
        $this->persistenceFactory = $persistenceFactory;

        if (!isset(self::$pdo)) {
            $config = ApplicationRegistry::instance()->get('database');
            
            $dsn = $config->driver . ':host=' . $config->host . ';dbname=' . $config->database;
            $username = $config->username;
            $password = $config->password;

            self::$pdo = new \PDO($dsn, $username, $password);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }

    public function getStatement($query)
    {
        if (!isset($this->statements[$query])) {
            $this->statements[$query] = self::$pdo->prepare($query);
        }

        return $this->statements[$query];
    }

    public function findOne(IdentityObject $identityObject)
    {
        $collection = $this->find($identityObject);

        return $collection->getGenerator()->current();
    }

    public function find(IdentityObject $identityObject)
    {
        $raw = $this->findRaw($identityObject);
        return $this->persistenceFactory->getCollection($raw);
    }

    public function findRaw(IdentityObject $identityObject)
    {
        $selectionFactory = $this->persistenceFactory->getSelectionFactory();
        list($query, $values) = $selectionFactory->newInstance($identityObject);

        $statement = $this->getStatement($query);
        $statement->execute($values);
        $raw = $statement->fetchAll();

        return $raw;
    }

    public function insert(Model $model)
    {
    	$updateFactory = $this->persistenceFactory->getUpdateFactory();
        list($query, $values) = $updateFactory->newUpdate($model);

        $statement = $this->getStatement($query);
        $statement->execute($values);

        if (!$model->getId()) {
            $model->setId(self::$pdo->lastInsertId());
        }

        $model->markClean();
    }
}