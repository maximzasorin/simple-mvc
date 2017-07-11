<?php

namespace Helpers;

class ApplicationHelper
{
	static protected $instance = null;

	protected $configFile = __DIR__ . '/../../config.json';
	protected $config;

	static public function instance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function init()
	{
		$this->fetchConfig();
	}

	protected function fetchConfig()
	{
		$this->config = json_decode(file_get_contents($this->configFile));
	}
}