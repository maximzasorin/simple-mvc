<?php

namespace Mappers;

class ProductIdentityObject extends IdentityObject
{
    public function __construct($fieldName = null)
    {
        parent::__construct($fieldName = null, array(
        	'name', 'created_at'
        ));
    }
}