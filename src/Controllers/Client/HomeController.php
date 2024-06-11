<?php

namespace Dell\DuAnXuong\Controllers\Client;

use Dell\DuAnXuong\Commons\Controller;
use Dell\DuAnXuong\Commons\Helper;
use Dell\DuAnXuong\Models\Product;
use Dell\DuAnXuong\Models\User;

class HomeController extends Controller
{

    private Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }
    
    public function index()
    {

        $products = $this->product->joinWithCategory();
        $this->rendViewClient('home', [
            'products' => $products
        ]);
    }
}
 