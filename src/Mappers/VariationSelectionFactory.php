<?php

namespace Mappers;

class VariationSelectionFactory extends SelectionFactory
{
    public function newInstance(IdentityObject $identityObject)
    {
    	$fields = implode(', ', $identityObject->getObjectFields());
    	$query = "SELECT {$fields} FROM variations";

    	list($where, $values) = $this->buildWhere($identityObject);

    	return [$query . ' ' . $where, $values];
    }
}