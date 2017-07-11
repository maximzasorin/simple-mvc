<?php

namespace Commands;

use Http\Request;

class CommandResolver
{
	protected $defaultCommand = 'Commands\\NotFound';

	public function getCommand(Request $request)
	{
		try {
			$commandName = $request->getProperty('command');
			$commandReflection = new \ReflectionClass('Commands\\' . $commandName);
		} catch (\ReflectionException $exception) {
			$commandReflection = new \ReflectionClass($this->defaultCommand);
		}

		return $commandReflection->newInstance();
	}
}