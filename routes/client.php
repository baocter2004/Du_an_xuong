<?php

//   website có các trang :
//          trang chủ
//          giới thiệu
//          sản phẩm
//          chi tiết sản phẩm
//          liên hệ

// để định nghĩ được , điều đầu tiên phải tạo controller trước
//  khai báo function tương ứng để xử lý
// định nghĩa đường dẫn

// HTTP Method : get , post , put ( path ), delete , option , head

use Dell\DuAnXuong\Controllers\Client\AboutController;
use Dell\DuAnXuong\Controllers\Client\CartController;
use Dell\DuAnXuong\Controllers\Client\ContactController;
use Dell\DuAnXuong\Controllers\Client\HomeController;
use Dell\DuAnXuong\Controllers\Client\LoginController;
use Dell\DuAnXuong\Controllers\Client\ProductController;

$router->get('/',               HomeController::class . '@index');
$router->get('/about',          AboutController::class . '@index');

$router->get('/contact',        ContactController::class . '@index');
$router->post('/contact/store', ContactController::class . '@store');

$router->get('/products',       ProductController::class . '@index');
$router->get('/products/{id}',  ProductController::class . '@detail');


$router->get('/login',          LoginController::class . '@showFormLogin');
$router->post('/handle-login',  LoginController::class . '@login');
$router->get('/logout',         LoginController::class . '@logout');

$router->get('/cart/add',          CartController::class . '@add');
$router->get('/cart',          CartController::class . '@index');
$router->get('/cart/quantityInc',  CartController::class . '@quantityInc');
$router->get('/cart/quantityDec',  CartController::class . '@quantityDec');
$router->get('/cart/remove',       CartController::class . '@remove');
$router->get('/cart/detail',       CartController::class . '@detail');


