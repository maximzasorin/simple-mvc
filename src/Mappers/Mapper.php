<?php

namespace Mappers;

abstract class Mapper
{
	public function find($id)
	{

	}

	abstract protected function select();
}