<?php

namespace Mappers;

use Models\Model;

class ProductDeleteFactory extends DeleteFactory
{
    public function newDelete(Model $model)
    {
        $conditions = [];

        if ($model->getId()) {
            $conditions['id'] = $model->getId();
        }

        return $this->buildStatement('products', $conditions);
    }
}