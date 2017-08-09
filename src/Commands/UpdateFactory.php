<?php

namespace Commands;

use Http\Request;

use Models\Product;
use Mappers\ProductMapper;

use Mappers\ProductUpdateFactory;

class UpdateFactory extends Command
{
	public function execute(Request $request)
	{
		$productMapper = new ProductMapper;
		$product = $productMapper->find($request->getProperty('id'));
		$productUpdateFactory = new ProductUpdateFactory;

		// Update
		if ($product) {

			$updateQuery = $productUpdateFactory->newUpdate($product);
			var_dump($updateQuery);
		}

		// Insert
		$insertQuery = $productUpdateFactory->newUpdate(new Product);
		var_dump($insertQuery);
	}
}