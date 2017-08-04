<?php

namespace Mappers;

class DefferedVariationCollection extends VariationCollection
{
	protected $statement;
	protected $array;
	protected $run = false;

	public function __construct(Mapper $mapper, \PDOStatement $statement, array $array)
	{
		parent::__construct(null, $mapper);

		$this->statement = $statement;
		$this->array = $array;
	}

	protected function notifyAccess()
	{
		if (!$this->run) {
			$this->statement->execute($this->array);
			$this->raw = $this->statement->fetchAll();
			$this->total = count($this->raw);
		}

		$this->run = true;
	}
}