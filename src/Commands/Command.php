<?php

namespace Commands;

use Http\Request;

abstract class Command
{
	abstract public function execute(Request $request);
}