<?php

namespace Dell\DuAnXuong\Controllers\Admin;

use Dell\DuAnXuong\Commons\Controller;
use Dell\DuAnXuong\Commons\Helper;
use Dell\DuAnXuong\Models\User;
use Rakit\Validation\Validator;

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
        $this->rendViewAdmin('users.create');
    }

    public function store()
    {
        $validator = new Validator;

        // make it
        $validation = $validator->make($_POST + $_FILES, [
            'name'                  => 'required|max:50',
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
            'confirm_password'      => 'required|same:password',
            'avatar'                => 'required|uploaded_file:0,2M,png,jpeg,jpg',
        ]);

        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();


            header('Location: ' . url('admin/users/create'));
            exit();
        } else {
            $data = [
                'name'     => $_POST['name'],
                'email'    => $_POST['email'],
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
    }


    public function show($id)
    {
        $user = $this->user->findById($id);

        $this->rendViewAdmin('users.show', [
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        echo __CLASS__ . "@" . __FUNCTION__ . $id;
    }

    public function update($id)
    {
        echo __CLASS__ . "@" . __FUNCTION__ . $id;
    }

    public function delete($id)
    {

        // $this->user->delete($id);
        // header('location: ' . url('admin/users'));

        // url('admin/users');
        // header("Location : " . $_ENV['BASE_URL'].  'admin/users');

        // echo 'delete id : ' . $id;

        try {
            $this->user->delete($id);
            header('location: ' . url('admin/users'));
            exit();
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }
}
