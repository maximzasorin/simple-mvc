<?php

namespace Mappers;

class VariationPersistenceFactory extends PersistenceFactory
{
	public function getCollection(array $raw)
	{
		return new VariationCollection($raw, $this->getModelFactory());
	}

	public function getDefferedCollection(IdentityObject $identityObject)
	{
		return new VariationDefferedCollection($this->getModelFactory(), new DomainObjectAssembler($this), $identityObject);
	}

	public function getModelFactory()
	{
		return new VariationModelFactory;
	}

	public function getSelectionFactory()
	{
		return new VariationSelectionFactory;
	}

	public function getUpdateFactory()
	{
		return new VariationUpdateFactory;
	}

	public function getIdentityObject()
	{
		return new VariationIdentityObject;
	}
}