<?php

namespace Commands;

use Http\Request;

use Mappers\ProductMapper;

class Products extends Command
{
	public function execute(Request $request)
	{
		$productMapper = new ProductMapper;
		$products = $productMapper->findAll();

		$tranformed = [];
		foreach ($products->getGenerator() as $product) {
			$tranformed[] = $product->transform();
		}

		print json_encode($tranformed);
	}
}