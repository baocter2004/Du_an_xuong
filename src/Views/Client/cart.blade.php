@extends('layouts.master')

@section('title')
Giỏ Hàng
@endsection

@section('content')
<div class="row">
    @if (!empty($_SESSION['cart']))
    <div class="col-lg-12">
        <div class="card QA_section border-0">
            <div class="card-body QA_table ">
                <div class="table-responsive shopping-cart ">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="border-top-0">Product</th>
                                <th class="border-top-0">Price</th>
                                <th class="border-top-0">Quantity</th>
                                <th class="border-top-0">Total</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $cart = $_SESSION['cart'] ?? $_SESSION['cart-' . $_SESSION['user']['id']];
                            @endphp
                            @foreach ($cart as $item)
                            <tr>
                                <td>
                                    <img src="<?= asset($item['img_thumbnail']) ?>" alt height="52">
                                    <p class="d-inline-block align-middle mb-0">
                                        <a href class="d-inline-block align-middle mb-0 f_s_16 f_w_600 color_theme2"><?= $item['name'] ?>
                                        </a>
                                    </p>
                                </td>
                                <td><?= $item['price_sale'] ?: $item['price_regular'] ?></td>
                                <td><input class="form-control w-25" type="number" min="0" value="<?= $item['quantity'] ?>" id="example-number-input1">
                                </td>
                                <td>
                                    <?= $item['quantity'] * ($item['price_sale'] ?: $item['price_regular']); ?>
                                </td>
                                <td>
                                    <a class="text-dark" onclick="return confirm('Chắc chắn xóa không?')" href="<?= url('cart/remove') ?>?productId=<?= $item['id'] ?>"><i class="far fa-times-circle font_s_18"></i></a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
    @endif
</div>
@endsection