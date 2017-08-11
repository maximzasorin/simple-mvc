<?php

namespace Mappers;

use Models\Model;

class ProductMapper extends Mapper
{
	public function __construct()
	{
		$this->persistenceFactory = new ProductPersistenceFactory;
	}

	protected function getCollection(array $raw)
	{
		return $this->persistenceFactory->getCollection($raw);
	}
}