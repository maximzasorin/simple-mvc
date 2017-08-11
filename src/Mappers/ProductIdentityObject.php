<?php

namespace Mappers;

class ProductIdentityObject extends IdentityObject
{
    public function __construct($fieldName = null)
    {
        parent::__construct($fieldName = null, array(
        	'id', 'name', 'created_at'
        ));
    }
}