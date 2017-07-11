<?php

namespace Commands;

use Http\Request;

class NotFound extends Command
{
	public function execute(Request $request)
	{
		require realpath(__DIR__ . '/../Views/Commands/NotFound.php');
	}
}