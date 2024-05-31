<?php

namespace Dell\DuAnXuong\Controllers\Admin;

use Dell\DuAnXuong\Commons\Controller;
use Dell\DuAnXuong\Commons\Helper;
use Dell\DuAnXuong\Models\User;

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
            [$users , $totalPage] = $this->user->paginate($_GET['page'] ?? 1);

            $this->rendViewAdmin('users.index',[
                'users' => $users,
                'totalPage' => $totalPage
            ]);
        } catch (\Throwable $th) {
            Helper::debug($th->getMessage());
        }
    }

    public function create()
    {
        echo __CLASS__ . "@" . __FUNCTION__;

    }

    public function store()
    {
        echo __CLASS__ . "@" . __FUNCTION__;

    }


    public function show($id)
    {
        echo __CLASS__ . "@" . __FUNCTION__ . $id;
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
        echo __CLASS__ . "@" . __FUNCTION__ . $id;

    }
}
