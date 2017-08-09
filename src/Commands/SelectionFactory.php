<?php

namespace Commands;

use Http\Request;

use Mappers\ProductIdentityObject;
use Mappers\ProductSelectionFactory;

class SelectionFactory extends Command
{
	public function execute(Request $request)
	{
		$productIdentityObject = new ProductIdentityObject;
		$productIdentityObject
			->field('name')->eq('Test');

		$productSelectionFactory = new ProductSelectionFactory;

		$selectionQuery = $productSelectionFactory->newInstance($productIdentityObject);
		var_dump($selectionQuery);
	}
}