<?php

namespace Mappers;

use Models\Product;
use Models\Variation;

class ProductModelFactory extends ModelFactory
{
	public function targetClass()
	{
		return \Models\Variation::class;
	}

    protected function doCreateObject(array $array)
	{
		$product = new Product($array['id']);
		$product->setName($array['name']);
		$product->setCreatedAt($array['created_at']);

		$variationMapper = new VariationMapper;
		$variationCollection = $variationMapper->findByProductId($array['id']);

		$product->setVariations($variationCollection);

		return $product;
	}
}
