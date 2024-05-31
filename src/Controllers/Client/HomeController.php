<?php

namespace Dell\DuAnXuong\Controllers\Client;

use Dell\DuAnXuong\Commons\Controller;
use Dell\DuAnXuong\Commons\Helper;
use Dell\DuAnXuong\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = new User();
        // Helper::debug($user);
        $name = "bao";

        $this->rendViewClient('home', [
            'name' => $name
        ]);
    }
}
 