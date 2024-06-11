<?php

namespace Dell\DuAnXuong\Models;

use Dell\DuAnXuong\Commons\Model;

class Cart extends Model
{
    protected string $tableName = 'carts';

    public function findByUserId($userId)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('id = ?')
            ->setParameter(0, $userId)
            ->fetchAssociative();
    }

    
}
