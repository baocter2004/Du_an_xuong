<?php

namespace Dell\DuAnXuong\Controllers\Admin;

use Exception;
use Rakit\Validation\Validator;
use Dell\DuAnXuong\Commons\Helper;
use Dell\DuAnXuong\Commons\Controller;
use Dell\DuAnXuong\Models\Category;
use Dell\DuAnXuong\Models\Product;

class ProductController extends Controller
{
    private Category $category;
    private Product $product;
    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
    }

    public function index()
    {
        try {
            // phân trang product
            [$products, $totalPage] = $this->product->paginate($_GET['page'] ?? 1);

            $this->rendViewAdmin('products.index', [
                'products' => $products,
                'totalPage' => $totalPage
            ]);

        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }

    public function create()
    {
        try {
            $categories = $this->category->all();

            $this->rendViewAdmin('products.create',
            [
                'categories' => $categories
            ]);

        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }

    public function store()
    {
        try {
            $validator = new Validator;

            // make it
            $validation = $validator->make($_POST + $_FILES, [
                'name' => 'required|max:50',
                'price_regular' => 'required|numeric',
                'overview' => 'required|max:1000',
                'content' => 'required|max:15000',
                'img_thumbnail' => 'required|uploaded_file:0,2M,png,jpeg,jpg',
            ]);

            $validation->validate();

            if ($validation->fails()) {
                $_SESSION['errors'] = $validation->errors()->firstOfAll();

                header('Location: ' . url('admin/products/create'));
                exit();
            } else {
                $data = [
                    'name' => $_POST['name'],
                    'price_regular' => $_POST['price_regular'],
                    'overview' => $_POST['overview'],
                    'content' => $_POST['content'],
                    'category_id' => $_POST['category_id']
                ];

                if (isset($_FILES['img_thumbnail']) && $_FILES['img_thumbnail']['size'] > 0) {

                    $from = $_FILES['img_thumbnail']['tmp_name'];
                    $to = 'assets/uploads/' . time() . $_FILES['img_thumbnail']['name'];

                    if (move_uploaded_file($from, PATH_ROOT . $to)) {
                        $data['img_thumbnail'] = $to;
                    } else {
                        $_SESSION['errors']['img_thumbnail'] = 'Upload Không thành công';

                        header('Location: ' . url('admin/products/create'));
                        exit;
                    }
                }

                $this->product->insert($data);

                $_SESSION['status'] = true;
                $_SESSION['msg'] = 'Thao tác thành công';

                header('Location: ' . url('admin/products'));
                exit;
            }
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }


    public function show($id)
    {
        try {
            $product = $this->product->findById($id);

            $this->rendViewAdmin('products.show', [
                'product' => $product
            ]);

            // $this->rendViewAdmin('layouts.partials.topbar',[
            //     'product' => $product
            // ]);
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $categories = $this->category->all();

            $product = $this->product->findById($id);

            if (empty($product)) {
                throw new Exception("Model not found");
            }

            $this->rendViewAdmin('products.edit', [
                'product' => $product,
                'categories' => $categories
            ]);
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }

    public function update($id)
    {
        try {

            $product = $this->product->findById($id);

            $validator = new Validator;

            // make it
            $validation = $validator->make($_POST + $_FILES, [
                'name' => 'required|max:50',
                'price_regular' => 'required|numeric',
                'overview' => 'required|max:1000',
                'content' => 'required|max:15000',
                'img_thumbnail' => 'required|uploaded_file:0,2M,png,jpeg,jpg',
            ]);

            $validation->validate();

            if ($validation->fails()) {
                // thông báo lỗi để gửi ra trang index 
                $_SESSION['errors'] = $validation->errors()->firstOfAll();

                header('Location: ' . url("admin/products/{$product['id']}/edit"));
                exit();
            } else {
                // data để POST lên db
                $validation = $validator->make($_POST + $_FILES, [
                    'name' => 'required|max:50',
                    'price_regular' => 'required|numeric',
                    'overview' => 'required|max:100',
                    'content' => 'required|max:150',
                    'img_thumbnail' => 'required|uploaded_file:0,2M,png,jpeg,jpg',
                ]);
                // mặc định là không upload
                $flagUpload = false;
                // kiểm tra xem file đã có ảnh chưa
                if (isset($_FILES['img_thumbnail']) && $_FILES['img_thumbnail']['size'] > 0) {
                    // đã upload
                    $flagUpload = true;

                    $from = $_FILES['img_thumbnail']['tmp_name'];
                    $to = 'assets/uploads/' . time() . $_FILES['img_thumbnail']['name'];

                    if (move_uploaded_file($from, PATH_ROOT . $to)) {
                        $data['img_thumbnail'] = $to;
                    } else {
                        $_SESSION['errors']['img_thumbnail'] = 'Upload Không thành công';

                        header('Location: ' . url("admin/products/{$product['id']}/edit"));
                        exit;
                    }
                }

                $this->product->update($id, $data);

                // xóa file ảnh trước đây
                if (
                    $flagUpload
                    && $product['img_thumbnail']
                    && file_exists(PATH_ROOT . $product['img_thumbnail'])
                ) {
                    unlink(PATH_ROOT . $product['img_thumbnail']);
                }

                $_SESSION['status'] = true;
                $_SESSION['msg'] = 'Thao tác thành công';

                header('Location: ' . url("admin/products/{$product['id']}/edit"));
                exit;
            }
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }

    public function delete($id)
    {
        try {

            $product = $this->product->findById($id);

            $this->product->delete($id);

            if (
                $product['img_thumbnail']
                && file_exists(PATH_ROOT . $product['img_thumbnail'])
            ) {
                unlink(PATH_ROOT . $product['img_thumbnail']);
            }

            header('location: ' . url('admin/products'));
            exit();
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }
}
