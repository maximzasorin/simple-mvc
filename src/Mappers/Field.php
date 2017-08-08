<?php

namespace Mappers;

class Field
{
	protected $name;
	protected $comps;

	public function __construct($name)
	{
		$this->name = $name;
	}

	public function getComps()
	{
		return $this->comps;
	}

	public function addTest($operator, $value)
	{
		$this->comps[] = array(
			'name' => $this->name,
			'operator' => $operator,
			'value' => $value
		);
	}

	public function isIncomplete()
	{
		return empty($this->comps);
	}
}