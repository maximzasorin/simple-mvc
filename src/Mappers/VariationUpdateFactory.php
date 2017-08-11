<?php

namespace Mappers;

use Models\Model;

class VariationUpdateFactory extends UpdateFactory
{
    public function newUpdate(Model $model)
    {
    	$fields = [
            'name' => $model->getName(),
            'price' => $model->getPrice(),
    	];

    	$conditions = [];

    	if ($model->getId()) {
    		$conditions['id'] = $model->getId();
    	}

    	return $this->buildStatement('variations', $fields, $conditions);
    }
}