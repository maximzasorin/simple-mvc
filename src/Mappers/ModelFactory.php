<?php

namespace Mappers;

use Models\Model;
use Models\ObjectWatcher;

abstract class ModelFactory
{
	public function createObject(array $array)
	{
		$model = $this->getFromWatcher($array['id']);

		if ($model) {
			return $model;
		}

		$model = $this->doCreateObject($array);
		$model->markClean();

		$this->addToWatcher($model);

		return $model;
	}

	public function getFromWatcher($id)
	{
		return ObjectWatcher::get($this->targetClass(), $id);
	}

	public function addToWatcher(Model $model)
	{
		ObjectWatcher::add($model);
	}

	public function deleteFromWatcher(Model $model)
	{
		ObjectWatcher::delete($model);
	}

	abstract public function targetClass();

	abstract protected function doCreateObject(array $array);
}
