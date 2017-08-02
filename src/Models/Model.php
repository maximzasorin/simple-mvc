<?php

namespace Models;

use Base\HelperFactory;

class Model
{
	protected $id;

	public function __construct($id = null)
	{
		if (!$id) {
			$this->markNew();
		} else {
			$this->id = $id;
		}
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function markNew()
	{
		ObjectWatcher::addNew($this);
	}

	public function markDirty()
	{
		ObjectWatcher::addDirty($this);
	}

	public function markClean()
	{
		ObjectWatcher::addClean($this);
	}

	public function markDelete()
	{
		ObjectWatcher::addDelete($this);
	}

	static public function getFinder($type = null)
	{
		if (!$type) {
			return HelperFactory::getFinder(get_called_class());
		}

		return HelperFactory::getFinder($type);
	}

	public function finder()
	{
		return self::getFinder(get_class($this));
	}

	protected static function getCollection($type = null)
	{
		if (!$type) {
			return HelperFactory::getCollection(get_called_class());
		}

		return HelperFactory::getCollection($type);
	}

	public function collection()
	{
		return self::getCollection(get_class($this));
	}
}