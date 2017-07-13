<?php

namespace Commands;

use Http\Request;

class CommandResolver
{
	protected $notFoundCommand = 'NotFound';
	
	protected $indexCommand = 'Index';

	public function getCommand(Request $request)
	{
		try {
			$commandName = substr(strtolower($request->getPath()), 1);

			if (!$commandName) {
				$commandName = $this->indexCommand;
			}

			$commandReflection = new \ReflectionClass('Commands\\' . $commandName);
		} catch (\ReflectionException $exception) {
			$commandReflection = new \ReflectionClass('Commands\\' . $this->notFoundCommand);
		}

		return $commandReflection->newInstance();
	}
}