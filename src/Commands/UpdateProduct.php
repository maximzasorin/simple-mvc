<?php

namespace Commands;

use Http\Request;

use Models\ObjectWatcher;
use Models\Product;
use Mappers\ProductMapper;

class UpdateProduct extends Command
{
	public function execute(Request $request)
	{
		$productMapper = new ProductMapper;
		$product = $productMapper->find($request->getProperty('id'));

		if ($product) {
			$product->setName('Updated product');
		}

		ObjectWatcher::instance()->performOperations();
	}
}