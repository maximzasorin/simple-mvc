<?php

namespace Mappers;

class ProductPersistenceFactory extends PersistenceFactory
{
	public function getCollection(array $raw)
	{
		return new ProductCollection($raw, $this->getModelFactory());
	}

	public function getModelFactory()
	{
		return new ProductModelFactory;
	}
}