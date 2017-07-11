<?php

namespace Models;

class Model
{
	protected static function getCollection($type)
	{
		return [];
	}

	protected function collection()
	{
		return self::getCollection(get_class($this));
	}
}