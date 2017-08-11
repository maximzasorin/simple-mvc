<?php

namespace Mappers;

use Models\Model;

abstract class UpdateFactory
{
    public abstract function newUpdate(Model $model);

    protected function buildStatement($table, array $fields, array $conditions = null)
    {
    	$terms = [];

    	if ($conditions) {
    		$query .= "UPDATE {$table} SET ";
			$query .= implode(' = ?,', array_keys($fields)) . ' = ?';
            $terms = array_merge($terms, array_values($fields));

			$query .= ' WHERE ';
			$c = [];

			foreach ($conditions as $field => $value) {
				$c[] = $field . ' = ?';
				$terms[] = $value;
			}

			$query .= implode(' AND ', $c);


    	} else {
    		$query .= "INSERT INTO {$table} (";
    		$query .= implode(',', array_keys($fields));
    		$query .= ')';
    		$query .= ' VALUES (';
    		
    		foreach ($fields as $field => $value) {
    			$terms[] = $value;
    			$qs[] = '?';
    		}

    		$query .= implode(',', $qs);
    		$query .= ')';
    	}

    	return [$query, $terms];
    }
}