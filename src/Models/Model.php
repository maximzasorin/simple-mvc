<?php

namespace Models;

class Model
{
	protected $id;

	public function __construct($id = null)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	protected static function getCollection($type)
	{
		return [];
	}

	protected function collection()
	{
		return self::getCollection(get_class($this));
	}
}