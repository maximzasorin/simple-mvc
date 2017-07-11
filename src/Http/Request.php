<?php

namespace Http;

class Request
{
	protected $request = array();

	public function __construct()
	{
		$this->request = $_REQUEST;
	}

	public function getProperty($property)
	{
		if (isset($this->request[$property])) {
			return $this->request[$property];
		}

		return null;
	}
}