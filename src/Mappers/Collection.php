<?php

namespace Mappers;

abstract class Collection implements \Iterator
{
	protected $mapper;
	protected $total = 0;
	protected $raw = [];

	protected $result;
	protected $pointer = 0;
	protected $objects = [];

	public function __construct(array $raw = null, Mapper $mapper = null)
	{
		if ($raw && $mapper) {
			$this->raw = $raw;
			$this->count = count($raw);
		}

		$this->mapper = $mapper;
	}

	protected function getRaw($index)
	{
		if (isset($this->objects[$index])) {
			return $this->objects[$index];
		}

		if (isset($this->raw[$index])) {
			$this->objects[$index] = $this->mapper->createObject($this->raw[$index]);

			return $this->objects[$index];
		}
	}

	public function rewind()
	{
		$this->pointer = 0;
	}

	public function current()
	{
		return $this->getRaw($this->pointer);
	}

	public function key()
	{
		return $this->pointer;
	}

	public function next()
	{
		$this->pointer++;

		return $this->getRaw($this->pointer);
	}

	public function valid()
	{
		return !is_null($this->current());
	}
}