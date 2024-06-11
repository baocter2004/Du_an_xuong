<?php

namespace Dell\DuAnXuong\Controllers\Admin;

use Dell\DuAnXuong\Commons\Controller;
use Dell\DuAnXuong\Commons\Helper;
use Dell\DuAnXuong\Models\Product;

class DashboardController extends Controller
{
    private Product $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function dashboard()
    {
        $products = $this->product->all();
        // Helper::debug($products);

        $analysisProduct = array_map(function ($item) {

            return [
                $item['name'],
                $item['views']
            ];
        }, $products);

        Helper::debug($analysisProduct);

        array_unshift($analysisProduct, ['Tên sản phẩm', 'Lượt views']);

        $this->rendViewAdmin(__FUNCTION__, [
            'analysisProduct' => $analysisProduct
        ]);
    }
}
