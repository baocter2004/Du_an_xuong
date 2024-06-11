<?php

namespace Dell\DuAnXuong\Models;

use Dell\DuAnXuong\Commons\Model;

class Product extends Model
{
    protected string $tableName = 'products';

    public function joinWithCategory()
    {
        return $this->queryBuilder
            ->select('p.*, c.name as category_name')
            ->from($this->tableName, 'p')
            ->leftjoin('p', 'categories', 'c', 'p.category_id = c.id')
            ->orderBy('id', 'desc')
            ->fetchAllAssociative();
    }

    public function paginate($page = 1, $perPage = 4)
    {
        $queryBuilder = clone ($this->queryBuilder);
        $offset = $perPage * ($page - 1);
        $totalPage = ceil($this->count() / $perPage);
        $data = $queryBuilder
            ->select('p.*, c.name as category_name')
            ->from($this->tableName, 'p')
            ->leftjoin('p', 'categories', 'c', 'p.category_id = c.id')
            ->setFirstResult($offset)
            ->setMaxResults($perPage)
            ->orderBy('id', 'desc')
            ->fetchAllAssociative();

        return [$data, $totalPage];
    }
}
