<?php

namespace Http;

class Request
{
	protected $request = [];
	protected $path = '/';

	public function __construct()
	{
		$this->request = $_REQUEST;

		$url = parse_url($_SERVER['REQUEST_URI']);
		$this->path = isset($url['path'])
			? $url['path']
			: '/';
	}

	public function getPath()
	{
		return $this->path;
	}

	public function getProperty($property)
	{
		if (isset($this->request[$property])) {
			return $this->request[$property];
		}

		return null;
	}
}