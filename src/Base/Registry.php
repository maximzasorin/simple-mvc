<?php

namespace Base;

abstract class Registry
{
	abstract public function get($key);
	abstract public function set($key, $value);
}