<?php

namespace Commands;

use Http\Request;

class Index extends Command
{
	public function execute(Request $request)
	{
		require realpath(__DIR__ . '/../Views/Commands/Index.php');
	}
}