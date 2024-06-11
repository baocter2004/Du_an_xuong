@extends('layouts.master')

@section('title')
Sửa Sản Phẩm
@endsection


@section('content')
<div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h1 class="m-0">Sửa Sản Phẩm</h1>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
            @if (!empty($_SESSION['errors']))
        <div class="alert alert-warning">
            <ul>
                @foreach ($_SESSION['errors'] as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>

            @php
            unset($_SESSION['errors']);
            @endphp
        </div>
        @endif

        <a href="<?= asset("admin/products/") ?>" class="btn btn-primary">Danh Sách products</a>
        <form action="<?= asset("admin/products/{$product['id']}/update") ?>" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?= $product['name'] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="price_regular" class="form-label">Price Regular:</label>
                <input type="price_regular" class="form-control" id="price_regular" placeholder="Enter price_regular" name="price_regular" value="<?= $product['price_regular'] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="price_sale" class="form-label">Price sale:</label>
                <input type="price_sale" class="form-control" id="price_sale" placeholder="Enter price_sale" name="price_sale" value="<?= $product['price_sale'] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="img_thumbnail" class="form-label">img_thumbnail:</label>
                <input type="file" class="form-control" id="img_thumbnail" placeholder="Enter img_thumbnail" name="img_thumbnail">
                <img src="<?= url($product['img_thumbnail']) ?>" alt="" width="100px">
            </div>
            <div class="mb-3 mt-3">
                <label for="overview" class="form-label">overview:</label>
                <input type="text" class="form-control" id="overview" placeholder="Enter overview" name="overview" value="<?= $product['overview'] ?>">
            </div>
            <div class="mb-3 mt-3">
                <label for="content" class="form-label">Content:</label>
                <textarea name="content" id="" cols="120" style="resize: none;"><?= $product['content'] ?></textarea>
            </div>
            <div class="mb-3 mt-3">
                <label for="is_active" class="form-label">Category:</label>
                <select name="category_id" id="category_id">
                    <option value="">Select a category</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id'] ?>" <?= $product['category_id'] === $category['id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
            </div>
        </div>
    </div>
@endsection