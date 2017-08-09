<?php

namespace Mappers;

use Models\Model;

class ProductUpdateFactory extends UpdateFactory
{
    public function newUpdate(Model $model)
    {
    	$fields = [
    		'name' => $model->getName(),
    	];

    	$conditions = [];

    	if ($model->getId()) {
    		$conditions['id'] = $model->getId();
    	}

    	return $this->buildStatement('products', $fields, $conditions);
    }
}