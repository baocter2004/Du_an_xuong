@extends('layouts.master')

@section('title')
Danh sách Products
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h1 class="m-0">Danh sách Product</h1>
                    </div>
                </div>
            </div>
            <div class="white_card_body">

                <a class="btn btn-primary" href="<?= url('admin/products/create') ?>">Thêm mới</a>

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
                                <th>IMAGE</th>
                                <th>NAME</th>
                                <th>Price Regular</th>
                                <th>Price Sale</th>
                                <th>OverView</th>
                                <th>CREATED AT</th>
                                <th>UPDATED AT</th>
                                <th colspan="3">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($products as $product) { ?>
                                <tr>
                                    <td>
                                        <?= $product['id'] ?>
                                    </td>
                                    <td>
                                        <img src="<?= asset($product['img_thumbnail']) ?>" alt="" width="100px">
                                    </td>
                                    <td>
                                        <?= $product['name'] ?>
                                    </td>
                                    <td>
                                        <?= $product['price_regular'] ?>
                                    </td>
                                    <td>
                                        <?= $product['price_sale'] ?>
                                    </td>
                                    <td>
                                        <?= $product['overview'] ?>
                                    </td>
                                    <td>
                                        <?= $product['created_at'] ?>
                                    </td>
                                    <td>
                                        <?= $product['updated_at'] ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="<?= url('admin/products/' . $product['id'] . '/show') ?>">Xem</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning" href="<?= url('admin/products/' . $product['id'] . '/edit') ?>">Sửa</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="<?= url('admin/products/' . $product['id'] . '/delete') ?>" onclick="return confirm('Chắc chắn xóa không?')">Xóa</a>
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
                <a href="<?= url('admin/products/?page=' . (($_GET['page'] ?? 1) - 1)) ?>" class="page-link">&laquo;</a>
            </li>

            @for ($i = max(1, ($_GET['page'] ?? 1) - 2); $i <= min($totalPage, ($_GET['page'] ?? 1) + 2); $i++) <li class="page-item <?= $i == ($_GET['page'] ?? 1) ? 'active' : '' ?>">
                <a href="<?= url('admin/products/?page=' . $i) ?>" class="page-link"><?= $i ?></a>
                </li>
                @endfor

                <li class="page-item <?= ($_GET['page'] ?? 1) >= $totalPage ? 'disabled' : '' ?>">
                    <a href="<?= url('admin/products/?page=' . (($_GET['page'] ?? 1) + 1)) ?>" class="page-link">&raquo;</a>
                </li>
        </ul>
    </nav>
</div>
@endsection