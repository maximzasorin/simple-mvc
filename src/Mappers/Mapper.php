<?php

namespace Mappers;

use Base\ApplicationRegistry;
use Models\Model;

abstract class Mapper
{
	protected $persistenceFactory;

	protected $findStatement;
	protected $insertStatement;
	protected $updateStatement;
	protected $findAllStatemend;

	public function find($id)
	{
		$model = $this->persistenceFactory->getModelFactory()->getFromWatcher($id);

		if ($model) {
			return $model;
		}

		$identityObject = $this->persistenceFactory->getIdentityObject();
		$identityObject
			->field('id')
			->eq($id);

		$domainObjectAssembler = new DomainObjectAssembler($this->persistenceFactory);

		return $domainObjectAssembler->findOne($identityObject);
	}

	public function findAll()
	{
		$identityObject = $this->persistenceFactory->getIdentityObject();
		$domainObjectAssembler = new DomainObjectAssembler($this->persistenceFactory);

		return $domainObjectAssembler->find($this->persistenceFactory->getIdentityObject());
	}

	public function insert(Model $model)
	{
		$domainObjectAssembler = new DomainObjectAssembler($this->persistenceFactory);
		$domainObjectAssembler->insert($model);

		$this->persistenceFactory->getModelFactory()->addToWatcher($model);
	}

	public function update(Model $model)
	{
		$domainObjectAssembler = new DomainObjectAssembler($this->persistenceFactory);
		$domainObjectAssembler->insert($model);
	}

	public function delete(Model $model)
	{
		$this->doDelete($model);
		$this->persistenceFactory->getModelFactory()->deleteFromWatcher($model);
	}
}