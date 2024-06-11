@extends('layouts.master')

@section('title')
add user
@endsection

@section('content')
<div class="container">
    <h1>Thêm Mới User : </h1>

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
    <form action="<?= asset("admin/users/store") ?>" enctype="multipart/form-data" method="POST">
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
        </div>
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="mb-3 mt-3">
            <label for="avatar" class="form-label">Avatar:</label>
            <input type="file" class="form-control" id="avatar" placeholder="Enter avatar" name="avatar">
        </div>
        <div class="mb-3 mt-3">
            <label for="password" class="form-label">Password:</label>
            <input type="text" class="form-control" id="password" placeholder="Enter password" name="password">
        </div>
        <div class="mb-3 mt-3">
            <label for="confirm_password" class="form-label">confirm_password:</label>
            <input type="text" class="form-control" id="confirm_password" placeholder="Enter password" name="confirm_password">
        </div>
        <div class="mb-3 mt-3">
            <label for="type" class="form-label">Type:</label>
            <input type="text" class="form-control" id="type" placeholder="Enter type" name="type">
        </div>
        <div class="mb-3 mt-3">
            <label for="is_active" class="form-label">is_active:</label>
            <input type="text" class="form-control" id="is_active" placeholder="Enter active" name="is_active" value="0" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection