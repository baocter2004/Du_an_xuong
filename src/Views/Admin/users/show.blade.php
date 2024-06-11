@extends('layouts.master')

@section('title')
Thông Tin chi tiết
@endsection

@section('content')
<div class="container">
        <h1>Chi Tiết User : <?=$user['name']?></h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Trường dữ liệu</th>
                    <th>Giá Trị</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $field => $value) : ?>
                    <tr>
                        <td><?= $field ?></td>
                        <td><?= $value ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
@endsection