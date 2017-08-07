<?php

namespace Mappers;

use Models\Product;
use Models\Variation;

class VariationModelFactory extends ModelFactory
{
	public function targetClass()
	{
		return \Models\Variation::class;
	}

   	protected function doCreateObject(array $array)
	{
		$variation = new Variation($array['id']);
		$variation->setName($array['name']);
		$variation->setPrice($array['price']);
		$variation->setCreatedAt($array['created_at']);

		return $variation;
	}
}