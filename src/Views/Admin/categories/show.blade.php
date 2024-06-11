@extends('layouts.master')

@section('title')
Thông Tin chi tiết
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h1>Chi Tiết category: <?= $category['name'] ?></h1>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Trường dữ liệu</th>
                                    <th>Giá Trị</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($category as $field => $value) : ?>
                                    <tr>
                                        <td><?= $field ?></td>
                                        <td><?= $value ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection