<?php

namespace Dell\DuAnXuong\Controllers\Client;

use Dell\DuAnXuong\Commons\Controller;
use Dell\DuAnXuong\Commons\Helper;
use Dell\DuAnXuong\Models\User;

class LoginController extends Controller
{
    private User $user;
    public function __construct()
    {
        $this->user = new User();
    }
    public function showFormLogin()
    {
        $this->rendViewClient('login');
    }

    public function login()
    {
        try {

            $user = $this->user->findByEmail($_POST['email']);

            if (empty($user)) {
                throw new \Exception('Không Tồn Tại Email : ' . $_POST['email']);
            }

            $flag = password_verify($_POST['password'], $user['password']);

            if ($flag) {

                $_SESSION['user'] = $user;

                unset($_SESSION['cart']);

                if ($user['type'] == 'admin') {
                    header('Location: ' . url('admin/'));
                    exit;
                }

                header('Location: ' . url(''));
                exit;
            }
            // Helper::debug($user);
            throw new \Exception('password không đúng');
        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();

            header("Location: " . url('login'));

            exit;
        }
    }


    public function logout()
    {
        unset($_SESSION['cart-' . $_SESSION['user']['id']]);

        unset($_SESSION['user']);

        header("Location: " . url(''));
    }
}
