<?php

namespace Commands;

use Http\Request;

use Mappers\ProductMapper;

class Product extends Command
{
	public function execute(Request $request)
	{
		$productMapper = new ProductMapper;
		$product = $productMapper->find($request->getProperty('id'));

		print json_encode($product->transform());
	}
}