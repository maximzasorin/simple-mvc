<?php

namespace Mappers;

use Models\Model;

abstract class Collection
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
			$this->total = count($raw);
		}

		$this->mapper = $mapper;
	}

	public function getGenerator()
	{
		$this->notifyAccess();

		for ($index = 0; $index < $this->total; $index++) {
			yield $this->getRow($index);
		}
	}

	public function add(Model $model)
	{
		$class = $this->targetClass();

		if (!($model instanceof $class)) {
			throw \Exception("Model not instance of {$class}");
		}

		$this->notifyAccess();
		$this->objects[$this->total] = $object;
		$this->total++;
	}

	abstract public function targetClass();

	protected function notifyAccess()
	{
		// Метод оставлен пустым и может переопределяться в потомках
		// для отложенного обращения к БД
	}

	protected function getRow($index)
	{
		if (isset($this->objects[$index])) {
			return $this->objects[$index];
		}

		if (isset($this->raw[$index])) {
			$this->objects[$index] = $this->mapper->createObject($this->raw[$index]);

			return $this->objects[$index];
		}

		return null;
	}
}