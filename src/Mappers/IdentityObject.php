<?php

namespace Mappers;

class IdentityObject
{
	protected $fields = array();
	protected $currentField = null;

	protected $objectFields = array();

	public function __construct($fieldName = null, array $objectFields = null)
	{
		if ($fieldName) {
			$this->field($fieldName);
		}

		if ($objectFields) {
			$this->objectFields = $objectFields;
		}
	}

	public function field($fieldName)
	{
		// Проверяем, что текущее обрабатываемое поле заполнено
		if (!$this->isVoid() && $this->currentField->isIncomplete())
		{
			throw new \Exception('Field not filled.');
		}

		// Проверяем, что поле присутствует в списке полей
		if (!empty($this->objectFields) && !in_array($fieldName, $this->objectFields)) {
			throw new \Exception('Field not exists.');
		}

		if (!isset($this->fields[$fieldName])) {
			$this->fields[$fieldName] = new Field($fieldName);
		}

		$this->currentField = $this->fields[$fieldName];

		return $this;
	}

	public function eq($value)
	{
		$this->currentField->addTest('=', $value);

		return $this;
	}

	public function gt($value)
	{
		$this->currentField->addTest('>', $value);

		return $this;
	}

	public function lt($value)
	{
		$this->currentField->addTest('<', $value);

		return $this;
	}

	// public function getFields()
	// {
	// 	return $this->fields;
	// }

	// public function getObjectFields()
	// {
	// 	return $this->objectFields;
	// }

	public function getComps()
	{
		$comps = [];

		foreach ($this->fields as $field) {
			$comps = array_merge($comps, $field->getComps());
		}

		return $comps;
	}

	protected function isVoid()
	{
		return empty($this->fields);
	}
}