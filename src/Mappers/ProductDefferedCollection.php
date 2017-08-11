<?php

namespace Mappers;

class ProductDefferedCollection extends VariationCollection
{
	protected $identityObject;
	protected $run = false;

	public function __construct(ModelFactory $modelFactory, DomainObjectAssembler $domainObjectAssembler, ProductIdentityObject $identityObject)
	{
		parent::__construct(null, $modelFactory);

		$this->identityObject = $identityObject;
	}

	protected function notifyAccess()
	{
		if (!$this->run) {
			$this->raw = $domainObjectAssembler->findRaw($this->identityObject);
			$this->total = count($this->raw);
		}

		$this->run = true;
	}
}