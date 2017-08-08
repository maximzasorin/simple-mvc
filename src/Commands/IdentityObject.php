<?php

namespace Commands;

use Http\Request;

use Mappers\ProductIdentityObject;
use Mappers\VariationIdentityObject;

class IdentityObject extends Command
{
	public function execute(Request $request)
	{
		$productIdentityObject = new ProductIdentityObject;
		$productIdentityObject
			->field('name')->eq('Test');

		print json_encode($productIdentityObject->getComps(), JSON_PRETTY_PRINT);
		print "\n\n";

		$variationIdentityObject = new VariationIdentityObject;
		$variationIdentityObject
			->field('name')->eq('Test')
			->field('price')->gt(1000)
			->field('price')->lt(5000);

		print json_encode($variationIdentityObject->getComps(), JSON_PRETTY_PRINT);
	}
}