<?php

namespace Dell\DuAnXuong\Controllers\Admin;

use Exception;
use Dell\DuAnXuong\Models\User;
use Rakit\Validation\Validator;
use Dell\DuAnXuong\Commons\Helper;
use Dell\DuAnXuong\Commons\Controller;

class UserController extends Controller
{
    private User $user;
    public function __construct()
    {
        $this->user = new User();
    }

    public function index()
    {
        try {
            // phân trang user
            [$users, $totalPage] = $this->user->paginate($_GET['page'] ?? 1);

            $this->rendViewAdmin('users.index', [
                'users' => $users,
                'totalPage' => $totalPage
            ]);
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }

    public function create()
    {
        try {
            $this->rendViewAdmin('users.create');
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
                'email' => 'required|email',
                'password' => 'required|min:6',
                'confirm_password' => 'required|same:password',
                'avatar' => 'required|uploaded_file:0,2M,png,jpeg,jpg',
            ]);

            $validation->validate();

            if ($validation->fails()) {
                $_SESSION['errors'] = $validation->errors()->firstOfAll();

                header('Location: ' . url('admin/users/create'));
                exit();
            } else {
                $data = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                ];

                if (isset($_FILES['avatar']) && $_FILES['avatar']['size'] > 0) {

                    $from = $_FILES['avatar']['tmp_name'];
                    $to = 'assets/uploads/' . time() . $_FILES['avatar']['name'];

                    if (move_uploaded_file($from, PATH_ROOT . $to)) {
                        $data['avatar'] = $to;
                    } else {
                        $_SESSION['errors']['avatar'] = 'Upload Không thành công';

                        header('Location: ' . url('admin/users/create'));
                        exit;
                    }
                }

                $this->user->insert($data);

                $_SESSION['status'] = true;
                $_SESSION['msg'] = 'Thao tác thành công';

                header('Location: ' . url('admin/users'));
                exit;
            }
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }


    public function show($id)
    {
        try {
            $user = $this->user->findById($id);

            $this->rendViewAdmin('users.show', [
                'user' => $user
            ]);
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $user = $this->user->findById($id);

            if (empty($user)) {
                throw new Exception("Model not found");
            }

            $this->rendViewAdmin('users.edit', [
                'user' => $user
            ]);
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }

    public function update($id)
    {
        try {

            $user = $this->user->findById($id);

            $validator = new Validator;

            // make it
            $validation = $validator->make($_POST + $_FILES, [
                'name' => 'required|max:50',
                'email' => 'required|email',
                'password' => 'min:6',
                'confirm_password' => 'required|same:password',
                'avatar' => 'required|uploaded_file:0,2M,png,jpeg,jpg',
            ]);

            $validation->validate();

            if ($validation->fails()) {
                // thông báo lỗi để gửi ra trang index 
                $_SESSION['errors'] = $validation->errors()->firstOfAll();

                header('Location: ' . url("admin/users/{$user['id']}/edit"));
                exit();
            } else {
                // data để POST lên db
                $data = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    // nếu chưa có password thì giữ password cũ và băm nó ra
                    'password' => !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password']
                ];
                // mặc định là không upload
                $flagUpload = false;
                // kiểm tra xem file đã có ảnh chưa
                if (isset($_FILES['avatar']) && $_FILES['avatar']['size'] > 0) {
                    // đã upload
                    $flagUpload = true;

                    $from = $_FILES['avatar']['tmp_name'];
                    $to = 'assets/uploads/' . time() . $_FILES['avatar']['name'];

                    if (move_uploaded_file($from, PATH_ROOT . $to)) {
                        $data['avatar'] = $to;
                    } else {
                        $_SESSION['errors']['avatar'] = 'Upload Không thành công';

                        header('Location: ' . url("admin/users/{$user['id']}/edit"));
                        exit;
                    }
                }

                $this->user->update($id, $data);

                // xóa file ảnh trước đây
                if (
                    $flagUpload
                    && $user['avatar']
                    && file_exists(PATH_ROOT . $user['avatar'])
                ) {
                    unlink(PATH_ROOT . $user['avatar']);
                }

                $_SESSION['status'] = true;
                $_SESSION['msg'] = 'Thao tác thành công';

                header('Location: ' . url("admin/users/{$user['id']}/edit"));
                exit;
            }
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }

    public function delete($id)
    {
        try {

            $user = $this->user->findById($id);

            $this->user->delete($id);

            if (
                $user['avatar']
                && file_exists(PATH_ROOT . $user['avatar'])
            ) {
                unlink(PATH_ROOT . $user['avatar']);
            }

            header('location: ' . url('admin/users'));
            exit();
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }
}
