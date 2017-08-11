<?php

namespace Mappers;

class VariationDefferedCollection extends VariationCollection
{
	protected $domainObjectAssembler;
	protected $identityObject;
	protected $run = false;

	public function __construct(ModelFactory $modelFactory, DomainObjectAssembler $domainObjectAssembler, VariationIdentityObject $identityObject)
	{
		parent::__construct(null, $modelFactory);

		$this->domainObjectAssembler = $domainObjectAssembler;
		$this->identityObject = $identityObject;
	}

	protected function notifyAccess()
	{
		if (!$this->run) {
			$this->raw = $this->domainObjectAssembler->findRaw($this->identityObject);
			$this->total = count($this->raw);
		}

		$this->run = true;
	}
}