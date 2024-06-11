@extends('layouts.master');

@section('title')
Edit Categories
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h1>Cập Nhật Category : </h1>
                    </div>
                    @if (isset($_SESSION['status']) && $_SESSION['status'])
                    <div class="alert alert-success">
                        <?= $_SESSION['msg'] ?>
                    </div>

                    @php
                    unset($_SESSION['status']);
                    unset($_SESSION['msg']);
                    @endphp
                    @endif

                    <a href="<?= asset("admin/categories/") ?>" class="btn btn-primary">Danh Sách categories</a>
                    <form action="<?= asset("admin/categories/{$category['id']}/update") ?>" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="id" value="<?= $category['id'] ?>">
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?= $category['name'] ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection