<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật User</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Cập Nhật User : </h1>


    </div>
</body>

</html>



@extends('layouts.master')

@section('title')
Sửa Người Dùng
@endsection


@section('content')
<div class="col-lg-12">
    <div class="white_card card_height_100 mb_30">
        <div class="white_card_header">
            <div class="box_header m-0">
                <div class="main-title">
                    <h1 class="m-0">Sửa Người Dùng</h1>
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

            <a href="<?= asset("admin/users/") ?>" class="btn btn-primary">Danh Sách Users</a>
            <form action="<?= asset("admin/users/{$user['id']}/update") ?>" enctype="multipart/form-data" method="POST">
                <div class="mb-3 mt-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?= $user['name'] ?>">
                </div>
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?= $user['email'] ?>">
                </div>
                <div class="mb-3 mt-3">
                    <label for="avatar" class="form-label">Avatar:</label>
                    <input type="file" class="form-control" id="avatar" placeholder="Enter avatar" name="avatar">
                    <img src="{{ asset($user['avatar']) }}" alt="" width="100px">
                </div>
                <div class="mb-3 mt-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="text" class="form-control" id="password" placeholder="Enter password" name="password">
                </div>
                <div class="mb-3 mt-3">
                    <label for="type" class="form-label">Type:</label>
                    <input type="text" class="form-control" id="type" placeholder="Enter type" name="type" value="<?= $user['type'] ?>">
                </div>
                <div class="mb-3 mt-3">
                    <label for="is_active" class="form-label">is_active:</label>
                    <input type="text" class="form-control" id="is_active" placeholder="Enter active" name="is_active" value="<?= $user['is_active'] ?>">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection