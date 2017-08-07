<?php

namespace Mappers;

abstract class PersistenceFactory
{
	abstract public function getCollection(array $raw);
	abstract public function getModelFactory();
}
