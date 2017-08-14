<?php

namespace Mappers;

use Models\Model;

class VariationMapper extends Mapper
{
	public function __construct()
	{
		$this->persistenceFactory = new VariationPersistenceFactory;
	}

	public function findByProductId($productId)
	{
		$identityObject = $this->persistenceFactory->getIdentityObject();
		$identityObject->field('product_id')
			->eq($productId);

		return $this->persistenceFactory->getDefferedCollection($identityObject);
	}

	protected function getCollection(array $raw)
	{
		return $this->persistenceFactory->getCollection($raw);
	}
}