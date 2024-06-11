<?php

namespace Dell\DuAnXuong\Models;

use Dell\DuAnXuong\Commons\Model;

class CartDetail extends Model
{
    protected string $tableName = 'cart_details';

    public function findByCartIdAndProductId($cartId, $productId)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)

            ->where('cart_id = ?')->setParameter(0, $cartId)
            ->where('product_id = ?')->setParameter(1, $productId)

            ->fetchAssociative();
    }

    public function deleteByCartId($cartId) 
    {
        return $this->queryBuilder
            ->delete($this->tableName)
            ->where('cart_id = ?')
            ->setParameter(0,$cartId)
            ->executeQuery();
    }
}
