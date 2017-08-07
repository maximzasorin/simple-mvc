<?php

namespace Mappers;

class ProductCollection extends Collection
{
	public function targetClass()
	{
		return \Models\Product::class;
	}
}