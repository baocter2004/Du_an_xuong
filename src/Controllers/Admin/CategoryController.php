<?php

namespace Dell\DuAnXuong\Controllers\Admin;

use Exception;
use Rakit\Validation\Validator;
use Dell\DuAnXuong\Commons\Helper;
use Dell\DuAnXuong\Commons\Controller;
use Dell\DuAnXuong\Models\Category;

class CategoryController extends Controller
{
    private Category $category;
    public function __construct()
    {
        $this->category = new Category();
    }

    public function index()
    {
        try {
            // phân trang category
            [$categories, $totalPage] = $this->category->paginate($_GET['page'] ?? 1);

            $this->rendViewAdmin('categories.index', [
                'categories' => $categories,
                'totalPage' => $totalPage
            ]);

        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }

    public function create()
    {
        try {

            $this->rendViewAdmin('categories.create');

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
                'name' => 'required|max:20',
            ]);

            $validation->validate();

            if ($validation->fails()) {
                $_SESSION['errors'] = $validation->errors()->firstOfAll();

                header('Location: ' . url('admin/categories/create'));
                exit();
            } else {
                $data = [
                    'name' => $_POST['name'],
                ];

                $this->category->insert($data);

                $_SESSION['status'] = true;
                $_SESSION['msg'] = 'Thao tác thành công';

                header('Location: ' . url('admin/categories'));
                exit;
            }
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }


    public function show($id)
    {
        try {
            $category = $this->category->findById($id);

            $this->rendViewAdmin('categories.show', [
                'category' => $category
            ]);

            $this->rendViewAdmin('layouts.partials.topbar',[
                'category' => $category
            ]);
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $category = $this->category->findById($id);

            if (empty($category)) {
                throw new Exception("Model not found");
            }

            $this->rendViewAdmin('categories.edit', [
                'category' => $category
            ]);
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }

    public function update($id)
    {
        try {

            $category = $this->category->findById($id);

            $validator = new Validator;

            // make it
            $validation = $validator->make($_POST + $_FILES, [
                'name' => 'required|max:20',
            ]);

            $validation->validate();

            if ($validation->fails()) {
                // thông báo lỗi để gửi ra trang index 
                $_SESSION['errors'] = $validation->errors()->firstOfAll();

                header('Location: ' . url("admin/categories/{$category['id']}/edit"));
                exit();
            } else {
                // data để POST lên db
                $data = [
                    'name' => $_POST['name'],
                ];
                

                $this->category->update($id, $data);

                $_SESSION['status'] = true;
                $_SESSION['msg'] = 'Thao tác thành công';

                header('Location: ' . url("admin/categories/{$category['id']}/edit"));
                exit;
            }
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }

    public function delete($id)
    {
        try {

            $this->category->delete($id);

            header('location: ' . url('admin/categories'));
            exit();
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }
}
