<?php

namespace Mappers;

class ProductSelectionFactory extends SelectionFactory
{
    public function newInstance(IdentityObject $identityObject)
    {
    	$fields = implode(', ', $identityObject->getObjectFields());
    	$query = "SELECT {$fields} FROM products";

    	list($where, $values) = $this->buildWhere($identityObject);

    	return [$query . ' ' . $where, $values];
    }
}