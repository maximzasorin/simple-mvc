<?php

namespace Mappers;

class VariationPersistenceFactory extends PersistenceFactory
{
	public function getCollection(array $raw)
	{
		return new VariationCollection($raw, $this->getModelFactory());
	}

	public function getModelFactory()
	{
		return new VariationModelFactory;
	}
}