<?php

namespace Dell\DuAnXuong\Controllers\Client;

use Dell\DuAnXuong\Commons\Controller;
use Dell\DuAnXuong\Commons\Helper;
use Dell\DuAnXuong\Models\Cart;
use Dell\DuAnXuong\Models\CartDetail;
use Dell\DuAnXuong\Models\Product;

class CartController extends Controller
{
    private Cart $cart;
    private Product $product;
    private CartDetail $cartDetail;

    public function __construct()
    {
        $this->cart = new Cart();
        $this->product = new Product();
        $this->cartDetail = new cartDetail();
    }

    public function index()
    {
        $this->rendViewClient('cart');
    }


    public function add()
    { // thêm vào giỏ hàng đó
        // lấy thông tin sản phẩm theo id
        $product = $this->product->findById($_GET['productId']);
        // khởi tạo SESSION cart
        // check đang đăng nhập hay không
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            // nếu đã đăng nhập => cập nhật $key thành cart - 
            // $_SESSION['user']['id'] 
            $key .= '-' . $_SESSION['user']['id'];
        }

        // Kiểm tra sản phẩm đã có trong giỏ hàng hay chưa 
        if (!isset($_SESSION[$key][$product['id']])) {
            $_SESSION[$key][$product['id']] = $product + ['quantity' => $_GET['quantity'] ?? 1];
        } else {
            $_SESSION[$key][$product['id']]['quantity'] += $_GET['quantity'];
        }

        // nếu đã đăng nhập thì phải lưu vào csdl
        if (isset($_SESSION[$key][$product['id']])) {

            $conn = $this->cart->getConnect();

            $conn->beginTransaction();

            try {

                $cart = $this->cart->findByUserId($_SESSION['user']['id']);

                if (empty($cart)) {
                    $this->cart->insert([
                        'user_id' => $_SESSION['user']['id']
                    ]);
                }

                $cartId = $cart['id'] ?? $conn->lastInsertId();


                $this->cartDetail->deleteByCartId($cartId);

                foreach ($_SESSION[$key] as $productId => $item) {

                    $this->cartDetail->findByCartIdAndproductId($cartId, $productId);

                    Helper::debug([
                        'cart_id' => $cartId,
                        'product_id' => $productId,
                        'quantity' => $item['quantity']
                    ]);

                    $this->cartDetail->insert([
                        'cart_id' => $cartId,
                        'product_id' => $productId,
                        'quantity' => $item['quantity']
                    ]);
                    

                    // $cartItem = $this->cartDetail->findByCartIdAndproductId($cartId, $productId);
                    // if (empty($cartItem)) {
                    //     $this->cartDetail->insert([
                    //         'cart_id' => $cartId,
                    //         'product_id' => $productId,
                    //         'quantity' => $item['quantity']
                    //     ]);
                    // } else {
                    //     $this->cartDetail->update($cartItem['id'], [
                    //         'quantity' => $item['quantity']
                    //     ]);
                    // }
                }

                $conn->commit();
            } catch (\Throwable $th) {
                $conn->rollBack();
            }
        }

        header('Location: ' . url('cart/detail'));
        exit;
    }

    public function detail()
    {
        // chi tiết giỏ hàng
        $this->rendViewClient('cart');
    }

    public function quantityInc()
    {
        // tăng số lượng
    }

    public function quantityDec()
    {
        // giảm số lượng
    }

    public function remove()
    {
        //xóa trắng
    }
}

