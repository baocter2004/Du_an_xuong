<?php

namespace Dell\DuAnXuong\Controllers\Client;

use Dell\DuAnXuong\Commons\Controller;
use Dell\DuAnXuong\Models\Product;

class ProductController extends Controller
{
    private Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function index()
    {
        [$products, $totalPage] = $this->product->paginate($_GET['page'] ?? 1);

        $this->rendViewClient('product-list', [
            'products' => $products,
            'totalPage' => $totalPage
        ]);
    }

    public function detail($id)
    {
        $product = $this->product->findByID($id);

        $this->rendViewClient(
            'product-detail',
            [
                'product' => $product
            ]
        );
    }

    public function cart(){
        $this->rendViewClient(
            'cart'
        );
    }
}
