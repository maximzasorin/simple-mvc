<?php

namespace Mappers;

use Models\Model;

abstract class SelectionFactory
{
    abstract public function newInstance(IdentityObject $identityObject);

    public function buildWhere(IdentityObject $identityObject)
    {
    	if ($identityObject->isVoid()) {
    		return ['', []];
    	}

    	$conditions = [];
    	$fields = [];

    	foreach ($identityObject->getComps() as $comp) {
    		$conditions[] = $comp['name'] . ' ' . $comp['operator'] . ' ?';
    		$fields[] = $comp['value'];
    	};

    	$where = 'WHERE ' . implode(' AND ', $conditions);

    	return [$where, $fields];
    }
}