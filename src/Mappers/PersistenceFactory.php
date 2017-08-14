<?php

namespace Mappers;

abstract class PersistenceFactory
{
	abstract public function getCollection(array $raw);
	abstract public function getDefferedCollection(IdentityObject $identityObject);
	abstract public function getModelFactory();
	abstract public function getSelectionFactory();
	abstract public function getUpdateFactory();
	abstract public function getDeleteFactory();
	abstract public function getIdentityObject();
}
