<?php

namespace Commands;

use Http\Request;

use Mappers\ProductMapper;

class ObjectWatcher extends Command
{
	public function execute(Request $request)
	{
		$productId = $request->getProperty('id');

		$productMapper = new ProductMapper;
		$product1 = $productMapper->find($productId);
		$product2 = $productMapper->find($productId);

		var_dump($product1 === $product2);
	}
}