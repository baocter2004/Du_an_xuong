@extends('layouts.master')

@section('title')
Danh sách category
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h1 class="m-0">Danh sách category</h1>
                    </div>
                </div>
            </div>
            <div class="white_card_body">

                <a class="btn btn-primary" href="<?= url('admin/categories/create') ?>">Thêm mới</a>

                @if (isset($_SESSION['status']) && $_SESSION['status'])
                <div class="alert alert-success">
                    <?= $_SESSION['msg'] ?>
                </div>

                @php
                unset($_SESSION['status']);
                unset($_SESSION['msg']);
                @endphp
                @endif

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th colspan="3">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($categories as $category) { ?>
                                <tr>
                                    <td>
                                        <?= $category['id'] ?>
                                    </td>
                                    <td>
                                        <?= $category['name'] ?>
                                    </td> 
                                    <td>
                                        <a class="btn btn-info" href="<?= url('admin/categories/' . $category['id'] . '/show') ?>">Xem</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning" href="<?= url('admin/categories/' . $category['id'] . '/edit') ?>">Sửa</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="<?= url('admin/categories/' . $category['id'] . '/delete') ?>" onclick="return confirm('Chắc chắn xóa không?')">Xóa</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <nav>
        <ul class="pagination justify-content-center">

            <li class="page-item <?= ($_GET['page'] ?? 1) <= 1 ? 'disabled' : '' ?>">
                <a href="<?= url('admin/categories/?page=' . (($_GET['page'] ?? 1) - 1)) ?>" class="page-link">&laquo;</a>
            </li>

            @for ($i = max(1, ($_GET['page'] ?? 1) - 2); $i <= min($totalPage, ($_GET['page'] ?? 1) + 2); $i++) <li class="page-item <?= $i == ($_GET['page'] ?? 1) ? 'active' : '' ?>">
                <a href="<?= url('admin/categories/?page=' . $i) ?>" class="page-link"><?= $i ?></a>
                </li>
                @endfor

                <li class="page-item <?= ($_GET['page'] ?? 1) >= $totalPage ? 'disabled' : '' ?>">
                    <a href="<?= url('admin/categories/?page=' . (($_GET['page'] ?? 1) + 1)) ?>" class="page-link">&raquo;</a>
                </li>
        </ul>
    </nav>
</div>
@endsection