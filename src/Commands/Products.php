<?php

namespace Commands;

use Http\Request;

use Models\Product;
use Mappers\ProductMapper;

class Products extends Command
{
	public function execute(Request $request)
	{
		$product = new Product;
		$productMapper = new ProductMapper;
	}
}