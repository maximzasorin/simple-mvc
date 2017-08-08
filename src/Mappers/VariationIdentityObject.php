<?php

namespace Mappers;

class VariationIdentityObject extends IdentityObject
{
    public function __construct($fieldName = null)
    {
        parent::__construct($fieldName, array(
        	'name', 'price', 'created_at'
        ));
    }
}