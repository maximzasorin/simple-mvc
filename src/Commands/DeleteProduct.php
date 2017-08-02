<?php

namespace Commands;

use Http\Request;

use Models\ObjectWatcher;
use Models\Product;
use Mappers\ProductMapper;

class DeleteProduct extends Command
{
	public function execute(Request $request)
	{
		$productMapper = new ProductMapper;
		$product = $productMapper->find($request->getProperty('id'));
		
		if ($product) {
			$product->markDelete();
		}

		ObjectWatcher::instance()->performOperations();

		$product = $productMapper->find($request->getProperty('id'));

		var_dump($product);
	}
}