<?php

namespace Commands;

use Http\Request;

use Models\ObjectWatcher;
use Models\Product;
use Mappers\ProductMapper;

class CreateProduct extends Command
{
	public function execute(Request $request)
	{
		$product = new Product;
		$product->setName('New product');
		$product->setCreatedAt(time());

		// ObjectWatcher::instance()->performOperations();

		var_dump($product->getId());
	}
}