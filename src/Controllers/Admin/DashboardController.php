<?php
namespace Dell\DuAnXuong\Controllers\Admin;

use Dell\DuAnXuong\Commons\Controller;

class DashboardController extends Controller
{
    public function dashboard () {
        $this->rendViewAdmin((__FUNCTION__));
    }
}