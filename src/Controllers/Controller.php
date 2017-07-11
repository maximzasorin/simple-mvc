<?php

namespace Controllers;

use Http\Request;
use Commands\CommandResolver;

class Controller
{
	public function init()
	{
		$this->handleRequest();
	}

	public function handleRequest()
	{
		$request = new Request;
		$commandResolver = new CommandResolver;

		$command = $commandResolver->getCommand($request);
		$command->execute($request);
	}
}