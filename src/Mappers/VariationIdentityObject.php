<?php

namespace Mappers;

class VariationIdentityObject extends IdentityObject
{
    public function __construct($fieldName = null)
    {
        parent::__construct($fieldName, array(
        	'id', 'name', 'price', 'product_id', 'created_at'
        ));
    }
}