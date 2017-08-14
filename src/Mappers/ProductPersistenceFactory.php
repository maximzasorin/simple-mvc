<?php

namespace Mappers;

class ProductPersistenceFactory extends PersistenceFactory
{
	public function getCollection(array $raw)
	{
		return new ProductCollection($raw, $this->getModelFactory());
	}

	public function getDefferedCollection(IdentityObject $identityObject)
	{
		return new ProductDefferedCollection($this->getModelFactory(), new DomainObjectAssembler($this), $identityObject);
	}

	public function getModelFactory()
	{
		return new ProductModelFactory;
	}

	public function getSelectionFactory()
	{
		return new ProductSelectionFactory;
	}

	public function getUpdateFactory()
	{
		return new ProductUpdateFactory;
	}

	public function getDeleteFactory()
	{
		return new ProductDeleteFactory;
	}

	public function getIdentityObject()
	{
		return new ProductIdentityObject;
	}
}