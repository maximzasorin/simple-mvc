<?php

namespace Base;

class ApplicationRegistry extends Registry
{
	static protected $instance = null;

	protected $values;

	static public function instance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function get($key)
	{
		return isset($this->values[$key])
			? $this->values[$key]
			: null;
	}

	public function set($key, $value)
	{
		$this->values[$key] = $value;
	}
}