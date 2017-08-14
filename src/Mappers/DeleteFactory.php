<?php

namespace Mappers;

use Models\Model;

abstract class DeleteFactory
{
    public abstract function newDelete(Model $model);

    protected function buildStatement($table, array $conditions = [])
    {
        $query = "DELETE FROM {$table}";

        $query .= ' WHERE ';
        $terms = [];
        $c = [];

        foreach ($conditions as $field => $value) {
            $c[] = $field . ' = ?';
            $terms[] = $value;
        }

        $query .= implode(' AND ', $c);

        return [$query, $terms];
    }
}