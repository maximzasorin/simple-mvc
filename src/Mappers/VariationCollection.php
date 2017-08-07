<?php

namespace Mappers;

class VariationCollection extends Collection
{
	public function targetClass()
	{
		return \Models\Variation::class;
	}
}